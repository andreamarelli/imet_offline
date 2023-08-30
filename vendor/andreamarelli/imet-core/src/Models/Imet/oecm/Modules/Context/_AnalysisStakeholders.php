<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ImetCore\Models\User\Role;

abstract class _AnalysisStakeholders extends Modules\Component\ImetModule
{
    public $titles = [];

    protected static $DEPENDENCY_ON = 'Stakeholder';
    protected static $DEPENDENCIES = [
        [Modules\Evaluation\KeyElements::class, 'Element']
    ];

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_HIGH;

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

    public static function calculateKeyElementsImportancesByUserMode($form_id, $weights, $records = null): array
    {
        $records = $records ?? static::getModuleRecords($form_id)['records'];

        return collect($records)
            ->map(function ($item) use ($weights) {
                // Retrieve Stakeholders weights
                $item['__stakeholder_weight'] = $weights[$item['Stakeholder']] ?? null;
                // Retrieve weighted importance per each record
                $item['__weighted_importance'] = static::calculateKeyElementImportance($item);
                return $item;
            })
            ->filter(function ($item) {
                return $item['__weighted_importance'] != null;
            })
            ->groupBy('Element')
            ->map(function ($group_element) {

//                // Retrieve lists of legal & illegal specific elements
//                $specific_elements_legal = $group_element
//                    ->filter(function($item){
//                        return $item['Illegal'] == false;
//                    })
//                    ->pluck('Description')
//                    ->toArray();
//
//                $specific_elements_illegal = $group_element
//                    ->filter(function($item){
//                        return $item['Illegal'] == true;
//                    })
//                    ->pluck('Description')
//                    ->toArray();

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
//                    'specific_elements_legal' => $specific_elements_legal,
//                    'specific_elements_illegal' => $specific_elements_illegal,
                    'importance' => round($importance, 1),
                    'stakeholder_count' => $stakeholder_count,
                    'group' => trans('imet-core::oecm_context.AnalysisStakeholders.groups.' . $group_element->first()['group_key'])
                ];
            })
            ->sortByDesc('importance')
            ->values()
            ->toArray();
    }

    private static function retrieveStakeholdersWeights($form_id): ?array
    {
        $weights = Modules\Context\Stakeholders::calculateWeights($form_id, Stakeholders::ALL_USERS);
        $weights_sum = array_sum($weights);
        return $weights_sum > 0 ?
            collect($weights)
                ->map(function ($item) use ($weights_sum) {
                    return $item / $weights_sum;
                })
                ->toArray()
            : null;
    }

    public static function calculateKeyElementsImportances($form_id, $records = null): array
    {
        $records = $records ?? static::getModuleRecords($form_id)['records'];
        $weights = static::retrieveStakeholdersWeights($form_id);

        if(static::$USER_MODE === Stakeholders::ONLY_DIRECT){
            $key_elements_importance_direct = static::calculateKeyElementsImportancesByUserMode($form_id, $weights, $records);
            $key_elements_importance_indirect = AnalysisStakeholderIndirectUsers::calculateKeyElementsImportancesByUserMode($form_id, $weights);
        } else {
            $key_elements_importance_direct = AnalysisStakeholderDirectUsers::calculateKeyElementsImportancesByUserMode($form_id, $weights);
            $key_elements_importance_indirect = static::calculateKeyElementsImportancesByUserMode($form_id, $weights, $records);
        }

        $key_elements_importance_direct = collect($key_elements_importance_direct)
            ->map(function ($item){
                $item['importance_direct'] = $item['importance'];
                $item['stakeholder_direct_count'] = $item['stakeholder_count'];
                unset($item['importance'], $item['stakeholder_count']);
               return $item;
            })
            ->mapWithKeys(function ($item) {
                return [$item['element'] => $item];
            });;
        $key_elements_importance_indirect = collect($key_elements_importance_indirect)
            ->map(function ($item){
                $item['importance_indirect'] = $item['importance'];
                $item['stakeholder_indirect_count'] = $item['stakeholder_count'];
                unset($item['importance'], $item['stakeholder_count']);
               return $item;
            })
            ->mapWithKeys(function ($item) {
                return [$item['element'] => $item];
            });

        // merge
        $key_elements_importances = $key_elements_importance_direct;
        $key_elements_importance_indirect->each(function($item, $key) use($key_elements_importances){
            $key_elements_importances[$key] = $key_elements_importances->has($key)
                ? array_merge($key_elements_importances[$key], $item)
                : $item;
        });

        // Sum importances & counts
        $key_elements_importances = $key_elements_importances->map(function ($item){
            $item['importance_direct'] = $item['importance_direct'] ?? 0;
            $item['importance_indirect'] = $item['importance_indirect'] ?? 0;
            $item['stakeholder_direct_count'] = $item['stakeholder_direct_count'] ?? 0;
            $item['stakeholder_indirect_count'] = $item['stakeholder_indirect_count'] ?? 0;

            $item['importance'] = $item['importance_direct'] + $item['importance_indirect'];
            $item['stakeholder_count'] = $item['stakeholder_direct_count'] + $item['stakeholder_indirect_count'];
            return $item;
        });

        // rescale to 0-100
        $max_importance = $key_elements_importances->max('importance');
        $key_elements_importances = $key_elements_importances->map(function ($item) use($max_importance){
            $item['importance_direct'] = round($item['importance_direct']*100/$max_importance, 1);
            $item['importance_indirect'] = round($item['importance_indirect']*100/$max_importance, 1);
            $item['importance'] = round($item['importance']*100/$max_importance, 1);
            return $item;
        });

        return collect($key_elements_importances)
            ->sortByDesc('importance')
            ->values()
            ->toArray();
    }

    public static function getAnalysisElements($form_id): array
    {
        $records = $records ?? static::getModuleRecords($form_id)['records'];

        $items = [];
        foreach ($records as $record) {

            if ($record['Element'] !== null) {
                $category = $record['group_key'];
                if(!isset($items[$category])){
                    $items[$category] = [];
                }
                $element = $record['Element'];
                if (!isset($items[$category][$element])) {
                    $items[$category][$element] = ['elements' => []];
                }

                if ($record['Description'] !== null) {
                    $items[$category][$element]['elements'][] = $record['Description'];
                }
            }
        }

        return $items;
    }
}
