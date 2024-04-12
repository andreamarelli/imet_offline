<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\oecm;

use AndreaMarelli\ImetCore\Controllers\Imet\ReportController as BaseReportController;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Report;
use AndreaMarelli\ImetCore\Services\Scores\OecmScores;
use Illuminate\Http\Request;
use AndreaMarelli\ImetCore\Services\Reports\OECM;

class ReportController extends BaseReportController
{
    protected static $form_class = Imet::class;
    protected static $form_view_prefix = 'imet-core::oecm.report';

    /**
     * Retrieve data to populate report view
     */
    protected function __retrieve_report_data(Imet $item): array
    {
        $form_id = $item->getKey();
        $show_non_wdpa = false;

        if (ProtectedAreaNonWdpa::isNonWdpa($item->wdpa_id)) {
            $show_non_wdpa = true;
            $non_wdpa = ProtectedAreaNonWdpa::find($item->wdpa_id)->toArray();
        }

        $governance = Modules\Context\Governance::getModuleRecords($form_id);
        $key_elements = OECM::getKeyElements($form_id);
        $records = Modules\Evaluation\KeyElements::getModuleRecords($form_id)['records'];
        $threats = collect($records)
            ->toArray();

        return [
            'item' => $item,
            'main_threats' => OECM::getThreats($form_id),
            'key_elements_ecosystem_charts' => OECM::getBiodiversityThreats($threats, true),
            'key_elements_biodiversity_charts' => OECM::getBiodiversityThreats($threats),
            'key_elements_biodiversity_charts_global' => OECM::getBiodiversityGlobalThreats($form_id, $key_elements),
            'key_elements_biodiversity' => array_values(OECM::getKeyElementsBiodiversity($key_elements)),
            'key_elements_ecosystem' => array_values(OECM::getKeyElementsEcosystems($key_elements)),
            'key_elements_impacts' => OECM::getElementImpacts($form_id),
            'stake_holders' => OECM::getStakeholderDirectIndirect($form_id),
            'stake_analysis' => OECM::getStakeAnalysis($form_id),
            'objectives' => OECM::getObjectives($form_id),
            'assessment' => array_merge(
                OecmScores::get_all($form_id),
                [
                    'labels' => OecmScores::indicators_labels(\AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_OECM)
                ]
            ),
            'report' => Report::getByForm($form_id),
            'report_schema' => Report::getSchema(),
            'show_non_wdpa' => $show_non_wdpa ?? false,
            'non_wdpa' => $non_wdpa ?? null,
            'governance' => $governance['records'][0] ?? null,
            'area' => Modules\Context\Areas::getArea($form_id),
            'form_id' => $form_id
        ];
    }

    /**
     * @param int $form_id
     * @return array[]
     */
    public function get_objectives(int $form_id): array
    {
        return OECM::get_objectives($form_id);
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
