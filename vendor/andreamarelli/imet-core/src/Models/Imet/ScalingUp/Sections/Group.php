<?php

namespace AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections;

use AndreaMarelli\ImetCore\Helpers\ScalingUp\Common;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;

class Group
{
    /**
     * @param array $parameters
     * @param array $assessments
     * @return array
     */
    public static function get_calculation_grouping_analysis(array $parameters, array $assessments = [], int $scaling_id = 0): array
    {
        $groups = [];
        $average = [];
        $form_ids = [];
        $indicator = [
            'context' => [],
            'outcomes' => [],
            'outputs' => [],
            'process' => [],
            'inputs' => [],
            'planning' => [],
        ];

        foreach ($parameters as $form) {
            $form_ids[] = $form['id'];
            $groups[$form['group']] = [$form['group'], $form['name'], $form['color'] ?? null];
        }
        $indicator = static::calculate_indicators_by_group($indicator, $parameters, $form_ids, $assessments, $scaling_id);

        krsort($groups);

        foreach ($indicator as $indi => $value) {
            foreach ($groups as $key => $group) {
                $average[$group[1]][$indi] = Common::round_number(array_sum($value[$key]) / count($value[$key]));
                if (isset($group[2])) {
                    $average[$group[1]]['color'] = $group[2];
                }
            }
        }

        return $average;
    }

    /**
     * @param array $indicator
     * @param array $parameters
     * @param array $form_ids
     * @param array $assessments
     * @param int $scaling_id
     * @return array
     */
    public static function calculate_indicators_by_group(array $indicator, array $parameters, array $form_ids, array $assessments = [], int $scaling_id = 0): array
    {
        $assessments = count($assessments) ? $assessments : Common::get_assessments($form_ids, $scaling_id);

        foreach ($indicator as $indi => $value) {
            foreach ($assessments['data']['assessments'] as $assessment) {
                foreach ($parameters as $form) {

                    if ($form['id'] === $assessment['form_id']) {

                        $indicator[$indi][$form['group']][] = $assessment[$indi];
                    }
                }
            }
        }
        return $indicator;
    }
}
