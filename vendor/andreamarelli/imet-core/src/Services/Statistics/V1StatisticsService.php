<?php

namespace AndreaMarelli\ImetCore\Services\Statistics;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Evaluation;
use AndreaMarelli\ImetCore\Services\Statistics\traits\CommonFunctions;
use AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions;
use AndreaMarelli\ImetCore\Services\Statistics\traits\Math;


class V1StatisticsService extends StatisticsService
{
    use CommonFunctions;
    use CustomFunctions\V1\Context;
    use CustomFunctions\V1\Planning;
    use CustomFunctions\V1\Inputs;
    use CustomFunctions\V1\Process;
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
        $imet_id = $imet->getKey();

        $scores = [
            'c11' => static::score_table($imet_id, Evaluation\ImportanceGovernance::class, 'EvaluationScore'),
            'c12' => static::score_c12($imet_id),
            'c13' => static::score_c13($imet_id),
            'c14' => static::score_c14($imet_id),
            'c15' => static::score_table($imet_id, Evaluation\ImportanceClimateChange::class, 'EvaluationScore'),
            'c16' => static::score_table($imet_id, Evaluation\ImportanceEcosystemServices::class, 'EvaluationScore'),
        ];
        $scores['c1'] = self::average($scores);
        $scores['c2'] = static::score_c2($imet_id);
        $scores['c3'] = static::score_c3($imet_id);

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
        $imet = static::get_imet($imet);
        $imet_id = $imet->getKey();

        $scores = [
            'p1' => static::score_table($imet_id, Evaluation\RegulationsAdequacy::class, 'EvaluationScore'),
            'p2' => static::score_table($imet_id, Evaluation\DesignAdequacy::class, 'EvaluationScore'),
            'p3' => static::score_p3($imet_id),
            'p4' => static::score_table($imet_id, Evaluation\ManagementPlan::class, 'PlanExistenceScore'),
            'p5' => static::score_table($imet_id, Evaluation\WorkPlan::class, 'PlanExistenceScore'),
            'p6' => static::score_table($imet_id, Evaluation\Objectives::class, 'EvaluationScore'),
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
        $imet = static::get_imet($imet);
        $imet_id = $imet->getKey();

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
     *
     * @param Imet|int $imet
     * @return array
     */
    public static function scores_process($imet): array
    {
        $imet = static::get_imet($imet);
        $imet_id = $imet->getKey();

        $scores = [
            'pr1' => static::score_pr1($imet_id),
            'pr2' => static::score_table($imet_id, Evaluation\HRmanagementPolitics::class, 'EvaluationScore'),
            'pr3' => static::score_table($imet_id, Evaluation\HRmanagementSystems::class, 'EvaluationScore'),
            'pr4' => static::score_table($imet_id, Evaluation\GovernanceLeadership::class, 'EvaluationScoreGovernace'),
            'pr5' => static::score_table($imet_id, Evaluation\AdministrativeManagement::class, 'EvaluationScore'),
            'pr6' => static::score_table($imet_id, Evaluation\EquipmentMaintenance::class, 'EvaluationScore'),
            'pr7' => static::score_group($imet_id, Evaluation\ManagementActivities::class, 'EvaluationScore', 'group_key'),
            'pr8' => static::score_group($imet_id, Evaluation\ProtectionActivities::class, 'EvaluationScore', 'group_key'),
            'pr9' => static::score_pr9($imet),
            'pr10' => static::score_table($imet_id, Evaluation\LawEnforcement::class, 'EvaluationScore'),
            'pr11' => static::score_group($imet_id, Evaluation\Implications::class, 'EvaluationScore', 'group_key'),
            'pr12' => static::score_table($imet_id, Evaluation\AssistanceActivities::class, 'EvaluationScore'),
            'pr13' => static::score_pr13($imet_id),
            'pr14' => static::score_group($imet_id, Evaluation\VisitorsManagement::class, 'EvaluationScore', 'group_key'),
            'pr15' => static::score_group($imet_id, Evaluation\VisitorsImpact::class, 'EvaluationScore', 'group_key'),
            'pr16' => static::score_table($imet_id, Evaluation\NaturalResourcesMonitoring::class, 'EvaluationScore'),
            'pr17' => static::score_table($imet_id, Evaluation\ResearchAndMonitoring::class, 'EvaluationScore'),
            'pr18' => static::score_table($imet_id, Evaluation\ClimateChangeMonitoring::class, 'EvaluationScore'),
            'pr19' => static::score_group($imet_id, Evaluation\EcosystemServices::class, 'EvaluationScore', 'group_key')
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        // intermediate scores
        $scores['pr1_6'] = static::average([$scores['pr1'],  $scores['pr2'], $scores['pr3'], $scores['pr4'], $scores['pr5'], $scores['pr6']]);
        $scores['pr7_10'] = static::average([$scores['pr7'],  $scores['pr8'],  $scores['pr9'], $scores['pr10']], 1);
        $scores['pr11_13'] = static::average([ $scores['pr11'],  $scores['pr12'],  $scores['pr13']], 1);
        $scores['pr14_14'] = static::average([$scores['pr14'],  $scores['pr15']], 1);
        $scores['pr16_17'] = static::average([$scores['pr16'],  $scores['pr17']], 1);
        $scores['pr18_19'] = static::average([$scores['pr18'],  $scores['pr19']], 1);
        return $scores;
    }

    /**
     * Return OUTPUT step scores
     *
     * @param Imet|int $imet
     * @return array
     */
    public static function scores_outputs($imet): array
    {
        $imet = static::get_imet($imet);
        $imet_id = $imet->getKey();

        $scores = [
            'r1' => static::score_table($imet_id, Evaluation\WorkProgramImplementation::class, 'EvaluationScore'),
            'r2' => static::score_table($imet_id, Evaluation\AchievedResults::class, 'EvaluationScore'),
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 2);

        return $scores;
    }

    /**
     * Return OUTCOME step scores
     *
     * @param Imet|int $imet
     * @return array
     */
    public static function scores_outcomes($imet): array
    {
        $imet = static::get_imet($imet);
        $imet_id = $imet->getKey();

        $scores = [
            'ei1' => static::score_table($imet_id, Evaluation\AchievedObjectives::class, 'EvaluationScore'),
            'ei2' => static::score_group($imet_id, Evaluation\DesignatedValuesConservation::class, 'EvaluationScore', 'group_key'),
            'ei3' => static::score_group($imet_id, Evaluation\DesignatedValuesConservationTendency::class, 'EvaluationScore', 'group_key'),
            'ei4' => static::score_table($imet_id, Evaluation\LocalCommunitiesImpact::class, 'EvaluationScore'),
            'ei5' => static::score_table($imet_id, Evaluation\ClimateChangeImpact::class, 'EvaluationScore'),
            'ei6' => static::score_table($imet_id, Evaluation\EcosystemServicesImpact::class, 'EvaluationScore'),
        ];

        // aggregate step score
        $sum = ($scores['ei1'] ?? 0)
            + ($scores['ei2']/2+50 ?? 0)
            + ($scores['ei3']/2+50 ?? 0)
            + ($scores['ei4']/2+50 ?? 0)
            + ($scores['ei5']/2+50 ?? 0)
            + ($scores['ei6']/2+50 ?? 0);
        $count = count(array_filter($scores, function($x) { return $x!==null; }));
        $scores['avg_indicator'] = $count ? round($sum/$count, 1) : null;

        return $scores;
    }

}
