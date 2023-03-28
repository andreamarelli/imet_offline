<?php

namespace AndreaMarelli\ImetCore\Models\Imet\API\Assessment;


use AndreaMarelli\ImetCore\Models\Animal;

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\GeneralInfo;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\Areas;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use Illuminate\Support\Facades\Lang;
use AndreaMarelli\ImetCore\Models\Imet\v2\Report;
use Illuminate\Support\Str;


class ReportV2 extends ReportV1
{

    protected static string $report_class = Report::class;
    protected static string $general_info_class = GeneralInfo::class;
    protected static string $areas_class = Areas::class;

    /**
     * @param int $form_id
     * @return array
     */
    protected static function get_key_elements(int $form_id): array
    {
        return [
            'species' => Modules\Evaluation\ImportanceSpecies::getModule($form_id)->filter(function ($item) {
                return $item['IncludeInStatistics'];
            })->pluck('Aspect')->map(function ($item) {
                return Str::contains('|', $item) ? Animal::getByTaxonomy($item)->binomial : $item;
            })->toArray(),
            'habitats' => Modules\Evaluation\ImportanceHabitats::getModule($form_id)->filter(function ($item) {
                return $item['IncludeInStatistics'];
            })->pluck('Aspect')->toArray(),
            'climate_change' => Modules\Evaluation\ImportanceClimateChange::getModule($form_id)->filter(function ($item) {
                return $item['IncludeInStatistics'];
            })->pluck('Aspect')->toArray(),
            'ecosystem_services' => Modules\Evaluation\ImportanceEcosystemServices::getModule($form_id)->filter(function ($item) {
                return $item['IncludeInStatistics'];
            })->pluck('Aspect')->toArray(),
            'threats' => Modules\Evaluation\Menaces::getModule($form_id)->filter(function ($item) {
                return $item['IncludeInStatistics'];
            })->pluck('Aspect')->toArray(),
        ];
    }

    /**
     * @return array
     */
    protected static function get_labels(): array
    {
        $general_info_labels = trans('imet-core::v2_context.GeneralInfo.fields');
        $steps_eval_labels = trans('imet-core::v2_common.steps_eval');
        $mission_labels = Lang::get('imet-core::v2_context.Missions.fields');
        $assessment_labels = Lang::get('imet-core::analysis_report.assessment');

        unset($general_info_labels['WDPA']);
        unset($steps_eval_labels['objectives']);
        unset($steps_eval_labels['management_effectiveness']);
        unset($steps_eval_labels['general_info']);
        unset($assessment_labels['ctx101']);
        unset($assessment_labels['ctx102']);

        return array_merge($steps_eval_labels, $general_info_labels, $mission_labels, $assessment_labels);
    }

}
