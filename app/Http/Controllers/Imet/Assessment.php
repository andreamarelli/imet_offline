<?php

namespace App\Http\Controllers\Imet;

use App\Models\Imet\Imet;

trait Assessment{

    private static $indicators = ['context',
        'planning',
        'inputs',
        'process',
        'outputs',
        'outcomes'
    ];

    /**
     * Retrieve the IMET assessment statistics
     *
     * @param $item
     * @param string $step
     * @param bool $labels
     * @return \Illuminate\Http\JsonResponse|array
     */
    public static function assessment($item, $step = 'global', $labels= false)
    {
        $version = Imet::getVersion($item);
        $assessment_schema = $version=='v1'
            ? 'imet_assessment_v1_to_v2'
            : 'imet_assessment_v2';

        if($version!==null) {
            $functions = [
                'context' => 'get_imet_evaluation_stats_step1',
                'planning' => 'get_imet_evaluation_stats_step2',
                'inputs' => 'get_imet_evaluation_stats_step3',
                'process' => 'get_imet_evaluation_stats_step4',
                'outputs' => 'get_imet_evaluation_stats_step5',
                'outcomes' => 'get_imet_evaluation_stats_step6',
            ];

            $function = $step === 'global'
                ? $assessment_schema . '.get_imet_evaluation_stats_step_summary(' . $item . '::text)'
                : $assessment_schema . '.' . $functions[$step] . '(' . $item . ')';

            $stats = (array)\DB::select(\DB::raw('SELECT row_to_json(' . $function . ');'));
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
                $stats['labels'] = (array) static::assessment_labels($assessment_schema)->getData();
            }

            // version
            $stats['version'] = $version;
        } else {
            $stats = [];
        }

        return response()->json($stats);
    }


    /**
     * Retrieve the IMET assessment labels
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function assessment_labels($schema){

        $stats = \DB::select(\DB::raw('select * from '.$schema.'.get_imet_stat_labels();'));

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

    public static function radar_assessment($item)
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
        if($stats->original['version']=='v1'){
            $labels = ['C', 'P', 'I', 'PR', 'R', 'EI'];
        } elseif($stats->original['version']=='v2'){
            $labels = ['C', 'P', 'I', 'PR', 'OP', 'OC'];
        }
        return array_combine($labels, $values);
    }

    public static function getUpperLimit($indicator)
    {
        $upperLimit = [];
        foreach (static::$indicators as $v) {
            $upperLimit[$v] = max($indicator[$v]);
        }

        return $upperLimit;
    }

    public static function getLowerLimit($indicator)
    {
        $lowerLimit = [];
        foreach (static::$indicators as $v) {
            $lowerLimit[$v] = min($indicator[$v]);
        }

        return $lowerLimit;
    }

}

