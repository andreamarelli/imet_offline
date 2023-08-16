<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\Animal;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;
use Illuminate\Support\Str;

abstract class _AnalysisStakeholders extends Modules\Component\ImetModule
{
    public static $USER_MODE;

    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $form_id = $empty_record['FormID'];

        // retrieve stakeholders
        $stakeholders = Stakeholders::getStakeholders($form_id, static::$USER_MODE, true);

        // Add at least a record (empty) for each group (related to selected categories) per stakeholder
        $groups = array_keys(trans('imet-core::oecm_context.AnalysisStakeholders.groups'));
        foreach ($stakeholders as $stakeholder => $stakeholder_categories) {
            $stakeholder_categories = json_decode($stakeholder_categories);
            $stakeholder_categories = $stakeholder_categories!==null ? $stakeholder_categories : [];
            foreach ($groups as $group) {

                if(
                    in_array('provisioning', $stakeholder_categories) && in_array($group, ['group0', 'group1', 'group2', 'group3']) ||
                    in_array('cultural', $stakeholder_categories) && in_array($group, ['group4', 'group5', 'group6' ]) ||
                    in_array('regulating', $stakeholder_categories) && in_array($group, ['group7', 'group8']) ||
                    in_array('supporting', $stakeholder_categories) && in_array($group, ['group9', 'group10'])
                ){

                    // Find a record for the given stakeholder/group
                    $found = false;
                    foreach ($records as $record) {
                        if ($record['group_key'] === $group
                            && $record['Stakeholder'] === $stakeholder) {
                            $found = true;
                        }
                    }
                    // if record not found force an empty one
                    if (!$found) {
                        $record = $empty_record;
                        $record['__predefined'] = false;
                        $record['group_key'] = $group;
                        $record['Stakeholder'] = $stakeholder;
                        $records[] = $record;
                    }
                }
            }
        }
        return $records;
    }

    abstract static function calculateKeyElementImportance($item): ?float;

    public static function calculateKeyElementsImportances($form_id, $records = null): array
    {
        $records = $records ?? static::getModuleRecords($form_id)['records'];

        $weights = Modules\Context\Stakeholders::calculateWeights($form_id, static::$USER_MODE);
        $weights_sum = array_sum($weights);
        $weights_div = $weights_sum > 0 ?
            collect($weights)
                ->map(function ($item) use ($weights_sum) {
                    return $item / $weights_sum;
                })
                ->toArray()
            : null;

        return collect($records)
            ->map(function ($item) use ($weights_div) {
                // Retrieve Stakeholders weights
                $item['__stakeholder_weight'] = $weights_div[$item['Stakeholder']] ?? null;
                // Retrieve weighted importance per each record
                $item['__weighted_importance'] = static::calculateKeyElementImportance($item);
                return $item;
            })
            ->filter(function ($item) {
                return $item['__weighted_importance'] != null;
            })
            ->groupBy('Element')
            ->map(function ($group_element) {

                // Average importance if same stakeholder encode same element multiple times
                $group_element = $group_element
                    ->groupBy('Stakeholder')
                    ->map(function ($group_stakeholder) {
                        $importance = $group_stakeholder
                            ->map(function ($item) {
                                return $item['__weighted_importance'];
                            })
                            ->average();
                        return [
                            'Element' => $group_stakeholder[0]['Element'],
                            'Stakeholder' => $group_stakeholder[0]['Stakeholder'],
                            'group_key' => $group_stakeholder[0]['group_key'],
                            'FormID' => $group_stakeholder[0]['FormID'],
                            '__stakeholder_weight' => $group_stakeholder[0]['__stakeholder_weight'],
                            '__weighted_importance' => $importance
                        ];
                    });

                // Aggregate importance on element
                $importance = $group_element
                    ->map(function ($item) {
                        return $item['__weighted_importance'];
                    })
                    ->sum();

                // Count how many stakeholders encoded the element
                $stakeholder_count = $group_element->count();

                return [
                    'element' => $group_element->first()['Element'],
                    'importance' => round($importance, 1),
                    'stakeholder_count' => $stakeholder_count,
                    'group' => trans('imet-core::oecm_context.AnalysisStakeholders.groups.' . $group_element->first()['group_key'])
                ];
            })
            ->sortByDesc('importance')
            ->values()
            ->toArray();
    }

    public static function getNumStakeholdersElementsByThreat($form_id): array
    {
        $records = $records ?? static::getModuleRecords($form_id)['records'];

        $threats = [];
        foreach ($records as $record) {
            if ($record['Element'] !== null && $record['Threats'] !== null) {
                foreach (json_decode($record['Threats']) as $threat) {
                    if (!array_key_exists($threat, $threats)) {
                        $threats[$threat] = [
                            'stakeholders' => [],
                            'elements' => [],
                            'elements_illegal' => [],
                        ];
                    }
                    $threats[$threat]['stakeholders'][] = $record['Stakeholder'];

                    if (!array_key_exists($record['group_key'], $threats[$threat]['elements'])) {
                        $threats[$threat]['elements'][$record['group_key']] = [];
                    }
                    if (!array_key_exists($record['group_key'], $threats[$threat]['elements_illegal'])) {
                        $threats[$threat]['elements_illegal'][$record['group_key']] = [];
                    }

                    if ($record['Illegal']) {
                        $threats[$threat]['elements_illegal'][$record['group_key']][] = $record['Description'] ?? $record['Element'];
                    } else {
                        $threats[$threat]['elements'][$record['group_key']][] = $record['Description'] ?? $record['Element'];
                    }

                }
            }
        }
        return $threats;
    }

    public static function getAnalysisElements($form_id): array
    {
        $records = $records ?? static::getModuleRecords($form_id)['records'];

        $items = [];
        foreach ($records as $record) {
            if ($record['Element'] !== null) {
                $element = $record['Element'];
                if (!isset($items[$element])) {
                    $items[$element] = [];
                }
                if ($record['Description'] !== null) {
                    $items[$element][] = $record['Description'];
                }
            }
        }
        return $items;
    }
}
