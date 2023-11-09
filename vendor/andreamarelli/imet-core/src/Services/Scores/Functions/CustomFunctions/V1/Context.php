<?php

namespace AndreaMarelli\ImetCore\Services\Scores\Functions\CustomFunctions\V1;


use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\MenacesPressions;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation\ImportanceClassification;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation\ImportanceHabitats;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation\ImportanceSpecies;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation\SupportsAndConstraints;

trait Context
{
    public static function score_c12(int $imet_id): ?float
    {
        $records = ImportanceClassification::getModule($imet_id);

        $values =$records
            ->filter(function ($record){
                return $record['EvaluationScore'] !== null
                    && intval($record['EvaluationScore']) >= 0
                    && $record['SignificativeClassification'] !== null;
            });

        $numerator = $values->sum(function ($item){
            return (1 + 2 * $item['SignificativeClassification']) * $item['EvaluationScore'];
        });
        $denominator = $values->sum(function ($item){
            return (1 + 2 * $item['SignificativeClassification']);
        });

        $score = $denominator>0
            ? $numerator/$denominator * 100 / 3
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

    public static function score_c13(int $imet_id): ?float
    {
        $records = ImportanceSpecies::getModule($imet_id);

        $values = $records
            ->filter(function ($record){
                return $record['EvaluationScore'] !== null
                    && intval($record['EvaluationScore']) >= 0;
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

    public static function score_c14(int $imet_id): ?float
    {
        $records = ImportanceHabitats::getModule($imet_id);

        $values = $records
            ->filter(function ($record){
                return $record['EvaluationScore'] !== null
                    && intval($record['EvaluationScore']) >= 0;
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

    public static function score_c2(int $imet_id): ?float
    {
        $records = SupportsAndConstraints::getModule($imet_id);

        $values = $records
            ->filter(function ($record){
                return $record['EvaluationScore'] !== null
                    && intval($record['EvaluationScore']) != -99
                    && intval($record['EvaluationScore']) > -4;
            });

        $numerator = $values->sum(function ($item){
            return $item['EvaluationScore'] * $item['EvaluationScore2'];
        });
        $denominator = $values->sum(function ($item){
            return $item['EvaluationScore2']===null
                ? 0
                : $item['EvaluationScore2'];

        });
        $denominator = $denominator===0 ? null : $denominator;

        $score = $denominator>0
            ? $numerator/$denominator * 100 / 3
            : null;


        return $score!== null ?
            round($score, 2)
            : null;
    }

    public static function score_c3(int $imet_id): ?float
    {
        $records = MenacesPressions::getModule($imet_id);

        $values = $records
            ->map(function ($record){
                $impact = $record['Impact']!==null ? $record['Impact'] * -1 + 4 : null;
                $extension = $record['Extension']!==null ? $record['Extension'] * -1 + 4 : null;
                $duration = $record['Duration']!==null ? $record['Duration'] * -1 + 4 : null;
                $probability = $record['Probability']!==null ? $record['Probability'] * -1 + 4 : null;
                $trend = $record['Trend']!==null ? $record['Trend'] * -0.75 + 2.5 : null;
                $product =
                    ($impact===null ? 1 : $impact) *
                    ($extension===null ? 1 : $extension) *
                    ($duration===null ? 1 : $duration) *
                    ($probability===null ? 1 : $probability) *
                    ($trend===null ? 1 : $trend);
                $not_null =
                    ($impact===null ? 0 : 1) +
                    ($extension===null ? 0 : 1) +
                    ($duration===null ? 0 : 1) +
                    ($probability===null ? 0 : 1) +
                    ($trend===null ? 0 : 1);
                $exp_denominator = $not_null===0 ? null : $not_null;
                $record['n_power'] = $exp_denominator!==null
                    ? 4 - pow($product, (1/$exp_denominator))
                    : null;
                return $record;
            })
            ->groupBy('group_key')
            ->map(function ($group){
                $group_values = $group
                    ->pluck('n_power')
                    ->toArray();
                $average = static::average($group_values, null);
                return $average!==null
                    ? -1 * $average
                    : null;
            })
            ->toArray();

        $score = static::average($values, null);

        $score = $score!==null
            ? $score * 100 / 3
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

}