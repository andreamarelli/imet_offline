<?php

namespace AndreaMarelli\ImetCore\Models\Imet\API\ScalingUp\Analysis;

use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Sections\AverageContribution;

trait Average
{
    /**
     * @param array $items
     * @param array $indicators
     * @param string $type
     * @return array
     */
    private static function retrieve_average(array $items, array $indicators, string $type = 'context'): array
    {
        $api = [];
        $average = AverageContribution::average_contribution_calculations($items, $indicators, $type, "", [], 'imet-core::analysis_report.assessment.');

        foreach ($average['average_contribution']['data']['Average'] as $key => $average) {
            $indicator = implode(' ', $average['label']);
            $api[] = [
                'indicator' => $indicator,
                'values' => [
                    'value' => $average['value'],
                    'percentile_10' => $average['upper limit'][0],
                    'percentile_90' => $average['upper limit'][1]
                ]
            ];
        }

        return [$api];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function threat_average(array $items): array
    {
        $api = [];
        $average = AverageContribution::average_contribution_calculations_threat($items, '#C23531', ['height' => '850px'], 'imet-core::v2_context.MenacesPressions.categories.title', "");

        if (array_key_exists('data', $average['average_contribution'])) {
            foreach ($average['average_contribution']['data']['Average'] as $key => $average) {
                $api[] = [
                    'indicator' => $average['indicator'],
                    'values' => [
                        'value' => $average['value'],
                        'percentile_10' => $average['upper limit'][0],
                        'percentile_90' => $average['upper limit'][1]
                    ]
                ];
            }
        }

        return ['data' => $api] ;
    }

    /**
     * @param array $items
     * @return array
     */
    public static function management_context_average(array $items): array
    {
        $indicators = [
            'c1' => [],
            'c2' => [],
            'c3' => []
        ];

        list($api) = static::retrieve_average($items, $indicators);

        return ['data' => $api];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function value_and_importance_sub_indicators_average(array $items): array
    {
        $indicators = [
            'c11' => [],
            'c12' => [],
            'c13' => [],
            'c14' => [],
            'c15' => []
        ];

        list($api) = static::retrieve_average($items, $indicators);

        return ['data' => $api];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function planning_indicators_average(array $items): array
    {
        $indicators = [
            'p1' => [],
            'p2' => [],
            'p3' => [],
            'p4' => [],
            'p5' => [],
            'p6' => []
        ];

        list($api) = static::retrieve_average($items, $indicators, 'planning');

        return ['data' => $api];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function inputs_indicators_average(array $items): array
    {
        $indicators = [
            'i1' => [],
            'i2' => [],
            'i3' => [],
            'i4' => [],
            'i5' => []
        ];

        list($api) = static::retrieve_average($items, $indicators, 'inputs');

        return ['data' => $api];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function outputs_indicators_average(array $items): array
    {
        $indicators = [
            'op1' => [],
            'op2' => [],
            'op3' => []
        ];

        list($api) = static::retrieve_average($items, $indicators, 'outputs');

        return ['data' => $api];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function outcomes_indicators_average(array $items): array
    {
        $indicators = [
            'oc1' => [],
            'oc2' => [],
            'oc3' => []
        ];

        list($api) = static::retrieve_average($items, $indicators, 'outcomes');

        return ['data' => $api];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_indicators_average(array $items): array
    {
        $indicators = [
            'pr15_16' => [],
            'pr10_12' => [],
            'pr13_14' => [],
            'pr17_18' => [],
            'pr1_6' => [],
            'pr7_9' => [],
        ];

        list($api) = static::retrieve_average($items, $indicators, 'process');

        return ['data' => $api];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_internal_management_indicators_average(array $items): array
    {
        $indicators = [
            'pr1' => [],
            'pr2' => [],
            'pr3' => [],
            'pr4' => [],
            'pr5' => [],
            'pr6' => [],
        ];

        list($api) = static::retrieve_average($items, $indicators, 'process');

        return ['data' => $api];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_management_protection_indicators_average(array $items): array
    {
        $indicators = [
            'pr7' => [],
            'pr8' => [],
            'pr9' => []
        ];

        list($api) = static::retrieve_average($items, $indicators, 'process');

        return ['data' => $api];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_stakeholders_relationships_indicators_average(array $items): array
    {
        $indicators = [
            'pr10' => [],
            'pr11' => [],
            'pr12' => []
        ];

        list($api) = static::retrieve_average($items, $indicators, 'process');

        return ['data' => $api];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_tourism_management_indicators_average(array $items): array
    {
        $indicators = [
            'pr13' => [],
            'pr14' => []
        ];

        list($api) = static::retrieve_average($items, $indicators, 'process');

        return ['data' => $api];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_monitoring_and_research_indicators_average(array $items): array
    {
        $indicators = [
            'pr15' => [],
            'pr16' => []
        ];

        list($api) = static::retrieve_average($items, $indicators, 'process');

        return ['data' => $api];
    }

    /**
     * @param array $items
     * @return array
     */
    public static function process_effects_of_climate_change_indicators_average(array $items): array
    {
        $indicators = [
            'pr17' => [],
            'pr18' => []
        ];

        list($api) = static::retrieve_average($items, $indicators, 'process');

        return ['data' => $api];
    }
}
