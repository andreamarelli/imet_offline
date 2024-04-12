<?php

return [

    'languages' => [
        'fr'        => 'Français',
        'en'        => 'Anglais',
        'sp'        => 'Espagnol',
        'pt'        => 'Portugais'
    ],

    'NonWdpaPaDef' => [
        '1' => 'répond aux définitions des aires protégées de l\'UICN et/ou de la CDB',
        '0' => 'répond à la définition CBD d\'un espace conservé',
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
        'terrestrial'           => 'terrestre',
        'marine_and_coastal'    => 'maritime et côtier',
        'oecm_terrestrial'      => 'Conserved areas - Terrestrial',
        'oecm_marine'           => 'Conserved areas - Marine',
        'icca_terrestrial'      => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Terrestrial',
        'icca_marine'           => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Marine'
    ],

    'IUCNDesignation' => [
        'IA'    => 'IA Réserve naturelle intégrale',
        'IB'    => 'IB Zone de nature sauvage',
        'II'    => 'II Parc national',
        'III'   => 'III Natural Monument or Feature',
        'IV'    => 'IV Aire de gestion des habitats/espèces',
        'V'     => 'V Paysage terrestre/marin protégé',
        'VI'    => 'VI Zone de gestion de ressources protégées',
        'not_reported' => 'Not reported'
    ],

    'MarineDesignation' => [
        'Zone d’interdiction d’accès (No-Entry zone)',
        'Zone de non-prélèvement (No-Take zone)',
        'AMP à buts multiples — Zones tampons pour l’utilisation traditionnelle',
        'AMP à buts multiples — Zones tampons pour les activités éducatives et/ou récréatives',
        'AMP à buts multiples — Autre ',
        'Réserves marines ',
        'Refuges pour la faune sauvage',
        'Zone de gestion de pêche',
        'Autre',
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
        'Conservation à base communautaire (CBC - Community-based conservation)',
        'Gestion à base communautaire (CBM - Community-based managemen)',
        'Aire basée sur la conservation (CBA - Conservation Based Area)',
        'Aires marines gérées localement (LMMA - Locally Managed Marine Areas)',
        'Aires conservées par les communautés autochtones (ICCAs - ndigenous Community Conserved Areas)',
        'Aires protégées et conservées (PCAs - Protected and Conserved Areas)',
        'Autre'
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
        '0' => 'Locale',
        '1' => 'Plus grand',
    ]

];
