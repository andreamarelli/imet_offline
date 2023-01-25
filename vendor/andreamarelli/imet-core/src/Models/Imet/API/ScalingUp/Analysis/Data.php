<?php

namespace AndreaMarelli\ImetCore\Models\Imet\API\ScalingUp\Analysis;

use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections\DataTable as ScalingUpDataTable;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections\Radar;
use AndreaMarelli\ImetCore\Helpers\ScalingUp\Common;

trait Data
{
    /**
     * @param array $items
     * @param array $indicators
     * @param string $type
     * @return array
     */
    private static function retrieve_data(array $items, array $indicators, string $type = 'context'): array
    {
        $api = [];
        $table = ScalingUpDataTable::get_datatable_analysis_indicators($items, $indicators, $type);

        foreach ($table['table'] as $key => $item) {
            $name = $item['name'];
            $id = $item['wdpa_id'];
            unset($item['name']);
            unset($item['wdpa_id']);
            $values = $item;
            $api[] = [
                'wdpa_id' => $id,
                'name' => $name,
                'values' => $values
            ];
        }

        return [$api];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function threats_table(array $items): array
    {
        $api = [];
        $data = Radar::get_threats_radar_indicators($items);

        foreach ($data['total_categories'][0] as $key => $value) {
            $api[] = [
                'wdpa_id' => $value['id'],
                'name' => $value['name'],
                'values' => $data['radar']['values'][$value['name']]
            ];
        }

        return ['data' => $api, 'labels' => $data['radar']['indicators']];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function management_context_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('management_context');
        list($api) = static::retrieve_data($items, $indicators);

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function value_and_importance_sub_indicators_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('value_and_importance_sub_indicators');
        list($api) = static::retrieve_data($items, $indicators);

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function planning_indicators_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('planning');
        list($api) = static::retrieve_data($items, $indicators, 'planning');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function inputs_indicators_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('inputs');
        list($api) = static::retrieve_data($items, $indicators, 'inputs');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function outputs_indicators_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('outputs');
        list($api) = static::retrieve_data($items, $indicators, 'outputs');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function outcomes_indicators_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('outcomes');
        list($api) = static::retrieve_data($items, $indicators, 'outcomes');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_indicators_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process');
        list($api) = static::retrieve_data($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_internal_management_indicators_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process_internal_management_indicators');
        list($api) = static::retrieve_data($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_management_protection_indicators_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process_management_protection_indicators');
        list($api) = static::retrieve_data($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_stakeholders_relationships_indicators_table(array $items): array
    {
        $indicators = Common::get_labels_by_indicator('process_stakeholders_relationships_indicators');
        list($api) = static::retrieve_data($items, $indicators, 'process');

        return ['data' => $api, 'labels' => $indicators];
    }
}
