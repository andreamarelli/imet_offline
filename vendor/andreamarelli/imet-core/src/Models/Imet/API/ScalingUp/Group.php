<?php

namespace AndreaMarelli\ImetCore\Models\Imet\API\ScalingUp;


use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections\Group as SectionGroup;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections\Scatter;

trait Group
{
    /**
     * @param array $parameters
     * @return array
     */
    public function get_grouping_analysis(array $parameters): array
    {
        $labels = [];
        $api = SectionGroup::get_calculation_grouping_analysis($parameters, []);
        foreach ($api as $k => $indicators) {
            foreach ($indicators as $indi => $value) {
                $labels[$indi] = trans('imet-core::v2_common.steps_eval.' . $indi);
            }
        }

        return ['data' => $api, 'labels' => $labels];
    }

    /**
     * @param array $parameters
     * @return array
     */
    public static function get_grouping_analysis_by_indicators(array $parameters):array
    {
        $labels = [
            'process' => trans('imet-core::v2_common.steps_eval.process'),
            'context_planning_inputs' => trans('imet-core::v2_common.steps_eval.context') . ", " . trans('imet-core::v2_common.steps_eval.planning') . ", " . trans('imet-core::v2_common.steps_eval.inputs'),
            'outcomes_outputs' => trans('imet-core::v2_common.steps_eval.outcomes') . ", " . trans('imet-core::v2_common.steps_eval.outputs')
        ];

        $api = [];

        $data = Scatter::get_scatter_grouping_analysis($parameters, []);
        foreach ($data['data']['scatter'] as $k => $item) {
            $api[] = ['name' => $item['name'], 'value' => ['process' => $item['value'][0],
                'context_planning_inputs' => $item['value'][1],
                'outcomes_outputs' => $item ['value'][2]]];
        }

        return ['data' => $api, 'labels' => $labels];
    }
}
