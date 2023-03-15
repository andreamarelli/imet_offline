<?php

namespace AndreaMarelli\ImetCore\Services\Statistics;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\AchievedObjectives;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\AdministrativeManagement;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\AssistanceActivities;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\CapacityAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\DesignAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\Designation;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\EmpowermentGovernance;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\EnvironmentalEducation;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\HRmanagementPolitics;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\InformationAvailability;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\LawEnforcementImplementation;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\LifeQualityImpact;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ManagementActivities;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\NaturalResourcesMonitoring;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\Objectives;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\RegulationsAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\StaffCompetence;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\VisitorsManagement;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\WorkProgramImplementation;
use AndreaMarelli\ImetCore\Services\Statistics\traits\CommonFunctions;
use AndreaMarelli\ImetCore\Services\Statistics\traits\CustomFunctions;
use AndreaMarelli\ImetCore\Services\Statistics\traits\Math;

class OEMCStatisticsService extends StatisticsService
{
    use CommonFunctions;
    use CustomFunctions\oecm\_Common;
    use CustomFunctions\oecm\Context;
    use CustomFunctions\oecm\Planning;
    use CustomFunctions\oecm\Inputs;
    use CustomFunctions\oecm\Process;
    use CustomFunctions\oecm\Outputs;
    use Math;

    /**
     * Override: Ensure to return IMET model
     *
     * @param $imet
     * @return Imet
     */
    protected static function get_imet($imet): Imet
    {
        if(is_int($imet) or is_string($imet)){
            $imet = Imet::find($imet);
        }
        return $imet;
    }

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
            'c1' => static::score_designations($imet_id),
            'c2' => static::score_key_elements($imet_id),
            'c3' => static::score_support_contraints($imet_id),
            'c4' => static::score_threats($imet_id),
        ];

        // aggregate step score
        $denominator = ($scores['c1']!==null ? 1 : 0)
            + ($scores['c2']!==null ? 3 : 0)
            + ($scores['c3']!==null ? 3 : 0)
            + ($scores['c4']!==null ? 3 : 0);

        $scores['avg_indicator'] = $denominator>0
            ? (
                $scores['c1']
                + ($scores['c2']!==null ? 3 * $scores['c2'] : 0)
                + ($scores['c3']!==null ? 3 * ($scores['c3']/2+50) : 0)
                + ($scores['c4']!==null ? 3 * ($scores['c4']+100) : 0)
            ) / $denominator
            : null;

        $scores['avg_indicator'] =  $scores['avg_indicator']!== null
            ? round($scores['avg_indicator'], 2)
            : null;
        
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
            'p1' => static::score_table($imet_id, RegulationsAdequacy::class, 'EvaluationScore'),
            'p2' => static::score_table($imet_id, DesignAdequacy::class, 'EvaluationScore'),
            'p3' => static::score_p3($imet_id),
            'p4' => static::score_p4($imet_id),
            'p5' => static::score_p5($imet_id),
            'p6' => static::score_p6($imet_id)
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

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
            'i1' => static::score_group($imet_id, InformationAvailability::class, 'EvaluationScore', 'group_key'),
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
            'pr2' => static::score_table($imet_id, HRmanagementPolitics::class, 'EvaluationScore'),
            'pr3' => static::score_group($imet_id, EmpowermentGovernance::class, 'EvaluationScore', 'group_key'),
            'pr4' => static::score_table($imet_id, AdministrativeManagement::class, 'EvaluationScore', 4),
            'pr5' => static::score_pr5($imet_id),
            'pr6' => static::score_group($imet_id, ManagementActivities::class, 'EvaluationScore', 'group_key'),
            'pr7' => static::score_group($imet_id, LawEnforcementImplementation::class, 'Adequacy', 'group_key'),
            'pr8' => static::score_pr8($imet_id),
            'pr9' => static::score_group($imet_id, AssistanceActivities::class, 'EvaluationScore', 'group_key'),
            'pr10' => static::score_table($imet_id, EnvironmentalEducation::class, 'EvaluationScore'),
            'pr11' => static::score_table($imet_id, VisitorsManagement::class, 'EvaluationScore'),
            'pr12' => static::score_table($imet_id, NaturalResourcesMonitoring::class, 'EvaluationScore'),

        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        // intermediate scores
        $scores['pr1_6'] = static::average([$scores['pr1'],  $scores['pr2'], $scores['pr3'], $scores['pr4'], $scores['pr5'], $scores['pr6']]);
        $scores['pr7_9'] = static::average([$scores['pr7'],  $scores['pr8'],  $scores['pr9']]);
        $scores['pr10_12'] = static::average([$scores['pr10'],  $scores['pr11'],  $scores['pr12']]);

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
        $imet = static::get_imet($imet);
        $imet_id = $imet->getKey();

        $scores = [
            'op1' => static::score_table($imet_id, WorkProgramImplementation::class, 'EvaluationScore'),
            'op2' => static::score_op2($imet_id)
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
        $imet = static::get_imet($imet);
        $imet_id = $imet->getKey();

        $scores = [
            'oc1' => static::score_table($imet_id, AchievedObjectives::class, 'EvaluationScore'),
            'oc2' => static::score_group($imet_id, LifeQualityImpact::class, 'EvaluationScore', 'group_key'),
        ];


        // aggregate step score
        $denominator =
            ($scores['oc1']!==null ? 1 : 0)
            + ($scores['oc2']!==null ? 1 : 0);

        // aggregate step score
        $scores['avg_indicator'] = $denominator>0
            ? ($scores['oc1']
                + ($scores['oc2']/2+50)) / $denominator
            : null;

        return $scores;
    }

}
