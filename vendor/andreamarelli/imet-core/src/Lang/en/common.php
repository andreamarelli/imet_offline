<?php
return [

    'id'                    => 'ID',
    'name'                  => 'nom',
    'year'                  => 'year',
    'country'               => 'country',
    'language'              => 'language',
    'version'               => 'version',

    'staff' => [
        'first_name'            => 'first name',
        'last_name'             => 'last name',
        'institution'           => 'institution',
        'function'              => 'function',
        'confirm_user_info'         => 'Please confirm your information'
    ],

    'protected_area' => [
        'protected_area'    => 'protected area|protected areas',
        'wdpa_id'           => 'WDPA id|WDPA ids',
        'iucn_category'     => 'IUCN category',
    ],

    'methodology'   => 'Evaluation question',
    'criteria'      => 'Rating',

    'terrestrial' => 'terrestrial',
    'marine' => 'marine and coastal',

    'dopa_not_available' => 'DOPA services not available',
    'no' => 'No',
    'yes' => 'Yes',

    'languages' => [
        'fr'        => 'French',
        'en'        => 'English',
        'sp'        => 'Spanish',
        'pt'        => 'Portuguese'
    ],
    'switch_language' => 'Switch current language to',

    'imet' => 'Integrated Management Effectiveness Tool',
    'imet_short'        => 'IMET',

    'management'        => 'IMET management',

    'encoding_language'         => 'Encoding language',
    'encoders_responsible'      => 'Encoders and responsibles',
    'encoders'                  => 'Encoders',
    'responsible_internal'      => 'Responsibles (management team)',
    'responsible_external'      => 'Responsibles (external support)',

    'supervisors'              => 'Supervisors',
    'readonly'                 => 'Read-only',

    'encode'            => 'encode',
    'show'              => 'show',

    'context'           => 'context',
    'evaluation'        => 'evaluation',
    'cross_analysis'    => 'cross analysis',
    'report'            => 'analysis report',
    'context_long'      => 'intervention context',
    'evaluation_long'   => 'management evaluation',
    'cross_analysis_long'   => 'cross analysis',
    'report_long'       => 'analysis report',

    'import_imet'       => 'Import IMET from file',
    'merge_tool'        => 'Merge Tool',
    'destination_form'        => 'Destination form',
    'set_as_destination_form' => 'Set as destination form',
    'confirm_merge'     => 'Confirm to copy data',
    'upgrade'           => 'Upgrade to IMET v2',
    'upgrade_confirm'   => 'Confirm to upgrade to IMET v2?<ul><li>A copy of the original form will be created.</li><li>Some data could not be converted to v2</li>',
    'upgrade_success'   => 'Upgrade to IMET v2 successfully completed',
    'upgrade_failed'    => 'Error in upgrading to IMET v2',
    'not_authorized_module' => 'No authorization to visualize this information',
    'double_check_wdpa' => 'Be sure to select the right WDPA',
    'nothing_to_evaluate' => 'Nothing to evaluate',

    'synthetic_indicator' => 'synthetic indicator',
    'cross_analysis_info' => 'Cross-analysis function aims to spot possible inconsistencies in IMET scores. It investigates whether scores within a pair (or a triplet) of IMET items were significantly different. The threshold for significant differences is set at the level of 20 percentage points for questions measured on the scale (min:0 – max:100). Below are provided those indicators, for which the difference exceeding the predefined threshold was established in your assessment. Since cross-analysis is for advisory purposes only, no suggestions are provided regarding the direction of discrepancy or possible changes that could be implemented. The responses can remain unchanged but should be double checked by the management team. Additional comments can be added in the selected questions to explain the significant score difference.',
    'nothing_found' => 'Nothing found',

    'indexes' => [
        'imet'        => 'IMET index',
        'context'     => 'Context index',
        'planning'    => 'Planning index',
        'inputs'      => 'Inputs index',
        'process'     => 'Process index',
        'outputs'     => 'Outputs index',
        'outcomes'    => 'Outcomes index',
    ],

    'steps_eval' => [
        'context'                   => 'Management context',
        'planning'                  => 'Planning',
        'inputs'                    => 'Inputs',
        'process'                   => 'Process',
        'outputs'                   => 'Outputs',
        'outcomes'                  => 'Outcomes',
        'objectives'                => 'Objectives',
        'management_effectiveness'  => 'Management Effectiveness',
        'cross_analysis'  => 'Cross Analysis',
    ],

    'Create' => [
        'title' => 'Create a new IMET (WDPA)',
        'fields' => [
            'version' => 'IMET version',
            'Year' => 'Year subject to evaluation',
            'wdpa_id' => 'protected area',
            'language' => 'language',
            'prefill_prev_year' => 'prefill with previous year',
        ]
    ],

    'CreateNonWdpa' => [
        'title' => 'Create a new IMET (non-WDPA)',
        'fields' => [
            'version' => 'version',
            'Year' => 'Year subject to evaluation',
            'wdpa_id' => 'protected area',
            'language' => 'language',
            'prefill_prev_year' => 'prefill with previous year',
            'pa_def' => 'definition',
            'name' => 'name as provided by the operator',
            'origin_name' => 'name in original language',
            'designation' => 'name of designation (ex. reserve, sanctuary park, etc.)',
            'designation_eng' => 'designation in English',
            'designation_type' => 'designation type',
            'marine' => 'typology',
            'rep_m_area' => 'surface of the protected conserved marine area [km<sup>2</sup>]',
            'rep_area' => 'surface of the protected conserved area [km<sup>2</sup>]',
            'status' => 'status',
            'ownership_type' => 'Ownership type',
            'status_year' => 'year of the enactment',
            'country' => 'country',
        ],

        'allowed_international' => 'Allowed values for international-level designations',
        'allowed_regional' => 'Allowed values for regional-level designations',
        'allowed_national' => 'No fixed values for protected areas designated at a national level',
    ],

    'ResponsablesInterviewers' => [
        'title' => 'Responsibility for filling the form: Management team and partners',
        'fields' => [
            'Name'          => 'name',
            'Institution'   => 'organisation',
            'Function'      => 'job role',
            'Contacts'      => 'contact details',
            'EncodingDate'  => 'Date of compilation',
            'EncodingDuration' => 'Time taken for evaluation (hrs)'
        ]
    ],

    'ResponsablesInterviewees' => [
        'title' => 'Responsibility for filling the form: External support for analysis and management evaluation',
        'fields' => [
            'Name' => 'Name',
            'Institution'   => 'organisation',
            'Function'      => 'job role',
            'Contacts' => 'contact details',
            'EncodingDate' => 'Date of compilation',
            'EncodingDuration' => 'Time taken for evaluation (hrs)',
        ]
    ],

];
