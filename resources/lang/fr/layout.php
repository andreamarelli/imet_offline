<?php

return [

    "home" => "Accueil",
    "creative_commons" => "Contenu soumis à une Licence Creative Common",

    "search" => [
        "pages"     => "Pages",
        "glossary"  => "Glossaire",
        "search"    => "Recherche"
    ],

    "menu" => [

        "ofac" => [
            "ofac"              => "OFAC",
            "observatory"       => "L'Observatoire",
            "activity"          => "Activités",
            "projects_appui"    => "Projets d’appui",
            "partners"          => "Partenaires",
            "contacts"          => "Contacts",
            "news"              => "Les nouvelles de l'OFAC",
            "observatory_menu"  => [
                "glance"             =>  "En bref",
                "background"         =>  "Histoire",
                "purpose"            =>  "Objectifs",
                "ofac_network"       =>  "Le Réseau de l’OFAC",
            ],
            "activity_menu"     => [
                "mapping_actors"        => "Cartographie des acteurs et initiatives en Afrique Centrale",
                "environmental_data"    => "Collecte de données environnementales",
                "data_collection"       => "Collectes dans les sites de gestion",
                "concessions"           => "Concessions forestières",
                "protected_areas"       => "Aires protégées",
                "monitoring_plot"       => "Suivi des placettes permanentes"
            ]
        ],

        "africa" => [
            "africa"                => "L’Afrique centrale",
            "context_physical"      => "Contexte physique",
            "biodiversity"          => "Biodiversité animale",
            "biodiversity_details"  => "Biodiversité animale",
            "biodiversity_tabs"     => [
                "introduction"          => "Introduction",
                "taxonomy"              => "Taxonomie",
                "list"                  => "Liste des espèces",
                "biogeography"          => "Biogéographie",
                "distribution"          => "Distribution par pays",
                "exploitation"          => "Exploitation humaine",
                "threats_conservation"  => "Menaces et conservation",
                "fauna_status"          => "Etat de la faune",
                "bibliography"          => "Bibliographie et Crédits",
            ],
            "forest_ecosystems"     => "Écosystèmes forestiers",
            "essences"              => "Liste des essences forestières de l’OFAC",
            "ap"                    => "Aires Protégées",
            "forest_management"     => "Gestion forestière et filière bois",
            "context_human"         => "Contexte humain",
            "context_legal"         => "Contexte juridique",
            "context_physical_menu"     => [
                "geology"                   => "Geologie",
                "hydrography"               => "Hydrographie",
                "rainfall"                  => "Pluviométrie",
                "topography"                => "Topographie",
            ],
            "forest_ecosystems_menu"     => [
                "mapping"                   => "Cartographie des écosystèmes forestiers",
                "landscapes"                => "Paysages écologiques",
                "maps"                      => "Cartes interactives"
            ],
            "forest_management_menu"     => [
                "forest_production"         => "Production forestières",
                "forest_certification"      => "Certifications forestières",
                "forest_governance"         => "Gouvernance forestière",
                "forest_management"         => "Aménagement forestier"
            ],
            "context_human_menu"         => [
                "demography"                => "Démographie et développement",
                "population"                => "Densité de la population",
                "impact"                    => "Impact des populations urbaines",
                "history"                   => "Implantation des populations",
                "agriculture"               => "Agriculture, élevage et utilisation des ressources spontanées de la forêt",
                "bibliography"              => "Bibliographie"
            ],
        ],

        "monitoring_system" => [
            "monitoring_system"     => "Systèmes de suivi",
            "introduction"          => "Introduction",
            "introduction_menu"    => [
                "national_collection"                => "Collectes nationales",
                "collection_management_site"                => "Collecte dans les sites de gestion",
                "forest_concessions"                => "Concessions forestières",
                "protected_area"                => "Aires protégées",
                "monitoring_permanent_plots"                    => "Suivi des placettes permanentes"
            ],
            "national_indicators"   => "Indicateurs nationaux",
            "conservation"          => "Conservation et valorisation de la biodiversité",
            "concessions"           => "Concessions forestières",
            "national_synthesis"    => "Synthèses nationales",
            "regional_synthesis"    => "Synthèse régionale",
            "imet"                  => "Aires protégées (IMET)",

            "concessions_indicators" => "Indicateurs de gestion forestière par concession",
        ],

        "activity_competencies" => [
            "activity_competencies"     => "Activités & Compétences",
            "projects"                  => "Projets",
            "project"                   => "Projet",
            "experts"                   => "Experts",
            "expert"                    => "Expert",
            "trainings"                 => "Formations",
            "training"                  => "Formation",
            "institutions"              => "Institutions",
        ],

        "publications" => [
            "publications"          => "Publications",
            "edf"                   => "État des Forêts",
            "edap"                  => "État des Aires Protégées",
            "other_publications"    => "Autres publications OFAC",
            "library"               => "Catalogue de données",
            "policy_briefs"         => "Policy brief",
            "newsletter"         => "Newsletter",
        ],

        "cartography" => [
            "cartography"   => "Espace cartographique",
            "geoportal"     => "Géoportail COMIFAC",
            "download"      => "Téléchargement des données SIG",
            "products"      => "Produits cartographiques",
            "atlas"         => "Atlas de l’utilisation des terres",
            "inventory"     => "Inventaire des géoportails",
        ],

    ],

    'admin' => [
        'admin_page'    =>  'panneau d\'administration',
        'profile'       =>  'profil',
        'expert_cv'     =>  'CV Expert',

        'administration_tools' => 'outils d\'administration',

        'application' => [
            'management'        => 'gestion de l\'application',
            'error_log'         => 'Journal de bord des anomalies',
            'exception_log'     => 'Journal de bord des exceptions',
            'activity_log'      => 'Journal de bord des opérations',
            'db_stats'          => 'Taille de la base de données',
            'forms_dashboard'   => 'Taux de remplissage des formulaires ',
            'web_stats'         => 'Statistiques du site web',

            'old_ofac_error_log' => 'ancien système (anomalies PostgreSQL)',
            'new_laravel_error_log' => 'nouveau système (exceptions Laravel)',
        ],

        'website' => [
            'management'    => 'Gestion du siteweb',
            'licenses'      => 'Licences d\'utilisation',
            'press'         => '"Dans la press"',
        ],

        'users' => [
            'user_management'   => 'Gestion du personnel et des utilisateurs',
            'role_management' => 'Gestion des rôles et des autorisations',
            'national_form_roles'   => 'Rôles de formulaires nationaux',
            'regional_form_roles'   => 'Rôles de formulaire régionaux',
            'concession_form_roles'   => 'Rôles de formulaire des concessions forestières',
            'imet_form_roles'   => 'Rôles de formulaire IMET',
        ],

        'knowledge_base'    => [
            'knowledge_base'    =>  'Partage des connaissances',
            'entities' => 'Entités administratives et géographiques',
        ],

        'monitoring_system'     => [
            'monitoring_system' => 'Systèmes de suivi',
            'national_level' => 'Collecte des données au niveau national',
            'regional_level' => 'Collecte des données au niveau regional',
            'site_level' => 'Collecte des données au niveau du site de gestion',
        ],
    ]

];
