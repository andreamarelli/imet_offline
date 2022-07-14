<?php

return [

    'ResponsablesInterviewers' => [
        'title' => 'Responsables de la compilation du fichier: Équipe de gestion et partenaires de l\'AP',
        'fields' => [
            'Name' => 'Nom',
            'Institution' => 'Organisation',
            'Function' => 'Fonction',
            'Contacts' => 'Coordonnées',
            'EncodingDate' => 'Date de compilation',
            'EncodingDuration' => 'Durée de l\'évaluation (h)',
        ]
    ],

    'ResponsablesInterviewees' => [
        'title' => 'Responsables de la compilation du fichier: Support extérieur à l\'analyse et à l\'évaluation',
        'fields' => [
            'Name' => 'Nom',
            'Institution' => 'Organisation',
            'Function' => 'Fonction',
            'Contacts' => 'Coordonnées',
            'EncodingDate' => 'Date de compilation',
            'EncodingDuration' => 'Durée de l\'évaluation (h)',
        ]
    ],

    'ImportanceGovernance' => [
        'title' => 'Gouvernance/Partenariat',
        'fields' => [
            'Aspect' => 'Critères, Concept mesuré, Variables',
            'EvaluationScore' => 'Note',
            'Comments' => 'Commentaire, Explication',
        ],
        'predefined_values' => [
            'Coordination entre gestionnaires de l\'aire protégée-partenaires-bailleurs de fonds pour les aspects financiers',
            'Coordination entre gestionnaires de l\'aire protégée-communautés pour les aspects financiers',
            'Coordination entre gestionnaires de l\'aire protégée-communautés-partenaires pour les aspects techniques',
            'Coordination entre gestionnaires de l\'aire protégée-communautés-partenaires pour les aspects scientifiques',
            'Intégration des nécessités/aspirations des gestionnaires dans la gestion de l\'aire protégée par les partenaires',
            'Intégration des nécessités/aspirations des partenaires dans la gestion de l\'aire protégée par les gestionnaires',
            'Intégration des nécessités/aspirations des communautés locales dans la gestion de l\'aire protégée par les gestionnaires et les partenaires',
            'Intégration des nécessités/aspirations des gestionnaires dans la gestion de l\'aire protégée et les partenaires par les communautés',
            'Intégration des nécessités/aspirations des gestionnaires dans la gestion de l\'aire protégée par les opérateurs touristiques',
            'Intégration des nécessités/aspirations des opérateurs touristiques par les gestionnaires dans la gestion de l\'aire protégée',
            'Coordination avec les administrations décentralisées — déconcentrées [p.ex. échelon(s) provincial et/ou territorial]',
            'Coordination de plusieurs administrations décentralisées – déconcentrées [p.ex. échelon(s) provincial et/ou territorial] en raison de l’appartenance de l’aire protégée à plusieurs territoires administratifs'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'pas mise en application',
                '1' => 'faiblement mise en application',
                '2' => 'mise en application',
                '3' => 'considérablement mise en application',
            ]
        ],
        'module_subTitle' => 'Valeur et Importance - Gouvernance / Partenariat',
        'module_info_EvaluationQuestion' => '<ul> <li>L\'aire protégée a-t-elle une typologie de gouvernance bien définie et êtes-vous en mesure d\'en identifier les avantages ou désavantages?</li> <li>L\'aire protégée a-t-elle actuellement des partenariats en appui à la gouvernance et la gestion ?</li> <li><b>Identifier la typologie actuelle de gouvernance ainsi que le degré d\'intégration des aspirations des partenariats dans la gestion de l\'aire protégée</b></li> </ul>',
        'module_info_Rating' => 'Evaluez les aspects de premier plan de la gouvernance / des partenariats'
    ],

    'ObjectivesGovernance' => [
        'title' => 'Détermination des objectifs',
        'fields' => [
            'Status' => 'Ligne de base de la gouvernance / des partenariats',
            'Benchmark1' => 'Valeur de référence, benchmark 1',
            'Benchmark2' => 'Valeur de référence, benchmark 2',
            'Benchmark3' => 'Valeur de référence, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées de la gouvernance / des partenariats',
        ],
        'module_info' => 'Cibles de conservation et des indicateurs relatifs à <b>la gouvernance, partenariat, etc. </b>de l\'aire protégée<br /> Les objectifs et les valeurs de référence à insérer dans le tableau ci-dessous sont à utiliser dans la gestion et le suivi des activités de l\'aire protégée et plus spécifiquement dans les phases de planification, recherche des ressources (intrants), processus, détermination des résultats et des objectifs d\'impact.'
    ],

    'ImportanceClassification' => [
        'title' => 'Classifications',
        'fields' => [
            'Aspect' => 'Critères, Concept mesuré, Variables',
            'EvaluationScore' => 'Note',
            'SignificativeClassification' => 'Classification internationale hautement significative',
            'Comments' => 'Commentaire, Explication',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'sans importance',
                '1' => 'faible importance',
                '2' => 'important',
                '3' => 'extrêmement important',
            ]
        ],
        'module_subTitle' => 'Valeur et Importance - Classifications',
        'module_info_EvaluationQuestion' => '<ul> <li>L\'aire protégée a-elle-été classée ou érigée à un statut au profit de la conservation au niveau nationale, régionale ou internationale?</li> <li><b>Identifier l\'importance et l\'influence du (ou des) statut(s) national, régional ou international dans la gestion de l\'aire protégée</b></li> </ul>',
        'module_info_Rating' => 'Listez les classifications de l\'aire protégée au niveau national, régional ou international (voir Contexte d\'Intervention, point 1.3)'
    ],

    'ObjectivesClassification' => [
        'title' => 'Détermination des objectifs',
        'fields' => [
            'Status' => 'Ligne de base de classification / statut de l\'aire protégée',
            'Benchmark1' => 'Valeur de référence, benchmark 1',
            'Benchmark2' => 'Valeur de référence, benchmark 2',
            'Benchmark3' => 'Valeur de référence, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées de classification / statut de l\'aire protégée',
        ],
        'module_info' => 'Cibles de conservation et des indicateurs relatifs <b>au (aux) statu(s) actuel(s) au niveau national, régional ou international</b> de l’aire protégée<br /> Les objectifs et les valeurs de référence à insérer dans le tableau ci-dessous sont à utiliser dans la gestion et le suivi des activités de l\'aire protégée et plus spécifiquement dans les phases de planification, recherche des ressources (intrants), processus, détermination des résultats et des objectifs d\'impact.'
    ],

    'ImportanceSpecies' => [
        'title' => 'Espèces',
        'fields' => [
            'Aspect' => 'Critères, Concept mesuré, Variables',
            'EvaluationScore' => 'Note',
            'SignificativeSpecies' => 'Espèce hautement significative',
            'Comments' => 'Commentaire, Explication'
        ],
        'groups' => [
            'group0' => 'Identifiez les espèces animales phares, menacées, endémiques, …, choisies comme indicateurs',
            'group1' => 'Identifiez les espèces végétales phares, menacées, endémiques, …, choisies comme indicateurs',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'sans effort de gestion',
                '1' => 'faible importance',
                '2' => 'important',
                '3' => 'extrêmement important',
            ]
        ],
        'module_subTitle' => 'Valeur et Importance - Espèces phare, menacées, endémiques, exploitées, invasives, avec faible niveau de connaissance',
        'module_info_EvaluationQuestion' => '<ul> <li>L\'aire protégée assure-t-elle la conservation des espèces phare, menacées, endémiques, exploitées, invasives, avec faible niveau de connaissance les plus représentatives pour l\'aire protégée ?</li> <li><b>Identifier le degré d\'importance dans la gestion de l\'aire protégée attribué aux espèces phare, menacées, endémiques, exploitées, invasives, avec faible niveau de connaissance les plus représentatives et pouvant être adoptées comme indicateurs écologiques d\'excellence</b></li> </ul>',
        'module_info_Rating' => 'Listez les espèces phare, menacées, endémiques, exploitées, invasives, avec faible niveau de connaissance les plus représentatives de l\'aire protégée (sur la base des éléments du Contexte d\'Intervention, points: 4.1; 4.2).<br /> <span class="error">Attention: pas moins de 5, pas plus de 10</span>'
    ],

    'ObjectivesSpecies' => [
        'title' => 'Détermination des objectifs',
        'fields' => [
            'Status' => 'Ligne de base actuellement évaluable de conservation des valeurs et importances de l\'aire protégée',
            'Benchmark1' => 'Valeur de référence, benchmark 1',
            'Benchmark2' => 'Valeur de référence, benchmark 2',
            'Benchmark3' => 'Valeur de référence, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées des valeurs et importances de l\'aire protégée',
        ],
        'module_info' => 'Cibles de conservation et des indicateurs relatifs aux <b>éléments clé et aux espèces phare, menaces, endémiques, invasives, avec faible niveau de connaissance </b> de l’aire protégée<br /> Les objectifs et les valeurs de référence à insérer dans le tableau ci-dessous sont à utiliser dans la gestion et le suivi des activités de l\'aire protégée et plus spécifiquement dans les phases de planification, recherche des ressources (intrants), processus, détermination des résultats et des objectifs d\'impact.'
    ],

    'ImportanceHabitats' => [
        'title' => 'Habitats terrestres et marines et couverture du sol',
        'fields' => [
            'Aspect' => 'Critères, Concept mesuré, Variables',
            'EvaluationScore' => 'Importance',
            'EvaluationScore2' => 'En fonction de la valeur régionale et globale, degré d\'importance aux habitats et aux typologies de la couverture du sol',
            'Comments' => 'Commentaire, Explication',
        ],
        'groups' => [
            'group0' => 'Habitats les plus importants de l\'aire protégée',
            'group1' => 'Éléments importants de la couverture du sol (land cover et land change) dans et en dehors de l\'aire protégée',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'sans importance',
                '1' => 'faible importance',
                '2' => 'important',
                '3' => 'extrêmement important',
            ],
            'EvaluationScore2' => [
                '1' => 'peu important',
                '2' => 'important',
                '3' => 'extrêmement important',
            ],
        ],
        'module_subTitle' => 'Valeur et Importance - Habitats terrestres et marines et couverture du sol (land-cover et land-change)',
        'module_info_EvaluationQuestion' => '<ul> <li>L\'aire protégée assure-t-elle la conservation et la valorisation des habitats terrestres et marins et de la couverture du sol (land-cover et land-change)pour l\'aire protégée?</li> <li><b>Identifier le degré d\'importance attribuée dans la gestion de l\'aire protégée aux habitats terrestres et marins et de la couverture du sol (land-cover et land-change) pouvant être adoptées comme indicateurs de gestion</b></li> </ul>',
        'module_info_Rating' => 'Listez les habitats ou éléments de la couverture du sol les plus importants pour l\'aire protégée, identifiés (sur la base des éléments du Contexte d\'Intervention, point 4.3).<br /> <span class="error">Attention: pas moins de 5, pas plus de 10</span>'
    ],

    'ObjectivesHabitats' => [
        'title' => 'Détermination des objectifs',
        'fields' => [
            'Status' => 'Ligne de base actuellement évaluable de conservation des habitats terrestres et marines et couverture du sol',
            'Benchmark1' => 'Valeur de référence, benchmark 1',
            'Benchmark2' => 'Valeur de référence, benchmark 2',
            'Benchmark3' => 'Valeur de référence, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées des habitats terrestres et marines et couverture du sol',
        ],
        'module_info' => 'Cibles de conservation et des indicateurs relatifs au <b>maintien des habitats terrestres et marins ou de la couverture du sol</b> de l’aire protégée<br /> Les objectifs et les valeurs de référence à insérer dans le tableau ci-dessous sont à utiliser dans la gestion et le suivi des activités de l\'aire protégée et plus spécifiquement dans les phases de planification, recherche des ressources (intrants), processus, détermination des résultats et des objectifs d\'impact.'
    ],

    'ImportanceClimateChange' => [
        'title' => 'Changement Climatique',
        'fields' => [
            'Aspect' => 'Critères, Concept mesuré, Variables',
            'EvaluationScore' => 'Note',
            'Comments' => 'Commentaire, Explication',
        ],
        'predefined_values' => [
            'Aspects écologiques affectés par le CC',
            'Projets REDD+',
            'Intégration dans le paysage terrestre et marine permettant d\'améliorer la résilience au CC',
            'Aire protégée avec variation d’altitude',
            'Aires protégées transfrontalières permettant d\'améliorer la résilience au CC',
            'Pertinence habitats pour l\'adaptation au CC',
            'Restauration habitats pour contribuer à l\'atténuation au CC',
            'Planification intersectorielle pour accroitre l\'efficacité des réponses au CC',
            'Politique environnementale pour répondre aux effets du CC',
            'Financement durable pour soutenir les réponses au CC',
            'Difficultés socioéconomiques des populations riveraines (de la zone de transition pour les réserves MAB) dans les effets et à fournir les réponses au CC',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'sans importance',
                '1' => 'faible importance',
                '2' => 'important',
                '3' => 'extrêmement important',
            ]
        ],
        'module_subTitle' => 'Valeur et Importance - Changement Climatique',
        'module_info_EvaluationQuestion' => '<ul> <li>L\'aire protégée assure-t-elle de l\'importance aux effets du changement climatique dans la gestion de l\'aire protégée ?</li> <li><b>Identifier le degré d\'importance attribué dans la gestion de l\'aire protégée aux effets du changement climatique les plus significatifs et pouvant être adoptés comme indicateurs écologiques d\'excellence pour accroitre l’efficacité d’atténuation et d’adaptation des réponses au phénomène</b></li> </ul>',
        'module_info_Rating' => 'Listez cinq ou plus éléments les plus importants liés au changement climatique et affectant l\'aire protégée (sur la base des éléments du Contexte d\'Intervention, point 6.1)'
    ],

    'ObjectivesClimateChange' => [
        'title' => 'Détermination des objectifs',
        'fields' => [
            'Status' => 'Ligne de base actuellement évaluable des effets du changement climatique',
            'Benchmark1' => 'Valeur de référence, benchmark 1',
            'Benchmark2' => 'Valeur de référence, benchmark 2',
            'Benchmark3' => 'Valeur de référence, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées pour les réponses aux effets du changement climatique',
        ],
        'module_info' => 'Cibles de conservation et des indicateurs relatifs <b> aux effets du changement climatique</b><br /> Les objectifs et les valeurs de référence à insérer dans le tableau ci-dessous sont à utiliser dans la gestion et le suivi des activités de l\'aire protégée et plus spécifiquement dans les phases de planification, recherche des ressources (intrants), processus, détermination des résultats et des objectifs d\'impact.'
    ],

    'ImportanceEcosystemServices' => [
        'title' => 'Services Ecosystémiques',
        'fields' => [
            'Aspect' => 'Critères, Concept mesuré, Variables',
            'Comments' => 'Commentaire, Explication',
        ],
        'predefined_values' => [
            'Approvisionnement: Nutrition',
            'Approvisionnement: Matériaux',
            'Approvisionnement: Energie',
            'Régulation: Médiation des déchets, substances toxiques et autres nuisances',
            'Régulation: Médiation des flux',
            'Régulation: Maintien de conditions biologiques, chimiques, physiques',
            'Culturel: Interactions physiques  et expérience',
            'Culturel: Interactions intellectuelles et de représentation',
            'Culturel: Spirituel et/ou emblématiques',
            'Culturel: Autres sorties culturelles (conservation ex-situ)'
        ],
        'module_info' => 'Notez que les estimations sont reportées automatiquement a’ partir des appréciations que vous avez effectué au point #7.1. L’échelle des critères vous permet de vérifier la cohérence des estimations que vous avez effectué précédemment.',
        'ratingLegend' => [
            'Importance' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'sans effort de gestion',
                '1' => 'faible importance',
                '2' => 'important',
                '3' => 'extrêmement important',
            ]
        ],
        'module_subTitle' => 'Valeur et Importance - Services Ecosystémiques',
        'module_info_EvaluationQuestion' => '<ul> <li>L\'aire protégée assure-t-elle la conservation et la valorisation des services écosystémiques pour le bien-être humain ?</li> <li><b>Identifier le degré d\'importance attribué dans la gestion de l\'aire protégée aux services écosystémiques les plus significatifs et pouvant être adoptés comme indicateurs écologiques d\'excellence en raison de la dépendance des populations riveraines (de la zone de transition pour les réserves MAB) de ces services écosystémiques</b></li> </ul>',
        'module_info_Rating' => 'Listez cinq ou plus services écosystémiques (légaux et illégaux) les plus importants et représentatifs pour l\'aire protégée sur la base de l\'analyse de l\'Etat du Contexte (voir Contexte d\'Intervention, point 7.1)'
    ],

    'ObjectivesEcosystemServices' => [
        'title' => 'Détermination des objectifs',
        'fields' => [
            'Status' => 'Ligne de base currently evaluable state of the ecosystem services for human well-being',
            'Benchmark1' => 'Valeur de référence, benchmark 1',
            'Benchmark2' => 'Valeur de référence, benchmark 2',
            'Benchmark3' => 'Valeur de référence, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées of the ecosystem services provided by the protected area',
        ],
        'module_info' => 'Cibles de conservation et des indicateurs relatifs au <b>maintien des services écosystémiques et à la dépendance des collectivités</b> de l’aire protégée envers ses services<br /> Les objectifs et les valeurs de référence à insérer dans le tableau ci-dessous sont à utiliser dans la gestion et le suivi des activités de l\'aire protégée et plus spécifiquement dans les phases de planification, recherche des ressources (intrants), processus, détermination des résultats et des objectifs d\'impact.'
    ],

    'SupportsAndConstraints' => [
        'title' => 'Contraintes ou appuis externes',
        'fields' => [
            'Aspect' => 'Appuis ou contraintes',
            'EvaluationScore' => 'Importance des appuis et des contraintes',
            'EvaluationScore2' => 'Acteurs dans leur action d\'appui ou de contraste',
            'Comments' => 'Commentaire',
        ],
        'predefined_values' => [
            'Gouverneur',
            'Autorités territoriales (préfet, sous-préfet)',
            'Élus et notables locaux (ministres de la localité, députés, sénateurs)',
            'Communautés locales',
            'Autorités traditionnelles',
            'Société civile',
            'Droits de l\'homme',
            'Ministère de tutelle technique',
            'Direction générale des parcs',
            'Agences de Coordination intersectorielle',
            'Justice militaire',
            'Justice civile',
            'Forces militaires terrestres et Gendarmerie',
            'Forces militaires marines',
            'Forces de police',
            'Résidents de haut niveau dans la zone tampon',
            'Hautes autorités de l\'Etat'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '-3 / -2 / -1' => 'Contraintes (importante - modérée - légère)',
                '0' => 'Nul (pas d\'influence)',
                '+1 / +2 / +3' => 'Appui (légère - modérée - importante)',
                'N/A' => 'Cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
            ],
            'EvaluationScore2' => [
                '1' => 'peu de pouvoir',
                '2' => 'pouvoir important',
                '3' => 'pouvoir extrêmement important',
            ],
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>L\'aire protégée est-elle soumise à des contraintes ou profite-t-elle d\'appuis exercés par l\'environnement politique-institutionnel et social externe?</li> <li><b>Etes-vous en mesure d\'identifier les avantages et les inconvénients exercés par l\'environnement politique et social externe ?</b></li> </ul>',
        'module_info_Rating' => 'Listez les principaux appuis et contraintes exercés sur l\'aire protégée et évaluer leur importance'
    ],

    'ObjectivesSupportsAndConstraints' => [
        'title' => 'Détermination des objectifs',
        'fields' => [
            'Status' => 'Ligne de base actuellement évaluable des contraintes ou des appuis externes sur l\'aire protégée',
            'Benchmark1' => 'Valeur de référence, benchmark 1',
            'Benchmark2' => 'Valeur de référence, benchmark 2',
            'Benchmark3' => 'Valeur de référence, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées  pour les contraintes ou les appuis externes sur l\'aire protégée',
        ],
        'module_info' => 'Cibles de conservation et des indicateurs relatifs aux <b>contraintes ou appuis externes</b> sur l’aire protégée<br /> Les objectifs et les valeurs de référence à insérer dans le tableau ci-dessous sont à utiliser dans la gestion et le suivi des activités de l\'aire protégée et plus spécifiquement dans les phases de planification, recherche des ressources (intrants), processus, détermination des résultats et des objectifs d\'impact.'
    ],

    'Menaces' => [
        'title' => 'Menaces',
        'fields' => [
            'Aspect' => 'Appuis ou contraintes',
            'Comments' => 'Commentaire',
        ],
        'module_info' => 'Notez que les estimations sont reportées automatiquement a’ partir des appréciations que vous avez effectué au point #5.1. L’échelle des critères vous permet de vérifier la cohérence des estimations que vous avez effectué précédemment.',
        'ratingLegend' => [
            'Menaces' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'pas d\'influence',
                '-3 / -2 / -1' => 'Gravité (moins - plus sévère)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>L\'aire protégée est-elle soumise à des menaces (pressions - menaces - vulnérabilités) en mesure de mettre en danger les patrimoines en biodiversité, culturels, les services écosystémiques, etc. de l\'aire protégée ?</li> <li>Quelles sont les menaces (pressions - menaces - vulnérabilités) les plus graves et importantes qui pèsent sur l\'aire protégée ?</li> <li><b>Identifier le degré de prise en compte des menaces principales et pouvant être adoptées comme indicateurs d\'excellence, dans la gestion de l\'aire protégée</b></li> </ul>',
        'module_info_Rating' => 'Listez les menaces (pressions - menaces - vulnérabilités) les plus importantes qui pèsent sur l\'aire protégée (sur la base des éléments du Contexte d\'Intervention, point 5.1)'
    ],

    'ObjectivesMenaces' => [
        'title' => 'Détermination des objectifs',
        'fields' => [
            'Status' => 'Ligne de base actuellement évaluable des pressions et menaces qui pèsent sur l\'aire protégée',
            'Benchmark1' => 'Valeur de référence, benchmark 1',
            'Benchmark2' => 'Valeur de référence, benchmark 2',
            'Benchmark3' => 'Valeur de référence, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées concernant les pressions et les menaces qui pèsent sur l\'aire protégée',
        ],
        'module_info' => 'Cibles de conservation et des indicateurs relatifs aux <b>pressions et menaces qui pèsent</b> sur l’aire protégée<br /> Les objectifs et les valeurs de référence à insérer dans le tableau ci-dessous sont à utiliser dans la gestion et le suivi des activités de l\'aire protégée et plus spécifiquement dans les phases de planification, recherche des ressources (intrants), processus, détermination des résultats et des objectifs d\'impact.'
    ],

    'RegulationsAdequacy' => [
        'title' => 'Adéquation des dispositions législatives et réglementaires',
        'fields' => [
            'Regulation' => 'Sujets principaux de réglementations en vigueur',
            'EvaluationScore' => 'Faiblesse/Convenance',
            'Comments' => 'Commentaire',
        ],
        'predefined_values' => [
            'Texte de classement (objectifs, aspect délimitation, etc.)',
            'Réglementation interne du parc',
            'Loi relative à la conservation',
            'Textes d\'application des ratifications des conventions internationales sur la conservation (CDB, Nagoya, CITES, RAMSAR, etc.)',
            'Mesures d\'application des lois sur la conservation',
            'Lois complémentaires relativement à la gestion des ressources naturelles',
            'Mesures d\'application des lois de gestion des ressources naturelles',
            'Lois, conventions sur la recherche sur la biodiversité et les ressources naturelles',
            'Mesures d\'application des dispositions sur la recherche',
            'Droit coutumier (élément tiré du P2)',
            'Droit foncier'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '-3' => 'très inadéquate',
                '-2' => 'inadéquate',
                '-1' => 'moyennement inadéquate',
                '0' => 'neutre',
                '1' => 'moyennement adéquate',
                '2' => 'adéquates',
                '3' => 'très adéquates',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Les réglementations en vigueur pour le contrôle des activités et l\'utilisation des terres et des ressources naturelles (p.ex. la cueillette) dans l\'aire protégée sont-elles appropriées?</li> <li><b>Identifier les réglementations en vigueur pour le contrôle des activités et l\'utilisation des terres et des ressources naturelles de l\'aire protégée, et en évaluer la conformité</b></li> </ul>',
        'module_info_Rating' => 'Evaluez les principales réglementations en vigueur intervenant dans le cadre de la gestion de l\'aire protégée'
    ],

    'DesignAdequacy' => [
        'title' => 'Conception et configuration de l’aire protégée',
        'fields' => [
            'Values' => 'Valeurs les plus importantes pour l\'aire protégée',
            'EvaluationScore' => 'Adéquation',
            'Comments' => 'Commentaire',
        ],
        'predefined_values' => [
            'Taille (superficie)',
            'Indice de forme ou Configuration (Superficie/Contour)',
            'Forme',
            'Zone tampon',
            'Corridors',
            'Zone de frontière',
            'Segment(s) de limites sujets à conflits ou contestation (ex. limites non naturelles, droits coutumiers, exploitations, etc.)',
            'Enclaves reconnues officiellement',
            'Zones enclavées avec un difficile / impossible accès pour les patrouilles'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '-3' => 'très insuffisant',
                '-2' => 'modérément insuffisant',
                '-1' => 'légèrement insuffisante',
                '0' => 'neutre',
                '1' => 'peu adéquate',
                '2' => 'modérément adéquates',
                '3' => 'très adéquates',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>L\'aire protégée est-elle de la bonne taille et forme pour protéger les espèces, les habitats et assurer les processus écologiques et naturels comme la couverture du sol et les captages d\'eau ?</li> <li>L\'aire protégée a-t-elle besoin d\'être agrandie (élargir ses corridors, etc.) pour atteindre ses objectifs ?</li> <li><b>Evaluez le degré d\'adéquation de la conception de l\'aire protégée pour assurer la protection de ses valeurs et aspects d\'importance</b></li> </ul>',
        'module_info_Rating' => 'Evaluez les aspects les plus importants concernant la configuration et l\'adéquation actuelle de la conception de l\'aire protégée (sur la base des éléments du Contexte d\'Intervention, point 2)'
    ],

    'BoundaryLevel' => [
        'title' => 'Démarcation de l’aire protégée',
        'fields' => [
            'EvaluationScore' => 'État de connaissance et de signalisation des limites',
            'PercentageLevel' => '% du périmètre signal',
            'Comments' => 'Commentaire',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'limites pas connues par les autorités et/ou les résidents/utilisateurs (0%)',
                '1' => 'limites connues par les autorités et les résidents/utilisateurs, mais insuffisamment signalées (1-50%)',
                '2' => 'limites connues par les autorités et les résidents/utilisateurs, mais non signalées de manière adéquate (51-75%)',
                '3' => 'limites connues par les autorités et les résidents/utilisateurs et signalées (plus de 76, mais inferieur à 100%)',
                '4' => 'limites parfaictement connues par les autorités et les résidents/utilisateurs et correctement signalées (100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>La limite est-elle connue et signalée?</li> <li><b>Identifier le degré de connaissance et de signalisation des limites de l\'aire protégée et, si vous le pouvez, le pourcentage de signalisation des limites dans la fourchette indiquée</b></li> </ul>',
        'module_info_Rating' => 'Renseignez l\'état actuel et si possible le % du périmètre de l\'aire protégée signalé'
    ],

    'ManagementPlan' => [
        'title' => 'Plan de gestion',
        'fields' => [
            'PlanExistenceScore' => 'Existence du plan',
            'PlanApplicationScore' => 'Applicabilité du plan',
            'PercentageLevel' => 'Pourcentage d\'application du plan',
            'Comments' => 'Commentaire',
        ],
        'ratingLegend' => [
            'PlanExistenceScore' => [
                '0' => 'l’aire protégée n’a pas de plan de gestion',
                '1' => 'un plan de gestion est en cours d\'élaboration',
                '2' => 'un plan de gestion a été élaboré, mais il n\'est pas approuvé, pourtant il est mis en œuvre',
                '3' => 'un plan de gestion a été élaboré, il est approuvé et mis en œuvre',
            ],
            'PlanApplicationScore' => [
                '0' => 'Le plan de gestion n\'affiche pas une vision, la mission et des objectifs de l\'aire protégée claires et praticables (0%)',
                '1' => 'Le plan de gestion n\'affiche pas une vision, la mission et des objectifs de l\'aire protégée suffisamment claires et praticables (1-33%)',
                '2' => 'Le plan de gestion affiche une vision, la mission et des objectifs de l\'aire protégée suffisamment claires et praticables (34-66%)',
                '3' => 'Le plan de gestion affiche une vision, la mission et des objectifs de l\'aire protégée claires et praticables (67-100%)',
            ],
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Y a-t-il un plan de gestion et, si oui, est-il applicable ?</li> <li><b>Vérifier l\'existence et l\'applicabilité du plan de gestion</b></li> </ul>',
        'module_info_Rating' => 'Renseignez l\'existence et l\'applicabilité du plan de gestion sur la base des quatre + quatre niveaux ci-dessous'
    ],

    'WorkPlan' => [
        'title' => 'Plan de travail',
        'fields' => [
            'PlanExistenceScore' => 'Existence du plan',
            'PlanApplicationScore' => 'Pertinence du plan',
            'PercentageLevel' => 'Pourcentage de pertinence du plan',
            'Comments' => 'Commentaire',
        ],
        'ratingLegend' => [
            'PlanExistenceScore' => [
                '0' => 'Il n’y a pas de plan de travail',
                '1' => 'Un plan de travail régulier existe, mais les activités ne sont pas exécutées et vérifiées sur la base des objectifs de ce plan',
                '2' => 'Un plan de travail existe, mais les activités ne sont pas complètement orientées sur la base des objectifs du plan et menées à terme',
                '3' => 'Un plan de travail existe, les activités sont exécutées sur la base des objectifs du plan et toutes les activités prévues ou presque sont menées à terme',
            ],
            'PlanApplicationScore' => [
                '0' => 'Les activités et les résultats attendus par le plan de travail ne correspondent pas à l’orientation donnée par le plan de gestion (vision – mission – objectifs) (0%)',
                '1' => 'Les activités et les résultats attendus par le plan de travail ne correspondent pas correctement à l’orientation donnée par le plan de gestion (vision – mission – objectifs) (1-33%)',
                '2' => 'Les activités et les résultats attendus par le plan de travail correspondent, mais en dessous du seuil optimal, à l’orientation donnée par le plan de gestion (vision – mission – objectifs) (34-66%)',
                '3' => 'Les activités et les résultats attendus par le plan de travail correspondent parfaitement à l’orientation donnée par le plan de gestion (vision – mission – objectifs) (67-100%)',
            ],
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Existe-t-il un plan de travail annuel ?</li> <li><b>Vérifier l\'existence et la pertinance du plan de travail</b></li> </ul>',
        'module_info_Rating' => 'Renseignez l\'existence et la pertinence du plan de travail sur la base des quatre +quatre niveaux ci-dessous:'
    ],

    'Objectives' => [
        'title' => 'Objectifs de l’aire protégée',
        'fields' => [
            'Objective' => 'Objective',
            'EvaluationScore' => 'Pertinence',
            'Comments' => 'Commentaire',
        ],
        'predefined_values' => [
            'Conservation des espèces animales phare, menacées ou endémiques',
            'Conservation des espèces végétales  caractéristiques, menacées ou endémiques',
            'Conservation des habitats caractéristiques et sur l\'utilisation des sols dans et en dehors de l\'aire protégée (land cover - use - take)',
            'Utilisation légale et durable des ressources naturelles (droits coutumiers et aires protégées à gestion des ressources naturelles)',
            'Atténuation des menaces directes et indirectes qui pèsent sur l\'aire protégée',
            'Atténuation / l\'adaptation des effets du changement climatique sur les éléments clés de l\'aire protégée',
            'Conservation des services écosystémiques fournis par l\'aire protégée'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'pas de definition des objectifs, ni d\'indicateurs et ni de valeurs de référence',
                '1' => 'definition des objectifs, mais ceux-ci ne sont pas précisés sur la base des indicateurs et des valeurs de référence',
                '2' => 'definition des objectifs, mais ceux-ci ne sont pas complètement précisés sur la base des indicateurs ou des valeurs de référence',
                '3' => 'definition des objectifs accompagnés d\'indicateurs et de valeurs de référence relatifs',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Les objectifs fixés présent-ils des indicateurs et de valeurs de référence des conditions souhaitées comme impact de la gestion de l’aire protégée ?</li> <li><b>Juger la pertinence des objectifs, des indicateurs et de valeurs de référence associés sur la base des précédents documents de planification et de l’état du contexte de l’aire protégée</b></li> </ul>',
        'module_info_Rating' => 'Jugez la pertinence des objectifs, des indicateurs et de valeurs de référence de la planification pour assurer la conservation des valeurs et de l’importance de l’aire protégée (sur la base des éléments du Contexte d\'intervention, points 4; 5; 6; 7) '
    ],

    'ObjectivesPlanification' => [
        'title' => 'Détermination des objectifs',
        'fields' => [
            'Status' => 'Ligne de base',
            'Benchmark1' => 'Valeur de référence, benchmark 1',
            'Benchmark2' => 'Valeur de référence, benchmark 2',
            'Benchmark3' => 'Valeur de référence, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées',
        ],
        'module_info' => 'Cibles de conservation et des indicateurs relatifs aux <b>exercices et outil de planification</b> de l’aire protégée<br /> Les objectifs et les valeurs de référence à insérer dans le tableau ci-dessous sont à utiliser dans la gestion et le suivi des activités de l\'aire protégée et plus spécifiquement dans les phases de planification, recherche des ressources (intrants), processus, détermination des résultats et des objectifs d\'impact.'
    ],

    'InformationAvailability' => [
        'title' => 'Information de base',
        'fields' => [
            'Element' => 'éléments de gestion',
            'EvaluationScore' => 'Disponibilité ',
            'PercentageLevel' => 'Connaissance par rapport aux besoins de gestion [%]',
            'Comments' => 'Commentaire',
        ],
        'groups' => [
            'group0' => 'Connaissances sur les espèces animales phares, menacées, endémiques, …, choisies comme indicateurs',
            'group1' => 'Connaissances sur les espèces végétales phares, menacées, endémiques, …, choisies comme indicateurs',
            'group2' => 'Connaissances sur les habitats à caractéristique importante et significative, et sur l\'utilisation des sols dans en dehors de l\'aire protégée (land cover - use - take)',
            'group3' => 'Connaissances sur les types des menaces directes et indirectes qui pèsent sur l\'aire protégée',
            'group4' => 'Connaissances sur les impacts potentiels du changement climatique sur les éléments clés',
            'group5' => 'Connaissances sur les services écosystémiques que fournit l\'aire protégée',
            'group6' => 'Zones névralgiques en terme des menaces',
            'group7' => 'Attentes et aspirations des communautés locales',
            'group8' => 'REDD+',
            'group9' => 'Autre',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'peu ou pas d’information (entre 0 et 25% des besoins de gestion)',
                '1' => 'information disponible, mais insuffisante pour la planification et la prise de décision (entre 26 et 50% des besoins de gestion)',
                '2' => 'information disponible et suffisante pour la planification et la prise de décision, mais le travail essentiel de suivi et recherche n’est pas assuré (entre 51 et 75% des besoins de gestion)',
                '3' => 'information disponible et suffisante pour la planification et la prise de décision et mise à jour par le travail essentiel de suivi et recherche (entre 76 et 100% des besoins de gestion)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Disposez-vous d\'informations suffisantes pour gérer l’aire protégée?</li> <li><b>Analyser la pertinence et la disponibilité des informations pour assurer une gestion efficace de l\'aire protégée.</b></li> </ul>',
        'module_info_Rating' => 'Précisez les plus importants éléments de gestion de l\'aire protégée disposant ou pas d\'informations fondamentales pour assurer leur gestion (sur la base des éléments du Contexte d\'intervention, points 4; 5; 6; 7) '
    ],

    'Staff' => [
        'title' => 'Personnel',
        'fields' => [
            'Theme' => 'Function',
            'PercentageLevel' => 'Pourcentage',
            'Comments' => 'Commentaire',
        ],
        'status' => 'État actuel des effectifs disponibles',
        'module_info' => 'Notez que les estimations sont reportées automatiquement a’ partir des appréciations que vous avez effectué au point #3.1.1. L’échelle des critères vous permet de vérifier la cohérence des estimations que vous avez effectué précédemment.',
        'ratingLegend' => [
            'Estimation' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'peu d’effectifs (entre 0 et 25% des besoins)',
                '1' => 'pas suffisant aux activités de gestion essentielles (entre 26 et 50% des besoins)',
                '2' => 'en dessous du seuil optimal (entre 51 et 75% des besoins)',
                '3' => 'adaptés aux activités (entre 76 et 100% des besoins)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Y a-t-il assez de personnel pour gérer l’aire protégée ?</li> <li><b>Préciser l\'adéquation des effectifs par rapport aux exigences de gestion de l\'aire protégée sur la base des indications du plan de gestion or de l\'organigramme officiel</b></li> </ul>',
        'module_info_Rating' => 'Identification automatique de l\'état actuel; évaluez si possible le % du personnel par rapport aux nécessités de gestion de l\'aire protégée (sur la base des éléments du Contexte d\'Intervention, point 3.1)'
    ],

    'BudgetAdequacy' => [
        'title' => 'Budget actuel',
        'fields' => [
            'EvaluationScore' => 'Adéquation du budget',
            'Percentage' => 'Pourcentage d\'adéquation par rapport aux besoins',
            'Comments' => 'Commentaires',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'aucun budget (0% des besoins)',
                '1' => 'insuffisant pour les activités de gestion essentielles (entre 1 et 35% des besoins)',
                '2' => 'en-dessous du seuil optimal (entre 36 et 70% des besoins)',
                '3' => 'adapté aux activités (plus de 71 mais inferieur à 100% des besoins)',
                '4' => 'parfaitement adapté aux activités (100% des besoins)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Le budget actuel est-il suffisant pour assurer une gestion appropriée de l\'aire protégée ?</li> <li><b>Juger l\'adéquation du financement actuel par rapport aux exigences de conservation de l\'aire protégée</b></li> </ul>',
        'module_info_Rating' => 'Renseignez le niveau d\'adéquation des financements actuels de l\'aire protégée par rapport aux exigences de conservation sur la base des quatre niveaux ci-dessous (sur la base des éléments du Contexte d\'Intervention, point 3.2)'
    ],

    'BudgetSecurization' => [
        'title' => 'Sécurisation du budget',
        'fields' => [
            'EvaluationScore' => 'Sécurisation du budget',
            'Percentage' => 'Pourcentage de sécurisation du budget par rapport aux besoins',
            'Comments' => 'Commentaires',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'budget non sécurisé et gestion entièrement dépendante de fonds externes ou de financement annuel (0% de sécurisation du budget)',
                '1' => 'budget sécurisé en proportion très restreinte et gestion largement dépendante de fonds externes ou de financements annuels (entre 1 et 33% de sécurisation du budget)',
                '2' => 'budget sécurisé en proportion importante, mais de nombreuses innovations et initiatives demeurent dépendantes de fonds externes (entre 34 et 67% de sécurisation du budget)',
                '3' => 'budget sécurisé et besoins de gestion couverts pour plusieurs années (plus de 67 mais inferieur à 100% de sécurisation du budget)',
                '4' => 'budget sécurisé et besoins de gestion parfaictement couverts pour plusieurs années (100% de sécurisation du budget)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Le budget est-il sécurisé ?</li> <li><b>Juger de la sécurisation du budget par rapport aux exigences de conservation de l\'aire protégée</b></li> </ul>',
        'module_info_Rating' => 'Indiquez le niveau de sécurisation des financements actuels de l\'aire protégée par rapport aux exigences de conservation sur la base des quatre niveaux ci-dessous'
    ],

    'ManagementEquipmentAdequacy' => [
        'title' => 'Infrastructures, équipements et installations',
        'fields' => [
            'Equipment' => 'Infrastructures, équipements et installations',
            'Importance' => 'Importance pour le parc',
            'Comments' => 'Commentaires',
        ],
        'adequacy' => 'Adéquation',
        'module_info' => 'Notez que les estimations sont reportées automatiquement a’ partir des appréciations que vous avez effectué au point #3.3. L’échelle des critères vous permet de vérifier la cohérence des estimations que vous avez effectué précédemment.',
        'ratingLegend' => [
            'Estimation' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'insuffisante (entre 0 et 25% des besoins)',
                '1' => 'insuffisante pour les activités de gestion essentielles (entre 26 et 50% des besoins)',
                '2' => 'en dessous du seuil optimal (entre 51 et 75% des besoins)',
                '3' => 'adaptés aux activités (entre 76 et 100% des besoins)',
            ],
            'Importance' => [
                '0' => 'd\'importance modérée',
                '1' => 'd\'importance',
                '2' => 'de haute importance',
            ],
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Les infrastructures, les équipements et les installations sont-ils suffisants pour les besoins de gestion ?</li> <li><b>Juger l\'adéquation des infrastructures, des équipements et des installations par rapport aux exigences de gestion de l\'aire protégée</b></li> </ul>',
        'module_info_Rating' => 'Evaluez le niveau d\'adéquation des infrastructures, équipements et installations par rapport aux exigences de gestion de l\'aire protégée (sur la base des éléments du Contexte d\'Intervention, point 3.3) '
    ],

    'ObjectivesIntrants' => [
        'title' => 'Détermination des objectifs',
        'fields' => [
            'Status' => 'Ligne de base',
            'Benchmark1' => 'Valeur de référence, benchmark 1',
            'Benchmark2' => 'Valeur de référence, benchmark 2',
            'Benchmark3' => 'Valeur de référence, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées',
        ],
        'module_info' => 'Cibles de conservation et des indicateurs relatifs aux <b>intrants nécessaires pour la mise en œuvre de la planification</b> de l’aire protégée<br /> Les objectifs et les valeurs de référence à insérer dans le tableau ci-dessous sont à utiliser dans la gestion et le suivi des activités de l\'aire protégée et plus spécifiquement dans les phases de planification, recherche des ressources (intrants), processus, détermination des résultats et des objectifs d\'impact.'
    ],

    'StaffCompetence' => [
        'title' => 'Capacités et formation du personnel',
        'fields' => [
            'Theme' => 'Fonctions',
            'EvaluationScore' => 'Niveau moyen de compétence',
            'PercentageLevel' => 'Niveau moyen de formation',
            'Comments' => 'Commentaire',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'pas de compétence ou de formation',
                '1' => 'niveau de compétences ou de formation faible',
                '2' => 'niveau de compétences ou de formation adaptés, mais à améliorer',
                '3' => 'niveau de compétences ou de formation à jour, voire anticipé',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Le personnel a-t-il les compétences et est-il formé de façon adéquate pour atteindre les objectifs de gestion ?</li> <li><b>Juger le niveau de compétences et l\'adéquation de la formation du personnel par rapport aux exigences de gestion de l\'aire protégée</b></li> </ul>',
        'module_info_Rating' => 'Par rapport au poste de service et au plus importantes thématiques de gestion de l\'aire protégée renseignez le niveau moyen de compétences et de formation du personnel disponible (sur la base des éléments du Contexte d\'Intervention, point 3.1)'
    ],

    'HRmanagementPolitics' => [
        'title' => 'Politiques et procédures de gestion des ressources humaines',
        'fields' => [
            'Conditions' => 'Conditions indispensables pour avoir une bonne politique et des procédures adéquate de gestion des ressources humaines (si nécessaire, complétez la liste)',
            'EvaluationScore' => 'Degré d\'application',
            'Comments' => 'Commentaire',
        ],
        'predefined_values' => [
            'Politiques et directives formellement documentées pour assurer l\'organisation et définir les procédures de gestion du personnel de l\'administration publique',
            'Niveau de l\'application du statut spécifiquement pour le personnel de l\'aire protégée (statut du personnel de l\'institution en charge des aires protégées)',
            'Réglementation interne à l\'aire protégée avec la définition des rôles, des obligations, des autorités, des contrôles, des services et des responsabilités',
            'Gestion et contrôle des procédures internes par la DRH de l\'aire protégée pour l\'amélioration de la gestion des ressources humaines',
            'Le recrutement et la gestion des RH sont indépendants des pressions externes',
            'Mise en œuvre des dispositions de RH avec les communications, les procédures appliquées et les programmes de formation',
            'Suivi et révisions des procédures et des processus internes à l\'aire protégée'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'pas d\'application',
                '1' => 'faible application',
                '2' => 'application moyenne',
                '3' => 'forte application',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>L’aire protégée adopte-t-elle des politiques et des procédures de gestion des ressources humaines ?</li> <li><b>Juger l\'adéquation des politiques et des procédures de gestion des ressources humaines de l\'aire protégée</b></li> </ul>',
        'module_info_Rating' => 'Si nécessaire, complétez et évaluez la liste des conditions indispensables pour avoir une bonne politique et des procédures adéquates de gestion des ressources humaines dans une aire protégée'
    ],

    'HRmanagementSystems' => [
        'title' => 'Systèmes et processus de gestion des ressources humaines',
        'fields' => [
            'Conditions' => 'Conditions indispensables pour entretenir un bon niveau de motivation du personnel (si nécessaire, complétez la liste)',
            'EvaluationScore' => 'Degré d\'application',
            'Comments' => 'Commentaire',
        ],
        'predefined_values' => [
            'Objectifs de mission clairs et précis',
            'Mobilisation à l\'action',
            'Informations des résultats des activités',
            'Niveau suffisant d\'autonomie',
            'Récompenses appropriées (salaire, primes, sécurité sociale)',
            'Conditions de travail adéquates',
            'Soutien des autorités politiques, administratives et militaires',
            'Soutien des autorités  judiciaires',
            'Soutien des communautés locales'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'aucune mise en pratique',
                '1' => 'faiblement mise en pratique',
                '2' => 'moyennement mise en pratique',
                '3' => 'activement mise en pratique',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Le personnel de service de l\'aire protégée dispose-t-il d\'une bonne aptitude au travail de conservation?</li> <li><b>Analyser le degré de motivation du personnel (aptitude au travail)</b></li> </ul>',
        'module_info_Rating' => 'Si nécessaire, complétez la liste des conditions indispensables pour entretenir un bon niveau de motivation du personnel dans une aire protégée'
    ],

    'GovernanceLeadership' => [
        'title' => 'Management et leadership interne',
        'fields' => [
            'EvaluationScoreGovernace' => 'Niveau de gouvernance interne',
            'EvaluationScoreLeadership' => 'Niveau de leadership',
            'Comments' => 'Commentaire',
        ],
        'ratingLegend' => [
            'EvaluationScoreGovernace' => [
                '0' => 'Le nombre de cas d\'indiscipline et la non-exécution des ordres sont très importants',
                '1' => 'Le nombre de cas d\'indiscipline et la non-exécution des ordres sont importants',
                '2' => 'Le nombre de cas d\'indiscipline et la non-exécution des ordres sont faibles',
                '3' => 'Le nombre de cas d\'indiscipline et la non-exécution des ordres sont rares',
            ],
            'EvaluationScoreLeadership' => [
                '0' => 'Les processus et la prise de décision de management et de commandement présentent des insuffisances très importantes',
                '1' => 'Les processus et la prise de décision de management et de commandement présentent des insuffisances importantes',
                '2' => 'Les processus et la prise de décision de management et de commandement sont adéquats',
                '3' => 'Les processus et la prise de décision de management et de commandement sont optimaux',
            ],
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>La prise de décision, l\'exécution des ordres et la discipline sont-elles adéquatement assurées dans la gestion de l\'aire protégée ?</li> <li><b>Évaluer le niveau de gouvernance interne et de leadership</b></li> </ul>',
        'module_info_Rating' => 'Evaluez le niveau actuel de gouvernance interne et de leadership de l\'aire protégée'
    ],

    'AdministrativeManagement' => [
        'title' => 'Gestion comptable et financière',
        'fields' => [
            'EvaluationScore' => 'Niveau de qualité de la gestion',
            'Comments' => 'Commentaires',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'la gestion du budget et des ressources financières est mauvaise et compromet sévèrement l’efficacité de la gestion de l’aire protégée',
                '1' => 'la gestion du budget et des ressources financières est médiocre et compromet l’efficacité de la gestion de l’aire protégée',
                '2' => 'la gestion du budget et des ressources financières est adéquate, mais pourrait être améliorée',
                '3' => 'la gestion du budget et des ressources financières est excellente et soutient l’efficacité de la gestion de l’aire protégée',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Le budget et les ressources financières sont-ils gérés de façon à couvrir les besoins essentiels de gestion ?</li> <li><b>Evaluez l\'efficacité de la gestion comptable et financière</b></li> </ul>',
        'module_info_Rating' => 'Evaluez le niveau de qualité de gestion comptable et financière'
    ],

    'EquipmentMaintenance' => [
        'title' => 'Entretien des infrastructures, des équipements et des installations',
        'fields' => [
            'Equipment' => 'Infrastructures, équipements et installations',
            'EvaluationScore' => 'Niveau d\'adéquation des efforts d\'entretien',
            'Percentage' => 'Adéquation des efforts d\'entretien par rapport aux besoins (%)',
            'Comments' => 'Commentaires',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'très insuffisante (entre 0 et 25% des besoins)',
                '1' => 'insuffisante pour les activités de gestion essentielles (entre 26 et 50% des besoins)',
                '2' => 'en dessous du seuil optimal (entre 51 et 75% des besoins)',
                '3' => 'adaptés aux activités (entre 76 et 100% des besoins)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Les infrastructures, les équipements et les installations sont-ils entretenus de manière adéquate ?</li> <li><b>Estimer le niveau d\'entretien des infrastructures, des équipements et des installations</b></li> </ul>',
        'module_info_Rating' => 'Jugez le niveau d\'entretien des infrastructures, équipements et installations par rapport aux exigences de gestion de l\'aire protégée (sur la base des éléments du Contexte d\'Intervention, point 3.3)'
    ],

    'ManagementActivities' => [
        'title' => 'Gestion des valeurs et des aspects d\'importance de l\'aire protégée',
        'fields' => [
            'Activity' => 'Activités spécifiques de gestion',
            'EvaluationScore' => 'Niveau de l\'action de gestion',
            'Comments' => 'Commentaire'
        ],
        'groups' => [
            'group0' => 'Mesures actives de gestion: espèces animales phares, menacées, endémiques, …, choisies comme indicateurs',
            'group1' => 'Mesures actives de gestion: espèces végétales phares, menacées, endémiques, …, choisies comme indicateurs',
            'group2' => 'Mesures actives de gestion: habitats à caractéristique importante et significative, et sur l\'utilisation de sols dans et en dehors de l\'aire protégée (land cover - use - take)',
            'group3' => 'Mesures actives de gestion: gestion d\'utilisation légale, mais pas durable des ressources naturelles',
            'group4' => 'Mesures actives de gestion: menaces directes et indirectes qui pèsent sur l\'aire protégée',
            'group5' => 'Mesures actives de gestion: fonctionnement generale',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'pas de dispositions ni d\'application',
                '1' => 'adoption de dispositions et application faible',
                '2' => 'adoption de dispositions et applications adaptées, mais à améliorer',
                '3' => 'adoption de dispositions et applications conformes et proactives',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>L\'aire protégée adopte-t-elle des mesures actives de gestion des espèces animales et végétales clé, des habitats, du maintien de la couverture et l\'utilisation du sol, des menaces?</li> <li><b>Evaluer l\'existence et l\'efficacité des activités de gestion des espèces animales et végétales clé, des habitats, du maintien de la couverture et l\'utilisation du sol, des menaces</b></li> </ul>',
        'module_info_Rating' => 'Listez cinq ou plus activités spécifiques de gestion des espèces animales et végétales clé, des habitats, du maintien de la couverture et l\'utilisation du sol, des menaces qui sont présents dans l\'aire protégée (sur la base des éléments du Contexte d\'Intervention, points 4; 5)'
    ],

    'ProtectionActivities' => [
        'title' => 'Degré de protection des valeurs et des aspects d’importance de l’aire protégée',
        'fields' => [
            'Activity' => 'Activités spécifiques de conservation',
            'EvaluationScore' => 'Systèmes de protection',
            'Percentage' => 'Protection assurée par rapport aux besoins',
            'Comments' => 'Commentaire',
        ],
        'groups' => [
            'group0' => 'Mesures de protection des espèces animales phares, menacées, endémiques, …, choisies comme indicateurs',
            'group1' => 'Mesures de protection des espèces végétales phares, menacées, endémiques, …, choisies comme indicateurs',
            'group2' => 'Mesures de protections des habitats à caractéristique importante et significative, et sur l\'utilisation des sols (land cover, land use)',
            'group3' => 'Mesures de contrôle de l\'utilisation légale, mais pas durable des ressources naturelles',
            'group4' => 'Mesures de contraste et d\'atténuation des menaces directes et indirectes qui pèsent sur l\'aire protégée',
            'group5' => 'Mesures de protection des services écosystémiques fournis par l\'aire protégée',
            'group6' => 'Autres mesures de gestion',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'pas de mesures de protection / contrôle',
                '1' => 'mesures de protection / contrôle partiels',
                '2' => 'mesures de protection / contrôle modérément efficace',
                '3' => 'mesures de protection / contrôle efficace',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>L\'aire protégée adopte-t-elle des dispositions de protection des espèces animales et végétales clé, des habitats, du maintien de la couverture et l\'utilisation du sol, des menaces, des effets du changement climatique et des services écosystémiques ?</li> <li><b>Evaluer l\'efficacité des activités de protection des espèces animales et végétales clé, des habitats, du maintien de la couverture et l\'utilisation du sol, des menaces, des effets du changement climatique et des services écosystémiques</b></li> </ul>',
        'module_info_Rating' => 'Listez cinq ou plus activités spécifiques de protection des espèces animales et végétales clé, des habitats, du maintien de la couverture et l\'utilisation du sol, des menaces, des effets du changement climatique et des services écosystémiques (sur la base des éléments du Contexte d\'Intervention, points 4; 5; 6; 7)'
    ],

    'Control' => [
        'title' => 'Contrôle de l\'aire protégée',
        'fields' => [
            'EvaluationScore' => 'État du contrôle',
            'Percentage' => '% de la surface sous contrôle',
            'Comments' => 'Commentaire',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Le contrôle de l\'aire protégée est minime (entre 0 et 25% de la surface)',
                '1' => 'Le contrôle de l\'aire protégée est faible (entre 26 et 50% de la surface)',
                '2' => 'Le contrôle de l\'aire protégée est bon (entre 51 et 75% de la surface)',
                '3' => 'Le contrôle de l\'aire protégée est élevé (plus de 76%, mais inferieur à 100% de la surface)',
                '4' => 'Le contrôle de l\'aire protégée est total (100% de la surface)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>L\'aire protégée est-elle sous contrôle total ou partiel ?</li> <li><b>Déterminer le niveau de contrôle de l\'aire protégée</b></li> </ul>',
        'module_info_Rating' => 'Evaluez l\'état actuel et si possible le % du contrôle de l\'aire protégée sur la base'
    ],

    'LawEnforcement' => [
        'title' => 'Application des lois',
        'fields' => [
            'Element' => 'Éléments',
            'EvaluationScore' => 'Niveau d\'application des lois',
            'Comments' => 'Commentaires',
        ],
        'predefined_values' => [
            'Niveau d\'application de la réglementation interne à l\'aire protégée',
            'Nombre des agents assermentés par rapport au besoin de l\'application de la loi dans l\'aire protégée',
            'Niveau des connaissances et des capacités des agents de l\'aire protégée pour faire respecter les règlements et la législation conformément aux principes de légalité et d’équité',
            'L\'aire protégée a les ressources suffisantes pour le suivi des processus judiciaires',
            'Niveau d\'application des lois par les instances juridiques',
            'Niveau de collaboration des gestionnaires de l\'aire protégée avec les autres forces de contrôle',
            'Le système d\'application des lois et des règlements est intangible',
            'Proximité des instances de justice par rapport à l\'aire protégée',
            'L’autorité centrale en charge de la conservation soutient les efforts d’application de la loi',
            'L’autorité administrative locale soutient les efforts d’application de la loi'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'très insuffisante',
                '1' => 'insuffisante',
                '2' => 'satisfaisante',
                '3' => 'très satisfaisante',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Le personnel de l\'aire protégée peut-il faire respecter efficacement les règles de l\'aire protégée ?</li> <li>Qu\'arrive-t-il en cas d\'arrestation ?</li> <li><b>Evaluer les capacités d\'application des lois</b></li> </ul>',
        'module_info_Rating' => 'Établissez lesquels des 10 ou plus éléments de base pour l\'application des dispositions des lois de protection concernent l\'aire protégée'
    ],

    'Implications' => [
        'title' => 'Implication des communautés, des ayants droit et des parties prenantes',
        'fields' => [
            'Actor' => 'Communautés locales, ayants droit, parties prenantes',
            'EvaluationScore' => 'Implications',
            'Percentage' => 'Pourcentage d\'implication',
            'Comments' => 'Commentaire',
        ],
        'groups' => [
            'group0' => 'Communauté locale',
            'group1' => 'Gouvernement',
            'group2' => 'Bailleurs de fonds, Privés et ONG',
            'group3' => 'Autres parties prenantes',
        ],
        'predefined_values' => [
            'group0' => [
                'Autorités traditionnelles',
                'Communautés qui vivent à proximité ou dans le parc',
                'Groupes exploitants forestiers et pêcheurs',
                'Opérateurs privés',
                'Représentants de la société civile / des conseils locaux'
            ],
            'group1' => [
                'Gouvernement national (ministères, mandataires des entreprises publics, etc.)',
                'Gouvernement(s) régional, provincial et Préfecture(s)',
                'Conseil territorial / départemental et communal',
                'Représentants des populations (députés, etc.)',
                'Forces armées (Gendarmerie et Marine Nationale)'
            ]
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'pas d\'implication (0%)',
                '1' => 'implication, mais pas de rôle direct dans la prise de décisions (1 - 25%)',
                '2' => 'implication avec contribution à certaines décisions (26 - 75%)',
                '3' => 'implication et contribution à la prise de toutes les décisions, p.ex. cogestion (76 - 100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Les communautés locales, les ayants droit et les parties prenantes sont-ils impliqués dans les décisions de gestion de l\'aire protégée?</li> <li><b>Estimer le degré d\'implication des communautés locales, des ayants droit et des parties prenantes dans l\'échange d\'informations et la prise des décisions de la gestion de l\'aire protégée</b></li> </ul>',
        'module_info_Rating' => 'Estimez l\'implication des communautés locales, des ayants droit et des parties prenantes dans les décisions de gestion de l\'aire protégée'
    ],

    'AssistanceActivities' => [
        'title' => 'Avantages / assistance appropriés au profit des collectivités',
        'fields' => [
            'Activity' => 'Activités/programmes',
            'EvaluationScore' => 'Niveau des avantages et d\'assistance vis-à-vis des collectivités',
            'Comments' => 'Commentaire',
        ],
        'predefined_values' => [
            'Emploi de personnel riverains de l\'aire protégée',
            'Payement des biens et services à la population riveraine de l\'aire protégée',
            'Recrutement des gardes dans la zone administrative de référence',
            'Tourisme et retombées en termes d\'emploi',
            'Projet pilote de réduction des conflits homme/faune',
            'Ecoles, dispensaires, appui social',
            'Appui dans la production vivrière et petit élevage',
            'Points d\'eau, adduction d\'eau',
            'Amélioration des routes',
            'Fourniture énergie, connexion électrique'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'pas d\'activités / programmes et pas d\'avantages',
                '1' => 'petites activités / programmes, et avantages minimes',
                '2' => 'activités / programmes convenables, mais parfois occasionnelles, et avantages moyens',
                '3' => 'activités / programmes importantes et constants, et forts avantages',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Y a-t-il des activités / programmes actuellement en cours par le gestionnaires dans l\'aire protégée visant des avantages / assistance appropriés vis-à-vis des collectivités ?</li> <li><b>Evaluer si le niveau des avantages et d\'assistance vis-à-vis des collectivités apportés par les activités et programmes de l\'aire protégée est approprié</b></li> </ul>',
        'module_info_Rating' => 'Evaluez les activités / programmes en cours par l\'aire protégée visant des avantages / assistance appropriés vis-à-vis des collectivités'
    ],

    'ActorsRelations' => [
        'title' => 'Relations avec les acteurs et Education environnementale',
        'fields' => [
            'Activity' => 'Activités/programmes',
            'EvaluationScore' => 'Importance et impact des activités',
            'Percentage' => 'Participation des communautés locales au activité/programme',
            'Comments' => 'Commentaire',
        ],
        'predefined_values' => [
            'Programme de sensibilisation au niveau des villages',
            'Programme de sensibilisation de résidants autres que les villages',
            'Programme d\'EE dans les écoles',
            'Programme de diffusion aux radios communautaires',
            'Conférences et débats sur la conservation',
            'Visites guidées dans le parc',
            'Matériel didactique de diffusion aux  écoles',
            'Emissions télévisuelles sur le PN',
            'Operations de nettoyage et déchets',
            'Ecomusée'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'pas d\'activités / programmes et sans effets',
                '1' => 'activités / programmes limités et peu ciblés, et à effets minimes',
                '2' => 'activités / programmes convenables, mais parfois occasionnels, et à effets moyens',
                '3' => 'activités / programmes planifiés et constants, et à effets forts',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Y a-t-il un programme établi d’éducation environnementale généraliste ou spécifiquement liée aux objectifs et nécessités de la conservation / gestion des ressources naturelles ?</li> <li><b>Juger s\'il existe des programmes d’éducation et de sensibilisation adaptés aux objectifs et aux nécessités de conservation / gestion des ressources naturelles de l\'aire protégée</b></li> </ul>',
        'module_info_Rating' => 'Evaluez les activités / programmes d’éducation et de sensibilisation actuellement en cours dans l\'aire protégée'
    ],

    'VisitorsManagement' => [
        'title' => 'Gestion des visiteurs',
        'fields' => [
            'Aspect' => '',
            'EvaluationScore' => 'Adéquation des installations et des services',
            'Comments' => 'Commentaire',
        ],
        'groups' => [
            'group0' => 'Gestion',
            'group1' => 'Expérience des visiteurs',
        ],
        'predefined_values' => [
            'group0' => [
                'Planification',
                'Hébergement , restauration et activités de loisirs',
                'Compétences et expertise du personnel',
                'Qualité des attraits touristiques',
                'Diversité des attraits touristiques',
                'Niveau de valorisation des potentialités touristiques',
                'Innovation'
            ],
            'group1' => [
                'Gamme de diversité de l\'offre et des expériences pour les visiteurs',
                'Sens de l\'endroit (maintenir ou améliorer le caractère propre de l\'espace naturel)',
                'Degré de satisfaction des visiteurs et expériences enrichissantes',
                'Niveau d\'appréciation des visiteurs du degré d\'assainissement / propreté de l\'espace naturel',
                'Sécurité des visiteurs',
                'Transport des visiteurs',
                'Stabilité du pays',
                'Accessibilité à l\'aire protégée',
                'Facilité administrative (visa, absence des tracasseries administratives, etc.)',
                'Réseau d\'échange touristique'
            ],
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'pas de disposition ni d\'application',
                '1' => 'établissement et application faibles',
                '2' => 'établissement et application adaptés, mais à améliorer',
                '3' => 'établissement et application conformes et proactifs',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>L\'aire protégée a-t-elle établi et mis en application les conditions nécessaires pour avoir une bonne adéquation des installations et des services pour les visiteurs (tourisme) ?</li> <li><b>Déterminer l\'adéquation des installations et des services pour les visiteurs (tourisme et éducation environnementale)</b></li> </ul>',
        'module_info_Rating' => 'Notez et évaluez le niveau d\'application des conditions nécessaires pour avoir une bonne adéquation des installations et des services pour les visiteurs dans l\'aire protégée (tourisme et éducation environnementale)'
    ],

    'VisitorsImpact' => [
        'title' => 'Visiteurs et impacts',
        'fields' => [
            'Impact' => '',
            'EvaluationScore' => 'Note',
            'Comments' => 'Commentaire',
        ],
        'groups' => [
            'group0' => 'Prise en charge des visiteurs',
            'group1' => 'Impact',
        ],
        'predefined_values' => [
            'group0' => [
                'Planification',
                'Gestion active',
                'Communication',
                'Surveillance'
            ],
            'group1' => [
                'Parvenir à une utilisation durable (écologique, sociale et économique)',
                'Minimiser les impacts environnementaux (transport, hébergement et logement, et activités de loisirs)',
                'Assurer des bénéfices économiques pour les aires protégées et les populations locales'
            ],
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'insuffisantes',
                '1' => 'pas suffisantes aux activités touristiques',
                '2' => 'en dessous du seuil optimal',
                '3' => 'adaptées et proactives par rapport aux activités touristiques',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>L\'aire protégée assure-t-elle la prise en charge et l\'atténuation des impacts des activités touristiques de manière appropriée ?</li> <li><b>Juger si la prise en charge et l\'atténuation des impacts des visiteurs sont gérées de manière appropriée</b></li> </ul>',
        'module_info_Rating' => 'Notez et évaluez le niveau de prise en charge et d\'atténuation des impacts des visites touristiques dans l\'aire protégée'
    ],

    'NaturalResourcesMonitoring' => [
        'title' => 'Systèmes de suivi / monitoring des valeurs et des aspects d\'importance de l\'aire protégée',
        'fields' => [
            'Aspect' => 'Conditions',
            'EvaluationScore' => 'Évaluez dans quelle mesure elle est respectée',
            'Comments' => 'Commentaires',
        ],
        'predefined_values' => [
            'La mise en œuvre des principaux objectifs de conservation est suivi',
            'L\'utilisation de plus d\'un indicateur facilite le suivi de la mise en œuvre des principaux objectifs de conservation',
            'La connaissance des données de référence sur l\'environnement appuie la gestion',
            'Les dispositions de suivi sont relativement faciles à comprendre par les utilisateurs visés',
            'Les méthodes de collecte et d’analyse des données sont adaptées et techniquement valables',
            'Les données sont accessibles et sécurisées',
            'Le suivi permet la détermination des tendances d’une série de menaces',
            'Les capacités institutionnelles et les ressources techniques permettent d\'assurer le suivi à l\'avenir',
            'Les données de suivi sont utilisées et entraînent des changements dans la gestion de l\'aire protégée',
            'Les données de suivi sont analysées et sont communiquées de manière appropriée',
            'Suivi des espèces animales phares, menacées, endémiques, ..., choisies comme indicateurs',
            'Suivi des espèces végétales phares, menacées, endémiques, ..., choisies comme indicateurs',
            'Suivi des habitats à caractéristique importante et significative, et sur l\'utilisation des sols dans et en dehors de l\'aire protégée (land cover - use)',
            'Suivi de l\'utilisation légale et durable des ressources naturelles (droits coutumiers et aires protégées à gestion des ressources naturelles',
            'Suivi de menaces directes et indirectes qui pèsent sur l\'aire protégée',
            'Suivi des impacts potentiels du changement climatique sur les éléments clés',
            'Suivi des services écosystémiques fournis par l\'aire protégée'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'pas des dispositions ni d\'application',
                '1' => 'adoption des dispositions et application faible',
                '2' => 'adoption des dispositions et applications adaptés, mais à améliorer',
                '3' => 'adoption des disposition et applications conformes et proactifs',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Les valeurs et les aspects importants de l\'aire protégée sont-ils efficacement suivis par rapport aux efforts de gestion et à l\'ampleur et à la gravité des menaces ?</li> <li><b>Evaluer l\'efficacité du suivi des valeurs et des aspects importants par rapport aux efforts de gestion et à l\'ampleur et à la gravité des menaces portées sur l\'aire protégée</b></li> </ul>',
        'module_info_Rating' => 'Établissez lesquelles des conditions ou plus listées sont respectées pour effectuer un suivi pertinent par rapport aux efforts de gestion et des menaces portées aux valeurs et aux aspects importants de l\'aire protégée (sur la base des éléments du Contexte d\'Intervention, points 4; 5; 6; 7)'
    ],

    'ResearchAndMonitoring' => [
        'title' => 'Recherche et biomonitoring',
        'fields' => [
            'Program' => 'Programmes et activités de biomonitoring et de recherche',
            'EvaluationScore' => 'Niveau d\'efficacité des activités de suivi et de recherche',
            'Comments' => 'Commentaire',
        ],
        'predefined_values' => [
            'Activités de biomonitoring et de recherche sur les espèces animales phare, menacées ou endémiques',
            'Activités de biomonitoring et de recherche sur les espèces végétales  caractéristiques, menacées ou endémiques',
            'Activités de biomonitoring et de recherche sur les habitats à caractéristique importante et significative, et sur l\'utilisation des sols dans et en dehors de l\'aire protégée (land cover - use - take)',
            'Activités de biomonitoring et de recherche sur l\'utilisation durable des ressources naturelles en périphérie de l\'aire protégée',
            'Activités de biomonitoring et de recherche sur les menaces directes et indirectes qui pèsent sur l\'aire protégée',
            'Activités de biomonitoring et de recherche sur les impacts potentiels du changement climatique sur les éléments clés',
            'Activités de biomonitoring et de recherche sur les services écosystémiques fournis par l\'aire protégée'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'pas d’activités de suivi ou de recherche dans l’aire protégée',
                '1' => 'activités ad hoc de suivi et de recherche, mais pas alignées sur les besoins et l\'amélioration de la gestion de l\'aire protégée',
                '2' => 'activités de suivi et de recherche partiellement alignées sur les besoins et l\'amélioration de la gestion de l\'aire protégée',
                '3' => 'activités de suivi et de recherche alignées sur les besoins et l\'amélioration de la gestion de l\'aire protégée',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>o	Y a-t-il un programme et des activités de biomonitoring et de recherche ?</li> <li><b>Analyser et évaluer les activités de recherche et suivi écologique (biomonitoring) de la gestion des aspects naturels et culturels</b></li> </ul>',
        'module_info_Rating' => 'Établissez et évaluez lesquelles des activités de recherche ou plus listées sont mise en œuvre dans le programme de gestion de l\'aire protégée (sur la base des éléments du Contexte d\'Intervention, points 4; 5; 6; 7)'
    ],

    'ClimateChangeMonitoring' => [
        'title' => 'Gestion des effets du changement climatique',
        'fields' => [
            'Program' => 'Programmes de gestion',
            'EvaluationScore' => 'Niveau d\'efficacité des activités',
            'Comments' => 'Commentaire',
        ],
        'predefined_values' => [
            'Adoption des éléments de suivi et évaluation des aspects et des effets du changement climatique (p.ex. indicateurs pour les activités de REDD+)',
            'Adoption des aspects liés au changement climatique dans la planification',
            'Adoptions de mesures liées à l’atténuation et adaptation au changement climatique pour les espèces animales phare, menacées ou endémiques',
            'Adoptions de mesures liées à l’atténuation et adaptation au changement climatique pour les espèces végétales  caractéristiques, menacées ou endémiques',
            'Adoptions de mesures liées à l’atténuation et adaptation au changement climatique pour les habitats et sur l\'utilisation des sols dans et en dehors de l\'aire protégée (land cover - use - take)',
            'Adoptions de mesures liées à l’atténuation et adaptation au changement climatique pour les services écosystémiques rendus et la dépendance des populations riveraines (de la zone de transition pour les réserves MAB)',
            'Adoptions de mesures liées à l’atténuation et adaptation au changement climatique pour l\'utilisation durable des ressources naturelles en périphérie de l\'aire protégée',
            'Adoption d’une approche adaptative et proactive dans la gestion des effets du changement climatique',
            'Adoption de renforcement de capacités des ressources humaines dans la planification, suivi-évaluation, gestion et gouvernance des processus liés au changement climatique (p.ex. activités REDD-plus)',
            'Adoption d’une approche d’implication-responsabilisation des parties prenantes dans la planification et processus liés au  changement climatique de l\'AP et son écosystème de référence',
            'Adoption des indicateurs-benchmarks relatifs à l’atténuation et adaptation au changement climatique (p.ex. stock carbone, espèces exotiques envahissantes, incendies, etc.)',
            'Adoption des aspects du  changement climatique dans les stratégies de communication et d’éducation environnementale et à l’environnement des AP (avantages) et leurs écosystèmes de référence (gestion durable des ressources naturelles)'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'pas d’activité / programme d\'atténuation et d\'adaptation au changement climatique dans l’aire protégée',
                '1' => 'activités / programme ad hoc, mais pas alignés sur les besoins d\'atténuation et d\'adaptation au changement climatique',
                '2' => 'activités / programme partiellement alignés sur les besoins d\'atténuation et d\'adaptation au changement climatique',
                '3' => 'activités / programme alignés sur les besoins d\'atténuation et d\'adaptation au changement climatique',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>L\'aire protégée est-elle gérée de manière à prendre en compte les effets probables du changement climatique?</li> <li><b>Estimer les dispositions d\'atténuation et d\'adaptation dans la planification et la gestion de l\'aire protégée visant à prendre en compte les effets du changement climatique</b></li> </ul>',
        'module_info_Rating' => 'Établissez et évaluez lesquelles des activités et programmes de planification / gestion de l\'aire protégée axés sur les activités d’atténuation et d\'adaptation au changement climatique au profit de la conservation et la gestion durable des ressources naturelles sont mise en œuvre dans le programme de gestion de l\'aire protégée (sur la base des éléments du Contexte d\'Intervention, points 4; 5; 7) (voir exemple des projets REDD+)'
    ],

    'EcosystemServices' => [
        'title' => 'Services écosystémiques',
        'fields' => [
            'Intervention' => 'Interventions',
            'EvaluationScore' => 'Efficacité dans la conservation',
            'Comments' => 'Commentaire',
        ],
        'groups' => [
            'group0' => 'Approvisionnement: Nutrition (p.ex. eau, arbres à chenilles, plante médicinales, etc. dans et autour de l\'aire protégée)',
            'group1' => 'Approvisionnement: Matériaux (p.ex. reboisement de production, PFNL pour leur utilisation durable)',
            'group2' => 'Approvisionnement: Energie (p.ex. production hydroélectrique)',
            'group3' => 'Régulation: Médiation des déchets, substances toxiques et autres nuisances (p.ex. le filtrage et la décomposition des déchets organiques et des polluants dans les eaux)',
            'group4' => 'Régulation: Médiation des flux (p.ex. reboisements de protection)',
            'group5' => 'Régulation: Maintien de conditions biologiques, chimiques, physiques (p.ex. pollination, atténuer les dégâts provoqués par les catastrophes naturelles)',
            'group6' => 'Culturel: Interactions physiques et expérience (p.ex. éducation environnementale)',
            'group7' => 'Culturel: Interactions intellectuelles et de représentation (p.ex. activités de recherche)',
            'group8' => 'Culturel: Spirituel et/ou emblématiques (p.ex. rites traditionnels)',
            'group9' => 'Culturel: Autres sorties culturelles (conservation ex-situ) (p.ex. jardin botaniques, refuge des animaux, etc.)',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'insuffisante',
                '1' => 'pas suffisante au maintien/valorisation des services écosystémiques essentiels',
                '2' => 'en dessous du seuil optimal du maintien/valorisation des services écosystémiques',
                '3' => 'adaptés au maintien/valorisation des services écosystémiques',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Y a-t-il des actions / un programme en faveur de la conservation / la valorisation des services écosystémiques rendus par l\'aire protégée ?</li> <li><b>Déterminer l\'efficacité dans la conservation / la valorisation des services écosystémiques</b></li> </ul>',
        'module_info_Rating' => 'Listez jusqu\'à 3 ou plus activités et programmes de maintien et valorisation de services écosystémiques fournis par l\'aire protégée pour le bien-être humain (sur la base des éléments du Contexte d\'Intervention, point 7.1)'
    ],

    'ObjectivesProcessus' => [
        'title' => 'Détermination des objectifs',
        'fields' => [
            'Status' => 'Ligne de base',
            'Benchmark1' => 'Valeur de référence, benchmark 1',
            'Benchmark2' => 'Valeur de référence, benchmark 2',
            'Benchmark3' => 'Valeur de référence, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées',
        ],
        'module_info' => 'Cibles de conservation et des indicateurs relatifs aux <b>processus et activités de mise en œuvre des planifications</b> de l’aire protégée<br /> Les objectifs et les valeurs de référence (benchmarks) à insérer dans le tableau ci-dessous sont à utiliser dans la gestion et le suivi des activités de l\'aire protégée et plus spécifiquement dans les phases de planification, recherche des ressources (Intrants), processus, détermination des résultats et des objectifs d\'impact.'
    ],

    'WorkProgramImplementation' => [
        'title' => 'Mise en œuvre du programme de travail',
        'fields' => [
            'Activity' => 'Lignes d’intervention',
            'Action' => 'Action',
            'EvaluationScore' => '',
            'Percentage' => '% de mise en œuvre',
            'Comments' => 'Commentaire',
        ],
        'module_info' => 'Le système statistique ne permet que cinq lignes pour identifier les fonctions du personnel de l’aire protégée',
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'pas de mise en œuvre de l\'activité annuelle (0%)',
                '1' => 'faible mise en œuvre de l\'activité annuelle (entre 1-33%) ',
                '2' => 'mise en œuvre modérée de l\'activité annuelle (entre 34-66%)',
                '3' => 'mise en œuvre importante de l\'activité annuelle (entre 66-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Comment et dans quelle proportion les principales activités du programme de travail sont-elles mises en œuvre par l’aire protégée ?</li> <li><b>Evaluation de la <span style="text-decoration: underline">mise en œuvre</span> des principales activités du plan de travail annuel ou pluriannuel</b></li> </ul>',
        'module_info_Rating' => 'Listez jusqu\'à cinq principales activités du plan de travail pour évaluer leur mise en œuvre'
    ],

    'AchievedResults' => [
        'title' => 'Résultats atteints',
        'fields' => [
            'Activity' => 'Principales activités du plan de travail',
            'EvaluationScore' => 'Niveau d\'atteinte des activités',
            'Percentage' => 'Pourcentage d\'atteinte',
            'Comments' => 'Commentaire',
        ],
        'module_info' => 'Le système statistique ne permet que cinq lignes pour identifier les fonctions du personnel de l’aire protégée',
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'pas d\'atteinte du résultat (0%)',
                '1' => 'faible atteinte du résultat (entre 1 - 33%) ',
                '2' => 'atteinte modérée du résultat (entre 34-66%)',
                '3' => 'atteinte importante du résultat (entre 66 - 100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Comment et dans quelle proportion l\'aire protégée a -t-elle atteint les principaux <b>résultats</b> du plande travail ?</li> <li><b>Indiquer la proportion d\'atteintes estimées des principaux <span style="text-decoration: underline">résultats</span> des activités et des plans de travail annuels ou pluriannuel</b></li> </ul>',
        'module_info_Rating' => 'Listez jusqu\'à cinq principales résultats du plan de travail pour évaluer le niveau d\'atteinte des résultats attendus'
    ],

    'AchievedObjectives' => [
        'title' => 'Atteinte des objectifs de conservation',
        'fields' => [
            'Objective' => 'Objectifs principaux ou secondaires du plan de gestion',
            'EvaluationScore' => 'Niveau d\'ateinte',
            'Percentage' => 'Proportion de l\'objectif atteinte',
            'Comments' => 'Commentaire',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'pas d\'atteinte de l\'objectif du plan de travail et du plan de gestion (0%)',
                '1' => 'faible atteinte de l\'objectif du plan de travail et du plan de gestion (entre 1 - 33%)',
                '2' => 'atteinte modérée de l\'objectif du plan de travail et du plan de gestion (entre 34-66%)',
                '3' => 'atteinte importante de l\'objectif du plan de travail et du plan de gestion (pluriannuel) (entre 66 - 100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Comment et en quelle proportion l\'aire protégée a-t-elle atteint les objectifs du plan de travail et du plan de gestion ?</li> <li><b>Déterminer l\'atteinte des objectifs fixés</b></li> </ul>',
        'module_info_Rating' => 'Listez et évaluez cinq ou plus objectifs principaux ou secondaires du plan de gestion pour en évaluer le niveau d\'atteinte'
    ],

    'DesignatedValuesConservation' => [
        'title' => 'Etat de conservation des valeurs désignées de l’aire protégée',
        'fields' => [
            'Value' => 'Valeurs',
            'EvaluationScore' => 'État de conservation',
            'Comments' => 'Commentaire',
        ],
        'groups' => [
            'group0' => 'Impact des activités de gestion sur l\'état de conservation des espèces animales phare, menacées ou endémiques, …, choisies comme indicateurs',
            'group1' => 'Impact des activités de gestion sur l\'état de conservation des espèces végétales caractéristiques, menacées ou endémiques, …, choisies comme indicateurs',
            'group2' => 'Impact des activités de gestion sur l\'état de conservation des habitats caractéristiques et sur l\'utilisation des sols dans et en dehors de l\'aire protégée (land cover - use - take)',
            'group3' => 'Impact des activités de gestion sur l\'état d\'utilisation légale, mais pas durable des ressources naturelles',
            'group4' => 'Impact des activités de gestion sur l\'atténuation des menaces directes et indirectes qui pèsent sur l\'aire protégée',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '-3 / -2 / -1' => 'Négative (moins - plus important)',
                '0' => 'Stable',
                '+1 / +2 / +3' => 'Positive (moins - plus important)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Quels sont les <span style="text-decoration: underline">états de conservation</span> des valeurs désignées de l’aire protégée ?</li> <li><b>Déterminer l\'impact des activités de gestion sur l\'état de conservation des valeurs désignées et des elements clé de l’aire protégée</b></li> </ul>',
        'module_info_Rating' => 'Evaluez les valeurs et les éléments clé de l’aire protégée sur la base des analyses du contexte pour évaluer l\'impact des activités de gestion sur l\'état de conservation (sur la base des éléments du Contexte d\'Intervention, points 4; 5; 6; 7)'
    ],

    'DesignatedValuesConservationTendency' => [
        'title' => 'Tendances de l’état de conservation des valeurs désignées de l’aire protégée',
        'fields' => [
            'Value' => 'Valeurs',
            'EvaluationScore' => 'Tendance de l\'état de conservation',
            'Comments' => 'Commentaire',
        ],
        'groups' => [
            'group0' => 'Impact des activités de gestion sur les tendances de l’état de conservation des espèces animales phare, menacées ou endémiques, …, choisies comme indicateurs',
            'group1' => 'Impact des activités de gestion sur les tendances de l’état de conservation des espèces végétales caractéristiques, menacées ou endémiques, …, choisies comme indicateurs',
            'group2' => 'Impact des activités de gestion sur les tendances de l’état de conservation des habitats caractéristiques et sur l\'utilisation des sols dans et en dehors de l\'aire protégée (land cover - use - take)',
            'group3' => 'Impact des activités de gestion sur les tendances de l\'utilisation légale, mais pas durable des ressources naturelles',
            'group4' => 'Impact des activités de gestion sur les tendances des menaces directes et indirectes qui pèsent sur l\'aire protégée',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '-3 / -2 / -1' => 'Négative (moins - plus important)',
                '0' => 'Stable',
                '1 / 2 / 3' => 'Positive (moins - plus important)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Quelles sont les <span style="text-decoration: underline">tendances évolutivesde l\'état de conservation</span> de valeurs et les éléments clé désignées de l’aire protégée ?</li> <li>Estimer la <span style="text-decoration: underline">tendance évolutive de l’état de conservation</span> des valeurs et les éléments clé désignées de l’aire protégée</li> </ul>',
        'module_info_Rating' => 'Evaluez les valeurs et les éléments clé de l’aire protégée sur la base des analyses du contexte déjà établies dans le point précèdent pour en évaluer la tendance évolutive de l\'état de conservation (sur la base des éléments du Contexte d\'Intervention, points 4; 5; 6; 7)'
    ],

    'LocalCommunitiesImpact' => [
        'title' => 'Effets et Impact sur les communautés locales',
        'fields' => [
            'Impact' => 'Effets et impacts économiques/sociaux',
            'EvaluationScore' => 'Degré d\'atteinte actuel',
            'Comments' => 'Commentaire',
        ],
        'predefined_values' => [
            'Emploi de personnel riverains de l\'aire protégée',
            'Payement des biens et services à la population riveraine de l\'aire protégée',
            'Recrutement des gardes dans la zone administrative de référence',
            'Tourisme et retombées en termes d\'emploi',
            'Projet pilote de réduction des conflits homme/faune',
            'Ecoles, dispensaires, appui social',
            'Appui dans la production vivrière et petit élevage',
            'Points d\'eau, adduction d\'eau',
            'Amélioration des routes',
            'Fourniture énergie, connexion électrique'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '-3 / -2 / -1' => 'Négative (moins - plus important)',
                '0' => 'Nulle',
                '1 / 2 / 3' => 'Positive (moins - plus important)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>L\'aire protégée fournit-elle des avantages ou des désavantages économiques/sociaux aux communautés locales, par exemple, revenu, emploi, payement des services environnementaux, etc. ?</li> <li>Juger les effets et l\'impacts économiques/sociaux de la gestion de l\'aire protégée sur les communautés locales</li> </ul>',
        'module_info_Rating' => 'Evaluez les effets et les impacts économiques/sociaux sur les communautés locales comme consequence de la gestion de l\'aire protégée'
    ],

    'ClimateChangeImpact' => [
        'title' => 'Effets et Impact de l’atténuation et de l\'adaptation au changement climatique',
        'fields' => [
            'Impact' => 'Effets et impacts',
            'EvaluationScore' => 'Degré d\'atteinte actuel',
            'Comments' => 'Commentaire',
        ],
        'predefined_values' => [
            'Impacts des activités d’atténuation et d\'adaptation au changement climatique pour les espèces animales phare, menacées ou endémiques',
            'Impacts des activités d’atténuation et d\'adaptation au changement climatique pour les espèces végétales  caractéristiques, menacées ou endémiques',
            'Impacts des activités d’atténuation et d\'adaptation au changement climatique pour les habitats à caractéristique importante et significative, et sur l\'utilisation des sols dans et en dehors de l\'aire protégée (land cover - use - take)',
            'Impacts des activités d’atténuation et d\'adaptation au changement climatique pour les services écosystémiques rendus et la dépendance des populations riveraines (de la zone de transition pour les réserves MAB)',
            'Impacts des activités d’atténuation et d\'adaptation au changement climatique pour l\'utilisation durable des ressources naturelles en périphérie de l\'aire protégée'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '-3 / -2 / -1' => 'Négative (moins - plus important)',
                '0' => 'Nulle',
                '1 / 2 / 3' => 'Positive (moins - plus important)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>L\'aire protégée est-elle gérée en prenant en compte les effets probables du changement climatique?</li> <li>Estimer les effets et l\'impact sur la conservation de la diversité biologique et la gestion durable des ressources naturelles comme conséquence des résultats des activités d’atténuation et d\'adaptation au changement climatique</li> </ul>',
        'module_info_Rating' => 'Evaluez les effets et les impacts au profit de la conservation de la diversité biologique et de la gestion durable des ressources naturelles comme conséquence des résultats des activités d’atténuation et d\'adaptation au changement climatique (sur la base des éléments du Contexte d\'Intervention, points 4; 5; 7)'
    ],

    'EcosystemServicesImpact' => [
        'title' => 'Effets et Impact sur les services écosystémiques',
        'fields' => [
            'Impact' => 'Effets et impacts',
            'EvaluationScore' => 'Degré d\'atteinte actuel',
            'Comments' => 'Commentaire',
        ],
        'predefined_values' => [
            'Approvisionnement Nutrition',
            'Approvisionnement Matériaux',
            'Approvisionnement Energie',
            'Régulation: Médiation des déchets, substances toxiques et autres nuisances',
            'Régulation: Médiation des flux',
            'Régulation: Maintien de conditions biologiques, chimiques, physiques',
            'Culturel: Interactions physiques  et l\'expérience',
            'Culturel: Interactions intellectuelles et de représentation',
            'Culturel: Spirituel et/ou emblématiques',
            'Culturel: Autres sorties culturelles (conservation ex-situ)'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '-3 / -2 / -1' => 'Négative (moins - plus important)',
                '0' => 'Stable',
                '+1 / +2 / +3' => 'Positive (moins - plus important)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>L’aire protégée fournit-elle des effets et un impact sur le maintien / la valorisation des services écosystémiques ?</li> <li>Juger les effets et l\'impact de la gestion de l’aire protégée sur le maintien / la valorisation des services écosystémiques</li> </ul>',
        'module_info_Rating' => 'Evaluez les effets et les impacts sur les services écosystémiques comme conséquence des résultats des activités de gestion de l\'aire protégée (sur la base des éléments du Contexte d\'Intervention, point 7.2)'
    ],

];