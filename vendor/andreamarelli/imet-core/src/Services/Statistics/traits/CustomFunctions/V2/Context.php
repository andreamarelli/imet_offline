<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\V2;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\EcosystemServices;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\ImportanceEcosystemServices;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\ImportanceHabitats;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\ImportanceSpecies;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\SupportsAndConstraints;
use AndreaMarelli\ImetCore\Services\Statistics\V1StatisticsService;

trait Context
{
    protected static function score_c11($imet_id): ?float
    {
        return V1StatisticsService::score_c12($imet_id);
    }

    protected static function score_c12($imet_id): ?float
    {
        $records = ImportanceSpecies::getModule($imet_id);

        $values = $records
            ->filter(function ($record){
                return $record['EvaluationScore'] !== null
                    && intval($record['EvaluationScore']) >= 0
                    && $record['IncludeInStatistics']==1;
            })->map(function ($record){
                $record['SignificativeSpecies'] = $record['SignificativeSpecies']===null
                    ? 0
                    : $record['SignificativeSpecies'];
                return $record;
            });

        $numerator = $values->sum(function ($item){
            return (1 + 2 * $item['SignificativeSpecies']) * $item['EvaluationScore'];
        });
        $denominator = $values->sum(function ($item){
            return (1 + 2 * $item['SignificativeSpecies']);
        });

        $score = $denominator>0
            ? $numerator/$denominator * 100 / 3
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

    protected static function score_c13($imet_id): ?float
    {
        $records = ImportanceHabitats::getModule($imet_id);

        $values = $records
            ->filter(function ($record){
                return $record['EvaluationScore'] !== null
                    && intval($record['EvaluationScore']) >= 0
                    && $record['IncludeInStatistics']==1;
            })->map(function ($record){
                $record['EvaluationScore2'] = $record['EvaluationScore2']===null
                    ? 1
                    : $record['EvaluationScore2'];
                return $record;
            });

        $numerator = $values->sum(function ($item){
            return $item['EvaluationScore2'] * $item['EvaluationScore'];
        });
        $denominator = $values->sum('EvaluationScore2');
        $denominator = $denominator===0 ? null : $denominator;

        $score = $denominator>0
            ? $numerator/$denominator * 100 / 3
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }
    protected static function score_c15($imet_id): ?float
    {
        $ecosystem_services = EcosystemServices::getModule($imet_id)
            ->map(function ($record){
                $record['weight'] = (
                        ($record['Importance'] ?? 0) +
                        ($record['ImportanceRegional']!==null ? $record['ImportanceRegional']/3 : 0) +
                        ($record['ImportanceGlobal']!== null ? ((2 - $record['ImportanceGlobal'])/4) : 0)
                    ) / 3;
                return $record;
            }) ->keyBy('Element');

        $values = ImportanceEcosystemServices::getModule($imet_id)
            ->filter(function ($record){
                return $record['IncludeInStatistics']==1;
            })->map(function ($record) use($ecosystem_services) {
                $record['score'] = $record['EvaluationScore']<0
                    ? null
                    : $record['EvaluationScore'];
                $record['weight'] = in_array($record['Aspect'], array_keys($ecosystem_services->toArray()))
                    ? $ecosystem_services[$record['Aspect']]['weight']
                    : null;
                return $record;
            })
            ->filter(function ($record){
                return $record['score']!==null;
            });


        $numerator = $values->sum(function ($item){
            return ($item['weight'] ?? 0) * ($item['score']/3 ?? 0);
        });
        $denominator = $values->sum(function ($item){
            return ($item['weight'] ?? 0);
        });
        $score = $denominator!==null && $denominator>0
            ? $numerator/$denominator * 100
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }
    protected static function score_c2($imet_id): ?float
    {
        $records = SupportsAndConstraints::getModule($imet_id);

        $values = $records
            ->filter(function ($record){
                return $record['EvaluationScore'] !== null
                    && intval($record['EvaluationScore']) > -4
                    && $record['EvaluationScore2'] !== null
                    && intval($record['EvaluationScore2']) > -4;
            })->map(function ($record){
                $record['EvaluationScore2'] = $record['EvaluationScore2']===null
                    ? 1
                    : $record['EvaluationScore2'];
                return $record;
            });

        $numerator = $values->sum(function ($item){
            return $item['EvaluationScore2'] * $item['EvaluationScore'];
        });
        $denominator = $values->sum('EvaluationScore');

        $score = $denominator>0
            ? $numerator/$denominator * 100 / 3
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }
    protected static function score_c3($imet_id): ?float
    {
        return V1StatisticsService::score_c3($imet_id);
    }
}