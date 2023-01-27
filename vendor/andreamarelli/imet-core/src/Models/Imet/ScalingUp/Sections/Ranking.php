<?php

namespace AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections;

use AndreaMarelli\ImetCore\Helpers\ScalingUp\Common;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\ScalingUpAnalysis;

class Ranking
{
    /**
     * @param array $form_ids
     * @param string $type
     * @param array $indicators
     * @param int $scaling_id
     * @return array[]|\array[][]
     */
    public static function ranking_indicators(array $form_ids, string $type, array $indicators, int $scaling_id = 0): array
    {
        $items_to_calculate = $percent_values = $sum_values = $separated_values_by_pa = [];
        $ranking = ['values' => [], 'legends' => [], 'xAxis' => [], 'wdpa_ids' => [], 'actual_value' => []];


        // only for process sub-indicators average
        if (isset($indicators['pr15_16'])) {
            $result = static::process_subindicators_for_ranking_protected_areas($form_ids, $type);
            $filtered = $result[0];
            $indicators_numbers = $result[1];
        } else {
            $filtered = Common::filtered_indicators_and_round_values($form_ids, $type, $indicators);
        }

        //loop each imet record sorted and get pa name
        //and merge it with the table
        $i = 0;
        foreach ($filtered as $id => $values) {
            $pa = Common::get_pa_name($id, $scaling_id);

            $protected_area = $pa->name;
            $wdpa_id = $pa->wdpa_id;
            unset($values['avg']);
            unset($values['indicators_number']);

            $indicators_divide_length = count(array_filter($values));
            if (!isset($items_to_calculate[$i])) {
                $items_to_calculate[$i] = 0;
            }

            foreach ($values as $v => $value) {
                if ($type === "process" && stripos($v, "_") === true) {
                    $name = Common::indicator_label($v, 'imet-core::analysis_report.assessment.', 'imet-core::analysis_report.legends.');
                } else {
                    $name = Common::indicator_label($v, 'imet-core::analysis_report.assessment.');
                }
                $indicators_process_number = [];
                if (isset($indicators_numbers[$id])) {
                    $indicators_process_number = $indicators_numbers[$id];
                }

                if (count($indicators_process_number) > 0) {
                    $correction_value = Common::ranking_values_correction(Common::values_correction($v, $value), $indicators_divide_length, $indicators_process_number, $v);
                } else {
                    $correction_value = Common::values_correction($v, $value);
                }

                $ranking['legends'][$v] = $name;
                $ranking['actual_value'][$name][] = $correction_value;
                if ((string)$correction_value !== "-") {
                    $items_to_calculate[$i]++;
                    $separated_values_by_pa[$i][] = $correction_value;
                } else {
                    $separated_values_by_pa[$i][] = ScalingUpAnalysis::UNDEFINED_VALUE;
                }

                if (!isset($sum_values[$i])) {
                    $sum_values[$i] = 0;
                }
                $sum_values[$i] += (float)($correction_value);
            }

            $ranking['xAxis'][$i] = $protected_area;
            $ranking['wdpa_ids'][$i] = $wdpa_id;
            $i++;
        }

        return static::get_values_ranking($ranking, $sum_values, $separated_values_by_pa, $percent_values, $items_to_calculate);
    }

    /**
     * @param array $ranking
     * @param array $sum_values
     * @param array $separated_values_by_pa
     * @param array $percent_values
     * @param array $items_to_calculate
     * @return array
     */
    private static function get_values_ranking(array $ranking, array $sum_values, array $separated_values_by_pa, array $percent_values, array $items_to_calculate = []): array
    {
        $new_ranking = ['values' => [], 'legends' => [], 'xAxis' => [], 'wdpa_ids' => [], 'actual_value' => []];
        $reorder_separated_values_by_pa = [];
        $reorder_percent_values = [];
        $keys = array_keys($ranking['actual_value']);
        foreach ($separated_values_by_pa as $k => $values) {
            foreach ($values as $kk => $value) {
                $val = $sum_values[$k];
                if ($val == 0) {
                    $val = 1;
                }

                $set_value = ($value != ScalingUpAnalysis::UNDEFINED_VALUE) ? Common::round_number(($value / $val) * 100) : $value;
                $percent_values[$keys[$kk]][$k] = $set_value ;
            }
        }

        $average_values = array_map(function ($value, $i) use ($items_to_calculate, $separated_values_by_pa) {
            return $items_to_calculate[$i] > 0  ? Common::round_number($value / $items_to_calculate[$i]) : 0;
        }, $sum_values, array_keys($sum_values));

        foreach ($percent_values as $k => $values) {
            foreach ($values as $kk => $value) {
                $ranking['values'][$k][$kk] = $value !== ScalingUpAnalysis::UNDEFINED_VALUE ? Common::round_number(($value / 100) * $average_values[$kk]) : $value;
            }
        }

        arsort($average_values);

        foreach ($ranking['values'] as $ind => $items) {
            $i = 0;
            foreach ($average_values as $k => $vals) {
                if (!isset($new_ranking['values'][$ind])) {
                    $new_ranking['values'][$ind] = [];
                }
                if (!isset($new_ranking['actual_value'][$ind])) {
                    $new_ranking['actual_value'][$ind] = [];
                }
                $new_ranking['values'][$ind][$i] = $ranking['values'][$ind][$k];
                $new_ranking['actual_value'][$ind][$i] = $ranking['actual_value'][$ind][$k];
                $new_ranking['xAxis'][$i] = $ranking['xAxis'][$k];
                $new_ranking['wdpa_ids'][$i] = $ranking['wdpa_ids'][$k];
                $reorder_separated_values_by_pa[$i] = $separated_values_by_pa[$k];
                $reorder_percent_values[$ind][$i] = $percent_values[$ind][$k];
                $i++;
            }
        }

        $new_ranking['legends'] = $ranking['legends'];
        $new_ranking['percent_value'] = $reorder_percent_values;
        $new_ranking['raw_values_protected_area'] = $reorder_separated_values_by_pa;

        return $new_ranking;
    }

    /**
     * @param array $form_ids
     * @param string $type
     * @return array[]
     */
    private static function process_subindicators_for_ranking_protected_areas(array $form_ids, string $type): array
    {
        $overall_ranking = [
            'pr1_6' => ['pr1' => [], 'pr2' => [], 'pr3' => [], 'pr4' => [], 'pr5' => [], 'pr6' => []],
            'pr7_9' => ['pr7' => [], 'pr8' => [], 'pr9' => []],
            'pr10_12' => ['pr10' => [], 'pr11' => [], 'pr12' => []],
            'pr13_14' => ['pr13' => [], 'pr14' => []],
            'pr15_16' => ['pr15' => [], 'pr16' => []],
            'pr17_18' => ['pr17' => [], 'pr18' => []]
        ];

        $indicators_numbers = [];
        $indicators_average = [];

        foreach ($overall_ranking as $key => $value) {
            $indicators_average[$key] = Common::filtered_indicators_and_round_values($form_ids, $type, $value);
        }
        $filtered_indicators = [];

        foreach ($indicators_average as $key => $item) {
            foreach ($form_ids as $form_id) {
                $form_values = $item[$form_id];

                $filtered_indicators[$form_id][$key] = $form_values['avg'];
                $indicators_numbers[$form_id][$key] = $form_values['indicators_number'];
            }
        }

        return [$filtered_indicators, $indicators_numbers];
    }

    /**
     * @param array $form_ids
     * @param int|null $scaling_id
     * @return array[]|\array[][]
     */
    public static function ranking_threats_indicators(array $form_ids, int $scaling_id = 0): array
    {
        $ranking = ['values' => [], 'legends' => [], 'xAxis' => [], 'xAxisx' => [], 'wdpa_ids' => []];
        $items_to_calculate = $ranking_raw_values = $separated_values_by_pa = $sum_values = $percent_values = $protected_areas = [];
        foreach ($form_ids as $j => $form_id) {
            $pa = Common::get_pa_name($form_id, $scaling_id);
            $protected_areas[$j] = Modules\Context\MenacesPressions::getStats($form_id);
            $wdpa_id = $pa->wdpa_id;

            foreach ($protected_areas[$j]['category_stats'] as $k => $protected_area) {
                if (!isset($sum_values[$j])) {
                    $sum_values[$j] = 0;
                }
                if (!isset($items_to_calculate[$j])) {
                    $items_to_calculate[$j] = 0;
                }
                $name = trans('imet-core::v2_context.MenacesPressions.categories.title' . ($k + 1), []);
                if ($protected_area === "") {
                    $value = ScalingUpAnalysis::UNDEFINED_VALUE;
                    $separated_values_by_pa[$j][] = $value;
                } else {
                    $items_to_calculate[$j] += 1;
                    $value = Common::round_number((-1 * (double)$protected_area));
                    $sum_values[$j] += (float)($value);
                    $separated_values_by_pa[$j][] = $value;
                }
                $ranking_raw_values[$name][] = $ranking['actual_value'][$name][] = $value;
                $ranking['legends'][$name] = $name;


            }
            $ranking['xAxis'][$j] = $pa->name;
            $ranking['wdpa_ids'][$j] = $wdpa_id;
        }
        //dd($ranking);
        return static::get_values_ranking($ranking, $sum_values, $separated_values_by_pa, $percent_values, $items_to_calculate);
    }

    /**
     * @param array $form_ids
     * @param array $assessment
     * @return array|array[]|\array[][]
     */
    public static function get_overall_ranking(array $form_ids, array $assessment = []): array
    {
        $indicators = [
            'context' => 0,
            'planning' => 0,
            'inputs' => 0,
            'process' => 0,
            'outputs' => 0,
            'outcomes' => 0
        ];

        $total_values = $raw_values = [];
        $percent = ['values' => [], 'legends' => [], 'xAxis' => []];

        $assessments = count($assessment) ? $assessment : Common::get_assessments($form_ids);
        $items = $assessments['data'];

        usort($items['assessments'], function ($first, $second) {
            return ($first['imet_index']) < ($second['imet_index']);
        });

        $i = 0;
        foreach ($items['assessments'] as $key => $assessment) {
            $name = $assessment['name'];
            $total_values[$name] = 0;
            $form_ids[$name] = $assessment['wdpa_id'];

            foreach ($indicators as $ind => $indicator) {
                $value = Common::round_number($assessment[$ind]);
                $raw_values[$i][] = $value;
                $total_values[$name] += $value;
                $indicators[$ind] = $value;
            }

            $i++;
            $percent['xAxis'][] = $name;
            $collect_values_for_sorting = [];
            foreach ($indicators as $ind => $indicator) {
                $label = trans('imet-core::v2_common.steps_eval.' . $ind);
                $percent['legends'][$ind] = $label;
                $percent_value = Common::round_number(($indicator / $total_values[$name]) * 100);
                $percent['percent_values'][$label][] = $percent_value;
                $percent['values'][$label][] = $collect_values_for_sorting[] = Common::round_number(($percent_value / 100) * $assessment['imet_index']);
                $percent['actual_value'][$label][] = Common::round_number($indicator);
            }
        }

        $new_ranking = [
            'values' => $percent['values'],
            'percent_values' => $percent['percent_values'],
            'legends' => $percent['legends'],
            'xAxis' => $percent['xAxis'],
            'actual_value' => $percent['actual_value'],
            'raw_values' => $raw_values
        ];

        return ['status' => 'success', 'data' => ['values' => $new_ranking, 'form_ids' => $form_ids]];
    }

}
