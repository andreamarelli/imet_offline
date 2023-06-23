<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\oecm;

use AndreaMarelli\ImetCore\Controllers\Imet\ReportController as BaseReportController;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use AndreaMarelli\ImetCore\Services\Statistics\OEMCStatisticsService;
use AndreaMarelli\ModularForms\Helpers\API\DOPA\DOPA;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Report;
use Illuminate\Http\Request;

class ReportController extends BaseReportController
{
    protected static $form_class = Imet::class;
    protected static $form_view_prefix = 'imet-core::oecm.report';

    /**
     * Retrieve data to populate report view
     *
     * @param $item
     * @return array
     * @throws \ReflectionException
     */
    protected function __retrieve_report_data($item): array
    {
        $form_id = $item->getKey();

        $api_available = $show_api = false;
        $dopa_radar = null;

        if (!ProtectedAreaNonWdpa::isNonWdpa($item->wdpa_id)) {
            $show_api = true;
            $api_available = DOPA::apiAvailable();
            if ($api_available) {
                $dopa_radar = DOPA::get_wdpa_radarplot($item->wdpa_id, true);
            }
        } else {
            $show_non_wdpa = true;
            $non_wdpa = ProtectedAreaNonWdpa::find($item->wdpa_id)->toArray();
        }

        $general_info = Modules\Context\GeneralInfo::getVueData($form_id);
        $vision = Modules\Context\Missions::getModuleRecords($form_id);
        $scores = OEMCStatisticsService::get_scores($form_id, 'ALL');

        $main_threats = [];
        $status = [];
        $planning_objectives_list = ['long' => [], 'short' => []];

        $planning_objectives = Modules\Evaluation\ObjectivesPlanification::getModule($form_id)->toArray();

        foreach ($planning_objectives as $record){
            $planning_objectives_list[$record['ShortOrLongTerm']][] = $record['Element'];
        }

        // TODO: to be reviewed
//        $trend_and_threats = Modules\Context\AnalysisStakeholderTrendsThreats::getModule($form_id)->toArray();
        $trend_and_threats = [];

        foreach ($trend_and_threats as $record) {
            if ($record['Status']) {
                $status[$record['Status']] = trans('imet-core::oecm_context.AnalysisStakeholderTrendsThreats.ratingLegend.Status')[$record['Status']];
            }
            if ($record['MainThreat']) {
                $label =  str_replace('"]','', str_replace('["','', $record['MainThreat']));
                $main_threats[$record['MainThreat']] = trans('imet-core::oecm_lists.MainThreat')[$label] ?? null;
            }
        }

        return [
            'item' => $item,
            'planning_objectives' => $planning_objectives_list,
            'main_threats' => $main_threats,
            'status' => $status,
            'key_elements' => Modules\Evaluation\KeyElements::getModule($form_id)->filter(function ($item) {
                return $item['IncludeInStatistics'];
            })->pluck('Aspect')->toArray(),
            'assessment' => array_merge(
                $scores,
                [
                    'labels' => OEMCStatisticsService::indicators_labels(\AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_OECM)
                ]
            ),
            'report' => Report::getByForm($form_id),
            'report_schema' => Report::getSchema(),
            'connection' => $api_available,
            'show_api' => $show_api,
            'dopa_radar' => $dopa_radar,
            'show_non_wdpa' => $show_non_wdpa ?? false,
            'non_wdpa' => $non_wdpa ?? null,
            'general_info' => $general_info['records'][0] ?? null,
            'vision' => $vision['records'][0] ?? null,
            'area' => Modules\Context\Areas::getArea($form_id)
        ];
    }

    /**
     * Manage "report" update route
     *
     * @param $item
     * @param \Illuminate\Http\Request $request
     * @return string[]
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function report_update($item, Request $request): array
    {
        $this->authorize('edit', (static::$form_class)::find($item));

        Report::updateByForm($item, $request->input('report'));
        return ['status' => 'success'];
    }
}
