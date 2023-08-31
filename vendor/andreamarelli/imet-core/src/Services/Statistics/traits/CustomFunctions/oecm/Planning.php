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

        if($records[0]['Boundaries'] === null && $records[0]['Adequacy'] === null){
            $score = null;
        } else if($records[0]['Boundaries'] === null || $records[0]['Adequacy'] === null){
            $score = ($records[0]['Boundaries'] + $records[0]['Adequacy'] * 2) * 100 / 6;
        } else {
            $score = ($records[0]['Boundaries'] + $records[0]['Adequacy'] * 2) * 100 / 12;
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

        $score = $denominator>0
            ? $score / $denominator * 100 / 3
            : null;

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
                ($record['PlanExistence'] ? 4 : 0) +
                ($record['PrintedCopy'] ? 1 : 0) +
                ($record['KnowledgePercentage'] ?? 0) +
                ($record['PlanUptoDate'] ? 2 : 0) +
                ($record['PlanApproved'] ? 2 : 0) +
                ($record['PlanImplemented'] ? 2 : 0) +
                ($record['PlanAdequacyScore'] ?? 0);

            $score = 100 * $numerator / 17;

            return $score!== null ?
                round($score, 2)
                : null;

        }
        return null;
    }

}
