<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\v1;

use AndreaMarelli\ImetCore\Controllers\Imet\ReportController as BaseReportController;
use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use AndreaMarelli\ImetCore\Services\Scores\ImetScores;
use AndreaMarelli\ModularForms\Helpers\API\DOPA\DOPA;
use AndreaMarelli\ImetCore\Models\Imet\v1\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v1\Modules;
use AndreaMarelli\ImetCore\Models\Animal;
use Illuminate\Support\Str;
use ReflectionException;


class ReportController extends BaseReportController
{
    protected static $form_class = Imet::class;
    protected static $form_view_prefix = 'imet-core::v1.report';

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
                $dopa_radar = DOPA::get_wdpa_radarplot($item->wdpa_id);
                $dopa_indicators = DOPA::get_wdpa_all_inds($item->wdpa_id);
            }
        } else {
            $show_non_wdpa = true;
            $non_wdpa = ProtectedAreaNonWdpa::find($item->wdpa_id)->toArray();
        }

        $general_info = Modules\Context\GeneralInfo::getVueData($form_id);
        $vision = Modules\Context\Missions::getModuleRecords($form_id);
        return [
            'item' => $item,
            'key_elements' => [
                'species' => Modules\Evaluation\ImportanceSpecies::getModule($form_id)
                    ->pluck('Aspect')->map(function ($item) {
                        return Str::contains('|', $item) ? Animal::getByTaxonomy($item)->binomial : $item;
                    })->toArray(),
                'habitats' => Modules\Evaluation\ImportanceHabitats::getModule($form_id)
                    ->pluck('Aspect')->toArray(),
                'climate_change' => Modules\Evaluation\ImportanceClimateChange::getModule($form_id)
                    ->pluck('Aspect')->toArray(),
                'ecosystem_services' => array_values(Modules\Evaluation\ImportanceEcosystemServices::getPredefined()['values']),
                'threats' => array_values(Modules\Evaluation\Menaces::getPredefined()['values'])
            ],
            'assessment' => array_merge(
                ImetScores::get_all($item),
                [
                    'labels' => ImetScores::indicators_labels(\AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_V1)
                ]
            ),
            'report' => \AndreaMarelli\ImetCore\Models\Imet\v1\Report::getByForm($form_id),
            'connection' => $api_available,
            'show_api' => $show_api,
            'wdpa_extent' => $wdpa_extent[0]->extent ?? null,
            'dopa_radar' => $dopa_radar,
            'dopa_indicators' => $dopa_indicators[0] ?? null,
            'show_non_wdpa' => $show_non_wdpa ?? false,
            'non_wdpa' => $non_wdpa ?? null,
            'general_info' => $general_info['records'][0] ?? null,
            'vision' => $vision['records'][0] ?? null,
            'area' => Modules\Context\Areas::getArea($form_id)
        ];
    }


}
