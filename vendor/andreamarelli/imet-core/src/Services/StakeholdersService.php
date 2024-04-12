<?php

namespace AndreaMarelli\ImetCore\Services;

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\AnalysisStakeholderDirectUsers;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\AnalysisStakeholderIndirectUsers;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\Stakeholders;

class StakeholdersService{

    /**
     * Retrieve all the stakeholders records (both direct and indirect)
     */
    public static function getAllRecords(int $form_id): array
    {
        $stakeholder_direct_records = collect(AnalysisStakeholderDirectUsers::getModuleRecords($form_id)['records'])
            ->map(function($item){
                $item['__mode'] = Stakeholders::ONLY_DIRECT;
                return $item;
            })
            ->toArray();
        $stakeholder_indirect_records = collect(AnalysisStakeholderIndirectUsers::getModuleRecords($form_id)['records'])
            ->map(function($item){
                $item['__mode'] = Stakeholders::ONLY_INDIRECT;
                return $item;
            })
            ->toArray();

        return array_merge($stakeholder_direct_records, $stakeholder_indirect_records);
    }

    public static function keyElementsByThreat($stakeholder_records): array
    {
        $threats = [];
        foreach ($stakeholder_records as $record) {
            if ($record['Element'] !== null && $record['Threats'] !== null) {
                foreach (json_decode($record['Threats']) as $threat) {
                    $threats[$threat] = $threats[$threat] ?? [
                        'stakeholders_direct' => [],
                        'stakeholders_indirect' => [],
                        'elements_legal' => [],
                        'elements_illegal' => [],
                    ];

                    // extract direct & indirect stakeholders arrays
                    if($record['__mode'] == Stakeholders::ONLY_DIRECT){
                        $threats[$threat]['stakeholders_direct'][] = $record['Stakeholder'];
                    } elseif($record['__mode'] == Stakeholders::ONLY_INDIRECT){
                        $threats[$threat]['stakeholders_indirect'][] = $record['Stakeholder'];
                    }

                    if($record['Illegal']) {
                        $threats[$threat]['elements_illegal'][$record['Element']] = $threats[$threat]['elements_illegal'][$record['Element']] ?? [];
                        $threats[$threat]['elements_illegal'][$record['Element']][] = $record['Description'];
                    } else {
                        $threats[$threat]['elements_legal'][$record['Element']] = $threats[$threat]['elements_legal'][$record['Element']] ?? [];
                        $threats[$threat]['elements_legal'][$record['Element']][] = $record['Description'];
                    }
                }
            }
        }

        $render_list = function ($elements) {
            $list = '';
            foreach ($elements as $elem_key => $spec_elements) {
                $list .= ''.$elem_key;
                if(count($spec_elements) > 0){
                    $list .= ' ('.implode(', ', $spec_elements).')';
                }
                $list .= ', ';
            }
            return rtrim($list, ', ');
        };

        foreach($threats as $idx => $threat){
            // render key elements lists
            $threats[$idx]['elements_legal_list'] = $render_list($threat['elements_legal']);
            $threats[$idx]['elements_illegal_list'] = $render_list($threat['elements_illegal']);
            // count stakeholders
            $threats[$idx]['count_stakeholders_direct'] = count($threat['stakeholders_direct']);
            $threats[$idx]['count_stakeholders_indirect'] = count($threat['stakeholders_indirect']);
            $threats[$idx]['count_stakeholders'] = $threats[$idx]['count_stakeholders_direct'] + $threats[$idx]['count_stakeholders_indirect'];
            unset($threats[$idx]['stakeholders_direct'], $threats[$idx]['stakeholders_indirect']);
        }

        return $threats;
    }

}