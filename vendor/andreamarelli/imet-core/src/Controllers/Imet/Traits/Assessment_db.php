<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\Traits;

use AndreaMarelli\ImetCore\Models\Imet\Imet;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class Assessment_db
{

    // TODO: to be replaced
    private static $indicators = [
        'context',
        'planning',
        'inputs',
        'process',
        'outputs',
        'outcomes'
    ];

    // XXXXX DONE: to be removed XXXXX
    // #### REPLACED ################
    private static function assessment($item, string $step = 'global', bool $labels= false): JsonResponse
    {
        $version = Imet::getVersion($item);
        $assessment_schema = $version==Imet::IMET_V1
            ? 'imet_assessment_v1_to_v2'
            : 'imet_assessment_v2';

        if($version!==null) {
            $functions = [
                'context' => 'get_imet_evaluation_stats_by_formid_step1',
                'planning' => 'get_imet_evaluation_stats_by_formid_step2',
                'inputs' => 'get_imet_evaluation_stats_by_formid_step3',
                'process' => 'get_imet_evaluation_stats_by_formid_step4',
                'outputs' => 'get_imet_evaluation_stats_by_formid_step5',
                'outcomes' => 'get_imet_evaluation_stats_by_formid_step6',
                'process_pr1_pr6' => 'get_imet_evaluation_stats_step_by_formid_process_pr1_pr6',
                'process_pr7_pr9' => 'get_imet_evaluation_stats_step_by_formid_process_pr7_pr9',
                'process_pr10_pr12' => 'get_imet_evaluation_stats_step_by_formid_process_pr10_pr12',
                'process_pr13_pr14' => 'get_imet_evaluation_stats_step_by_formid_process_pr13_pr14',
                'process_pr15_pr16' => 'get_imet_evaluation_stats_step_by_formid_process_pr15_pr16',
                'process_pr17_pr18' => 'get_imet_evaluation_stats_step_by_formid_process_pr17_pr18'
            ];

            $function = $step === 'global'
                ? $assessment_schema . ".get_imet_evaluation_stats_step_by_formid_summary('" . $item . "'::text)"
                : $assessment_schema . "." . $functions[$step] . "('" . $item . "')";

            $stats = (array) DB::select(DB::raw('SELECT row_to_json(' . $function . ');'));
            $stats = $stats === [] ? $stats : json_decode($stats[0]->row_to_json, true);

            if (array_key_exists('plans', $stats)) {
                $stats['planning'] = $stats['plans'];
                unset($stats['plans']);
            }

            // Calculate IMET global index
            if ($step == 'global') {
                $stats['imet_index'] = ($stats['context'] + $stats['planning'] + $stats['inputs'] + $stats['process'] + $stats['outputs'] + $stats['outcomes']) / 6;
                $stats['imet_index'] = round($stats['imet_index'], 2);
            }

            // labels
            if ($labels) {
                $stats['labels'] = (array) Assessment_db::assessment_labels($assessment_schema)->getData();
            }

            // version
            $stats['version'] = $version;
        } else {
            $stats = [];
        }

        return response()->json($stats);
    }

    // XXXXX DONE: to be removed XXXXX
    // #### REPLACED ################
    private static function assessment_labels($schema): JsonResponse
    {

        $stats = DB::select(DB::raw('select * from '.$schema.'.get_imet_stat_labels();'));

        $labels = [];
        foreach ($stats as $item){
            $labels[$item->code] = [
                'code_label' => $item->code_label,
                'title_fr' => $item->title_fr,
                'title_en' => $item->title_en,
                'title_sp' => $item->title_sp
            ];
        }

        return response()->json($labels);
    }

    // XXXXX DONE: to be removed XXXXX
    // #### REPLACED ################
    public static function radar_assessment($item, $abbreviations = true)
    {
        $stats = static::assessment($item, 'global', true);
        $values = [
            $stats->original["context"],
            $stats->original["planning"],
            $stats->original["inputs"],
            $stats->original["process"],
            $stats->original["outputs"],
            $stats->original["outcomes"]
        ];
        $labels = static::assessment_steps_labels()[$stats->original['version']][$abbreviations ? 'abbreviations' : 'full'];
        return array_combine($labels, $values);
    }

    // XXXXX DONE: to be removed XXXXX
    // #### REPLACED ################
    private static function assessment_steps_labels(): array
    {
        return [
            Imet::IMET_V1 => [
                'abbreviations' => ['C', 'P', 'I', 'PR', 'R', 'EI'],
                'full' => [
                    trans('imet-core::v1_common.steps_eval.context'),
                    trans('imet-core::v1_common.steps_eval.planning'),
                    trans('imet-core::v1_common.steps_eval.inputs'),
                    trans('imet-core::v1_common.steps_eval.process'),
                    trans('imet-core::v1_common.steps_eval.outputs'),
                    trans('imet-core::v1_common.steps_eval.outcomes'),
                ]
            ],
            Imet::IMET_V2 => [
                'abbreviations' => ['C', 'P', 'I', 'PR', 'OP', 'OC'],
                'full' => [
                    trans('imet-core::v2_common.steps_eval.context'),
                    trans('imet-core::v2_common.steps_eval.planning'),
                    trans('imet-core::v2_common.steps_eval.inputs'),
                    trans('imet-core::v2_common.steps_eval.process'),
                    trans('imet-core::v2_common.steps_eval.outputs'),
                    trans('imet-core::v2_common.steps_eval.outcomes'),
                ]
            ],
        ];
    }

}