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
    'cross_analysis_info' => 'Cross-analysis function aims to spot possible inconsistencies in IMET scores. It investigates whether scores within a pair (or a triplet) of IMET items were significantly different. The threshold for significant differences is set at the level of 20 percentage points for questions measured on the scale (min:0 – max:100). Below are provided those indicators, for which the difference exceeding the predefined threshold was established in your assessment. Since cross-analysis is for advisory purposes only, no suggestions are provided regarding the direction of discrepancy or possible changes that could be implemented. The responses can remain unchanged but should be double checked by the management team. Additional comments can be added in the selected questions to explain the significant score difference.',
    'nothing_found' => 'No se han encontrado resultados',

];
