<?php
return [

    'id'                    => 'ID',
    'name'                  => 'nombre',
    'year'                  => 'año',
    'country'               => 'país',
    'language'              => 'idioma',
    'version'            => 'versión',

    'staff' => [
        'first_name'            => 'nombre',
        'last_name'             => 'apellido',
        'institution'           => 'institución',
        'function'              => 'function',
        'confirm_user_info'         => 'Confirma tu información'
    ],

    'protected_area' => [
        'protected_area'    => 'área protegida|áreas protegidas',
        'wdpa_id'           => 'WDPA id|WDPA ids',
        'iucn_category'     => 'Categoría UICN',
    ],

    'methodology'   => 'Pregunta de evaluación',
    'criteria'      => 'Clasificación',

    'terrestrial' => 'terrestre',
    'marine' => 'marítimo y costero',
    
    'dopa_not_available' => 'Servicios DOPA no disponibles',

    'languages' => [
        'fr'        => 'Francés',
        'en'        => 'Inglés',
        'sp'        => 'Español',
        'pt'        => 'Portugués'
    ],
    'switch_language' => 'Cambiar el idioma actual a',

    'imet' => 'IMET: por sus siglas en inglés Herramienta de Efectividad de Manejo Integral',
    'imet_short'        => 'IMET',

    'management'        => 'Gestión del IMET',

    'encoding_language'         => 'Lenguaje de codificación',
    'encoders_responsible'      => 'Codificadores y responsables',
    'encoders'                  => 'Codificadores',
    'responsible_internal'      => 'Responsables (equipo directivo)',
    'responsible_external'      => 'Responsables (apoyo externo)',

    'supervisors'              => 'Supervisores',
    'readonly'                 => 'Sólo lectura',

    'encode'            => 'codificar',
    'show'              => 'mostrar',

    'context'           => 'contexto',
    'evaluation'        => 'evaluación',
    'cross_analysis'        => 'cross analysis',
    'report'            => 'informe de análisis',
    'context_long'      => 'contexto de intervención',
    'evaluation_long'   => 'evaluación de la gestión',
    'cross_analysis_long'   => 'cross analysis',
    'report_long'       => 'informe de análisis',

    'import_imet'       => 'Importar IMET desde un archivo',
    'merge_tool'        => 'Herramienta de combinación',
    'destination_form'        => 'Formulario de destino',
    'set_as_destination_form' => 'Establecer como forma de destino',
    'confirm_merge'     => 'Confirmar para copiar de datos',
    'upgrade'           => 'Actualización a IMET v2',
    'upgrade_confirm'   => 'Confirmar la actualización a IMET v2?<ul><li>Se creará una copia del formulario original.</li><li>Algunos datos no han podido ser convertidos a v2</li>',
    'upgrade_success'   => 'Actualización a IMET v2 completada con éxito',
    'upgrade_failed'    => 'Error al actualizar a IMET v2',
    'not_authorized_module' => 'Sin autorización para visualizar esta información',
    'double_check_wdpa' => 'Asegúrese de seleccionar la WDPA correcta',
    'nothing_to_evaluate' => 'Nada que evaluar',

    'synthetic_indicator' => 'Indicador sintético',
    'cross_analysis_info' => 'La función de análisis cruzado tiene como objetivo identificar posibles incoherencias en las puntuaciones del análisis IMET. Busca si las puntuaciones de un par (o triplete) de preguntas IMET son significativamente diferentes. El umbral para una diferencia significativa se establece en 20 puntos porcentuales para las preguntas medidas en la escala (mínimo: 0 - máximo: 100). A continuación, encontrará los indicadores para los que se ha identificado una diferencia que supera el umbral predefinido en su evaluación. Como el análisis de tabulación cruzada es sólo consultivo, no se ofrecen sugerencias sobre el motivo de la diferencia de valores ni sobre los posibles cambios que podrían adoptarse en el análisis. Las respuestas proporcionadas pueden permanecer sin cambios, pero los valores asignados deben ser comprobados junto con el equipo del área protegida. También se deben añadir comentarios adicionales en los indicadores seleccionados para explicar la diferencia de puntuación significativa o para las disposiciones de gestión que se adopten',
    'nothing_found' => 'No se han encontrado resultados',

    'indexes' => [
        'imet'        => 'IMET index',
        'context'     => 'Índice de contexto',
        'planning'    => 'Índice de planificación',
        'inputs'      => 'Índice de insumos',
        'process'     => 'Índice de procesos',
        'outputs'     => 'Índice de resultados',
        'outcomes'    => 'Índice de Efectos/impactos',
    ],

    'steps_eval' => [
        'general_info'              => 'Información general',
        'context'                   => 'Contexto de gestión',
        'planning'                  => 'Planificación',
        'inputs'                    => 'Insumos',
        'process'                   => 'Procesos',
        'outputs'                   => 'Resultados',
        'outcomes'                  => 'Efectos/impactos',
        'objectives'                => 'Objetivos',
        'management_effectiveness'  => 'Efectividad de manejo',
    ],

    'Create' => [
        'title' => 'Crear un nuevo IMET (WDPA)',
        'fields' => [
            'version' => 'versión',
            'Year' => 'Año sujeto a evaluación',
            'wdpa_id' => 'área protegida',
            'language' => 'idioma',
            'prefill_prev_year' => 'Pre-rellenado con el año anterior',
        ]
    ],

    'CreateNonWdpa' => [
        'title' => 'Crear un nuevo IMET (no WDPA)',
        'fields' => [
            'version' => 'versión',
            'Year' => 'Año sujeto a evaluación',
            'wdpa_id' => 'área protegida',
            'language' => 'idioma',
            'prefill_prev_year' => 'Pre-rellenado con el año anterior',
            'pa_def' => 'definición',
            'name' => 'nombre proporcionado por el operador',
            'origin_name' => 'nombre en idioma original',
            'designation' => 'nombre de la designación (por ejemplo, reserva, santuario, etc.)',
            'designation_eng' => 'designación obligatoria en Inglés',
            'designation_type' => 'Tipo de designación',
            'marine' => 'tipología',
            'rep_m_area' => 'superficie del área protegida marina conservada [km<sup>2</sup>]',
            'rep_area' => 'superficie del área protegida conservada [km<sup>2</sup>]',
            'status' => 'estado',
            'ownership_type' => 'Tipo de propiedad',
            'status_year' => 'año de promulgación del estatuto',
            'country' => 'país',
        ],

        'allowed_international' => 'Allowed values for international-level designations',
        'allowed_regional' => 'Allowed values for regional-level designations',
        'allowed_national' => 'No fixed values for protected areas designated at a national level',
    ],

    'ResponsablesInterviewers' => [
        'title' => 'Responsabilidad para el llenado del formulario: Personal del área protegida y socios',
        'fields' => [
            'Name'          => 'Nombre',
            'Institution'   => 'Organización',
            'Function'      => 'Rol en el trabajo',
            'Contacts'      => 'Datos de contacto',
            'EncodingDate'  => 'Fecha de compilación',
            'EncodingDuration' => 'Tiempo necesario para completar la evaluación (horas)'
        ]
    ],

    'ResponsablesInterviewees' => [
        'title' => 'Responsabilidad de llenar el formulario: Apoyo externo para el análisis y la evaluación de la gestión',
        'fields' => [
            'Name' => 'Nombre',
            'Institution'   => 'Organización',
            'Function'      => 'Rol en el trabajo',
            'Contacts' => 'Datos de contacto',
            'EncodingDate' => 'Fecha de compilación',
            'EncodingDuration' => 'Tiempo de evaluación (horas)',
        ]
    ],
];
