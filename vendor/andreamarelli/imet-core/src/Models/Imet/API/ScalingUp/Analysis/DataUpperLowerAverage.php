<?php

namespace AndreaMarelli\ImetCore\Models\Imet\API\ScalingUp\Analysis;

use AndreaMarelli\ImetCore\Helpers\ScalingUp\Common;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections\Radar as ScalingUpRadar;

trait DataUpperLowerAverage
{
    /**
     * @param array $items
     * @param array $indicators
     * @param string $type
     * @return array
     */
    private static function retrieve_data_upper_low_average(array $items, array $indicators, string $type = 'context'): array
    {
        $keys = array_keys($indicators);
        $api = [];
        $radar = ScalingUpRadar::get_radar_analysis_indicators_data($items, $indicators, $type);

        foreach ($radar['wdpas'] as $key => $wdpa) {
            $name = $wdpa['name'];
            $values = $radar['values'][$name];
            $indicator_values = [];
            foreach ($values as $k => $v) {
                $indicator_values[$keys[$k]] = $v;
            }

            $indicator = $wdpa['name'];
            $api[] = [
                'wdpa_id' => $wdpa['id'],
                'name' => $indicator,
                'values' => $indicator_values
            ];
        }

        $average_values = [];

        foreach ($radar['values']['Average'] as $k => $v) {
            $average_values[$keys[$k]] = $v;
        }

        $api[] = [
            'wdpa_id' => 0,
            'name' => 'Lower Limit',
            'values' => $radar['values']['lower limit']
        ];
        $api[] = [
            'wdpa_id' => 0,
            'name' => 'Upper Limit',
            'values' => $radar['values']['upper limit']
        ];

        $api[] = [
            'wdpa_id' => 0,
            'name' => 'Average',
            'values' => $average_values
        ];
        //}

        return [$api];
    }


    /**
     * @param array $items
     * @return array
     */
    public static function management_context_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('management_context');
        list($api) = static::retrieve_data_upper_low_average($items, $indicators);

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function value_and_importance_sub_indicators_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('value_and_importance_sub_indicators');
        list($api) = static::retrieve_data_upper_low_average($items, $indicators);

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function planning_indicators_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('planning');
        list($api) = static::retrieve_data_upper_low_average($items, $indicators, 'planning');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function inputs_indicators_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('inputs');
        list($api) = static::retrieve_data_upper_low_average($items, $indicators, 'inputs');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function outputs_indicators_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('outputs');
        list($api) = static::retrieve_data_upper_low_average($items, $indicators, 'outputs');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function outcomes_indicators_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('outcomes');
        list($api) = static::retrieve_data_upper_low_average($items, $indicators, 'outcomes');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_indicators_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process');
        list($api) = static::retrieve_data_upper_low_average($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_internal_management_indicators_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process_internal_management_indicators');
        list($api) = static::retrieve_data_upper_low_average($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_management_protection_indicators_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process_management_protection_indicators');
        list($api) = static::retrieve_data_upper_low_average($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_stakeholders_relationships_indicators_radar(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process_stakeholders_relationships_indicators');
        list($api) = static::retrieve_data_upper_low_average($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }
}
