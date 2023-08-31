<?php
return [

    'ShortOrLongTerm' => [
        'short'     => 'Court terme',
        'long'      => 'Long terme'
    ],

    'GovernanceModel' => [
        'government'    => 'Gouvernance par le gouvernement',
        'shared'        => 'Gouvernance partagée',
        'private'       => 'Gouvernance privée',
        'indigenous'    => 'Gouvernance par les peuples indigènes et les communautés locales',
        'not_reported'  => 'Non communiqué'
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
        'academic'      => 'Académique',
        'confessionnel' => 'Confessionnel',
        'independent'   => 'Indépendant',
        'ngo'           => 'NGO / ASBL',
        'internat_orgs' => 'Organisation internationale',
        'private'       => 'Privé',
        'project'       => 'Projet / Programme',
        'public'        => 'Public (état)',
        'other'         => 'Autre'
    ],

    'ManagementUnique' => [
        'unique'        => 'Une entité spécifiée',
        'multiple'      => 'Une combinaison convenue de parties prenantes'
    ],

    'ManagementType'=> [
        'association'   => 'Association',
        'community'     => 'Communauté et groupe autochtone',
        'private'       => 'Privé',
        'faith_based'   => 'Organisation confessionnelle',
        'ngo'           => 'ONG',
        'public'        => 'Organisation publique',
        'other'         => 'Autre'
    ],

    'DateOfCreation'=> [
        'always_existed'    => 'A toujours existé',
        'not_known'         => 'Non connu'
    ],

    'PaType' => [
        'terrestrial'           => 'Terrestre et/ou eau douce',
        'marine_and_coastal'    => 'Marine et côtiere ',
        'mixed'                 => 'Partiellement marin et terrestre (ou d’eau douce)',
    ],

    'Habitats' => [
        'artificial_water'  => 'Artificiel–Aquatique',
        'artificial_land'   => 'Artificiel-Terrestre',
        'caves'             => 'Caves et habitats souterrains (non aquatiques)',
        'desert'            => 'Déserts',
        'forest'            => 'Forêt (aussi Mangroves)',
        'grasslands'        => 'Prairies',
        'introduced_veget'  => 'Végétation introduite',
        'marine_coastal'    => 'Marin Côtier/Supratidal',
        'marine_deep'       => 'Fonds marins profonds (benthiques et démersaux)',
        'marine_intertidal' => 'Intertidal marin',
        'marine_neritic'    => 'Néritique marin (également récif corallien)',
        'marine_oceanic'    => 'Océanique marin',
        'rocky'             => 'Zones rocheuses (par exemple, falaises intérieures, sommets montagneux)',
        'savanna'           => 'Savane',
        'shrubland'         => 'Arbuste',
        'wetlands'          => 'Zones humides (intérieures)',
        'other'             => 'Autre',
        'unknown'           => 'Inconnu',
    ],

    'UsesCategories' => [
        'provisioning'  => 'Approvisionnement',
        'cultural'      => 'Culturel',
        'regulating'    => 'Régulateur',
        'supporting'    => 'Porteur',
    ],


    'PopulationStatus' => [
        'scarce'            => 'Scarse',
        'below_optimum'     => 'En dessous de l’optimum',
        'optimum'           => 'Optimum',
        'exceeding_optimum' => 'Dépassement de l’optimum'
    ],

    'Access' => [
        'no_access' => 'Pas d’accès',
        'limited' => 'Accès limité (existence de critères ou de règles d’utilisation)',
        'open'      => 'Accès libre (pas de critères ou de règles d’utilisation)'
    ],

    'Guidelines' => [
        'poorly_developed'      => 'Lignes directrices et procédures mal développées',
        'moderately_developed'  => 'Lignes directrices et procédures modérément développées',
        'well_developed'        => 'Lignes directrices et procédures bien développées'
    ],

    'Threats' => [
        'commercial_residential'    => 'Commercial et résidentiel',
        'agriculture_aquaculture'   => 'Agriculture et aquaculture',
        'energy_mining'              => 'Énergie et exploitation minière',
        'transport_infrastructure'  => 'Transport et infrastructures',
        'extraction'                => 'Extraction de ressources biologiques',
        'human_disturbance'         => 'Perturbations / intrusions humaines',
        'changes_natural_system'    => 'Changements dans le système naturel',
        'invasive_species'          => 'Espèces envahissantes / difficiles',
        'pollution'                 => 'Pollution',
        'geological'                => 'Phénomènes géologiques',
        'climate_change'            => 'Changement climatique',
        'other'                     => 'Autres pressions et menaces',
    ],

    'Reliability' => [
        'high' => 'Élevé',
        'medium' => 'Moyen',
        'poor' => 'Faible',
    ]
];
