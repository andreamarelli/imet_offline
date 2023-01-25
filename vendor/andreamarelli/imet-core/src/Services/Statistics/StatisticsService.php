<?php

namespace AndreaMarelli\ImetCore\Services\Statistics;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Services\Statistics\traits\Math;
use AndreaMarelli\ModularForms\Helpers\Locale;

abstract class StatisticsService
{
    use Math;

    const GLOBAL = 'global';

    const CONTEXT = 'context';
    const PLANNING = 'planning';
    const INPUTS = 'inputs';
    const PROCESS = 'process';
    const OUTPUTS = 'outputs';
    const OUTCOMES = 'outcomes';

    /**
     * Ensure to return IMET model
     *
     * @param $imet
     * @return Imet
     */
    protected static function get_imet($imet): Imet
    {
        if(is_int($imet) or is_string($imet)){
            $imet = Imet::find($imet);
        }
        return $imet;
    }

    /**
     * Retrieve assessment's scores
     *
     * @param Imet|int $imet
     * @param string $step
     * @return array
     */
    public static function get_scores($imet, string $step = self::GLOBAL): array
    {
        $imet = static::get_imet($imet);

        switch ($step) {
            case static::GLOBAL:
                $scores = [
                    static::CONTEXT => static::scores_context($imet)['avg_indicator'],
                    static::PLANNING => static::scores_planning($imet)['avg_indicator'],
                    static::INPUTS => static::scores_inputs($imet)['avg_indicator'],
                    static::PROCESS => static::scores_process($imet)['avg_indicator'],
                    static::OUTPUTS => static::scores_outputs($imet)['avg_indicator'],
                    static::OUTCOMES => static::scores_outcomes($imet)['avg_indicator'],
                ];
                $scores['imet_index'] = static::average($scores);
                return $scores;
            case self::CONTEXT:
                return static::scores_context($imet);
            case self::PLANNING:
                return static::scores_planning($imet);
            case self::INPUTS:
                return static::scores_inputs($imet);
            case self::PROCESS:
                return static::scores_process($imet);
            case self::OUTPUTS:
                return static::scores_outputs($imet);
            case self::OUTCOMES:
                return static::scores_outcomes($imet);
            case "ALL":
                return [
                    static::GLOBAL => static::get_scores($imet),
                    static::CONTEXT => static::get_scores($imet, StatisticsService::CONTEXT),
                    static::PLANNING => static::get_scores($imet, StatisticsService::PLANNING),
                    static::INPUTS => static::get_scores($imet, StatisticsService::INPUTS),
                    static::PROCESS => static::get_scores($imet, StatisticsService::PROCESS),
                    static::OUTPUTS => static::get_scores($imet, StatisticsService::OUTPUTS),
                    static::OUTCOMES => static::get_scores($imet, StatisticsService::OUTCOMES),
                ];
            default:
                return [];
        }
    }

    /**
     * Retrieve assessment's scores (for radar)
     *
     * @param Imet|int $imet
     * @return array
     */
    public static function get_radar_scores($imet): array
    {
        $imet = static::get_imet($imet);

        $labels = static::steps_labels();
        $scores = static::get_scores($imet);
        unset($scores['imet_index']);

        return array_combine(
            $labels[$imet->version]['abbreviations'],
            $scores
        );
    }

    /**
     * Retrieve the global IMET score
     * @param $imet
     * @return float
     */
    public static function get_imet_score($imet): ?float
    {
        return static::get_scores($imet)['imet_index'];
    }

    /**
     *
     *
     * @param Imet|int $imet
     * @param string $step
     * @return array
     */
    public static function get_assessment($imet, string $step = self::GLOBAL): array
    {
        $imet = static::get_imet($imet);
        return array_merge(
            [
                'formid' => $imet->getKey(),
                'wdpa_id' => $imet->wdpa_id,
                'iso3' => $imet->Country,
                'name' => $imet->name,
                'version' => $imet->version,
                'labels' => static::indicators_labels($imet->version)
                ],
            static::get_scores($imet, $step)
        );
    }

    /**
     * Return steps' labels
     *
     * @return array[]
     */
    public static function steps_labels(): array
    {
        return [
            Imet::IMET_V1 => [
                'abbreviations' => ['C', 'P', 'I', 'PR', 'R', 'EI'],
                'full' => [
                    trans('imet-core::v1_common.steps_eval.context'),
                    trans('imet-core::v1_common.steps_eval.planning'),
                    trans('imet-core::v1_common.steps_eval.inputs'),
                    trans('imet-core::v1_common.steps_eval.process'),
                    trans('imet-core::v1_common.steps_eval.outputs'),
                    trans('imet-core::v1_common.steps_eval.outcomes'),
                ]
            ],
            Imet::IMET_V2 => [
                'abbreviations' => ['C', 'P', 'I', 'PR', 'OP', 'OC'],
                'full' => [
                    trans('imet-core::v2_common.steps_eval.context'),
                    trans('imet-core::v2_common.steps_eval.planning'),
                    trans('imet-core::v2_common.steps_eval.inputs'),
                    trans('imet-core::v2_common.steps_eval.process'),
                    trans('imet-core::v2_common.steps_eval.outputs'),
                    trans('imet-core::v2_common.steps_eval.outcomes'),
                ]
            ],
        ];
    }


    /**
     * Return indicators's labels
     *
     * @param $version
     * @return array
     */
    public static function indicators_labels($version): array
    {
        $labels = [];
        foreach (trans('imet-core::'.$version.'_common.assessment') as $code => $item){
            $labels[$code] = [
                'code_label' => $item[0],
                'title_' . Locale::lower() => $item[1],
            ];
        }
        return $labels;
    }

}