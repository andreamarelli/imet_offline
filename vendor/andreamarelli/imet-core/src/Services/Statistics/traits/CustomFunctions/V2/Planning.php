<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\V2;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\BoundaryLevel;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\ManagementPlan;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\WorkPlan;


trait Planning {

    protected static function score_p3($imet_id): ?float
    {
        $values = BoundaryLevel::getModule($imet_id)
            ->map(function ($record){
                $record['score'] =
                    $record['EvaluationScore']===null || intval($record['EvaluationScore'])===-99
                        ? 0
                        : intval($record['EvaluationScore']);
                return $record;
            });

        $not_null = $values
            ->filter(function($record){
                return $record['EvaluationScore'] !== null;
            })
            ->count();

        $value1 = ($values
            ->map(function($record){
                return $record['Boundaries'] / 6;
            })
            ->avg() * 100 / 2) ?? 0;

        $value2 = $values
            ->map(function($record){
                return (($record['score'] / 3 * 100) ?? 0) / 2;
            })
            ->sum();

        $score = $not_null>0
            ? $value1 + $value2 / $not_null
            : null;

        return $score!== null ?
            round($score, 2)
            : null;
    }

    protected static function score_p4($imet_id): ?float
    {
        $records = ManagementPlan::getModule($imet_id)
            ->toArray();
        return static::score_p4_p5($imet_id, $records);
    }

    protected static function score_p5($imet_id): ?float
    {
        $records = WorkPlan::getModule($imet_id)
            ->toArray();
        return static::score_p4_p5($imet_id, $records);
    }

    private static function score_p4_p5($imet_id, $records): ?float
    {
        $record = $records[0] ?? null;

        if($record!==null){
            $record['VisionAdequacy'] = intval($record['VisionAdequacy']);
            $record['PlanAdequacyScore'] = intval($record['PlanAdequacyScore']);

            $numerator =
                ($record['PlanExistence'] ? 1 : 0) +
                ($record['PlanUptoDate'] ? 1 : 0) +
                ($record['PlanApproved'] ? 1 : 0) +
                ($record['PlanImplemented'] ? 1 : 0) +
                ($record['VisionAdequacy'] ?? 0) +
                ($record['PlanAdequacyScore'] ?? 0);

            $denominator_part_1 = ($record['VisionAdequacy']===0 ? null : $record['VisionAdequacy']);
            $denominator_part_1 = $denominator_part_1!==null
                ? (1 - $record['VisionAdequacy'] / $denominator_part_1)
                : 3;
            $denominator_part_1 = $denominator_part_1 ?? 3;

            $denominator_part_2 = ($record['PlanAdequacyScore']===0 ? null : $record['PlanAdequacyScore']);
            $denominator_part_2 = $denominator_part_2!==null
                ? (1 - $record['PlanAdequacyScore'] / $denominator_part_2)
                : 3;
            $denominator_part_2 = $denominator_part_2 ?? 3;

            $denominator = $denominator_part_1 + $denominator_part_2 !== 0
                ? 10 - $denominator_part_1 - $denominator_part_2
                : null;

            $score = $denominator > 0
                ? 100 * $numerator / $denominator
                : null;

            return $score!== null ?
                round($score, 2)
                : null;

        }
        return null;
    }
}