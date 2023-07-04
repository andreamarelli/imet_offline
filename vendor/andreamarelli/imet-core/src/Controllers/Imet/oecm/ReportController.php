<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\oecm;

use AndreaMarelli\ImetCore\Controllers\Imet\ReportController as BaseReportController;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\KeyElements;
use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use AndreaMarelli\ImetCore\Services\Statistics\OEMCStatisticsService;
use AndreaMarelli\ModularForms\Helpers\API\DOPA\DOPA;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Report;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mod;

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

        $show_non_wdpa = false;
        $stake_holders = ['direct' => [], 'indirect' => []];
        $planning_objectives_list = ['long' => [], 'short' => []];


        if (ProtectedAreaNonWdpa::isNonWdpa($item->wdpa_id)) {
            $show_non_wdpa = true;
            $non_wdpa = ProtectedAreaNonWdpa::find($item->wdpa_id)->toArray();
        }

        $governance = Modules\Context\Governance::getModuleRecords($form_id);
        $general_info = Modules\Context\GeneralInfo::getVueData($form_id);
        $vision = Modules\Context\Missions::getModuleRecords($form_id);
        $key_elements_impacts = Modules\Evaluation\KeyElementsImpact::getModuleRecords($form_id);
        $scores = OEMCStatisticsService::get_scores($form_id, 'ALL');
        $stake_holders['direct'] = array_count_values(array_map('strtolower', Modules\Context\Stakeholders::getStakeholders($form_id, Modules\Context\Stakeholders::ONLY_DIRECT)));
        $stake_holders['indirect'] = array_count_values(array_map('strtolower', Modules\Context\Stakeholders::getStakeholders($form_id, Modules\Context\Stakeholders::ONLY_INDIRECT)));

        $planning_objectives = Modules\Evaluation\ObjectivesPlanification::getModule($form_id)->toArray();

        foreach ($planning_objectives as $record) {
            $planning_objectives_list[$record['ShortOrLongTerm']][] = $record['Element'];
        }

        $stake_analysis['direct'] = Modules\Context\AnalysisStakeholderDirectUsers::getAnalysisElements($form_id);
        $stake_analysis['indirect'] = Modules\Context\AnalysisStakeholderIndirectUsers::getAnalysisElements($form_id);

        $trend_and_threats = collect(Modules\Evaluation\ThreatsIntegration::getModuleRecords($form_id)['records'])
            ->toArray();

        uasort($trend_and_threats, function ($a, $b) {
            if ($a['__score'] == $b['__score']) {
                return 0;
            }
            return ($a['__score'] > $b['__score']) ? -1 : 1;
        });

        $key_elements = collect(Modules\Evaluation\KeyElements::getModuleRecords($form_id)['records'])
            ->filter(function ($item) {
                return $item['IncludeInStatistics'];
            })
            ->toArray();
        uasort($key_elements, function ($a, $b) {
            if ($a['Importance'] == $b['Importance']) {
                return 0;
            }
            return ($a['Importance'] > $b['Importance']) ? -1 : 1;
        });
        //dd(Report::getByForm($form_id));
        return [
            'item' => $item,
            'planning_objectives' => $planning_objectives_list,
            'main_threats' => $trend_and_threats,
            'key_elements' => array_values($key_elements),
            'key_elements_impacts' => $key_elements_impacts['records'],
            'stake_holders' => $stake_holders,
            'stake_analysis' => array_merge($stake_analysis['direct'], $stake_analysis['indirect']),
            'assessment' => array_merge(
                $scores,
                [
                    'labels' => OEMCStatisticsService::indicators_labels(\AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_OECM)
                ]
            ),
            'report' => Report::getByForm($form_id),
            'report_schema' => Report::getSchema(),
            'show_non_wdpa' => $show_non_wdpa ?? false,
            'non_wdpa' => $non_wdpa ?? null,
            'general_info' => $general_info['records'][0] ?? null,
            'vision' => $vision['records'][0] ?? null,
            'governance' => $governance['records'][0] ?? null,
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
