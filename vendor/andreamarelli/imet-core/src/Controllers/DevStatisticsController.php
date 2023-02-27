<?php

namespace AndreaMarelli\ImetCore\Controllers;


use AndreaMarelli\ImetCore\Controllers\Imet\EvalController;
use AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment_db;
use AndreaMarelli\ImetCore\Helpers\ScalingUp\Common;
use AndreaMarelli\ImetCore\Models\Imet\Imet;
use AndreaMarelli\ImetCore\Services\Statistics\StatisticsService;
use AndreaMarelli\ImetCore\Services\Statistics\V1ToV2StatisticsService;
use AndreaMarelli\ImetCore\Services\Statistics\V2StatisticsService;
use Illuminate\Http\Request;

class DevStatisticsController extends __Controller
{

    public function index(Request $request)
    {
        $assessments_v1 = Imet
            ::select((new Imet)->getKeyName())
            ->where('version', Imet::IMET_V1)
            ->get()
            ->pluck((new Imet)->getKeyName())
            ->toArray();

        $v1_stats_from_db = [];
        $v1_stats_from_php = [];
        foreach ($assessments_v1 as $id){
            $v1_stats_from_db['radar'][$id] = Assessment_db::radar_assessment($id);
            $v1_stats_from_db['context'][$id] = V1ToV2StatisticsService::db_scores_context($id);
            $v1_stats_from_db['planning'][$id] = V1ToV2StatisticsService::db_scores_planning($id);
            $v1_stats_from_db['inputs'][$id] = V1ToV2StatisticsService::db_scores_inputs($id);
            $v1_stats_from_db['process'][$id] = V1ToV2StatisticsService::db_scores_process($id);
            $v1_stats_from_db['outputs'][$id] = V1ToV2StatisticsService::db_scores_outputs($id);
            $v1_stats_from_db['outcomes'][$id] = V1ToV2StatisticsService::db_scores_outcomes($id);

            $v1_stats_from_php['radar'][$id] = V1ToV2StatisticsService::get_radar_scores($id);
            $v1_stats_from_php['context'][$id] = V1ToV2StatisticsService::get_scores($id, StatisticsService::CONTEXT);
            $v1_stats_from_php['planning'][$id] = V1ToV2StatisticsService::get_scores($id, StatisticsService::PLANNING);
            $v1_stats_from_php['inputs'][$id] = V1ToV2StatisticsService::get_scores($id, StatisticsService::INPUTS);
            $v1_stats_from_php['process'][$id] = V1ToV2StatisticsService::get_scores($id, StatisticsService::PROCESS);
            $v1_stats_from_php['outputs'][$id] = V1ToV2StatisticsService::get_scores($id, StatisticsService::OUTPUTS);
            $v1_stats_from_php['outcomes'][$id] = V1ToV2StatisticsService::get_scores($id, StatisticsService::OUTCOMES);
        }

        $assessments_v2 = Imet
            ::select((new Imet)->getKeyName())
            ->where('version', Imet::IMET_V2)
            ->get()
            ->pluck((new Imet)->getKeyName())
            ->toArray();

        $v2_stats_from_db = [];
        $v2_stats_from_php = [];
        foreach ($assessments_v2 as $id){
            $v2_stats_from_db['radar'][$id] = Assessment_db::radar_assessment($id);
            $v2_stats_from_db['context'][$id] = V2StatisticsService::db_scores_context($id);
            $v2_stats_from_db['planning'][$id] = V2StatisticsService::db_scores_planning($id);
            $v2_stats_from_db['inputs'][$id] = V2StatisticsService::db_scores_inputs($id);
            $v2_stats_from_db['process'][$id] = V2StatisticsService::db_scores_process($id);
            $v2_stats_from_db['outputs'][$id] = V2StatisticsService::db_scores_outputs($id);
            $v2_stats_from_db['outcomes'][$id] = V2StatisticsService::db_scores_outcomes($id);

            $v2_stats_from_php['radar'][$id] = V2StatisticsService::get_radar_scores($id);
            $v2_stats_from_php['context'][$id] = V2StatisticsService::get_scores($id, StatisticsService::CONTEXT);
            $v2_stats_from_php['planning'][$id] = V2StatisticsService::get_scores($id, StatisticsService::PLANNING);
            $v2_stats_from_php['inputs'][$id] = V2StatisticsService::get_scores($id, StatisticsService::INPUTS);
            $v2_stats_from_php['process'][$id] = V2StatisticsService::get_scores($id, StatisticsService::PROCESS);
            $v2_stats_from_php['outputs'][$id] = V2StatisticsService::get_scores($id, StatisticsService::OUTPUTS);
            $v2_stats_from_php['outcomes'][$id] = V2StatisticsService::get_scores($id, StatisticsService::OUTCOMES);
        }

        return view('imet-core::dev_stats', [
            'assessments_v1' => $assessments_v1,
            'v1_stats_from_db' => $v1_stats_from_db,
            'v1_stats_from_php' => $v1_stats_from_php,
            'assessments_v2' => $assessments_v2,
            'v2_stats_from_db' => $v2_stats_from_db,
            'v2_stats_from_php' => $v2_stats_from_php,
        ]);

    }

}