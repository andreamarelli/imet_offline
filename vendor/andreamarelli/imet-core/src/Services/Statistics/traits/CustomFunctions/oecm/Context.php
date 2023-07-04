<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\oecm;


use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\Designation;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\KeyElements;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\SupportsAndConstraints;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\Threats;

trait Context {

    protected static function score_designations($imet_id): ?float
    {
        $records = Designation::getModuleRecords($imet_id)['records'];
        $values = collect($records);

        $numerator = $values->sum(function ($item){
            return $item['EvaluationScore'] * ($item['SignificativeClassification'] ? 3 : 1);
        });
        $denominator = $values->sum(function ($item){
                return $item['SignificativeClassification'] ? 3 : 1;
            });

        $score = $numerator>0 && $denominator>0
            ? $numerator/$denominator * 100 / 3
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

    protected static function score_key_elements($imet_id): ?float
    {
        $module_class = KeyElements::class;

        $records = $module_class::getModule($imet_id);
        $values = $records
            ->filter(function ($record){
                return $record['EvaluationScore'] !== null
                    && intval($record['EvaluationScore']) >= 0;
            })
            ->map(function($item){
                $importance = $item['Importance'];
                $integration = $item['EvaluationScore'];
                $toPrioritize = $item['IncludeInStatistics'];
                $item['_numerator'] = $importance * $integration * ($toPrioritize ? 2 : 1);
                $item['_denominator'] = $importance * ($toPrioritize ? 2 : 1);
                return $item;
            });

        $numerator = $values->sum('_numerator');
        $denominator = $values->sum('_denominator');

        $score = $denominator>0
            ? $numerator/$denominator * 100 / 3
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

    protected static function score_support_contraints($imet_id): ?float
    {
        $values = collect(SupportsAndConstraints::calculateRanking($imet_id));

        $numerator = $values->sum(function ($item){
            return $item['__score'];
        });
        $denominator = $values->sum('Weight');

        $score = $denominator>0
            ? $numerator/$denominator * 100 / 3
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

    protected static function score_threats($imet_id): ?float
    {
        $values = Threats::calculateRanking($imet_id);

        $values = collect($values)
            ->pluck('__score')
            ->toArray();

        $score = static::average($values, null);

        return $score!== null ?
            round($score, 2)
            : null;
    }

}
