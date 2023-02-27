<?php
return [

    'GovernanceModel' => [
        'government'    => 'Governance by government',
        'shared'        => 'Shared governance',
        'private'       => 'Private governance',
        'indigenous'    => 'Governance by indigenous peoples and local communities',
        'not_reported'  => 'Not Reported'
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
        'communal'      => 'Communal',
        'landowners'    => 'Individual landowners',
        'for_profit'    => 'For-profit organisations',
        'non_profit'    => 'Non-profit organisations',
        'joint'         => 'Joint ownership',
        'multiple'      => 'Multiple ownership',
        'contested'     => 'Contested',
        'not_reported'  => 'Not Reported'
    ],

    'Habitats' => [
        # Forest
        'forest_temperate'  => 'Forest temperate',
        'forest_boreal'     => 'Forest boreal',
        'moist_lowland'     => 'Subtropical/tropical moist lowland',
        'moist_montane'     => 'Subtropical/tropical moist montane',
        'dry'               => 'Subtropical/tropical dry',
        'swamp'              => 'Subtropical/tropical swamp',
        # Savanna
        'savanna_moist'     => 'Savanna-moist',
        'savanna_dry'       => 'Savanna-dry',
        # Shrubland
        'shrubland_dry'             => 'Shrubland-Subtropical/tropical dry',
        'shrubland_moist'           => 'Shrubland-Subtropical/tropical moist',
        'shrubland_high_altitude'   => 'Shrubland-Subtropical/tropical high altitude',
        'shrubland_temperate'       => 'Shrubland temperate',
        'shrubland_boreal'          => 'Shrubland boreal',
        # Grassland
        'grassland_yemperate'       => 'Grassland Temperate',
        'grassland_high_altitude'   => 'Grassland subtropical/tropical high altitude',
        'grassland_dry'             => 'Grassland subtropical/tropical dry',
        # Wetlands
        'wetlands_perman_freshwater'    => 'Wetlands (inland)-Permanent freshwater lakes',
        'wetlands'                      => 'Wetlands (inland)',
        'wetlands_tundra'               => 'Wetlands (inland)-Tundra wetlands',
        # Rocky Areas, Desert
        'desert_temperate'  => 'Desert – Temperate',
        'desert_cold'       => 'Desert – Cold',
        'desert_hot'        => 'Desert - Hot',
        # Artificial
        'plantations'       => 'Plantations'
    ],

    'Engagement' => [
        'provisioning'  => 'Provisioning (food, energy, material, pharmacopeia)',
        'spiritual'     => 'Spiritual',
        'cultural'      => 'Cultural (tourism, education, etc.)',
        'regulation'    => 'Regulation / Defence (fight against degradation/ climate change, erosion, desertification, etc)',
        'enforcement'   => 'Enforcement (pr eserving biodiversity and managing the use of natural resources, cultural and other values.)',
        'market_economy' => 'Market economy'
    ],

    'PopulationStatus' => [
        'scarce'            => 'Scarse',
        'below_optimum'     => 'Below optimum',
        'optimum'           => 'Optimum',
        'exceeding_optimum' => 'Exceeding optimum'
    ],

    'Access' => [
        'no_access' => 'No access',
        'exclusion' => 'Exclusion (criteria for access, use, withdrawal, management)',
        'open'      => 'Open (generally use or enjoy of NR including lands)'
    ],

    'MainThreat' => [
        'over_exploitation'     => 'Illegal or overexploitation',
        'habitat_loss'          => 'Habitat loss or degradation - Infrastructures',
        'pollution'             => 'Pollution',
        'invasive_species'      => 'Invasive species',
        'gas_oil_mining'        => 'gas/oil exploitation, mining',
        'other'                 => 'Others',
    ]
];
