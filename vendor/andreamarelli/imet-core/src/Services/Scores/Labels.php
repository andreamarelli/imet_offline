<?php

namespace AndreaMarelli\ImetCore\Services\Scores;

use AndreaMarelli\ImetCore\Models\Imet;
use AndreaMarelli\ImetCore\Services\Scores\Functions\_Scores;
use AndreaMarelli\ModularForms\Helpers\Locale;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

trait Labels{

    protected static function get_labels(string $version = null, $only_abbreviations = false): array
    {
        $labels = static::all_labels();

        if($version !== null){
            $labels = $labels[$version];
            if($only_abbreviations){
                $labels = $labels['abbreviations'];
            }
        }

        return $labels;
    }

    private static function all_labels(): array
    {
        return [
            Imet\Imet::IMET_V1 => [
                'abbreviations' => ['C', 'P', 'I', 'PR', 'R', 'EI'],
                'full' => [
                    trans('imet-core::common.steps_eval.context'),
                    trans('imet-core::common.steps_eval.planning'),
                    trans('imet-core::common.steps_eval.inputs'),
                    trans('imet-core::common.steps_eval.process'),
                    trans('imet-core::common.steps_eval.outputs'),
                    trans('imet-core::common.steps_eval.outcomes'),
                ]
            ],
            Imet\Imet::IMET_V2 => [
                'abbreviations' => ['C', 'P', 'I', 'PR', 'OP', 'OC'],
                'full' => [
                    trans('imet-core::common.steps_eval.context'),
                    trans('imet-core::common.steps_eval.planning'),
                    trans('imet-core::common.steps_eval.inputs'),
                    trans('imet-core::common.steps_eval.process'),
                    trans('imet-core::common.steps_eval.outputs'),
                    trans('imet-core::common.steps_eval.outcomes'),
                ]
            ],
            Imet\Imet::IMET_OECM => [
                'abbreviations' => ['C', 'P', 'I', 'PR', 'OP', 'OC'],
                'full' => [
                    trans('imet-core::common.steps_eval.context'),
                    trans('imet-core::common.steps_eval.planning'),
                    trans('imet-core::common.steps_eval.inputs'),
                    trans('imet-core::common.steps_eval.process'),
                    trans('imet-core::common.steps_eval.outputs'),
                    trans('imet-core::common.steps_eval.outcomes'),
                ]
            ],
        ];
    }

    /**
     * Return score's labels
     */
    public static function get_scores_labels(string $version, $locale = null): array
    {
        $current_locale = App::getLocale();
        if(Str::upper($locale)!==Str::upper($current_locale)){
            App::setLocale($locale);
        }

        // Labels per each module
        $step_labels = [];
        $all_modules = $version===Imet\Imet::IMET_V2 || $version===Imet\Imet::IMET_V1
            ? Imet\v2\Imet_Eval::allModules() // v1 & v2 are sharing the same labels - due to V1ToV2Scores compatibility layer
            : Imet\oecm\Imet_Eval::allModules();
        foreach ($all_modules as $module){
            $code = Str::replace(['.', '/'], '', (new $module)->module_code);
            $step_labels[$code] = (new $module)->module_title;
        }

        // Global scores
        $global_labels =  array_combine(
            [_Scores::CONTEXT, _Scores::PLANNING, _Scores::INPUTS, _Scores::PROCESS, _Scores::OUTPUTS, _Scores::OUTCOMES],
            static::all_labels()[$version]['full']
        );

        // Custom scores
        $custom_labels = [];
        foreach (trans('imet-core::'.$version.'_common.assessment') as $code => $item){
            $custom_labels[$code] = $item;
        }

        App::setLocale($current_locale);

        return array_merge($global_labels, $step_labels, $custom_labels);
    }

}