<?php

namespace AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections;

use AndreaMarelli\ImetCore\Controllers\Imet\EvalControllerV2;
use AndreaMarelli\ImetCore\Helpers\ScalingUp\Common;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\ScalingUpWdpa;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class Ranking
{

    /**
     * @param array $form_ids
     * @param string $type
     * @param array $indicators
     * @return array[]|\array[][]
     */
    public static function ranking_indicators(array $form_ids, string $type, array $indicators, int $scaling_id): array
    {
        $ranking_values = [];
        $ranking = ['values' => [], 'legends' => [], 'xAxis' => []];

        // only for process sub-indicators average
        if (isset($indicators['pr15_16'])) {
            $result = static::process_subindicators_for_ranking_protected_areas($form_ids, $type);
            $filtered = $result[0];
            $indicators_numbers = $result[1];
        } else {
            $filtered = Common::filtered_indicators_and_round_values($form_ids, $type, $indicators);
        }

        $sort_keys = [];
        //loop the each imet record sorted and get pa name
        //and merge it with the table
        foreach ($filtered as $id => $values) {
            $pa = ScalingUpWdpa::getCustomNames($id, $scaling_id);
            $protected_area = $pa->name;
            unset($values['avg']);
            unset($values['indicators_number']);
            $corrected_values = [];

            $indicators_divide_length = 0;
            foreach ($values as $v => $value) {
                if (isset($value)) {
                    $indicators_divide_length++;
                }
            }

            foreach ($values as $v => $value) {

                if ($type === "process") {
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
                   // echo $correction_value;
                }

                $ranking['legends'][$v] = $name;
                $ranking_values[$name][] =  $correction_value;
                if((string)$correction_value !== "-"){
                    $corrected_values[] = $correction_value;
                }
               // echo "\n\n";
            }

            $sort_keys[] = array_sum($corrected_values);
            $ranking['xAxis'][] = $protected_area;
        }
        arsort($sort_keys);

        $new_ranking = ['values' => [], 'legends' => [], 'xAxis' => []];
        foreach ($ranking_values as $name => $ranking_value) {
            $new_ranking['xAxis'] = [];
            foreach ($sort_keys as $k => $val) {
                //if (isset($ranking_value[$k])) {
                    $new_ranking['values'][$name][] = $ranking_value[$k];
               // }
                $new_ranking['xAxis'][] = $ranking['xAxis'][$k];
            }
        }
//dd($new_ranking);
        $new_ranking['legends'] = $ranking['legends'];
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
     * @return array[]|\array[][]
     */
    public static function ranking_threats_indicators(array $form_ids, int $scaling_id = null): array
    {
        $ranking = ['values' => [], 'legends' => [], 'xAxis' => []];
        $sort_keys = [];
        $ranking_raw_values = [];
        $protected_areas_names = [];

        foreach ($form_ids as $j => $form_id) {
            $pa = ScalingUpWdpa::getCustomNames($form_id, $scaling_id);
            $protected_areas_names[$form_id] = $pa->name;
            $protected_areas[$j] = Modules\Context\MenacesPressions::getStats($form_id);

            $collect_values = [];
            foreach ($protected_areas[$j]['category_stats'] as $k => $protected_area) {
                if($protected_area === ""){
                    $value = "-";
                }else {
                    $value = Common::round_number((-1 * (double)$protected_area));
                }
                $ranking_raw_values[$form_id][] = $collect_values[] = $value;
            }
            $sort_keys[$form_id] = array_sum($collect_values);
        }

        //sorting array
        arsort($sort_keys);
        $new_ranking = [];

        foreach ($sort_keys as $k => $val) {
            $new_ranking[$k] = $ranking_raw_values[$k];
        }

        foreach ($new_ranking as $id => $values) {
            foreach ($values as $v => $value) {
                $name = trans('imet-core::v2_context.MenacesPressions.categories.title' . ($v + 1), []);//, $keep_locale);
                $ranking['values'][$name][] = $value;
                $ranking['legends'][$v] = $name;
            }
            $ranking['xAxis'][] = $protected_areas_names[$id];
        }

        return $ranking;
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

        $total_values = [];
        $sorted_values = [];
        $percent = ['values' => [], 'legends' => [], 'xAxis' => []];

        $assessments = count($assessment) ? $assessment : static::get_assessments($form_ids);

        foreach ($assessments['data']['assessments'] as $key => $assessment) {
            $name = $assessment['name'];
            $total_values[$name] = 0;

            foreach ($indicators as $ind => $indicator) {
                $value = Common::round_number($assessment[$ind]);
                $total_values[$name] += $value;
                $indicators[$ind] = $value;
            }

            $percent['xAxis'][] = $name;
            $collect_values_for_sorting = [];
            foreach ($indicators as $ind => $indicator) {
                $label = trans('imet-core::v2_common.steps_eval.' . $ind);
                $percent['legends'][$ind] = $label;

                $percent['values'][$label][] = $collect_values_for_sorting[] = $total_values[$name] ? Common::round_number((((($indicator / $total_values[$name]) * 100) / 100) * $assessment['imet_index'])) : 0;
            }
            $sorted_values[] = array_sum($collect_values_for_sorting);
        }

        //sort ranking descending
        arsort($sorted_values);
        $new_ranking = ['values' => [], 'legends' => [], 'xAxis' => []];
        foreach ($percent['values'] as $name => $value) {
            $new_ranking['xAxis'] = [];
            foreach ($sorted_values as $k => $val) {
                //dd($k);
                $new_ranking['values'][$name][] = $percent['values'][$name][$k];
                $new_ranking['xAxis'][] = $percent['xAxis'][$k];
            }
        }
        $new_ranking['legends'][] = $percent['legends'];

        return ['status' => 'success', 'data' => ['values' => $new_ranking]];
    }

}
