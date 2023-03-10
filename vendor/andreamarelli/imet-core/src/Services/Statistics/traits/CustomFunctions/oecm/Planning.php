<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\oecm;



use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\BoundaryLevel;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ManagementPlan;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\Objectives;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\WorkPlan;

trait Planning
{

    protected static function score_p3($imet_id): ?float
    {
        $records = BoundaryLevel::getModuleRecords($imet_id)['records'];

        $score = $records[0]['Boundaries'] + $records[0]['Adequacy'] * 2;

        if($score!==null){
            $score = $records[0]['Boundaries'] === null || $records[0]['Adequacy'] === null
                ? $score * 100 / 6
                : $score * 100 / 12;
        }

        return $score!== null ?
            round($score, 2)
            : null;
    }

    public static function score_p4($imet_id): ?float
    {
        $records = ManagementPlan::getModule($imet_id)
            ->toArray();
        return static::score_p4_p5($imet_id, $records);
    }

    public static function score_p5($imet_id): ?float
    {
        $records = WorkPlan::getModule($imet_id)
            ->toArray();
        return static::score_p4_p5($imet_id, $records);
    }

    public static function score_p6($imet_id): ?float
    {
        $records = Objectives::getModule($imet_id)
            ->toArray();

        $denominator = collect($records)
            ->filter(function($item){
                return $item['EvaluationScore']!==null;
            })
            ->map(function ($item){
                return $item['group_key']==='group0'
                    ? 3
                    : 1;
            })
            ->sum();

        $score = collect($records)
            ->map(function ($item){
                return $item['group_key']==='group0'
                    ? $item['EvaluationScore'] * 3
                    : $item['EvaluationScore'];
            })
            ->sum();

        $score =  $score / $denominator * 100 / 3;

        return $score!== null ?
            round($score, 2)
            : null;
    }

    private static function score_p4_p5($imet_id, $records): ?float
    {
        $record = $records[0] ?? null;

        if($record!==null){
            $record['PlanAdequacyScore'] = intval($record['PlanAdequacyScore']);

            $numerator =
                ($record['PlanExistence'] ? 1 : 0) +
                ($record['PlanUptoDate'] ? 1 : 0) +
                ($record['PlanApproved'] ? 1 : 0) +
                ($record['PlanImplemented'] ? 1 : 0) +
                ($record['PlanAdequacyScore'] ?? 0);

            $score = 100 * $numerator / 7;

            return $score!== null ?
                round($score, 2)
                : null;

        }
        return null;
    }

}
