<?php
return [

    'id'                    => 'ID',
    'name'                  => 'nom',
    'year'                  => 'année',
    'country'               => 'pays',
    'language'              => 'langue',
    'version'           => 'version',

    'staff' => [
        'first_name'            => 'prénom',
        'last_name'             => 'nom',
        'institution'           => 'organisation',
        'function'              => 'fonction',
        'confirm_user_info'         => 'S\'il vous plaît confirmer vos informations'
    ],

    'protected_area' => [
        'protected_area'    => 'aire protégée|aires protégées',
        'wdpa_id'           => 'code WDPA|codes WDPA',
        'iucn_category'     => 'catégorie UICN',
    ],

    'methodology'   => 'Question posée',
    'criteria'      => 'Notation',

    'terrestrial' => 'terrestre',
    'marine' => 'maritime et côtier',

    'dopa_not_available' => 'Services DOPA non disponibles',

    'languages' => [
        'fr'        => 'Français',
        'en'        => 'Anglais',
        'sp'        => 'Espagnol',
        'pt'        => 'Portugais'
    ],
    'switch_language' => 'Changer la langue actuelle en',

    'imet' => 'IMET: Outil intégré sur l’efficacité de gestion',
    'imet_short'        => 'IMET',

    'management'        => 'gestion des formulaires IMET',

    'encoding_language' => 'Langue d\'encodage',
    'encoders_responsible'      => 'Encodeurs and responsables',
    'encoders'                  => 'Encodeurs',
    'responsible_internal'      => 'Responsables (équipe de gestion)',
    'responsible_external'      => 'Responsables (support extérieur)',

    'supervisors'              => 'Superviseurs',
    'readonly'                 => 'Read-only',

    'encode'            => 'encoder',
    'show'              => 'visualiser',

    'context'           => 'Contexte',
    'evaluation'        => 'Évaluation',
    'cross_analysis'        => 'cross analysis',
    'report'            => 'rapport d\'analyse',
    'context_long'      => 'contexte d\'intervention',
    'evaluation_long'   => 'Évaluation de gestion',
    'cross_analysis_long'   => 'cross analysis',
    'report_long'       => 'rapport d\'analyse',

    'import_imet'       => 'Importer un IMET à partir d\'un fichier',
    'merge_tool'        => 'Outil de fusion',
    'destination_form'        => 'Formulaire de destination',
    'set_as_destination_form' => 'Utiliser comme formulaire de destination',
    'confirm_merge'     => 'Confirmer pour copier les données.',
    'upgrade'           => 'Convertir en IMET v2',
    'upgrade_confirm'   => 'Confirmer to convertir en IMET v2?<ul><li>Une copie du formulaire original sera créée.</li><li>Certaines données ne seront pas converties en v2</li>',
    'upgrade_success'   => 'Conversion en IMET v2 terminée avec succès',
    'upgrade_failed'    => 'Erreur lors de la conversion en IMET v2',
    'not_authorized_module' => 'Aucune autorisation de visualiser ces informations',
    'double_check_wdpa' => 'Assurez-vous de sélectionner la bonne WDPA',
    'nothing_to_evaluate' => 'Rien à évaluer',

    'synthetic_indicator' => 'indicateur synthese',
    'cross_analysis_info' => 'La fonction d’analyse croisée vise à identifier d’éventuelles incohérences dans les scores de l’analyse IMET. Elle cherche à savoir si les scores d’une paire (ou d’un triplet) de questions IMET sont significativement différents. Le seuil de différence significative est fixé à 20 points de pourcentage pour les questions mesurées sur l’échelle (min: 0 — max: 100). Vous trouverez ci-dessous les indicateurs pour lesquels une différence dépassant le seuil prédéfini a été identifiée dans votre évaluation. L’analyse croisée n’étant que consultative, aucune suggestion n’est fournie quant à la raison de la différence des valeurs ou aux éventuels changements qui pourraient être adoptés dans l’analyse. Les réponses fournies peuvent rester inchangées, mais les valeurs attribuées doivent être vérifiées ensemble à l’équipe de l’aire protégée. Des commentaires supplémentaires doivent aussi être ajoutés dans les indicateurs sélectionnés pour expliquer la différence de score significative ou pour les dispositions de gestion à adopter.',
    'nothing_found' => 'Aucun résultat trouvé',

    'indexes' => [
        'imet'        => 'IMET index',
        'context'     => 'Contexte index',
        'planning'    => 'Planification index',
        'inputs'      => 'Intrants index',
        'process'     => 'Processus index',
        'outputs'     => 'Resultats index',
        'outcomes'    => 'Effects et Impacts index',
    ],

    'steps_eval' => [
        'context'                   => 'Contexte de gestion',
        'planning'                  => 'Planification',
        'inputs'                    => 'Intrants',
        'process'                   => 'Processus',
        'outputs'                   => 'Resultats',
        'outcomes'                  => 'Effects et Impacts',
        'objectives'                => 'Objectifs',
        'management_effectiveness'  => 'Efficacité de gestion',
        'cross_analysis'  => 'Analyse croisée',
    ],

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

];
