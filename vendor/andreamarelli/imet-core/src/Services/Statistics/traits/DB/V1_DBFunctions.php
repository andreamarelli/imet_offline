<?php

namespace AndreaMarelli\ImetCore\Services\Statistics\traits\DB;


trait V1_DBFunctions {


    public static function db_scores_context($imet): array
    {
        $imet = static::get_imet($imet);
        $imet_id = $imet->getKey();

        $scores = [
            'c11' => static::table_db_function($imet_id, 'eval_importance_c11', 'EvaluationScore'),
            'c12' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c12', 'eval_importance_c12'),
            'c13' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c13', 'eval_importance_c13'),
            'c14' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c14', 'eval_importance_c14'),
            'c15' => static::table_db_function($imet_id, 'eval_importance_c15', 'EvaluationScore'),
            'c16' => static::table_db_function($imet_id, 'eval_importance_c16', 'EvaluationScore'),
        ];
        $scores['c1'] = self::average($scores);
        $scores['c2'] = static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c2', 'eval_supports_and_constaints');
        $scores['c3'] = static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_c3', 'context_menaces_pressions');

        // aggregate step score
        $sum = ($scores['c1'] ?? 0)
            + (($scores['c2'] ?? 0) / 2 + 50)
            + (($scores['c3'] ?? 0) + 100);
        $count = count(array_filter([$scores['c1'], $scores['c2'], $scores['c3']], function($x) { return $x!==null; }));
        $scores['avg_indicator'] = $count ? round($sum/$count, 1) : null;

        return $scores;
    }

    public static function db_scores_planning($imet): array
    {
        $imet = static::get_imet($imet);
        $imet_id = $imet->getKey();

        $scores = [
            'p1' => static::table_db_function($imet_id, 'eval_regulations_adequacy', 'EvaluationScore'),
            'p2' => static::table_db_function($imet_id, 'eval_design_adequacy', 'EvaluationScore'),
            'p3' => static::rank_db_function($imet_id, 'eval_boundary_level', 'EvaluationScore', 'EVAL P3'),
            'p4' => static::table_db_function($imet_id, 'eval_management_plan', 'PlanExistenceScore'),
            'p5' => static::table_db_function($imet_id, 'eval_work_plan', 'PlanExistenceScore'),
            'p6' => static::table_db_function($imet_id, 'eval_objectives', 'EvaluationScore'),
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

    public static function db_scores_inputs($imet): array
    {
        $imet = static::get_imet($imet);
        $imet_id = $imet->getKey();

        $scores = [
            'i1' => static::group_db_function($imet_id, 'eval_information_availability', 'EvaluationScore', 'group_key'),
            'i2' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_i2', 'eval_staff', ['EvaluationScore']),
            'i3' => static::rank_db_function($imet_id, 'eval_budget_adequacy', 'EvaluationScore', 'EVAL I3'),
            'i4' => static::rank_db_function($imet_id, 'eval_budget_securization', 'EvaluationScore', 'EVAL I4'),
            'i5' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_i5', 'eval_management_equipment_adequacy', ['EvaluationScore']),
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 1);

        return $scores;
    }

    public static function db_scores_process($imet): array
    {
        $imet = static::get_imet($imet);
        $imet_id = $imet->getKey();

        $scores = [
            'pr1' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_pr1', 'eval_staff_competence', ['EvaluationScore']),
            'pr2' => static::table_db_function($imet_id, 'eval_hr_management_politics', 'EvaluationScore'),
            'pr3' => static::table_db_function($imet_id, 'eval_hr_management_systems', 'EvaluationScore'),
            'pr4' => static::table_db_function($imet_id, 'eval_governance_leadership', 'EvaluationScoreGovernace'),
            'pr5' => static::table_db_function($imet_id, 'eval_administrative_management', 'EvaluationScore'),
            'pr6' => static::table_db_function($imet_id, 'eval_equipment_maintenance', 'EvaluationScore'),
            'pr7' => static::group_db_function($imet_id, 'eval_management_activities', 'EvaluationScore', 'group_key'),
            'pr8' => static::group_db_function($imet_id, 'eval_protection_activities', 'EvaluationScore', 'group_key'),
            'pr9' => static::rank_db_function($imet_id, 'eval_control', 'EvaluationScore', 'EVAL PR9'),
            'pr10' => static::table_db_function($imet_id, 'eval_law_enforcement', 'EvaluationScore'),
            'pr11' => static::group_db_function($imet_id, 'eval_implications', 'EvaluationScore', 'group_key'),
            'pr12' => static::table_db_function($imet_id, 'eval_assistance_activities', 'EvaluationScore'),
            'pr13' => static::custom_db_function($imet_id, 'get_imet_evaluation_stats_cm_pr13', 'eval_actors_relations', ['EvaluationScore']),
            'pr14' => static::group_db_function($imet_id,  'eval_visitors_management', 'EvaluationScore', 'group_key'),
            'pr15' => static::group_db_function($imet_id, 'eval_visitors_impact', 'EvaluationScore', 'group_key'),
            'pr16' => static::table_db_function($imet_id, 'eval_natural_resources_monitoring', 'EvaluationScore'),
            'pr17' => static::table_db_function($imet_id, 'eval_research_and_monitoring', 'EvaluationScore'),
            'pr18' => static::table_db_function($imet_id, 'eval_climate_change_monitoring', 'EvaluationScore'),
            'pr19' => static::group_db_function($imet_id, 'eval_ecosystem_services', 'EvaluationScore', 'group_key')
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

    public static function db_scores_outputs($imet): array
    {
        $imet = static::get_imet($imet);
        $imet_id = $imet->getKey();

        $scores = [
            'r1' => static::table_db_function($imet_id, 'eval_work_program_implementation', 'EvaluationScore'),
            'r2' => static::table_db_function($imet_id, 'eval_achieved_results', 'EvaluationScore'),
        ];

        // aggregate step score
        $scores['avg_indicator'] = static::average($scores, 2);

        return $scores;
    }

    public static function db_scores_outcomes($imet): array
    {
        $imet = static::get_imet($imet);
        $imet_id = $imet->getKey();

        $scores = [
            'ei1' => static::table_db_function($imet_id, 'eval_achived_objectives', 'EvaluationScore'),
            'ei2' => static::group_db_function($imet_id, 'eval_designated_values_conservation', 'EvaluationScore', 'group_key'),
            'ei3' => static::group_db_function($imet_id, 'eval_designated_values_conservation_tendency', 'EvaluationScore', 'group_key'),
            'ei4' => static::table_db_function($imet_id, 'eval_local_communities_impact', 'EvaluationScore'),
            'ei5' => static::table_db_function($imet_id, 'eval_climate_change_impact', 'EvaluationScore'),
            'ei6' => static::table_db_function($imet_id, 'eval_ecosystem_services_impact', 'EvaluationScore'),

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