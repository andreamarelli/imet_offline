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

    'dopa_not_available' => 'Servicios DOPA no disponibles',
    'languages' => [
        'fr'        => 'francés',
        'en'        => 'inglés',
        'sp'        => 'español',
        'pt'        => 'portugués'
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

    'synthetic_indicator' => 'Indicador sintético',
    'cross_analysis_info' => 'La función de análisis cruzado tiene como objetivo identificar posibles incoherencias en las puntuaciones del análisis IMET. Busca si las puntuaciones de un par (o triplete) de preguntas IMET son significativamente diferentes. El umbral para una diferencia significativa se establece en 20 puntos porcentuales para las preguntas medidas en la escala (mínimo: 0 - máximo: 100). A continuación, encontrará los indicadores para los que se ha identificado una diferencia que supera el umbral predefinido en su evaluación. Como el análisis de tabulación cruzada es sólo consultivo, no se ofrecen sugerencias sobre el motivo de la diferencia de valores ni sobre los posibles cambios que podrían adoptarse en el análisis. Las respuestas proporcionadas pueden permanecer sin cambios, pero los valores asignados deben ser comprobados junto con el equipo del área protegida. También se deben añadir comentarios adicionales en los indicadores seleccionados para explicar la diferencia de puntuación significativa o para las disposiciones de gestión que se adopten',
    'nothing_found' => 'No se han encontrado resultados',

];
