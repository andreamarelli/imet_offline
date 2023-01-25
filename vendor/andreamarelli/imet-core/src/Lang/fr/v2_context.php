<?php

return [

    'Create' => [
        'title' => 'Créer un nouveau IMET (WDPA)',
        'fields' => [
            'version' => 'version',
            'Year' => 'Année sujette à évaluation',
            'wdpa_id' => 'aire protégée',
            'language' => 'langue',
            'prefill_prev_year' => 'préremplir avec l\'année précédente',
        ]
    ],

    'CreateNonWdpa' => [
        'title' => 'Créer un nouveau IMET (non-WDPA)',
        'fields' => [
            'version' => 'version IMET',
            'Year' => 'Année sujette à évaluation',
            'wdpa_id' => 'aire protégée',
            'language' => 'langue',
            'prefill_prev_year' => 'préremplir avec l\'année précédente',
            'pa_def' => 'définition',
            'name' => 'nom fourni par l’exploitant',
            'origin_name' => 'nom dans la langue d’origine',
            'designation' => 'nom de la désignation (ex. réserve, sanctuaire, etc.)',
            'designation_eng' => 'désignation obligatoire en Anglais',
            'designation_type' => 'type de désignation',
            'marine' => 'typologie',
            'rep_m_area' => 'surface de l’aire protégée conservée marine [km<sup>2</sup>]',
            'rep_area' => 'surface de l’aire protégée conservée [km<sup>2</sup>]',
            'status' => 'statut',
            'ownership_type' => 'Type de propriété',
            'status_year' => 'année de promulgation du statut',
            'country' => 'pays',
        ],

        'allowed_international' => 'Valeurs autorisées pour les désignations de niveau international',
        'allowed_regional' => 'Valeurs autorisées pour les désignations de niveau régional',
        'allowed_national' => 'Pas de valeurs fixes pour les protégées - conservées désignées au niveau national',
    ],

    'Objectives' => [
        'title' => 'Détermination des objectifs',
        'fields' => [
            'Element' => 'Elément/Indicateur',
            'Status' => 'Ligne de base',
            'Objective' => 'Objectif – Condition optimal ou favorable',
            'Comments' => 'Commentaires'
        ]
    ],

    'Objectives1' => [
        'module_info' => 'Établir et décrire les objectifs relatifs à la <b>gouvernance, les partenariats et la désignation </b> de l\'aire protégée<br /> Les objectifs et les cibles indiqués ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases de processus et pour le suivi des activités de gestion de l’aire protégée'
    ],
    'Objectives2' => [
        'module_info' => 'Établir et décrire les objectifs relatifs aux <b>limites, l’indice de configuration, l’extension des patrouilles et l’application de la loi et le contexte territorial de l’aire protégée</b><br /> Les objectifs et les cibles indiqués ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases de processus et pour le suivi des activités de gestion de l’aire protégée'
    ],
    'Objectives3' => [
        'module_info' => 'Établir et décrire les objectifs relatifs aux <b>pour les ressources humaines, financières et matérielles pour la gestion </b> de l\'aire protégée<br /> Les objectifs et les cibles indiqués ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases de processus et pour le suivi des activités de gestion de l’aire protégée'
    ],
    'Objectives4' => [
        'module_info' => 'Établir et décrire les objectifs relatifs aux <b> i) espèces animales; ii) espèces de plante; iii) habitats iv) couverture, utilisation et occupation des terres </b>de l\'aire protégée<br /> Les objectifs et les cibles indiqués ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases de processus et pour le suivi des activités de gestion de l’aire protégée'
    ],
    'Objectives5' => [
        'module_info' => 'Établir et décrire les objectifs relatifs aux <b>pressions et menaces</b> qui pèsent sur l’aire protégée<br /> Les objectifs et les cibles indiqués ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases de processus et pour le suivi des activités de gestion de l’aire protégée'
    ],
    'Objectives6' => [
        'module_info' => 'Établir et décrire les objectifs relatifs au <b>changement climatique </b> qui pèsent sur l’aire protégée.<br /> Les objectifs et les cibles indiqués ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases de processus et pour le suivi des activités de gestion de l’aire protégée'
    ],
    'Objectives7' => [
        'module_info' => 'Établir et décrire les objectifs relatifs aux <b> services écosystémiques et à la dépendance des collectivités</b> de l’aire protégée envers ces services<br /> Les objectifs et les cibles indiqués ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases de processus et pour le suivi des activités de gestion de l’aire protégée'
    ],

    'ResponsablesInterviewers' => [
        'title' => 'Responsables de la compilation du fichier: Équipe de gestion et partenaires',
        'fields' => [
            'Name'          => 'Nom',
            'Institution'   => 'Organisation',
            'Function'      => 'Fonction',
            'Contacts'      => 'Coordonnées de contact',
            'EncodingDate'  => 'Date de compilation',
            'EncodingDuration' => 'Durée de l\'évaluation (h)'
        ]
    ],

    'ResponsablesInterviewees' => [
        'title' => 'Responsables de la compilation du formulaire: Support extérieur à l\'analyse et à l\'évaluation',
        'fields' => [
            'Name' => 'Nom',
            'Institution' => 'Organisation',
            'Function' => 'Fonction',
            'Contacts' => 'Coordonnées de contact',
            'EncodingDate' => 'Date de compilation',
            'EncodingDuration' => 'Durée de l\'évaluation (h)',
        ]
    ],

    'GeneralInfo' => [
        'title' => 'Données de base',
        'fields' => [
            'CompleteName' => 'Nom complet de l\'aire protégée',
            'CompleteNameWDPA' => 'Nom de l\'aire protégée dans le site WDPA',
            'UsedName' => 'Nom utilisé',
            'WDPA' => 'WDPA ID (www.protectedplanet.net)',
            'Type' => 'Typologie',
            'NationalCategory' => 'Catégorie Nationale',
            'IUCNCategory1' => 'Catégorie UICN principale',
            'IUCNCategory2' => 'Autre catégorie UICN',
            'IUCNCategory3' => 'Autre catégorie UICN',
            'MarineDesignation' => 'Désignation marine et côtier',
            'Country' => 'Pays',
            'CreationYear' => 'Année de création',
            'Institution' => 'Institution de tutelle',
            'Biome' => 'Biome',
            'Ecoregions' => 'Ecorégion(s) de référence [Ecorégions G200, Olson, WWF; Spalding M. et alt. 2007]',
            'Ecotype' => 'Écotypes (indiquer jusqu’à trois éléments par ordre d’importance décroissante)',
            'ReferenceText' => 'Référence du texte de création en cours de validité',
            'ReferenceTextDocument' => '',
            'ReferenceTextValues' => 'Quelle est l’importance de l’aire protégée et les principales valeurs pour lesquelles elle a été désignée? (Fournir une liste, puis une brève description)',
        ],
        'module_info' => '<b>Introduction à la typologie</b>: Introduction à la typologie: IMET identifie trois catégories 
            d’aires protégées: (1) Terrestres (2) Marines et côtières (3) OECM — Autres Mesures de Conservation Efficaces 
            ou AMCE. Dans la section Gouvernance (CTX 1.2), vous pouvez affiner la typologie de gestion et de gouvernance 
            de ces trois typologies d’aires protégées. Si vous analysez une aire protégée et conservée (APC), vous pouvez 
            préciser le contexte territorial dans le CTX 2.4. Aire protégée (définition générale): Une aire protégée est 
            un espace géographique clairement défini, reconnu, dédié et géré, par des moyens légaux ou d’autres moyens efficaces, 
            pour réaliser la conservation à long terme de la nature avec les services écosystémiques et les valeurs culturelles 
            associées. (Définition de l’UICN 2008)',
        'type_info' => [
            'terrestrial' => 'Une aire protégée terrestre (APT) est une portion de terre protégée par des restrictions et 
                des lois spéciales pour la conservation de l’environnement naturel. Il peut s’agir de grandes étendues 
                de terre réservées à la protection de la faune et de son habitat; de zones d’une grande beauté naturelle 
                ou d’un intérêt unique; d’aires contenant des formes rares de vie végétale et animale; de zones représentant 
                une formation géologique inhabituelle; de lieux d’intérêt historique et préhistorique; d’aires contenant des 
                écosystèmes d’une importance particulière pour les recherches et les études scientifiques; et de zones qui 
                préservent les besoins de la biosphère. (GEMET- DODERO/WPR) (nous vérifions pour une description de la CBD)',
            'marine_and_coastal' => 'Une aire marine et côtière protégée (AMP ou AMPC) est «une aire située à l’intérieur 
                ou à proximité du milieu marin, ainsi que ses eaux surjacentes et la flore, la faune et les caractéristiques 
                historiques et culturelles associées, qui a été réservée par la législation ou par d’autres moyens efficaces, 
                y compris les aspects culturels-traditionnels, de sorte que sa biodiversité marine et/ou côtière bénéficie d’un 
                niveau de protection plus élevé que son environnement» (Convention sur la diversité biologique — CDB)',
            'oecm' => '(OECM ou AMCE Autres Mesures de Conservation Efficaces ou AMCE) Une zone géographiquement définie autre 
                qu’une aire protégée, qui est régie et gérée de manière à obtenir des résultats positifs et durables à long 
                terme pour la conservation in situ de la biodiversité, avec les fonctions et services écosystémiques associés 
                et, le cas échéant, les valeurs culturelles, spirituelles, socio-économiques et autres valeurs pertinentes au 
                niveau local «(CBD, 2018)',
            'icca' => 'Territoires et aires conservés par les peuples autochtones et les communautés locales (ICCA) Un écosystème 
                naturel et/ou modifié, contenant des valeurs importantes de biodiversité, des avantages écologiques et des valeurs 
                culturelles, conservé volontairement par les peuples autochtones et les communautés locales, par le biais du 
                droit coutumier ou d’autres moyens efficaces (CBD — Reconnaissance et soutien des ICCA)'
        ]
    ],

    'Governance' => [
        'title' => 'Gouvernance et Partenariat',
        'fields' => [
            'Partner' => 'Noms du partenaire',
            'InstitutionType' => 'Type d\'institution',
            'PartnershipsType1' => 'Type de partenariat le plus important: première',
            'PartnershipsType2' => 'deuxième',
            'PartnershipsType3' => 'troisième',
            'Type' => 'Typologie de gouvernance de l\'aire protégée',
            'Comments' => 'Précisions sur la typologie de gouvernance (si nécessaire) ',
        ],
        'governance' => 'Gouvernance',
        'partnership' => 'Partenariats',
    ],

    'SpecialStatus' => [
        'title' => 'Désignations spéciales de l\'aire protégée (Patrimoine mondial, MAB, Site Ramsar, IBAs, SPAMI, LMMA, ... )',
        'fields' => [
            'Designation' => 'Désignation',
            'RegistrationDate' => 'Date d\'inscription',
            'Code' => 'Code',
            'Area' => 'Superficie (ha)',
            'DesignationCriteria' => 'Critères de désignation',
            'upload' => 'Charger',
        ],
        'groups' => [
            'conventions'   => 'Désignations (inclusions) dans la liste des conventions internationales (Patrimoine Mondial, RAMSAR, etc.,)',
            'networks'      => 'Appartenance à un réseau international officiellement reconnu (MAB, RAPAC, etc.,)',
            'conservation'  => 'Site désigné par des organismes internationaux (IBA, AZE, etc.) pour son intérêt en matière de conservation',
            'marine_pa'     => 'Statut des aires protégées marines'
        ],
        'module_info' => 'La liste indicative, mais pas exhaustive est disponible dans la guide du formulaire'
    ],

    'Networks' => [
        'title' => 'Appartenance à un réseau de gestion local, national, paysage, transfrontalier, régional ou international',
        'fields' => [
            'NetworkName' => 'Nom',
            'ProtectedAreas' => 'Noms des autres aires protégées du réseau',
        ],
        'groups' => [
            'group0' => 'Réseau transfrontalier',
            'group1' => 'Paysage terrestre - Landscape (réseau des AP terrestres) - Paysage marin - seascape (réseau des AP marines)',
            'group2' => 'Autre réseau',
        ]
    ],

    'Missions' => [
        'title' => 'Vision - Mission - Objectifs',
        'fields' => [
            'LocalVision' => 'Vision (au niveau local ou national)',
            'LocalMission' => 'Mission',
            'LocalObjective' => 'Objectifs',
            'LocalSource' => 'Source',
            'LocalManagementPlan' => 'Fichier (Plan d\'aménagement)',
            'InternationalVision' => 'Vision (au niveau international)',
            'InternationalMission' => 'Mission',
            'InternationalObjective' => 'Objectifs',
            'InternationalSource' => 'Source',
            'InternationalManagementPlan' => 'Fichier (Plan d\'aménagement)',
            'Observation' => 'Observation',
        ]
    ],

    'Contexts' => [
        'title' => 'Références des contextes historique, politique, juridique et institutionnel, socioéconomique  et autres éléments spécifiques de l’aire protégée ',
        'fields' => [
            'Context' => 'Contexte ou élément spécifique',
            'file' => 'Fichier',
            'Summary' => 'Résumé',
            'Source' => 'Source',
            'Observations' => 'Observations',
        ],
        'predefined_values' => [
            'Contexte historique',
            'Contexte socioéconomique',
            'Contexte politique (niveau pays)',
            'Contexte juridique',
            'Contexte institutionnel'
        ],
    ],

    'GeographicalLocation' => [
        'title' => 'Localisation',
        'fields' => [
            'LimitsExist' => 'Existence de limites géoréférencées officielles (oui/non)',
            'Shapefile' => 'Fichier SIG',
            'SourceSHP' => 'Source du fichier SIG',
            'Coordinates' => 'Coordonnées géographiques (préciser s’il s’agit d’une référence WDPA ou une référence SIG d’un autre point clé du parc)',
            'SourceCoords' => 'Source des coordonnées',
            'AdministrativeLocation' => 'Localisation administrative de la zone protégée (province, région, etc.)',
        ]
    ],

    'Areas' => [
        'title' => 'Superficies de l’aire protégée et du contexte de conservation',
        'fields' => [
            'AdministrativeArea' => 'Superficie administrative',
            'WDPAArea' => 'Superficie WDPA',
            'GISArea' => 'Superficie SIG correspondante au fichier téléchargé (données résultants d’une analyse SIG réalisée par l’aire protégée ou par l’autorité nationale responsable des aires protégées)',
            'BoundaryLength' => 'Longueur des limites',
            'TerrestrialArea' => 'Superficie protégée terrestre',
            'MarineArea' => 'Superficie protégée marine et côtière',
            'PercentageNationalNetwork' => '% par rapport au réseau national des aires protégées',
            'PercentageEcoregion' => '% par rapport à l’écorégion ou à chacune des écorégions pour le cas des aires protégées appartenant à plusieurs réseaux',
            'PercentageTransnationalNetwork' => '% par rapport réseau transfrontalier',
            'PercentageLandscapeNetwork' => '% par rapport au landscape/network',
            'Index' => 'Indice de forme (RACINE(3.14)/(6.28)*périmètre/RACINE(superficie) = bon 1 - 1,5; moyen de 1,5 - 2;  faible > 2)',
            'Observations' => 'Observations',
        ]
    ],

    'Sectors' => [
        'title' => 'Patrouilles et application de la loi: Zone ou secteurs terrestres et/ou Zone ou secteurs marins et côtiers',
        'fields' => [
            'Name' => 'Secteur',
            'TerrestrialOrMarine' => 'Terrestre ou marine et côtier?',
            'UnderControlArea' => 'Km² de surface couverte par la patrouille',
            'UnderControlPatrolKm' => 'Km de patrouille',
            'UnderControlPatrolManDay' => 'Jours de patrouille',
            'SectorMap' => 'Carte de zonage',
            'Source' => 'Source',
            'Observations' => 'Observations',
        ],
        'area_percentage'               => '% de la surface',
        'average_time'                  => 'Patrouille moyenne * j * Km² de secteur'
    ],

    'TerritorialReferenceContext' => [
        'title' => 'Contexte territorial de référence (paysage) de l’Aire Protégée',
        'fields' => [
            'FunctionalHasNoTakeArea' => 'L’aire de l’écosystème fonctionnel correspond-elle à la zone de non-prélèvement ?',
            'FunctionalArea' => 'Estimer la superficie de l’écosystème fonctionnel importante pour le maintien de la biodiversité de l’aire protégée (habitats, espèces clés, etc.): a) en Km² et b) en Km de largeur de la bande extérieure',
            'FunctionalPopulation' => 'Estimer la population humaine vivant dans l’aire de l’écosystème fonctionnel',
            'EcologicalAspects' => 'Préciser l’éventuelle présence de facteurs écologiques qui doivent être pris en considération dans la gestion de l’aire protégée (p.ex. domaines vitaux des espèces phare) et estimer la surface en km2',
            'BenefitArea' => 'Estimer la zone habitée qui est influencée par l’aire protégée: a) en km² et b) en Km de largeur de la bande extérieure',
            'BenefitPopulation' => 'Estimer la population locale vivant dans l’aire d’influence socio-économique',
            'BenefitSocioEconomicAspects' => 'Énumérer et décrire les facteurs socio-économiques et administratifs (p. ex. les normes coutumières et  modernes qui régissent ou influencent la gestion des ressources naturelles)',
            'SpillOverArea' => 'Estimer les effets du débordement (spill-over) des zones de conservation strictes. Zone de débordement pour maintenir l’approvisionnement en services écosystémiques (p. ex. pêche) fournis par l’aire protégée: a) en km² et b) en mètres de largeur de la bande extérieure',
            'SpillOverEvalPredatory0_500' => '',
            'SpillOverEvalPredatory500_1000' => '',
            'SpillOverEvalPredatory200_3000' => '',
            'SpillOverEvalComposition0_500' => '',
            'SpillOverEvalComposition500_1000' => '',
            'SpillOverEvalComposition200_3000' => '',
            'SpillOverEvalDistance0_500' => '',
            'SpillOverEvalDistance500_1000' => '',
            'SpillOverEvalDistance200_3000' => '',
        ],
        'info' => [
            'spillover_eval' =>
                'Le mouvement net des individus des réserves marines (également connues sous le nom d’aires marines protégées 
                sans prélèvement) vers les zones de pêche restantes est connu sous le nom de spill-over. Le débordement 
                peut contribuer à la réduction de la pauvreté des populations, bien que son effet soit modulé par le nombre 
                de pêcheurs et l’intensité de la pêche. En général:
                <ul>
                    <li>Fort effet positif de débordement (spill-over) lorsque la pêche est mal gérée</li>
                    <li>Léger effet de débordement (spill-over) positif lorsque la pêche est bien gérée, mais un effet positif pour les espèces à plus grand mouvement et à croissance plus lente</li>
                    <li>Évaluer l’effet de débordement (spill-over) d’une réserve capable de fournir un bénéfice net pour une pêcherie (de Garry Russ & Angel Alcala, Enhanced biodiversity beyond marine reserve boundaries: the cup spill-over):<ul>
                    <li>les poissons prédateurs (les gros poissons prédateurs sont plus fréquents à l’intérieur et juste à l’extérieur des réserves que plus loin)</li>
                    <li>composition à l’extérieur et à l’intérieur (la composition de la communauté à l’extérieur des réserves se rapproche de celle à l’intérieur au fil du temps)</li>
                    <li>distance de détection de l’effet de débordement (la distance par rapport à la limite et le temps écoulé après la création de la réserve sont les variables qui ont l’effet le plus fort sur l’abondance des poissons; prédation des poissons: A) 500 m et moins; B) 500 à 1000 m; C) 2000 à 3000 m</li>
                </ul>',
            'spill_over_variation' => 'SPILL-OVER Variation à l’intérieur et à l’extérieur de l’AMP',
            'variation' => 'Variation à l’intérieur et à l’extérieur de l’AMP',
            '0_500' => '0 à 500m',
            '500_1000' => '500 à 1000m',
            '2000_3000' => '2000 à 3000m',
            'predatory' => 'Poissons prédateurs',
            'composition' => 'Composition de la communauté de poissons',
            'distance' => 'Distance de l’effet de débordement (spil-over)',
        ],
        'ratingLegend' => [
            'SpillOverEvalPredatory0_500' => [
                '-2' => 'Forte différence négative',
                '-1' => 'Faible différence négative',
                '0' => 'Aucune différence',
            ]
        ],
        'categories' => [
            'FunctionalEcosystemArea' => 'Aire fonctionnelle de l’écosystème',
            'BenefitsOfEcosystemServicesArea' => 'Zone qui bénéficie des services écosystémiques fournis par l’aire protégée',
            'SpillOverArea' => 'Zone de débordement (spill-over)',
        ],
        'module_info' => '<b>Landscape</b>: Linked governance and management of a protected area and its surrounding territories 
          can contribute to biodiversity conservation and climate resilience, maintenance of natural resources and ecosystem 
          services that ensure sustainable development of local communities. <br />
          <b>Protected and Conserved Areas (PCAs)</b>: They are one of the most effective tools for preventing loss of 
          natural ecosystems and species, as well as to achieve long-term sustainable development, including Aichi targets 
          11 and 12 and several Sustainable Development Goals (SDGs). In some regions, PCAs are the center of economic 
          development, through tourism, sustainable use of resources and as sources of freshwater. PCAs also contribute 
          to food security through maintenance of the ecosystem services that support agriculture, by protecting resources 
          essential for crop breeding programmes, and by providing space for traditional biodiversity-friendly farming and 
          grazing systems. PCAs also have a major role to play in climate resilience, both by storing and sequestering carbon, 
          and by ensuring that ecosystems continue to provide goods and services to human societies (WWF).',
    ],

    'ManagementStaff' => [
        'title' => 'Effectifs et composition du personnel: Personnel de l\'aire protégée',
        'fields' => [
            'Function' => 'Fonctions',
            'ExpectedPermanent' => 'Effectifs prévus ou adéquats',
            'ActualPermanent' => 'Effectifs actuels',
            'Observations' => 'Observations',
            'difference' => 'Différence',
            'Source' => 'Source',
        ],
        'module_info' => 'Le système statistique ne permet que quatorze lignes pour identifier les fonctions du personnel de l’aire protégée'
    ],

    'ManagementStaffPartners' => [
        'title' => 'Effectifs et composition du personnel: Personnel Partenaires',
        'fields' => [
            'Partner' => 'Partenaire',
            'Coordinators' => 'Coordinateurs',
            'Technicians' => 'Personnel technique et administratif',
            'Auxiliaries' => 'Personnel auxiliaire',
        ]
    ],

    'ManagementStaffCommunities' => [
        'title' => 'Effectifs et composition du personnel: Personnel Communautés',
        'fields' => [
            'Community' => 'Communauté',
            'Role1' => 'Rôle',
            'StaffNUmberRole1' => 'Nombre',
            'Role2' => 'Rôle',
            'StaffNUmberRole2' => 'Nombre',
            'Role3' => 'Rôle',
            'StaffNUmberRole3' => 'Nombre',
        ]
    ],

    'FinancialResources' => [
        'title' => 'Ressources financières: Budget et coûts de gestion',
        'fields' => [
            'Currency' => 'Devise',
            'ReferenceYear' => 'Année de référence',
            'ManagementFinancialPlanCosts' => 'Coûts de fonctionnement annuel estimés à partir du Plan financier pluriannuel [$ ou €/an]',
            'OperationalWorkPlanCosts' => 'Coûts de fonctionnement estimés à partir du Plan de travail annuel [$ ou €/an]',
            'TotalBudget' => 'Budget total annuel effectivement disponible [$ ou €/an]',
        ],
        'amount'                        => 'Montant',
        'functioning_costs'             => 'Coûts de fonctionnement ($ ou €/Km²/an)',
        'estimation_financial_plan'     => '% du Plan financier (budget annuel)',
        'estimation_operational_plan'   => '% du Plan de travail (budget annuel)',
        'module_info' => 'Coûts totaux estimés à partir du Plan financier'
    ],

    'FinancialAvailableResources' => [
        'title' => 'Ressources financières: Budget disponible',
        'fields' => [
            'BudgetType' => '',
            'NationalBudget' => 'Budget national',
            'OwnRevenues' => 'Recettes de l’aire protégée',
            'Disputes' => 'Contentieux (trésor public)',
            'Partners' => 'Contributions des partenaires',
            'total' => 'Total',
            'percentage' => '% des prévisions du budget',
        ],
        "predefined_values" => [
            "Budget total annuel disponible",
            "Budget total annuel disponible pour le fonctionnement",
            "Budget total annuel disponible pour les investissements"
        ],
        'module_info' => 'Montants dans la même devise spécifiée dans le module <b>CTX 3.2.1</b>',
        'sum_error' => 'Le total doit correspondre au budget total déclaré dans le module <b>CTX 3.2.1</b>.'
    ],

    'FinancialResourcesBudgetLines' => [
        'title' => 'Ressources financières: Lignes budgétaires du plan opérationnel/plan de travail budgétisé annuellement',
        'fields' => [
            'Line' => 'Lignes budgétaires',
            'Amount' => 'Montant ($ ou €/an)',
            'BudgetSource' => 'Source de financement',
            'function_costs' => 'Coûts de fonctionnement ($ ou € /Km²/an)',
            'percentage' => '% du budget disponible',
        ],
        'module_info' => 'Montants dans la même devise spécifiée dans le module <b>CTX 3.2.1</b>',
        'sum_error' => 'Le total doit correspondre au budget total déclaré dans le module <b>CTX 3.2.1</b>.'
    ],

    'FinancialResourcesPartners' => [
        'title' => 'Contribution des partenaires au soutien de l’aire protégée',
        'fields' => [
            'Partner' => 'Partenaire',
            'Funding' => 'Appui (financement / projet / activités)',
            'Contribution' => 'Montant ($ ou €/an)',
            'StartDate' => 'Début',
            'EndDate' => 'Fin prévue',
            'Observations' => 'Observations',
            'Currency' => 'Devise',
        ],
        'module_info' => 'Montants dans la même devise spécifiée dans le module <b>CTX 3.2.1</b>'
    ],

    'Equipments' => [
        'title' => 'Disponibilité en infrastructures, en équipement et en installations',
        'fields' => [
            'Resource' => 'Identification',
            'AdequacyLevel' => 'Rapport nécessité/disponibilité',
            'Comments' => 'Commentaires / Source',
        ],
        'groups' => [
            'group0' => 'Bâtiments administratifs',
            'group1' => 'Logements',
            'group2' => 'Tourisme',
            'group3' => 'Moyens de transport',
            'group4' => 'Equipements anti-braconnage',
            'group5' => 'Moyens de communication',
            'group6' => 'Informatique',
            'group7' => 'Équipements de production d’eau et d’électricité pour les services',
            'group8' => 'Matériel d’entretien pour (voir catégories)',
            'group9' => 'Routes et pistes',
            'group10' => 'Voies fluviales',
            'group11' => 'Pistes aériennes',
            'group12' => 'Liens et connexions de l’aire protégée avec le monde extérieur',
        ],
        'predefined_values' => [
            'group0' => ['Bureaux','Postes de patrouille','Points de barrières','Bâtiments scientifiques','Garage et atelier','Espace pour les bouteilles et autres équipements de plongée', 'Hangars à bateaux', 'Parking voitures-bateaux', 'Services divers (magazine, radio, etc.)','Dispensaires'],
            'group1' => ['pour Officiers et sous-officiers', 'pour les Agents', 'pour le Personnel d\'appui', 'pour le Personnel scientifique'],
            'group2' => ['Hôtels (capacité d’accueil)', 'Eco-lodges (capacité d’accueil)', 'Campements', 'Accueils des touristes', 'Points de vue ou points d’observation (miradors)', 'Parcours touristiques aménagés'],
            'group3' => ['Voitures','Motos/Quads','Vélos','Bateaux', 'Moteurs hors-bord', 'Pirogues','Avion, ULM','Jet ski','Animaux (chevaux)'],
            'group4' => ['Radar de contrôle','Armements','Cartouches','Tenues','Rations','GPS, Boussoles', 'Matériel de camping et de brousse'],
            'group5' => ['Radios VHF-HF','V-SAT','Téléphones fixes','Téléphones GSM','Téléphones satellitaires','Connexion internet'],
            'group6' => ['Ordinateurs fixes','Ordinateurs portables','Imprimantes','Photocopieurs','Onduleur'],
            'group7' => ['Groupes électrogènes','Installation électrique solaire','Installation électrique hydraulique','Installation électrique éolienne'],
            'group8' => ['Matériel roulant/bateaux','Radios','Bâtiments','Réseau électrique','Réseau hydraulique'],
            'group9' => ['Routes/pistes de pénétration dans l\'aire protégée','Route de délimitation de l’aire protégée', 'Chemins à l’intérieur de l’aire protégée'],
            'group10' => ['Voies fluviales à l’intérieur de l’aire protégée'],
            'group11' => ['Pistes aériennes à l\'intérieur et/ou à l\'extérieur de l\'aire protégée'],
            'group12' => ['Principales voies de communication terrestres','Voies navigables intérieures et maritimes','Liaisons aériennes nationales et internationales de proximité'],
        ],
        'ratingLegend' => [
            'AdequacyLevel' => [
                '0' => 'Totalement inadéquat (0-30 % des besoins)',
                '1' => 'Plutôt inadéquat (31-60 % des besoins)',
                '2' => 'Adéquat (61-90 % des besoins)',
                '3' => 'Tout à fait adéquat (91-100 % des besoins)',
            ]
        ]
    ],

    'AnimalSpecies' => [
        'title' => 'Espèces animales (espèces phares, menacées, endémiques, exploitées, envahissantes, etc.) choisis comme éléments clés de l’aire protégée et nécessitant un suivi dans le temps',
        'fields' => [
            'SpeciesID' => 'Espèce',
            'FlagshipSpecies' => 'PHA',
            'EndangeredSpecies' => 'MEN',
            'EndemicSpecies' => 'END',
            'ExploitedSpecies' => 'EXP',
            'InvasiveSpecies' => 'INV',
            'InsufficientDataSpecies' => 'INS',
            'PopulationEstimation' => 'Estimation de l’état actuel',
            'DesiredPopulation' => 'Etat de conservation souhaité',
            'TrendRating' => 'Tendance',
            'Reliability' => 'Fiabilité',
            'Comments' => 'Commentaires / Source',
        ],
        'module_info' => 'État de conservation favorable: Selon Natura 2000, l’état de conservation des espèces est considéré 
            comme « favorable » lorsque:
            <ul>
                <li>les données sur la dynamique des populations de l’espèce concernée indiquent qu’elle se maintient à long terme en tant que composante viable de ses habitats naturels, et</li>
                <li>l’aire de répartition naturelle de l’espèce n’est ni réduite ni susceptible de l’être dans un avenir prévisible, et il existe, et il existera probablement encore à long terme un habitat suffisamment vaste pour maintenir ses populations</li>
            </ul>
            Evaluation: Évaluer, à partir de la liste des espèces supposées exister (voir les listes A de l’UICN - mammifères, 
            B - oiseaux et C - amphibiens), un nombre limité d’espèces clés de l’aire protégée.<br />
            <b>Types d\'espèces</b>
            <ul>
                <li><b>PHA</b>: Espèce phare</li>
                <li><b>MEN</b>: Espèce en voie de disparition menacée</li>
                <li><b>END</b>: Espèce endémique</li> <li><b>EXP</b>: Espèce exploitée</li>
                <li><b>INV</b>: Espèce invasive</li> <li><b>INS</b>: Espèce avec faible niveau de connaissance</li>
            </ul>',
        'validation_min3' => 'Veuillez encoder au moins 3 des espèces clés.',
        'warning_on_save' =>
            'ATTENTION!!<br />Toute modification provoquera une perte complète des données dans les modules
            d\'évaluation suivants (s\'ils sont déjà codés):<br /> <i>C1.2</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'VegetalSpecies' => [
        'title' => 'Espèces de plantes: espèces phares, menacées, endémiques, exploitées, envahissantes, etc. et choisis comme éléments clés pour l’aire protégée et qui devront faire l’objet d’un suivi dans le temps',
        'fields' => [
            'Species' => 'Espèce',
            'FlagshipSpecies' => 'PHA',
            'EndangeredSpecies' => 'MEN',
            'EndemicSpecies' => 'END',
            'ExploitedSpecies' => 'EXP',
            'InvasiveSpecies' => 'INV',
            'InsufficientDataSpecies' => 'INS',
            'PopulationEstimation' => 'Estimation de l’état actuel',
            'DesiredPopulation' => 'Etat de conservation souhaité',
            'TrendRating' => 'Tendance',
            'Reliability' => 'Fiabilité de l’information',
            'Comments' => 'Commentaires / Source',
        ],
        'module_info' =>'État de conservation favorable: Selon Natura 2000, L’état de conservation des espèces est considéré comme « favorable » lorsque:<ul><li>les données sur la dynamique des populations de l’espèce concernée indiquent qu’elle se maintient à long terme en tant que composante viable de ses habitats naturels, et</li><li>l’aire de répartition naturelle de l’espèce n’est ni réduite ni susceptible de l’être dans un avenir prévisible, et il existe, et il existera probablement encore à long terme un habitat suffisamment vaste pour maintenir ses populations</li></ul>Evaluation: Évaluer, à partir de la liste des plantes supposées exister (voir les listes mises à disposition et les informations du parc), un nombre limité d’espèces végétales clés de l’aire protégée.<br /> <b>Types d\'espèces</b> <ul> <li><b>PHA</b>: Espèce phare</li> <li><b>MEN</b>: Espèce menacée</li> <li><b>END</b>: Espèce endémique</li> <li><b>EXP</b>: Espèce exploitée</li> <li><b>INV</b>: Espèce invasive</li> <li><b>INS</b>: Espèce avec faible niveau de connaissance</li> </ul>',
        'warning_on_save' =>
            'ATTENTION!!<br />Toute modification provoquera une perte complète des données dans les modules
            d\'évaluation suivants (s\'ils sont déjà codés):<br /> <i>C1.2</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'Habitats' => [
        'title' => 'Habitats choisis comme éléments clés pour l’aire protégée et qui devront faire l’objet d’un suivi dans le temps',
        'fields' => [
            'EcosystemType' => 'Type d\'habitat',
            'Value' => 'Description de l’état ou de la valeur',
            'Area' => 'Surface (ha)',
            'DesiredConservationStatus' => 'Etat de conservation souhaité',
            'Trend' => 'Tendance',
            'Reliability' => 'Fiabilité',
            'Sectors' => 'Secteurs',
            'Comments' => 'Commentaires / Source',
        ],
        'module_info' =>'État de conservation favorable: Selon Natura 2000, l’état de conservation d’un habitat naturel est considéré comme « favorable » lorsque:<ul><li>son aire de répartition naturelle et les zones qu’il couvre à l’intérieur de cette aire sont stables ou en augmentation, et</li><li>la structure et les fonctions spécifiques qui sont nécessaires à son maintien à long terme existent et sont susceptibles de continuer à exister dans un avenir prévisible</li></ul>Sur la base de plusieurs paramètres relatifs aux habitats (externe = irremplaçabilité et internes = spécificités de l\'aire protégée), le gestionnaire détermine les spécificités des habitats terrestres et marine de l\'aire protégée qui devront faire l\'objet d\'un suivi dans le temps.<br /> <b>Note</b>: l\'évaluation des écosystemes et habitats est une discipline très complexe. La classification prévoit la division de territoire suivante: Biome, Ecorégion, Ecosystème, Habitat. Les caractéristiques de l\'habitat / valeurs peuvent être évaluées comme: <ul> <li>i) sous la menace d\'extinction (au sein de leur aire de répartition naturelle),</li> <li>ii) ayant une aire de répartition naturelle réduite,</li> <li>iii) en déclin,</li> <li>iv) un exemple exceptionnel de caractéristiques spécifiques, etc.</li> </ul> Les Caractéristiques / Valeurs des écosystèmes et habitats peuvent être estimées comme spécifique pour: <ul> <li>i) la reproduction,</li> <li>ii) la nutrition,</li> <li>iii) la protection des espèces, etc.</li> </ul>',
        'warning_on_save' =>
            'ATTENTION!!<br />Toute modification provoquera une perte complète des données dans les modules
            d\'évaluation suivants (s\'ils sont déjà codés):<br /> <i>C1.3</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'MenacesPressions' => [
        'title' => 'Pressions et menaces',
        'fields' => [
            'Value' => 'Valeurs',
            'Impact' => 'Impact/ Sévérité',
            'Extension' => 'Ampleur/ Etendue',
            'Duration' => 'Durée/ Irréversibilité',
            'Trend' => 'Tendance',
            'Probability' => 'Probabilité de la menace dans le futur',
        ],
        'groups' => [
            'group0' => 'Développement commercial et résidentiel',
            'group1' => 'Cultures annuelles ou pluriannuelles (non-ligneuses)',
            'group2' => 'Plantations pour le bois et la pulpe',
            'group3' => 'Elevage à petite et grande échelle',
            'group4' => 'Aquaculture marine et d\'eau douce',
            'group5' => 'Autre typologie de production',
            'group6' => 'Production d\'énergie et exploitation minière',
            'group7' => 'Transports et infrastructures',
            'group8' => 'Chasse et prélèvement d\'animaux terrestres',
            'group9' => 'Cueillette et prélèvement de plantes terrestres',
            'group10' => 'Exploitation forestière et récolte de bois',
            'group11' => 'Pêche et exploitation de ressources aquatiques',
            'group12' => 'Intrusions et perturbations humaines',
            'group13' => 'Incendies et feux de brousse',
            'group14' => 'Barrages et gestion ou utilisation de l\'eau',
            'group15' => 'Autres modifications de l\'écosystème',
            'group16' => 'Espèces envahissantes et problématiques',
            'group17' => 'Eaux usées domestiques et urbaines',
            'group18' => 'Effluents industriels et militaires',
            'group19' => 'Effluents agricoles et forestiers',
            'group20' => 'Détritus et déchets solides',
            'group21' => 'Pollutions atmosphériques',
            'group22' => 'Energie excessive',
            'group23' => 'Phénomènes géologiques',
            'group24' => 'Changement climatique et phénomènes météorologiques graves',
            'group25' => 'Autres pressions et menaces'
        ],
        'predefined_values' => [
            'group0' => [
                'Zones urbaines et habitations',
                'Zones commerciales',
                'Zones touristiques et récréatives',
                'Zones des enclaves',
                'Voies de navigation, ports, constructions maritimes',
                'Activités intérieures'
            ],
            'group1' => [
                'Agriculture itinérante',
                'Petites exploitations agricoles',
                'Exploitations agro-industrielles',
                'Production de fruits/légumes'
            ],
            'group2' => [
                'Petites plantations',
                'Plantations agro-industrielles'
            ],
            'group3' => [
                'Pâturage nomade',
                'Pâturage et élevage de petites exploitations',
                'Pâturage et élevage agro-industriel'
            ],
            'group4' => [
                'Aquaculture de subsistance ou artisanale',
                'Trop d’élément nutritifs',
                'Aquaculture industrielle'
            ],
            'group6' => [
                'Forages (gaz et pétrole)',
                'Exploitation de mines ou de carrières',
                'Energies renouvelables'
            ],
            'group7' => [
                'Routes',
                'Réseaux et lignes de services publics et de communication (électricité, téléphone, aqueduc, etc.)',
                'Voies navigables et voies de navigation maritimes',
                'Navigation commerciale',
                'Navigation privée de plaisance ',
                'Couloirs aériens',
                'Voies ferrées'
            ],
            'group8' => [
                'Chasse d\'animaux terrestres',
                'Prélèvement d\'animaux vivants'
            ],
            'group9' => [
                'Cueillette de produits des plantes',
                'Prélèvement des plantes vivantes'
            ],
            'group10' => [
                'Exploitation bois d\'oeuvre à grande échelle',
                'Exploitation bois d\'oeuvre à petite échelle',
                'Exploitation bois énergie à grande échelle',
                'Exploitation bois énergie à petite échelle',
                'Perche/poteau pour construction'
            ],
            'group11' => [
                'Pêche de subsistance ou à petite échelle',
                'Pêche à grande échelle',
                'Récolte de ressources aquatiques de subsistance ou à petite échelle',
                'Récolte de ressources aquatiques à grande échelle',
                'Récolte de coquillages',
                'Prélèvement/enlèvement illégal de la faune marine',
                'Surpêche et pêche destructive',
                'Exploitation des espèces menacées d’extinction',
                'Chalutiers/sous-marins',
            ],
            'group12' => [
                'Activités récréatives',
                'Travaux et autres activités',
                'Bruit et autres formes de pollution',
                'Sports de plein air, loisirs et activités récréatives',
                'Intrusions et perturbations humaines multiples',
                'Pêche récréative à la ligne et à l’hameçon',
                'Pêche de loisir, chasse sous-marine',
                'Baignade et piétinement',
                'Plongée sous-marine',
                'Guerres, troubles civils et exercices militaires'
            ],
            'group13' => [
                'Fréquence et intensité des incendies',
                'Modifications des conditions hydrauliques dues à l’homme',
                'Changements des conditions abiotiques',
                'Changements dans les conditions biotiques'
            ],
            'group14' => [
                'Prélèvement d\'eau de surface (utilisation domestique)',
                'Prélèvement d\'eau de surface (utilisation commerciale)',
                'Prélèvement d\'eau de surface (utilisation agricole)',
                'Prélèvement d\'eau de surface (utilisation inconnue)',
                'Prélèvement d\'eau souterraine (utilisation domestique)',
                'Prélèvement d\'eau souterraine (utilisation commerciale)',
                'Prélèvement d\'eau souterraine (utilisation agricole)',
                'Prélèvement d\'eau souterraine (utilisation inconnue)',
                'Petits barrages',
                'Grands barrages',
                'Barrages (taille inconnue)'
            ],
            'group16' => [
                'Espèces ou maladies introduites et envahissantes',
                'Espèces ou maladies indigènes problématiques',
                'Espèces ou maladies problématiques d\'origine inconnue',
                'Matériel génétique introduit',
                'Maladies virales ou prion',
                'Maladie de cause inconnue',
                'Évolution biocénotique',
                'Relations faunistiques interspécifiques',
                'Modifications multiples de l’écosystème'
            ],
            'group17' => [
                'Eaux usées et égouts',
                'Fuites (liquid or gas)',
                'Plastiquecs'
            ],
            'group18' => [
                'Marée noire ou nappe de pétrole',
                'Rejets de navires',
                'Fuite d\'exploitation minière'
            ],
            'group19' => [
                'Charge en éléments nutritifs',
                'Erosion des sols et sédimentation',
                'Herbicides et pesticides',
                'Pollution à l’échelle du bassin versant'
            ],
            'group20' => [
                'Déchets des villes',
                'Déchets libérés par les voitures/ par les bateaux',
                'Débris de construction',
                'Déchets nuisibles pour la faune'
            ],
            'group21' => [
                'Pluies acides',
                'Nuage de pollution',
                'Ozone'
            ],
            'group22' => [
                'Pollution lumineuse',
                'Pollution thermique',
                'Pollution à l\'ozone',
                'Pollution sonore'
            ],
            'group23' => [
                'Volcans',
                'Tremblements de terre et tsunamis',
                'Avalanches et glissements de terrain',
                'Processus naturels abiotiques'
            ],
            'group24' => [
                'Altération et modification de l\'habitat',
                'Sécheresses',
                'Températures extrêmes',
                'Tempêtes et inondations',
                'Augmentation des pluies et changements saisonniers',
                'Réchauffement, acidification, blanchiment, désoxygénation'
            ],
            'group25' => [
                'Conflit Homme-Faune'
            ]
        ],
        'categories' => [
            'title1' =>  'Développement commercial et résidentiel',
            'title2' =>  'Agriculture et aquaculture',
            'title3' =>  'Production d\'énergie et exploitation minière',
            'title4' =>  'Transports et infrastructures',
            'title5' =>  'Utilisation des ressources biologiques',
            'title6' =>  'Intrusions et perturbations humaines',
            'title7' =>  'Modifications du système naturel',
            'title8' =>  'Espèces envahissantes et problématiques',
            'title9' =>  'Pollution',
            'title10' => 'Phénomènes géologiques',
            'title11' => 'Changement climatique et phénomènes météorologiques graves',
            'title12' => 'Autres pressions et menaces'
        ],
        'ratingLegend' => [
            'Impact' => [
                '0' => 'peu sévère',
                '1' => 'modéré',
                '2' => 'fort',
                '3' => 'sévère',
            ],
            'Extension' => [
                '0' => 'localisée <5%',
                '1' => 'éparse 5-15%',
                '2' => 'largement dispersé  15-50%',
                '3' => 'partout >50%',
            ],
            'Duration' => [
                '0' => 'récente < 5 ans',
                '1' => 'à durée 5-20 ans',
                '2' => 'dure de plus 20-100 ans',
                '3' => 'est permanent >100 ans',
            ],
            'Trend' => [
                '-2' => 'en baisse',
                '-1' => 'légèrement en baisse',
                '0' => 'aucun changement',
                '1' => 'légèrement en hausse',
                '2' => 'en hausse',
            ],
            'Probability' => [
                '0' => 'très faible',
                '1' => 'faible',
                '2' => 'moyenne',
                '3' => 'élevée',
            ],
        ],
        'module_info' => 'Le calculateur de menaces permet de calculer les scores d’impact des menaces sur une zone protégée spécifique. En utilisant votre meilleur jugement professionnel, évaluez l’impact de la menace en exploitant cinq catégories de score: (1) Impact/ Sévérité ; (2) Ampleur/ Etendue ; (3) Durée/ Irréversibilité ; (4) Tendance ; (5) Probabilité de la menace dans le futur',
        'warning_on_save' =>
            'ATTENTION!!<br />Toute modification provoquera une perte complète des données dans les modules
            d\'évaluation suivants (s\'ils sont déjà codés):<br /> <i>C3</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'ClimateChange' => [
        'title' => 'Éléments clés les plus vulnérables au changement climatique',
        'fields' => [
            'Value' => 'Élément clé de la conservation',
            'Description' => 'Description des effets du changement climatique',
            'Trend' => 'Evaluation: Effet',
            'Notes' => 'Observations',
        ],
        'groups' => [
            'group0' => 'Espèces animales les plus vulnérables au changement climatique',
            'group1' => 'Espèces de plantes les plus vulnérables au changement climatique',
            'group2' => 'Habitats les plus vulnérables au changement climatique',
            'group3' => 'Services écosystémiques les plus vulnérables au changement climatique',
            'group4' => 'Autres éléments importants et valeurs clés particulièrement sensibles au changement climatique',
            'group5' => 'Autre',
        ],
        'module_info' => 'Les résultats de la section suivante appuieront les décisions de gestion pour s’assurer que l’aire protégée adopte des mesures visant à minimiser les effets du changement climatique. L’analyse assurera l’intégration des valeurs affectées par le changement climatique dans le système de gestion des aires protégées.<br />Evaluation: Identifier et évaluer l’importance d’intégrer dans les systèmes de gestion de l’aire protégée les efforts d’adaptation au changement climatique des éléments clés les plus vulnérables au changement climatique, en utilisant les échelles ci-dessous',
        'ratingLegend' => [
            'Trend' => [
                '0' => 'très affecté par le changement climatique',
                '1' => 'modérément affecté par le changement climatique',
                '2' => 'peu affecté par le changement climatique',
                '3' => 'non affecté par le changement climatique',
            ]
        ],
        'warning_on_save' =>
            'ATTENTION!!<br />Toute modification provoquera une perte complète des données dans les modules
            d\'évaluation suivants (s\'ils sont déjà codés):<br /> <i>C1.4</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'EcosystemServices' => [
        'title' => 'Services écosystémiques et dépendance des communautés/société',
        'fields' => [
            'Element' => 'Elément',
            'Importance' => 'Importance',
            'ImportanceRegional' => 'Dépendance à l’égard du service écosystémique',
            'ImportanceGlobal' => 'Tendance',
            'Observations' => 'Description/État/Observations',
        ],
        'groups' => [
            'group0' => 'Nutrition',
            'group1' => 'Matériaux',
            'group2' => 'Energie',
            'group3' => 'Assainissement des déchets, des substances toxiques et autres pollutions',
            'group4' => 'Régulation des flux',
            'group5' => 'Interactions physiques et expérience',
            'group6' => 'Interactions et amélioration intellectuelles',
            'group7' => 'Spirituel et/ou emblématiques',
            'group8' => 'Autres services écosystémiques culturels',
            'group9' => 'Support / Soutien',
        ],
        'predefined_values' => [
            'group0' => ['Approvisionnement en eau (disponibilité, épuration) - illégal', 'Approvisionnement en eau (disponibilité, épuration) - légal', 'Alimentation humaine - végétale  (tubercules, feuilles, fruits, miel, champignons, etc.) - illégal', 'Alimentation humaine - végétale (tubercules, feuilles, fruits, miel, champignons, etc.) - légal', 'Alimentation humaine - animale (viande sauvage/d’élevage, insectes) - illégal', 'Alimentation humaine - animal (viande sauvage/d’élevage, insectes) - légal', 'Médicaments / pharmacopée - illégal', 'Médicaments / pharmacopée - légal', 'Aliments pour l’élevage (poissons et bétail) - illégal', 'Aliments pour l’élevage (poissons et bétail) - légal'],
            'group1' => ['Bois à haute valeur économique - illégal', 'Bois à haute valeur économique - légal','Bois pour la construction locale - illégal', 'Bois pour la construction locale - légal', 'Fibres de tiges (palmiers, kénaf, jute, etc.) - illégal', 'Fibres de tiges (palmiers, kénaf, jute, etc.) - légal', 'Autres fibres (kapok, coco,  etc.) - illégal', 'Autres fibres (kapok, coco,  etc.) - légal', 'Ornementale (graines, coquilles, etc.) - illégal', 'Ornementale (graines, coquilles, etc.) - légal', 'Sable (bâtiment) - illégal', 'Sable (bâtiment) - légal', 'Algues/coquillages - illégal', 'Algues/coquillages - légal', 'Terres cultivées (agriculture, élevage, forêts) - illégal', 'Terres cultivées (agriculture, élevage, forêts) - légal'],
            'group2' => ['Bois de feu et biocarburants - illégal', 'Bois de feu et biocarburants - légal', 'Eau pour énergie - illégal', 'Eau pour énergie - légal', 'Engrais (production – transformation) - illégal', 'Engrais (production – transformation) - légal'],
            'group3' => ['Régulation du gaz (séquestration du C)', 'Enterrement/décomposition/neutralisation des déchets', 'Régulation des déchets (absorption d’éléments nutritifs)', 'Contrôle de l’érosion éolienne'],
            'group4' => ['Contrôle des inondations', 'Lutte contre la sécheresse', 'Protection contre les tempêtes', 'Contrôle de l’érosion par l’eau', 'Contrôle de l’érosion éolienne', 'Prévention de l\'érosion côtière'],
            'group5' => ['Esthétique (intégrité de l’écosystème)', 'Ecotourisme et observation de la nature', 'Marche, randonnée pédestre et loisirs généraux', 'Navigation de plaisance, natation et plongée', 'Plongée en apnée, navigation de plaisance et plongée', 'Chasse ou pêche si autorisée', 'Pêche traditionnelle spécifiée'],
            'group6' => ['Science — Recherche', 'Education', 'Patrimoine culturel/héritage'],
            'group7' => ['Symboliqu ou Historique', 'Sacré ou Religieuse'],
            'group8' => ['Conservation ex-situ'],
            'group9' => ['Production primaire nette (végétation)', 'Cycle des nutriments (décomposition et minéralisation de la litière)', 'Formation de l’habitat des espèces', 'Formation du paysage marin', 'Anciennes espèces d\'habitat (ex. coraux)', 'Pollinisation (plantes)', 'Cycle de l’eau', 'Paysage marin : hétérogénéité/complexité de l\'habitat (diversité favorable)'],
        ],
        'categories' => [
            'title1' => 'Approvisionnement',
            'title2' => 'Régulation',
            'title3' => 'Culturel',
            'title4' => 'Support / Soutien',
        ],
        'module_info' => '<b>Services écosystémiques — importance, dépendance des communautés/société et tendance des services écosystémiques fournis par l’aire protégé </b> <ul> <li>Evaluation: Évaluer chaque service écosystémique sur la base de: A) son importance, B) la dépendance de la population locale/société à l’égard du service écosystémique et C) la tendance de sa quantité ou de sa qualité, selon les échelles suivantes:<ul><li>Vous n’avez pas besoin d’une mesure précise de la valeur pour attribuer une note.</li><li>La détermination de la nature légale ou illégale de l’approvisionnement dépend de la désignation de l’aire protégée et des dispositions légales et règlementaires en vigueur dans l’aire évaluée</li> </ul>',
        'ratingLegend' => [
            'Importance' => [
                'Locale' => 'Importance limitée aux communautés locales ou régionales (ex. tubercules, fruits, bois de chauffage, etc.)',
                'Larger' => 'Importance étendue à la société nationale et mondiale (bassin versant, tourisme, etc.)'
            ],
            'ImportanceRegional' => [
                '0' => 'très faible',
                '1' => 'faible',
                '2' => 'moyenne',
                '3' => 'élevée',
            ],
            'ImportanceGlobal' => [
                '-2' => 'En baisse',
                '-1' => 'Légèrement en baisse',
                '0' => 'Aucun changement',
                '1' => 'Légèrement en hausse',
                '2' => 'En hausse'
            ],
        ],
        'warning_on_save' =>
            'ATTENTION!!<br />Toute modification provoquera une perte complète des données dans les modules
            d\'évaluation suivants (s\'ils sont déjà codés):<br /> <i>C1.5</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

];
