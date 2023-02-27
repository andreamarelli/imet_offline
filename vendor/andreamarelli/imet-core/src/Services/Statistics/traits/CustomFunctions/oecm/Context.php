<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\oecm;


use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\Designation;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\KeyElements;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\SupportsAndConstraints;

trait Context {

    protected static function score_c11($imet_id): ?float
    {
        $records = Designation::getModuleRecords($imet_id)['records'];
        $values = collect($records);

        $numerator = $values->sum(function ($item){
            return $item['EvaluationScore'] * ($item['SignificativeClassification'] ? 3 : 1);
        });
        $denominator = $values->sum(function ($item){
                return $item['SignificativeClassification'] ? 3 : 1;
            });

        $score = $denominator>0
            ? $numerator/$denominator * 100 / 3
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

    protected static function score_c12($imet_id): ?float
    {
        $module_class = KeyElements::class;

        $records = $module_class::getModule($imet_id);
        $values = $records
            ->filter(function ($record){
                return $record['EvaluationScore'] !== null
                    && intval($record['EvaluationScore']) >= 0;
            })
            ->groupBy('group_key')
            ->map(function($group){

                $numerator = $group->sum(function ($item){
                    return $item['EvaluationScore'] * ($item['IncludeInStatistics'] ? 2 : 1);
                });
                $denominator = $group->sum(function ($item){
                    return $item['IncludeInStatistics'] ? 2 : 1;
                });

                return $denominator>0
                    ? $numerator/$denominator * 100 / 3
                    : null;
            })
            ->toArray();

        $score = static::average($values, null);

        return $score!== null ?
            round($score, 2)
            : null;
    }

    protected static function score_c2($imet_id): ?float
    {
        $records = SupportsAndConstraints::getModuleRecords($imet_id)['records'];

        $values = collect($records)
            ->filter(function ($record){
                return $record['Weight'] !== null
                    && $record['ConstraintLevel'] !== null;
            });

        $numerator = $values->sum(function ($item){
            return $item['ConstraintLevel'] * $item['Weight'];
        });
        $denominator = $values->sum('Weight');

        $score = $denominator>0
            ? $numerator/$denominator * 100 / 3
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

}
