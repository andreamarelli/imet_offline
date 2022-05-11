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
        'terrestrial'           => 'Terrestrial',
        'marine_and_coastal'    => 'Marine and coastal',
        'oecm_terrestrial'      => 'OECMs (Other effective area-based conservation measures) - Terrestrial',
        'oecm_marine'           => 'OECMs (Other effective area-based conservation measures) - Marine',
        'icca_terrestrial'      => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Terrestrial',
        'icca_marine'           => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Marine'
    ],

    'IUCNDesignation' => [
        'IA' => 'IA Strict Nature Reserve',
        'IB' => 'IB Wilderness Area',
        'II' => 'II National Park',
        'III' => 'III Natural Monument or Feature',
        'IV' => 'IV HABITAT/Species Management Area',
        'V' => 'V Protected Seascape',
        'VI' => 'VI Protected Area with Sustainable Use of Natural Resources',
        'not_reported' => 'Not reported'
    ],

    'MarineDesignation' => [
        'No-Entry zone',
        'No-Take zone',
        'Multi-purposes MPA - Buffer zones for traditional use',
        'Multi-purposes MPA - Buffer zones for educational and/or recreational activities',
        'Multi-purposes MPA - Other',
        'Marine reserves',
        'Wildlife refuges',
        'Fish management zone',
        'Other',
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
        'Community-based conservation (CBC)',
        'CBM (Community-based management (CBM)',
        'CBA (Conservation Based Area)',
        'Locally Managed Marine Areas - LMMA',
        'Indigenous Community Conserved Areas - ICCAs',
        'Protected and Conserved Areas (PCAs)',
        'Other'
    ],

    'TerrestrialOrMarine' => [
        'terrestrial' => 'Terrestrial',
        'marine' => 'Marine',
    ],

    'SpecialDesignation' => [
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

    'SpeciesReliability' => [
        'High', 'Medium', 'Poor'
    ],

    'Habitats' => [
        # Forest
        'Forest temperate',
        'Forest boreal',
        'Subtropical/tropical moist lowland',
        'Subtropical/tropical moist montane',
        'Subtropical/tropical dry',
        'Subtropical/tropical swamp',
        # Savanna
        'Savanna-moist',
        'Savanna-dry',
        # Shrubland
        'Shrubland-Subtropical/tropical dry',
        'Shrubland-Subtropical/tropical moist',
        'Shrubland-Subtropical/tropical high altitude',
        'Shrubland temperate',
        'Shrubland boreal',
        # Grassland
        'Grassland Temperate',
        'Grassland subtropical/tropical high altitude',
        'Grassland subtropical/tropical dry',
        # Wetlands
        'Wetlands (inland)-Permanent freshwater lakes',
        'Wetlands (inland)',
        'Wetlands (inland)-Tundra wetlands',
        # Rocky Areas, Desert
        'Desert – Temperate',
        'Desert – Cold',
        'Desert - Hot',
        # Artificial
        'Plantations'
    ],

    'EcosystemServicesImportance' => [
        '_' => null,        // need to force string keys
        '0' => 'Local',
        '1' => 'Larger',
    ]

];
