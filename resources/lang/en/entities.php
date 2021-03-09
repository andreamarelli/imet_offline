<?php

return [

    'common' => [
        'id'                    => 'ID',
        'name'                  => 'name',
        'email'                 => 'email',
        'first_name'            => 'first name',
        'last_name'             => 'last name',
        'user'                  => 'user|users',
        'city'                  => 'city',
        'country'               => 'country',
        'address'               => 'address',
        'phone'                 => 'phone',
        'age'                   => 'age',
        'day'                   => 'day',
        'month'                 => 'month',
        'year'                  => 'year',
        'years'                 => 'years',
        'hour'                  => 'hour',
        'minute'                => 'minute',
        'second'                => 'second',
        'time'                  => 'time',
        'denomination'          => 'denomination',
        'denomination_acronym'  => 'acronym',
        'acronym'               => 'acronym',
        'full_name'             => 'full name',
        'title'                 => 'title',
        'sub_title'             => 'sub-title',
        'content'               => 'content',
        'description'           => 'description',
        'date'                  => 'date',
        'start_date'            => 'start date',
        'end_date'              => 'end date',
        'duration'              => 'duration',
        'last_update'           => 'last update',
        'last_update_date'      => 'last update date',
        'last_update_by'        => 'last update by',
        'created_by'            => 'created by',
        'creation_date'         => 'creation date',
        'domain'                => 'domain',
        'sub_domain'            => 'sub-domain',
        'typology'              => 'typology',
        'level'                 => 'level',
        'interactive_map'       => 'interactive map',
        'details'               => 'details',
        'url'                   => 'url',
        'user_agent'            => 'user agent',
        'keywords'              => 'keywords',
        'language'              => 'language',
        'observations'          => 'observations',
        'role'                  => 'role',
        'website'               => 'website',
        'file'                  => 'file',
        'logo'                  => 'logo',
        'abstract'              => 'abstract',
        'thumbnail'             => 'thumbnail',
        'basic_info'            => 'basic info',
        'all_countries'         => 'all countries',
        'all_sites'             => 'all sites',
        'sum'                   => 'sum',
        'difference'            => 'difference',
        'total'                 => 'total',
        'protected_area'        => 'protected_area'
    ],

    'dopa_not_available' => 'DOPA services not available',

    'staff' => [
        'name'                      => 'name',
        'persons_and_users'         => 'Staff and users',
        'institution'               => 'institution',
        'function'                  => 'function',
        'institution_and_function'  => 'institution and function',
        'role_ofac'                 => 'Role within OFAC',
        'general_info'              => 'general info',
        'auth'                      => 'user: authentication data',
        'rights'                    => 'rights',
        'project_owner'             => 'project_owner',
        'activity'                  => 'activity log',
        'contacts'                  => 'contacts',
        'responsibilities'          => 'responsibilities',
        'confirm_user_info'         => 'Please confirm your information'
    ],

    'biodiversity' => [

        'biodiversity'      => 'biodiversity',

        'species'           => 'species',

        'taxonomy' => [
            'taxonomy'      => 'taxonomy',
            'class'         => 'class',
            'order'         => 'order',
            'family'        => 'family',
            'genus'         => 'genus',
            'species'       => 'species',
            'authority'     => 'authority'
        ],

        'class' => [
            'mammals'       => 'mammals',
            'birds'         => 'birds',
            'reptiles'      => 'reptiles',
            'amphibians'    => 'amphibians',
            'butterflies'   => 'butterflies',
            'fishes'        => 'fishes',
        ],

        'common_names' => 'common names',
        'red_list'      => 'IUCN Red List',
        'red_list_id'   => 'IUCN Red List ID',
        'red_list_category' => 'IUCN Red List category',
        'red_list_categories' => [
            'EX' => 'Extinct',
            'EW' => 'Extint in the wild',
            'CR' => 'Critically Endangered',
            'EN' => 'Endangered',
            'VU' => 'Vulnerable',
            'NT' => 'Near Threatened',
            'LC' => 'Least Concern',
            'DD' => 'Data Deficient',
            'NE' => 'Not Evaluated'
        ],

        'essence' => [
            'essence'           => 'essence|essences',
            'pilot_name'        => 'pilot name (ATIBT)',
            'commercial_names'  => 'Commercial names',
            'scientific_names'  => 'Scientific names',
        ]
    ],

    'protected_area' => [
        'protected_area'    => 'protected area|protected areas',
        'wdpa_id'           => 'WDPA id|WDPA ids',
        'iucn_category'     => 'IUCN category',
    ],

    'landscape' => 'CBFP landscape|CBFP landscapes',
    'klc' =>       'Key Landscapes for Conservation (KLC)',

    'expert'=> [
        'expert'                => 'expert|experts',
        'type_profil'           => 'profile type',
        'nationality'           => 'nationality',
        'education'             => 'education',
        'education_degree'      => 'education degree',
        'education_field'       => 'education ield',
        'competence_domain'     => 'competence domain',
        'experience'            => 'year of experience',
    ],

    'gis_repository' => [
        'gis_repository' => 'GIS repository'
    ],

    'log' => [
        'activity_detail'       => 'activity detail',
        'error_detail'          => 'error detail',
        'exception_details'     => 'exception details',
        'request_details'       => 'request details',
        'sql'                   => 'sql',
        'entity'                => 'entity',
        'error_message'         => 'error message',
        'exception'             => 'exception',
        'trace_depth'           => 'trace depth',
        'stack_trace'           => 'stack trace',
        'first_exception'       => 'first exception',
        'count'                 => 'count',
        'referer'               => 'referer',
        'request'               => 'request',
        'path'                  => 'path',
        'method'                => 'method',
        'parameters'            => 'parameters',
        'line'                  => 'line',
        'severity'              => 'severity',
        'remove_all_exceptions' => 'remove all exceptions',
        'remove_all_errors'     => 'remove all errors',
    ],

    'library' => [
        'media' => 'media',
        'type'  => 'media type',
        'file'  => 'file type',
        'url'   => 'url',
    ]

];