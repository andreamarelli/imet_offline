<?php

namespace AndreaMarelli\ImetCore\Helpers\ScalingUp;

use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\ScalingUpWdpa;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use AndreaMarelli\ImetCore\Services\Statistics\V1ToV2StatisticsService;
use AndreaMarelli\ImetCore\Services\Statistics\V2StatisticsService;

class Common
{

    private static $protected_areas_ids = [];

    /**
     * @return string
     */
    public static function random_color(): string
    {
        return "#" . substr(md5(rand()), 0, 6);
    }

    /**
     * @param $val
     * @param int $round
     * @return float
     */
    public static function round_number($val, int $round = 1)
    {
        if ($val == "-") {
            return $val;
        }

        if ($val == 100 || $val == 0) {
            return $val;
        }
        if ($val == "0.0") {
            return 0;
        }

        return number_format(round($val, $round), 1);
    }

    /**
     * @param array $array
     * @param int $items_number
     * @return float|int
     */
    public static function get_average(array $array, int $items_number = 0): float
    {
        array_walk($array, function (&$item, $key) {
            if ((string)$item === "-") {
                $item = 0;
            }
        });

        return $items_number ? array_sum($array) / $items_number : 0;
    }

    /**
     * @param $id
     * @param string $label
     * @param string $path
     * @return string
     */
    public static function indicator_label($id, string $label, string $path = 'imet-core::v2_common.assessment.'): string
    {
        //echo trans($path . $id)." ".strtoupper(trans($path . $id)[0]) . " " . trans($label . $id)."\n";
        return strtoupper(trans($path . $id)[0]) . " " . trans($label . $id);
    }

    /**
     * @param array $array
     * @param $percentile
     * @return float|int|mixed
     */
    public static function get_percentile(array $array, $percentile)
    {
        sort($array);
        $result = 0;
        $index = ($percentile / 100) * count($array);
        if (floor($index) == $index) {
            if (isset($array[$index - 1])) {
                $result = ($array[$index - 1] + $array[$index]) / 2;
            } else {
                //todo maybe is wrong i have to discuss it
                //$result = 0;
            }
        } else {
            $result = $array[floor($index)];
        }
        return $result;
    }

    /**
     * use it when duplicate values to add a value in a parenthesis next to the name
     * @param string $search_with
     * @param string $in_value
     * @param string $add_value
     * @return mixed|string
     */
    public static function add_the_indicator_to_the_field(string $search_with, string $in_value, string $add_value): string
    {
        if (in_array($search_with, static::$protected_areas_ids)) {
            $in_value .= " ($add_value)";
        }
        static::$protected_areas_ids[] = $search_with;

        return $in_value;
    }

    /**
     * @param array $general_info
     * @return string
     */
    public static function get_category_of_protected_area(array $general_info): string
    {
        $iucn_category = $general_info['IUCNCategory1'] === 'Not Reported' ? '' : "(" . $general_info['IUCNCategory1'] . ")";
        return $general_info['NationalCategory'] . $iucn_category;
    }

    /**
     * @return void
     */
    public static function reset_areas_ids()
    {
        static::$protected_areas_ids = [];
    }

    /**
     * @param string $indicator
     * @param $value
     * @return float
     */
    public static function values_correction(string $indicator, $value)
    {
        if ($indicator === "c3") {
            if ($value < 0 && !is_string($value)) {
                return static::round_number((100 + $value), 3);
            }
        } else if (in_array($indicator, ["c2", "oc2", "oc3"])) {
            return static::round_number(50 + ((float)$value / 2), 3);
        }

        return $value;
    }

    /**
     * @param $value
     * @param int $length_to_divide
     * @param array $process_indicators
     * @param string|null $indicator
     * @return float
     */
    public static function ranking_values_correction($value, int $length_to_divide, array $process_indicators = [], string $indicator = null): float
    {
        if ($value === 0) {
            return 0;
        }

        if ((string)$value === "-") {
            return $value;
        }

        //use it only for process indicators
        if ($indicator && isset($process_indicators[$indicator])) {
            $length_to_divide = array_sum($process_indicators);
            return static::round_number(($value * $process_indicators[$indicator]) / $length_to_divide, 2);
        }
        //echo $value ."\n";
        return static::round_number($value / $length_to_divide, 3);
    }

    /**
     * @param array $form_ids
     * @param string $type
     * @param array $indicators
     * @return array
     */
    public static function filtered_indicators_and_round_values(array $form_ids, string $type, array $indicators = [], bool $add_synthetic_indicator = false): array
    {
        $filtered = [];

        foreach ($form_ids as $key => $form_id) {

            $version = \AndreaMarelli\ImetCore\Models\Imet\Imet::getVersion($form_id);

            $results[$form_id] = $version === \AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_V1
                ? V1ToV2StatisticsService::get_scores($form_id, $type)
                : V2StatisticsService::get_scores($form_id, $type);

            if (count($indicators)) {
                $filtered[$form_id] = array_intersect_key($results[$form_id], $indicators);
            }

            if($filtered[$form_id] && $add_synthetic_indicator){
                $filtered[$form_id][$type] = static::round_number($results[$form_id]['avg_indicator']);
            }
            array_walk($filtered[$form_id], function (&$item, $key) {

                if ((string)$item !== "") {
                    $item = $item;
                } else {
                    $item = "-";
                }
            });

            $number_of_indicators = count(array_filter($filtered[$form_id], function ($item) {
                return (string)$item != "-";
            }));

            //loop through imet sub indicators to create an average value in order to sort in the ranking
            //and pass the correct value where needed

            $filtered[$form_id]['avg'] = static::round_number(static::get_average($filtered[$form_id], $number_of_indicators));
            $filtered[$form_id]['indicators_number'] = $number_of_indicators;


            //
        }

            return $filtered;
        }


    /**
     * if names are duplicate add the year
     * @param int $form_id
     * @param bool $show_original_names
     * @return \AndreaMarelli\ImetCore\Models\Imet\v2\Imet[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|null
     */
    public static function protected_areas_duplicate_fixes(int $form_id, bool $show_original_names = false)
    {
        $area = static::get_protected_area_data($form_id, $show_original_names);
        if ($area !== null) {
            $area->name = Common::add_the_indicator_to_the_field($area->wdpa_id, $area->name, $area->Year);

            return $area;
        }
        return null;
    }

    /**
     * @param $form_id
     * @param bool $show_original_names
     * @return Imet[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    private static function get_protected_area_data($form_id, bool $show_original_names = false)
    {
        if ($show_original_names) {
            $protected_area = Imet::where('FormID', $form_id)->get();
            if (count($protected_area)) {
                return $protected_area[0];
            }
        } else {
            $protected_area = ScalingUpWdpa::getByFormID(static::$scaling_id, $form_id);
            if (($protected_area)) {
                return $protected_area;
            }
        }

        return null;
    }

    /**
     * get protected area custom names with all the information
     * @param array $form_ids
     * @param bool $show_original_names
     * @return Imet[]|bool|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     * @throws \ReflectionException
     */
    public static function get_protected_area(array $form_ids, bool $show_original_names = false): array
    {
        $protected_area = [];
        $categories = [];
        foreach ($form_ids as $form_id) {
            $protected_area[$form_id] = static::protected_areas_duplicate_fixes($form_id, $show_original_names);
            $general_info = Modules\Context\GeneralInfo::getVueData($form_id);
            if ($general_info['records'][0]) {
                $categories[$form_id] = Common::get_category_of_protected_area($general_info['records'][0]);
            }
        }

        return ["models" => $protected_area, "categories" => $categories];
    }

    /**
     * @param array $form_ids
     * @param int $scaling_id
     * @return array|array[]
     */
    public static function get_assessments(array $form_ids, int $scaling_id = 0): array
    {
        $indicators = [
            'context',
            'planning',
            'inputs',
            'process',
            'outputs',
            'outcomes'
        ];

        $assessments = [];
        foreach ($form_ids as $k => $form_id) {

            $version = \AndreaMarelli\ImetCore\Models\Imet\Imet::getVersion($form_id);

            $assessments[$k] = $version === \AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_V1
                ? V1ToV2StatisticsService::get_scores($form_id, 'global')
                : V2StatisticsService::get_scores($form_id, 'global');

            $name = static::get_pa_name($form_id, $scaling_id);

            $assessments[$k]['name'] = $name->name;
            $assessments[$k]['color'] = $name->color;
            $assessments[$k]['wdpa_id'] = $name->wdpa_id;
            $assessments[$k]['formid'] = (int)$form_id;

            $assessments[$k]['imet_index'] = static::round_number($assessments[$k]['imet_index']);
            foreach ($indicators as $key => $indicator) {
                $assessments[$k][$indicator] = static::round_number($assessments[$k][$indicator]);
            }
        }

        uasort($assessments, function ($a, $b) {
            return $b['name'] <=> $a['name'];
        });

        return ['status' => 'success', 'data' => ['assessments' => $assessments]];
    }

    public static function get_pa_name(int $id, int $scaling_id = 0)
    {
        if ($scaling_id > 0) {
            return ScalingUpWdpa::getCustomNames($id, $scaling_id);
        }

        return static::protected_areas_duplicate_fixes($id, true);
    }

    /**
     * @param $indicator
     * @return string[]
     */
    public static function get_labels_by_indicator($indicator): array
    {
        $indicators = [
            'management_context' => [
                'c1' => 'C1: ' . trans('imet-core::analysis_report.assessment.c1'),
                'c2' => 'C2: ' . trans('imet-core::analysis_report.assessment.c2'),
                'c3' => 'C3: ' . trans('imet-core::analysis_report.assessment.c3')
            ],
            'value_and_importance_sub_indicators' => [
                'c11' => 'C1.1: ' . trans('imet-core::analysis_report.assessment.c11'),
                'c12' => 'C1.2: ' . trans('imet-core::analysis_report.assessment.c12'),
                'c13' => 'C1.3: ' . trans('imet-core::analysis_report.assessment.c13'),
                'c14' => 'C1.4: ' . trans('imet-core::analysis_report.assessment.c14'),
                'c15' => 'C1.5: ' . trans('imet-core::analysis_report.assessment.c15')
            ],
            'planning' => [
                'p1' => 'P1: ' . trans('imet-core::analysis_report.assessment.p1'),
                'p2' => 'P2: ' . trans('imet-core::analysis_report.assessment.p2'),
                'p3' => 'P3: ' . trans('imet-core::analysis_report.assessment.p3'),
                'p4' => 'P4: ' . trans('imet-core::analysis_report.assessment.p4'),
                'p5' => 'P5: ' . trans('imet-core::analysis_report.assessment.p5'),
                'p6' => 'P6: ' . trans('imet-core::analysis_report.assessment.p6')
            ],
            'inputs' => [
                'i1' => 'I1: ' . trans('imet-core::analysis_report.assessment.i1'),
                'i2' => 'I2: ' . trans('imet-core::analysis_report.assessment.i2'),
                'i3' => 'I3: ' . trans('imet-core::analysis_report.assessment.i3'),
                'i4' => 'I4: ' . trans('imet-core::analysis_report.assessment.i4'),
                'i5' => 'I5: ' . trans('imet-core::analysis_report.assessment.i5')
            ],
            'outputs' => [
                'op1' => 'O/P1: ' . trans('imet-core::analysis_report.assessment.op1'),
                'op2' => 'O/P2: ' . trans('imet-core::analysis_report.assessment.op2'),
                'op3' => 'O/P3: ' . trans('imet-core::analysis_report.assessment.op3')
            ],
            'outcomes' => [
                'oc1' => 'O/C1: ' . trans('imet-core::analysis_report.assessment.oc1'),
                'oc2' => 'O/C2: ' . trans('imet-core::analysis_report.assessment.oc2'),
                'oc3' => 'O/C3: ' . trans('imet-core::analysis_report.assessment.oc3'),
            ],
            'process' => [
                'pr15_16' => 'PR A: ' . trans('imet-core::analysis_report.assessment.pr15_16'),
                'pr10_12' => 'PR B: ' . trans('imet-core::analysis_report.assessment.pr10_12'),
                'pr13_14' => 'PR C: ' . trans('imet-core::analysis_report.assessment.pr13_14'),
                'pr17_18' => 'PR D: ' . trans('imet-core::analysis_report.assessment.pr17_18'),
                'pr1_6' => 'PR E: ' . trans('imet-core::analysis_report.assessment.pr1_6'),
                'pr7_9' => 'PR F: ' . trans('imet-core::analysis_report.assessment.pr7_9')
            ],
            'process_internal_management_indicators' => [
                'pr1' => 'PR1: ' . trans('imet-core::analysis_report.assessment.pr1'),
                'pr2' => 'PR2: ' . trans('imet-core::analysis_report.assessment.pr2'),
                'pr3' => 'PR3: ' . trans('imet-core::analysis_report.assessment.pr3'),
                'pr4' => 'PR4: ' . trans('imet-core::analysis_report.assessment.pr4'),
                'pr5' => 'PR5: ' . trans('imet-core::analysis_report.assessment.pr5'),
                'pr6' => 'PR6: ' . trans('imet-core::analysis_report.assessment.pr6')
            ],
            'process_management_protection_indicators' => [
                'pr7' => 'PR7: ' . trans('imet-core::analysis_report.assessment.pr7'),
                'pr8' => 'PR8: ' . trans('imet-core::analysis_report.assessment.pr8'),
                'pr9' => 'PR9: ' . trans('imet-core::analysis_report.assessment.pr9')
            ],
            'process_stakeholders_relationships_indicators' => [
                'pr10' => 'PR10: ' . trans('imet-core::analysis_report.assessment.pr10'),
                'pr11' => 'PR11: ' . trans('imet-core::analysis_report.assessment.pr11'),
                'pr12' => 'PR12: ' . trans('imet-core::analysis_report.assessment.pr12')
            ],
            'process_tourism_management_indicators' => [
                'pr13' => 'PR13: ' . trans('imet-core::analysis_report.assessment.pr13'),
                'pr14' => 'PR14: ' . trans('imet-core::analysis_report.assessment.pr14'),
            ],
            'process_monitoring_and_research_indicators' => [
                'pr15' => 'PR15: ' . trans('imet-core::analysis_report.assessment.pr15'),
                'pr16' => 'PR16: ' . trans('imet-core::analysis_report.assessment.pr16'),
            ],
            'process_effects_of_climate_change_indicators' => [
                'pr17' => 'PR17: ' . trans('imet-core::analysis_report.assessment.pr17'),
                'pr18' => 'PR18: ' . trans('imet-core::analysis_report.assessment.pr18'),
            ]
        ];

        return $indicators[$indicator];
    }

}
