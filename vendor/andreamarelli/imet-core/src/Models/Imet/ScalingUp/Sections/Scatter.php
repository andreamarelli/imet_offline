<?php

namespace AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections;

use AndreaMarelli\ImetCore\Helpers\ScalingUp\Common;

class Scatter
{
    public static function get_scatter_grouping_analysis(array $parameters, array $assessments = [], bool $not_grouped = false, $scaling_id): array
    {
        $groups = [];
        $form_ids = [];
        $colors = ['#5470c6', '#91cc75', '#fac858', '#ee6666', '#73c0de', '#3ba272', '#fc8452', '#9a60b4', '#ea7ccc', '#f8f9fa'];
        $indicator = [
            'context' => [],
            'outcomes' => [],
            'planning' => [],
            'inputs' => [],
            'process' => [],
            'outputs' => [],

        ];

        foreach ($parameters as $form) {
            $form_ids[] = $form['id'];
            $groups[$form['group']] = [$form['group'], $form['name'], $form['color'] ?? null];
        }

        $assessments = count($assessments) ? $assessments : Common::get_assessments($form_ids, $scaling_id);

        foreach ($indicator as $indi => $value) {
            foreach ($assessments['data']['assessments'] as $assessment) {
                foreach ($parameters as $form) {
                    if ($form['id'] === $assessment['formid']) {
                        $indicator[$indi][$form['group']][] = $assessment[$indi];

                    }
                }
            }
        }
        krsort($groups);
        $average = [];

        foreach ($indicator as $indi => $value) {
            $i = 0;

            foreach ($groups as $key => $group) {
                $result = Common::round_number(array_sum($value[$key]) / count($value[$key]));
                $average[$group[1]][$indi] = $result;
                if ($not_grouped) {
                    $average[$group[1]]['color'] = $group[2];
                } else {
                    $group_color = $group[0] - 1;
                    $average[$group[1]]['color'] = $colors[$group_color] ?? $colors[9];
                }

                $average[$group[1]]['legend_selected'] = true;
                $i++;
            }
        }
        $final_average = [];
        $i = 0;
        foreach ($average as $key => $value) {
            $final_average[$i]['value'][] = Common::round_number($value['process']);
            $final_average[$i]['value'][] = Common::round_number(($value['context'] + $value['planning'] + $value['inputs']) / 3);
            $final_average[$i]['value'][] = Common::round_number(($value['outcomes'] + $value['outputs']) / 2);
            $final_average[$i]['name'] = $key;
            $final_average[$i]['itemStyle']['borderColor'] = $value['color'];
            $final_average[$i]['itemStyle']['color'] = 'transparent';
            $final_average[$i]['itemStyle']['borderWidth'] = '4';
            $final_average[$i]['label'] = ["position" => "inside",
                "color" => $value['color'],
                "backgroundColor" => "transparent",
                "show" => true
            ];
            $i++;
        }

        return ['status' => 'success', 'data' => ['scatter' => $final_average]];
    }
}
