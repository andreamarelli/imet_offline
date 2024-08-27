<?php

namespace AndreaMarelli\ImetCore\Services\Scores\Functions;

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;
use AndreaMarelli\ImetCore\Services\Scores\Functions\CustomFunctions;


class V1Scores extends _Scores
{
    use CommonFunctions;
    use CustomFunctions\V1\Context;
    use CustomFunctions\V1\Planning;
    use CustomFunctions\V1\Inputs;
    use CustomFunctions\V1\Process;
    use Math;

    /**
     * Return CONTEXT step scores
     */
    public static function scores_context(int $imet_id): array
    {
        $scores = [
            'C11' => static::score_table($imet_id, Evaluation\ImportanceGovernance::class, 'EvaluationScore'),
            'C12' => static::score_c12($imet_id),
            'C13' => static::score_c13($imet_id),
            'C14' => static::score_c14($imet_id),
            'C15' => static::score_table($imet_id, Evaluation\ImportanceClimateChange::class, 'EvaluationScore'),
            'C16' => static::score_table($imet_id, Evaluation\ImportanceEcosystemServices::class, 'EvaluationScore'),
        ];
        $scores['C1'] = self::average($scores);
        $scores['C2'] = static::score_c2($imet_id);
        $scores['C3'] = static::score_c3($imet_id);

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
        $scores = [
            'P1' => static::score_table($imet_id, Evaluation\RegulationsAdequacy::class, 'EvaluationScore'),
            'P2' => static::score_table($imet_id, Evaluation\DesignAdequacy::class, 'EvaluationScore'),
            'P3' => static::score_p3($imet_id),
            'P4' => static::score_table($imet_id, Evaluation\ManagementPlan::class, 'PlanExistenceScore'),
            'P5' => static::score_table($imet_id, Evaluation\WorkPlan::class, 'PlanExistenceScore'),
            'P6' => static::score_table($imet_id, Evaluation\Objectives::class, 'EvaluationScore'),
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
            'PR4' => static::score_table($imet_id, Evaluation\GovernanceLeadership::class, 'EvaluationScoreGovernace'),
            'PR5' => static::score_table($imet_id, Evaluation\AdministrativeManagement::class, 'EvaluationScore'),
            'PR6' => static::score_table($imet_id, Evaluation\EquipmentMaintenance::class, 'EvaluationScore'),
            'PR7' => static::score_group($imet_id, Evaluation\ManagementActivities::class, 'EvaluationScore', 'group_key'),
            'PR8' => static::score_group($imet_id, Evaluation\ProtectionActivities::class, 'EvaluationScore', 'group_key'),
            'PR9' => static::score_pr9($imet_id),
            'PR10' => static::score_table($imet_id, Evaluation\LawEnforcement::class, 'EvaluationScore'),
            'PR11' => static::score_group($imet_id, Evaluation\Implications::class, 'EvaluationScore', 'group_key'),
            'PR12' => static::score_table($imet_id, Evaluation\AssistanceActivities::class, 'EvaluationScore'),
            'PR13' => static::score_pr13($imet_id),
            'PR14' => static::score_group($imet_id, Evaluation\VisitorsManagement::class, 'EvaluationScore', 'group_key'),
            'PR15' => static::score_group($imet_id, Evaluation\VisitorsImpact::class, 'EvaluationScore', 'group_key'),
            'PR16' => static::score_table($imet_id, Evaluation\NaturalResourcesMonitoring::class, 'EvaluationScore'),
            'PR17' => static::score_table($imet_id, Evaluation\ResearchAndMonitoring::class, 'EvaluationScore'),
            'PR18' => static::score_table($imet_id, Evaluation\ClimateChangeMonitoring::class, 'EvaluationScore'),
            'PR19' => static::score_group($imet_id, Evaluation\EcosystemServices::class, 'EvaluationScore', 'group_key')
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        // intermediate scores
        $scores['PRA'] = static::average([$scores['PR1'],  $scores['PR2'], $scores['PR3'], $scores['PR4'], $scores['PR5'], $scores['PR6']]);
        $scores['PRB'] = static::average([$scores['PR7'],  $scores['PR8'],  $scores['PR9'], $scores['PR10']], 1);
        $scores['PRC'] = static::average([ $scores['PR11'],  $scores['PR12'],  $scores['PR13']], 1);
        $scores['PRD'] = static::average([$scores['PR14'],  $scores['PR15']], 1);
        $scores['PRE'] = static::average([$scores['PR16'],  $scores['PR17']], 1);
        $scores['PRF'] = static::average([$scores['PR18'],  $scores['PR19']], 1);
        return $scores;
    }

    /**
     * Return OUTPUT step scores
     */
    public static function scores_outputs(int $imet_id): array
    {
        $scores = [
            'R1' => static::score_table($imet_id, Evaluation\WorkProgramImplementation::class, 'EvaluationScore'),
            'R2' => static::score_table($imet_id, Evaluation\AchievedResults::class, 'EvaluationScore'),
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 2);

        return $scores;
    }

    /**
     * Return OUTCOME step scores
     */
    public static function scores_outcomes(int $imet_id): array
    {
        $scores = [
            'EI1' => static::score_table($imet_id, Evaluation\AchievedObjectives::class, 'EvaluationScore'),
            'EI2' => static::score_group($imet_id, Evaluation\DesignatedValuesConservation::class, 'EvaluationScore', 'group_key'),
            'EI3' => static::score_group($imet_id, Evaluation\DesignatedValuesConservationTendency::class, 'EvaluationScore', 'group_key'),
            'EI4' => static::score_table($imet_id, Evaluation\LocalCommunitiesImpact::class, 'EvaluationScore'),
            'EI5' => static::score_table($imet_id, Evaluation\ClimateChangeImpact::class, 'EvaluationScore'),
            'EI6' => static::score_table($imet_id, Evaluation\EcosystemServicesImpact::class, 'EvaluationScore'),
        ];

        // aggregate step score
        $sum = ($scores['EI1'] ?? 0)
            + ($scores['EI2']/2+50 ?? 0)
            + ($scores['EI3']/2+50 ?? 0)
            + ($scores['EI4']/2+50 ?? 0)
            + ($scores['EI5']/2+50 ?? 0)
            + ($scores['EI6']/2+50 ?? 0);
        $count = count(array_filter($scores, function($x) { return $x!==null; }));
        $scores['avg_indicator'] = $count ? round($sum/$count, 1) : null;

        return $scores;
    }

}
