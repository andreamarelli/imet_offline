<?php

namespace AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context;

use AndreaMarelli\ImetCore\Models\Animal;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;
use Illuminate\Support\Str;

abstract class _AnalysisStakeholders extends Modules\Component\ImetModule
{
    protected static $USER_MODE;

    /**
     * Override: Inject predefined values and replicate for each stakeholder
     *
     * @param $predefined_values
     * @param $records
     * @param $empty_record
     * @return array
     */
    protected static function arrange_records($predefined_values, $records, $empty_record): array
    {
        $form_id = $empty_record['FormID'];

        // retrieve stakeholders
        $stakeholders = Stakeholders::getStakeholders($form_id, static::$USER_MODE);

        // Inject additional predefined values (last 3 groups) retrieved from CTX
        $predefined_values = (new static())->predefined_values;
        $predefined_values['values']['group11'] =
            Modules\Context\AnimalSpecies::getModule($form_id)
                ->filter(function ($item) {
                    return !empty($item['species']);
                })
                ->pluck('species')
                ->map(function ($item) {
                    return Str::contains($item, '|')
                        ? Animal::getScientificName($item)
                        : $item;
                })
                ->toArray();
        $predefined_values['values']['group12'] =
            Modules\Context\VegetalSpecies::getModule($form_id)
                ->filter(function ($item) {
                    return !empty($item['species']);
                })
                ->pluck('species')
                ->toArray();
        $predefined_values['values']['group13'] =
            Modules\Context\Habitats::getModule($form_id)
                ->filter(function ($item) {
                    return !empty($item['EcosystemType']);
                })
                ->pluck('EcosystemType')
                ->map(function ($item) {
                    $labels = SelectionList::getList('ImetOECM_Habitats');
                    return array_key_exists($item, $labels) ?
                        $labels[$item]
                        : null;
                })
                ->toArray();

        // Clean records (if nothing from DB)
        if (!empty($records)) {
            // ensure first record has id field (set to null if doesn't)
            if (!array_key_exists((new static())->primaryKey, $records[0])) {
                $records[0][(new static())->primaryKey] = null;
            }
            // ensure records are empty if the first record is empty (no id)
            if (count($predefined_values['values']) >= 1
                && count($records) == 1
                && $records[0][(new static())->primaryKey] == null
            ) {
                $records = [];
            }
        }

        // inject predefined values and replicate for each stakeholder
        $new_records = [];
        foreach ($stakeholders as $stakeholder) {
            foreach ($predefined_values['values'] as $g => $group) {
                foreach ($group as $predefined_value) {
                    $new_record = $empty_record;
                    foreach ($records as $r => $record) {
                        if ($record['Element'] == $predefined_value
                            && $record['group_key'] == $g
                            && $record['Stakeholder'] == $stakeholder) {
                            $new_record = $record;
                            unset($records[$r]);
                            break;
                        }
                    }
                    $new_record['Element'] = $predefined_value;
                    $new_record['group_key'] = $g;
                    $new_record['Stakeholder'] = $stakeholder;
                    $new_record['__predefined'] = true;
                    $new_records[] = $new_record;
                }
            }
        }

        // Add remaining records (without predefined)
        if (count($records) > 0) {
            foreach ($records as $r => $record) {
                $new_record = $record;
                $new_record['__predefined'] = false;
                $new_records[] = $record;
            }
        }

        // Add at least a record (empty) for each group per stakeholder
        $groups = array_keys(trans('imet-core::oecm_context.AnalysisStakeholders.groups'));
        foreach ($stakeholders as $stakeholder) {
            foreach ($groups as $group) {
                $found = false;
                foreach ($new_records as $record) {
                    if ($record['group_key'] === $group
                        && $record['Stakeholder'] === $stakeholder) {
                        $found = true;
                    }
                }
                if (!$found) {
                    $new_record = $empty_record;
                    $new_record['__predefined'] = false;
                    $new_record['group_key'] = $group;
                    $new_record['Stakeholder'] = $stakeholder;
                    $new_records[] = $new_record;
                }
            }
        }

        return $new_records;
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

                    if (in_array($record['group_key'], ['group11', 'group12', 'group13'])) {
                        $threats[$threat]['elements'][$record['group_key']][] = $record['Element'];
                    } else {
                        if ($record['Illegal']) {
                            $threats[$threat]['elements_illegal'][$record['group_key']][] = $record['Description'] ?? $record['Element'];
                        } else {
                            $threats[$threat]['elements'][$record['group_key']][] = $record['Description'] ?? $record['Element'];
                        }
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
