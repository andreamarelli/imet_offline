<?php

namespace AndreaMarelli\ImetCore\Services\Scores\Functions;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation;
use AndreaMarelli\ImetCore\Services\Scores\Functions\CustomFunctions;


class V2Scores extends _Scores
{
    use CommonFunctions;
    use CustomFunctions\V2\Context;
    use CustomFunctions\V2\Planning;
    use CustomFunctions\V2\Inputs;
    use CustomFunctions\V2\Process;
    use CustomFunctions\V2\Outputs;
    use CustomFunctions\V2\Outcomes;
    use Math;

    /**
     * Return CONTEXT step scores
     */
    public static function scores_context(int $imet_id): array
    {
        $scores = [
            'C11' => static::score_c11($imet_id),
            'C12' => static::score_c12($imet_id),
            'C13' => static::score_c13($imet_id),
            'C14' => static::score_table($imet_id, Evaluation\ImportanceClimateChange::class, 'EvaluationScore'),
            'C15' => static::score_c15($imet_id),
        ];
        $scores['C1'] = self::average($scores);
        $scores['C2'] = static::score_c2($imet_id);
        $scores['C3'] = static::score_c3($imet_id);

        // aggregate step score
        $sum = ($scores['C1'] ?? 0)
            + ($scores['C2'] ? $scores['C2'] / 2 + 50 : 0)
            + ($scores['C3'] ? $scores['C3'] + 100 : 0);
        $count = count(array_filter([$scores['C1'], $scores['C2'], $scores['C3']], function($x) { return $x!==null; }));
        $scores['avg_indicator'] = $count ? round($sum/$count, 1) : null;

        return $scores;
    }

    /**
     * Return PLANNING step scores
     */
    public static function scores_planning(int $imet_id): array
    {
        $scores = [
            'P1' => static::score_table($imet_id, Evaluation\RegulationsAdequacy::class, 'EvaluationScore'),
            'P2' => static::score_table($imet_id, Evaluation\DesignAdequacy::class, 'EvaluationScore'),
            'P3' => static::score_p3($imet_id),
            'P4' => static::score_p4($imet_id),
            'P5' => static::score_p5($imet_id),
            'P6' => static::score_table($imet_id, Evaluation\Objectives::class, 'EvaluationScore'),
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        return $scores;
    }

    /**
     * Return INPUTS step scores
     */
    public static function scores_inputs(int $imet_id): array
    {
        $scores = [
            'I1' => static::score_group($imet_id, Evaluation\InformationAvailability::class, 'EvaluationScore', 'group_key'),
            'I2' => static::score_i2($imet_id),
            'I3' => static::score_i3($imet_id),
            'I4' => static::score_i4($imet_id),
            'I5' => static::score_i5($imet_id),
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
        $scores = [
            'PR1' => static::score_pr1($imet_id),
            'PR2' => static::score_table($imet_id, Evaluation\HRmanagementPolitics::class, 'EvaluationScore'),
            'PR3' => static::score_table($imet_id, Evaluation\HRmanagementSystems::class, 'EvaluationScore'),
            'PR4' => static::score_pr4($imet_id),
            'PR5' => static::score_table($imet_id, Evaluation\AdministrativeManagement::class, 'EvaluationScore', 4),
            'PR6' => static::score_pr6($imet_id),
            'PR7' => static::score_group($imet_id, Evaluation\ManagementActivities::class, 'EvaluationScore', 'group_key'),
            'PR8' => static::score_pr8($imet_id),
            'PR9' => static::score_group($imet_id, Evaluation\IntelligenceImplementation::class, 'Adequacy', 'group_key'),
            'PR10' => static::score_pr10($imet_id),
            'PR11' => static::score_group($imet_id, Evaluation\AssistanceActivities::class, 'EvaluationScore', 'group_key'),
            'PR12' => static::score_table($imet_id, Evaluation\EnvironmentalEducation::class, 'EvaluationScore'),
            'PR13' => static::score_group($imet_id,  Evaluation\VisitorsManagement::class, 'EvaluationScore', 'group_key'),
            'PR14' => static::score_group($imet_id, Evaluation\VisitorsImpact::class, 'EvaluationScore', 'group_key'),
            'PR15' => static::score_table($imet_id, Evaluation\NaturalResourcesMonitoring::class, 'EvaluationScore'),
            'PR16' => static::score_table($imet_id, Evaluation\ResearchAndMonitoring::class, 'EvaluationScore'),
            'PR17' => static::score_table($imet_id, Evaluation\ClimateChangeMonitoring::class, 'EvaluationScore'),
            'PR18' => static::score_pr18($imet_id),
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        // intermediate scores
        $scores['PRA'] = static::average([$scores['PR1'],  $scores['PR2'], $scores['PR3'], $scores['PR4'], $scores['PR5'], $scores['PR6']]);
        $scores['PRB'] = static::average([$scores['PR7'],  $scores['PR8'],  $scores['PR9']]);
        $scores['PRC'] = static::average([$scores['PR10'],  $scores['PR11'],  $scores['PR12']]);
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
        $scores = [
            'OP1' => static::score_table($imet_id, Evaluation\WorkProgramImplementation::class, 'EvaluationScore'),
            'OP2' => static::score_table($imet_id, Evaluation\AchievedResults::class, 'EvaluationScore'),
            'OP3' => static::score_op3($imet_id),
            'OP4' => static::score_op4($imet_id),
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
        $scores = [
            'OC1' => static::score_table($imet_id, Evaluation\AchievedObjectives::class, 'EvaluationScore'),
            'OC2' => static::score_oc2($imet_id),
            'OC3' => static::score_group($imet_id, Evaluation\LifeQualityImpact::class, 'EvaluationScore', 'group_key'),
        ];

        // aggregate step score
        $sum = ($scores['OC1'] ?? 0)
            + ($scores['OC2'] ? $scores['OC2']/2+50 : 0)
            + ($scores['OC3'] ? $scores['OC3']/2+50 : 0);
        $count = count(array_filter([$scores['OC1'], $scores['OC2'], $scores['OC3']], function($x) { return $x!==null; }));
        $scores['avg_indicator'] = $count ? round($sum/$count, 1) : null;

        return $scores;
    }

}