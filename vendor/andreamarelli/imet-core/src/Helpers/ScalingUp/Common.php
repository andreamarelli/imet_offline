<?php

namespace AndreaMarelli\ImetCore\Helpers\ScalingUp;

use AndreaMarelli\ImetCore\Models\Imet\Imet as ImetAlias;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\ScalingUpWdpa;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use AndreaMarelli\ImetCore\Services\Scores\ImetScores;

class Common
{

    private static array $protected_areas_ids = [];

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

        return (float)number_format(round($val, $round), 2);
    }

    /**
     * @param array $array
     * @param int $items_number
     * @return float|int
     */
    public static function get_average(array $array, int $items_number = 0): ?float
    {
        array_walk($array, function (&$item, $key) use (&$items_number) {
            if ((string)$item === "-") {
                $item = 0;
            }
        });

        return $items_number ? array_sum($array) / $items_number : null;
    }

    /**
     * @param $id
     * @param string $label
     * @param string $path
     * @return string
     */
    public static function indicator_label($id, string $label, string $path = 'imet-core::v2_common.assessment.'): string
    {
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
     * @return string
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
        if ($indicator === 'C3') {
            if ($value < 0 && !is_string($value)) {
                return static::round_number((100 + $value), 3);
            }
        } else if (in_array($indicator, ['C2', 'OC2', 'OC3'])) {
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
    public static function ranking_values_correction($value, int $length_to_divide, array $process_indicators = [], string $indicator = null)
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

        return static::round_number($value / $length_to_divide, 2);
    }

    /**
     * @param array $form_ids
     * @param string $type
     * @param array $indicators
     * @param bool $add_synthetic_indicator
     * @return array
     */
    public static function filtered_indicators_and_round_values(array $form_ids, string $type, array $indicators = [], bool $add_synthetic_indicator = false): array
    {
        $filtered = [];

        foreach ($form_ids as $form_id) {
            $results[$form_id] = ImetScores::get_step($form_id, $type);

            if (count($indicators)) {
                $filtered[$form_id] = array_intersect_key($results[$form_id], $indicators);
            }

            array_walk($filtered[$form_id], function (&$item) {
                $item = ((string)$item !== "") ? $item : "-";
            });

            $number_of_indicators = count(array_filter($filtered[$form_id], function ($item) {
                return (string)$item != "-";
            }));

            //loop through imet sub indicators to create an average value in order to sort in the ranking
            //and pass the correct value where needed
            $average = static::get_average($filtered[$form_id], $number_of_indicators);

            if ($filtered[$form_id] && $add_synthetic_indicator) {
                $filtered[$form_id][$type] = static::round_number($results[$form_id]['avg_indicator']);
            }

            $filtered[$form_id]['avg'] = $average !== null ? static::round_number($average) : "-";
            $filtered[$form_id]['indicators_number'] = $number_of_indicators;
        }
        //print_r($filtered);
        return $filtered;
    }


    /**
     * if names are duplicate add the year
     * @param int $form_id
     * @param bool $show_original_names
     * @return Imet[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|null
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

            $assessments[$k] = ImetScores::get_radar($form_id);

            $name = static::get_pa_name($form_id, $scaling_id);

            $assessments[$k]['name'] = $name->name;
            $assessments[$k]['color'] = $name->color;
            $assessments[$k]['wdpa_id'] = $name->wdpa_id;
            $assessments[$k]['form_id'] = (int)$form_id;
            $assessments[$k]['year'] = (int)$name->Year;

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
        $labels =  ImetScores::indicators_labels(ImetAlias::IMET_V2);
        $indicators = [
            'management_context' => [
                'C1' => 'C1: ' . $labels['C1'],
                'C2' => 'C2: ' . $labels['C2'],
                'C3' => 'C3: ' . $labels['C3']
            ],
            'value_and_importance_sub_indicators' => [
                'C11' => 'C1.1: ' . $labels['C11'],
                'C12' => 'C1.2: ' . $labels['C12'],
                'C13' => 'C1.3: ' . $labels['C13'],
                'C14' => 'C1.4: ' . $labels['C14'],
                'C15' => 'C1.5: ' . $labels['C15']
            ],
            'planning' => [
                'P1' => 'P1: ' . $labels['P1'],
                'P2' => 'P2: ' . $labels['P2'],
                'P3' => 'P3: ' . $labels['P3'],
                'P4' => 'P4: ' . $labels['P4'],
                'P5' => 'P5: ' . $labels['P5'],
                'P6' => 'P6: ' . $labels['P6']
            ],
            'inputs' => [
                'I1' => 'I1: ' . $labels['I1'],
                'I2' => 'I2: ' . $labels['I2'],
                'I3' => 'I3: ' . $labels['I3'],
                'I4' => 'I4: ' . $labels['I4'],
                'I5' => 'I5: ' . $labels['I5']
            ],
            'outputs' => [
                'OP1' => 'O/P1: ' . $labels['OP1'],
                'OP2' => 'O/P2: ' . $labels['OP2'],
                'OP3' => 'O/P3: ' . $labels['OP3'],
                'OP4' => 'O/P4: ' . $labels['OP4']
            ],
            'outcomes' => [
                'OC1' => 'O/C1: ' . $labels['OC1'],
                'OC2' => 'O/C2: ' . $labels['OC2'],
                'OC3' => 'O/C3: ' . $labels['OC3'],
            ],
            'process' => [
                'PRA' => 'PR A: ' . $labels['PRA'],
                'PRB' => 'PR B: ' . $labels['PRB'],
                'PRC' => 'PR C: ' . $labels['PRC'],
                'PRD' => 'PR D: ' . $labels['PRD'],
                'PRE' => 'PR E: ' . $labels['PRE'],
                'PRF' => 'PR F: ' . $labels['PRF']
            ],
            'process_internal_management_indicators' => [
                'PR1' => 'PR1: ' . $labels['PR1'],
                'PR2' => 'PR2: ' . $labels['PR2'],
                'PR3' => 'PR3: ' . $labels['PR3'],
                'PR4' => 'PR4: ' . $labels['PR4'],
                'PR5' => 'PR5: ' . $labels['PR5'],
                'PR6' => 'PR6: ' . $labels['PR6']
            ],
            'process_management_protection_indicators' => [
                'PR7' => 'PR7: ' . $labels['PR7'],
                'PR8' => 'PR8: ' . $labels['PR8'],
                'PR9' => 'PR9: ' . $labels['PR9']
            ],
            'process_stakeholders_relationships_indicators' => [
                'PR10' => 'PR10: ' . $labels['PR10'],
                'PR11' => 'PR11: ' . $labels['PR11'],
                'PR12' => 'PR12: ' . $labels['PR12']
            ],
            'process_tourism_management_indicators' => [
                'PR13' => 'PR13: ' . $labels['PR13'],
                'PR14' => 'PR14: ' . $labels['PR14'],
            ],
            'process_monitoring_and_research_indicators' => [
                'PR15' => 'PR15: ' . $labels['PR15'],
                'PR16' => 'PR16: ' . $labels['PR16'],
            ],
            'process_effects_of_climate_change_indicators' => [
                'PR17' => 'PR17: ' . $labels['PR17'],
                'PR18' => 'PR18: ' . $labels['PR18'],
            ]
        ];

        return $indicators[$indicator];
    }

}
