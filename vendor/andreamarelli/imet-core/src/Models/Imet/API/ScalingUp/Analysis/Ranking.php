<?php

namespace AndreaMarelli\ImetCore\Models\Imet\API\ScalingUp\Analysis;

use AndreaMarelli\ImetCore\Helpers\ScalingUp\Common;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections\Ranking as ScalingUpRanking;

trait Ranking
{
    /**
     * @param array $items
     * @param array $indicators
     * @param string $type
     * @return array
     */
    private static function retrieve_data_ranking(array $items, array $indicators, string $type = 'context'): array
    {
        $ranking = ScalingUpRanking::ranking_indicators($items, $type, $indicators);
        $api = static::parse_data($ranking);

        return [$api];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function threat_ranking(array $items): array
    {
        $labels = [];

        $ranking = ScalingUpRanking::ranking_threats_indicators($items);
        $api = static::parse_data($ranking);

        for ($i = 1; $i < 13; $i++) {
            $labels[] = trans('imet-core::v2_context.MenacesPressions.categories.title' . $i);
        }
        return ['data' => $api, 'labels' => $labels];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function management_context_ranking(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('management_context');
        list($api) = static::retrieve_data_ranking($items, $indicators);

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function value_and_importance_sub_indicators_ranking(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('value_and_importance_sub_indicators');
        list($api) = static::retrieve_data_ranking($items, $indicators);

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function planning_indicators_ranking(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('planning');
        list($api) = static::retrieve_data_ranking($items, $indicators, 'planning');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function inputs_indicators_ranking(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('inputs');
        list($api) = static::retrieve_data_ranking($items, $indicators, 'inputs');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function outputs_indicators_ranking(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('outputs');
        list($api) = static::retrieve_data_ranking($items, $indicators, 'outputs');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function outcomes_indicators_ranking(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('outcomes');
        list($api) = static::retrieve_data_ranking($items, $indicators, 'outcomes');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_indicators_ranking(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process');
        list($api) = static::retrieve_data_ranking($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_internal_management_indicators_ranking(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process_internal_management_indicators');
        list($api) = static::retrieve_data_ranking($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_management_protection_indicators_ranking(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process_management_protection_indicators');
        list($api) = static::retrieve_data_ranking($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_stakeholders_relationships_indicators_ranking(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process_stakeholders_relationships_indicators');
        list($api) = static::retrieve_data_ranking($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_tourism_management_indicators_ranking(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process_tourism_management_indicators');
        list($api) = static::retrieve_data_ranking($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_monitoring_and_research_indicators_ranking(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process_monitoring_and_research_indicators');
        list($api) = static::retrieve_data_ranking($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_effects_of_climate_change_indicators_ranking(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process_effects_of_climate_change_indicators');
        list($api) = static::retrieve_data_ranking($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param $data
     * @return array
     */
    private static function parse_data($data): array
    {
        $api = [];
        foreach ($data['xAxis'] as $key => $xAxi) {
            $api[] = ['name' => $xAxi, 'wdpa_id' => $data['wdpa_ids'][$key], 'values' => [], 'percent_values' => [], 'raw_values' => []];
        }

        $new_names = ['values', 'percent_values', 'raw_values'];

        foreach(['values', 'percent_value', 'actual_value'] as $n => $type) {
            foreach ($data[$type] as $key => $value) {
                foreach ($value as $k => $v) {
                    $indicator = array_keys($data['legends'], $key)[0];
                    $api[$k][$new_names[$n]][$indicator] = $v;
                }
            }
        }
        return $api;
    }
}
