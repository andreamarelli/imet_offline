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

    'dopa_not_available' => 'Services DOPA non disponibles',

    'languages' => [
        'fr'        => 'français',
        'en'        => 'anglais',
        'sp'        => 'espagnol',
        'pt'        => 'portugais'
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

    'synthetic_indicator' => 'indicateur synthese',
    'cross_analysis_info' => 'Cross-analysis function aims to spot possible inconsistencies in IMET scores. It investigates whether scores within a pair (or a triplet) of IMET items were significantly different. The threshold for significant differences is set at the level of 20 percentage points for questions measured on the scale (min:0 – max:100). Below are provided those indicators, for which the difference exceeding the predefined threshold was established in your assessment. Since cross-analysis is for advisory purposes only, no suggestions are provided regarding the direction of discrepancy or possible changes that could be implemented. The responses can remain unchanged but should be double checked by the management team. Additional comments can be added in the selected questions to explain the significant score difference.',
    'nothing_found' => 'Aucun résultat trouvé',

];
