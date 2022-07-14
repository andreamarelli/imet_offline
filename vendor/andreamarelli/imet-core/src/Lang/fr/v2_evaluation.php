<?php

return [

    '_Objectives' => [
        'title' => 'Détermination des objectifs',
        'fields' => [
            'Element' => 'Elément/Indicateur',
            'Status' => 'Base de référence',
            'Objective' => 'Objectif - Condition souhaitée',
            'comments' => 'Commentaires'
        ]
    ],

    'ImportanceClassification' => [
        'title' => 'Désignations',
        'fields' => [
            'Aspect' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Evaluation: Intégration',
            'SignificativeClassification' => 'Importante désignation internationale',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Pas d’intégration',
                '1' => 'Faible intégration',
                '2' => 'Intégration partielle',
                '3' => 'Forte intégration',
            ]
        ],
        'module_subTitle' => 'Valeur et importance: Désignations',
        'module_info_EvaluationQuestion' => [
            'L’aire protégée tient-elle compte des valeurs et de l’importance des désignations nationales, régionales ou internationales dans sa gestion ?'
        ],
        'module_info_Rating' => [
            'Évaluer le niveau d’intégration des valeurs et de l’importance des désignations (nationale, internationale et spéciales par exemple site du patrimoine mondial ou site Ramsar) dans la gestion de l’aire protégée'
        ]
    ],

    'ObjectivesClassification' => [
        'module_info' => 'Établir et décrire les objectifs de conservation pour la ou les désignations nationales, régionales ou internationales actuelles de l’aire protégée. Les objectifs et les cibles indiqués ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases de processus et pour le suivi des activités de gestion de l’aire protégée'
    ],

    'ImportanceSpecies' => [
        'title' => 'Espèces clés',
        'fields' => [
            'Aspect' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Intégration',
            'SignificativeSpecies' => 'Espèce très représentative',
            'IncludeInStatistics' => 'À prioriser dans la gestion',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Identifier les espèces animales (espèces phares, menacées, endémiques,...)',
            'group1' => 'Identifier les espèces de plantes (espèces phares, menacées, endémiques,...)',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Pas d’intégration',
                '1' => 'Faible intégration',
                '2' => 'Intégration partielle',
                '3' => 'Forte intégration',
            ]
        ],
        'module_subTitle' => 'Valeurs et importance — Espèces (phare, en voie de disparition, endémiques, exploitées, envahissantes, etc.)',
        'module_info_EvaluationQuestion' => [
            'L’aire protégée a-t-elle clairement identifié et intégré les espèces clés dans sa gestion ?'
        ],
        'module_info_Rating' => [
            'Évaluer le niveau d’intégration d’un minimum de 3 à un maximum de 10 espèces clés dans la gestion de l’aire protégée (sur la base de l’analyse du contexte d’intervention, points CTX 4.1 et 4.2, automatiquement reportée ci-dessous). La représentativité ou la très représentativité d’une espèce clé correspond au degré auquel elle: [i] représente un importante caractéristique naturelle d’un habitat, d’un écosystème ou d’un biome ; (ii) influence un processus ou une communauté écologique ou [iii] affecte une politique de gestion axée sur les espèces)'
        ],
        'validation_3to10' => 'Évaluer le niveau d’intégration d’un minimum de 3 à un maximum de 10 espèces clés dans la gestion de l’aire protégée (sur la base de l’analyse du contexte d’intervention, points CTX 4.1 et 4.2, automatiquement reportée ci-dessous). La représentativité d’une espèce clé correspond au degré auquel elle: [i] représente un importante caractéristique naturelle d’un habitat, d’un écosystème ou d’un biome ; (ii) influence un processus ou une communauté écologique ou [iii] affecte une politique de gestion axée sur les espèces)',
        'warning_on_save' =>
            'ATTENTION!!<br />Toute modification peut provoquer une perte de données dans les modules
            d\'évaluation suivants (s\'ils sont déjà codés):<br /><i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'ObjectivesSpecies' => [
        'module_info' => 'Établir et décrire les objectifs de conservation des espèces (espèces phares, menacées, endémiques, exploitées, envahissantes ou pour lesquelles les données sont insuffisantes) dans l’aire protégée. Les objectifs et les cibles indiqués ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases de processus et pour le suivi des activités de gestion de l’aire protégée'
    ],

    'ImportanceHabitats' => [
        'title' => 'Habitats terrestres et marins (couverture terrestre, utilisation et occupation du sol)',
        'fields' => [
            'Aspect' => 'Critère — Concept mesuré — Variable ',
            'EvaluationScore' => 'Intégration',
            'EvaluationScore2' => 'Valeur/importance régionale et mondiale',
            'IncludeInStatistics' => 'À prioriser dans la gestion',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Pas d’intégration',
                '1' => 'Faible intégration',
                '2' => 'Intégration partielle',
                '3' => 'Forte intégration',
            ],
            'EvaluationScore2' => [
                '1' => 'Faible valeur/importance',
                '2' => 'Valeur/importance modérée',
                '3' => 'Valeur/importance élevée',
            ],
        ],
        'module_subTitle' => 'Valeurs et importance — Habitats terrestres et marins - couverture terrestre, utilisation et occupation du sol',
        'module_info_EvaluationQuestion' => [
            'L’aire protégée a-t-elle clairement identifié et intégré les habitats terrestres et marins les plus importants et les éléments connexes de couverture terrestre, utilisation et occupation du sol dans la gestion ?'
        ],
        'module_info_Rating' => [
            'Évaluer le niveau d’intégration dans la gestion de l’aire protégée d’un minimum de 3 à un maximum de 10 des habitats et éléments connexes les plus représentatifs et les plus importants des types de couverture terrestre, d’utilisation et d’occupation du sol (sur la base de l’analyse du contexte d’intervention, points CTX 4.3, automatiquement reportés ci-dessous). La valeur/importance régionale et mondiale des habitats est une mesure dans laquelle elle : i) représente, au niveau local, national ou mondial, l’environnement naturel de plantes ou d’animaux clés ; (ii) influence un processus ou une communauté écologique et [iii] affecte une politique de gestion axée sur l’habitat'
        ],
        'validation_3to10' => 'Veuillez inclure dans la gestion au moins 3 et au plus 10 habitats.',
        'warning_on_save' =>
            'ATTENTION!!<br />Toute modification peut provoquer une perte de données dans les modules
            d\'évaluation suivants (s\'ils sont déjà codés):<br /><i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'ObjectivesHabitats' => [
        'module_info' => 'Établir et décrire les objectifs de conservation pour le maintien des habitats terrestres et marins et les éléments connexes de la couverture terrestre, l’utilisation et l’occupation du sol et de l’occupation du sol de l’aire protégée. Les objectifs et les cibles indiqués ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases de processus et pour le suivi des activités de gestion dans l’aire protégée'
    ],

    'ImportanceClimateChange' => [
        'title' => 'Changement climatique',
        'fields' => [
            'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
            'Aspect' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Intégration',
            'IncludeInStatistics' => 'À prioriser dans la gestion',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Pas d’intégration',
                '1' => 'Faible intégration',
                '2' => 'Intégration partielle',
                '3' => 'Forte intégration',
            ]
        ],
        'module_subTitle' => 'Valeur et importance - Changement climatique',
        'module_info_EvaluationQuestion' => [
            'L’aire protégée a-t-elle clairement identifié et intégré les éléments clés (espèces, habitats, etc.) les plus vulnérables au changement climatique dans la gestion pour adopter les meilleures mesures d’adaptation disponibles ?'
        ],
        'module_info_Rating' => [
            'Évaluer le niveau d’intégration dans la gestion de l’aire protégée des éléments clés les plus importants (espèces, habitats, etc.) les plus vulnérables au changement climatique (sur la base de l’analyse du contexte d’intervention, points CTX6.1, automatiquement reporté ci-dessous)'
        ],
        'warning_on_save' =>
            'ATTENTION!!<br />Toute modification peut provoquer une perte de données dans les modules
            d\'évaluation suivants (s\'ils sont déjà codés):<br /><i>I1</i>, <i>PR7</i>, <i>PR17</i> and <i>O/C2</i>'
    ],

    'ObjectivesClimateChange' => [
        'module_info' => 'Établir et décrire les objectifs de conservation pour les effets les plus importants du changement climatique sur l’aire protégée. Les objectifs et les cibles indiqués ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases de processus et pour le suivi des activités de gestion de l’aire protégée'
    ],

    'ImportanceEcosystemServices' => [
        'title' => 'Services écosystémiques',
        'fields' => [
            'Aspect' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Intégration',
            'IncludeInStatistics' => 'À prioriser dans la gestion',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'Pas d’intégration',
                '1' => 'Faible intégration',
                '2' => 'Intégration partielle',
                '3' => 'Forte intégration',
            ]
        ],
        'module_subTitle' => 'Valeur et importance - Services écosystémiques',
        'module_info_EvaluationQuestion' => [
            'L’aire protégée a-t-elle clairement identifié et intégré les services écosystémiques les plus importants pour le bien-être humain dans la gestion ?'
        ],
        'module_info_Rating' => [
            'Evaluer le niveau d’intégration des services écosystémiques les plus importants dans la gestion de l’aire protégée (sur la base de l’analyse du contexte d’intervention, point CTX 7.1, reporté automatiquement ci-dessous)'
        ],
        'warning_on_save' =>
            'ATTENTION!!<br />Toute modification peut provoquer une perte de données dans les modules
            d\'évaluation suivants (s\'ils sont déjà codés):<br /><i>I1</i>, <i>PR7</i>, <i>PR18</i> and <i>O/C2</i>'
    ],

    'ObjectivesEcosystemServices' => [
        'module_info' => 'Établir et décrire les objectifs de conservation pour préserver les services écosystémiques de l’aire protégée. Les objectifs et les cibles indiqués ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases de processus et pour le suivi des activités de gestion dans l’aire protégée'
    ],

    'SupportsAndConstraints' => [
        'title' => 'Contraintes/conflits ou soutiens/conformités externes',
        'fields' => [
            'Aspect' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Influence/pouvoir des parties prenantes',
            'EvaluationScore2' => 'Niveau des contraintes/conflits ou soutiens/conformités',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Collectivité locale',
            'group1' => 'Gouvernement',
            'group2' => 'Bailleurs de fonds, scientifiques, chercheurs et ONG',
            'group3' => 'Opérateurs économiques',
        ],
        'predefined_values' => [
            'group0' => [
                'Autorités traditionnelles',
                'Peuples autochtones',
                'Collectivités vivant à proximité ou à l’intérieur de l’aire protégée',
                'Collectivités ne vivant pas en proximité de l’aire protégée',
                'Détenteurs de droits traditionnels ou modernes',
                'Propriétaires fonciers ou des terres',
                'Utilisateurs locaux des ressources naturelles',
                'Utilisateurs locaux de produits forestiers non ligneux (PFNL)',
                'Groupes sous-représentés ou défavorisés'
            ],
            'group1' => [
                'Gouvernement central',
                'Gouvernement local',
                'Conseil territorial/départemental et municipal',
                'Autorité en charge des aires protégées',
                'Services fonciers locaux',
                'Représentants des populations locales (parlementaires, etc.)',
                'Forces armées (police, paramilitaire, militaire et marine)'
            ],
            'group2' => [
                'ONG de défense des droits sociaux',
                'ONG environnementale',
                'Scientifiques/Chercheurs',
                'Bailleurs de fonds',
            ],
            'group3' => [
                'Opérateurs touristiques privés',
                'Exploitants forestiers',
                'Pêcheurs'
            ],
        ],

        'ratingLegend' => [
            'EvaluationScore' => [
                '1' => 'Influence/pouvoir faible ',
                '2' => 'Influence/pouvoir modéré',
                '3' => 'Influence/pouvoir élevé',
                'N/A' => 'n\'est pas impliquée dans le processus'
            ],
            'EvaluationScore2' => [
                '-3' => 'Contraintes/conflits importantes',
                '-2' => 'Contraintes/conflits modérées',
                '-1' => 'Contraintes/conflits faibles',
                '0' => 'Ni contraintes/conflits, ni soutiens/conformités de la partie prenante',
                '+1' => 'Supports/conformités faibles',
                '+2' => 'Supports/conformités modérés',
                '+3' => 'Supports/conformités importantes',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'La gestion de l’aire protégée est-elle soumise à des contraintes/conflits ou bénéficie-t-elle de facteurs d’appui liés à l’environnement politique, institutionnel et social extérieur ?',
            'L’environnement politique, institutionnel et civil peut entraver (contraintes/conflits externes) ou faciliter (soutiens/conformités externes) les activités de conservation de l’aire protégée. Les contraintes/conflits ou les soutiens/conformités par l’environnement politique, institutionnel et civil extérieur peuvent être mesurés par leur intensité et par l’influence/le pouvoir des parties prenantes qui limitent ou soutiennent l’aire protégée'
        ],
        'module_info_Rating' => [
            'Évaluer les contraintes/conflits ou les facteurs d’appui les plus importants de l’environnement politique, institutionnel et civil extérieur dans la gestion de l’aire protégée'
        ]
    ],

    'ObjectivesSupportsAndConstraints' => [
        'module_info' => 'Établir et décrire les objectifs de conservation pour les contraintes/conflits ou les facteurs de soutien/conformité de l’aire protégée. Les objectifs et les cibles indiqués ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases de processus et pour le suivi des activités de gestion de l’aire protégée'
    ],

    'Menaces' => [
        'title' => 'Menaces',
        'fields' => [
            'Aspect' => 'Evaluation des menaces (automatiquement reportées de CTX 5.1)',
            'IncludeInStatistics' => 'À prioriser dans la gestion',
            'Comments' => 'Commentaires/Explication',
        ],
        'module_info_EvaluationQuestion' => [
            'L’aire protégée a-t-elle clairement identifié et intégré les menaces qui pourraient affecter la biodiversité, le patrimoine culturel ou les services écosystémiques dans sa gestion ?'
        ],
        'module_info_Rating' => [
            'Évaluer le niveau d’intégration des menaces les plus importantes dans la gestion de l’aire protégée sur la base de l’analyse du contexte d’intervention, calculateur de menaces, point  CTX 5.1 et automatiquement reporté ci-dessous'
        ],
        'warning_on_save' =>
            'ATTENTION!!<br />Toute modification peut provoquer une perte de données dans les modules
            d\'évaluation suivants (s\'ils sont déjà codés):<br /><i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'ObjectivesMenaces' => [
        'module_info' => 'Établir et décrire les objectifs de conservation pour les menaces les plus importantes auxquelles l’aire protégée est confrontée. Les objectifs et les cibles indiqués ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases de processus et pour le suivi des activités de gestion de l’aire protégée'
    ],

    'RegulationsAdequacy' => [
        'title' => 'Adéquation des dispositions légales et réglementaires',
        'fields' => [
            'Regulation' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Evaluation: Adéquation',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Promulgation et désignation par l’autorité (p. ex. parc national)',
            'Clarté de la délimitation juridique de l’aire protégée (p.ex. limites naturelles telles que rivières, limites non naturelles, droits coutumiers, enclaves, etc.)',
            'Règlement interne pour la gestion de l’aire protégée',
            'Ratification et application des conventions internationales [CITES, CDB, Nagoya, CMS, Patrimoine mondial, RAMSAR, etc.]',
            'Lois sur les aires protégées et la conservation',
            'Lois sur la gestion des ressources naturelles [complémentaires aux lois sur la conservation]',
            'Lois et conventions sur la recherche en matière de biodiversité et de ressources naturelles',
            'Lois sur les droits fonciers',
            'Droit coutumier',
            'Accords volontaires, y compris les partenariats public-privé (qui peuvent inclure, par exemple, des systèmes de compensation volontaire de la biodiversité)',
            'Impôts, taxes, droits d’utilisation (par exemple, droits d’entrée dans les parcs marins)',
            'Certification, éco-label (par exemple, le MSC Marine Stewardship Council)',
            'Fermetures spatiales et temporelles de la pêche ; limitations du nombre et de la taille des navires (contrôle des entrées) ; autres restrictions ou interdictions d’utilisation (par exemple, CITES)',
            'Normes (par exemple MARPOL pour les navires) ; interdiction de la pêche à la dynamite ou des engins de pêche',
            'Limites ou quotas de captures (contrôles des prélèvements)',
            'Licences, par exemple aquaculture et parcs éoliens offshore'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' => 'Inadéquat',
                '1' => 'Plutôt inadéquat',
                '2' => 'Adéquat',
                '3' => 'totalement adéquat',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Les dispositions légales et réglementaires actuelles sont-elles adéquates pour les activités de conservation et de gestion des ressources naturelles de l’aire protégée ?',
            'Les dispositions législatives et réglementaires, résultant des institutions et des énoncés de politique, constituent la base d’un cadre efficace et solide pour la gouvernance et la gestion de l’aire protégée et, plus important encore, pour assurer sa durabilité à long terme pour les générations actuelles et futures.'
        ],
        'module_info_Rating' => [
            'Identifier et évaluer l’adéquation des dispositions légales et réglementaires actuelles pour la conservation et la gestion des ressources naturelles de l’aire protégée'
        ]
    ],

    'DesignAdequacy' => [
        'title' => 'Conception et aménagement de l’aire protégée',
        'fields' => [
            'Values' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Evaluation: A) Adéquation de la mesure de la démarcation',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Taille [superficie]',
            'Configuration ou forme de l’aire protégées',
            'Rapport périmètre/surface [sur la base de l’analyse du contexte d’intervention, point CTX 2.1]',
            'Zone frontalière [zones situées à proximité immédiate des frontières à l’extérieur de l’aire protégée et qui sont soumises à des règles spéciales d’utilisation des ressources]',
            'Zones tampons [zones entourant une aire protégée, où une gestion spéciale de l’utilisation des ressources et des mesures spéciales de développement sont entreprises afin d’améliorer la valeur de conservation de l’aire protégée]',
            'Corridors de migration',
            'Intégrité du/des bassins versants pour le captage d’eau',
            'Zone de non-utilisation (No-Use zone)',
            'Zone de non-prélèvement (No-take zone)',
            'Zones tampons pour les usages traditionnels',
            'Zones tampons pour les activités éducatives et/ou récréatives',
            'Zone multi-usage'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' =>    'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' => 'Inadéquat',
                '1' => 'Plutôt inadéquat',
                '2' => 'Adéquat',
                '3' => 'Totalement adéquat',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'La conception, la taille et la forme de l’aire protégée sont-elles adéquates pour protéger les espèces, les habitats et les autres valeurs et maintenir les processus naturels [p. ex. les habitats des zones humides] ?',
            'La conception et la configuration spatiale [taille et forme] conditionnent la gestion des écosystèmes, de la biodiversité et des autres valeurs d’une aire protégée. Le processus de conception des aires protégées pour protéger les valeurs est complexe. Généralement les aires protégées n’ont pas une conception et une disposition optimales pour représenter et maintenir les écosystèmes, la biodiversité et les autres valeurs qui doivent être protégés. La configuration spatiale actuelle de l’aire protégée devrait être évaluée en fonction de l’objectif de conservation de ses valeurs clés. L’analyse doit montrer si la conception et la configuration spatiale sont adéquats pour protéger pleinement les écosystèmes représentatifs, la biodiversité et les autres valeurs et si un aménagement d’amélioration spatiale (taille et forme) devrait être proposé, si possible'
        ],
        'module_info_Rating' => [
            'Évaluer si la conception et la configuration [taille et forme] de l’aire protégée sont adéquates pour assurer que les valeurs clés sont protégées et peuvent être bien gérées (sur la base de l’analyse du contexte d’intervention, point CTX 2)'
        ]
    ],

    'BoundaryLevel' => [
        'title' => 'Démarcation de l’aire protégée',
        'fields' => [
            'Boundaries' => 'Adéquation de la démarcation',
            'BoundariesComments' => 'Commentaires/Explication',
            'Adequacy' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Evaluation: B) Adéquation de la typologie de la démarcation',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Correspondance des limites marquées en ce qui concerne le statut juridique',
            'Adéquation des limites marquées',
            'Limites marquées par des éléments naturels (p. ex., rivières)',
            'Limites clairement délimitées, non ambiguës et donc faciles à interpréter (p. ex. panneaux, poteaux, balises, clôtures, bouées, etc.)',
            'Reconnaissance des limites par les autorités',
            'Reconnaissance des limites par les communautés/utilisateurs',
            'Approche de collaboration incluant les agences nationales et les parties prenantes concernées dans la démarcation des frontières',
            'Publication d’informations sur la démarcation des limites de l’aire protégée',
            'Définition et démarcation des frontières conformes aux statuts juridiques et au droit international, si nécessaire',
            'Délimitation de l’aire protégée à l’aide de la source officielle de données géographiques de référence',
            'Limites de l’aire protégée enregistrées avec coordonnées géographiques (degré, min, sec)',
            'Délimitation des zones d’utilisation des aires protégées (zonage)',
            'Démarcation des frontières, ou d’une partie d’entre elles, qui sont variables (par exemple, les berges, les rivières, etc.) et que doivent être révisées',
            'Démarcation par des éléments naturels à l’aide d’une déclaration claire (par exemple, données sur les inondations dues aux marées ou aux rivières — moyenne d’eaux basses, moyenne d’eaux hautes, etc.)'
        ],
        'ratingLegend' => [
            'Boundaries' => [
                '0' => 'si 0–15 %',
                '1' => 'si 16–30 %',
                '2' => 'si 31–45 %',
                '3' => 'si 46–60 %',
                '4' => 'si 61–75 %',
                '5' => 'si 76–90 %',
                '6' => 'si 91–100 %'
            ],
            'EvaluationScore' => [
                'N/A' =>   'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' => 'Inadéquat',
                '1' => 'Plutôt inadéquat',
                '2' => 'Adéquat',
                '3' => 'Totalement adéquat'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Les limites de l’aire protégée sont-elles bien marquées et reconnues d’une manière adéquate?',
            'La démarcation ou délimitation physique d’une aire protégée est souvent une obligation légale. La démarcation doit indiquer la limite de l’aire protégée établie par la loi. La délimitation physique des aires protégées sert l’objectif juridique, car elle permet de définir où le cadre juridique [par exemple les sanctions] relatif à l’aire protégée s’applique et doit être appliqué. Il convient toutefois de noter que, si elle est utile, la démarcation à elle seule ne constitue pas une mesure suffisante pour assurer la protection. La connaissance et l’acceptation des limites de l’aire protégée par les parties prenantes sont cependant une nécessité pour une conservation efficace.'
        ],
        'module_info_Rating' => [
            'Évaluer: A) la mesure dans laquelle les limites de l’aire protégée sont marquées et B) l’adéquation de la démarcation des limites pour la gestion de l’aire protégée'
        ]
    ],

    'ManagementPlan' => [
        'title' => 'Plan de gestion',
        'fields' => [
            'PlanExistence' => 'A) Existe-t-il un plan de gestion ?',
            'PlanUptoDate' => 'Le plan de gestion est-il à jour (couvrant la période en cours) ?',
            'PlanApproved' => 'Le plan de gestion a-t-il été approuvé ?',
            'PlanImplemented' => 'Le plan de gestion est-il mis en œuvre ?',
            'VisionAdequacy' => 'B) Adéquation de la vision, de la mission et des objectifs du plan de gestion avec les besoins de la conservation',
            'PlanAdequacyScore' => 'C) Adéquation concernant la clarté et l’applicabilité de la vision, de la mission et des objectifs',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'PlanAdequacyScore' => [
                '0' => 'La vision, la mission et les objectifs du plan de gestion sont absolument inadéquats',
                '1' => 'La vision, la mission et les objectifs du plan de gestion sont inadéquats',
                '2' => 'La vision, la mission et les objectifs du plan de gestion sont adéquats',
                '3' => 'La vision, la mission et les objectifs du plan de gestion sont absolument adéquats'
            ],
            'VisionAdequacy' => [
                '0' => 'Le plan de gestion présente une vision, une mission et des objectifs pas de tout clairs et applicables (0-30% des besoins)',
                '1' => 'Le plan de gestion présente une vision, une mission et des objectifs insuffisamment clairs et applicables (31-60% des besoins)',
                '2' => 'Le plan de gestion présente une vision, une mission et des objectifs suffisamment clairs et applicables (61-90% des besoins)',
                '3' => 'Le plan de gestion présente une vision, une mission et des objectifs parfaitement clairs et applicables (91-100% des besoins)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Existe-t-il un plan de gestion ; est-il adéquat et pratique à mettre en œuvre pour l’aire protégée ?',
            'Le plan de gestion est un document qui définit l’approche et les objectifs de gestion, ainsi qu’un cadre décisionnel, qui s’appliquent à une aire protégée spécifique sur une période donnée. La réussite du plan dépend essentiellement de la consultation la plus large possible des parties prenantes et de l’élaboration d’objectifs pouvant être acceptés et respectés par tous ceux qui ont un intérêt dans l’utilisation et la survie de l’aire protégée (Extrait des Lignes directrices de l’UICN pour la planification de la gestion des aires protégées, 2008)'
        ],
        'module_info_Rating' => [
            'Évaluer: A) l’état du plan de gestion, B) l’adéquation de la vision, de la mission et des objectifs énoncés dans le plan par rapport aux besoins de la conservation et C) l’adéquation concernant la clarté et l’applicabilité de la vision, de la mission et des objectifs'
        ]
    ],

    'WorkPlan' => [
        'title' => 'Plan de travail/d’action (terrestre) ou plan de suivi (MPA)',
        'fields' => [
            'PlanExistence' => 'A) Existe-t-il un plan de travail/d’action ou plan de suivi ?',
            'PlanUptoDate' => 'Le plan de travail/d’action ou plan de suivi est-il à jour (couvrant la période en cours) ?',
            'PlanApproved' => 'Le plan de travail/d’action ou plan de suivi a-t-il été approuvé ?',
            'PlanImplemented' => 'Le plan de travail/d’action ou plan de suivi est-il mis en œuvre ?',
            'VisionAdequacy' => 'B) Adéquation des activités et des résultats du plan de travail/d’action ou plan de suivi par rapport aux objectifs du plan de gestion',
            'PlanAdequacyScore' => 'C) Adéquation concernant la clarté et l’applicabilité des activités et des résultats attendus du plan de travail/d’action ou plan de suivi',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'PlanAdequacyScore' => [
                '0' => 'Les activités et des résultats du plan de travail/d’action ou plan de suivi sont totalement inadéquats par rapport aux objectifs du plan de gestion (0-30% des besoins)',
                '1' => 'Les activités et des résultats du plan de travail/d’action ou plan de suivi sont inadéquats par rapport aux objectifs du plan de gestion (31-60% des besoins)',
                '2' => 'Les activités et des résultats du plan de travail/d’action ou plan de suivi sont adéquats par rapport aux objectifs du plan de gestion (61-90% des besoins)',
                '3' => 'Les activités et des résultats du plan de travail/d’action ou plan de suivi sont totalement adéquats par rapport aux objectifs du plan de gestion (91-100% des besoins)',
            ],
            'VisionAdequacy' => [
                '0' => 'Le plan de travail/d’action ou plan de suivi ne présente pas des activités et des résultats attendus pas de tout clairs et applicables (0-30% des besoins)',
                '1' => 'Le plan de travail/d’action ou plan de suivi ne présente pas des activités et des résultats attendus insuffisamment clairs et applicables',
                '2' => 'Le plan de travail/d’action ou plan de suivi présente des activités et des résultats attendus suffisamment clairs et applicables',
                '3' => 'Le plan de travail/d’action ou plan de suivi présente des activités et des résultats attendus parfaitement clairs et applicables'
            ]
        ],
        'module_info_Rating' => 'Évaluer : A) l’état du plan de travail/d’action ou plan de suivi, B) l’adéquation des activités et des résultats du plan de travail/d’action ou plan de suivi par rapport aux objectifs du plan de gestion et C) l’adéquation concernant la clarté et l’applicabilité des activités et des résultats attendus du plan de travail/d’action ou plan de suivi',
        'module_info_EvaluationQuestion' => [
            'Existe-t-il un plan de travail/d’action ou plan de suivi annuel ; est-il adéquat et pratique à mettre en œuvre pour l’aire protégée ?',
            'Un plan de travail/plan d’action est un plan détaillé décrivant les actions ou activités concrètes qui doivent être menées (et par qui, ou/et quand) afin d’atteindre les résultats établis dans le plan de gestion de l’aire protégée. Un plan de travail ou d’action permet de suivre les progrès accomplis dans l’atteinte des résultats de l’aire protégée. Le plan de travail/plan d’action couvre généralement une période fixe (par exemple l’année civile) et crée un lien au sein de l’équipe, car chaque membre est conscient de son rôle individuel, et fournit les efforts et les informations nécessaires pour assurer le succès dans la conservation de l’aire protégée'
        ]
    ],

    'Objectives' => [
        'title' => 'Objectifs du plan de gestion de l’aire protégée ',
        'fields' => [
            'Objective' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Evaluation: Adéquation des objectifs du plan de gestion ',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'État et protection de la biodiversité en tant de valeur mondiale',
            'Espèces animales — phare, en voie de disparition, endémique,... -',
            'Espèces de plantes — phare, en voie de disparition, endémique,... -',
            'Atténuation des menaces pour l’aire protégée',
            'Services écosystémiques — Approvisionnement (nourriture, produits de la mer, matériel, qualité de l\'eau, etc. utilisation durable)',
            'Services écosystémiques - Régulation (protection contre les tempêtes et le littoral, érosion hydrique, etc. utilisation durable)',
            'Services écosystémiques — Culturels (tourisme, pêche traditionnelle, etc. utilisation durable)',
            'Services écosystémiques — Support / Soutien (frayères marines - habitats de nourricerie, etc.)',
            'Adaptation au changement climatique',
            'Gouvernance',
            'Soutien à l’économie locale',
            'Soutien aux aspects sociaux',
            'Tourisme et fréquentation humaine',
            'Systèmes de gestion — personnel, finances, achats',
            'Infrastructure et équipement'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' =>   'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' => 'Inadéquat (0-30% des besoins)',
                '1' => 'Plutôt inadéquat (31-60% des besoins)',
                '2' => 'Adéquat (61-90% des besoins)',
                '3' => 'Totalement adéquat (91-100% des besoins)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Les objectifs fixés dans le plan de gestion pour l’aire protégée sont-ils adéquats?',
            'La gestion des aires protégées se fait de plus en plus selon l’approche de la « gestion par objectifs ». La gestion par objectifs exige une approche proactive, c’est-à-dire qu’elle est conçue pour atteindre un ensemble précis d’objectifs ou des états souhaités de conservation, plutôt que réactive, c’est-à-dire qu’elle répond simplement aux problèmes qui se posent. Les objectifs et l’état souhaité, qui doivent être atteints par les mesures de conservation de l’aire protégée, doivent être clairement compris. Ils doivent être bien définis et formulés de manière à faciliter le suivi, mais ils doivent également se rapporter aux valeurs clés de l’aire protégée (p.ex. espèces ou écosystèmes importants) ou aux principales zones d’activité de gestion (p. ex. tourisme, éducation). Dans cet outil, nous faisons une distinction importante entre les résultats et les effets/impacts :<ul><li>Les effets/impacts se rapportent aux aux changements liés aux OBJECTIFS/ÉTATS SOUHAITES à long terme ou à la vision exprimés dans le plan de gestion et caractérisant une situation visée ou souhaitée, à la fin de la période considérée. Ces objectifs sont généralement des énoncés spécifiques concernant les valeurs clés de l’aire protégée (p. ex. les espèces ou les services écosystémiques importants) ou les principaux domaines d’activités de gestion (p. ex. tourisme, éducation).<li>Les résultats/extrants se rapportent à la réalisation d’ACTIVITES à court terme (ou à relativement court terme), généralement mesurés de manière quantitative, et qui contribuent avec d’autres réalisations à atteindre les objectifs/états souhaités à long terme.'
        ],
        'module_info_Rating' => [
            'Évaluer l’adéquation de la formulation des objectifs du plan de gestion pour les éléments clés de l’aire protégée (sur la base de l’analyse du contexte d’intervention, points CTX1.5; CTX 4, 5, 6, 7 et contexte de gestion, points de C 1.1 à C 1.5)'
        ]
    ],

    'ObjectivesPlanification' => [
        'module_info' => 'Établir et décrire les objectifs de conservation pour la planification de la zone protégée. Les objectifs et les cibles indiqués ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases de processus et pour le suivi des activités de gestion de l’aire protégée'
    ],

    'InformationAvailability' => [
        'title' => 'Informations de base',
        'fields' => [
            'Element' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Evaluation: Disponibilité',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Espèces animales (phares, en voie de disparition, endémiques,....)',
            'group1' => 'Espèces de plantes (phares, en voie de disparition, endémiques,....) ',
            'group2' => 'Habitats et les dimensions connexes de couverture terrestre, utilisation et occupation du sol à l’intérieur et à l’extérieur de l’aire protégée',
            'group3' => 'Menaces qui pèsent sur l’aire protégée',
            'group4' => 'Effets du changement climatique sur les éléments clés de l’aire protégée',
            'group5' => 'Services écosystémiques fournis par l’aire protégée'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Aucune ou pratiquement pas d’information disponible en support de la gestion (0-30 % des besoins)',
                '1' => 'Peu d’informations disponibles et insuffisantes en support de la gestion (31-60 % des besoins)',
                '2' => 'Information disponible mais modérément suffisante en support de la gestion (61-90 % des besoins)',
                '3' => 'Information disponible et suffisante en support de la gestion (91-100 % des besoins)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Disposez-vous d’informations suffisantes et ciblées pour vous aider à prendre des décisions concernant la gestion de l’aire protégée ?',
            'Une gestion efficace des aires protégées nécessite suffisamment de connaissances et d’informations pour éclairer la prise de décision. La gestion d’une aire protégée a besoin d’une analyse solide pour résumer et structurer l’information pertinente en vue de trouver des solutions à des problèmes concrets de gestion. La qualité des données et de l’information est une condition préalable à une bonne analyse, et sans informations, il ne peut y avoir de bonne gestion.'
        ],
        'module_info_Rating' => [
            'Evaluer la disponibilité de l’information en appui à la gestion de l’aire protégée pour les éléments les plus importants (sur la base de l’analyse du contexte d’intervention, points CTX 4 ; 5 ; 6 ; 7)'
        ]
    ],

    'Staff' => [
        'title' => 'Personnel',
        'fields' => [
            'Theme' => 'Critère — Concept mesuré — Variable',
            'StaffNumberAdequacy' => 'A) Adéquation du nombre d’employés',
            'StaffCapacityAdequacy' => 'B) Adéquation des capacités du personnel',
            'Comments' => 'Commentaires/Explication',
        ],
        'StaffNumberAdequacy' => 'Notation de l’adéquation du nombre d’employés',
        'ratingLegend' => [
            'StaffNumberAdequacy' => [
                '0' => 'Presque pas de personnel (entre 0 et 20 % du nombre requis)',
                '1' =>  'Pas assez de personnel pour les activités de gestion essentielles (entre 21 et 40 % du nombre requis)',
                '2' =>  'Pas assez de personnel pour mener à bien de nombreuses activités de gestion (entre 41 et 60 % du nombre requis)',
                '3' =>  'Suffisamment de personnel pour mener à bien la plupart, mais pas toutes les activités (entre 61 et 80 % du nombre requis)',
                '4' =>  'Nombre approprié d’employés pour mener à bien toutes les activités (entre 81 et 100 % du nombre requis)'
            ],
            'StaffCapacityAdequacy' => [
                '0' => 'Aucune capacité de personnel (0-30 % des besoins)',
                '1' => 'Capacités insuffisantes du personnel (31-60 % des besoins)',
                '2' => 'Capacités adéquates du personnel, mais de nouvelles compétences sont nécessaires (61-90 % des besoins)',
                '3' => 'Capacités parfaitement adéquates et mises à jour du personnel (91-100 % des besoins)'

            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Y a-t-il suffisamment de personnel pour répondre aux exigences de gestion de l’aire protégée ?',
            'Un personnel qualifié, compétent, engagé et adéquat (en nombre) est essentiel au succès des aires protégées. Les besoins en personnel sont clairement liés à la taille et à la typologie de l’aire protégée, à la densité de la végétation et aux pressions et menaces (p. ex. la densité humaine) d’une aire protégée. Par exemple pour leur protection, les aires protégées plus petites et plus boisées ont tendance à nécessiter relativement plus de personnel  par rapport aux aires protégées de savane plus grandes et plus ouvertes, ce qui implique des coûts de personnel plus élevés. L’évaluation se fonde sur les informations contenues dans le plan de gestion ou dans l’organigramme officiel du personnel',
        ],
        'module_info_Rating' => [
            'Évaluer: A) l’adéquation du nombre d’employés (résultats calculés automatiquement sur la base de l’analyse du contexte d’intervention, point CTX 3.1.1),  B) l’adéquation des capacités du personnel'
        ]
    ],

    'BudgetAdequacy' => [
        'title' => 'Budget actuel',
        'fields' => [
            'EvaluationScore' => 'Adéquation du budget actuel',
            'Percentage' => '%',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Pas de budget (0 % des besoins)',
                '1' => 'Inadéquat même pour les activités de gestion essentielles (entre 1 et 25 % des besoins)',
                '2' => 'Inadéquat pour de nombreuses activités de gestion (26 à 50 % des besoins)',
                '3' => 'Adéquat pour les activités de gestion essentielles (entre 51 et 70 % des besoins)',
                '4' => 'Adéquat pour de nombreuses activités mais pas toutes (entre 71 % et 90 % des besoins)',
                '5' => 'Adéquat pour toutes les activités (91 % ou plus des besoins)'

            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Le budget actuel est-il suffisant pour une gestion appropriée de l’aire protégée ?',
            'Les aires protégées préparent leur budget de fonctionnement chaque an ou ou pour une période de plusieurs ans. Les principaux documents de planification financière et budgétaire sont nécessaires pour améliorer l’efficience et l’efficacité opérationnelles. L’amélioration est obtenue grâce à l’utilisation de mesures du rendement et à l’analyse des processus'
        ],
        'module_info_Rating' => [
            'Evaluer l’adéquation du financement de l’année en cours de l’aire protégée par rapport aux exigences de conservation (sur la base de l’analyse du contexte d’intervention, point CTX 3.2)'
        ]
    ],

    'BudgetSecurization' => [
        'title' => 'Sécurisation du financement futur',
        'fields' => [
            'Percentage' => 'A) Évaluer en pourcentage la sécurité du financement futur',
            'EvaluationScore' => 'B) Évaluer en ans la période de sécurité du financement futur',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'Percentage' => [
                '0' => 'Les besoins financiers de base pour la gestion de l’aire protégée ne sont pas assurés (0-20 % des besoins assurés)',
                '1' => 'Les besoins financiers de base pour la gestion de l’aire protégée sont très faiblement couverts (21-40 % des besoins assurés)',
                '2' => 'Les besoins financiers de base pour la gestion de l’aire protégée sont faiblement couverts (41-60 % des besoins assurés)',
                '3' => 'Les besoins financiers de base pour la gestion de l’aire protégée sont partiellement couverts (61-75 % des besoins assurés)',
                '4' => 'Les besoins financiers de base pour la gestion de l’aire protégée sont relativement bien couverts (76 à 90 % des besoins assurés)',
                '5' => 'Les besoins financiers de base pour la gestion de l’aire protégée sont satisfaits (> 90 % des besoins assurés)',
            ],
            'EvaluationScore' =>[
                '0' => 'Les besoins financiers de base pour la gestion de l’aire protégée ne sont assurés que pour 1 an (année en cours)',
                '1' => 'Les besoins financiers de base pour la gestion de l’aire protégée sont assurés pour 2 ans (année en cours + 1 an)',
                '2' => 'Les besoins financiers de base pour la gestion de l’aire protégée sont assurés pour 3 ans (année en cours + 2 ans)',
                '3' => 'Les besoins financiers de base pour la gestion des aires protégées sont assurés pour 4 or plus d’années (année en cours +3 ans et plus)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Quelle part du budget requis est assurée, et pour combien de temps, pour couvrir les besoins de base de la gestion des aires protégées ?',
            'Un budget sûr et fiable est essentiel pour la planification et la gestion des aires protégées, en particulier pour les activités à grande échelle et à long terme. Une évaluation réaliste des besoins devrait être faite pour s’assurer que tous les coûts associés au plan de travail ou de gestion peuvent être entièrement couverts, en gardant à l’esprit que certains objectifs exigeront plusieurs années pour être atteints. Lorsque les ressources ne sont pas disponibles, le gestionnaire doit décider comment prioriser les activités en termes de calendrier et d’investissement'
        ],
        'module_info_Rating' => [
            'Evaluer: A) la sécurité du financement et B) la période de sécurité du financement pour les années à venir par rapport aux exigences de conservation dans l’aire protégée'
        ]
    ],

    'ManagementEquipmentAdequacy' => [
        'title' => 'Infrastructures, équipements et installations',
        'fields' => [
            'Equipment' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'A) Adéquation des infrastructures, équipements et installations (CTX 3.3)',
            'Importance' => 'B) Priorité à présent pour la gestion',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'Equipment' => [
                '0' =>      'Inadéquats même pour les activités de gestion essentielles (entre 1 et 25 % des besoins)',
                '1' =>      'Inadéquats pour de nombreuses activités de gestion (26 à 50 % des besoins)',
                '2' =>      'Adéquats pour les activités de gestion essentielles (entre 51 et 70 % des besoins)',
                '3' =>      'Adéquats pour de nombreuses activités, mais pas toutes (entre 71 % et 90 % des besoins)',
                '4' =>      'Adéquats pour toutes les activités (91 % ou plus des besoins)'
            ],
            'Importance' => [
                '0' => 'Normal',
                '1' => 'Haute',
                '2' => 'Très élevée',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Les infrastructures, les équipements et les installations de l’aire protégée sont-ils adéquats pour les besoins de la gestion ?',
            'Les infrastructures, les équipements et les installations sont importants pour assurer et améliorer l’efficacité et l’efficience opérationnelles de l’aire protégée. L’analyse de l’infrastructure, de l’équipement et des installations d’une aire protégée peut servir de base à la recherche de financement supplémentaire. Les donateurs devraient être encouragés à contribuer à la réalisation et au maintien de niveaux appropriés d’infrastructures, d’équipements et d’installations pour la gestion des aires protégées'
        ],
        'module_info_Rating' => [
            'Évaluer: A) l’adéquation des infrastructures, équipements et installations (résultats calculés automatiquement sur la base de l’analyse du contexte d’intervention, point CTX 3.3),  B) la priorité de la disponibilité à présent des particuliers infrastructures, équipements et installations pour assurer la gestion de l’aire protégée'
        ]
    ],

    'ObjectivesIntrants' => [
        'module_info' => 'Établir et décrire les objectifs de conservation pour les intrants (ressources humaines, financières et infrastructures, équipements et installations) de l’aire protégée. Les objectifs et les cibles indiqués ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases de processus et pour le suivi des activités de gestion de l’aire protégée'
    ],

    'StaffCompetence' => [
        'title' => 'Renforcement des capacités du personnel',
        'fields' => [
            'Theme' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'A) Adéquation de l’analyse des capacités du personnel aux programmes de renforcement des capacités',
            'PercentageLevel' => 'B) Adéquation des activités de renforcement des capacités du personnel',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Inadéquat',
                '1' => 'Plutôt inadéquat',
                '2' => 'Adéquat',
                '3' => 'Totalement adéquat'
            ],
            'PercentageLevel' => [
                '0' => 'Activités de renforcement des capacités du personnel inadéquates',
                '1' => 'Activités de renforcement des capacités du personnel plutôt adéquates',
                '2' => 'Activités de renforcement des capacités du personnel adéquates, mais des améliorations s’imposent',
                '3' => 'Activités de renforcement des capacités du personnel totalement adéquat (suffisantes et mise à jour)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '<b>L’aire protégée organise et met-elle en œuvre un programme adéquat de renforcement des capacités qui répond aux besoins du personnel pour atteindre les objectifs de gestion ?</b>',
            'Un personnel qualifié, compétent et engagé est essentiel au succès des aires protégées. La formation du personnel est de plus en plus reconnue comme une composante essentielle d’une gestion efficace des aires protégées. L’objectif principal de la formation du personnel est d’accroître la capacité du personnel des aires protégées à s’adapter aux nouveaux défis, en utilisant des approches novatrices, si nécessaire. L’analyse présentée ici tient compte de l’adéquation (A) de la conception du programme de formation (y compris l’analyse, la conception et les ressources) et (B) des activités de renforcement des capacités (y compris la prestation de la formation) par rapport aux capacités et aux besoins du personnel en matière de gestion de l’aire protégée'
        ],
        'module_info_Rating' => [
            'Evaluer l’adéquation de: (A) la conception de programmes de formation et (B) les activités de renforcement des capacités du personnel pour les différentes catégories de personnel/fonctions (par exemple, les gestionnaires, les gardes forestiers, etc.)'
        ]
    ],

    'HRmanagementPolitics' => [
        'title' => 'Politiques et procédures de gestion des ressources humaines',
        'fields' => [
            'Conditions' => 'Critère - Concept mesuré - Variable',
            'EvaluationScore' => 'Adéquation des politiques et procédures de gestion des ressources humaines',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Rémunération et avantages sociaux',
            'Procédures de recrutement fondées sur le mérite',
            'Attribution du type de travail',
            'Affectation au milieu de travail',
            'Santé, sécurité et sécurisation dans le travail',
            'Possibilités de carrière et de promotion',
            'Genre et équité ethnique',
            'Règles réduisant le favoritisme et la discrimination',
            'Formation et perfectionnement',
            'Gestion des relations avec les employés',
            'Systèmes d’information sur les ressources humaines'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' => 'Inadéquat (0-30% des besoins)',
                '1' => 'Plutôt inadéquat (31-60% des besoins)',
                '2' => 'Adéquat (61-90% des besoins)',
                '3' => 'Ttotalement adéquat (91-100% des besoins)'
            ]
        ],
        'module_info_EvaluationQuestion' =>[
            '<b>L’aire protégée a-t-elle adopté des politiques, procédures et lignes directrices adéquates en matière de gestion des ressources humaines pour le recrutement, la promotion, la rémunération, le rendement, l’évaluation et la formation du personnel, leurs fonctions et leur code de conduite ?</b>',
            'Les politiques de ressources humaines décrivent l’approche et les mesures à adopter dans la gestion du personnel. Ces politiques fournissent également des lignes directrices pour la gestion des ressources humaines sur diverses questions concernant différents aspects tels que le recrutement, la promotion, la rémunération, le rendement, l’évaluation et la formation, mais aussi les fonctions du personnel et leur code de conduite, les procédures disciplinaires, etc. L’établissement de politiques, de procédures et de lignes directrices claires peut aider à démontrer, tant à l’interne qu’à l’externe, que l’aire protégée répond aux exigences en matière de bonne gouvernance, d’équité, de diversité, d’éthique et de formation ainsi qu’à ses engagements à respecter les exigences réglementaires et à bien gérer les ressources humaines des employés des aires protégées'
        ],
        'module_info_Rating' => [
            'Évaluer la pertinence des dispositions des politiques, procédures et lignes directrices en matière de gestion des ressources humaines pour l’aire protégée'
        ]
    ],

    'HRmanagementSystems' => [
        'title' => 'Conditions de travail et motivation du personnel',
        'fields' => [
            'Conditions' => 'Critère - Concept mesuré - Variable',
            'EvaluationScore' => 'Adéquation de la motivation du personnel',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Objectifs clairs et spécifiques pour les tâches à accomplir',
            'Loyauté et intégrité des gestionnaires et des dirigeants',
            'Retour d’information et encadrement par les gestionnaires et les leaders',
            'Stimulation et motivation pour la réalisation des activités',
            'Retour d’information sur les activités réalisées par le personnel',
            'Autonomie pour accomplir les tâches de façon adéquate',
            'Implication du personnel dans les décisions concernant leur travail et leur emploi',
            'Rémunération appropriée (salaires, primes et sécurité sociale)',
            'Conditions de travail appropriées (équipement de travail, tenue, etc.)',
            'Motivation à la suite de l’attitude des autorités politiques, administratives et militaires envers l’aire protégée',
            'Motivation à la suite de l’attitude des autorités judiciaires envers l’aire protégée',
            'Motivation à la suite de l’attitude des communautés locales envers l’aire protégée'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' => 'Inadéquat (0-30% des besoins)',
                '1' => 'Plutôt inadéquat (31-60% des besoins)',
                '2' => 'Adéquat (61-90% des besoins)',
                '3' => 'Totalement adéquat (91-100% des besoins)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'La gestion de l’aire protégée adopte-t-elle des mesures/approches/outils adéquats pour assurer la motivation du personnel ?',
            'Pour une aire protégée, la motivation du personnel est essentielle à la réussite de la conservation. Les conditions de travail et la motivation influencent fortement la capacité du personnel à effectuer son travail. Les gestionnaires et les dirigeants doivent comprendre qu’ils doivent fournir un environnement de travail qui crée et maintient la motivation du personnel pour obtenir des résultats en matière de conservation',
        ],
        'module_info_Rating' => [
            'Évaluer l’adéquation des mesures/approches/outils de motivation du personnel dans l’aire protégée',
        ]
    ],

    'GovernanceLeadership' => [
        'title' => 'Orientation de la gestion de l’aire protégée',
        'fields' => [
            'EvaluationScoreGovernace' => 'A) Adéquation de l’orientation de la gestion par la communication sur la vision, la mission et les valeurs de l’aire protégée influençant la performance du personnel',
            'EvaluationScoreLeadership' => 'B) Adéquation de l’orientation de la gestion par l’adoption de l’approche axée sur les résultats',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'EvaluationScoreGovernace' => [
                '0' => 'Il n’y a pas ou très peu de communication et retour d’information sur la vision, la mission et les valeurs de l’aire protégée pour influencer la performance et le soutien du personnel (entre 0 et 25 % des besoins)',
                '1' => 'Il n’y a pas de communication et retour d’information suffisamment claire sur la vision, la mission et les valeurs de l’aire protégée pour influencer la performance et le soutien du personnel (entre 26 et 50 % des besoins)',
                '2' => 'Il y a une communication claire et un retour d’information, mais incomplètes sur la vision, la mission et les valeurs de l’aire protégée pour influencer la performance et le soutien du personnel (entre 51 et 75 % des besoins)',
                '3' => 'Il y a une communication et un retour d’information complète sur la vision, la mission et les valeurs de l’aire protégée afin d’influencer la performance et le soutien du personnel (entre 76 et 100 % des besoins)'
            ],
            'EvaluationScoreLeadership' => [
                '0' => 'La gestion n’est pas axée sur les résultats dans l’atteinte de la vision et  de la mission et la conservation des valeurs de l’aire protégée',
                '1' => 'La gestion est faiblement orientée vers les résultats dans l’atteinte de la vision et de la mission et la conservation des valeurs de l’aire protégée',
                '2' => 'La gestion est généralement axée sur les résultats dans l’atteinte de la vision et de la mission et la conservation des valeurs de l’aire protégée',
                '3' => 'La gestion est fortement axée sur les résultats dans l’atteinte de la vision et de la mission et la conservation des valeurs de l’aire protégée'
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'La gestion de l’aire protégée donne-t-elle une orientation et des directives adéquates pour entreprendre les tâches liées à la conservation et les exécuter ?',
            'La gestion de l’aire protégée devrait donner une orientation et des directives adéquates pour toutes les activités liées aux opérations de bureau et sur le terrain, à l’utilisation des ressources, à l’administration, à l’application de la loi, à la surveillance, etc. L’évaluation des directives de gestion devrait permettre de déterminer si elles sont toujours pertinentes, efficaces et actuelles ou si des changements sont nécessaires. Parfois, des ajustements peuvent s’avérer nécessaires pour s’assurer que la direction de l’aire protégée fournit une orientation adéquate pour la mise en œuvre des résultats et des effets/ impacts souhaités'
        ],
        'module_info_Rating' => 'Evaluer l’adéquation de: (A) la communication de la direction sur la mission et les valeurs de l’aire protégée et (B) l’approche axée sur les résultats de la direction'
    ],

    'AdministrativeManagement' => [
        'title' => 'Gestion budgétaire et financière',
        'fields' => [
            'Aspect' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Application des éléments de base de la gestion budgétaire et financière',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Cohérence: vos politiques de gestion et les systèmes financiers restent cohérents',
            'Responsabilité: vous êtes en mesure d’expliquer et de démontrer à tous les fonctionnaires/intervenants comment vous avez utilisé vos ressources et ce que vous avez accompli',
            'Transparence: votre organisation est transparente en ce qui concerne son travail et ses finances, en mettant les informations à la disposition de tous les fonctionnaires/intervenants',
            'Intégrité: les membres de votre organisation font preuve d’honnêteté et de bienséance.',
            'Gérance financière: votre organisation prend soin des ressources financières qui lui sont allouées et s’assure qu’elles sont utilisées aux fins prévues',
            'Normes comptables: le système de tenue des registres et de la documentation financière de votre organisation respecte les normes comptables externes reconnues'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' =>    'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' =>      'Jamais',
                '1' =>      'Rarement',
                '2' =>      'Parfois',
                '3' =>      'Souvent',
                '4' =>      'Toujours'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Le budget et les ressources financières sont-ils bien gérés pour répondre aux exigences et priorités essentielles de gestion de l’aire protégée?',
            'La gestion budgétaire et financière d’une aire protégée doit être solide pour assurer  l’allocation adéquate des fonds, la prévision dynamique et détaillée des coûts, et la planification stratégique. La gestion budgétaire et financière ne se limitent pas à la tenue de registres comptables. C’est un élément essentiel de la planification, de l’organisation, du contrôle et du suivi des ressources financières afin d’atteindre les objectifs de conservation de l’aire protégée. Une gestion budgétaire et financière efficace n’est possible que si l’on dispose d’une bonne gestion et d’un bon plan de travail avec des politiques, des stratégies et des objectifs fixés clairs.'
        ],
        'module_info_Rating' => [
            'Évaluer l’application des éléments de base qui doivent être en place pour obtenir de bonnes pratiques en matière de gestion budgétaire et financière '
        ]
    ],

    'EquipmentMaintenance' => [
        'title' => 'Entretien des infrastructures, équipements et installations',
        'fields' => [
            'Equipment' => 'Critère - Concept mesuré - Variable',
            'EvaluationScore' => 'Adéquation de l’entretien',
            'AdequacyLevel' => 'Valeurs transférées de CTX 3.3',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' => 'Inadéquat (0-30% des besoins)',
                '1' => 'Plutôt inadéquat (31-60% des besoins)',
                '2' => 'Adéquat (61-90% des besoins)',
                '3' => 'Totalement adéquat (91-100% des besoins)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Les infrastructures, les équipements et les installations de l’aire protégée sont-ils bien entretenus ?',
            'L’entretien préventif est le terme utilisé pour désigner l’entretien régulier et récurrent des infrastructures, équipements et installations afin de les maintenir en bon état et efficaces et de contribuer à prolonger leur durée de vie. Des infrastructures, équipements et des installations mal entretenus non seulement s’usent plus rapidement, mais gaspillent également des ressources et dégradent fondamentalement la capacité de l’aire protégée à atteindre ses objectifs de conservation. L’aire protégée devrait s’efforcer de prévenir ces deux conditions grâce à un programme d’entretien adéquat'
        ],
        'module_info_Rating' => [
            'Évaluer le niveau d’entretien des infrastructures, équipements et installations par rapport aux exigences de gestion de l’aire protégée (sur la base de l’analyse du contexte d’intervention, point CTX 3.3)'
        ]
    ],

    'ManagementActivities' => [
        'title' => 'Gestion des valeurs clés et des menaces de l’aire protégée par des actions spécifiques',
        'fields' => [
            'Activity' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Adéquation des mesures de gestion',
            'InManagementPlan' => 'Inclus dans le plan de gestion',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Espèces animales (phares, en voie de disparition, endémiques,....)',
            'group1' => 'Espèces de plantes (phares, en voie de disparition, endémiques,....)',
            'group2' => 'Habitats les plus importants et les dimensions connexes de l’aire protégée',
            'group3' => 'Gestion visant à atténuer les menaces qui pèsent sur l’aire protégée',
            'group4' => 'Services Ecosystémiques',
            'group5' => 'Autre'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' => 'Inadéquat (0-30% des besoins)',
                '1' => 'Plutôt inadéquat (31-60% des besoins)',
                '2' => 'Adéquat (61-90% des besoins)',
                '3' => 'Totalement adéquat (91-100% des besoins)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Existe-t-il des mesures de gestion spécifiques pour les valeurs clés et les menaces qui pèsent sur l’aire protégée ?',
            'Le principal objectif de gestion des aires protégées est la conservation/restauration des valeurs naturelles et culturelles associées. Pour préserver ces valeurs et minimiser les menaces les plus importantes, les gestionnaires devraient utiliser les lignes directrices, les mesures et les meilleures pratiques de gestion disponibles. Les actions peuvent inclure la conservation/restauration d’espèces animales et végétales, l\'habitat et la gestion de diverses menaces (note : pour les actions d’adaptation au changement climatique et de gestion des services écosystémiques, voir PR 17 et PR 18). Exemples d’actions : gestion des animaux ou des plantes, gestion de l’environnement physique, gestion du feu, travaux de végétalisation, contrôle des espèces envahissantes, gestion des ressources culturelles, réduction des menaces, etc.'
        ],
        'module_info_Rating' => [
            'Énumérez au moins trois valeurs, menaces et autres éléments et évaluez l’adéquation des mesures de gestion connexes (sur la base de l’analyse du contexte d’intervention, points CTX 4 et CTX 5)'
        ]
    ],
    'LawEnforcementImplementation' => [
        'title' => 'Gestion des patrouilles de surveillance (application de la loi)',
        'fields' => [
            'Element' => 'Critère — Concept mesuré — Variable',
            'Adequacy' => 'Evaluation: Adéquation de l’organisation et des activités des patrouilles de surveillance',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Gestion des patrouilles de rangers',
            'group1' => 'Gestion des patrouilles de gardes maritimes',
        ],
        'predefined_values' => [
            'group0' => [
                'Gestion stratégique proactive',
                'Surveillance collaborative (protection obtenue par une combinaison d’application de la loi et de collaboration avec les communautés)',
                'Procédures d’opération normalisées [PON]',
                'Procédures d’exploitation d’emergence',
                'Procédures d’intervention rapide',
                'Non collaborative (technologie : données numériques, surveillance aérienne, etc. Vs technologie peu performante, gardes maritimes qualifiés)',
                'Tactiques adaptables et diverses (p. ex. types de patrouilles complémentaires, comme les points d’observation, les patrouilles assistées par véhicule, les embuscades, etc.)',
                'Stratégies d’application combinant la technologie et les patrouilles en mer (par exemple, surveillance par satellite et patrouilles assistées par des véhicules/bateaux)',
                'Processus décisionnel efficace pour les procédures d’exploitation normalisées et d’urgence',
                'Gestion des unités d’élite (surveillants les plus performants)',
                'Salle de contrôle des opérations',
                'Poste de surveillance / Barrières de contrôle — dans le parc',
                'Poste de surveillance / Barrières de contrôle — en dehors du parc',
                'Patrouilles de plusieurs jours',
                'Utilisation de l’information SMART-RBM pour mener des briefings de patrouille et de débriefing'
            ],
            'group1' => [
                'Stratégies d’application combinant la technologie et les patrouilles en mer (surveillance par satellite et hydrophones, capteurs électroniques, etc.)',
                'Utilisation de capteurs visuels et électroniques de base pour les patrouilles en mer (radar, optique/infrarouge)',
                'Protection assurée par une combinaison de mesures d’application et de collaboration avec les communautés',
                'Utilisation de la surveillance collaborative (couverture en temps réel et sur de grandes zones, faibles investissements par rapport à l’intervalle de temps et aux côtes récurrentes, réglementations et incitations, émetteurs-récepteurs désactivés)',
                'Utilisation d’une surveillance non collaborative (technologie : radar, optique/infrarouge, radio vs technologie peu performante, personnel qualifié)',
                'Intégration entre les systèmes de surveillance collaboratifs et non collaboratifs dans l’aire protégée',
                'Patrouilles de contrôle effectuées la nuit et à d’autres heures aléatoires',
                'Participation régulière à des formations spécialisées (formation de base de l’Organisation maritime internationale — OMI —, lecture et utilisation de cartes marines, recherche et sauvetage, cours d’entretien de base des moteurs hors-bord, etc.)',
                'Mise à jour et distribution permanentes d’une simple fiche d’information décrivant le zonage, les règlements, les restrictions et les amendes ou sanctions',
            ]
        ],
        'ratingLegend' => [
            'Adequacy' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' => 'Inadéquat (0-30% des besoins)',
                '1' => 'Plutôt inadéquat (31-60% des besoins)',
                '2' => 'Adéquat (61-90% des besoins)',
                '3' => 'Totalement adéquat (91-100% des besoins)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Dans quelle mesure la gestion et la mise en œuvre de l’application de la loi par les patrouilles de surveillants sont-elles adéquates et axées sur la protection à long terme de la biodiversité ?',
            'La gestion des patrouilles de surveillants est une activité d’application de la loi essentielle pour faire respecter les règles juridiques existantes qui devraient assurer la protection à long terme de la biodiversité et des autres valeurs de l’aire protégée. Une gestion efficace des aires protégées nécessite l’application de la loi à tous les niveaux: patrouilles de surveillants, renseignements et systèmes de justice pénale efficaces. Cette étape de l’analyse porte sur le processus de gestion des patrouilles de surveillants (un module spécifique à une analyse approfondie de l’application de la loi est disponible)',
        ],
        'module_info_Rating' => [
            'Évaluer l’adéquation des éléments de la gestion des patrouilles de surveillants visant à assurer la protection à long terme de la biodiversité et d’autres valeurs'
        ]
    ],

    'IntelligenceImplementation' => [
        'title' => 'Renseignement, enquêtes, développement de cas et actions en justice (application de la loi)',
        'fields' => [
            'Element' => 'Critère — Concept mesuré — Variable',
            'Adequacy' => 'Adéquation: A) de la gestion des éléments des renseignements et enquêtes; B) du traitement des éléments de preuve, développement de cas et actions en justice',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'A) Gestion du renseignement et des enquêtes - Terrestre',
            'group0b' => 'A) Gestion du renseignement et des enquêtes - Maritime et côtier',
            'group1' => 'B) Traitement des éléments de preuve, développement de cas et actions en justice - Terrestre',
            'group1b' => 'B) Traitement des éléments de preuve, développement de cas et actions en justice - Maritime et côtier',
        ],
        'predefined_values' => [
            'group0' => [
                'Unités de renseignement et d’enquête orientant et soutenant les actions des patrouilles de surveillants',
                'Organisation du système des informateurs',
                'Support informatique au renseignement',
                'Système d’organisation et d’analyse de données de renseignement',
                'Collaboration interinstitutions [p. ex., procureurs au sein du service de la protection de la nature ou unité spécialisée dans la répression des infractions liées aux espèces sauvages]',
                'Collaboration interinstitutions avec les ONG [p. ex., le réseau EAGLE, l’Afrique centrale et occidentale]'
            ],
            'group0b' => [
                'Unités de renseignement et d’investigation orientant et soutenant les opérations de patrouille maritime',
                'Détection et sanction des activités illégales (telles que la pêche et la récolte)',
                'Connaissance des exigences légales en matière d’embarquement',
                'Protocoles d’embarquement : inspections, documents requis, ce qu’il faut vérifier et rechercher, documenter l’inspection',
                'Interroger et confronter les équipages suspects sur des activités illégales',
                'Rapport d’internat standardisé utilisé de manière cohérente et correcte',
                'Niveau de sécurité personnelle pendant l’embarquement',
                'Utilisation d’un modèle d’évaluation des risques (GAR – GREEN-AMBER-RED ou équivalent/autre)',
                'Utilisation d’une base de données pour l’enregistrement et le suivi des informations relatives aux infractions',
                'Collaboration avec des ONG spécialisées dans les lois marines, l’application des lois, etc. (par exemple, l’Environmental Law Institute – ELI – Ocean Program)'
            ],
            'group1' => [
                'Gestion des scènes de crime',
                'Collecte et gestion des preuves',
                'Arrestations ou préparation de rapport de cas',
                'Poursuite des suspects',
                'Surveillance des cas et des délinquants',
                'Jugements obtenus au tribunal'
            ],
            'group1b' => [
                'Ateliers de formation pour les juges, les avocats et les juristes sur les règles et règlements relatifs à la mer et à la pêche',
                'Capacité de saisir et d’immobiliser des navires après une transgression',
                'Possibilité de restreindre la navigation à l’intérieur des limites de l’AMP en délivrant des permis d’autorisation',
                'Saisie d’engins de pêche',
                'Possibilité d’appliquer la suspension temporaire des permis pour les navires, les membres d’équipage ou les propriétaires de navires',
                'Possibilité de retirer les licences d’exploitation des navires, des armateurs, des agents, du personnel maritime ou des pêcheurs',
            ],
        ],
        'ratingLegend' => [
            'Adequacy' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' => 'Inadéquat (0-30% des besoins)',
                '1' => 'Plutôt inadéquat (31-60% des besoins)',
                '2' => 'Adéquat (61-90% des besoins)',
                '3' => 'Totalement adéquat (91-100% des besoins)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Dans quelle mesure la gestion des renseignements, des enquêtes, de l’élaboration des cas et des actions en justice est-elle adéquate pour assurer la protection à long terme de la biodiversité ?',
            'La gestion des renseignements et des enquêtes ainsi que l’élaboration de dossiers et les actions en justice sont des activités essentielles pour faire respecter les lois existantes qui devraient assurer la protection à long terme de la biodiversité et d’autres valeurs dans la zone protégée. Une gestion efficace des aires protégées nécessite l’application de la loi à tous les niveaux: surveillance, renseignements et systèmes de justice pénale efficaces. Cette étape de l’analyse est axée sur: (1) la gestion des renseignements et des enquêtes et (2) le traitement des preuves, l’élaboration des dossiers et l’engagement d’actions en justice. Un processus d’application de la loi bien organisé est fondamental, mais nous devons nous rappeler que rien ne peut remplacer des gardes bien équipés, bien formés et très motivés.'
        ],
        'module_info_Rating' => [
            'Évaluer l’adéquation: A) de la gestion des renseignements et des enquêtes et B) du traitement des éléments de preuve, développement de cas et actions en justice visant à assurer la protection à long terme de la biodiversité et d’autres valeurs'
        ]
    ],

    'StakeholderCooperation' => [
        'title' => 'Coopération avec les parties prenantes',
        'fields' => [
            'Element' => 'Critère — Concept mesuré — Variable',
            'Cooperation' => 'Niveau de coopération',
            'MPInvolvement' => 'P',
            'MPIImplementation' => 'PG',
            'BAInvolvement' => 'B/A',
            'EEInvolvement' => 'IEC',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Communauté locale',
            'group1' => 'Gouvernement',
            'group2' => 'Donateurs et ONG',
            'group3' => 'Opérateurs économiques',
            'group4' => 'Autre'
        ],
        'predefined_values' => [
            'group0' => [
                'Autorités traditionnelles',
                'Peuples autochtones',
                'Collectivités vivant à proximité ou à l’interieur de l’aire protégée',
                'Collectivités ne vivant pas en proximité de l’aire protégée',
                'Détenteurs de droits traditionnels ou modernes',
                'Propriétaires fonciers ou des terres',
                'Utilisateurs locaux des ressources naturelles',
                'Utilisateurs locaux de produits forestiers non ligneux (PFNL)',
                'Groupes sous-représentés ou défavorisés',
            ],
            'group1' => [
                'Gouvernement central',
                'Gouvernement local',
                'Conseil territorial/départemental et municipal',
                'Autorité en charge des aires protégées',
                'Services fonciers locaux',
                'Représentants des populations locales (parlementaires, etc.)',
                'Forces armées (police, paramilitaire, militaire et marine)'
            ],
            'group2' => [
                'ONG de défense des droits sociaux',
                'ONG environnementale',
                'Scientifiques/Chercheurs',
                'Bailleurs de fonds'
            ],
            'group3' => [
                'Opérateurs touristiques privés',
                'Exploitants forestiers',
                'Pêcheurs'
            ]
        ],
        'ratingLegend' => [
            'Cooperation' => [
                'N/A' =>    'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' =>      'Pas de coopération',
                '1' =>      'Coopération limitée',
                '2' =>      'Coopération satisfaisante',
                '3' =>      'Coopération importante'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Les parties prenantes contribuent-elles à la gestion de l’aire protégée afin de mieux comprendre et appuyer la réalisation des objectifs de l’aire protégée?',
            'Dans de nombreuses aires protégées, une partie ou la totalité des parties prenantes concernées coopèrent de manière substantielle à la prise de décision de la gestion concernant les activités et leur mise en œuvre à l’intérieur ou à l’extérieur de l’aire protégée. Cette coopération peut prendre la forme d’accords formels ou informels. Le niveau de coopération entre les parties prenantes dans une aire protégée dépend d’une variété de facteurs, mais en particulier de la spécificité des acteurs, des pressions et d’autres influences qui découlent de ces dernières, ainsi que de la biodiversité et des services écosystémiques fournis par l’aire protégée. Cette étape de l’analyse permet d’évaluer comment une partie ou la totalité des parties prenantes concernées sont impliquées dans la gestion de l’aire protégée, relativement aux quatre aspects suivants : (P) planification; (PG) planification et gestion, (B/A) bénéfices/assistance aux communautés locales, (IEC) information, éducation environnementale et communication au profit de la sensibilisation et l’engagement des communautés. Le niveau optimal de coopération des parties prenantes devrait être déterminé pour chaque aire protégée individuellement, car chaque aire protégée est unique'
        ],
        'module_info_Rating' => [
            'Choisir (A) les domaines de coopération dans la gestion de l’aire protégée des parties prenantes et évaluer (B) le niveau de coopération<ul><li><b>P</b>: planification</li><li><b>PG</b>: planification et gestion</li><li><b>B/A</b>: bénéfices/assistance aux communautés locales</li><li><b>IEC</b>: information, éducation et communication au profit de la sensibilisation et l’engagement des communautés</li></ul>',
        ]
    ],

    'AssistanceActivities' => [
        'title' => 'Avantages/assistance appropriés pour les communautés locales',
        'fields' => [
            'Activity' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Avantages/assistance adéquates pour les communautés locales',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Éléments de bien-être matériel',
            'group1' => 'Éléments de bien-être immatériel'
        ],
        'predefined_values' => [
            'group0' => [
                'Soutien aux activités locales (gestion des services écosystémiques - gestion de l\'approvisionnement, adaptation au changement climatique, etc.)',
                'Soutien aux entreprises locales (p. ex. transformation des produits de l’agriculture, de la pêche, de la forêt, etc.)',
                'Soutien aux voies de financement locales',
                'Soutien à la production alimentaire et aux petites exploitations agricoles',
                'Achat de produits agricoles pour le tourisme et le personnel',
                'Soutien aux activités touristiques privées',
                'Soutien aux produits traditionnels et à l’artisanat pour les touristes',
                'Soutient à la résolution des conflits homme-faune – compensation',
                'Soutien à l’emploi du personnel local dans le tourisme',
                'Soutien aux fournisseurs de services locaux',
                'Répartition des revenus touristiques',
                'Mise à disposition de ressources naturelles en cas de besoin (eau, fibres, etc.) à partir des aires protégées en cas de crise ou contribution matérielle a’ la construction de bâtiments sociaux tels des hôpitaux ou des écoles, etc.)',
                'Emploi des populations locales dans l’aire protégée',
                'Emploi de surveillants de la région',
                'Fourniture d’énergie électrique, connexion électrique',
                'Approvisionnement en eau',
                'Appui à la construction, à l’entretien et à l’amélioration des routes extérieures',
                'Soutien à la résolution des conflits entre l’homme et la faune sauvage — indemnisation',
                'Soutenir la pêche à petite échelle',
                'Soutien à la construction de hangars à bateaux',
                'Soutien à la construction d’un parking à bateaux'
            ],
            'group1' => [
                'Renforcement de la sécurité dans la région en favorisant de meilleures conditions de vie et de production',
                'Minimisation des conflits et renforcement de la gestion et de l’utilisation durables des services écosystémiques (approvisionnement et culture)',
                'Fourniture d’infrastructures éducatives (bâtiments)',
                'Prestation de services éducatifs (enseignement)',
                'Fourniture d’infrastructures de santé (bâtiments, eau potable)',
                'Prestation de services de santé (soins de santé)',
                'Fourniture d’un accès gratuit au parc',
                'Fourniture de services culturels (physique – intellectuels – emblématiques – spirituels –par l’interaction avec les services écosystémiques)',
                'Facilitation de la résolution de problèmes sociaux',
                'Renforcement de l’identité et du sentiment d’appartenance des communautés locales'
            ]
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' => 'Inadéquat (0-30% des besoins)',
                '1' => 'Plutôt inadéquat (31-60% des besoins)',
                '2' => 'Adéquat (61-90% des besoins)',
                '3' => 'Totalement adéquat (91-100% des besoins)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'L’aire protégée réalise-t-elle des activités/programmes conçus pour fournir des avantages/assistance adéquats aux communautés ?',
            'La gestion des aires protégées s’est éloignée du paradigme historique des conflits liés à une protection totale, où les résultats positifs en matière de conservation étaient généralement obtenus ou perçus au détriment des intérêts des communautés locales. Il est maintenant largement reconnu que les aires protégées devraient contribuer au développement durable et au bien-être des communautés voisines. Les résultats socio-économiques positifs des aires protégées sont importants en soi, mais ils peuvent aussi être nécessaires pour s’assurer que les aires protégées continuent de produire des résultats écologiques solides. Dans de nombreuses études de cas menées dans le monde entier, l’absence d’assistance et d’avantages appropriés pour les communautés locales a été liée à l’échec des initiatives de conservation des aires protégées. En conséquence, les normes internationales des meilleures pratiques encouragent l’évaluation des aires protégées qui tient compte des résultats écologiques et socio-économiques (Sources UNESCO - UICN)'
        ],
        'module_info_Rating' => [
            'Évaluer l’adéquation des activités/programme que l’aire protégée met en œuvre pour fournir des avantages/assistance aux communautés'
        ],
    ],

    'EnvironmentalEducation' => [
        'title' => 'Éducation environnementale et sensibilisation du public',
        'fields' => [
            'Activity' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Adéquation des activités d’éducation et de sensibilisation du public à l’environnement ',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Programmes communautaires de conservation',
            'Programme de sensibilisation dans les villages autour de l’aire protégée',
            'Programme de sensibilisation des habitants en dehors des villages autour de l’aire protégée',
            'Programme d’éducation environnementale dans les écoles',
            'Émissions de radio sur l’aire protégée (par ex. sur les radios communautaires)',
            'Émissions de télévision sur l’aire protégée',
            'Conférences et débats sur la conservation',
            'Visites guidées pour les communautés locales dans l’aire protégée',
            'Distribution de matériel éducatif sur l’environnement dans les écoles',
            'Déchets et opérations de nettoyage',
            'Sensibilisation du public (p. ex. écomusée)'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' => 'Inadéquat (0-30% des besoins)',
                '1' => 'Plutôt inadéquat (31-60% des besoins)',
                '2' => 'Adéquat (61-90% des besoins)',
                '3' => 'Totalement adéquat (91-100% des besoins)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'L’aire protégée mène-t-elle des activités/programmes d’éducation environnementale et de sensibilisation du public spécifiquement liés aux besoins et aux objectifs de conservation/gestion des ressources naturelles ?',
            'L’éducation environnementale peut jouer un rôle efficace dans la sensibilisation à la nécessité de protéger et de préserver l’environnement et d’améliorer la qualité de la vie humaine. L’éducation environnementale peut aider les individus à équilibrer leurs propres besoins vitaux avec les besoins de l’environnement naturel qui fournit des services écosystémiques (approvisionnement, régulation, culture et soutien) pour les communautés à l’intérieur et à l’extérieur, près et loin de l’aire protégée (en considérant la désignation spécifique de l’aire protégée). L’éducation environnementale comprend l’éducation et la formation formelles et informelles qui renforcent la capacité humaine et la capacité de participer à la gestion de l’environnement et à la résolution des crises et défis environnementaux, y compris le changement climatique. On pourrait y parvenir en sensibilisant davantage les gens et en changeant efficacement leur point de vue sur l’environnement'
        ],
        'module_info_Rating' => [
            'Évaluer l’adéquation des activités/programmes d’éducation environnementale et de sensibilisation du public qui sont soutenus par l’aire protégée'
        ]
    ],

    'VisitorsManagement' => [
        'title' => 'Gestion des installations et des services pour les visiteurs',
        'fields' => [
            'Aspect' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Adéquation des installations et des services aux visiteurs',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Procédures de gestion du tourisme liées aux objectifs/résultats souhaités pour les valeurs des aires protégées',
            'Existence d’objectifs spécifiques pour le tourisme et la gestion des visiteurs',
            'Sensibilisation aux conséquences des activités écotouristiques',
            'Utilisation du zonage pour gérer les diverses possibilités de loisirs tout en préservant les valeurs importantes.',
            'Diversification touristique par la promotion  des valeurs biophysiques, culturelles et sociales',
            'Engagement des parties prenantes et des détenteurs de droits à établir un consensus et des partenariats pour la mise en œuvre d’activités touristiques',
            'Bénéfices économiques pour l’aire protégée assurés',
            'Stratégie d’information et de communication et programmes d’appui à la durabilité des programmes touristiques',
            'Gestion de l’hébergement, de la restauration et des loisirs',
            'Transport des visiteurs et gestion de la sécurité',
            'Hébergement, restauration, loisirs pour personnes handicapées',
            'Gamme d’expériences offertes aux visiteurs',
            'Guides touristiques dans l’aire protégée',
            'Développement constant des attraits touristiques',
            'Sentiment d’appartenance (préservation ou amélioration de la spécificité de l’espace naturel)',
            'Suivi de la fréquentation et appréciation des visiteurs'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' => 'Inadéquat (0-30% des besoins)',
                '1' => 'Plutôt inadéquat (31-60% des besoins)',
                '2' => 'Adéquat (61-90% des besoins)',
                '3' => 'Totalement adéquat (91-100% des besoins)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'L’aire protégée gère-t-elle (conçoit, établit, entretient et améliore-t-elle) les installations et les services requis pour le tourisme environnemental ?',
            'Le tourisme dans les aires protégées est une industrie importante et en pleine croissance. Le tourisme est un service écosystémique essentiel qui peut contribuer directement et indirectement aux aires protégées en tant que stratégie de conservation, notamment en atteignant les objectifs d’Aichi en matière de conservation, de développement communautaire et de sensibilisation du public (CDB, 2012). Le tourisme est un phénomène complexe et ses interactions avec les aires protégées se produisent dans des contextes historiques, culturels et géographiques uniques impliquant de multiples valeurs et intervenants. Une gestion efficace du tourisme dans les aires protégées exige une appréciation et une compréhension des contextes de durabilité environnementale, sociale et économique, ainsi qu’une gestion compatible des installations et des services aux visiteurs, et la compréhension de leur évolution dans le temps'
        ],
        'module_info_Rating' => [
            'Évaluer l’adéquation de la gestion des installations et des services d’écotourisme offerts aux visiteurs par l’aire protégée'
        ]
    ],

    'VisitorsImpact' => [
        'title' => 'Gestion de l’impact des visiteurs',
        'fields' => [
            'Impact' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Adéquation de la gestion de l’impact des visiteurs',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Mesures visant à déterminer, surveiller et gérer le niveau acceptable d’impact sur les visiteurs',
            'Actions visant à minimiser les changements induits par l’homme (transport, hébergement et loisirs)',
            'Processus de gestion séparant les objectifs de biodiversité des activités à but lucratif [p. ex. (1) conception d’un centre d’accueil et emplacement des sentiers vs (2) décisions de limiter l’utilisation de la biodiversité dans un habitat particulier]',
            'Collecte et communication de données de suivi du tourisme et de preuves d’impacts pour accroître l’engagement du public et la sensibilisation des visiteurs'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' => 'Inadéquat (0-30% des besoins)',
                '1' => 'Plutôt inadéquat (31-60% des besoins)',
                '2' => 'Adéquat (61-90% des besoins)',
                '3' => 'Totalement adéquat (91-100% des besoins)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'L’aire protégée gère-t-elle et atténue-t-elle de façon appropriée les impacts des visiteurs ?',
            'Promouvoir les loisirs et le tourisme pour que les visiteurs puissent connaître et apprécier une aire protégée, sans porter atteinte aux valeurs pour lesquelles elle a été créée, peut s’avérer difficile. Les visiteurs peuvent avoir un impact négatif à la fois sur les ressources et sur l’expérience des autres visiteurs, ou peuvent aussi, sans le savoir, porter atteinte aux valeurs et normes culturelles. La surveillance, la gestion et l’atténuation des impacts sur les visiteurs sont des aspects essentiels pour la mise en place de stratégies de gestion du tourisme durable, mais ils sont souvent négligés une fois que le plan est en cours. Sans une connaissance adéquate des effets des activités touristiques sur l’environnement naturel du site et sur les communautés environnantes, il est impossible d’établir si la gestion des activités d’écotourisme de l’aire protégée est efficace',
        ],
        'module_info_Rating' => 'Évaluer l’adéquation de la gestion de l’impact des visiteurs sur l’aire protégée (écotourisme)'
    ],

    'NaturalResourcesMonitoring' => [
        'title' => 'Systèmes de suivi de la biodiversité et des ressources naturelles et culturelles',
        'fields' => [
            'Aspect' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Adéquation des systèmes de suivi',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Conception de suivi et de son application sur le terrain (p.ex. suivi assuré par des gardes forestiers, des chercheurs, etc.)',
            'Capacités institutionnelles et ressources techniques pour le suivi',
            'Sécurité de la sauvegarde et du stockage des données issues du suivi',
            'Utilisation des données issues de suivi pour induire des changements dans la gestion de l’aire protégée',
            'Suivi des principaux objectifs de conservation',
            'Suivi des espèces (espèces phares, en voie de disparition, endémiques, ....)',
            'Suivi des habitats et les dimensions connexes de couverture terrestre, utilisation et occupation des sols',
            'Suivi des écosystèmes d’eau douce (lacs, rivières, petits étangs et ruisseaux)',
            'Suivi du niveau de bien-être matériel des populations de l’aire protégée et de sa zone tampon',
            'Suivi du niveau de bien-être immatériel des populations de l’aire protégée et de sa zone tampon',
            'Suivi des menaces qui pèsent sur l’aire protégée',
            'Suivi de l’impact des visiteurs (tourisme) (degré global)',
            'Suivi des services écosystémiques fournis par l’aire protégée',
            'Suivi des effets du changement climatique sur les éléments clés de l’aire protégée',
            'Collecte et analyse adéquates des données de surveillance (p. ex., SMART, Ranger-Based Monitoring – RBM)'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' => 'Inadéquat (0-30% des besoins)',
                '1' => 'Plutôt inadéquat (31-60% des besoins)',
                '2' => 'Adéquat (61-90% des besoins)',
                '3' => 'Totalement adéquat (91-100% des besoins)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Les systèmes de suivi sont-ils adéquats pour observer  efficacement les conditions et l’evolutionévolution de la biodiversité et des ressources naturelles et culturelles de l’aire protégée ?',
            'La réussite de l’exécution d’un programme de suivi dépend de l’analyse des principaux objectifs de conservation de l’aire protégée pour établir des critères spécifiques et des indicateurs de suivi. Sous l’influence de forces et de menaces négatives (croissance démographique et économique, phénomènes naturels, etc.), les activités humaines exercent une pression sur l’aire protégée. Cette pression entraîne un changement, une perturbation ou une dégradation des valeurs et des ressources de l’aire protégée. Afin d’anticiper les problèmes potentiels et de planifier les meilleures interventions dans l’aire protégée, il est indispensable de bien comprendre les tendances des services environnementaux et écosystémiques (biodiversité, approvisionnement en eau, alimentation, qualité des forêts, menaces, etc.'
        ],
        'module_info_Rating' => [
            'Évaluer l’adéquation des systèmes de suivi en place pour la biodiversité et les ressources naturelles et culturelles de l’aire protégée'
        ]
    ],

    'ResearchAndMonitoring' => [
        'title' => 'Recherche et surveillance écologique à long terme',
        'fields' => [
            'Program' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Adéquation de la recherche et de la surveillance écologique à long terme',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Rôle de la recherche et de la surveillance écologique à long terme dans la gestion de l’aire protégée',
            'Fonds/installations et capacités institutionnels et/ou externes pour promouvoir et coordonner les activités de recherche',
            'Accessibilité et sécurité des données issues de la recherche',
            'Soutien de la gestion grâce à la recherche et aux données de surveillance écologique à long terme',
            'Recherche et surveillance écologique à long terme des espèces (espèces phares, menacées, endémiques, etc.)',
            'Recherche et surveillance écologique à long terme des habitats et les dimensions connexes de la couverture terrestre, utilisation et occupation des sols',
            'Recherche et surveillance écologique à long terme des écosystèmes d’eau douce (lacs, rivières, petits étangs et ruisseaux)',
            'Recherche et surveillance à long terme du bien-être humain de la population de l’aire protégée et de ses zons tampons',
            'Recherche et surveillance à long terme des menaces pour l’aire protégée',
            'Recherche et surveillance écologique à long terme des services écosystémiques fournis par l’aire protégée',
            'Recherche et surveillance écologique à long terme des effets du changement climatique sur les éléments clés de l’aire protégée'

        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' => 'Inadéquat (0-30% des besoins)',
                '1' => 'Plutôt inadéquat (31-60% des besoins)',
                '2' => 'Adéquat (61-90% des besoins)',
                '3' => 'Totalement adéquat (91-100% des besoins)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'L’aire protégée coordonne-t-elle ou entreprend-elle des activités de recherche et de surveillance écologique à long terme, et a-t-elle accès aux résultats de la recherche et s’en sert-elle pour la gestion ?',
            'Le but de la recherche et de la surveillance écologique à long terme dans une aire protégée est d’obtenir de l’information sur le développement à long terme de certaines composantes de ses écosystèmes afin de prévoir les enjeux futurs et de planifier des interventions de gestion. Une étude devrait sélectionner les éléments clés (espèces, habitats, eau, services écosystémiques, etc.) pour évaluer la santé environnementale des valeurs et de l’importance de l’aire  protégée. Les mesures fonctionnelles de gestion pourraient être de plus en plus appliquées en tant qu’approche pour assurer l’intégrité écologique de l’aire protégée'
        ],
        'module_info_Rating' => [
            'Évaluer l’adéquation des actions/applications de recherche et de surveillance écologique à long terme soutenant la gestion de l’aire protégée'
        ]
    ],

    'ClimateChangeMonitoring' => [
        'title' => 'Gestion de l’adaptation aux effets du changement climatique',
        'fields' => [
            'Program' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Adéquation des mesures d’adaptation',
            'Comments' => 'Commentaires/Explication',
        ],
        'predefined_values' => [
            'Gestion de l’adaptation pour les espèces (p. ex. espèces transférées, etc.)',
            'Gestion de l’adaptation pour les habitats et les dimensions connexes de couverture terrestre, utilisation et occupation des sols à l’intérieur et à l’extérieur de l’aire protégée (éviter la fragmentation des forêts, les sols dénudés, etc.)',
            'Gestion de l’adaptation pour les services écosystémiques',
            'Réduire les facteurs de stress qui amplifient les impacts climatiques (p. ex. augmenter la connectivité, contrôler les espèces envahissantes, etc.)',
            'Soutient ou restauration du processus et de la fonction de l’écosystème pour favoriser la résilience (p. ex. restaurer la végétation dégradée, etc.)',
            'Protection des écosystèmes intacts et reliés entre eux (p. ex. éliminer les obstacles aux voies navigables, éviter de diviser les corridors, etc.)',
            'Établissement des partenariats pour protéger les habitats essentiels à l’extérieur de l’aire protégée pour les espèces clés touchées par les effets du changement climatique)',
            'Identification et protection des refuges climatique (p. ex. réduire l’utilisation humaine et les perturbations dans les refuges du changement climatique, etc.)',
            'Gestion des réseaux écologiques pour promouvoir la résilience écologique face aux impacts climatiques',
            'Participation à la planification de l’adaptation des paysages terrestres et marins qui s’étendent au-delà des limites des aires protégées'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' => 'Inadéquat (0-30% des besoins)',
                '1' => 'Plutôt inadéquat (31-60% des besoins)',
                '2' => 'Adéquat (61-90% des besoins)',
                '3' => 'Totalement adéquat (91-100% des besoins)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Comment l’aire protégée gère-t-elle l’adaptation aux effets du changement climatique ?',
            'La réponse au changement climatique peut être divisée en "atténuation (mitigation)" (actions qui réduisent la quantité de dioxyde de carbone et d’autres gaz piégeant la chaleur dans l’atmosphère) et "adaptation" (adaptation des systèmes humains ou naturels au changement climatique). Bien que les aires protégées aient la capacité de capter et de stocker le carbone dans leurs écosystèmes et de réduire les émissions provenant de leurs activités, la gestion met généralement l’accent sur l’adaptation aux effets du changement climatique'
        ],
        'module_info_Rating' => [
            'Évaluer l’adéquation des mesures de gestion relatives à l’adaptation au changement climatique'
        ]
    ],

    'EcosystemServices' => [
        'title' => 'Gestion des services écosystémiques',
        'fields' => [
            'Intervention' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Adéquation de la gestion des services écosystémiques',
            'Comments' => 'Commentaires/Explication',
        ],
        'categories' => [
            'title1' => 'Approvisionnement',
            'title2' => 'Réglementer',
            'title3' => 'Culturel',
            'title4' => 'Support / Soutien',
        ],
        'groups' => [
            'group0' => 'Gestion des éléments de la nutrition (p. ex. eau, nourriture, fourrage, plantes médicinales, pêche, etc.)',
            'group1' => 'Gestion des matériaux (p. ex. bois, fibres, autres produits d’extraction)',
            'group2' => 'Gestion de l’énergie (p. ex., hydroélectricité)',
            'group3' => 'Gestion des flux de déchets, de substances toxiques (p. ex. filtrage et décomposition des déchets organiques et des polluants dans les eaux)',
            'group4' => 'Gestion pour le maintien des conditions biologiques, chimiques et physiques (p. ex. pollinisation, atténuer les dommages causés par les catastrophes naturelles)',
            'group5' => 'Gestion pour assurer un niveau élevé d’interactions physiques (p. ex. conservation ex situ)',
            'group6' => 'Gestion d’interactions intellectuelles de haut niveau (p. ex., la recherche)',
            'group7' => 'Gestion des niveaux élevés d’interactions spirituelles et/ou emblématiques entre l’aire protégée et les parties prenantes (par exemple, les rites traditionnels)',
            'group8' => 'Gestion durable des habitats (pollinisation des cultures, zones humides, insectes, etc.)',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’aire protégée',
                '0' => 'Inadéquat (0-30% des besoins)',
                '1' => 'Plutôt inadéquat (31-60% des besoins)',
                '2' => 'Adéquat (61-90% des besoins)',
                '3' => 'Totalement adéquat (91-100% des besoins)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'L’aire protégée parvient-elle à promouvoir la conservation/amélioration des services écosystémiques qu’elle fournit ?',
            'Les services écosystémiques sont les avantages nombreux et variés que les humains tirent librement de l’environnement naturel et du bon fonctionnement des écosystèmes. Les services écosystémiques sont regroupés en quatre grandes catégories: (1) les services d’approvisionnement, comme la production de nourriture et d’eau ; (2) les services de régulation, comme le contrôle du climat et des maladies ; (3) les services culturels, comme les avantages spirituels et récréatifs ; et (4) les services de support / soutien, comme les cycles nutritifs, la pollinisation des cultures ou les habitats qui fournissent tout ce dont une plante ou un animal a besoin pour survivre: nourriture, eau et abri [évaluation des écosystèmes pour le Millénaire (EM)]'
        ],
        'module_info_Rating' => [
            'Évaluer l’adéquation des mesures de gestion favorisant la conservation/amélioration des services écosystémiques fournis par l’aire protégée'
        ]
    ],

    'ObjectivesProcessus' => [
        'module_info' => 'Établir et décrire les objectifs de conservation liés au processus de mise en œuvre de l’aire protégée. Les objectifs et les cibles indiqués ci-dessous seront utilisés pour améliorer la gestion, et plus spécifiquement pour la planification, la mobilisation des ressources (intrants), les phases de processus et pour le suivi des activités de gestion de l’aire protégée'
    ],

    'WorkProgramImplementation' => [
        'title' => 'Mise en œuvre des activités du plan de travail/du plan d’action',
        'fields' => [
            'Category' => 'Catégories d’activités',
            'Activity' => 'Activités',
            'TargetedActivity' => 'Activités prévues',
            'EvaluationScore' => 'Evaluation: Niveau de mise en œuvre',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Niveau d’exécution nul ou très faible des activités prévues pour l’année(s) analysé(s) (entre 0 et 25 %)',
                '1' => 'Faible niveau d’exécution des activités prévues pour l’année(s) analysé(s) (entre 26 et 50 %)',
                '2' => 'Niveau moyen de mise en œuvre des activités prévues pour l’année(s) analysé(s) (entre 51 et 75 %)',
                '3' => 'Niveau élevé de mise en œuvre des activités prévues pour l’année(s) analysé(s) (entre 76 et 100 %)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Dans quelle mesure l’aire protégée a-t-elle mis en œuvre les principales activités du plan de travail ?',
            'La mise en œuvre est la réalisation ou l’exécution du plan de travail/action annuel ou pluriannuel concernant les activités de l’aire protégée. En tant que telle, la mise en œuvre est l’action qui doit suivre toute activité préalable de planification, de gestion et de conservation. Lorsque l’aire protégée met en œuvre un plan de travail, elle peut prendre des mesures de gestion et de conservation ciblées de manière durable'
        ],
        'module_info_Rating' => [
            'Évaluer le niveau de mise en œuvre des principales activités du plan de travail/plan d’action pour l’année précédente (dans les commentaires, indiquer l’année de référence si vous appliquez un plan de travail/d’action pluriannuel)',
            '<b>Catégorie d’activités</b>: p. ex. application de la loi, appui aux activités de développement dans la zone tampon, éducation environnementale, gestion du tourisme, etc.',
            '<b>Activité</b>: action appartenant à l’une des principales catégories d’activités qui est exécutée dans un but particulier',
            'En l’absence d’un plan de travail ou d’action, vous pouvez vous référer aux catégories et aux activités retenues dans l’élément « Processus », notamment pour ce qui est des indicateurs suivants: Gestion et protection des éléments clés de conservation ; Interactions avec les parties prenantes ; Tourisme ; Suivi  et recherche ; Changement climatique et services écosystémiques',
        ]
    ],

    'AchievedResults' => [
        'title' => 'Atteints des résultats/extrants du plan de travail/d’action',
        'fields' => [
            'Category' => 'Catégories d’activités',
            'Activity' => 'Activités',
            'TargetedOutput' => 'Résultats attendus',
            'EvaluationScore' => 'Evaluation: Niveau d’atteinte des résultats',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Aucune ou très faible atteinte des résultats visés pour l’année(s) analysé(s) (entre 0 et 25 %)',
                '1' => 'Faible niveau d’atteinte des résultats visés pour l’année(s) analysé(s) (entre 26 et 50 %)',
                '2' => 'Niveau moyen d’atteinte des résultats visés pour l’année(s) analysé(s) (entre 51 et 75 %)',
                '3' => 'Haut niveau d’atteinte des résultats visés pour l’année(s) analysé(s) (entre 76 et 100 %)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Dans quelle mesure l’aire protégée a-t-elle atteint les principaux résultats du plan de travail/d’action ?',
            'L’approche prédominante pour la planification des aires protégées comprend l’établissement d’un plan de travail/d’action annuel ou pluriannuel qui contribue à l’atteinte des objectifs de conservation à long terme. Dans le processus de planification, les objectifs à long terme sont traduits en cibles de conservation à court terme que le plan de travail/d’action permet d’atteindre pour des aspects spécifiques de la biodiversité, tels que les espèces, les habitats et les menaces ou les services écosystémiques. Toutefois, étant donné que l’utilisation de nombreux objectifs de conservation de faible niveau constitue un obstacle à l’atteinte d’une performance élevée en matière de conservation, les résultats doivent être étroitement liés aux effets/impacts pour assurer un rendement élevé en matière de conservation. La mise en place de systèmes d’évaluation du rendement est un moyen important de suivre l’évolution des activités de gestion et de conservation'
        ],
        'module_info_Rating' => [
            'Évaluer le niveau d’atteinte des principaux résultats/extrants du plan de travail/ d’action (dans les commentaires, indiquer l’année de référence si vous appliquez un plan de travail/d’action pluriannuel)',
            '<b>Catégorie d’activités</b>: p. ex. application de la loi, appui aux activités de développement dans la zone tampon, éducation environnementale, gestion du tourisme, etc.',
            '<b>Activité</b>: action appartenant à l’une des principales catégories d’activités qui est exécutée dans un but particulier',
            'En l’absence d’un plan de travail ou d’action, vous pouvez vous référer aux catégories et aux activités retenues dans l’élément « Processus », notamment pour ce qui est des indicateurs suivants: Gestion et protection des valeurs ; Relations avec les parties prenantes ; Tourisme ; Surveillance et recherche ; Changement climatique et services écosystémiques'
        ]
    ],

    'AreaDomination' => [
        'title' => 'Domination de l’aire protégée',
        'fields' => [
            'Patrol' => 'A) Zone contrôlée par des activités de patrouille',
            'RapidIntervention' => 'B) Intervention rapide sans moyens aériens',
            'AirVehicles' => 'C.1) Moyens spéciaux disponibles et adéquats pour la surveillance',
            'Planes' => 'C.2) Moyens spéciaux disponibles et adéquats pour une intervention rapide',
            'Comments' => 'Commentaires/Explication'
        ],
        'ratingLegend' => [
            'Patrol' => [
                '0' => 'La superficie de l’aire protégée contrôlée par les activités de patrouille est minimale (de 0 à 25 % de la superficie)',
                '1' => 'La superficie de l’aire protégée contrôlée par les activités de patrouille est limitée (de 26 à 50 % de la superficie)',
                '2' => 'La superficie de l’aire protégée contrôlée par les activités de patrouille est suffisante (de 51 à 75 % de la superficie)',
                '3' => 'La superficie de l’aire protégée contrôlée par les activités de patrouille est très bonne (plus de 76 % de la superficie)',
            ],
            'RapidIntervention' => [
                '0' => 'La capacité d’intervention rapide dans l’aire protégée est minime (de 0 à 25 % de la surface)',
                '1' => 'La capacité d’intervention rapide dans l’aire protégée est limitée (de 26 à 50 % de la superficie)',
                '2' => 'La capacité d’intervention rapide dans l’aire protégée est suffisante (de 51 à 75 % de la superficie)',
                '3' => 'La capacité d’intervention rapide dans l’aire protégée est très bonne (plus de 76 % de la superficie)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Quelle est l’étendue actuelle du contrôle de l’aire protégée ?',
            'Le contrôle d’une aire fait référence à la capacité de la direction du parc de créer une présence dans une zone donnée, par exemple par des patrouilles régulières, des interventions rapides ou une surveillance aérienne. Au besoin, cette présence doit être imposée fréquemment et efficacement pour faire face à des menaces telles que le braconnage ou les activités illégales. L’objectif de maximiser la superficie contrôlée est de prévenir ou de minimiser les activités illégales affectant la biodiversité, les valeurs culturelles ou historiques, et de faire respecter la protection de l’aire protégée et de ses limites'
        ],
        'module_info_Rating' => [
            'Évaluer le pourcentage de la superficie de l’aire protégée où le contrôle est assuré ou peut être assuré à travers (A) des activités de patrouille ; (B) des interventions rapides ; (C) des moyens spéciaux'
        ]
    ],

    'AreaDominationMPA' => [
        'title' => 'Application de la loi dans l’AMP',
        'fields' => [
            'Activity' => 'Gamme d’activités soumises à l’analyse',
            'Patrol' => 'Zone contrôlée par des activités de patrouille',
            'RapidIntervention' => 'Intervention rapide sans moyens aériens',
            'DetectionRemoteSensing' => 'Détection au moyen d’outils de télédétection (par exemple, systèmes de surveillance des navires VMS)',
            'SpecialMeansRapidIntervention' => 'Moyens spéciaux permettant une intervention rapide',
        ],
        'groups' => [
            'group0' => 'Sanctuaire',
            'group1' => 'Zones interdites à la pêche (No-take areas)/Réserve marine',
            'group2' => 'Zones tampons pour les usages traditionnels',
            'group3' => 'Zones tampons pour les activités éducatives et/ou récréatives',
            'group4' => 'Contrôle à quai pour les navires qui viennent au port'
        ],
        'predefined_values' => [
            'group0' => [
                'Toutes les activités/utilisations interdites'
            ],
            'group1' => [
                'Activités interdites (par exemple, pêche ou extraction de toute sorte, ancrage, navigation de plaisance, déversement, etc.)',
                'Activités autorisées (par exemple, recherche et surveillance, etc.)'
            ],
            'group2' => [
                'Activités interdites (par exemple, pêche illégale et méthodes de pêche légales spécifiées, ancrage, déversement)',
                'Activités autorisées (par exemple, pêche et navigation traditionnelles limitées et spécifiées, natation et plongée, ancrage sur des bouées d’amarrage, recherche, etc.)'
            ],
            'group3' => [
                'Activités autorisées (par exemple, pêche et navigation traditionnelles limitées et spécifiées, natation et plongée, ancrage sur des bouées d’amarrage, recherche et éducation, etc.)'
            ],
            'group4' => [
                'Activités utilisées pour recueillir des informations susceptibles de mettre en lumière des schémas de comportements illicites. Les stratégies de mise à quai devraient être adaptées afin de promouvoir l’application la plus appropriée pour les grandes AMP ou pour résoudre les problèmes d’application dans les petites AMP proches du rivage'
            ],
        ],
        'ratingLegend' => [
            'Patrol' => [
                '0' => 'La superficie de l’aire protégée contrôlée par les activités de patrouille est minimale (de 0 à 25 % de la superficie)',
                '1' => 'La superficie de l’aire protégée contrôlée par les activités de patrouille est limitée (de 26 à 50 % de la superficie)',
                '2' => 'La superficie de l’aire protégée contrôlée par les activités de patrouille est suffisante (de 51 à 75 % de la superficie)',
                '3' => 'La superficie de l’aire protégée contrôlée par les activités de patrouille est très bonne (plus de 76 % de la superficie)',
            ],
            'RapidIntervention' => [
                '0' => 'La capacité d’intervention rapide dans l’aire protégée est minime (de 0 à 25 % de la surface)',
                '1' => 'La capacité d’intervention rapide dans l’aire protégée est limitée (de 26 à 50 % de la superficie)',
                '2' => 'La capacité d’intervention rapide dans l’aire protégée est suffisante (de 51 à 75 % de la superficie)',
                '3' => 'La capacité d’intervention rapide dans l’aire protégée est très bonne (plus de 76 % de la superficie)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Quel est le degré actuel d’application de la loi dans l’AMP ?',
            'L’application de la loi dans les AMP fait référence à la capacité de la gestion du parc à créer une présence dans une aire donnée, par exemple par le biais de patrouilles régulières, d’enquêtes, d’interventions rapides, de surveillance aérienne ou de détection via des outils de télédétection. Si nécessaire, cette présence doit être imposée fréquemment et efficacement pour faire face aux menaces telles que la pêche ou les activités illégales. L’objectif de l’application stricte de la loi dans les AMP est de prévenir ou de minimiser les activités illégales affectant la biodiversité, les valeurs culturelles ou historiques, et de faire respecter la protection de l’aire protégée et de ses limites'
        ],
        'module_info_Rating' => [
            'Évaluer le pourcentage de la superficie de l’aire protégée où le contrôle est assuré ou peut être assuré à travers (A) des activités de patrouille ; (B) des interventions rapides ; (C) des moyens spéciaux'
        ]
    ],

    'AchievedObjectives' => [
        'title' => 'Atteinte des objectifs de conservation à long terme du plan de gestion',
        'fields' => [
            'Objective' => 'Principaux objectifs à long terme du plan de gestion',
            'EvaluationScore' => 'Atteinte des objectifs',
            'Comments' => 'Commentaires/Explication',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Aucune ou très faible atteinte de l’objectif à long terme du plan de gestion à présent (entre 0 et 25 %)',
                '1' => 'Faible niveau d’atteinte de l’objectif à long terme du plan de gestion à présent (entre 26 et 50 %)',
                '2' => 'Niveau moyen d’atteinte de l’objectif à long terme du plan de gestion à présent (entre 51 et 75 %)',
                '3' => 'Haut niveau d’atteinte de l’objectif à long terme du plan de gestion à présent) (entre 76 et 100 %)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Dans quelle proportion l’aire protégée a-t-elle atteint les principaux objectifs à long terme du plan de gestion ?',
            '(A partir de l’élément Contexte de l’intervention, point CTX1.5 Vision — Mission — Objectifs ou élément Planification, point P6 — Objectifs de l’aire protégée)<ul><li>Les objectifs doivent être bien définis et clairement compris de manière à faciliter le suivi de leur atteinte si l’on veut que la gestion soit efficace</li><li>Dans cet outil, nous faisons une distinction importante entre les résultats/extrants et les effets/impacts:</li><li>Les effets/impacts se rapportent aux changements liés aux OBJECTIFS/ÉTATS SOUHAITES ou à la vision exprimés dans le plan de gestion et caractérisant une situation visée ou souhaitée, à la fin de la période considérée. Ces objectifs sont généralement des énoncés spécifiques concernant les valeurs clés de l’aire protégée (p. ex. les espèces ou les services écosystémiques importants) ou les principaux domaines d’activités de gestion (p. ex. tourisme, éducation).</li><li>Les résultats/extrants se rapportent à la la réalisation d’ACTIVITES à court terme (ou à relativement court terme) généralement mesurés de manière quantitative, et qui contribuent avec d’autres réalisations, à atteindre les objectifs/états souhaités à long terme. Il est considéré que l’utilisation de nombreux objectifs de conservation de faible niveau est un obstacle à l’atteinte d’une performance élevée en matière de conservation</li></ul>'
        ],
        'module_info_Rating' => [
            'Évaluer le niveau d’atteinte des principaux objectifs à long terme liés aux valeurs clés de l’aire protégée ou des principaux aspects du plan de gestion'
        ]
    ],

    'KeyConservationTrend' => [
        'title' => 'Conditions et tendances des éléments clés de la conservation de l’aire protégée',
        'fields' => [
            'Element' => 'Critère — Concept mesuré — Variable',
            'Condition' => 'Condition de l’élément clé',
            'Trend' => 'Tendance de l’élément clé',
            'Reliability' => 'Fiabilité de l’information',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Conditions et tendances de conservation des espèces animales clés ',
            'group1' => 'Conditions et tendances de conservation des espèces de plantes clés ',
            'group2' => 'Conditions et tendances de conservation des habitats et des éléments connexes de la couverture terrestre, l’utilisation et l’occupation du sol',
            'group3' => 'Situation et tendances des menaces qui pèsent sur l’aire protégée',
            'group4' => 'Adaptation au changement climatique',
            'group5' => 'Conditions et tendances de conservation des services écosystémiques'
        ],
        'ratingLegend' => [
            'Condition' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’aire protégée',
                '-3' => 'Très mauvaise',
                '-2' => 'Mauvaise',
                '-1' => 'Légèrement mauvaise',
                '0' =>  'Neutre',
                '+1' => 'Légèrement bonne',
                '+2' => 'Bonne',
                '+3' => 'Très bonne'
            ],
            'Trend' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’aire protégée',
                '-3' => 'En forte baisse',
                '-2' => 'En baisse',
                '-1' => 'Légèrement en baisse',
                '0' =>  'Aucun changement',
                '+1' => 'Légèrement en hausse',
                '+2' => 'Légèrement en hausse',
                '+3' => 'En forte progression'
            ],
            'Reliability' => [
                'Élevé ' => 'Certitude presque totale quant aux valeurs de l’état et des tendances',
                'Moyen' => 'Possibilité d’erreur quant aux valeurs de l’état et des tendances',
                'Faible' => 'Forte incertitude quant aux valeurs de l’état et des tendances'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Quelles sont les conditions et les tendances pour les éléments clés de la conservation de l’aire protégée ?',
            'Les principaux objectifs de gestion de l’aire protégée sont la conservation/restauration des valeurs naturelles et les avantages que les humains tirent de l’environnement naturel et du maintien du fonctionnement des écosystèmes (services écosystémiques). Les gestionnaires devraient assurer la conservation/restauration des valeurs clés (espèces animales et végétales, habitats, etc.) et le maintien des services écosystémiques d’approvisionnement, de régulation, de culture et de soutien, en garantissant les valeurs et avantages des aires protégées pour tous'
        ],
        'module_info_Rating' => [
            'Évaluer: A) les conditions et B) les tendances des éléments clés de conservation de l’aire protégée (sur la base des éléments du Contexte: C 1, divers éléments clés et C3, menaces, Processus: PR7 — Gestion des valeurs et des éléments clés de l’aire protégée, PR 17 Adaptation au changement climatique et PR18 — Gestion des services écosystémiques',
        ]
    ],

    'LifeQualityImpact' => [
        'title' => 'Effets/Impacts sur la qualité de vie des acteurs locaux',
        'fields' => [
            'Element' => 'Critère — Concept mesuré — Variable',
            'EvaluationScore' => 'Evaluation: Effet/Impact',
            'Comments' => 'Commentaires/Explication',
        ],
        'groups' => [
            'group0' => 'Bien-être matériel',
            'group1' => 'Bien-être immatériel',

        ],
        'predefined_values' => [
            'group0' => [
                'Renforcement des activités locales (production alimentaire, petite agriculture, pêche artisanale, artisanat, services pour l’aire protégée, etc.)',
                'Soutien aux entreprises locales (alimentation électrique, approvisionnement en eau, commerce, routes entre les villages, hangars à bateaux, stationnement des bateaux, etc.)',
                'Services écosystémiques d’approvisionnement (nourriture,matériaux, etc) ',
                'Revenus touristiques',
                'Conflit homme-faune',
                'Création d’emplois des locaux dans les activités de l’AP'
            ],
            'group1' => [
                'Protection des hommes, des aménagements et des infrastructures et stabilité sociale',
                'Maintien de la quantité et de la qualité des services écosystémiques d’approvisionnement',
                'Contribution à l’éducation',
                'Contribution à l’amélioration de la santé publique locale',
                'Maintien de la valeur emblématique et spirituelle du territoire local',
                'Identité communautaire (culturelle, traditionnelle, spirituelle, etc.)',
                'Conflits entre les utilisateurs des ressources naturelles'
            ]
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n’est pas lié à la gestion de l’aire protégée',
                '-3' => 'Très dommageable',
                '-2' => 'Dommageable',
                '-1' => 'Légèrement dommageable',
                '0' =>  'Aucun',
                '1' =>  'Légèrement favorable',
                '+2' => 'Favorable',
                '+3' => 'Très favorable'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'La gestion de l’aire protégée a-t-elle des effets/impacts positifs ou négatifs sur la qualité de vie des acteurs locaux ?',
            'Les changements actuels et futurs de l’environnement et la disponibilité des ressources essentielles peuvent affecter la qualité de la vie à travers des effets/impacts sur la consommation, le revenu et la richesse (bien-être matériels) et sur le bien vivre, la santé et les relations sociales et culturelles (bien-être immatériels). La gestion des aires protégées doit être très attentive aux effets/impacts sur la qualité de vie des acteurs locaux',
        ],
        'module_info_Rating' => [
            'Évaluer les effets/impacts des activités opérationnelles de l’aire protégée envers les acteurs locaux.'
        ]
    ]

];
