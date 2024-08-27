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
            'C1' => [],
            'C2' => [],
            'C3' => []
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
            'C11' => [],
            'C12' => [],
            'C13' => [],
            'C14' => [],
            'C15' => []
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
            'P1' => [],
            'P2' => [],
            'P3' => [],
            'P4' => [],
            'P5' => [],
            'P6' => []
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
            'I1' => [],
            'I2' => [],
            'I3' => [],
            'I4' => [],
            'I5' => []
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
            'OP1' => [],
            'OP2' => [],
            'OP3' => []
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
            'OC1' => [],
            'OC2' => [],
            'OC3' => []
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
            'PRA' => [],
            'PRB' => [],
            'PRC' => [],
            'PRD' => [],
            'PRE' => [],
            'PRF' => [],
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
            'PR1' => [],
            'PR2' => [],
            'PR3' => [],
            'PR4' => [],
            'PR5' => [],
            'PR6' => [],
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
            'PR7' => [],
            'PR8' => [],
            'PR9' => []
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
            'PR10' => [],
            'PR11' => [],
            'PR12' => []
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
            'PR13' => [],
            'PR14' => []
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
            'PR15' => [],
            'PR16' => []
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
            'PR17' => [],
            'PR18' => []
        ];

        list($api) = static::retrieve_average($items, $indicators, 'process');

        return ['data' => $api];
    }
}
