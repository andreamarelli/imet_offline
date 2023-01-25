<?php

namespace AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections;

use AndreaMarelli\ImetCore\Helpers\ScalingUp\Common;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class Radar
{

    public static function get_radar_analysis_indicators_data(array $form_ids, array $table_indicators, string $type = "", int $scaling_id = 0): array
    {
        $valuesIndicators = [];

        $radar_protected_areas = ['values' => [], 'ids' => []];
        $indicators = [];
        $upperLimit = [];
        $lowerLimit = [];
        $radar_negative_indicators = ["c2", "oc2", "oc3"];
        $radar_zero_negative_indicators = ["c3"];
        $radar_indicators_for_negative = [];
        $radar_indicators_zero_negative = [];
        $radar_average = [];
        $indicators_count_to_calculate_average = [];
        $wdpas = [];

        $filtered = Common::filtered_indicators_and_round_values($form_ids, $type, $table_indicators);
        $idx = 0;
        foreach ($filtered as $id => $values) {
            $pa = Common::get_pa_name($id, $scaling_id);
            $protected_area = $pa->name;
            $color = $pa->color ?? null;
            $tables[$type][$idx] = [];
            $tables[$type][$idx]['name'] = $protected_area;
            $wdpas[] = ['id' => $pa->wdpa_id, 'name' => $protected_area];

            unset($values['indicators_number']);
            $i = 0;
            foreach ($values as $v => $value) {
                if ($v !== "avg") {
                    if ($type === "process" && stripos($v, "_") === true) {
                        $name = Common::indicator_label($v, 'imet-core::analysis_report.assessment.', 'imet-core::analysis_report.legends.');
                    } else {
                        $name = Common::indicator_label($v, 'imet-core::analysis_report.assessment.');
                    }

                    $indicators[$i] = $name;

                    if (in_array($v, $radar_negative_indicators) && !in_array($i, $radar_indicators_for_negative)) {
                        $radar_indicators_for_negative[] = $i;
                    } else if (in_array($v, $radar_zero_negative_indicators) && !in_array($i, $radar_indicators_zero_negative)) {
                        $radar_indicators_zero_negative[] = $i;
                    }

                    $rounded_value = Common::round_number($value);
                    $tables[$type][$idx][$v] = $valuesIndicators[$v][] = $rounded_value;

                    if ((string)$value === "-") {
                        $value = 0;
                    } else {
                        $indicators_count_to_calculate_average[$v] = array_key_exists($v, $indicators_count_to_calculate_average) ? $indicators_count_to_calculate_average[$v] + 1 : 1;
                    }
                    $radar_average[$v] = array_key_exists($v, $radar_average) ? $radar_average[$v] + $value : $value;

                    $radar_protected_areas['values'][$protected_area][] = $rounded_value;
                    if ($color) {
                        $radar_protected_areas['values'][$protected_area]['color'] = $color;
                    }
                    $i++;
                }
            }
            $idx++;
        }

        foreach ($valuesIndicators as $k => $v) {
            $upperLimit[$k] = max($v);
            $lowerLimit[$k] = min($v);
        }


        $analysis_diagrams_protected_areas['indicators'] = $indicators;

        foreach ($radar_average as $k => $item) {
            $radar_protected_areas['values']['Average'][] = Common::round_number($item / $indicators_count_to_calculate_average[$k]);
        }

        return [
            'radar_indicators_for_negative' => $radar_indicators_for_negative,
            'radar_indicators_zero_negative' => $radar_indicators_zero_negative,
            'wdpas' => $wdpas,
            'values' => array_merge($radar_protected_areas['values'], [
                    'upper limit' => $upperLimit,
                    'lower limit' => $lowerLimit
                ]
            ),
            'indicators' => $analysis_diagrams_protected_areas['indicators']
        ];
    }

    /**
     * @param array $form_ids
     * @param array $table_indicators
     * @param string $type
     * @param string $colors
     * @param array $options
     * @param string $label
     * @param int $scaling_id
     * @return array
     */
    public static function get_radar_analysis_indicators(array $form_ids, array $table_indicators, string $type = "", string $colors = "", array $options = [], string $label = "", int $scaling_id = 0)
    {
        $response = static::get_radar_analysis_indicators_data($form_ids, $table_indicators, $type, $scaling_id);

        $response['values']['upper limit']['lineStyle'] = 'dashed';
        $response['values']['upper limit']['color'] = 'green';

        $response['values']['lower limit']['lineStyle'] = 'dashed';
        $response['values']['lower limit']['color'] = 'yellow';

        $response['values']['Average']['color'] = 'red';
        $response['values']['Average']['legend_selected'] = true;

        return [
            'radar_indicators_for_negative' => $response['radar_indicators_for_negative'],
            'radar_indicators_zero_negative' => $response['radar_indicators_zero_negative'],
            'wdpas' => $response['wdpas'],
            'values' => $response['values'],
            'indicators' => $response['indicators']
        ];
    }

    /**
     * @param array $form_ids
     * @param bool $width
     * @param array $assessments
     * @param bool $overall
     * @param int $scaling_id
     * @return array
     */
    public static function get_radar_indicators(array $form_ids, bool $width = true, array $assessments = [], bool $overall = true, int $scaling_id = 0): array
    {
        $start_time = microtime(true);
        $assessments = count($assessments) ? $assessments : Common::get_assessments($form_ids, $scaling_id);

        $indicator = [
            'context' => [],
            'outcomes' => [],
            'outputs' => [],
            'process' => [],
            'inputs' => [],
            'planning' => [],
            'imet_index' => []
        ];

        $analysis_diagrams_protected_areas = [];
        $average = ['color' => 'red', 'legend_selected' => true, 'width' => 4];

        $form_ids = array_reverse($form_ids, true);
        $totalProtectedAreas = count($form_ids);
        $form_ids_ordering = [];
        foreach ($indicator as $indi => $value) {
            foreach ($form_ids as $key => $form_id) {
                $assess = $assessments['data']['assessments'][$key];
                $assess['width'] = '';
                $name = $assess['name'];

                $val = $assess[$indi];
                $indicator[$indi][] = $val;

                if ($overall) {
                    $analysis_diagrams_protected_areas[$name][$indi] = $val;
                } else {
                    $analysis_diagrams_protected_areas[$name][] = $val;
                }

                $analysis_diagrams_protected_areas[$name]['wdpa_id'] = $assess['wdpa_id'];
                $analysis_diagrams_protected_areas[$name]['color'] = $assess['color'];
                $form_ids_ordering[$name] = $form_id;
                if ($width) {
                    $analysis_diagrams_protected_areas[$name]['width'] = 4;
                }
            }
            // dd($totalProtectedAreas);
            if ($totalProtectedAreas > 0) {
                if ($overall) {
                    $average[$indi] = Common::round_number(array_sum($indicator[$indi]) / $totalProtectedAreas);
                } else {
                    $average[] = Common::round_number(array_sum($indicator[$indi]) / $totalProtectedAreas);
                }
            }
        }

//        if(count($analysis_diagrams_protected_areas) === 0){
//            return [];
//        }

        //get min and max level for each category
        foreach ($indicator as $k => $v) {
            if (count($v) > 0) {
                $upperLimit[$k] = max($v) ?? 0;
                $lowerLimit[$k] = min($v) ?? 0;
            }
        }

        $upperLimit['lineStyle'] = 'dashed';
        $upperLimit['width'] = 4;
        $upperLimit['color'] = 'green';

        $lowerLimit['lineStyle'] = 'dashed';
        $lowerLimit['width'] = 4;
        $lowerLimit['color'] = 'black';

        krsort($analysis_diagrams_protected_areas);

        $end_time = microtime(true);
        $execution_time = $end_time - $start_time;

        return [
            'status' => 'success',
            'execution_time' => $execution_time,
            'data' => [
                'form_ids' => $form_ids_ordering,
                'diagrams' => array_merge($analysis_diagrams_protected_areas,
                    ['Average' => $average, 'upper limit' => $upperLimit, 'lower limit' => $lowerLimit])
            ]
        ];
    }

    /**
     * @param array $form_ids
     * @param int $scaling_id
     * @return array
     */
    public static function get_threats_radar_indicators(array $form_ids, int $scaling_id = 0): array
    {
        $radar = ['values' => [], 'indicators' => []];
        $indicators = [];
        $total_categories = [];

        foreach ($form_ids as $j => $form_id) {
            $pa = Common::get_pa_name($form_id, $scaling_id);
            $protected_areas_names[$form_id] = $pa->name;

            $protected_areas[$j] = Modules\Context\MenacesPressions::getStats($form_id);
            if (count($indicators) === 0) {
                foreach ($protected_areas[$j]['category_stats'] as $c => $value) {
                    $name = trans('imet-core::v2_context.MenacesPressions.categories.title' . ($c + 1), []);
                    array_unshift($indicators, $name);

                }
            }
            foreach ($protected_areas[$j]['category_stats'] as $k => $protected_area) {
                if ($protected_area === "") {
                    $value = "-";
                } else {
                    $value = Common::round_number((-1 * (double)$protected_area));
                }
                $record = ["id" => $pa->wdpa_id, "name" => $protected_areas_names[$form_id], "value" => $value, 'color' => $pa->color];
                if ($pa->color) {
                    $record['color'] = $pa->color;
                }
                $total_categories[$k][] = $record;
            }
        }

        foreach ($total_categories as $k => $cat) {
            usort($cat, function ($a, $b) {
                return $a['value'] < $b['value'];
            });
            $total_categories[$k] = $cat;
            foreach ($cat as $c => $v) {
                $name = $v['name'];
                if (isset($radar['values'][$name])) {
                    array_unshift($radar['values'][$v['name']], $v['value']);
                } else {
                    $radar['values'][$name][] = $v['value'];
                    if ($v['color'] !== null) {
                        $radar['values'][$name]['color'] = $v['color'];
                    }
                }
            }
        }

        $radar['indicators'] = $indicators;
        return ['radar' => $radar, 'total_categories' => $total_categories];
    }
}
