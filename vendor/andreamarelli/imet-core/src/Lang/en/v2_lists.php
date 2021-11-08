<?php

return [

    'languages' => [
        'fr'        => 'french',
        'en'        => 'english',
        'sp'        => 'spanish',
        'pt'        => 'portuguese'
    ],

    'NonWdpaPaDef' => [
        '1' => 'meets IUCN and/or CBD protected area definitions',
        '0' => 'meets the CBD definition of an OECM',
    ],

    'NonWdpaDesignType' => [
        'National',
        'Regional',
        'International',
        'Not applicable'
    ],

    'NonWdpaTypology' => [
        '2' => 'predominantly or entirely marine',
        '1' => 'coastal: marine and terrestrial',
        '0' => 'predominantly or entirely terrestrial'
    ],

    'NonWdpaStatus' => [
        'Proposed',
        'Inscribed',
        'Adopted',
        'Designated',
        'Established'
    ],

    'PaType' => [
        'Terrestrial',
        'Marine',
        'Mixed'
    ],

    'EcoType' => [
        'Desert',
        'Savannas',
        'Miombo',
        'Woodlands',
        'Dry Forest',
        'Tropical forest',
        'High mountain',
        'lake / river',
        'Wet area',
        'Mangroves',
        'Coast',
        'Sea/Ocean'
    ],

    'InstitutionType' => [
        'Academic',
        'Confessionnel',
        'Independent',
        'NGO / ASBL',
        'International organisation',
        'Private',
        'Project / Program',
        'Public (state)',
        'Other'
    ],

    'PartnershipsType' => [
        'financial',
        'scientific',
        'research',
        'sponsorship',
        'twinning',
        'expertise',
        'service delivery',
        'concession (eg. tourism)',
        'collaboration',
        'PPP (Public/Private Partnership)'
    ],

    'GovernanceType' => [
        'Governance by the government',
        'Shared governance',
        'Private governance',
        'Governance by local communities and indigenous populations	'
    ],

    'Designation' => [
        'ASEAN Heritage Parks (ASEAN)',
        'Alliance for Zero Extinction Sites (AZE)',
        'Barcelona Convention',
        'Biodiversity Hotspots',
        'Endemic Bird Areas',
        'High Biodiversity Wilderness Area',
        'IUCN Important Sites for Freshwater Biodiversity',
        'Important Bird Areas (IBA)',
        'Important Plant Areas (IPA)',
        'Key Biodiversity Areas (KBA)',
        'Natura 2000',
        'OSPAR Marine Protected Areas',
        'Ramsar Wetlands',
        'Species Grid',
        'UNESCO MAB',
        'World Heritage Sites'
    ],

    'LandCoverUseTake' => [
        'Forest',
        'Savannah shrublands',
        'Herbaceous savannah',
        'Grasslands',
        'Water',
        'Crops/Plantations',
        'Dwellings',
        'Roads'
    ],

    'SpeciesReliability' => [
        'High', 'Medium', 'Poor'
    ],

    'MarineHabitatsPresence' => [
        'Présent', 'Absent', 'Dominant'
    ],

    'EcosystemServicesImportance' => [
        '_' => null,        // need to force string keys
        '0' => 'Local',
        '1' => 'Larger',
    ]

];
