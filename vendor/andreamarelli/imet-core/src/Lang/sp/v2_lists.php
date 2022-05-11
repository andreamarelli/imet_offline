<?php

return [

    'languages' => [
        'fr'        => 'french',
        'en'        => 'english',
        'sp'        => 'spanish',
        'pt'        => 'portuguese'
    ],

    'NonWdpaPaDef' => [
        '1' => 'cumple con las definiciones de áreas protegidas de la UICN y / o CBD',
        '0' => 'cumple con la definición de CBD de un OECM',
    ],

    'NonWdpaDesignType' => [
        'Regional',
        'Nacional',
        'Internacional',
        'No aplicable'
    ],

    'NonWdpaTypology' => [
        '2' => 'principalmente o enteramente marino',
        '1' => 'costero: marino y terrestre',
        '0' => 'principalmente o enteramente terrestre'
    ],

    'NonWdpaStatus' => [
        'Propuesta',
        'Inscrita',
        'Adoptada',
        'Designada',
        'Establecida'
    ],

    'PaType' => [
        'terrestrial'           => 'XXXXXXXXX Terrestrial',
        'marine_and_coastal'    => 'XXXXXXXXX Marine and coastal',
        'oecm_terrestrial'      => 'OECMs (Other effective area-based conservation measures) - Terrestrial',
        'oecm_marine'           => 'OECMs (Other effective area-based conservation measures) - Marine',
        'icca_terrestrial'      => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Terrestrial',
        'icca_marine'           => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Marine'
    ],

    'IUCNDesignation' => [
        'IA'    => 'XXXXXXXXX IA Strict Nature Reserve',
        'IB'    => 'XXXXXXXXX IB Wilderness Area',
        'II'    => 'XXXXXXXXX II National Park',
        'III'   => 'XXXXXXXXX III Natural Monument or Feature',
        'IV'    => 'XXXXXXXXX IV HABITAT/Species Management Area',
        'V'     => 'XXXXXXXXX V Protected Seascape',
        'VI'    => 'XXXXXXXXX VI Protected Area with Sustainable Use of Natural Resources',
        'not_reported' => 'Not reported'
    ],

    'MarineDesignation' => [
        'XXXXXXXXX No-Entry zone',
        'XXXXXXXXX No-Take zone',
        'XXXXXXXXX Multi-purposes MPA - Buffer zones for traditional use',
        'XXXXXXXXX Multi-purposes MPA - Buffer zones for educational and/or recreational activities',
        'XXXXXXXXX Multi-purposes MPA - Other',
        'XXXXXXXXX Marine reserves',
        'XXXXXXXXX Wildlife refuges',
        'XXXXXXXXX Fish management zone',
        'XXXXXXXXX Other',
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
        'XXXXXXXXX Community-based conservation (CBC)',
        'XXXXXXXXX CBM (Community-based management (CBM)',
        'XXXXXXXXX CBA (Conservation Based Area)',
        'XXXXXXXXX Locally Managed Marine Areas - LMMA',
        'XXXXXXXXX Indigenous Community Conserved Areas - ICCAs',
        'XXXXXXXXX Protected and Conserved Areas (PCAs)',
        'XXXXXXXXX Other'
    ],

    'TerrestrialOrMarine' => [
        'terrestrial' => 'Terrestre',
        'marine' => 'Marítimo',
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
