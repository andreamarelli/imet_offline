<?php

namespace AndreaMarelli\ImetCore\Models\Imet\API\ScalingUp;

use AndreaMarelli\ImetCore\Helpers\ScalingUp\Common;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\ScalingUpAnalysis;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections\Radar;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections\Ranking;

trait Overall
{

    /**
     * @param $items
     * @return array
     */
    public static function overall_ranking($items): array
    {
        $api = [];
        $assessments = [];
        $synthetic_indicators_table = Common::get_assessments($items);
        $assessments['data'] = $synthetic_indicators_table['data'];
        $ranking = Ranking::get_overall_ranking($items, $assessments);

        foreach ($ranking['data']['values']['xAxis'] as $key => $xAxi) {
            $api[] = ['wdpa_id' => $ranking['data']['form_ids'][$xAxi], 'name' => $xAxi, 'values' => []];
        }

        foreach ($ranking['data']['values']['values'] as $key => $value) {
            foreach ($value as $k => $v) {
                $indicator = array_keys($ranking['data']['values']['legend'][0], $key)[0];
                $api[$k]['values'][$indicator] = $v;
            }
        }

        return ['data' => $api, 'labels' => $ranking['data']['values']['legend']];
    }

    /**
     * @param $items
     * @return array|array[]|\array[][]
     */
    public static function overall_average_of_six_elements($items): array
    {
        $api = [];
        $assessments = Common::get_assessments($items);
        $averages_six_elements = ScalingUpAnalysis::get_averages_of_each_indicator_of_six_elements($items, $assessments, true);
        foreach ($averages_six_elements['data']['Average'] as $key => $average) {
            $api[] = [
                'indicator' => $average['indicator'],
                'values' => [
                    'value' => $average['value'],
                    'percentile_10' => $average['upper limit'][0],
                    'percentile_90' => $average['upper limit'][1]
                ]
            ];
        }

        return ['data' => $api];
    }

    /**
     * @param $items
     * @return array|array[]|\array[][]
     */
    public static function scatter_visualization_synthetic_indicators($items): array
    {
        $api = [];
        $labels = [
            'process' => trans('imet-core::v2_common.steps_eval.process'),
            'context_planning_inputs' => trans('imet-core::v2_common.steps_eval.context') . ", " . trans('imet-core::v2_common.steps_eval.planning') . ", " . trans('imet-core::v2_common.steps_eval.inputs'),
            'outcomes_outputs' => trans('imet-core::v2_common.steps_eval.outcomes') . ", " . trans('imet-core::v2_common.steps_eval.outputs')
        ];

        $assessments = Common::get_assessments($items);
        foreach ($assessments['data']['assessments'] as $key => $value) {
            $api[] = [
                'name' => $value['name'],
                'wdpa_id' => $value['wdpa_id'],
                "year" => $value['year'],
                'value' => [
                    'process' => Common::round_number($value['process']),
                    'context_planning_inputs' => Common::round_number(($value['context'] + $value['planning'] + $value['inputs']) / 3),
                    'outcomes_outputs' => Common::round_number(($value['outcomes'] + $value['outputs']) / 2)
                ]
            ];
        }

        return ['data' => $api, 'labels' => $labels];
    }

    /**
     * @param $items
     * @return array|array[]|\array[][]
     */
    public static function visualization_synthetics_indicators($items): array
    {
        $api = [];
        $labels = [
            'context' => trans('imet-core::v2_common.steps_eval.context'),
            'outcomes' => trans('imet-core::v2_common.steps_eval.outcomes'),
            'outputs' => trans('imet-core::v2_common.steps_eval.outputs'),
            'process' => trans('imet-core::v2_common.steps_eval.process'),
            'inputs' => trans('imet-core::v2_common.steps_eval.inputs'),
            'planning' => trans('imet-core::v2_common.steps_eval.planning'),
            'imet_index' => trans('imet-core::v2_common.indexes.imet')
        ];

        $assessments = Common::get_assessments($items);
        $radars = Radar::get_radar_indicators($items, false, $assessments, true);

        foreach ($radars['data']['diagrams'] as $key => $value) {
            $wdpa_id = $value['wdpa_id'] ?? "-";
            unset($value['color']);
            unset($value['lineStyle']);
            unset($value['width']);
            unset($value['wdpa_id']);
            $api[] = [
                'name' => $key,
                'wdpa_id' => $wdpa_id,
                'value' => $value
            ];
        }

        return ['data' => $api, 'labels' => $labels];
    }
}
