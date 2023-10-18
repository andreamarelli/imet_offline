<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet\oecm;

use AndreaMarelli\ImetCore\Controllers\Imet\ReportController as BaseReportController;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Evaluation\Threats;
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
        $scores = OEMCStatisticsService::get_scores($form_id, 'ALL', false);
        if(is_cache_scores_enabled()) {
            $this->report_cache_scores($form_id, $scores);
        }
        $key_elements = $this->getKeyElements($form_id);
       // dd($this->getBiodiversityThreats($form_id));
        return [
            'item' => $item,
            'main_threats' => $this->getThreats($form_id),
            'key_elements' => $this->getBiodiversityThreats($form_id),
            'key_elements_biodiversity' => array_values($this->getKeyElementsBiodiversity($key_elements)),
            'key_elements_ecosystem' => array_values($this->getKeyElementsEcosystems($key_elements)),
            'key_elements_impacts' => $this->getElementImpacts($form_id),
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

        return array_map(function ($item) {
            $effects = ['EffectSH', 'EffectER'];
            $item['average'] = "";
            $total_effect = 0;
            $total_effect_length = 0;
            foreach ($effects as $effect) {
                if ($item[$effect] !== null) {
                    $total_effect += $item[$effect];
                    $total_effect_length++;
                }
            }
            if ($total_effect_length > 0) {
                $item['average'] = $total_effect / $total_effect_length;
            }
            return $item;

        },
            Modules\Evaluation\KeyElementsImpact::getModuleRecords($form_id)['records']);
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
        $ecosystem = [];
        foreach ($items as $key => $value) {
            $ecosystem[$key] = $value;
        }

        return ['ecosystem_services' => $ecosystem];
    }

    private function getBiodiversityThreats(int $form_id): array{
        $fields = [];
        $threats = collect(Modules\Evaluation\KeyElements::getModuleRecords($form_id)['records'])
            ->toArray();

        uasort($threats, function ($a, $b) {

            if ($a['__score'] == $b['__score']) {
                return 0;
            }
            return ($a['__score'] > $b['__score']) ? -1 : 1;
        });

        foreach ($threats as $k => $value) {
            if ($value['__score'] !== null) {
                if(isset($fields[$value['Aspect']]) && $fields[$value['Aspect']] !== "-"){
                    $fields[$value['Aspect'].' '.$value['Comments']] = round($value['__score'], 2);
                } else {
                    $fields[$value['Aspect']] = round($value['__score'], 2);
                }
            } else {
                $fields[$value['Aspect']] = "-";
            }
        }

        return ['values' => $threats, 'chart' => ['values' => (($fields))]];
    }

    /**
     * @param int $form_id
     * @return array
     */
    private function getThreats(int $form_id): array
    {
        $fields = [];
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
            } else {
                $fields[$value['Threat']] = "-";
            }
        }

        return ['values' => $trend_and_threats, 'chart' => ['values' => (($fields))]];
    }

    /**
     * @param array $values
     * @return array
     */
    private function getKeyElementsEcosystems(array $values): array
    {
        return array_filter($values, function ($item) {
            return  $item['__group_stakeholders'] !== null;
        });
    }

    /**
     * @param array $values
     * @return array
     */
    private function getKeyElementsBiodiversity(array $values): array
    {
        return array_filter($values, function ($item) {
            return  $item['__group_stakeholders'] === null;
        });
    }

    /**
     * @param int $form_id
     * @param bool $ecosystem
     * @return array
     */
    private function getKeyElements(int $form_id, bool $ecosystem = false): array
    {
        return collect(Modules\Evaluation\KeyElements::getModuleRecords($form_id)['records'])
            ->filter(function ($item) {
                return $item['IncludeInStatistics'];
            })
            ->toArray();
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
