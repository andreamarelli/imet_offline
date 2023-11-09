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
            'c11' => static::score_c11($imet_id),
            'c12' => static::score_c12($imet_id),
            'c13' => static::score_c13($imet_id),
            'c14' => static::score_table($imet_id, Evaluation\ImportanceClimateChange::class, 'EvaluationScore'),
            'c15' => static::score_c15($imet_id),
        ];
        $scores['c1'] = self::average($scores);
        $scores['c2'] = static::score_c2($imet_id);
        $scores['c3'] = static::score_c3($imet_id);

        // aggregate step score
        $sum = ($scores['c1'] ?? 0)
            + ($scores['c2'] ? $scores['c2'] / 2 + 50 : 0)
            + ($scores['c3'] ? $scores['c3'] + 100 : 0);
        $count = count(array_filter([$scores['c1'], $scores['c2'], $scores['c3']], function($x) { return $x!==null; }));
        $scores['avg_indicator'] = $count ? round($sum/$count, 1) : null;

        return $scores;
    }

    /**
     * Return PLANNING step scores
     */
    public static function scores_planning(int $imet_id): array
    {
        $scores = [
            'p1' => static::score_table($imet_id, Evaluation\RegulationsAdequacy::class, 'EvaluationScore'),
            'p2' => static::score_table($imet_id, Evaluation\DesignAdequacy::class, 'EvaluationScore'),
            'p3' => static::score_p3($imet_id),
            'p4' => static::score_p4($imet_id),
            'p5' => static::score_p5($imet_id),
            'p6' => static::score_table($imet_id, Evaluation\Objectives::class, 'EvaluationScore'),
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
            'i1' => static::score_group($imet_id, Evaluation\InformationAvailability::class, 'EvaluationScore', 'group_key'),
            'i2' => static::score_i2($imet_id),
            'i3' => static::score_i3($imet_id),
            'i4' => static::score_i4($imet_id),
            'i5' => static::score_i5($imet_id),
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
            'pr1' => static::score_pr1($imet_id),
            'pr2' => static::score_table($imet_id, Evaluation\HRmanagementPolitics::class, 'EvaluationScore'),
            'pr3' => static::score_table($imet_id, Evaluation\HRmanagementSystems::class, 'EvaluationScore'),
            'pr4' => static::score_pr4($imet_id),
            'pr5' => static::score_table($imet_id, Evaluation\AdministrativeManagement::class, 'EvaluationScore', 4),
            'pr6' => static::score_pr6($imet_id),
            'pr7' => static::score_group($imet_id, Evaluation\ManagementActivities::class, 'EvaluationScore', 'group_key'),
            'pr8' => static::score_pr8($imet_id),
            'pr9' => static::score_group($imet_id, Evaluation\IntelligenceImplementation::class, 'Adequacy', 'group_key'),
            'pr10' => static::score_pr10($imet_id),
            'pr11' => static::score_group($imet_id, Evaluation\AssistanceActivities::class, 'EvaluationScore', 'group_key'),
            'pr12' => static::score_table($imet_id, Evaluation\EnvironmentalEducation::class, 'EvaluationScore'),
            'pr13' => static::score_group($imet_id,  Evaluation\VisitorsManagement::class, 'EvaluationScore', 'group_key'),
            'pr14' => static::score_group($imet_id, Evaluation\VisitorsImpact::class, 'EvaluationScore', 'group_key'),
            'pr15' => static::score_table($imet_id, Evaluation\NaturalResourcesMonitoring::class, 'EvaluationScore'),
            'pr16' => static::score_table($imet_id, Evaluation\ResearchAndMonitoring::class, 'EvaluationScore'),
            'pr17' => static::score_table($imet_id, Evaluation\ClimateChangeMonitoring::class, 'EvaluationScore'),
            'pr18' => static::score_pr18($imet_id),
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        // intermediate scores
        $scores['pr1_6'] = static::average([$scores['pr1'],  $scores['pr2'], $scores['pr3'], $scores['pr4'], $scores['pr5'], $scores['pr6']]);
        $scores['pr7_9'] = static::average([$scores['pr7'],  $scores['pr8'],  $scores['pr9']]);
        $scores['pr10_12'] = static::average([$scores['pr10'],  $scores['pr11'],  $scores['pr12']]);
        $scores['pr13_14'] = static::average([$scores['pr13'],  $scores['pr14']]);
        $scores['pr15_16'] = static::average([$scores['pr15'],  $scores['pr16']]);
        $scores['pr17_18'] = static::average([$scores['pr17'],  $scores['pr18']]);

        return $scores;
    }

    /**
     * Return OUTPUTS step scores
     */
    public static function scores_outputs(int $imet_id): array
    {
        $scores = [
            'op1' => static::score_table($imet_id, Evaluation\WorkProgramImplementation::class, 'EvaluationScore'),
            'op2' => static::score_table($imet_id, Evaluation\AchievedResults::class, 'EvaluationScore'),
            'op3' => static::score_op3($imet_id),
            'op4' => static::score_op4($imet_id),
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
            'oc1' => static::score_table($imet_id, Evaluation\AchievedObjectives::class, 'EvaluationScore'),
            'oc2' => static::score_oc2($imet_id),
            'oc3' => static::score_group($imet_id, Evaluation\LifeQualityImpact::class, 'EvaluationScore', 'group_key'),
        ];

        // aggregate step score
        $sum = ($scores['oc1'] ?? 0)
            + ($scores['oc2'] ? $scores['oc2']/2+50 : 0)
            + ($scores['oc3'] ? $scores['oc3']/2+50 : 0);
        $count = count(array_filter([$scores['oc1'], $scores['oc2'], $scores['oc3']], function($x) { return $x!==null; }));
        $scores['avg_indicator'] = $count ? round($sum/$count, 1) : null;

        return $scores;
    }

}