<?php
return [

    'ShortOrLongTerm' => [
        'short'     => 'Short term',
        'long'      => 'Long term'
    ],

    'GovernanceModel' => [
        'government'    => 'Governance by government',
        'shared'        => 'Shared governance',
        'private'       => 'Private governance',
        'indigenous'    => 'Governance by indigenous peoples and local communities',
        'not_reported'  => 'Not Reported'
    ],

    'SubGovernanceModel' => [
        'government' => [
            'national' => 'Federal or national ministry or agency',
            'sub_national' => 'Sub-national ministry or agency',
            'delegated' => 'Government-delegated management',
            'other' => 'Other'
        ],
        'shared' =>  [
            'transboundary' => 'Transboundary governance',
            'collaborative' => 'Collaborative governance',
            'joint' => 'Joint governance',
            'other' => 'Other',
        ],
        'private' =>  [
            'individual' => 'Individual landowners',
            'non_profit' => 'Non-profit organisation',
            'for_profit' => 'For-profit organisations',
            'other' => 'Other'
        ],
        'indigenous' =>  [
            'indigenous' => 'Indigenous peoples',
            'local_communities' => 'Local communities',
            'other' => 'Other'
        ]
    ],

    'StakeholderType' => [
        'academic'      => 'Academic',
        'confessionnel' => 'Confessionnel',
        'independent'   => 'Independent',
        'ngo'           => 'NGO / ASBL',
        'internat_orgs' => 'International organisation',
        'private'       => 'Private',
        'project'       => 'Project / Program',
        'public'        => 'Public (state)',
        'other'         => 'Other'
    ],

    'ManagementUnique' => [
        'unique'        => 'A specified entity',
        'multiple'      => 'An agreed upon combination of entities'
    ],

    'ManagementType'=> [
        'association'   => 'Association',
        'community'     => 'Community and indigenous group',
        'private'       => 'Private',
        'faith_based'   => 'Faith-based organization',
        'ngo'           => 'NGO',
        'public'        => 'public organization',
        'other'         => 'other'
    ],

    'DateOfCreation'=> [
        'always_existed'    => 'Has always existed',
        'not_known'         => 'Not known'
    ],

    'PaType' => [
        'terrestrial'           => 'Terrestrial and/or freshwater',
        'marine_and_coastal'    => 'Marine',
        'mixed'                 => 'Partially marine and terrestrial (or freshwater)',
    ],

    'Ownership' => [
        'state'         => 'State',
        'communal'      => 'Community',
        'landowners'    => 'Individual landowners',
        'for_profit'    => 'For-profit organisations',
        'non_profit'    => 'Non-profit organisations',
        'joint'         => 'Joint ownership',
        'multiple'      => 'Multiple ownership',
        'contested'     => 'Contested',
        'not_reported'  => 'Not Reported'
    ],

    'Habitats' => [
        'artificial_water'  => 'Artificial–Aquatic',
        'artificial_land'   => 'Artificial–Terrestrial',
        'caves'             => 'Caves & Subterranean Habitats (non-aquatic)',
        'desert'            => 'Deserts',
        'forest'            => 'Forest (also Mangroves)',
        'grasslands'        => 'Grasslands',
        'introduced_veget'  => 'Introduced Vegetation',
        'marine_coastal'    => 'Marine Coastal/Supratidal',
        'marine_deep'       => 'Marine Deep Ocean Floor (Benthic and Demersal)',
        'marine_intertidal' => 'Marine Intertidal',
        'marine_neritic'    => 'Marine Neritic (also Coral Reef)',
        'marine_oceanic'    => 'Marine Oceanic',
        'rocky'             => 'Rocky Areas (e.g. inland cliffs, mountain peaks)',
        'savanna'           => 'Savanna',
        'shrubland'         => 'Shrubland',
        'wetlands'          => 'Wetlands (inland)',
        'other'             => 'Other',
        'unknown'           => 'Unknown',
    ],

    'UsesCategories' => [
        'provisioning'  => 'Provisioning',
        'cultural'      => 'Cultural',
        'regulating'    => 'Regulating',
        'supporting'    => 'Supporting',
        'biodiversity'  => 'Biodiversity',
    ],

    'PopulationStatus' => [
        'scarce'            => 'Scarse',
        'below_optimum'     => 'Below optimum',
        'optimum'           => 'Optimum',
        'exceeding_optimum' => 'Exceeding optimum'
    ],

    'Access' => [
        'no_access' => 'No access',
        'limited' => 'Limited access (existence of criteria or rules for use)',
        'open'      => 'Open access (no criteria or rules for use) '
    ],

    'Guidelines' => [
        'poorly_developed'      => 'Poorly developed guidelines and procedures',
        'moderately_developed'  => 'Moderately developed guidelines and procedures',
        'well_developed'        => 'Well-developed guidelines and procedures'
    ],

    'Threats' => [
        'commercial_residential'    => 'Commercial and residential',
        'agriculture_aquaculture'   => 'Agriculture and aquaculture',
        'energy_mining'              => 'Energy and mining',
        'transport_infrastructure'  => 'Transport and infrastructure',
        'extraction'                => 'Extraction of biological resources',
        'human_disturbance'         => 'Human disturbance / intrusion',
        'changes_natural_system'    => 'Changes in the natural system',
        'invasive_species'          => 'Invasive / challenging species',
        'pollution'                 => 'Pollution',
        'geological'                => 'Geological phenomena',
        'climate_change'            => 'Climate change and effects',
        'other'                     => 'Other pressures and threats',
    ],

    'Reliability' => [
        'high' => 'High',
        'medium' => 'Medium',
        'poor' => 'Poor',
    ]

];
