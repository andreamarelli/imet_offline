<?php

namespace AndreaMarelli\ImetCore\Services\Statistics;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Services\Statistics\traits\Math;


class V1ToV2StatisticsService extends StatisticsService
{
    use Math;

    /**
     * Return CONTEXT step scores
     *
     * @param Imet|int $imet
     * @return array
     */
    public static function scores_context($imet): array
    {
        $imet = static::get_imet($imet);

        $scores_v1 = V1StatisticsService::scores_context($imet);
        $scores = [
            'c1' => self::average([
                    $scores_v1['c12'], $scores_v1['c13'], $scores_v1['c14'], $scores_v1['c15'], $scores_v1['c16']
                ]),
            'c2' => $scores_v1['c2'],
            'c3' => $scores_v1['c3'],
            'c11' => $scores_v1['c12'],
            'c12' => $scores_v1['c13'],
            'c13' => $scores_v1['c14'],
            'c14' => $scores_v1['c15'],
            'c15' => $scores_v1['c16']
        ];

        // aggregate step score
        $sum = ($scores['c1'] ?? 0)
            + (($scores['c2'] ?? 0) / 2 + 50)
            + (($scores['c3'] ?? 0) + 100);
        $count = count(array_filter([$scores['c1'], $scores['c2'], $scores['c3']], function($x) { return $x!==null; }));
        $scores['avg_indicator'] = $count ? round($sum/$count, 1) : null;

        return $scores;
    }

    /**
     * Return PLANNING step scores
     *
     * @param Imet|int $imet
     * @return array
     */
    public static function scores_planning($imet): array
    {
        $scores_v1 = V1StatisticsService::scores_planning($imet);

        $conditional_p3 = function($value){
            if($value===null) {
                return null;
            } else if($value===0) {
                return 0;
            } else if($value <= 25){
                return 0.8 * $value;
            } else if($value <= 62.5) {
                return (20 + ($value - 25) / (62.5 - 25) * 40);
            } else if($value <= 87.5) {
                return (60 + ($value - 62.5) / (87.5 - 62.5) * 30);
            } else {
                return (90+($value-87.5)/12.5*10);
            }
        };

        $scores = [
            'p1' => $scores_v1['p1'],
            'p2' => $scores_v1['p2'],
            'p3' => $conditional_p3($scores_v1['p3']),
            'p4' => round($scores_v1['p4'] * 0.92, 2),
            'p5' => round($scores_v1['p5'] * 0.837, 2),
            'p6' => $scores_v1['p6'],
        ];

        // aggregate step score
        $sum = (($scores['p1'] ?? 0) / 2 + 50)
            + (($scores['p2'] ?? 0) / 2 + 50)
            + ($scores['p3'] ?? 0)
            + ($scores['p4'] ?? 0)
            + ($scores['p5'] ?? 0)
            + ($scores['p6'] ?? 0);
        $count = count(array_filter($scores, function($x) { return $x!==null; }));
        $scores['avg_indicator'] = $count ? round($sum/$count, 1) : null;

        return $scores;
    }

    /**
     * Return INPUTS step scores
     *
     * @param Imet|int $imet
     * @return array
     */
    public static function scores_inputs($imet): array
    {
        $scores_v1 = V1StatisticsService::scores_inputs($imet);

        $conditional_i3 = function($value){
            if($value===0) {
                return 0;
            } else if($value <= 17.5){
                return (26/17.5)*$value;
            } else if($value <= 53){
                return (26+($value-17.5)/(53-17.5)*26);
            } else if($value <= 85.5){
                return (52+($value-53)/(85.5-53)*34);
            } else {
                return (86+($value-85.5)/14.5*14);
            }
        };

        $conditional_i4 = function($value){
            if($value===0) {
                return 0;
            } else if($value <= 16.7) {
                 return(5/16.7)*$value;
            } else if($value <= 50) {
                 return(5+($value-16.7)/(50-16.7)*31.6666667);
            } else if($value <= 83.3) {
                 return(36.666667+($value-50)/(83.3-50)*36.66666667);
            } else {
                return (73.333333333 + ($value - 83.3) / 16.7 * 26.6666666666667);
            }
        };

        $scores = [
            'i1' => $scores_v1['i1']!==null ? round($scores_v1['i1'] * 0.8, 2) : null,
            'i2' => $scores_v1['i2']!==null ? round($scores_v1['i2'] * 0.91, 2) : null,
            'i3' => $scores_v1['i3']!==null ? round($conditional_i3($scores_v1['i3']), 2) : null,
            'i4' => $scores_v1['i4']!==null ? round($conditional_i4($scores_v1['i4']), 2) : null,
            'i5' => $scores_v1['i5']!==null ? round($scores_v1['i5'] * 0.893, 2) : null,
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        return $scores;


    }

    /**
     * Return PROCESS step scores
     *
     * @param Imet|int $imet
     * @return array
     */
    public static function scores_process($imet): array
    {
        $scores_v1 = V1StatisticsService::scores_process($imet);
        $scores = [
            'pr1' => $scores_v1['pr1'],
            'pr2' => $scores_v1['pr2'],
            'pr3' => $scores_v1['pr3'],
            'pr4' => $scores_v1['pr4'],
            'pr5' => $scores_v1['pr5'],
            'pr6' => $scores_v1['pr6']!==null ? round($scores_v1['pr6'] * 0.8, 2) : null,
            'pr7' => $scores_v1['pr7'],
            'pr8' => $scores_v1['pr10'],
            'pr9' => $scores_v1['pr10'],
            'pr10' => $scores_v1['pr11'],
            'pr11' => $scores_v1['pr12'],
            'pr12' => $scores_v1['pr13'],
            'pr13' => $scores_v1['pr14'],
            'pr14' => $scores_v1['pr15'],
            'pr15' => $scores_v1['pr16'],
            'pr16' => $scores_v1['pr17'],
            'pr17' => $scores_v1['pr18'],
            'pr18' => $scores_v1['pr19']
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        $scores['pr1_6'] = static::average([$scores['pr1'],  $scores['pr2'], $scores['pr3'], $scores['pr4'], $scores['pr5'], $scores['pr6']]);//$scores_v1['pr1_6'];
        $scores['pr7_9'] = static::average([$scores['pr7'],  $scores['pr8'], $scores['pr9']]);
        $scores['pr10_12'] = static::average([$scores['pr10'],  $scores['pr11'], $scores['pr12']]);
        $scores['pr13_14'] = static::average([$scores['pr13'],  $scores['pr14']]);
        $scores['pr15_16'] = static::average([$scores['pr15'],  $scores['pr16']]);
        $scores['pr17_18'] = static::average([$scores['pr17'],  $scores['pr18']]);

        return $scores;
    }

    /**
     * Return OUTPUTS step scores
     *
     * @param Imet|int $imet
     * @return array
     */
    public static function scores_outputs($imet): array
    {
        $scores_v1 = V1StatisticsService::scores_outputs($imet);
        $scores = [
            'op1' => $scores_v1['r1']!==null ? round($scores_v1['r1'] * 0.76, 2) : null,
            'op2' => $scores_v1['r2']!==null ? round($scores_v1['r2'] * 0.76, 2) : null,
            'op3' => V1StatisticsService::score_pr9($imet),
            'op4' => null
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 2);

        return $scores;
    }

    /**
     * Return OUTCOMES step scores
     *
     * @param Imet|int $imet
     * @return array
     */
    public static function scores_outcomes($imet): array
    {
        $scores_v1 = V1StatisticsService::scores_outcomes($imet);
        $scores = [
            'oc1' => $scores_v1['ei1']!==null ? round($scores_v1['ei1'] * 0.76, 2) : null,
            'oc2' => round(((($scores_v1['ei2'] ?? 0) + $scores_v1['ei3'])/2), 2),
            'oc3' => $scores_v1['ei4'],
        ];

        $sum = ($scores['oc1'] ?? 0)
            + ($scores['oc2']/2+50 ?? 0)
            + ($scores['oc3']/2+50 ?? 0);
        $count = count(array_filter($scores, function($x) { return $x!==null; }));
        $scores['avg_indicator'] = $count ? round($sum/$count, 1) : null;

        return $scores;
    }
}
