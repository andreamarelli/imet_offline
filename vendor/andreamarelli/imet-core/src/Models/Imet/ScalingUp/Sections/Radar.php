<?php

namespace AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections;

use AndreaMarelli\ImetCore\Helpers\ScalingUp\Common;

class Radar
{
    public static function get_radar_indicators(array $form_ids, bool $width = true, array $assessments = [], bool $overall = true, $scaling_id): array
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

                $analysis_diagrams_protected_areas[$name]['color'] = $assess['color'];

                if ($width) {
                    $analysis_diagrams_protected_areas[$name]['width'] = 4;
                }
            }

            if ($overall) {
                $average[$indi] = Common::round_number(array_sum($indicator[$indi]) / $totalProtectedAreas);
            } else {
                $average[] = Common::round_number(array_sum($indicator[$indi]) / $totalProtectedAreas);
            }
        }

        //get min and max level for each category
        foreach ($indicator as $k => $v) {
            $upperLimit[$k] = max($v);
            $lowerLimit[$k] = min($v);
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
                'diagrams' => array_merge($analysis_diagrams_protected_areas,
                    ['Average' => $average, 'upper limit' => $upperLimit, 'lower limit' => $lowerLimit])
            ]
        ];
    }
}
