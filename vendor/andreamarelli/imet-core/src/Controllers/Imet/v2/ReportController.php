<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\v2;

use AndreaMarelli\ImetCore\Controllers\Imet\ReportController as BaseReportController;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;
use AndreaMarelli\ImetCore\Models\Animal;
use AndreaMarelli\ImetCore\Services\Scores\ImetScores;
use AndreaMarelli\ModularForms\Helpers\API\DOPA\DOPA;
use Illuminate\Support\Str;
use ReflectionException;


class ReportController extends BaseReportController
{
    protected static $form_class = Imet::class;
    protected static $form_view_prefix = 'imet-core::v2.report';

    /**
     * Retrieve data to populate report view
     * @throws ReflectionException
     */
    protected function __retrieve_report_data(Imet $item): array
    {
        $form_id = $item->getKey();

        $api_available = $show_api = false;
        $wdpa_extent = $dopa_radar = $dopa_indicators = null;

        if (!ProtectedAreaNonWdpa::isNonWdpa($item->wdpa_id)) {
            $show_api = true;
            $api_available = DOPA::apiAvailable();
            if ($api_available) {
                $wdpa_extent = [];
                $dopa_radar = DOPA::get_wdpa_radarplot($item->wdpa_id, true);
                $dopa_indicators = DOPA::get_wdpa_all_inds($item->wdpa_id);
            }
        } else {
            $show_non_wdpa = true;
            $non_wdpa = ProtectedAreaNonWdpa::find($item->wdpa_id)->toArray();
        }

        $general_info = Modules\Context\GeneralInfo::getModuleRecords($form_id);
        $vision = Modules\Context\Missions::getModuleRecords($form_id);
        return [
            'item' => $item,
            'key_elements' => [
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
            ],
            'scores' => ImetScores::get_all($item),
            'labels' => ImetScores::indicators_labels(\AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_V2),
            'report' => \AndreaMarelli\ImetCore\Models\Imet\v2\Report::getByForm($form_id),
            'connection' => $api_available,
            'show_api' => $show_api,
            'wdpa_extent' => $wdpa_extent[0]->extent ?? null,
            'dopa_radar' => $dopa_radar,
            'dopa_indicators' => $dopa_indicators[0] ?? null,
            'show_non_wdpa' => $show_non_wdpa ?? false,
            'non_wdpa' => $non_wdpa ?? null,
            'general_info' => $general_info[0] ?? null,
            'vision' => $vision['records'][0] ?? null,
            'area' => Modules\Context\Areas::getArea($form_id)
        ];
    }


}
