<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\V1;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation\BoundaryLevel;

trait Planning
{
    protected static function score_p3($imet_id): ?float
    {
        $records = BoundaryLevel::getModule($imet_id)
            ->toArray();

        $value = !empty($records)
            ? (int) $records[0]['EvaluationScore']
            : null;

        if($value===1){
            $score = 25;
        } elseif($value===2){
            $score = 62.5;
        } elseif($value===3){
            $score = 87.5;
        } elseif($value===4){
            $score = 100;
        } else {
            $score = null;
        }

        return $score;
    }
}