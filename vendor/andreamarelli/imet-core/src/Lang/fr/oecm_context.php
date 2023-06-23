<?php
return [

    'Create' => [
        'title' => 'Create a new IMET AMCE (WDPA)',
        'fields' => [
            'version' => 'version IMET',
            'Year' => 'Année faisant l’objet de l’évaluation',
            'wdpa_id' => 'AMCE',
            'language' => 'langue',
            'pré-remplissage avec les données de l’année précédente ',
        ]
    ],

    'CreateNonWdpa' => [
        'title' => 'Create a new IMET AMCE (non-WDPA)',
        'fields' => [
            'version' => 'version',
            'Year' => 'Année faisant l’objet de l’évaluation',
            'wdpa_id' => 'aire protégée',
            'language' => 'langue',
            'prefill_prev_year' => 'pré-remplissage avec les données de l’année précédente ',
            'pa_def' => 'definition',
            'name' => 'nom tel que fourni par l’opérateur',
            'origin_name' => 'nom dans la langue d’origine',
            'designation' => 'nom de la désignation (ex. réserve, parc sanctuaire, etc.)',
            'designation_eng' => 'désignation en anglais',
            'designation_type' => 'type de désignation',
            'marine' => 'typologie',
            'rep_m_area' => 'surface de l’aire marine protégée conservée [km<sup>2</sup>]',
            'rep_area' => 'surface de la zone protégée conservée [km<sup>2</sup>]',
            'status' => 'Designation',
            'ownership_type' => 'Type de propriété',
            'status_year' => 'Année de la promulgation',
            'country' => 'Pays',
        ],

        'allowed_international' => 'Valeurs autorisées pour les désignations de niveau international',
        'allowed_regional' => 'Valeurs autorisées pour les désignations au niveau régional',
        'allowed_national' => 'Pas de valeurs fixes pour les zones protégées désignées au niveau national',
    ],

    'GeneralInfo' => [
        'title' => 'Données de base',
        'fields' => [
            'CompleteName' => 'Nom complet de l’AMCE',
            'UsedName' => 'Nom de l’AMCE dans le site WDPA',
            'CompleteNameWDPA' => 'Name of the OECM in the WDPA site',
            'WDPA' => 'WDPA',
            'Type' => 'typologie',
            'Country' => 'Pays',
            'CreationYear' => 'Année de création',
            'ReferenceText' => 'Référence à la désignation du texte de publication',
            'Ownership' => 'Type de propriété de l’AMCE',
            'Importance' => 'Quelles sont les principales valeurs pour lesquelles la zone a été désignée ? (Fournissez une liste puis une brève description)',
        ],
        'module_info' => '<b>Introduction à la typologie</b>: IMET identifie trois catégories d’aires conservées : (1) Aires protégées terrestres (2) Zone marine et côtière protégée (3) AMCE - Autres mesures de conservation efficaces (AMCE).<br />
          Cette IMET analyse la gestion d’une AMCE définie comme "une zone géographiquement définie autre qu’une zone protégée", qui est gouverné et géré de manière à obtenir des résultats positifs et durables à long terme pour la conservation in situ de la biodiversité, avec les fonctions et services écosystémiques associés et, le cas échéant, les aspects culturels, spirituels et socio-économiques, et d’autres valeurs pertinentes au niveau local" (CDB, 2018). Les AMCE comprennent les forêts communautaires, les peuples autochtones et les territoires et zones conservés par les communautés (ICCA), les zones marines gérées localement (LMMA),
            et d’autre typologie de aires differement conservées.<br/>Quelle est la différence entre une aire protégée et une AMCE ? (Source WDPA)
            Les aires protégées et les AMCE présentent de nombreuses similitudes, telles que l’exigence d’une limite géographiquement définie et d’un engagement à long terme.
            Mais si les aires protégées sont des lieux désignés pour obtenir des résultats positifs en matière de biodiversité,
            le terme "AMCE" s’applique aux aires désignées dans n’importe quel but, où des résultats positifs en matière de biodiversité se produisent indépendamment des objectifs de gestion initiaux.
            Dans une aire protégée, la conservation doit être l’objectif principal, ou co-primaire.
            Dans un AMCE, il peut s’agir d’un objectif secondaire ou d’un objectif non explicite.<br/>
            Les AMCE englobent également des zones qui répondent à la définition d’une aire protégée,
          dans les cas où l’autorité de gouvernance préfère que la zone soit considérée comme une AMCE.<br/>
            <strong>Si votre site est une aire protégée, veuillez utiliser l’IMET pour aire protégée</strong>',
    ],

    'Governance' => [
        'title' => 'Entité de gouvernance et de gestion',
        'fields' => [
            'Stakeholder' => 'Parties prenantes',
            'StakeholderType' => 'Type d’institution',
            'GovernanceModel' => 'Modèle de gouvernance',
            'SubGovernanceModel' => 'Sous-modèle de gouvernance',
            'AdditionalInfo' => 'Informations complémentaires sur le modèle de gouvernance (si nécessaire)',
            'ManagementUnique' => 'Déterminer l’entité en charge de la gestion et de la gouvernance de l’AMCE',
            'ManagementName' => 'Name',
            'ManagementList' => 'Liste des entités impliquées dans la gestion quotidienne et la gouvernance (ne pas lister les partenaires)',
            'ManagementType' => 'Type',
            'DateOfCreation' => 'Date de création',
            'OfficialRecognition' => 'Reconnaissance officielle : L’organe de gestion a-t-il reçu une reconnaissance officielle de la part des autorités nationales ou régionales ?',
            'SupervisoryInstitution' => 'Institution de contrôle (le cas échéant)',
            'MemberRepresentativenessLevel' => 'Niveau de représentativité des membres',
            'AdditionalInformation' => 'Informations supplémentaires sur l\'entité de gestion (si nécessaire)',
        ],
        'governance' => 'Governance',
        'stakeholders' => 'Parties prenantes',
        'management' => 'Entité de gestion',
        'ratingLegend' => [
            'MemberRepresentativenessLevel' => [
                '0' => 'Less than 30% of the total population of the OECM area',
                '1' => '30–50% total population of the OECM area',
                '2' => '51–75% total population of the OECM area',
                '3' => 'More than 75% of the total population of the OECM area',
            ]
        ]
    ],

    'SpecialStatus' => [
        'title' => 'Désignations spéciales (patrimoine mondial, MAB, site Ramsar, IBA, ASPIM, LMMA, etc.)',
        'fields' => [
            'Designation' => 'Designation',
            'RegistrationDate' => 'Date d’inscription',
            'Code' => 'Code',
            'Area' => 'Area (ha)',
            'DesignationCriteria' => 'Critères de désignation',
            'upload' => 'charger',
        ],
        'groups' => [
            'conventions' => 'Désignations (inclusions) dans la liste des conventions internationales (patrimoine mondial, RAMSAR, etc.)',
            'networks' => 'Appartenance à un réseau international officiellement reconnu (MAB, RAPAC, etc.)',
            'conservation' => 'Désignation du statut d’importance pour la conservation par des organismes internationaux (IBA, AZE, etc.)',
            'marine_pa' => 'Autres désignations',
        ]
    ],

    'Networks' => [
        'title' => 'Appartenance à un réseau de gestion local',
        'fields' => [
            'NetworkName' => 'Name',
            'ProtectedAreas' => 'Noms d’autres AMCE ou aires protégées au sein du réseau',
        ],
        'groups' => [
            'group0' => 'Réseau transfrontalier',
            'group1' => 'Réseau d’un paysage (terrestre et marine AMCE)',
            'group2' => 'Autres réseaux',
        ]
    ],

    'Missions' => [
        'title' => 'Vision - Mission - Objectifs',
        'fields' => [
            'LocalVision' => 'Vision au niveau local ou national',
            'LocalMission' => 'Mission',
            'LocalObjective' => 'Objectifs',
            'LocalSource' => 'Source',
            'Observation' => 'Observation',
        ]
    ],

    'Contexts' => [
        'title' => 'Références des contextes historiques, politiques, juridiques, institutionnels et socio-économiques de l’AMCE',
        'fields' => [
            'Context' => 'Contexte ou éléments spécifiques',
            'file' => 'Fichier(s)',
            'Summary' => 'Résumé',
            'Source' => 'Source',
            'Observations' => 'Notes',
        ],
        'predefined_values' => [
            'Contexte historique',
            'Contexte socio-économique',
            'Contexte politique (pays)',
            'Contexte juridiquet',
            'Contexte institutionnel'
        ],
        'module_info' => 'Données au niveau national avec vérification au niveau local'
    ],

    'Objectives' => [
        'title' => 'Fixer des objectifs',
        'fields' => [
            'Element' => 'Objectif',
            'ShortOrLongTerm' => 'Court/long terme',
            'Comments' => 'Comments'
        ]
    ],

    'Objectives1' => [
        'module_info' => 'Établir et décrire les objectifs de conservation pour la gouvernance, les partenariats et la désignation <b>de l’AMCE</b><br /> Les objectifs fournis ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases du processus, et pour le suivi des activités de gestion de l’AMCE'
    ],

    'Objectives2' => [
        'module_info' => 'Établir et décrire les objectifs de conservation pour  <b>l’aire de l’AMCE</b><br /> Les objectifs saisis ci-dessous seront utilisés pour améliorer la gestion, et plus particulièrement pour les phases de planification, de mobilisation des ressources (intrants), de processus, et pour le suivi des activités de gestion de l’AMCE'
    ],

    'Objectives3' => [
        'module_info' => 'Établir et décrire les objectifs de conservation pour<b> les ressources humaines et financières/le soutien des partenariats dans la gestion </b>de l’AMCE<br/> Les objectifs saisis ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases du processus, et pour le suivi des activités de gestion de l’AMCE'
    ],

    'GeographicalLocation' => [
        'title' => 'Localisation',
        'fields' => [
            'LimitsExist' => 'Existence de limites officielles géoréférencées (oui / non)',
            'Shapefile' => 'Fichier SIG',
            'SourceSHP' => 'Source du fichier SIG',
            'Coordinates' => 'Coordonnées géographiques (ligne de base ou point clé dans le parc)',
            'SourceCoords' => 'Source',
            'AdministrativeLocation' => 'Situation administrative de l’AMCE (province, région, etc.)',
        ]
    ],

    'Areas' => [
        'title' => 'Surface de l’AMCE et contexte de conservation',
        'fields' => [
            'AdministrativeArea' => 'Surface administrative',
            'WDPAArea' => 'Surface selon WDPA',
            'GISArea' => 'Surface réelle (SIG du parc ou de l’autorité responsable des AMCE) correspondant au fichier téléchargé',
            'StrictConservationArea' => 'Superficie de la zone de conservation stricte (zone de non-prélèvement, zone centrale) (le cas échéant)',
            'TerrestrialArea' => 'Surface de l’AMCE terrestre, de la forêt communautaire, des ICCA, autre',
            'MarineArea' => 'Surface de l’AMCE marine et côtière, des ICCA, des LMMA, autres'
        ]
    ],

    'ManagementStaff' => [
        'title' => 'Composition et personnel de l’entité(s) de gestion (identifé in CTX 1.2).',
        'fields' => [
            'Function' => 'Functions',
            'Number' => 'Nombre',
            'Male' => 'Homme',
            'Female' => 'Femme',
            'Descriptions' => 'Descriptions',
            'AdequateNumber' => 'Nombre adéquat',
        ],
        'module_info' => 'Nombre et catégories de membres de l’organe de gestion de l’AMCE',
        'warning_on_save' => 'AVERTISSEMENT !!  <br /> Toute modification peut entraîner une perte de données dans les modules suivants (s’ils sont déjà encodés) : <i>I2, PR1</i>'
    ],

    'ManagementStaffPartners' => [
        'title' => 'Composition et personnel des organisations partenaires',
        'fields' => [
            'Partner' => 'Partenaitres',
            'Function' => 'Fonction',
            'Coordinators' => 'Coordinateurs (nombre)',
            'Technicians' => 'Personnel technique et administratif (nombre)',
            'Auxiliaries' => 'Personnel auxiliaire (nombre)',
        ]
    ],

    'ManagementRelativeImportance' => [
        'title' =>'Implication relative du personnel et des parties prenantes dans la gestion',
        'fields' => [
            'RelativeImportance' => 'Implication relative du personnel et des parties prenantes'
        ],
        'staff' => 'staff',
        'stakeholders' => 'Parties prenantes',
        'equal' =>  'Implication égale entre le personnel et les parties prenantes',
        'majority_by' =>  'Implication majoritaire par',
        'all_by' =>  'Implication de tous',
    ],

    'FinancialResources' => [
        'title' => 'Ressources financières : Budget et frais de gestion',
        'fields' => [
            'Currency' => 'Devise',
            'TotalAnnualBudgetAvailable' => 'Budget annuel total disponible',
        ],
        'module_info' => 'Estimation des coûts totaux de gestion de l’AMCE'
    ],

    'Equipments' => [
        'title' => 'Disponibilité de l’infrastructure, de l’équipement et des installations',
        'fields' => [
            'Resource' => 'Catégorie',
            'AdequacyLevel' => 'Adéquation',
            'Comments' => 'Source / Note'
        ],
        'groups' => [
            'group0' => 'Bâtiments administratifs',
            'group1' => 'Installations touristiques',
            'group2' => 'Moyens de transport',
            'group3' => 'Équipement de terrain',
            'group4' => 'Moyens de communication',
            'group5' => 'IT',
            'group6' => 'Équipement de production d’énergie',
            'group7' => 'Routes et pistes',
            'group8' => 'Voies navigables',
            'group9' => 'Liens et connexions de l’AMCE avec le monde extérieur'
        ],
        'predefined_values' => [
            'group0' => ['Bureaux', 'Centre d’information', 'Bâtiments de service (magazine, etc.)', 'Centre de soins de santé'],
            'group1' => ['Hôtels (capacité d’accueil)', 'Eco-lodges (capacité totale d’accueil)', 'Campements (capacité totale d’accueil)', 'Itinéraires touristiques disponibles (km)', 'Sentiers'],
            'group2' => ['Voitures', 'Motos/quads', 'Bicyclettes', 'Bateaux', 'Moteurs hors-bord', 'Pirogues'],
            'group3' => ['Équipement pour le travail communautaire sur le terrain', 'GPS, boussoles', 'Matériel de camping'],
            'group4' => ['Radios VHF/HF', 'V-SAT', 'Téléphones GSM', 'Connexion Internet'],
            'group5' => ['Ordinateurs de bureau', 'Ordinateurs portables', 'Imprimantes', 'Photocopieurs'],
            'group6' => ['Générateurs d’électricité', 'Installation électrique solaire', 'Installation électrique hydroélectrique', 'Installation électrique éolienne'],
            'group7' => ['Routes/pistes à l’intérieur de l’AMCE', 'Chemins à l’intérieur de l’AMCE', 'Route le long de la frontière'],
            'group8' => ['Voies navigables à l’intérieur de l’AMCE'],
            'group9' => ['Grandes voies de communication terrestres', 'Voies navigables intérieures et maritimes']
        ],
        'ratingLegend' => [
            'AdequacyLevel' => [
                '0' => 'Totalement inadéquat (0-30% des besoins)',
                '1' => 'Quelque peu inadéquat (31-60% des besoins)',
                '2' => 'Adéquat (61-90% des besoins)',
                '3' => 'Tout à fait adéquat (91-100% des besoins)',
            ]
        ],
        'warning_on_save' => 'AVERTISSEMENT !!  <br /> Toute modification peut entraîner une perte de données dans les modules suivants (s’ils sont déjà encodés) :  <i>I5, PR5</i>'
    ],

    'AnimalSpecies' => [
        'title' => 'Espèces animales (exploitées, protégées, en voie de disparition, envahissantes)',
        'fields' => [
            'SpeciesID' => 'Species',
            'ExploitedSpecies' => 'EXP',
            'ProtectedSpecies' => 'PRT',
            'DisappearingSpecies' => 'DSG',
            'InvasiveSpecies' => 'INV',
            'PopulationEstimation' => 'État estimé',
            'DescribeEstimation' => 'Décrire l’état optimal',
            'Comments' => 'Source / Note',
        ],
        'module_info' => '<b>Species types</b> <ul>
            <li><b>EXP</b>: Espèces exploitées</li>
            <li><b>PRT</b>: Espèces protégées</li>
            <li><b>DSG</b>: Espèces en voie de disparition</li>
            <li><b>INV</b>: Espèces envahissantes</li></ul>',
        'warning_on_save' => 'AVERTISSEMENT !!  <br /> Toute modification peut entraîner une perte de données dans les modules suivants (s’ils sont déjà encodés) : <i>SA 2</i>'
    ],

    'VegetalSpecies' => [
        'title' => 'Espèces végétales (exploitées, protégées, en voie de disparition, envahissantes, etc.)',
        'fields' => [
            'SpeciesID' => 'Species',
            'ExploitedSpecies' => 'EXP',
            'ProtectedSpecies' => 'PRT',
            'DisappearingSpecies' => 'DSG',
            'InvasiveSpecies' => 'INV',
            'PopulationEstimation' => 'État estimé',
            'DescribeEstimation' => 'Décrire l’état optimal',
            'Comments' => 'Source / Note',
        ],
        'module_info' => '<b>Species types</b> <ul>
            <li><b>EXP</b>: Espèces exploitées</li>
            <li><b>PRT</b>: Espèces protégées</li>
            <li><b>DSG</b>: Espèces en voie de disparition</li>
            <li><b>INV</b>: Espèces envahissantes</li></ul>',
        'warning_on_save' => 'AVERTISSEMENT !!  <br /> Toute modification peut entraîner une perte de données dans les modules suivants (s’ils sont déjà encodés): <i>SA 2</i>'
    ],

    'Habitats' => [
        'title' => 'Habitats sélectionnés comme indicateurs pour l’AMCE et qui devront faire l’objet d’un suivi dans le temps',
        'fields' => [
            'EcosystemType' => 'Types d’habitats',
            'EcosystemDescription' => 'Description pour l\'AMCE spécifique',
            'ExploitedSpecies' => 'EXP',
            'ProtectedSpecies' => 'PRT',
            'DisappearingSpecies' => 'DSG',
            'PopulationEstimation' => 'État estimé',
            'DescribeEstimation' => 'Décrire l’état optimal',
            'Comments' => 'Source / Note',
        ],
        'module_info' =>
            'Les types d\'habitats énumérés ci-dessous sont des termes standard utilisés pour décrire le ou les principaux habitats
            (<a href="https://www.iucnredlist.org/resources/habitat-classification-scheme">https://www.iucnredlist.org/resources/habitat-classification-scheme</a>).
                 Identifiez la catégorie principale dans la liste suggérée d\'habitats, puis ajoutez un deuxième niveau de description qui
                 prend en compte votre domaine spécifique.<br />
                <b>Species types</b><ul>
                <li><b>EXP</b>: Exploité</li>
                <li><b>PRT</b>: Protégé</li>
                <li><b>DSG</b>: En voie de disparition</li></ul>',
        'warning_on_save' => 'AVERTISSEMENT !!  <br /> Toute modification peut entraîner une perte de données dans les modules suivants (s’ils sont déjà encodés) :  <i>SA 2</i>'
    ],

    'Stakeholders' => [
        'title' => 'Parties prenantes impliquées dans la gestion ou ayant un impact sur l’utilisation des ressources naturelles de l’AMCE',
        'fields' => [
            'Element' => 'Partie prenante',
            'GeographicalProximity' => 'Vivant à l’intérieur ou à proximité (moins d\'une heure de marche)',
            'UsesCategories' => 'Catégories d\'usages ou de gestion des éléments clés de l\'AMCE',
            'DirectUser' => 'Utilisateurs directs des éléments clés de l\'AMCE',
            'LevelEngagement' => 'Niveau d\'engagement dans la gestion des éléments clés de l\'AMCE',
            'LevelInterest' => 'Niveau d\'intérêt pour la préservation des éléments clés de l\'AMCE',
            'LevelExpertise' => 'Niveau d\'expertise dans la gestion des éléments clés de l\'AMCE (y compris les connaissances traditionnelles ou autochtones)',

            'Comments' => 'Note',
        ],
        'titles' => [
            'title0' => 'Communauté/groupe ou autre',
            'title1' => 'Opérateurs économiques',
            'title2' => 'Gouvernement',
            'title3' => 'ONG, scientifiques et donateurs',
        ],
        'groups' => [
            'group0' => 'Autorités traditionnelles (Identifier les autorités traditionnelles)',
            'group1' => 'IPLCs ou Peuples autochtones et communautés locales (IPLCs*) (Identifier la communauté/groupe ILPCs)',
            'group2' => 'Non IPLCs (non IPLCs) (Identifier la communauté/groupe non ILPCs)',
            'group3' => 'Groupes défavorisés, minorités, …) (Identifiez les groupes défavorisés comme les associations de femmes, les groupes de jeunes, etc.)',
            'group4' => 'Autres communautés/groupes (Identifier autres communautés/groupes)',
            'group5' => 'IPLCs opérant dans l’économie de marché des ressources naturelles (Identifier les groupes d’IPLCs opérant dans l’économie de marché du bois, du non-bois, de la pêche, des plantes médicinales, du tourisme, etc.)',
            'group6' => 'Non IPLCs opérant dans l’économie des ressources naturelles (Identifier les groupes de non IPLCs opérant dans l’économie de marché de la forêt, de la pêche, du tourisme, de l’agriculture, de l’exploitation minière - charbon, diamants, eau, sable, etc.)',
            'group7' => 'Collectivités locales (identifier les élus locaux et les parlementaires, les conseils territoriaux / départementaux et municipaux, les services fonciers, les services de l’environnement, etc.)',
            'group8' => 'Autorités nationales (identifier le ministère ou le département national chargé de la gestion des RN) Gouvernement central Forces armées (police paramilitaire et marine, etc.)',
            'group9' => 'ONG (identifiez les ONG de défense des droits sociaux, les ONG de protection de l’environnement, les ONG de développement, etc.)',
            'group10' =>'Scientifiques/Chercheurs (Identifier les scientifiques/chercheurs, etc.)',
            'group11' =>'Donateurs (identifier les donateurs privés et publics, etc.)',

        ],
        'module_info' =>
            'Identifier les acteurs impliqués dans la gestion ou impactant dans l\'utilisation des ressources naturelles de l\'AMCE<br />
             <b>Vivant à l’intérieur ou à proximité (moins d\'une heure de marche)</b>: Vivre dans ou à proximité d\'une zone conservée peut donner accès à des
             services écosystémiques, mais peut également nécessiter des restrictions et des réglementations.<br />
             <b>Catégories d\'usages ou de gestion des éléments clés de l\'AMCE</b>: différentes manières dont les parties prenantes interagissent avec
             animaux, végétaux ou habitats (Biodiversité) et bénéficier de services écosystémiques (Approvisionnement, Culturel, Régulateur,
                Accompagnement) fourni par l\'AMCE.<br />
             <b>Utilisateurs directs des éléments clés de l\'AMCE</b>: les utilisateurs directs sont ceux qui bénéficient directement des biens et services
             fourni par l\'aire conservée.<br />
             <b>Niveau d\'intérêt pour la préservation des éléments clés de l\'AMCE</b>: Degré d\'intérêt des parties prenantes pour les éléments clés de l\'AMCE
             la conservation et la protection à long terme, telles que l\'établissement de réglementations d\'utilisation et d\'accès, car elles peuvent influencer
             leur niveau d\'implication et d\'engagement<br />
             <b>Niveau d\'expertise dans la gestion des éléments clés de l\'AMCE (y compris les connaissances traditionnelles ou autochtones)</b>: Degré à
             laquelle une partie prenante possède les connaissances, les compétences et l\'expérience nécessaires pour gérer et conserver efficacement certains éléments clés
             de l\'AMCE. L\'expertise peut provenir de connaissances traditionnelles et indigènes, de pratiques historiques, d\'observations à long terme,
             formations formelles et professionnelles. <br />',
        'ratingLegend' => [
            'LevelEngagement' => [
                '0' => 'Aucun engagement',
                '1' => 'Faible engagement',
                '2' => 'Engagement modéré',
                '3' => 'Engagement important',
            ],
            'LevelInterest' => [
                '0' => 'Pas d\'intérêt pour la conservation de l\'AMCE',
                '1' => 'Faible intérêt pour la conservation de l\'AMCE',
                '2' => 'Intérêt modéré pour la conservation de l\'AMCE',
                '3' => 'Intérêt important pour la conservation de l\'AMCE',
            ],
            'LevelExpertise' => [
                '0' => 'Aucune expertise dans la gestion des terres et des ressources naturelles',
                '1' => 'Faible expertise dans la gestion des terres et des ressources naturelles',
                '2' => 'Expertise modérée dans la gestion des terres et des ressources naturelles',
                '3' => 'Expertise important dans la gestion des terres et des ressources naturelles',
            ]
        ],
        'warning_on_save' => 'AVERTISSEMENT !! <br /> Toute modification peut entraîner une perte de données dans les modules suivants (s’ils sont déjà encodés) : <i>SA 2, C1.2, C2.2, I2, PR1, PR8</i>'
    ],

    'StakeholdersObjectives' => [
        'module_info' =>
            'Établir et décrire des objectifs de conservation pour les parties prenantes impliquées dans la gestion ou ayant un impact sur l\'utilisation des
             ressources naturelles de l\'AMCE. Les objectifs inscrits ci-dessous serviront à améliorer la gestion, et plus particulièrement
             pour la planification, la mobilisation des ressources (intrants), les phases de processus et pour le suivi des activités de gestion de l\'AMCE.'
    ],

    'AnalysisStakeholders' => [
        'titles' => [
            'title0' => 'Principaux services d’approvisionnement',
            'title1' => 'Principaux services culturels',
            'title2' => 'Principaux services de régulations',
            'title3' => 'Principaux services de soutien (services qui permettent d’assurer d’autres services)',
            'title4' => 'Éléments clés de la biodiversité',
        ],
        'groups' => [
            'group0' => 'Approvisionnement-Nutrition',
            'group1' => 'Approvisionnement-Eau',
            'group2' => 'Approvisionnement-Matériels',
            'group3' => 'Approvisionnement-Energie',
            'group4' => 'Tourisme (appréciation esthétique, loisirs, etc.)',
            'group5' => 'Intellectuel (éducation, savoir traditionnel, etc.)',
            'group6' => 'Spirituel et/ou emblématique',
            'group7' => 'Décontamination des polluants de l’air et de l’eau',
            'group8' => 'Prévention de l’érosion et maintien de la fertilité des sols',
            'group9' => 'Terres (agriculture, élevage, forêts)',
            'group10' => 'Habitats pour les animaux et les plants',
            'group11' => 'Animaux',
            'group12' => 'Plants',
            'group13' => 'Habitats',
        ],
        'groups_descriptions' => [
            'group0' =>
                '<p>La fourniture de services écosystémiques - nutrition fait référence à la fourniture d’aliments essentiels à la santé et au bien-être de l’homme.
                    Il est important de comprendre et de gérer la fourniture de nourriture en maintenant la santé des écosystèmes par la conservation des sols et de l’eau,
                    forêts, biodiversité, etc. Exemple de fourniture de services écosystémiques - la nutrition</p>
                    <ul>
                        <li>L’alimentation humaine végétale comme les céréales, les tubercules, les fruits, le miel, les champignons, les algues, etc.</li>
                        <li>Les animaux destinés à l’alimentation humaine sont la viande sauvage ou d’élevage, les œufs, les insectes, les aliments pour poissons ou animaux d’élevage (sauvages, d’élevage, appâts), etc.</li>
                        <li>Médicaments (quinine contre la malaria, compléments à base de plantes, huiles aromatiques, anti-venins, etc.) et biotechnologie bleue (huile de poisson)</li>
                    </ul>',
            'group1' =>
                '<p>L’approvisionnement de services écosystémiques – Eau - comprend la fourniture d’eau propre pour la boisson, l’usage humain et l’irrigation. La gestion de l’approvisionnement en eau implique protéger les bassins versants, les zones humides et les autres écosystèmes aquatiques, promouvoir des pratiques durables d’utilisation de l’eau et réduire la pollution et la dégradation de l’eau. Exemple de fourniture de services écosystémiques – l’eau.
                    Exemple L’approvisionnement de services écosystémiques – Eau</p>
                    <ul>
                        <li>L’approvisionnement en eau et la qualité de l’eau à usage humain : consommation, assainissement et hygiène.</li>
                        <li>L’eau pour l’irrigation des cultures ou d’autres activités agricoles et pour la consommation des poissons et du bétail</li>
                        <li>Réserve d’eau accessible en période de sécheresse ou de faible disponibilité de l’eau</li>
                     </ul>',
            'group2' =>
                '<p>L’approvisionnement de services écosystémiques - matériaux comprend la fourniture de bois, de fibres et d’autres matériaux qui sont utilisés pour la construction et la fabrication. La gestion des écosystèmes passe par la promotion de pratiques d’exploitation durables et l’exploration de matériaux et de technologies de substitution. Exemple de fourniture de services écosystémiques - matériaux</p>
                    <ul>
                        <li>Le bois d’œuvre comme bois de grande valeur ; bois pour la construction locale, piquets, tiges, etc.</li>
                        <li>Fibres végétales, telles que le coton, le lin, les palmiers, le kenaf, etc.</li>
                        <li>Ressources ornementales en général et aquariophiles (graines, coquillages et collection de poissons), etc.</li>
                        <li>Minéraux tels que l’or, l’argent, le cuivre, le sable (construction), etc.</li>
                     </ul>',
            'group3' =>
                '<p>L’approvvisionement de services écosystémiques - énergie comprend l’utilisation de la biomasse, comme le bois de chauffage ou les résidus de récolte, l’énergie solaire ou éolienne et d’autres besoins énergétiques comme l’engrais, afin de fournir des services essentiels tels que la cuisine, le chauffage, l’éclairage et la productivité agricole dans les communautés rurales qui n’ont pas toujours accès à des sources d’énergie modernes. La gestion durable des systèmes naturels, tels que les forêts et les terres agricoles, est essentielle pour garantir la disponibilité de ces services.). Exemple de services écosystémiques</p>
                    <ul>
                        <li>Biomasse provenant de matières végétales telles que le bois, les résidus de culture et les herbes qui peuvent être brûlées ou converties en biocarburants pour produire de l’énergie.</li>
                        <li>Biomasse à convertir en engrais</li>
                        <li>Autres sources d’électricité verte : L’eau courante, le vent, l’énergie solaire ou géothermique qui peuvent être exploités pour produire de l’électricité.</li>
                     </ul>',
            'group4' =>
                '<p>L’approvisionnement de services écosystémiques - services culturels fait référence aux avantages que les systèmes naturels procurent à l’homme pour son plaisir et son bien-être. Ces avantages peuvent inclure des possibilités de loisirs en plein air, comme la randonnée, le camping et l’observation de la faune et de la flore, ainsi que la beauté esthétique des paysages naturels, tels que les montagnes, les forêts et les plages. Les services écosystémiques pour l’appréciation esthétique, les loisirs et le tourisme peuvent contribuer aux économies locales grâce au développement de l’écotourisme et d’autres industries basées sur la nature. Il est important de garantir la disponibilité de ces des services écosystémiques pour les générations futures. Exemple de services écosystémiques</p>
                    <ul>
                        <li>Ecotourisme et observation de la nature : beaux paysages terrestres ou marins, paysages naturels, biodiversité et faune sauvage qui peuvent être appréciés pour les loisirs généraux, le camping, la marche, la randonnée, la navigation de plaisance, la natation, l’observation de la faune et de la flore et d’autres activités récréatives.</li>
                        <li>Le tourisme culturel consiste à visiter des sites historiques, des lieux d’intérêt et des attractions culturelles situés dans des aires naturelles.</li>
                        <li>Chasse ou pêche traditionnelle, aires conservées pour des pratiques de chasse ou de pêche traditionnelles spécifiées</li>
                     </ul>',
            'group5' =>
                '<p>L’approvisionnement de services écosystémiques - les services culturels désignent les avantages que les systèmes naturels procurent à l’éducation, à la recherche, à l’enseignement et l’expression artistique. Ces services peuvent contribuer au développement des connaissances humaines, du patrimoine culturel et de l’expression créative, qui sont importants pour le bien-être personnel et sociétal. La gestion durable des systèmes naturels est essentielle pour garantir la disponibilité de ces services écosystémiques pour les générations futures. Exemple de services écosystémiques</p>
                    <ul>
                        <li>Les possibilités d’enseignement et la recherche scientifique dans de nombreuses disciplines, y compris l’écologie, la botanique et la zoologie, pour comprendre les concepts scientifiques et les processus écologiques.</li>
                        <li>Les pratiques traditionnelles et les connaissances écologiques qui constituent une part importante de l’identité et du patrimoine de la communauté liés à la nature et à l’environnement, tels que la pharmacopée traditionnelle et les médicaments</li>
                        <li>Inspiration et créativité pour les artistes, les écrivains, les photographes et autres créateurs afin de développer de nouvelles idées et de nouvelles œuvres.</li>
                     </ul>',
            'group6' =>
                '<p>L’approvisionnement de services écosystémiques - les services culturels spirituels et emblématiques sont ceux qui fournissent des services culturels et symboliques aux sociétés humaines. Les services écosystémiques spirituels peuvent inclure les expériences esthétiques et émotionnelles que les humains tirent des éléments suivants nature. Les services écosystémiques emblématiques sont ceux qui sont associés à une identité culturelle ou à une icône particulière. Ces services sont importants pour le bien-être humain et l’identité culturelle. Exemple de services écosystémiques</p>
                    <ul>
                        <li>Les sites sacrés, historiques ou religieux et les lieux de pèlerinage tels que les montagnes, les rivières ou les forêts, etc.</li>
                        <li>Icônes et symboles culturels tels que des espèces animales ou végétales comme le lion (au Kenya, symbole de courage et de force), l’éléphant, la grue à crête (en Ouganda, oiseau qui représente la beauté naturelle et la grâce du pays) ou l’arbre Baobab, etc.</li>
                        <li>Les paysages qui ont une signification spirituelle ou culturelle pour l’identité communale.</li>
                     </ul>',
            'group7' =>
                '<p>L’approvisionnement de services écosystémiques - l’assainissement des polluants de l’air et de l’eau implique la protection des écosystèmes afin de réduire les émissions de gaz à effet de serre la pollution et la dégradation, et la purification de l’eau et de l’air par des processus naturels. Exemples de la manière dont les habitats fournissent ces services écosystémiques</p>
                    <ul>
                        <li>Les zones humides sont très efficaces pour éliminer les polluants de l’eau, tels que les excès de nutriments, les métaux lourds et les composés organiques.</li>
                        <li>Les forêts peuvent contribuer à réduire la pollution de l’air en absorbant et en filtrant les polluants atmosphériques et en produisant de l’oxygène, ce qui contribue à atténuer le changement climatique.</li>
                        <li>Les zones de végétation peuvent aider à filtrer et contribuer à la purification de l’eau, à l’élimination/neutralisation des déchets, à la régulation des déchets, etc.</li>
                     </ul>',
            'group8' =>
                '<p>L’approvisionnement de services écosystémiques - prévention de l’érosion et maintien de la fertilité des sols fait référence à la protection des sols par les moyens suivants la végétation contre les forces physiques du vent et de l’eau, qui peuvent entraîner la perte de la couche arable et des nutriments. Le maintien de la fertilité des sols fait référence aux processus qui maintiennent la teneur en éléments nutritifs et la structure des sols. Ces services sont importants pour la durabilité de l’agriculture, de la sylviculture et d’autres industries basées sur la terre, et contribuent à maintenir la santé et la productivité des écosystèmes. Exemple de services écosystémiques.</p>
                    <ul>
                        <li>Contrôle des inondations : les zones humides agissent comme des éponges naturelles, les rivières et les ruisseaux  fournissent des canaux pour l’eau excédentaire, la végétation et les forêts contribuent à absorber les précipitations et à ralentir l’écoulement de l’eau, les plaines d’inondation absorbent l’excès d’eau lors des inondations et protègent contre les tempêtes
                        and forests help absorb rainfall and slow down water flow, floodplains absorb excess water during floods and storm protection</li>
                        <li>Contrôle de l’érosion : la végétation aide à maintenir le sol en place, ses racines stabilisent le sol, la structure du sol résiste à l’érosion, les zones humides réduisent l’érosion en contrôlant le ruissellement et les brise-vent ou les barrières végétales adjacentes aux cours d’eau empêchent l’érosion (érosion côtière, érosion hydrique, érosion éolienne)</li>
                        <li>Contrôle de la sécheresse : La santé du sol et la couverture végétale jouent un rôle crucial dans la lutte contre la sécheresse en régulant le cycle de l’eau, en réduisant les pertes d’eau et en conservant l’eau</li>
                        <li>Contrôle des tempêtes : Les arbres aident à réduire l’impact des tempêtes, les barrières naturelles telles que les montagnes ou les îles peuvent agir comme des barrières en absorbant les tempêtes ou en absorbant une partie de l’énergie des vagues, les plans d’eau contribuent à modérer les températures, ce qui peut réduire la gravité des tempêtes.</li>
                     </ul>',
            'group9' =>
                '<p>Les services écosystémiques qui assurent la productivité de l’agriculture, de l’élevage et des forêts désignent les avantages que les écosystèmes naturels fournissent pour soutenir la production et la productivité de ces systèmes. Ces services comprennent le maintien de la fertilité des sols, le cycle des nutriments, la disponibilité et la régulation de l’eau, ainsi que la lutte contre les ravageurs et les maladies. Ces services d’approvisionnement sont essentiels pour maintenir la productivité des systèmes agricoles, d’élevage et forestiers tout en réduisant au minimum l’utilisation d’intrants synthétiques et la préservation des ressources naturelles. Exemple de services écosystémiques</p>
                    <ul>
                        <li>Formation, structure et fertilité du sol pour la culture, la production de bois, l’élevage, etc.</li>
                        <li>Disponibilité et régulation de l’eau</li>
                        <li>La lutte contre les parasites et les maladies</li>
                     </ul>',
            'group10' =>
                '<p>Les services écosystémiques des habitats pour les animaux et les plantes se réfèrent aux avantages que les écosystèmes naturels procurent pour soutenir la survie et la reproduction des espèces sauvages et des communautés végétales. Ces services comprennent la fourniture d’un habitat approprié pour diverses espèces, comme la nourriture, les abris et les sites de reproduction. La protection et la conservation des habitats naturels sont donc essentielles pour assurer la viabilité à long terme des espèces sauvages et des communautés végétales, ainsi que pour maintenir les nombreux avantages qu’elles procurent que les écosystèmes fournissent aux sociétés humaines. Exemple de services écosystémiques  </p>
                    <ul>
                        <li>Les habitats de nurserie et de nidification : Les écosystèmes fournissent des habitats à une grande variété d’espèces végétales et animales, notamment des zones d’alimentation et des abris contre les prédateurs, comme les sites de nidification des oiseaux, les frayères dans la mer, les rivières et les lacs, les habitats de reproduction (par exemple les coraux, les abeilles, etc.), etc.</li>
                        <li>Habitats pour la pollinisation : Les zones boisées et les zones de végétation offrent un soutien aux pollinisateurs tels que les abeilles, les papillons et les insectes les colibris, qui fournissent un service écosystémique important pour l’agriculture, car ils aident les plantes à produire des fruits, des semences et des graines d’autres structures reproductives. . </li>
                     </ul>',
            'group11' => '',
            'group12' => '',
            'group13' => '',
        ],
        'lists' => [
            'group0' => ['Alimentation humaine végétale', 'Alimentation humaine animale', 'Médicaments'],
            'group1' => ['Approvisionnement en eau et qualité de l’eau pour l’utilisation humaine', 'Eau pour l’irrigation', 'Stockage de l’eau'],
            'group2' => ['Bois', 'Fibres', 'Ressources ornementales et aquatiques', 'Minéraux'],
            'group3' => ['Biomasse pour l’énergie', 'Biomasse pour la fertilisation', 'Autres sources d’électricité verte'],
            'group4' => ['Ecotourisme et observation de la nature', 'Tourisme culturel', 'Chasse ou pêche traditionnelle'],
            'group5' => ['Opportunités éducatives et recherche scientifique', 'Pratiques traditionnelles et connaissances écologiques', 'Inspiration et créativité'],
            'group6' => ['Sites sacrés, historiques ou religieux', 'Icônes et symboles culturels', 'Paysages ayant une valeur spirituelle'],
            'group7' => ['Purification de l’eau et de l’air', 'Régulation et élimination des déchets'],
            'group8' => ['Lutte contre les inondations', 'Lutte contre l’érosion', 'Lutte contre la sécheresse', 'Lutte contre les tempêtes'],
            'group9' => ['Fourniture de fertilité', 'Fourniture d’eau', 'Fourniture de lutte contre les maladies'],
            'group10' => ['Habitats de pépinière et de nidification', 'Habitats pour la pollinisation']
        ],
        'summary' => 'Importance des éléments et implication des parties prenantes',
        'elements_importance' => 'Importance des éléments pour les parties prenantes',
        'involvement_ranking' => 'Implication des parties prenantes',
        'importance' => 'Importance (0-100)',
        'involvement' => 'Implication de la partie prenante (0-100)'
    ],

    'AnalysisStakeholderDirectUsers' => [
        'title' => 'Analyse par partie prenante - utilisateurs directs',
        'fields' => [
            'Element' => 'Critères',
            'Description' => 'Élément spécifique évalué',
            'Dependence' => 'Dépendance',
            'Access' => 'Accès',
            'Rivalry' => 'Rivalité',
            'Quality' => 'Qualité',
            'Quantity' => 'Quantité',
            'Threats' => 'Menaces',
            'Comments' => 'Note',
        ],
        'module_info' =>
            '<p>Identifiez les éléments clés de votre groupe et évaluez son importance et sa gestion/gouvernance de votre propre point de vue</p>' .
            '<b>Dependence</b>: La dépendance d’une partie prenante à l’égard des services écosystémiques fait référence à la mesure dans laquelle la subsistance, les revenus et l’identité culturelle dépendent des ressources naturelles et des processus écologiques. Il est donc essentiel de comprendre et de gérer la dépendance des parties prenantes vis-à-vis des services écosystémiques pour atteindre les objectifs de développement durable et de conservation.</br >' .
            '<b>Access</b>: L’accès d’une partie prenante aux services écosystémiques fait référence à sa capacité à bénéficier des ressources naturelles et des services fournis par les écosystèmes. Si une partie prenante n’a pas accès à ces services, ses moyens de subsistance et son bien-être sont menacés et elle peut être confrontée à la pauvreté, à l’insécurité alimentaire et à des problèmes de santé.</br >' .
            '<b>Rivalry</b>: La rivalité des parties prenantes dans les services écosystémiques fait référence à la concurrence ou au conflit entre les individus ou les parties prenantes pour l’accès ou les intérêts et les priorités dans la gestion et l’utilisation de ces services. La rivalité peut conduire à la surutilisation ou à l’épuisement des ressources, exacerber la dégradation de l’environnement et compromettre la disponibilité à long terme de ces services pour la ou les communautés.</br >' .

            '<b>Dependence</b>: La dépendance d\'une partie prenante vis-à-vis des services écosystémiques fait référence à la mesure dans laquelle la subsistance, les revenus,
                 et l\'identité culturelle dépendent des ressources naturelles et des processus écologiques. Une faible dépendance signifie que l\'écosystème
                 les services peuvent être remplacés sans difficulté ni coût significatifs. Une dépendance élevée fait référence à un degré plus élevé de
                 caractère irremplaçable de l\'élément clé. Ainsi, comprendre et gérer la dépendance des parties prenantes vis-à-vis
                 les services écosystémiques sont essentiels pour atteindre les objectifs de développement durable et de conservation.</br >'.
            '<b>Access</b>: L’accès d’une partie prenante aux services écosystémiques fait référence à sa capacité à bénéficier des ressources naturelles
                 et les services fournis par les écosystèmes. Si une partie prenante n\'a pas accès à ces services, ses moyens de subsistance et
                 leur bien-être sont menacés et ils peuvent être confrontés à la pauvreté, à l\'insécurité alimentaire et à des problèmes de santé..</br >',
            '<b>Rivalry</b>: La rivalité des acteurs dans les services écosystémiques renvoie à la compétition ou au conflit entre individus
                  ou les parties prenantes sur l\'accès et l\'utilisation de ces services. La rivalité peut entraîner une surexploitation ou un épuisement des ressources,
                  exacerbant la dégradation de l\'environnement et compromettant la disponibilité à long terme de ces services pour la communauté
                  ou communautés.</br >'.
            '<b>Qualité des services écosystémiques</b> facteurs physiques, biologiques et écologiques qui permettent à l\'écosystème de perdurer
                  pour fournir le service souhaité, ou pour que l\espèce continue d\'être viable. (Exemple : pas de pollution, présence de juvéniles,
                  biodiversité, etc.)'.
            '<b>Quantité des services écosystémiques</b>: quantité, volume ou taille des services écosystémiques ou des espèces (Exemple:
                  surface d\'une forêt, population d\'espèces, volume de cours d\'eau, etc.).</br >'.
            '<b>Threads</b>: Human activities or processes that have impacted, are impacting or may impact the OECM’s key element being assessed.</br >',
        'ratingLegend' => [
            'Dependence' => [
                '0' => 'Très faible',
                '1' => 'Faible',
                '2' => 'Moyenne',
                '3' => 'Elevée',
            ],
            'Quality' => [
                '-2' => 'Très médiocre',
                '-1' => 'Médiocre',
                ' 0' => 'Moyen',
                '+1' => 'Bon',
                '+2' => 'Excellent',
            ],
            'Quantity' => [
                '-2' => 'Très médiocre',
                '-1' => 'Médiocre',
                ' 0' => 'Moyen',
                '+1' => 'Bon',
                '+2' => 'Excellent',
            ],
        ],
        'warning_on_save' => 'AVERTISSEMENT!! <br /> Toute modification peut entraîner une perte de données dans les modules suivants (s’ils sont déjà encodés) : <i>SA 2, C4</i>',
    ],

    'AnalysisStakeholderIndirectUsers' => [
        'title' => 'Analyse des parties prenantes - utilisateurs indirects',
        'fields' => [
            'Element' => 'Critères',
            'Description' => 'Élément spécifique évalué',
            'Support' => 'Soutien ou contribution',
            'Guidelines' => 'Lignes directrices et procédures',
            'LackOfCollaboration' => 'Manque de collaboration entre les utilisateurs indirects et directs',
            'Status' => 'Statut des éléments clés de l\'AMCE',
            'Trend' => 'Tendance des éléments clés de l\'AMCE',
            'Threats' => 'Menaces',
            'Comments' => 'Note',
        ],
        'module_info' =>
            '<b>Soutien ou contribution</b>: Actions et efforts déployés par la partie prenante pour gérer et protéger 
                durablement les écosystèmes ou les espèces. Les domaines de soutien ou de contribution peuvent être l\'un des 
                suivants: financement, renforcement des capacités et assistance technique, recherche et suivi, application 
                de la loi, politique et plaidoyer, et engagement à long terme.</br >' .
            '<b>Lignes directrices et procédures</b>: Existence ou développement de lignes directrices et de procédures 
                claires élaborées par la partie prenante pour assurer une gestion et une gouvernance à long terme et durables 
                de l\'élément clé</br >' .
            '<b>Manque de collaboration entre les utilisateurs indirects et directs</b>: Absence ou insuffisance de coordination 
                entre les différents acteurs qui utilisent et bénéficient des services écosystémiques, ce qui pourrait conduire 
                à des conflits et à des pratiques non durables</br >' .
            '<b>Statut des éléments clés de l\'AMCE</b>: L\'état des éléments clés indique l\'état de la fourniture des services 
                écosystémiques ou de l\'élément clé de la biodiversité en termes de qualité. Un état très mauvais indique que 
                le service écosystémique fourni est de mauvaise qualité ou que l\'élément clé de la biodiversité risque sérieusement 
                de disparaître dans la zone de l\'AMCE. Un très bon état indique que l\'élément clé est de bonne qualité ou 
                en expansion. Divers facteurs environnementaux tels que le climat et les conditions météorologiques, le 
                changement d\'utilisation des terres, la pollution et la surexploitation des ressources, la surexploitation 
                peuvent affecter l\'état des éléments clés de l\'AMCE.</br >' .
            '<b>Tendance des éléments clés de l\'AMCE</b>: Les tendances actuelles des éléments clés indiquent le changement 
                dans la quantité de services écosystémiques fournis ou dans la taille-surface des éléments clés de la biodiversité. 
                Pour les services écosystémiques, il peut s\'agir de la quantité de services fournis, pour l\'élément clé 
                de la biodiversité, il peut s\'agir de la taille de la population (espèce), de la superficie (habitats, 
                couverture terrestre) ou de la quantité de production écologique.</br >' .
            '<b>Menaces</b>: Activités ou processus humains qui ont impacté, impactent ou peuvent impacter l’élément clé 
                de l\'AMCE évalué.</br >',
        'ratingLegend' => [
            'Support' => [
                '0' => 'Pas ou très peu d\'appui : La partie prenante n\'apporte pas ou très peu d\'appui dans la gestion et la gouvernance de l\'espèce ou des services écosystémiques.',
                '1' => 'Faible soutien: La partie prenante apporte peu de soutien dans la gestion et la gouvernance de l\'espèce ou des services écosystémiques.',
                '2' => 'Soutien modéré : La partie prenante apporte un certain soutien dans la gestion et la gouvernance de l\'espèce ou des services écosystémiques',
                '3' => 'Soutien élevé : La partie prenante apporte un soutien significatif dans la gestion et la gouvernance de l\'espèce ou des services écosystémiques',
            ],
            'Status' => [
                '-2' => 'Très mauvais',
                '-1' => 'Mauvais',
                '0' => 'Neutre',
                '1' => 'Bon',
                '2' => 'Très bon',
            ],
            'Trend' => [
                '-2' => 'Fortement en baisse',
                '-1' => 'Décroissante',
                '0' => 'Pas de changement',
                '1' => 'Augmentation',
                '2' => 'Forte augmentation',
            ]
        ],
        'warning_on_save' => 'AVERTISSEMENT!! <br /> Toute modification peut entraîner une perte de données dans les modules suivants (s’ils sont déjà encodés) : <i>C4</i>',
    ],

    'AnalysisStakeholdersObjectives' => [
        'module_info' =>
            'Établir et décrire les objectifs de conservation pour les parties prenantes analyse des éléments clés de l\'AMCE.
            Les objectifs inscrits ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, 
            la mobilisation des ressources (intrants), les phases de processus et pour le suivi des activités de gestion de l\'AMCE.'
    ],

];
