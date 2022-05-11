<?php

return [

    'languages' => [
        'fr'        => 'français',
        'en'        => 'anglais',
        'sp'        => 'espagnol',
        'pt'        => 'portugais'
    ],

    'NonWdpaPaDef' => [
        '1' => 'répond aux définitions des aires protégées de l\'UICN et/ou de la CDB',
        '0' => 'répond à la définition CBD d\'un OECM',
    ],

    'NonWdpaDesignType' => [
        'Régional',
        'National',
        'International',
        'Non applicable'
    ],

    'NonWdpaTypology' => [
        '2' => 'principalement ou entièrement marine',
        '1' => 'côtière: marine et terrestre',
        '0' => 'principalement ou entièrement terrestre'
    ],

    'NonWdpaStatus' => [
        'Proposé',
        'Inscrit',
        'Adopté',
        'Désigné',
        'Établi'
    ],

    'PaType' => [
        'terrestrial'           => 'terrestre',
        'marine_and_coastal'    => 'maritime et côtier',
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
        'Désert',
        'Savanes',
        'Miombo',
        'Forêts claires',
        'Forêts sèches',
        'Forêts tropicales',
        'Hautes montagnes',
        'Lacs / Rivières',
        'Zones humides',
        'Mangroves',
        'Côtière',
        'Mer/Océan'
    ],

    'InstitutionType' => [
        'Académique',
        'Confessionnel',
        'Indépendant',
        'ONG / ASBL',
        'Organisation internationale',
        'Privé',
        'Projet / Programme',
        'Public (étatique)',
        'Autre'
    ],

    'PartnershipsType' => [
        'Financier',
        'scientifique',
        'recherche',
        'parrainage',
        'jumelage',
        'expertise',
        'prestation de service',
        'concession (p.ex. tourisme)',
        'collaboration',
        'PPP (Partenariat Publique/Privé)'
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
        'marine' => 'Maritime',
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
        'Haute', 'Moyenne', 'Faible'
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
        '0' => 'Locale',
        '1' => 'Plus grand',
    ]

];
