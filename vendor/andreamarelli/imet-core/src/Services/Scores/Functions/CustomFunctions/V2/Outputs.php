<?php

namespace AndreaMarelli\ImetCore\Services\Scores\Functions\CustomFunctions\V2;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\AreaDomination;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\AreaDominationMPA;

trait Outputs
{
    protected static function score_op3(int $imet_id): ?float
    {
        $values = AreaDomination::getModule($imet_id)
            ->toArray();
        $values = $values[0] ?? null;

        $score = null;
        if($values){

            $numerator = ($values['Patrol'] ?? 0)
                + ($values['RapidIntervention'] ?? 0)
                + ($values['AirVehicles'] ? 1 : 0)
                + ($values['Planes'] ? 1 : 0);

            $denominator = 3
                * (($values['Patrol']!==null ? 1 : 0) + ($values['RapidIntervention']!==null ? 1 : 0))
                + (($values['AirVehicles']!==null ? 1 : 0) + ($values['Planes']!==null ? 1 : 0));

            $score = $denominator>0
                ? 100 * $numerator / $denominator
                : null;

        }

        return $score!== null ?
            round($score, 2)
            : null;
    }

    protected static function score_op4(int $imet_id): ?float
    {
        $values = AreaDominationMPA::getModule($imet_id);

        $formula = function($item){
            return (
                    $item['Patrol'] +
                    $item['RapidIntervention'] +
                    (int) $item['DetectionRemoteSensing'] +
                    (int) $item['SpecialMeansRapidIntervention']
                )
                /
                (
                    ($item['Patrol']===null ? 0 : 3) +
                    ($item['RapidIntervention']===null ? 0 : 3) +
                    ($item['DetectionRemoteSensing']===null ? 0 : 1) +
                    ($item['SpecialMeansRapidIntervention']===null ? 0 : 1)
                ) * 100;
        };

        $sanctuary_score = $values
            ->where('group_key', 'group0')
            ->map(function ($item) use ($formula){
                return $formula($item);
            })
            ->first();

        $no_take_score = $values
            ->where('group_key', 'group1')
            ->map(function ($item) use ($formula){
                return $formula($item);
            })->avg();

        $buffer_zone_score = $values
            ->whereIn('group_key', ['group2', 'group3'])
            ->map(function ($item)use ($formula){
                return $formula($item);
            })->avg();;

        $score = self::average([$sanctuary_score, $no_take_score, $buffer_zone_score]);

        return $score!== null ?
            round($score, 2)
            : null;
    }

}