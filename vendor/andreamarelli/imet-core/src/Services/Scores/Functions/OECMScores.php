<?php

namespace AndreaMarelli\ImetCore\Services\Scores\Functions;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\AchievedObjectives;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\AdministrativeManagement;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\AssistanceActivities;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\DesignAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\EmpowermentGovernance;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\EnvironmentalEducation;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\HRmanagementPolitics;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\InformationAvailability;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\LawEnforcementImplementation;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\LifeQualityImpact;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\ManagementActivities;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\NaturalResourcesMonitoring;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\RegulationsAdequacy;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\VisitorsManagement;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\WorkProgramImplementation;
use AndreaMarelli\ImetCore\Services\Scores\Functions\CustomFunctions;


class OECMScores extends _Scores
{
    const CACHE_PREFIX = 'oecm_scores';

    use CommonFunctions;
    use CustomFunctions\oecm\_Common;
    use CustomFunctions\oecm\Context;
    use CustomFunctions\oecm\Planning;
    use CustomFunctions\oecm\Inputs;
    use CustomFunctions\oecm\Process;
    use CustomFunctions\oecm\Outputs;
    use CustomFunctions\oecm\Outcomes;
    use Math;

    /**
     * Override: Ensure to return IMET model
     *
     * @param $imet
     * @return Imet
     */
    public static function getAsModel($imet): Imet
    {
        if (is_int($imet) or is_string($imet)) {
            $imet = Imet::find($imet);
        }
        return $imet;
    }

    /**
     * Return CONTEXT step scores
     */
    public static function scores_context(int $imet_id): array
    {
        $scores = [
            'C1' => static::score_designations($imet_id),
            'C2' => static::score_support_contraints($imet_id),
            'C3' => static::score_threats($imet_id),
            'C4' => static::score_key_elements($imet_id)
        ];

        // aggregate step score
        $denominator = ($scores['C1'] !== null ? 1 : 0)
            + ($scores['C4'] !== null ? 3 : 0)
            + ($scores['C3'] !== null ? 3 : 0)
            + ($scores['C2'] !== null ? 3 : 0);

        // numerator
        $numerator = $scores['C1']
            + ($scores['C4'] !== null ? 3 * $scores['C4'] : 0)
            + ($scores['C2'] !== null ? 3 * ($scores['C2'] / 2 + 50) : 0)
            + ($scores['C3'] !== null ? 3 * ($scores['C3'] + 100) : 0);


        $scores['avg_indicator'] = $numerator > 0 && $denominator > 0
            ? $numerator / $denominator
            : null;

        // round to 1 decimal
        $scores['avg_indicator'] = $scores['avg_indicator'] !== null
            ? round($scores['avg_indicator'], 1)
            : null;

        return $scores;
    }

    /**
     * Return PLANNING step scores
     */
    public static function scores_planning(int $imet_id): array
    {
        $scores = [
            'P1' => static::score_table($imet_id, RegulationsAdequacy::class, 'EvaluationScore'),
            'P2' => static::score_table($imet_id, DesignAdequacy::class, 'EvaluationScore'),
            'P3' => static::score_p3($imet_id),
            'P4' => static::score_p4($imet_id),
            'P5' => static::score_p5($imet_id),
            'P6' => static::score_p6($imet_id)
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        // round to 1 decimal
        $scores['avg_indicator'] = $scores['avg_indicator'] !== null
            ? round($scores['avg_indicator'], 1)
            : null;

        return $scores;
    }

    /**
     * Return INPUTS step scores
     */
    public static function scores_inputs(int $imet_id): array
    {
        $scores = [
            'I1' => static::score_group($imet_id, InformationAvailability::class, 'EvaluationScore', 'group_key'),
            'I2' => static::score_i2($imet_id),
            'I3' => static::score_i3($imet_id),
            'I4' => static::score_i4($imet_id),
            'I5' => static::score_i5($imet_id),
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        // round to 1 decimal
        $scores['avg_indicator'] = $scores['avg_indicator'] !== null
            ? round($scores['avg_indicator'], 1)
            : null;

        return $scores;
    }

    /**
     * Return PROCESS step scores
     */
    public static function scores_process(int $imet_id): array
    {
        $scores = [
            'PR1' => static::score_pr1($imet_id),
            'PR2' => static::score_table($imet_id, HRmanagementPolitics::class, 'EvaluationScore'),
            'PR3' => static::score_group($imet_id, EmpowermentGovernance::class, 'EvaluationScore', 'group_key'),
            'PR4' => static::score_table($imet_id, AdministrativeManagement::class, 'EvaluationScore', 4),
            'PR5' => static::score_pr5($imet_id),
            'PR6' => static::score_group($imet_id, ManagementActivities::class, 'EvaluationScore', 'group_key'),
            'PR7' => static::score_table($imet_id, NaturalResourcesMonitoring::class, 'EvaluationScore'),
            'PR8' => static::score_group($imet_id, LawEnforcementImplementation::class, 'Adequacy', 'group_key'),
            'PR9' => static::score_pr9($imet_id),
            'PR10' => static::score_group($imet_id, AssistanceActivities::class, 'EvaluationScore', 'group_key'),
            'PR11' => static::score_table($imet_id, EnvironmentalEducation::class, 'EvaluationScore'),
            'PR12' => static::score_table($imet_id, VisitorsManagement::class, 'EvaluationScore')
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        // intermediate scores
        $scores['PRA'] = static::average([$scores['PR1'], $scores['PR2'], $scores['PR3'], $scores['PR4'], $scores['PR5']]);
        $scores['PRB'] = static::average([$scores['PR6'], $scores['PR7']]);
        $scores['PRC'] = static::average([$scores['PR8'], $scores['PR9'], $scores['PR10'], $scores['PR11'], $scores['PR12']]);
        $scores['PRD'] = static::average([$scores['PR11'], $scores['PR12']]);

        // round to 1 decimal
        $scores['avg_indicator'] = $scores['avg_indicator'] !== null
            ? round($scores['avg_indicator'], 1)
            : null;

        return $scores;
    }

    /**
     * Return OUTPUTS step scores
     */
    public static function scores_outputs(int $imet_id): array
    {
        $scores = [
            'OP1' => static::score_table($imet_id, WorkProgramImplementation::class, 'EvaluationScore'),
            'OP2' => static::score_op2($imet_id)
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 2);

        // round to 1 decimal
        $scores['avg_indicator'] = $scores['avg_indicator'] !== null
            ? round($scores['avg_indicator'], 1)
            : null;

        return $scores;
    }

    /**
     * Return OUTCOMES step scores
     */
    public static function scores_outcomes(int $imet_id): array
    {
        $scores = [
            'OC1' => static::score_table($imet_id, AchievedObjectives::class, 'EvaluationScore'),
            'OC2' => self::score_oc2($imet_id),
            'OC3' => static::score_group($imet_id, LifeQualityImpact::class, 'EvaluationScore', 'group_key'),
        ];

        // aggregate step score
        $denominator =
            ($scores['OC1'] !== null ? 1 : 0)
            + ($scores['OC2'] !== null ? 1 : 0)
            + ($scores['OC3'] !== null ? 1 : 0);

        $numerator = $scores['OC1']
            + $scores['OC2']
            + ($scores['OC3']!==null
                ? $scores['OC3'] / 2 + 50
                : 0);

        // aggregate step score
        $scores['avg_indicator'] = $denominator > 0
            ? $numerator / $denominator
            : null;

        // round to 1 decimal
        $scores['avg_indicator'] = $scores['avg_indicator'] !== null
            ? round($scores['avg_indicator'], 1)
            : null;

        return $scores;
    }

}
