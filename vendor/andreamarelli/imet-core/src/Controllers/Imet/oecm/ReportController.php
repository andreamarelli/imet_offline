<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\oecm;

use AndreaMarelli\ImetCore\Controllers\Imet\ReportController as BaseReportController;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use AndreaMarelli\ImetCore\Services\Statistics\OEMCStatisticsService;
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
        $show_non_wdpa = false;

        if (ProtectedAreaNonWdpa::isNonWdpa($item->wdpa_id)) {
            $show_non_wdpa = true;
            $non_wdpa = ProtectedAreaNonWdpa::find($item->wdpa_id)->toArray();
        }

        $governance = Modules\Context\Governance::getModuleRecords($form_id);
        $general_info = Modules\Context\GeneralInfo::getVueData($form_id);
        $scores = OEMCStatisticsService::get_scores($form_id, 'ALL');

        return [
            'item' => $item,
            'main_threats' => $this->getThreats($form_id),
            'key_elements_biodiversity' => array_values($this->getKeyElements($form_id)),
            'key_elements_ecosystem' => array_values($this->getKeyElements($form_id, true)),
            'key_elements_impacts' => $this->getElementImpacts($form_id)['records'],
            'stake_holders' => $this->getStakeholderDirectIndirect($form_id),
            'stake_analysis' => $this->getStakeAnalysis($form_id),
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
            'governance' => $governance['records'][0] ?? null,
            'area' => Modules\Context\Areas::getArea($form_id)
        ];
    }

    /**
     * @param int $form_id
     * @return array
     */
    private function getElementImpacts(int $form_id): array
    {
        return Modules\Evaluation\KeyElementsImpact::getModuleRecords($form_id);
    }

    /**
     * @param int $form_id
     * @return array[]
     */
    private function getStakeholderDirectIndirect(int $form_id): array
    {
        $stake_holders = ['direct' => [], 'indirect' => []];
        $stake_holders['direct'] = (Modules\Context\Stakeholders::calculateWeights($form_id, Modules\Context\Stakeholders::ONLY_DIRECT));
        $stake_holders['indirect'] = (Modules\Context\Stakeholders::calculateWeights($form_id, Modules\Context\Stakeholders::ONLY_INDIRECT));

        arsort($stake_holders['direct']);
        arsort($stake_holders['indirect']);

        return $stake_holders;
    }

    /**
     * @param int $form_id
     * @return array[]
     */
    private function getStakeAnalysis(int $form_id): array
    {
        $direct = Modules\Context\AnalysisStakeholderDirectUsers::getAnalysisElements($form_id);
        $indirect = Modules\Context\AnalysisStakeholderIndirectUsers::getAnalysisElements($form_id);
        $items = array_merge($direct, $indirect);
        $biodiversity = [];
        $ecosystem = [];
        foreach ($items as $key => $value) {
            if (in_array($key, ['group11', 'group12', 'group13'])) {
                $biodiversity[$key] = $value;
            } else {
                $ecosystem[$key] = $value;
            }
        }

        return ['key_biodiversity_elements' => $biodiversity, 'ecosystem_services' => $ecosystem];
    }

    /**
     * @param int $form_id
     * @return array
     */
    private function getThreats(int $form_id): array
    {
        $fields = [];
        $colors = [];
        $trend_and_threats = collect(Modules\Evaluation\ThreatsIntegration::getModuleRecords($form_id)['records'])
            ->toArray();

        uasort($trend_and_threats, function ($a, $b) {

            if ($a['__score'] == $b['__score']) {
                return 0;
            }
            return ($a['__score'] > $b['__score']) ? -1 : 1;
        });

        foreach ($trend_and_threats as $k => $value) {
            if ($value['__score'] !== null && !isset($fields[$value['Threat']])) {
                $fields[$value['Threat']] = round($value['__score'], 2);
                $colors['#C23531'] = [];
            }
        }

        return ['values' => $trend_and_threats, 'chart' => ['fields' => json_encode(array_keys($fields)),
            'values' => json_encode(array_values($fields)), 'colors' => json_encode(array_keys($colors))]];
    }

    /**
     * @param int $form_id
     * @param bool $ecosystem
     * @return array
     */
    private function getKeyElements(int $form_id, bool $ecosystem = false): array
    {
        $key_elements = collect(Modules\Evaluation\KeyElements::getModuleRecords($form_id)['records'])
            ->filter(function ($item) {
                return $item['IncludeInStatistics'];
            })
            ->toArray();


        return array_filter($key_elements, function ($item) use ($ecosystem) {
            $where_to_search = [
                trans('imet-core::oecm_context.AnalysisStakeholders.groups.group11'),
                trans('imet-core::oecm_context.AnalysisStakeholders.groups.group12'),
                trans('imet-core::oecm_context.AnalysisStakeholders.groups.group13')
            ];
            if (!isset($item['__group_stakeholders'])) {
                return false;
            }
            return !$ecosystem ? in_array($item['__group_stakeholders'], $where_to_search) : !in_array($item['__group_stakeholders'], $where_to_search);
        });

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
