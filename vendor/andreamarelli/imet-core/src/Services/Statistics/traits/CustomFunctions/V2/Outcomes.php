<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions\V2;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\KeyConservationTrend;

trait Outcomes
{

    protected static function score_oc2($imet_id): ?float
    {
        $values = KeyConservationTrend::getModule($imet_id)
            ->filter(function($record){
                return intval($record['Condition']) !== -99
                    && $record['Condition'] !== null
                    && intval($record['Trend']) !== -99
                    && $record['Trend'] !== null;
            })
            ->groupBy('group_key')
            ->map(function($group){
                $sum_cond = static::average($group->pluck('Condition')->toArray(), null) * 100 / 3;
                $sum_trend = static::average($group->pluck('Trend')->toArray(), null) * 100 / 3;
                return ($sum_cond + $sum_trend) / 2;
            })
            ->toArray();
        $score = static::average($values, null);

        return $score!== null ?
            round($score, 2)
            : null;

    }
}