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
        'terrestrial'           => 'Terrestre',
        'marine_and_coastal'    => 'Marina y costera',
        'oecm_terrestrial'      => 'OECMs (Other effective area-based conservation measures) - Terrestrial',
        'oecm_marine'           => 'OECMs (Other effective area-based conservation measures) - Marine',
        'icca_terrestrial'      => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Terrestrial',
        'icca_marine'           => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Marine'
    ],

    'IUCNDesignation' => [
        'IA'    => 'IA Reserva Natural Estricta ',
        'IB'    => 'IB Área natural silvestre',
        'II'    => 'II Parque Nacional',
        'III'   => 'III Monumento o elemento natural',
        'IV'    => 'IV Área de manejo de hábitats / especies',
        'V'     => 'V Paisaje terrestre y marino protegido',
        'VI'    => 'VI Área protegida manejada',
        'not_reported' => 'Not reported'
    ],

    'MarineDesignation' => [
        'Zona de exclusión (No-Entry zone)',
        'Zona de no captura (No-Take zone)',
        'AMP polivalente - Zonas de amortiguación para usos tradicionales',
        'AMP polivalente - Zonas de amortiguación para actividades educativas y/o recreativas',
        'AMP polivalente - Otros ',
        'Reservas marinas',
        'Refugios de vida silvestre',
        'Zona de gestión pesquera',
        'Otros',
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
        'Conservación basada en la comunidad (Community-based conservation-CBC)',
        'Gestión basada en la comunidad (Community-based management-CBM)',
        'Área basada en la conservación (Conservation Based Area-CBA)',
        'Áreas marinas gestionadas localmente (Locally Managed Marine Areas-LMMA)',
        'Áreas Conservadas por Comunidades Indígenas (Indigenous Community Conserved Areas-ICCAs)',
        'Áreas Protegidas y Conservadas (Protected and Conserved Areas-PCAs)',
        'Otros'
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
