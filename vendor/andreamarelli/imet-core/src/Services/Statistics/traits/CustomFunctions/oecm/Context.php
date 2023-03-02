<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\oecm;


use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\Designation;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\KeyElements;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\SupportsAndConstraints;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\Threats;

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

    protected static function score_c3($imet_id): ?float
    {
        $records = Threats::getModuleRecords($imet_id)['records'];

        $values = collect($records)
            ->map(function($item){

                $prod = 1
                    * ($item['Impact']!=null ? 4-$item['Impact'] : 1)
                    * ($item['Extension']!=null ? 4-$item['Extension'] : 1)
                    * ($item['Duration']!=null ? 4-$item['Duration'] : 1)
                    * ($item['Trend']!=null ? (5/2 - $item['Trend']*3/4) : 1)
                    * ($item['Probability']!=null ? 4-$item['Probability'] : 1);

                $count = ($item['Impact']!=null ? 1 : 0)
                    + ($item['Extension']!=null ? 1 : 0)
                    + ($item['Duration']!=null ? 1 : 0)
                    + ($item['Trend']!=null ? 1 : 0)
                    + ($item['Probability']!=null ? 1 : 0);

                $item['score'] = $count>0
                    ? (4 - round(pow($prod, 1/($count)),2))
                    : null;

               return $item;
            })
            ->pluck('score')
            ->toArray();

        $score = static::average($values, null);

        return $score!== null ?
            round($score, 2) * 100 / 3
            : null;
    }

}
