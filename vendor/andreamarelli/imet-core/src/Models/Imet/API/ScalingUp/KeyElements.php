<?php

namespace AndreaMarelli\ImetCore\Models\Imet\API\ScalingUp;


use AndreaMarelli\ImetCore\Models\Animal;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules;


trait KeyElements
{
    public static function get_key_elements_conservation($items): array
    {
        $api = [];
        $labels = [
            'species' =>
                [
                    'animal_species' => trans('imet-core::analysis_report.management_context.animal_species'),
                    'plant_species' => trans('imet-core::analysis_report.management_context.plants_species')
                ],
            'habitats' => trans('imet-core::analysis_report.management_context.occurrences_habitats'),
            'climate_change' => trans('imet-core::analysis_report.management_context.climate_change'),
            'ecosystem_services' => trans('imet-core::analysis_report.management_context.ecosystem_services'),
            'threats' => trans('imet-core::analysis_report.management_context.label_threats')
        ];

        foreach ($items as $form_id) {
            $protected_area = Imet::where(['FormID' => $form_id])->first();

            $retrieve_key_elements = [
                'species' => Modules\Evaluation\ImportanceSpecies::getModule($form_id)->filter(function ($item) {
                    return $item['IncludeInStatistics'];
                })->map(function ($item) {
                    return [$item['group_key'] => Animal::getPlainNameByTaxonomy($item['Aspect'])];
                })->toArray(),
                'habitats' => Modules\Evaluation\ImportanceHabitats::getModule($form_id)->filter(function ($item) {
                    return $item['IncludeInStatistics'];
                })->pluck('Aspect')->toArray(),
                'climate_change' => Modules\Evaluation\ImportanceClimateChange::getModule($form_id)->filter(function ($item) {
                    return $item['IncludeInStatistics'];
                })->pluck('Aspect')->toArray(),
                'ecosystem_services' => Modules\Evaluation\ImportanceEcosystemServices::getModule($form_id)->filter(function ($item) {
                    return $item['IncludeInStatistics'];
                })->pluck('Aspect')->toArray(),
                'threats' => Modules\Evaluation\Menaces::getModule($form_id)->filter(function ($item) {
                    return $item['IncludeInStatistics'];
                })->pluck('Aspect')->toArray()
            ];
            $retrieve_key_elements['species']['animal_species'] = [];
            $retrieve_key_elements['species']['plant_species'] = [];
            $species_array = $retrieve_key_elements['species'];
            foreach ($species_array as $k => $species) {
                foreach ($species as $key => $value) {
                    //echo $key;
                    if ($key == "group0") {
                        $retrieve_key_elements['species']['animal_species'][] = $value;
                    } else {
                        $retrieve_key_elements['species']['plant_species'][] = $value;
                    }

                }

                if (is_numeric($k)) {
                    unset($retrieve_key_elements['species'][$k]);
                }
            }

            $api[] = ['wdpa_id' => $protected_area['wdpa_id'], 'name' => $protected_area['name'], 'values' => $retrieve_key_elements];
        }

        return ['data' => $api, 'labels' => $labels];
    }
}
