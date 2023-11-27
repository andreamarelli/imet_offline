<?php

namespace AndreaMarelli\ImetCore\Services\Reports;


use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Component\ImetModule_Eval;


class OECM
{
    /**
     * @param int $form_id
     * @return array
     */
    public static function getElementImpacts(int $form_id): array
    {
        //dd(Modules\Evaluation\KeyElementsImpact::getModuleRecords($form_id)['records']);
        return array_map(function ($item) {
            ($item);
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
    public static function getStakeholderDirectIndirect(int $form_id): array
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
    public static function getStakeAnalysis(int $form_id): array
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

    /***
     * @param $form_id
     * @param $key_elements
     * @return array
     */
    public static function getBiodiversityGlobalThreats($form_id, $key_elements): array
    {
        $global_threats = array_filter(static::getThreatsIntegration($form_id), function ($item) {
            return $item['IncludeInStatistics'] !== null;
        });

        $integration_threats = array_filter($key_elements, function ($item) {
            return $item['group_key'] === 'group1';
        });

        $chart_integration = static::getChartValues($integration_threats, 'Aspect');
        $chart_global = static::getChartValues($global_threats, 'Threat');


        return ['global' => $chart_global, 'integration' => $chart_integration];
    }

    /**
     * @param array $values
     * @param string $label
     * @return array
     */
    private static function getChartValues(array $values, string $label): array
    {
        $fields = [];
        uasort($values, function ($a, $b) {

            if ($a['__score'] == $b['__score']) {
                return 0;
            }
            return ($a['__score'] > $b['__score']) ? -1 : 1;
        });

        foreach ($values as $k => $value) {
            if ($value['__score'] !== null) {
                $fields[$value[$label]] = round($value['__score'], 2);
            } else {
                $fields[$value[$label]] = "-";
            }
        }

        return ['values' => $values, 'chart' => ['values' => (($fields))]];
    }

    /**
     * @param array $threats
     * @param bool $ecosystem
     * @return array
     */
    public static function getBiodiversityThreats(array $threats, bool $ecosystem = false): array
    {
        $fields = [];
        $score_field = $ecosystem ? 'Importance' : '__score';

        if ($ecosystem) {
            $threats = array_filter($threats, function ($item) {
                return $item['__group_stakeholders'] !== null;
            });
        } else {
            $threats = array_filter($threats, function ($item) {
                return $item['__group_stakeholders'] === null;
            });
        }

        uasort($threats, function ($a, $b) use ($score_field) {

            if ($a[$score_field] == $b[$score_field]) {
                return 0;
            }
            return ($a[$score_field] > $b[$score_field]) ? -1 : 1;
        });

        foreach ($threats as $k => $value) {
            if ($value[$score_field] !== null) {
                if (isset($fields[$value['Aspect']]) && $fields[$value['Aspect']] !== "-") {
                    $fields[$value['Aspect'] . ' ' . $value['Comments']] = round($value['__score'], 2);
                } else {
                    $fields[$value['Aspect']] = round($value[$score_field], 2);
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
    public static function getThreatsIntegration(int $form_id): array
    {
        return collect(Modules\Evaluation\ThreatsIntegration::getModuleRecords($form_id)['records'])
            ->toArray();
    }

    /**
     * @param int $form_id
     * @return array
     */
    public static function getThreats(int $form_id): array
    {
        $fields = [];
        $trend_and_threats = static::getThreatsIntegration($form_id);

        return static::getChartValues($trend_and_threats, 'Threat');
    }

    /**
     * @param array $values
     * @return array
     */
    public static function getKeyElementsEcosystems(array $values): array
    {
        return array_filter($values, function ($item) {
            return $item['__group_stakeholders'] !== null;
        });
    }

    /**
     * @param array $values
     * @return array
     */
    public static function getKeyElementsBiodiversity(array $values): array
    {
        return array_filter($values, function ($item) {
            return $item['__group_stakeholders'] === null;
        });
    }

    /**
     * @param int $form_id
     * @return array
     */
    public static function getKeyElements(int $form_id): array
    {
        return collect(Modules\Evaluation\KeyElements::getModuleRecords($form_id)['records'])
            ->filter(function ($item) {
                return $item['IncludeInStatistics'];
            })
            ->toArray();
    }

    /**
     * @param int $form_id
     * @return array
     */
    public static function getObjectives(int $form_id): array
    {

        $objectives = ['context' => [], 'evaluation' => []];
        $objectives['context'] = array_merge(
            static::objectivesSchema('context', 'obj1', Modules\Context\Objectives1::getModuleRecords($form_id)['records']),
            static::objectivesSchema('context', 'obj2', Modules\Context\Objectives2::getModuleRecords($form_id)['records']),
            static::objectivesSchema('context', 'obj3', Modules\Context\Objectives3::getModuleRecords($form_id)['records']),
            static::objectivesSchema('context', 'obj4', Modules\Context\Objectives4::getModuleRecords($form_id)['records']),
            static::objectivesSchema('context', 'obj5', Modules\Context\AnalysisStakeholdersObjectives::getModuleRecords($form_id)['records']),
            static::objectivesSchema('context', 'obj6', Modules\Context\StakeholdersObjectives::getModuleRecords($form_id)['records']));

        $objectives['evaluation'] = array_merge(
            static::objectivesSchema('evaluation', 'context', Modules\Evaluation\ObjectivesContext::getModuleRecords($form_id)['records']),
            static::objectivesSchema('evaluation', 'intrants', Modules\Evaluation\ObjectivesIntrants::getModuleRecords($form_id)['records']),
            static::objectivesSchema('evaluation', 'planning', Modules\Evaluation\ObjectivesPlanification::getModuleRecords($form_id)['records']),
            static::objectivesSchema('evaluation', 'process', Modules\Evaluation\ObjectivesProcessus::getModuleRecords($form_id)['records']),
        );
        return $objectives;
    }

    private static function objectivesSchema($index, $label, $items): array
    {
        $elements = [];
        foreach ($items as $key => $item) {
            if ($item["id"]) {
                $elements[$label . "_" . $item['ShortOrLongTerm'] . "_" . $index . "_" . $item["id"]] = $item["Element"];
            }
        }
        return $elements;
    }
}
