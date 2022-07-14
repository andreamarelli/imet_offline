<?php

namespace AndreaMarelli\ImetCore\Helpers\ScalingUp;

use AndreaMarelli\ImetCore\Controllers\Imet\EvalControllerV2;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\ScalingUpWdpa;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;

class Common
{

    private static $protected_areas_ids = [];

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

        return round($val, $round);
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
            return static::round_number((100 + $value), 3); //todo remove it and check context
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
    public static function filtered_indicators_and_round_values(array $form_ids, string $type, array $indicators = []): array
    {
        $filtered = [];
        foreach ($form_ids as $key => $form_id) {

            $results[$form_id] = static::get_sub_indicators_by_context($form_id, $type);

            if (count($indicators)) {
                $filtered[$form_id] = array_intersect_key($results[$form_id], $indicators);
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
            $filtered[$form_id]['avg'] = static::get_average($filtered[$form_id], $number_of_indicators);
            $filtered[$form_id]['indicators_number'] = $number_of_indicators;
        }

        return $filtered;
    }


    /**
     * @param int $form_id
     * @param string $type
     * @return array|array[]
     */
    public static function get_sub_indicators_by_context(int $form_id, string $type = ''): array
    {
        return (array)EvalControllerV2::assessment($form_id, $type)->getData();
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
     * @return array|array[]
     */
    public static function get_assessments(array $form_ids, int $scaling_id): array
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

            $assessments[$k] = (array)EvalControllerV2::assessment($form_id, 'global', true)->getData();
            $name = ScalingUpWdpa::getCustomNames($form_id, $scaling_id);
            $assessments[$k]['name'] = $name->name;
            $assessments[$k]['color'] = $name->color;
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

}
