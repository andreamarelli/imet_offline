<?php


return [
    'conclusions' => 'Conclusions',
    'average_contribution_management' => 'Average contribution of the management cycle elements',
    'governance_management' => 'Governance and management',
    'key_conservation_elements' => 'Key conservation elements',
    'climate_change_ecosystem' => 'Climate Change and Ecosystem services',
    'comments' => 'Comments',
    'scaling_legend' => 'Visualizations of values per categories',
    'add_analysis' => 'Add to analysis',
    'error_wrong' => 'An error occurred',
    'error_connection' => 'Something went wrong, please check your internet connection.',
    'general_info' => [
        'country' => 'Country',
        'network' => 'Network of',
        'transbondary_name' => 'Name of Transbondary area - Landscape',
        'category_protected_area' => 'Category(ies) or protected areas',
        'main_values' => 'Main values of the network – transbondary area - landscape',
        'total_surface_protected' => 'Total surface of the protected areas',
        'total_surface_landscape' => 'Total surface of the landscape',
        'agency' => 'Agency - Agencies',
        'ecoregions' => 'Ecoregions',
        'vision' => 'Vision',
        'mission' => 'Mission',
        'objectives' => 'Objectives'
    ],
    'grouping' => [
        'add_country' => 'Add by country',
        'reset' => 'Reset',
        'add_group' => 'Add group',
        'render_radar' => 'Render radar',
        'render_scatter' => 'Render scatter',
        'group' => 'Group'
    ],
    'management_context' => [
        'key_species' => 'Key species',
        'animal_species' => 'Animal species (flagship, endangered, endemic, ...)',
        'occurrences_species' => 'Number of occurrences of each key species',
        'plants_species' => 'Plants species (flagship, endangered, endemic, ...)',
        'terrestrial_marine_habitats' => 'Terrestrial and marine habitats - land-cover, land-change and land-take',
        'climate_change' => 'Climate Change',
        'ecosystem_services' => 'Ecosystem services',
        'comments_threats' => 'Comments on Threats',
        'comments_ecosystem' => 'Comments on Ecosystem services',
        'comments_climate' => 'Comments on Climate Change',
        'comments_terrestrial' => 'Comments on Terrestrial and marine habitats -land-cover, land-change and land-take',
        'comments_plants_species' => 'Comments on Key plants species',
        'comments_animal_species' => 'Comments on Key species',
    ],
    'protected_area_coverage_and_connectivity' => [
        'title',
        'chart' => 'Country coverage by protected areas and connected protected areas (connectivity)',
        'protected_land_area' => 'Protected Land Area',
        'protected_marin_area' => 'Protected Marine Area',
        'protected_connected_land' => 'Protected Connected Land'
    ]
    ,
    'land_degradation' => [
        'indicators' => [
            'title' => 'Land degradation',
            'chart' => 'Land degradation',
            'no_biomas' => 'No biomas (km2)',
            'persistent_severe' => 'Persistent severe decline in productivity (km2)',
            'persistent_moderate' => 'Persistent moderate decline in productivity (km2)',
            'stable_stressed' => 'Stable, but stressed; persistent strong inter-annual productivity variations (km2)',
            'stable_productivity' => 'Stable Productivity (km2)',
            'persistent_increase' => 'Persistent increase in productivity (km2)'
        ],
        'bar_indicators' => [
            'no_biomas' => 'No biomas (km2)',
            'persistent_severe' => 'Persistent severe decline in productivity (km2)',
            'persistent_moderate' => 'Persistent moderate decline in productivity (km2)',
            'persistent_strong' => 'Stable, but stressed; persistent strong inter-annual productivity variations (km2)',
            'stable_productivity' => 'Stable Productivity (km2)',
            'persistent_increase' => 'Persistent increase in productivity (km2)'
        ],
    ],
    'total_carbon' => [
        'title' => 'Total carbon',
        'min' => 'Min. [Mg]',
        'mean' => 'Mean [Mg]',
        'max' => 'Max. [Mg]',
        'std_dev' => 'Std. Dev. [Mg]',
        'sum' => 'Sum [Pg]',
    ],
    'relative_performance_effectiveness_bar_average' => [
        'titles' => [
            'context_sub_indicators' => 'Average contribution by the six sub-indicators to Value and Importance',
            'context' => 'Average contribution of the main indicators to the Management context',
            'planning' => 'Average contribution of the Planning indicators',
            'inputs' => 'Average contribution of the Inputs indicators',
            'process' => 'Average contribution of the Process indicators',
            'process_sub_indicators' => 'Average contribution of the six sub-elements of the Process indicators',
            'outputs' => 'Average contribution of the Outputs indicators',
            'outcomes' => 'Average contribution of the Outcomes indicators'
        ]
    ],
    'terrestial_ecoregions' => [
        'name' => 'Name',
        'area' => 'Area (km2)',
        'percentage_of_ecoregion_in_country' => '% of ecoregion in country',
        'percentage_of_ecoregion_protected_in_country' => '% of ecoregion protected in country',
        'country_contribution_to_global_ecoregion_protection' => '% country contribution to global protection',
        'ecoregion_protection_percentage' => '% of ecoregion protected worldwide'
    ],
    'marine_ecoregions' => [
        'name' => 'Name',
        'area' => 'Area (km2)',
        'percentage_of_ecoregion_in_country' => '% of ecoregion in country',
        'percentage_of_ecoregion_protected_in_country' => '% of ecoregion protected in country',
        'country_contribution_to_global_ecoregion_protection' => '% country contribution to global protection',
        'ecoregion_protection_percentage' => '% of ecoregion protected worldwide'
    ],
    'copernicus' => [
        'label' => 'Land Cover Class',
        'percent' => '% Covered',
        'area' => 'Calculated Surface',
        'color' => 'Color Map'
    ],
    'protected_area' => [
        'name' => 'Name',
        'gis_area' => 'Area (km2)',
        'nature' => 'Type'
    ],
    'map' => [
        'fields' => [
            'area_prot_terr_perc' => 'Protected Land',
            'protconn' => 'Protected Connected Land'
        ],
        'dopa_indicators' => [
            'terrestial_area' => [
                'title_table' => 'Terrestial Area',
                'area_terr_perc' => 'Coverage(%)',
                'area_prot_terr_km2' => 'Protected Land Area(km2)',
                'area_terr_km2' => 'Total Land Area(km2)',
                'carbon_stdev_c_mg' => 'Terrestial Archi 11 treshold'

            ],
            'marine_indicators' => [
                'title_table' => 'Marine Area',
                'area_mar_perc' => 'Coverage(%)',
                'area_prot_mar_km2' => 'Protected Marine Area(km2)',
                'area_mar_km2' => 'Total Marine Area(km2)',
                'carbon_stdev_c_mg' => 'Terrestial Archi 11 treshold'
            ]
        ],

    ],
];
