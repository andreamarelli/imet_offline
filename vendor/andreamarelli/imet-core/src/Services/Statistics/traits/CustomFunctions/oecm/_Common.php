<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\oecm;


use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\ManagementRelativeImportance;

trait _Common{

    public static function score_staff($imet_id, $records): ?float
    {
        $values = collect($records)
            ->filter(function ($record){
                return $record['Weight'] !== null
                    && $record['Adequacy'] !== null;
            });

        $scores = $values->groupBy('group_key')
            ->map(function ($group){
                $numerator = $group->sum(function ($item){
                    return $item['Adequacy'] * $item['Weight'];
                });
                $denominator = $group->sum(function ($item){
                    return $item['Weight'];
                });
                return $denominator>0
                    ? $numerator/$denominator * 100 / 3
                    : null;
            })
            ->toArray();

        $score_staff = $scores['group0'] ?? null;
        $score_stakeholders = $scores['group1'] ?? null;

        if($score_staff!==null && $score_stakeholders!==null){
            $relative_importance = ManagementRelativeImportance::getModuleRecords($imet_id);
            $relative_importance = (int) $relative_importance['records'][0]['RelativeImportance'] ?? 0;
            $score = (
                    ($score_staff * (50 - $relative_importance * 16.67)) +
                    ($score_stakeholders * (50 + $relative_importance * 16.67))
                ) / 100;
        } elseif($score_staff===null){
            $score = $score_stakeholders;
        } elseif($score_stakeholders===null){
            $score = $score_staff;
        } else {
            $score = null;
        }

        return $score!== null ?
            round($score, 2)
            : null;
    }

}