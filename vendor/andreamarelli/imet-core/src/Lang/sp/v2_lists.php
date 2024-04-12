<?php

return [

    'languages' => [
        'fr'        => 'French',
        'en'        => 'English',
        'sp'        => 'Spanish',
        'pt'        => 'Portuguese'
    ],

    'NonWdpaPaDef' => [
        '1' => 'cumple con las definiciones de áreas protegidas de la UICN y / o CBD',
        '0' => 'cumple con la definición de CBD de área conservada',
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

    'OwnershipType' => [
        'state' => 'State',
        'communal' => 'Community',
        'individual_landowners' => 'Individual landowners',
        'for_profit_organizations' => 'For-profit organisations',
        'nonprofit_organizations' => 'Non-profit organisations',
        'joint_ownership' => 'Joint ownership',
        'multiple_ownership' => 'Multiple ownership',
        'contested' => 'Contested',
        'not_reported' => 'Not Reported',
    ],

    'PaType' => [
        'terrestrial'           => 'Terrestre',
        'marine_and_coastal'    => 'Marina y costera',
        'oecm_terrestrial'      => 'Conserved area - Terrestrial',
        'oecm_marine'           => 'Conserved area - Marine',
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
        'artificial'                => 'Artificial - plantations, gardens, pasturelands',
        'desert'                    => 'Desert – hot, cold, temperate',
        'forest_temperate_boreal'   => 'Forest - boreal and temperate',
        'forest_dry'                => 'Forest - subtropical/tropical dry',
        'forest_moist_lowland'      => 'Forest - subtropical/tropical moist lowland',
        'forest_moist_montane'      => 'Forest - subtropical/tropical moist montane',
        'grassland_dry_moist'       => 'Grassland - subtropical/tropical dry or moist',
        'grassland_temperate'       => 'Grassland - temperate',
        'marine_coastal'            => 'Marine - coastal',
        'marine_coral_reefs'        => 'Marine - coral reefs',
        'marine_intertidal'         => 'Marine - intertidal',
        'marine_oceanic'            => 'Marine - oceanic and deep ocean',
        'marine_pelagic'            => 'Marine - pelagic',
        'marine_subtidal'           => 'Marine - subtidal',
        'rocky'                     => 'Rocky areas - mountains, cliffs',
        'savanna_dry'               => 'Savanna - dry',
        'savanna_moist'             => 'Savanna - moist',
        'shrubland_temperate_boreal' => 'Shrubland - boreal and temperate',
        'shrubland_dry_moist'       => 'Shrubland - Subtropical/tropical dry or moist',
        'shrubland_high_altitude'   => 'Shrubland - Subtropical/tropical high altitude',
        'swamp'                     => 'Swamp - subtropical/tropical',
        'wetlands_lakes'            => 'Wetlands (inland) - lake',
        'wetlands_rivers'           => 'Wetlands (inland) - rivers, streams, waterfalls',
        'wetlands_shrub'            => 'Wetlands (inland) - shrub dominated wetlands',
    ],

    'EcosystemServicesImportance' => [
        '_' => null,        // need to force string keys
        '0' => 'Local',
        '1' => 'Larger',
    ]

];
