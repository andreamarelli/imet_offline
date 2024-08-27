<?php

namespace AndreaMarelli\ImetCore\Services\Scores\Functions;


class V1ToV2Scores extends _Scores
{
    use Math;

    /**
     * Return CONTEXT step scores
     */
    public static function scores_context(int $imet_id): array
    {
        $scores_v1 = V1Scores::scores_context($imet_id);
        $scores = [
            'C1' => self::average([
                    $scores_v1['C12'], $scores_v1['C13'], $scores_v1['C14'], $scores_v1['C15'], $scores_v1['C16']
                ]),
            'C2' => $scores_v1['C2'],
            'C3' => $scores_v1['C3'],
            'C11' => $scores_v1['C12'],
            'C12' => $scores_v1['C13'],
            'C13' => $scores_v1['C14'],
            'C14' => $scores_v1['C15'],
            'C15' => $scores_v1['C16']
        ];

        // aggregate step score
        $sum = ($scores['C1'] ?? 0)
            + (($scores['C2'] ?? 0) / 2 + 50)
            + (($scores['C3'] ?? 0) + 100);
        $count = count(array_filter([$scores['C1'], $scores['C2'], $scores['C3']], function($x) { return $x!==null; }));
        $scores['avg_indicator'] = $count ? round($sum/$count, 1) : null;

        return $scores;
    }

    /**
     * Return PLANNING step scores
     */
    public static function scores_planning(int $imet_id): array
    {
        $scores_v1 = V1Scores::scores_planning($imet_id);

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
            'P1' => $scores_v1['P1'],
            'P2' => $scores_v1['P2'],
            'P3' => $conditional_p3($scores_v1['P3']),
            'P4' => round($scores_v1['P4'] * 0.92, 2),
            'P5' => round($scores_v1['P5'] * 0.837, 2),
            'P6' => $scores_v1['P6'],
        ];

        // aggregate step score
        $sum = (($scores['P1'] ?? 0) / 2 + 50)
            + (($scores['P2'] ?? 0) / 2 + 50)
            + ($scores['P3'] ?? 0)
            + ($scores['P4'] ?? 0)
            + ($scores['P5'] ?? 0)
            + ($scores['P6'] ?? 0);
        $count = count(array_filter($scores, function($x) { return $x!==null; }));
        $scores['avg_indicator'] = $count ? round($sum/$count, 1) : null;

        return $scores;
    }

    /**
     * Return INPUTS step scores
     */
    public static function scores_inputs(int $imet_id): array
    {
        $scores_v1 = V1Scores::scores_inputs($imet_id);

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
            'I1' => $scores_v1['I1']!==null ? round($scores_v1['I1'] * 0.8, 2) : null,
            'I2' => $scores_v1['I2']!==null ? round($scores_v1['I2'] * 0.91, 2) : null,
            'I3' => $scores_v1['I3']!==null ? round($conditional_i3($scores_v1['I3']), 2) : null,
            'I4' => $scores_v1['I4']!==null ? round($conditional_i4($scores_v1['I4']), 2) : null,
            'I5' => $scores_v1['I5']!==null ? round($scores_v1['I5'] * 0.893, 2) : null,
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        return $scores;


    }

    /**
     * Return PROCESS step scores
     */
    public static function scores_process(int $imet_id): array
    {
        $scores_v1 = V1Scores::scores_process($imet_id);
        $scores = [
            'PR1' => $scores_v1['PR1'],
            'PR2' => $scores_v1['PR2'],
            'PR3' => $scores_v1['PR3'],
            'PR4' => $scores_v1['PR4'],
            'PR5' => $scores_v1['PR5'],
            'PR6' => $scores_v1['PR6']!==null ? round($scores_v1['PR6'] * 0.8, 2) : null,
            'PR7' => $scores_v1['PR7'],
            'PR8' => $scores_v1['PR10'],
            'PR9' => $scores_v1['PR10'],
            'PR10' => $scores_v1['PR11'],
            'PR11' => $scores_v1['PR12'],
            'PR12' => $scores_v1['PR13'],
            'PR13' => $scores_v1['PR14'],
            'PR14' => $scores_v1['PR15'],
            'PR15' => $scores_v1['PR16'],
            'PR16' => $scores_v1['PR17'],
            'PR17' => $scores_v1['PR18'],
            'PR18' => $scores_v1['PR19']
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        $scores['PRA'] = static::average([$scores['PR1'],  $scores['PR2'], $scores['PR3'], $scores['PR4'], $scores['PR5'], $scores['PR6']]);//$scores_v1['PR1_6'];
        $scores['PRB'] = static::average([$scores['PR7'],  $scores['PR8'], $scores['PR9']]);
        $scores['PRC'] = static::average([$scores['PR10'],  $scores['PR11'], $scores['PR12']]);
        $scores['PRD'] = static::average([$scores['PR13'],  $scores['PR14']]);
        $scores['PRE'] = static::average([$scores['PR15'],  $scores['PR16']]);
        $scores['PRF'] = static::average([$scores['PR17'],  $scores['PR18']]);

        return $scores;
    }

    /**
     * Return OUTPUTS step scores
     */
    public static function scores_outputs(int $imet_id): array
    {
        $scores_v1 = V1Scores::scores_outputs($imet_id);
        $scores = [
            'OP1' => $scores_v1['R1']!==null ? round($scores_v1['R1'] * 0.76, 2) : null,
            'OP2' => $scores_v1['R2']!==null ? round($scores_v1['R2'] * 0.76, 2) : null,
            'OP3' => V1Scores::score_pr9($imet_id),
            'OP4' => null
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 2);

        return $scores;
    }

    /**
     * Return OUTCOMES step scores
     */
    public static function scores_outcomes(int $imet_id): array
    {
        $scores_v1 = V1Scores::scores_outcomes($imet_id);
        $scores = [
            'OC1' => $scores_v1['EI1']!==null ? round($scores_v1['EI1'] * 0.76, 2) : null,
            'OC2' => round(((($scores_v1['EI2'] ?? 0) + $scores_v1['EI3'])/2), 2),
            'OC3' => $scores_v1['EI4'],
        ];

        $sum = ($scores['OC1'] ?? 0)
            + ($scores['OC2']/2+50 ?? 0)
            + ($scores['OC3']/2+50 ?? 0);
        $count = count(array_filter($scores, function($x) { return $x!==null; }));
        $scores['avg_indicator'] = $count ? round($sum/$count, 1) : null;

        return $scores;
    }
}
