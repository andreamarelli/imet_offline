<?php

return [

    "home" => "Homepaage",
    "creative_commons" => "Content under Creative Common License",

    "search" => [
        "pages"     => "Pages",
        "glossary"  => "glossary",
        "search"    => "search"
    ],

    "menu" => [

        "ofac" => [
            "ofac"              => "OFAC",
            "observatory"       => "The Observatory",
            "activity"          => "Activities",
            "projects_appui"    => "Support projects",
            "partners"          => "Partners",
            "contacts"          => "Contacts",
            "news"              => "OFAC News",
            "observatory_menu"  => [
                        "glance"        => "At a glance",
                        "background"    => "Background",
                        "purpose"       => "Purpose",
                        "ofac_network"  => "OFAC’s network",
            ],
            "activity_menu"     => [
                        "mapping_actors"        => "Mapping actors and initiatives in Central Africa",
                        "environmental_data"    => "Environmental data collecting",
                        "data_collection"       => "Data collection in management sites",
                        "concessions"           => "Logging concessions",
                        "protected_areas"       => "Protected Areas",
                        "monitoring_plot"       => "Monitoring permanent plots"
            ],

        ],

        "africa" => [
            "africa"                => "Central africa",
            "context_physical"      => "Physical context",
            "biodiversity"          => "Biodiversity",
            "biodiversity_details"  => "Biodiversity",
            "biodiversity_tabs"     => [
                "introduction"          => "introduction",
                "taxonomy"              => "taxonomy",
                "list"                  => "Species list",
                "biogeography"          => "Biogeography",
                "distribution"          => "Country distribution",
                "exploitation"          => "Humnan exploitation",
                "threats_conservation"  => "Threats and conservation",
                "fauna_status"          => "Fauna status",
                "bibliography"          => "Bibliography and credits",
            ],
            "forest_ecosystems"     => "Forest ecosystems",
            "essences"              => "OFAC forest essences",
            "ap"                    => "Protected Areas",
            "forest_management"     => "Forest Management",
            "context_human"         => "Human context",
            "context_legal"         => "Legal context",
            "context_physical_menu"     => [
                "geology"                  => "Geology",
                "hydrography"              => "Hydrography",
                "rainfall"                 => "Rainfall",
                "topography"               => "Topography",
            ],
            "forest_ecosystems_menu"     => [
                "mapping"                  => "Mapping the forest ecosystems",
                "landscapes"               => "Ecological landscapes",
                "maps"                     => "Interactive maps"
            ],
            "forest_management_menu"     => [
                "forest_production"        => "Forest production",
                "forest_certification"     => "Forest certfification",
                "forest_governance"        => "Forest governance",
                "forest_management"        => "Forest management"
            ],
            "context_human_menu"     => [
                "demography"               => "Demography and development",
                "population"               => "Population density",
                "impact"                   => "Impact of urban populations",
                "history"                  => "History of population settlement",
                "agriculture"              => "Agriculture, livestock production and the use of natural forest resources",
                "bibliography"             => "Bibliography"
            ],
        ],

        "monitoring_system" => [
            "monitoring_system"     => "Monitoring system",
            "introduction"          => "Introduction",
            "introduction_menu"    => [
                "national_collection"                => "National collections",
                "collection_management_site"                => "Collection in management sites",
                "forest_concessions"                => "Forest Concessions",
                "protected_area"                => "Protected Areas",
                "monitoring_permanent_plots"                    => "Monitoring of permanent plots"
            ],
            "national_indicators"   => "National Indicators",
            "conservation"          => "Biodiversity Conservation and valorization",
            "concessions"           => "Forest Concessions",
            "national_synthesis"    => "National synthesis",
            "regional_synthesis"    => "Regional synthesis",
            "imet"                  => "Protected Areas (IMET)",
            "analytical_platform"   => "OFAC analytical portal",

            "concessions_indicators" => "Forest Concessions Indicators",
        ],

        "activity_competencies" => [
            "activity_competencies"     => "Activities & Skills",
            "projects"                  => "Projects",
            "project"                   => "Project",
            "experts"                   => "Experts",
            "expert"                    => "Expert",
            "trainings"                 => "Trainings",
            "training"                  => "Training",
            "institutions"              => "Institutions",
        ],

        "publications" => [
            "publications"          => "Publications",
            "edf"                   => "State of the Forest",
            "edap"                  => "State of the Protected Areas",
            "other_publications"    => "Other OFAC publications ",
            "library"               => "Library",
            "policy_briefs"         => "Policy brief",
            "newsletter"         => "Newsletter",
        ],

        "cartography" => [
            "cartography"   => "Cartography",
            "geoportal"     => "COMIFAC Geoportal",
            "download"      => "GIS data download",
            "products"      => "Cartography products",
            "atlas"         => "Land Use Atlas",
            "inventory"     => "Geoportal Inventory",
        ],

    ],

    'admin' => [
        'admin_page'    =>  'Administration panel',
        'profile'       =>  'profile',
        'expert_cv'     =>  'Expert CV',

        'administration_tools' => 'administration tools',

        'application' => [
            'management'        => 'application management',
            'error_log'         => 'Error log ',
            'exception_log'     => 'Exceptions log',
            'activity_log'      => 'Activity log',
            'db_stats'          => 'Size of the database',
            'db_records'        => 'Contents of the tables in the database',
            'web_stats'         => 'Website statistics',

            'old_ofac_error_log' => 'old system (PostgreSQL query errors)',
            'new_laravel_error_log' => 'new system (Laravel exceptions)',
        ],

        'website' => [
            'management'    => 'Website management',
            'licenses'      => 'Licences',
            'press'         => '"Press"',
        ],

        'users' => [
            'user_management'   => 'Staff and users management',
            'role_management' => 'Roles and authorizations management',
            'national_form_roles'   => 'National forms roles',
            'regional_form_roles'   => 'Regional form roles',
            'concession_form_roles'   => 'Concession form roles',
            'imet_form_roles'   => 'IMET form roles',
        ],

        'knowledge_base'    => [
            'knowledge_base'    =>  'Knowledge base',
            'entities' => 'Administrative et geographical entities',
        ],

        'monitoring_system'     => [
            'monitoring_system' => 'Monitoring system',
            'national_level' => 'Data collection at National level',
            'site_level' => 'Data collection at management site level',
        ],
    ]

];
