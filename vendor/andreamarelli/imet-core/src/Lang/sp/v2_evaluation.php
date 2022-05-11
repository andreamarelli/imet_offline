<?php

return [

    '_Objectives' => [
        'title' => 'Descripción de objetivos',
        'fields' => [
            'Element' => 'Elemento/Indicador',
            'Status' => 'Línea de base',
            'Objective' => 'Objetivo - Estado de conservación favorable',
            'comments' => 'Comentarios'
        ],
    ],

    'ImportanceClassification' => [
        'title' => 'Designaciones',
        'fields' => [
            'Aspect' => 'Criterios - Concepto medido - Variable',
            'EvaluationScore' => 'Integración',
            'SignificativeClassification' => 'Designación internacional de gran importancia',
            'Comments' => 'Comentarios/explicaciones',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'no hay integración',
                '1' => 'baja integración',
                '2' => 'integración moderada',
                '3' => 'alta integración',
            ]
        ],
        'module_subTitle' => 'Valor e importancia - Designaciones',
        'module_info_EvaluationQuestion' => [
            '¿Ha incluido el área protegida los valores y la importancia de las designaciones nacionales, regionales o internacionales en la gestión de la misma?'
        ],
        'module_info_Rating' => [
            'Evaluar la integración de los valores y la importancia de las designaciones (designación nacional y designación internacional, por ejemplo, sitio del Patrimonio Mundial o sitio Ramsar) en la gestión del área protegida'
        ]
    ],

    'ObjectivesClassification' => [
        'module_info' => 'Establecer y describir los objetivos de conservación para <b>la(s) actual(es) designación(es) nacional(es), regional(es) o internacional(es) </b>del área protegida<br /> Los objetivos que se indican a continuación se utilizarán para mejorar la gestión y, más concretamente, para la planificación, la movilización de recursos (insumos), las fases del proceso y el seguimiento de las actividades de gestión del área protegida.'
    ],

    'ImportanceSpecies' => [
        'title' => 'Especies clave',
        'fields' => [
            'Aspect' => 'Criterios - Concepto medido - Variable',
            'EvaluationScore' => 'Integración',
            'SignificativeSpecies' => 'Especie altamente representativa',
            'IncludeInStatistics' => 'Priorizar en la gestión',
            'Comments' => 'Comentarios/explicación',
        ],
        'groups' => [
            'group0' => 'Identificar la especie animal (buque insignia, en peligro de extinción, endémica, ...) elegida como especie clave',
            'group1' => 'Identificar las especies de plantas (emblemáticas, en peligro de extinción, endémicas, ...) elegidas como especies clave',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'no hay integración',
                '1' => 'baja integración',
                '2' => 'integración moderada',
                '3' => 'alta integración',
            ]
        ],
        'module_subTitle' => 'Identificar las especies animales (emblemáticas o bandera, en peligro, endémicas, etc.) elegidas como especies clave',
        'module_info_EvaluationQuestion' => [
            '¿Se han identificado e integrado claramente las especies clave en la gestión del área protegida?'
        ],
        'module_info_Rating' => [
            'Evaluar el nivel de integración de 3 a 10 especies clave en la gestión del área protegida (sobre la base de un análisis del Contexto de Intervención, puntos 4.1 y 4.2, que se informa automáticamente a continuación). La representatividad de una especie clave corresponde al grado en que ésta: i) representa una característica natural fuerte de un hábitat, ecosistema o bioma; ii) influye en un proceso o comunidad ecológica o iii) afecta a una política de gestión dirigida por la especie)'
        ],
        'validation_3to10' => 'Por favor, incluya en las estadísticas no menos de 3 y no más de 10 de las especies clave',
        'warning_on_save' =>
            'ADVERTENCIA!! <br /> Cualquier modificación puede causar la pérdida de datos en
            los módulos de evaluación (si ya se ha codificado):<br /><i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'ObjectivesSpecies' => [
        'module_info' => 'Establecer y describir los objetivos de conservación de <b>especies (emblemáticas o bandera, en peligro, endémicas, explotadas, invasoras o sobre las que no hay datos suficientes) </b> en el área protegida.<br /> Los objetivos que se indican a continuación se utilizarán para mejorar la gestión y, más concretamente, para la planificación, la movilización de recursos (insumos), las fases del proceso y la supervisión de las actividades de gestión del área protegida.'
    ],

    'ImportanceHabitats' => [
        'title' => 'Hábitats terrestre y marino (cobertura de suelo, cambio de uso de suelo y ocupación del territorio)',
        'fields' => [
            'Aspect' => 'Criterio - Concepto medido - Variables',
            'EvaluationScore' => 'Integración',
            'EvaluationScore2'=> 'Valor/importancia regional y mundial',
            'IncludeInStatistics' => 'Priorizar en la gestión',
            'Comments' => 'Comentarios/explicación',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'no hay integración',
                '1' => 'baja integración',
                '2' => 'integración moderada',
                '3' => 'alta integración',
            ],
            'EvaluationScore2' => [
                '1' => 'bajo valor/importancia',
                '2' => 'valor moderado/importancia',
                '3' => 'alto valor/importancia',
            ],
        ],
        'module_subTitle' => 'Valor e importancia - Hábitats terrestres y marinos - cobertura de suelo, cambio de uso de suelo y ocupación del territorio',
        'module_info_EvaluationQuestion' => [
            '¿Ha identificado e integrado claramente el área protegida los hábitats terrestres y marinos más importantes y las dimensiones relacionadas de la cobertura de suelo, cambio de uso de suelo y ocupación del territorio en la gestión del área protegida?'
        ],
        'module_info_Rating' => [
            'Evaluar el nivel de integración en la gestión del área protegida de 3 a 10 de los hábitats y dimensiones relacionadas más representativas e importantes de los tipos de cobertura de suelo, cambio de uso de suelo y ocupación del territorio (sobre la base del análisis del Contexto de la intervención, puntos 4.3, que se informa automáticamente a continuación). (El valor/importancia regional y mundial de los hábitats es un grado en el cual - i - representa a nivel regional o mundial el entorno natural de plantas o animales clave; ii) influye en un proceso ecológico o en una comunidad y - iii) - afecta una política de gestión dirigida a los hábitats)'
        ],
        'validation_3to10' => 'Por favor, incluya en las estadísticas no menos de 3 y no más de 10 de las especies clave',
        'warning_on_save' =>
            'ADVERTENCIA!! <br /> Cualquier modificación puede causar la pérdida de datos en
            los módulos de evaluación (si ya se ha codificado):<br /><i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'ObjectivesHabitats' => [
        'module_info' => 'Establecer y describir los objetivos de conservación para mantener los <b>hábitats terrestres y marinos y las dimensiones relacionadas de la cobertura de suelo, el cambio de uso de suelos  y la ocupación del territorio</b> del área protegida.<br /> Los objetivos (productos y resultados) que se indican a continuación se utilizarán para mejorar la gestión y, más concretamente, para la planificación, la movilización de recursos (insumos), las fases del proceso y la supervisión de las actividades de gestión en el área protegida.'
    ],

    'ImportanceClimateChange' => [
        'title' => 'Cambio climático',
        'fields' => [
            'Aspect' => 'Criterios - Concepto medido - Variable',
            'EvaluationScore' => 'Integración',
            'IncludeInStatistics' => 'Priorizar en la gestión',
            'Comments' => 'Comentarios/explicación',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento no está relacionado con la gestión del área protegida',
                '0' => 'no hay integración',
                '1' => 'baja integración',
                '2' => 'integración moderada',
                '3' => 'alta integración',
            ]
        ],
        'module_subTitle' => 'Valores y Importancia - Cambio Climático',
        'module_info_EvaluationQuestion' => [
            '¿Se han identificado e integrado claramente los elementos clave (especies, hábitats, etc.) más vulnerables al cambio climático para adoptar las mejores medidas de adaptación disponibles en la gestión del área protegida?'
        ],
        'module_info_Rating' => [
            'Evaluar el nivel de integración de los elementos clave más importantes (especies, hábitats, etc.) más vulnerables al cambio climático (sobre la base del análisis del Contexto de Intervención, puntos CTX6.1, que se informa automáticamente a continuación) en la gestión del área protegida.'
        ],
        'warning_on_save' =>
            'ADVERTENCIA!! <br /> Cualquier modificación puede causar la pérdida de datos en
            los módulos de evaluación (si ya se ha codificado):<br /><i>I1</i>, <i>PR7</i>, <i>PR17</i> and <i>O/C2</i>'
    ],

    'ObjectivesClimateChange' => [
        'module_info' => 'Establecer y describir los objetivos de conservación a los <b> efectos más significativos del cambio climático</b> en el área protegida<br /> Los objetivos que se indican a continuación se utilizarán para mejorar la gestión, y más concretamente para la planificación, la movilización de recursos (insumos), las fases del proceso y el seguimiento de las actividades de gestión del área protegida.'
    ],

    'ImportanceEcosystemServices' => [
        'title' => 'Servicios y funciones ecosistémicas',
        'fields' => [
            'Aspect' => 'Criterio - Concepto medido - Variable',
            'EvaluationScore' => 'Clasificación',
            'IncludeInStatistics' => 'Priorizar en la gestión',
            'Comments' => 'Comentarios/explicación',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento no está relacionado con la gestión del área protegida',
                '0' => 'no hay integración',
                '1' => 'baja integración',
                '2' => 'integración moderada',
                '3' => 'alta integración',
            ]
        ],
        'module_subTitle' => 'Valor e importacial de los Servicios y Funciones Ecosistémicas',
        'module_info_EvaluationQuestion' => [
            '¿Ha identificado e integrado claramente en la gestión del área protegida los servicios/funciones ecosistémicas más importantes para el bienestar humano?'
        ],
        'module_info_Rating' => [
            'Evaluar el nivel de integración en la gestión del área protegida de los Servicios/Funciones Ecosistémicas más importantes (basado en el análisis del Contexto del punto de intervención CTX7.1, que se informa automáticamente a continuación)'
        ],
        'warning_on_save' =>
            'ADVERTENCIA!! <br /> Cualquier modificación puede causar la pérdida de datos en
            los módulos de evaluación (si ya se ha codificado):<br /><i>I1</i>, <i>PR7</i>, <i>PR18</i> and <i>O/C2</i>'
    ],

    'ObjectivesEcosystemServices' => [
        'module_info' => 'Establecer y describir los objetivos de conservación para <b>preservar los servicios/funciones ecosistémicas</b> en el área protegida<br /> Los objetivos que se indican a continuación se utilizarán para mejorar la gestión y, más concretamente, para la planificación, la movilización de recursos (insumos), las fases de los procesos y la supervisión de las actividades de gestión del área protegida.'
    ],

    'SupportsAndConstraints' => [
        'title' => 'Limitaciones/conflictos externas o factores de apoyo/cumplimiento',
        'fields' => [
            'Aspect' => 'Criterio - Concepto medido - Variable',
            'EvaluationScore' => 'Influencia/poder de los actores en general',
            'EvaluationScore2'=> 'Nivel de la restricción/conflicto o del apoyo/cumplimiento',
            'Comments' => 'Comentarios/explicación',
        ],
        'groups' => [
            'group0' => 'Comunidad local',
            'group1' => 'Gobierno',
            'group2' => 'Donantes, Científicos, Investigadores y ONGs',
            'group3' => 'Operadores/actores económicos',
        ],
        'predefined_values' => [
            'group0' => [
                'Autoridades tradicionales locales',
                'Pueblos Indígenas y/o campesinos',
                'Comunidades que viven cerca o en el área protegida',
                'Comunidades que no viven cerca o en el área protegida',
                'Titulares con derechos',
                'Propietarios',
                'Usuarios locales de los recursos naturales',
                'Usuarios locales de productos forestales no maderables (PFNM)',
                'Grupos subrepresentados o desfavorecidos',
            ],
            'group1' => [
                'Gobierno central',
                'Gobierno local',
                'Consejo territorial, departamental y municipal',
                'Autoridad de las áreas protegidas (Comité de gestión)',
                'Autoridades y servicios de gestión del territorio y suelos (Autoridades Ambientales regionales y urbanas en Colombia, INRA, ABT en Bolivia, Servicio Forestal y Fauna Silvestre en Perú, etc.)',
                'Representantes de las poblaciones locales (representantes parlamentarios, etc.)',
                'Fuerzas armadas (policía, fuerzas armadas terrestres y marina)',
            ],
            'group2' => [
                'ONG de derechos sociales',
                'ONG medioambientales',
                'Científicos/investigadores',
                'Donantes',
            ],
            'group3' => [
                'Operadores privados de turismo',
                'Operadores forestales',
                'Los operadores de pesca',
            ],
        ],

        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'Este actor general no participa en el proceso',
                '1' => 'Baja influencia/poder',
                '2' => 'Influencia/poder moderado',
                '3' => 'Alta influencia/poder'
            ],
            'EvaluationScore2' => [
                '-3' => 'Severas limitaciones/conflictos generadas por este actor',
                '-2' => 'Restricciones generadas por este actor',
                '-1' => 'Algunas limitaciones/conflictos generadas por este actor',
                '0' => 'No existe apoyo/cumplimiento por parte de este actor',
                '+1' => 'Algo de apoyo/cumplimiento por parte de este actor',
                '+2' => 'Apoyo/cumplimiento por parte de este actor',
                '+3' => 'Apoyo/cumplimiento importante por parte de este actor',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿La gestión del área protegida está sujeta a limitaciones/conflictos o se beneficia de factores de apoyo/cumplimiento derivados del entorno político, institucional y social externo?',
            '<i>El entorno político, institucional y civil puede obstruir (limitaciones/conflictos externas) o facilitar (apoyos/cumplimientos externos) las actividades de conservación del área protegida. Las limitaciones/conflictos o apoyos/cumplimientos del entorno político, institucional y civil externo pueden medirse por su intensidad y por la influencia/poder de los socios directos en la limitación o el apoyo/cumplimiento del área protegida.</i>'
        ],
        'module_info_Rating' => [
            'Evaluar las limitaciones/conflictos o factores de apoyo/cumplimiento más importantes del entorno político, institucional y civil externo en la gestión del área protegida'
        ]
    ],

    'ObjectivesSupportsAndConstraints' => [
        'module_info' => 'Establecer y describir los objetivos de conservación para <b>limitaciones/conflictos o factores de apoyo/cumplimiento </b>para el área protegida <br /> Los objetivos que se indican a continuación se utilizarán para mejorar la gestión y, más concretamente, para la planificación, la movilización de recursos (insumos), las fases del proceso y la supervisión de las actividades de gestión del área protegida.'
    ],

    'Menaces' => [
        'title' => 'Amenazas',
        'fields' => [
            'Aspect' => 'Evaluación de amenazas (reportada automáticamente desde CTX 5.1)',
            'IncludeInStatistics' => 'Priorizar en la gestión',
            'Comments' => 'Comentarios/explicación',
        ],
        'module_info_EvaluationQuestion' => [
            '¿Se han identificado e integrado claramente las amenazas (presiones, amenazas y vulnerabilidades) que podrían afectar a la biodiversidad, el patrimonio cultural, los servicios o funciones ecosistémicas, etc. en la gestión del área protegida?'
        ],
        'module_info_Rating' => [
            'Evaluar el nivel de integración de las amenazas más importantes en la gestión del área protegida sobre la base del análisis de la calculadora de amenazas en el punto Contexto de intervención CTX 5.1 y de la que se informa automáticamente a continuación.'
        ],
        'warning_on_save' =>
            'ADVERTENCIA!! <br /> Cualquier modificación puede causar la pérdida de datos en
            los módulos de evaluación (si ya se ha codificado):<br /><i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'ObjectivesMenaces' => [
        'module_info' => 'Establecer y describir los objetivos de conservación para for <b>las amenazas más importantes a las que se enfrenta</b>  el área protegida<br /> Los objetivos que se indican a continuación se utilizarán para mejorar la gestión y, más concretamente, para la planificación, la movilización de recursos (insumos), las fases del proceso y el seguimiento de las actividades de gestión del área protegida.'
    ],

    'RegulationsAdequacy' => [
        'title' => 'Adecuación de las disposiciones legales y reglamentarias',
        'fields' => [
            'Regulation' => 'Criterio - Concepto medido - Variables',
            'EvaluationScore' => 'Adecuación',
            'Comments' => 'Comentarios/explicación',
        ],
        'predefined_values' => [
            'Disposiciones legales y designación (por ejemplo, parque nacional)',
            'Claridad de la demarcación legal del área protegida (por ejemplo, límites naturales como ríos, límites no naturales, derechos consuetudinarios, enclaves, etc.)',
            'Normas internas para la gestión del área protegida',
            'Ratificación y aplicación de las convenciones internacionales (CITES, CDB, Nagoya, CMS, Patrimonio Mundial, RAMSAR, etc.)',
            'Leyes sobre áreas protegidas y conservación',
            'Leyes sobre la gestión de los recursos naturales (complementarias de las leyes sobre conservación)',
            'Leyes y convenciones sobre la investigación de la biodiversidad y los recursos naturales',
            'Leyes sobre los derechos de la tierra',
            'Derecho consuetudinario',
            'XXXXXXXXX Voluntary agreements, including public private partnerships (which can include e.g., voluntary biodiversity offset schemes)',
            'XXXXXXXXX Taxes, charges, user fees (e.g. entrance fees to marine parks)',
            'XXXXXXXXX Certification, eco labelling (e.g. MSC Marine Stewardship Council)',
            'XXXXXXXXX Spatial and temporal fishing closures; limits on number and size of vessels (input controls); other re-strictions or prohibitions on use (e.g. CITES)',
            'XXXXXXXXX Standards (e.g. MARPOL for ships); bans on dynamite fishing or fishing gear',
            'XXXXXXXXX Catch limits or quotas (output controls)',
            'XXXXXXXXX Licenses e.g. aquaculture and offshore windfarms'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '0' => 'Completamente inadecuado',
                '1' => 'Algo inadecuado',
                '2' => 'Adecuado',
                '3' => 'Completamente adecuado',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Son adecuadas las actuales disposiciones legales y reglamentarias para actividades de conservación y gestión de los recursos naturales en el área protegida?',
            '<i>Una legislación y disposiciones reglamentarias adecuadas, son la base de un marco de gobernanza, gestión eficaz y sólido para el área protegida y, lo que es más importante, para garantizar su sostenibilidad a largo plazo para generaciones actuales y futuras</i>'
        ],
        'module_info_Rating' => [
            'Identificar y evaluar la pertinencia de las actuales disposiciones legales y reglamentarias para la conservación y la gestión de los recursos naturales en el área protegida'
            ]
    ],

    'DesignAdequacy' => [
        'title' => 'Diseño y disposición del área protegida',
        'fields' => [
            'Values' => 'Criterio - Concepto medido - Variables',
            'EvaluationScore' => 'Adecuación',
            'Comments' => 'Comentarios/explicación',
        ],
        'predefined_values' => [
            'Tamaño (superficie)',
            'Configuración o forma del área protegida (punto CTX 2.1)',
            'Relación límite/área, valor basado en el análisis del contexto de la intervención, punto CTX 2',
            'Zona fronteriza (zonas cercanas a las fronteras inmediatamente fuera del área protegida que tienen normas especiales sobre el uso de los recursos)',
            'Áreas de amortiguamiento (zonas que rodean una área protegida, en las que se lleva a cabo una gestión especial de la utilización de los recursos y se adoptan medidas especiales de desarrollo a fin de aumentar el valor de conservación del área protegida).',
            'Corredores',
            'Integridad de las cuencas hidrográficas',
            'XXXXXXXXX No-Use zone',
            'XXXXXXXXX No-take zone',
            'XXXXXXXXX Buffer zones for traditional use',
            'XXXXXXXXX Buffer zones for educational and/or recreational activities',
            'XXXXXXXXX Multi-use zone'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '0' => 'Totalmente inadecuado',
                '1' => 'Algo inadecuad',
                '2' => 'Adecuado',
                '3' => 'Totalmente adecuado',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿El diseño y la disposición del área protegida son adecuados para proteger las especies, los hábitats y otros valores y mantener los procesos naturales (por ejemplo, las cuencas hidrográficas)?',
            'Base metodológica: El diseño y la disposición (configuración espacial) afectan a la gestión de los ecosistemas, la biodiversidad y otros valores de un área  protegida. El diseño de las áreas protegidas para proteger los valores es complicado y no todas las zonas protegidas tienen un diseño y una disposición óptimos para representar y mantener sus ecosistemas, su biodiversidad y otros valores. La configuración espacial actual del área protegida debería evaluarse con respecto al objetivo de conservar sus valores clave. El análisis debería mostrar si el diseño y la disposición son adecuados para proteger plenamente los ecosistemas representativos, la biodiversidad y otros valores, o si se debería proponer una disposición mejorada, si es factible.'
        ],
        'module_info_Rating' => [
            'Evaluar si el diseño y la disposición del área protegida (basado en el análisis del Contexto del punto de intervención CTX2) es adecuado para asegurar que sus valores clave están protegidos y pueden ser bien gestionados.'
        ]
    ],

    'BoundaryLevel' => [
        'title' => 'Demarcación del área protegida',
        'fields' => [
            'Boundaries' => 'Grado de los límites marcados',
            'BoundariesComments' => 'Comentarios/explicación',
            'Adequacy' => 'Adecuación de los límites',
            'EvaluationScore' => 'Adecuación',
            'Comments' => 'Comentarios/explicación',
        ],
        'predefined_values' => [
            'Correspondencia de los límites marcados con respecto a la situación jurídica',
            'Adecuación de los límites marcados',
            'Límites marcados por elementos naturales (por ejemplo, ríos)',
            'Límites claramente demarcados, inequívocos y, por lo tanto, fáciles de interpretar (por ejemplo, señales, postes, marcadores, cercas, boyas, etc.)',
            'Reconocimiento de los límites por parte de las autoridades',
            'Reconocimiento de los límites por parte de las comunidades/usuarios',
            'Enfoque de colaboración que incluye agencias nacionales y partes interesadas relevantes en la demarcación de fronteras',
            'Publicación de información de la demarcación de fronteras',
            'Demarcación y desarrollo de los límites legales en consonancia con los estatutos jurídicos y el derecho internacional, de ser necesario',
            'Demarcación utilizando la fuente oficial de datos de referencia',
            'Límites registrados con coordenadas geográficas (grado, min, seg)',
            'Demarcación de las zonas de uso de la AP (zonificación)',
            'XXXXXXXXX Demarcation of boundaries, or part of them, that are ambulatory [e.g. banks, rivers, etc.] and may need to be revised',
            'XXXXXXXXX Demarcation by natural elements using a clear statement (e.g. tidal or river flooding data – average low water, average high water, etc.)'
        ],
        'ratingLegend' => [
            'Boundaries' => [
                '0' => '0–15%',
                '1' => '16–30%',
                '2' => '31–45%',
                '3' => '46–60%',
                '4' => '61–75%',
                '5' => '76–90%',
                '6' => '91–100%'
            ],
            'EvaluationScore' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '0' => 'Totalmente inadecuado (0-30% de las necesidades)',
                '1' => 'Algo inadecuado (31-60% de las necesidades)',
                '2' => 'Adecuado (61-90% de las necesidades)',
                '3' => 'Totalmente adecuado (91-100% de las necesidades)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿El límite del área protegida está marcado y es adecuado?',
            'La demarcación física de un área protegida es en general una obligación legal. La demarcación del límite cumple los requisitos para señalar cuál es el límite del área protegida establecido por la legislación específica. La demarcación de las áreas protegidas es útil desde el punto de vista jurídico, ya que permite definir exactamente dónde aplicar el marco jurídico específico (es decir, aplicar sanciones). Cabe señalar, sin embargo, que si bien es útil, la demarcación no es por sí misma una medida de protección suficiente y el conocimiento y la aceptación de los límites del área protegida por los interesados directos es necesario para la conservación.'
        ],
        'module_info_Rating' => [
            'Evaluar  <ol type="A"><li>el grado de delimitación del área protegida</li><li>la adecuación de la demarcación de los límites para la gestión del área protegida</li></ol>'
        ]
    ],

    'ManagementPlan' => [
        'title' => 'Plan de Gestión, Plan Rector o Plan de Manejo',
        'fields' => [
            'PlanExistence' => 'A) ¿Existe un plan de gestión?',
            'PlanUptoDate' => '¿Está actualizado el plan de gestión?',
            'PlanApproved' => '¿Se ha aprobado el plan de gestión?',
            'PlanImplemented' => '¿Se ha aplicado el plan de gestión?',
            'VisionAdequacy' => 'B) Adecuación de la visión, misión y objetivos del plan de gestión a las necesidades de conservación',
            'PlanAdequacyScore' => 'C) Adecuación en cuanto a la claridad y aplicabilidad',
            'Comments' => 'Comentarios / Explicación',
        ],
        'ratingLegend' => [
            'VisionAdequacy' => [
                '0' => 'La visión, la misión y los objetivos del plan de gestión son totalmente inadecuados',
                '1' => 'La visión, la misión y los objetivos del plan de gestión son algo inadecuados',
                '2' => 'La visión, misión y objetivos del plan de gestión son adecuados',
                '3' => 'La visión, misión y objetivos del plan de gestión son totalmente adecuados'
              ],
              'PlanAdequacyScore' => [
                  '0' => 'La claridad y aplicabilidad de la visión, misión y objetivos son totalmente inadecuadas (0-30% de las necesidades)',
                  '1' => 'La claridad y la aplicabilidad de la visión, la misión y los objetivos son algo inadecuados (31-60% de las necesidades)',
                  '2' => 'La claridad y la aplicabilidad de la visión, la misión y los objetivos son adecuados (61-90% de las necesidades)',
                  '3' => 'La claridad y la aplicabilidad de la visión, la misión y los objetivos son plenamente adecuados (91-100% de las necesidades)'
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Existe un plan de gestión, es adecuado y práctico de aplicar para el área protegida?',
            'El Plan de Gestión es un documento que establece el enfoque y los objetivos de gestión, junto con un marco para la toma de decisiones, que se aplica a un área protegida específica durante un período de tiempo determinado. Para el éxito del plan es fundamental la consulta más amplia posible con los interesados directos y la elaboración de objetivos que puedan ser acordados y a los que puedan adherirse todos los que tengan interés en el uso y la supervivencia continua del área en cuestión (de la UICN: Directrices para la planificación de la gestión de áreas protegidas, 2008).'
        ],
        'module_info_Rating' => [
            'Evaluar: A) Estado del plan de gestión, B) Idoneidad de la visión, la misión y los objetivos establecidos en el plan y C) Adecuación del plan de gestión a las necesidades de conservación'
        ]
    ],

    'WorkPlan' => [
        'title' => 'Plan de trabajo/acción (terrestre) o Plan de Monitoreo (MPA)',
        'fields' => [
            'PlanExistence' => 'A) ¿Hay un plan de trabajo/acción o plan de monitoreo? Sí/No',
            'PlanUptoDate' => '¿El plan de trabajo/acción o plan de monitoreo (que abarca el período actual) está actualizado? Sí/No',
            'PlanApproved' => '¿El plan de trabajo/acción o plan de monitoreo está aprobado oficialmente? Sí/No',
            'PlanImplemented' => '¿Se aplicará el plan de trabajo/acción o plan de monitoreo? Sí/No',
            'VisionAdequacy' => 'B) Adecuación de las actividades y resultados del plan de trabajo/acción o plan de monitoreo en relación con los objetivos del plan de gestión',
            'PlanAdequacyScore' => 'C) Adecuación en cuanto a la claridad y aplicabilidad de las actividades y los resultados establecidos del plan de trabajo/acción o plan de monitoreo',
            'Comments' => 'Comentarios/explicación',
        ],
        'ratingLegend' => [
            'VisionAdequacy' => [
                '0' => 'Las actividades y resultados del plan de trabajo/acción o plan de monitoreo son totalmente inadecuados en relación con los objetivos del plan de gestión (0-30% de las necesidades)',
                '1' => 'Las actividades y resultados del plan de trabajo/acción o plan de monitoreo son inadecuados en relación con los objetivos del plan de gestión (31-60% de las necesidades)',
                '2' => 'Las actividades y los resultados del plan de trabajo/acción o plan de monitoreo son adecuados en relación con los objetivos del plan de gestión (61-90% de las necesidades)',
                '3' => 'Las actividades y los resultados del plan de trabajo/acción o plan de monitoreo son plenamente adecuados en relación con los objetivos del plan de gestión (91-100% de las necesidades)'
            ],
            'PlanAdequacyScore' => [
                '0' => 'La claridad y la aplicabilidad de las actividades y los resultados previstos son totalmente inadecuados',
                '1' => 'La claridad y la aplicabilidad de las actividades y los resultados previstos son algo inadecuados',
                '2' => 'La claridad y la aplicabilidad de las actividades y los resultados previstos son adecuadas',
                '3' => 'La claridad y la aplicabilidad de las actividades y los resultados previstos son plenamente adecuados'
            ],
        ],
        'module_info_Rating' => '•	Evaluar: A) el estado del plan de trabajo/acción o plan de monitoreo, B) la idoneidad de las actividades y resultados del plan de trabajo/acción o plan de monitoreo en relación con los objetivos del plan de gestión y C) la idoneidad en cuanto a la claridad y aplicabilidad de las actividades y resultados establecidos del plan de trabajo/acción o plan de monitoreo',
        'module_info_EvaluationQuestion' => [
            '¿En el área protegida, existe un plan de trabajo/acción o plan de monitoreo, es adecuado y práctico de implementar?',
            'Un plan de trabajo/acción o plan de monitoreo es un plan detallado en el que se esbozan las acciones o actividades concretas que deben llevarse a cabo (y por quién, dónde y cuándo) a fin de lograr los productos y resultados establecidos en el plan de gestión del área protegida. Un plan de trabajo/acción o plan de monitoreo, permite monitorear el progreso en el logro de los productos y resultados del área protegida. El plan de trabajo/acción o plan de monitoreo suele abarcar un período fijo (por ejemplo, un año natural) y crea un vínculo dentro del equipo, ya que cada miembro es consciente de su papel individual, además de proporcionar la información necesaria para garantizar el éxito del área protegida en sus esfuerzos de conservación.'
        ]
    ],

    'Objectives' => [
        'title' => 'Objetivos del área protegida',
        'fields' => [
            'Objective' => 'Objetivo',
            'EvaluationScore' => 'Adecuación',
            'Comments' => 'Comentarios/explicación',
        ],
        'predefined_values' => [
            'El estado y la protección de la biodiversidad como valor mundial',
            'Especies animales  - especies bandera, en peligro de extinción, endémico, … –',
            'Especies de plantas  - especies bandera, en peligro, endémicas, … –',
            'Mitigación de las amenazas directas e indirectas al área protegida',
            'Servicios y funciones ecosistémicas - Provisión (alimentos, mariscos, material, calidad del agua, etc. uso sostenible)',
            'Servicios y funciones ecosistémicas - Regulación (protección frente a tormentas y costas, erosión hídrica, etc.,uso sostenible)',
            'Servicios y funciones ecosistémicas - Cultural (turismo, pesca tradicional, etc. uso sostenible)',
            'Servicios y funciones ecosistémicas - Soporte (zonas de desove en el mar - hábitats de cría, etc.)',
            'Adaptación al cambio climátco',
            'Gobernanza',
            'Apoyo a la economía local',
            'Apoyo los aspectos sociales',
            'El turismo y el uso humano',
            'Sistema de administración  - personal, finanzas, compras',
            'Infraestructura y equipo',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '0' => 'Completamente inadecuado (0-30% de las necesidades)',
                '1' => 'Algo inadecuado (31-60% de las necesidades)',
                '2' => 'Adecuado (61-90% de las necesidades)',
                '3' => 'Completamente adecuado (91-100% de las necesidades)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Son adecuados los objetivos establecidos para el área protegida?',
            'La gestión de las áreas protegidas se lleva a cabo cada vez más siguiendo el enfoque de "gestión por objetivos". Se considera proactiva, es decir, está diseñada para lograr un conjunto específico de resultados, en lugar de ser un instrumento reactivo, es decir, simplemente respondiendo a los problemas que surgen. Las metas y objetivos del área protegida deben ser claramente entendidos. Deberían estar bien definidos y redactados para facilitar la supervisión, pero también deberían estar relacionados con los valores clave del área protegida (es decir, especies o ecosistemas importantes) o con las principales áreas de actividad de gestión (por ejemplo, turismo, educación). En esta herramienta hacemos una importante distinción entre resultados y productos.<ul><li> Los RESULTADOS se refieren a los cambios relacionados con las METAS / OBJETIVOS, es decir, las metas / objetivos a largo plazo o las visiones expresadas en el plan de gestión o manejo. Estas metas / objetivos suelen serdeclaraciones específicas relacionadas con los valores clave del área protegida (es decir, especies importantes o funciones y/o servicios del ecosistema) o con las principales áreas de actividades de gestión (por ejemplo, turismo, educación).</li><li>Los RESULTADOS se refieren a la realización de ACTIVIDADES a corto plazo, generalmente se miden de forma cuantitativa, y contribuyen con otros logros a alcanzar las metas a largo plazo o los objetivos específicos.</li></ul>'
        ],
        'module_info_Rating' => [
            'Evaluar la adecuación de los objetivos del plan de manejo para los elementos clave del área protegida, basándose en el análisis del contexto de la intervención, puntos: CTX1.5, CTX 4, 5, 6, 7 y contexto de la gestión, puntos de C 1.1 a C 1.5)'
        ]
    ],

    'ObjectivesPlanification' => [
      'module_info' => 'Establecer y describir los objetivos de conservación para <b>la planificación</b> del área protegida.<br /> Los objetivos que se indican a continuación se utilizarán para mejorar la gestión y, más concretamente, para la planificación, la movilización de recursos (insumos), las fases del proceso y el seguimiento de las actividades de gestión del área protegida.'
    ],

    'InformationAvailability' => [
        'title' => 'Información básica',
        'fields' => [
            'Element' => 'Clasificación - Concepto medido - Variables',
            'EvaluationScore' => 'Disponibilidad',
            'Comments' => 'Comentarios/explicación',
        ],
        'groups' => [
            'group0' => 'Especies animales (emblemáticas o bandera, en peligro de extinción, endémicas, …)',
            'group1' => 'Especies de plantas (emblemáticas, en peligro de extinción, endémicas, …)',
            'group2' => 'Hábitats y las dimensiones relacionadas de cobertura de suelos - uso - ocupación del territorio dentro y fuera del área protegida',
            'group3' => 'Amenazas al área protegida',
            'group4' => 'Efectos del cambio climático en elementos clave del área protegida',
            'group5' => 'Servicios y funciones ecosistémicas que presta el área protegida'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'No hay o hay poca información disponible para ayudar en la gestión (0-30% de las necesidades)',
                '1' => 'No hay mucha información disponible e insuficiente para ayudar a la gestión (31-60% de las necesidades)',
                '2' => 'Información disponible pero moderadamente suficiente para ayudar a la gestión (61-90% de las necesidades)',
                '3' => 'Información disponible y en gran medida suficiente para ayudar a la gestión (91-100% de las necesidades)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿El área protegida, dispone de información suficiente y específica que le sirva de apoyo en la toma de decisiones para la gestión?',
            'La gestión efectiva de las áreas protegidas requiere conocimientos e información suficientes para fundamentar la adopción de decisiones. La gestión de un área protegida necesita un análisis sólido para resumir y estructurar la información pertinente con miras a encontrar soluciones a problemas concretos de gestión. Los buenos datos e información son un requisito previo para un análisis sólido, y sin esa información no puede haber una buena gestión.'
        ],
        'module_info_Rating' => [
            'Analizar la disponibilidad de información para apoyar la gestión del área protegida en las siguientes dimensiones del Contexto de la intervención, points CTX 4; 5; 6; 7'
        ]
    ],

    'Staff' => [
        'title' => 'Personal actual',
        'fields' => [
            'Theme' => 'Criterio -  Concepto medido  - Variables',
            'StaffNumberAdequacy'=> 'Adecuación del número de personal',
            'StaffCapacityAdequacy'=> 'Adecuación de las capacidades del personal',
            'Comments' => 'Comentarios/explicación',
        ],
        'StaffNumberAdequacy' => 'Adecuación del número del personal',
        'ratingLegend' => [
            'StaffNumberAdequacy' => [
                '0' => 'Casi no hay personal (entre el 0 y el 20% del número requerido)',
                '1' => 'No hay suficiente personal para las actividades esenciales de gestión (entre el 21 y el 40% del número requerido)',
                '2' => 'No hay suficiente personal para llevar a cabo muchas actividades de gestión (entre el 41 y el 60% del número necesario)',
                '3' => 'Suficiente personal para llevar a cabo muchas, pero no todas las actividades (entre el 61 y el 80% del número requerido)',
                '4' => 'Número de personal apropiado para llevar a cabo todas las actividades (entre el 81 y el 100% del número requerido)'
            ],
            'StaffCapacityAdequacy' => [
                '0' => 'Sin capacidad de personal (0-30% de las necesidades)',
                '1' => 'Capacidades de personal insuficientes (31-60% de las necesidades)',
                '2' => 'La capacidad del personal es adecuada en principio, pero se requieren más mejoras (61-90% de las necesidades)',
                '3' => 'Capacidades de personal suficientes (91-100% de las necesidades)'

            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Hay suficiente personal para cumplir los requisitos de gestión del área protegida?',
            'La dotación de personal cualificado, competente, comprometido y adecuado (en número) es fundamental para el éxito de las áreas protegidas. Las necesidades de personal están definitivamente correlacionadas con el tamaño, el tipo, la densidad de vegetación y las presiones y amenazas (es decir, la densidad humana) de un área protegida. Por ejemplo, para su protección, las zonas forestales más pequeñas y protegidas tienden a requerir relativamente más personal en comparación con las zonas protegidas de sabana más grandes y abiertas, lo que implica mayores costos de personal. La evaluación se basa en la información del plan de manejo o del organigrama oficial del personal'
        ],
        'module_info_Rating' => [
            'Evaluar: A) la adecuación del número de empleados (obsérvese que los resultados se calculan automáticamente sobre la evaluación realizada en el CTX 3.1.1), B) la adecuación de la capacidad del personal'
        ]
    ],

    'BudgetAdequacy' => [
        'title' => 'Presupuesto actual',
        'fields' => [
            'EvaluationScore' => 'Adecuación del presupuesto actual',
            'Percentage' => 'Porcentaje que indica la medida en que el presupuesto es adecuado en relación con las necesidades',
            'Comments' => 'Comentarios/explicación',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Sin presupuesto (0% de las necesidades)',
                '1' => 'Insuficiente incluso para las actividades de gestión esenciales (entre el 1 y el 25% de las necesidades)',
                '2' => 'Insuficiente para muchas actividades de gestión (26-50% de las necesidades)',
                '3' => 'Adecuado para las actividades esenciales de gestión (entre el 51 y el 70% de las necesidades)',
                '4' => 'Adecuado para muchas, pero no todas las actividades (entre el 71% y el 90% de las necesidades)',
                '5' => 'Adecuado para todas las actividades (91% o más de los requisitos)'

            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿El presupuesto actual es adecuado para la gestión apropiada del área protegida?',
            'Las áreas protegidas preparan sus presupuestos anuales de funcionamiento cada año o durante varios años. La planificación financiera y los documentos presupuestarios clave son necesarios para mejorar la eficiencia y la eficacia operativa. La mejora se consigue mediante el uso de medidas de rendimiento y el análisis de los procesos'
        ],
        'module_info_Rating' => [
            '•	Evaluar la idoneidad de la financiación del año en curso del área protegida en relación con los requisitos de conservación (sobre la base del análisis del contexto de la intervención, punto CTX 3.2)'
        ]
    ],

    'BudgetSecurization' => [
        'title' => 'Seguridad del presupuesto',
        'fields' => [
            'Percentage' => 'A) Evaluar, en porcentaje, la "Seguridad de financiamiento futuro"',
            'EvaluationScore' => 'B) Evaluar, en años, el "Período de seguridad del financiamiento futuro".',
            'Comments' => 'Comentarios/explicación',
        ],
        'ratingLegend' => [
            'Percentage' => [
                '0' => 'Las necesidades financieras básicas de la gestión del área protegida no están aseguradas (0-20% de las necesidades aseguradas)',
                '1' => 'Las necesidades financieras básicas de la gestión de las áreas protegidas están muy poco aseguradas (21-40% de las necesidades aseguradas)',
                '2' => 'Las necesidades financieras básicas de la gestión de las áreas protegidas están débilmente aseguradas (41-60% de las necesidades aseguradas)',
                '3' => 'Las necesidades financieras básicas de la gestión de las áreas protegidas están parcialmente aseguradas (61-75% de las necesidades aseguradas)',
                '4' => 'Las necesidades financieras básicas de la gestión de las áreas protegidas están relativamente bien aseguradas (76-90% de las necesidades aseguradas)',
                '5' => 'Se aseguran las necesidades financieras básicas de la gestión del área protegida (> 90% de las necesidades aseguradas)',
            ],
            'EvaluationScore' =>[
                '0' => 'Las necesidades financieras básicas de la gestión del área protegida están aseguradas sólo por 1 año (año en curso)',
                '1' => 'Las necesidades financieras básicas de la gestión del área protegida están aseguradas por 2 años (año en curso +1 año)',
                '2' => 'Las necesidades financieras básicas de la gestión del área protegida están aseguradas por 3 años (año en curso +2 años)',
                '3' => 'Las necesidades financieras básicas de la gestión de las áreas protegidas están aseguradas para 4 - and más años. (año en curso +3 años y más)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Qué parte del presupuesto necesario se asegura, y por cuánto tiempo, para cubrir las necesidades básicas de gestión de las áreas protegidas?',
            'Un presupuesto seguro y fiable es fundamental para la planificación y la gestión de las áreas protegidas, en particular para las actividades a gran escala y a largo plazo. Se debería hacer una evaluación realista de las necesidades para asegurar que todos los costos relacionados con el plan de trabajo o de gestión puedan ser satisfechos plenamente, teniendo en cuenta que algunos objetivos requerirán varios años para ser alcanzados. Cuando no se disponga de recursos, el administrador debe decidir cómo priorizar las actividades en términos de calendario e inversión'
        ],
        'module_info_Rating' => [
            'Evaluar: A) la seguridad del financiamiento y B) el período de seguridad de la financiación para los próximos años en relación con los requisitos de conservación en el área protegida'
        ]
    ],

    'ManagementEquipmentAdequacy' => [
        'title' => 'Infraestructura, equipo e instalaciones',
        'fields' => [
            'Equipment' => 'Criterio -  Concepto medido  - Variables',
            'EvaluationScore' => 'A) Adecuación de la infraestructura, el equipo y las instalaciones (CTX 3.3)',
            'Importance' => 'B) Necesidad actual de disponibilidad para la gestión de áreas protegidas',
            'Comments' => 'Comentarios/explicación',
        ],
        'adequacy' => 'Adecuación de la infraestructura, el equipo y las instalaciones',
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Completamente inadecuado (0-30% de las necesidades)',
                '1' => 'Algo inadecuado (31-60% de las necesidades)',
                '2' => 'Adecuado (61-90% de las necesidades)',
                '3' => 'Completamente adecuado (91-100% de las necesidades)',
            ],
            'Importance' => [
                '0' => 'Normal',
                '1' => 'Alto',
                '2' => 'Muy alto',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿La infraestructura, el equipo y las instalaciones del área protegida son adecuados para los requisitos de gestión?',
            'La infraestructura, el equipo y las instalaciones son importantes para asegurar y mejorar la eficiencia y eficacia operativa del área protegida. El análisis de la infraestructura, el equipo y las instalaciones de un área protegida puede servir de base para buscar financiación adicional. Se debería alentar a los donantes a que contribuyan a alcanzar y mantener niveles adecuados de infraestructura, equipo e instalaciones para la gestión de las áreas protegidas'
        ],
        'module_info_Rating' => [
            'Evaluar: A) la idoneidad de la infraestructura, el equipo y las instalaciones (resultados calculados automáticamente sobre la base del análisis del contexto de la intervención, punto (CTX 3.3), B) la necesidad actual de disponer de infraestructura, equipo e instalaciones específicas para el área protegida',
                ]
    ],

    'ObjectivesIntrants' => [
      'module_info' => 'Establecer y describir los objetivos de conservación de los <b>insumos</b> del área protegida.<br /> Los objetivos que se indican a continuación se utilizarán para mejorar la gestión y, más concretamente, para la planificación, la movilización de recursos (insumos), las fases del proceso y el seguimiento de las actividades de gestión del área protegida.'
        ],

    'StaffCompetence' => [
        'title' => 'Programa de capacitación y fomento de la capacidad del personal',
        'fields' => [
            'Theme' => 'Criterio - Concepto medido - Variables',
            'EvaluationScore' => 'A) Adecuación de la capacidad/necesidades del personal análisis y diseño del programa de capacitación',
            'PercentageLevel' => 'B) Adecuación de las actividades de fomento de la capacidad del personal',
            'Comments' => 'Comentarios/explicación',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Completamente inadecuado',
                '1' => 'Algo inadecuado',
                '2' => 'Adecuado',
                '3' => 'Completamente adecuado'
            ],
            'PercentageLevel' => [
                '0' => 'Actividades de fomento de la capacidad del personal totalmente inadecuadas',
                '1' => 'Actividades de fomento de la capacidad del personal algo adecuadas',
                '2' => 'Actividades adecuadas de fomento de la capacidad del personal, pero se necesitan mejoras',
                '3' => 'Actividades de fomento de la capacidad del personal plenamente adecuadas (suficientes y actualizadas)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Se está aplicando en el área protegida un programa adecuado de capacitación y fomento de la capacidad que responda a las necesidades de personal para lograr los objetivos de gestión?',
            'El personal cualificado, competente y comprometido es fundamental para el éxito de las áreas protegidas. La capacitación del personal se reconoce cada vez más como un componente vital de la gestión eficiente de las áreas protegidas. El objetivo principal de la capacitación del personal es aumentar la capacidad del personal de las áreas protegidas para adaptarse a los nuevos desafíos, utilizando enfoques innovadores, si es necesario. El análisis de este punto tiene en cuenta la adecuación de (A) el diseño del programa de formación (incluyendo el análisis, la dotación de recursos, el diseño), y (B) las actividades de creación de capacidad (incluyendo el desarrollo e impartición de formación) en relación con la capacidad y las necesidades del personal para los requisitos de gestión del área protegida'
        ],
        'module_info_Rating' => [
            'Para las diferentes categorías/funciones de personal (por ejemplo, directores, guardaparques, etc.) evaluar la idoneidad de: A) el diseño del programa de capacitación y B) las actividades de fomento de la capacidad del personal'
        ]
    ],

    'HRmanagementPolitics' => [
        'title' => 'Políticas y procedimientos de gestión de los recursos humanos',
        'fields' => [
            'Conditions' => 'Criterio - Concepto medido - Variables',
            'EvaluationScore' => 'Adecuación de las políticas y procedimientos de gestión de los recursos humanos',
            'Comments' => 'Comentarios/explicación',
        ],
        'predefined_values' => [
            'Compensación y beneficios',
            'Procedimientos de reclutamiento basados en el mérito',
            'Asignación de trabajo',
            'Asignación del lugar de trabajo',
            'Salud y seguridad',
            'Posibilidades de carrera y promoción',
            'Equidad de género y étnica',
            'Normas para reducir el favoritismo y la discriminación',
            'Formación y desarrollo',
            'Gestión de las relaciones con los empleados',
            'Sistemas de información de recursos humanos'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento no está relacionado con la gestión del área protegida',
                '0' => 'Completamente inadecuado (0-30% de las necesidades)',
                '1' => 'Algo inadecuado (31-60% de las necesidades)',
                '2' => 'Adecuado (61-90% de las necesidades)',
                '3' => 'Completamente adecuado (91-100% de las necesidades)'
            ]
        ],
        'module_info_EvaluationQuestion' =>[
            '¿Ha adoptado el área protegida políticas, procedimientos y directrices adecuados de gestión de los recursos humanos para la contratación, el ascenso, la compensación, el rendimiento, la evaluación y la capacitación del personal, sus obligaciones y su código de conducta?',
            'Las políticas de recursos humanos esbozan el enfoque y las medidas a adoptar en la gestión del personal. Esas políticas también proporcionan directrices para la gestión de los recursos humanos sobre diversas cuestiones relativas a diferentes aspectos como la contratación, los ascensos, la remuneración, el rendimiento, la evaluación y la capacitación, pero también las obligaciones del personal y su código de conducta, los procedimientos disciplinarios, etc. El establecimiento de políticas, procedimientos y directrices claros puede contribuir a demostrar, tanto interna como externamente, que el área protegida cumple los requisitos de equidad, diversidad, ética y capacitación, así como sus compromisos de cumplir los requisitos reglamentarios y la buena gestión de los recursos humanos de los empleados del área protegida'
        ],
        'module_info_Rating' => [
            'Evaluar la idoneidad de las disposiciones de las políticas, procedimientos y directrices de gestión de los recursos humanos para el área protegida'
        ]
    ],

    'HRmanagementSystems' => [
        'title' => 'Condiciones de trabajo y motivación del personal',
        'fields' => [
            'Conditions' => 'Criterio - Concepto medido - Variables',
            'EvaluationScore' => 'Adecuación de la motivación del personal',
            'Comments' => 'Comentarios/explicación',
        ],
        'predefined_values' => [
            'Objetivos claros y específicos para las asignaciones',
            'Lealtad e integridad de los gestores y líderes',
            'Retroalimentación y entrenamiento por parte de los gestores y líderes',
            'Estimulación y motivación para realizar actividades',
            'Retroalimentación sobre las actividades realizadas',
            'Autonomía para realizar las tareas adecuadamente',
            'La participación del personal en las decisiones sobre su trabajo y el empleo',
            'Remuneración adecuada (salarios, primas y seguridad social)',
            'Condiciones de trabajo adecuadas (equipo de trabajo, ropa, etc.)',
            'Motivación de las autoridades políticas, administrativas y militares',
            'Motivación de las autoridades legales',
            'Motivación de las comunidades locales'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento no está relacionado con la gestión del área protegida',
                '0' => 'Completamente inadecuado (0-30% de las necesidades)',
                '1' => 'Algo inadecuado (31-60% de las necesidades)',
                '2' => 'Adecuado (61-90% de las necesidades)',
                '3' => 'Completamente adecuado (91-100% de las necesidades)'
                ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Utiliza la gestión del área protegida medidas/enfoques/herramientas adecuadas para asegurar la motivación del personal?',
            'Para un área protegida, es esencial contar con personal motivado para lograr el éxito en la conservación. Las condiciones de trabajo y la motivación del personal influyen en gran medida en la capacidad del personal para llevar a cabo su labor. Los administradores y dirigentes deben comprender que es necesario proporcionar un entorno de trabajo que cree y mantenga la motivación del personal para lograr resultados en la conservación',
        ],
        'module_info_Rating' => [
            'Evaluar la idoneidad de las medidas/enfoques/herramientas de motivación del personal en el área protegida',
            ]
    ],

    'GovernanceLeadership' => [
        'title' => 'Orientación de la gestión del área protegida',
        'fields' => [
            'EvaluationScoreGovernace' => 'A) Adecuación de la gestión\'s comunicación sobre la misión y los valores del área protegida',
            'EvaluationScoreLeadership' => 'B) Adecuación del enfoque orientado a los resultados de la gestión',
            'Comments' => 'Comentarios/explicación',
        ],
        'ratingLegend' => [
            'EvaluationScoreGovernace' => [
                '0' => 'No hay comunicación, o es extremadamente limitada, sobre la visión, la misión y los valores del área protegida para influir en el desempeño, el apoyo y la retroalimentación del personal (entre el 0 y el 25% de las necesidades)',
                '1' => 'No hay una comunicación suficientemente clara sobre la visión de la misión de las áreas protegidas y los valores para influir en el desempeño, el apoyo y la retroalimentación del personal (entre el 26 y el 50% de las necesidades)',
                '2' => 'Existe una comunicación clara pero no completa sobre la visión, la misión y los valores del área protegida para influir en el desempeño, el apoyo y la retroalimentación del personal (entre el 51 y el 75% de las necesidades)',
                '3' => 'Existe una comunicación completa sobre la visión, misión y valores de las áreas protegidas para influir en el desempeño, el apoyo y la retroalimentación del personal (entre el 76 y el 100% de las necesidades)'
            ],
            'EvaluationScoreLeadership' => [
                '0' => 'La gestión no está orientada a los resultados en el logro de la visión, misión y conservación de los valores del área protegida',
                '1' => 'La gestión está débilmente orientada a los resultados en el logro de la visión, misión y conservación de los valores del área protegida',
                '2' => 'La gestión suele estar orientada a los resultados para lograr la visión, misión y conservación de los valores del área protegida',
                '3' => 'La gestión está fuertemente orientada a los resultados en el logro de la visión, la misión y la conservación de los valores del área protegida'
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿La gestión del área protegida ofrece una dirección y orientación adecuadas para emprender tareas y ejecutarlas?',
            'La gestión del área protegida debería dar una dirección y orientación adecuadas para cualquier actividad relacionada con las operaciones de escritorio y sobre el terreno, el uso de recursos, la administración, la aplicación de la ley, la vigilancia, etc. La evaluación de la orientación de la gestión debería determinar si sigue siendo pertinente, eficaz y actual, o si es necesario introducir cambios. A veces puede ser necesario hacer ajustes para asegurar que la gestión proporcione una dirección adecuada para la aplicación de los productos y resultados previstos'
        ],
        'module_info_Rating' => 'Evaluar la adecuación de: A) la comunicación por parte de la administración de la misión y los valores del área protegida y B) el enfoque de la administración orientado a los resultados'
    ],

    'AdministrativeManagement' => [
        'title' => 'Presupuesto y gestión financiera',
        'fields' => [
            'Aspect' => 'Criterio - Concepto medido - Variables',
            'EvaluationScore' => 'Establecimiento de los elementos básicos de la gestión presupuestaria y financiera',
            'Comments' => 'Comentarios/explicación',
        ],
        'predefined_values' => [
            'Coherencia: El sistema y políticas financieras son coherentes.',
            'Rendición de cuentas: Se puede explicar y demostrar a todos los funcionarios/socios cómo se han utilizado los recursos y qué se logró con ellos.',
            'Transparencia: La organización es transparente en lo que respecta a su trabajo y sus finanzas, poniendo la información a disposición de todos los funcionarios/interesados.',
            'Integridad: los individuos en su organización están operando con honestidad y decoro.',
            'Administración financiera: su organización cuida bien los recursos financieros que le han sido designados y se asegura de que se utilicen para los propósitos previstos.',
            'Normas de contabilidad: el sistema de su organización para mantener los registros y la documentación financiera sigue las normas de contabilidad externas aceptadas.'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '0' => 'Nunca',
                '1' => 'Raramente',
                '2' => 'A veces',
                '3' => 'A menudo',
                '4' => 'Siempre'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Se administran bien el presupuesto y los recursos financieros para satisfacer las necesidades esenciales y prioritarias de gestión del área protegida?',
            'El presupuesto y la gestión financiera de un área protegida debe ser sólida para permitir una asignación adecuada de los recursos, una previsión dinámica y detallada de los costes de posición en todos los programas y una planificación estratégica. La gestión presupuestaria y financiera es más que sólo llevar registros contables. Es una parte esencial de la planificación, la organización, el control y el seguimiento de los recursos financieros para lograr los objetivos de conservación del área protegida. Sólo se puede conseguir una gestión presupuestaria y financiera eficaz si se dispone de un plan de gestión y trabajo sólido con políticas y estrategias claras y un conjunto de objetivos acordados.'
        ],
        'module_info_Rating' => [
            'Evaluar la configuración de los elementos básicos que deben estar en vigor para lograr una buena práctica en la gestión presupuestaria y financiera. (No existe un modelo único de sistema de gestión presupuestaria y financiera que se adapte a todas las organizaciones, pero hay algunos elementos básicos que deben estar en vigor para lograr una buena práctica de gestión presupuestaria y financiera)'
        ]
    ],

    'EquipmentMaintenance' => [
        'title' => 'Mantenimiento de la infraestructura, el equipo y las instalaciones',
        'fields' => [
            'Equipment' => 'Criterio -  Concepto medido - Variables',
            'EvaluationScore' => 'Clasificación: Adecuación del mantenimiento',
            'AdequacyLevel' => 'Valor de CTX 3.3',
            'Comments' => 'Comentarios/explicación',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '0' => 'Completamente inadecuado (0-30% de las necesidades)',
                '1' => 'Algo inadecuado (31-60% de las necesidades)',
                '2' => 'Adecuado (61-90% de las necesidades)',
                '3' => 'Completamente adecuado (91-100% de las necesidades)'
                ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Se mantienen adecuadamente la infraestructura, el equipo y las instalaciones del área protegida?',
            'El mantenimiento preventivo es el término que se utiliza para el mantenimiento periódico de rutina realizado en la infraestructura, el equipo y las instalaciones para mantenerlas funcionando sin problemas y de manera eficiente y para ayudar a prolongar su vida útil. La infraestructura, el equipo y las instalaciones mal mantenidos no sólo se desgastan más rápidamente, sino que también desperdician recursos y degradan fundamentalmente la capacidad del área protegida para alcanzar los objetivos de conservación. El área protegida debería trabajar para prevenir ambas condiciones mediante un programa de mantenimiento adecuado'
        ],
        'module_info_Rating' => [
            'Evaluate the level of maintenance of infrastructure, equipment and facilities in relation to management requirements for the protected area (based on the analysis of the context of intervention, point CTX 3.3)'
        ]
    ],

    'ManagementActivities' => [
        'title' => 'Gestionar los valores y amenazas clave del área protegida con acciones específicas',
        'fields' => [
            'Activity' => 'Criterio - Concepto medido  - Variables',
            'EvaluationScore' => 'Adecuación de las medidas de gestión',
            'InManagementPlan' => 'Medidas incluidas en el plan de gestión',
            'Comments' => 'Comentarios/explicación',
        ],
        'groups' => [
            'group0' => 'Especies animales (emblemáticas o bandera, en peligro de extinción, endémicas, …)',
            'group1' => 'Especies de plantas (emblemáticas o bandera, en peligro de extinción, endémicas, …)',
            'group2' => 'Los hábitats más importantes y las dimensiones relacionadas del área protegida',
            'group3' => 'Gestión para mitigar las amenazas al área protegida',
            'group4' => 'Servicios/funciones ecosistémicas',
            'group5' => 'Otros',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '0' => 'Completamente inadecuado (0-30% de las necesidades)',
                '1' => 'Algo inadecuado (31-60% de las necesidades)',
                '2' => 'Adecuado (61-90% de las necesidades)',
                '3' => 'Completamente adecuado (91-100% de las necesidades)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Existen medidas de gestión específicas para los valores y amenazas clave del área protegida?',
            'El principal objetivo de gestión de las áreas protegidas es la conservación/restauración de los valores naturales y culturales asociados. Para preservar estos valores y minimizar las amenazas más significativas, los gestores deben identificar y utilizar las directrices, medidas o mejores prácticas de gestión disponibles. Las acciones pueden incluir la conservación/restauración de especies animales y vegetales, el hábitat y la gestión de diversas amenazas (nota: para las acciones de adaptación al cambio climático y de gestión de los servicios de los ecosistemas, véanse los PR 17 y PR 18). Ejemplos de acciones: gestión de fauna o vegetación, gestión del entorno físico, gestión de incendios, trabajos de revegetación, control de especies invasoras, gestión de recursos culturales, minimización de amenazas, etc.'
        ],
        'module_info_Rating' => [
            'Enumere tres o más valores, amenazas y otros elementos clave y evalúe la idoneidad de las medidas de gestión conexas (sobre la base del análisis del contexto de los puntos de intervención CTX 4 y 5).'
        ]
    ],
    'LawEnforcementImplementation' => [
        'title' => 'Gestión de patrullajes de guardaparques (aplicación de la ley)',
        'fields' => [
            'Element' => 'Criterio - Concepto medido  - Variables',
            'Adequacy'=> 'Adecuación de la gestión de patrullajes de guardaparques',
            'Comments' => 'Comentarios/explicación',
        ],
        'groups' => [
            'group0' => 'XXXXXXXXX Ranger patrol management',
            'group1' => 'XXXXXXXXX Sea ranger patrol management',
        ],
        'predefined_values' => [
            'group0' => [
                'Gestión estratégica proactive',
                'Vigilancia en colaboración (protección lograda mediante una combinación de medidas de control y colaboración con las comunidades)',
                'Procedimientos Operativos Estándar',
                'Procedimientos operativos de emergencia',
                'Procedimientos de intervención rápida',
                'No colaborativo (tecnología: datos digitales, vigilancia por aéreo, etc. vs. tecnología de bajo rendimiento, guardaparques calificados)',
                'Tácticas adaptables y diversas (por ejemplo, tipos de patrullajes complementarias, como puntos de observación, patrullajes asistidos por vehículos y emboscadas, etc.)',
                'Estrategias de aplicación que combinan la tecnología con los patrullajes marítimos (por ejemplo, vigilancia por satélite y patrullajes asistidos por vehículos/embarcaciones)',
                'Proceso eficiente de toma de decisiones para los procedimientos operativos estándar y de emergencia',
                'Gestión de las unidades de élite (los guardaparques/exploradores de mayor rendimiento)',
                'Salas de control de operaciones',
                'Puestos de avanzada/cuadrillas – dentro del área protegida',
                'Patrullajes de varios días – fuera del área protegida',
                'Patrullajes de varios días',
                'Uso de la información del SMART-RBM para llevar a cabo la sesión informativa y el informe de patrullajes conjuntos (policiales, militares).',
            ],
            'group1' => [
                'XXXXXXXXX Enforcement strategies that combine technology with sea patrols (satellite monitoring and hydrophones, electronic sensors, etc.)',
                'XXXXXXXXX Use of visual and basic electronic sensors for sea patrols (radar, optical/infrared)',
                'XXXXXXXXX Protection achieved through a combination of enforcement and collaboration with communities',
                'XXXXXXXXX Use of collaborative surveillance (real time and large area coverage, low investments vs time interval and recurring coasts, regulations and incentives, transceivers deactivated)',
                'XXXXXXXXX Use of non-collaborative (technology: radar, optical/infrared, radio monitoring vs technology poor performance, qualified personnel)',
                'XXXXXXXXX Integration between collaborative and non-collaborative surveillance systems in the protected area.',
                'XXXXXXXXX Enforcement patrols held during the night and other random hours',
                'XXXXXXXXX Regular participation in specialized training (International Maritime Organization –IMO- basic training, reading and using nautical charts, search and rescue, basic outboard motor maintenance course, etc.)',
                'XXXXXXXXX Continuous update and distribution of a simple fact sheet outlining zoning, regulations, restrictions, and fines or sanctions',
            ]
        ],
        'ratingLegend' => [
            'Adequacy' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '0' => 'Completamente inadecuado (0-30%)',
                '1' => 'Algo inadecuado (31-60%)',
                '2' => 'Adecuado (61-90%)',
                '3' => 'Completamente adecuado (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿En qué medida es adecuada la gestión y aplicación de la aplicación de la ley mediante patrullajes de guardaparques orientadas a garantizar la protección de la biodiversidad a largo plazo?',
            'La gestión de patrullajes de guardaparques es una actividad de aplicación de la ley esencial para hacer cumplir las normas jurídicas existentes que deberían garantizar la protección a largo plazo de la biodiversidad y otros valores del área protegida. La gestión eficaz de las áreas protegidas requiere la aplicación de la ley a todos los niveles: patrullajes de guardaparques, inteligencia y sistemas de justicia penal eficaces. Esta etapa del análisis se refiere al proceso de gestión de los patrullajes de guardaparques',
            '(Nota: Se dispone de un módulo específico del IMET para un análisis más profundo de la aplicación de la ley)',
        ],
        'module_info_Rating' => [
            'Evaluar la idoneidad de los elementos de la gestión de los patrullajes de guardaparques orientados a asegurar la protección a largo plazo de la biodiversidad y otros valores',
            ]
    ],

    'IntelligenceImplementation' => [
        'title' => 'Seguimiento de indicios, cruce de información, seguimiento a infracciones y acciones legales (aplicación de la ley)',
        'fields' => [
            'Element' => 'Criterios - Concepto medido – Variables',
            'Adequacy'=> 'Adecuación de la gestión de: A) Seguimiento de indicios y cruce de información; B) a busqueda de indicios, seguimiento a infracciones y desarrollo de casos de acciones legales',
            'Comments' => 'Comentarios/explicación',
        ],
        'groups' => [
            'group0' => 'A) Gestión del seguimiento de indicios y el cruce de información - Terrestre',
            'group0b' => 'A) Gestión del seguimiento de indicios y el cruce de información - Marítimo y costero',
            'group1' => 'B) a busqueda de indicios, seguimiento a infracciones y desarrollo de casos de acciones legales - Terrestre',
            'group1b' => 'B) a busqueda de indicios, seguimiento a infracciones y desarrollo de casos de acciones legales - Marítimo y costero',
        ],
        'predefined_values' => [
            'group0' => [
                'Las unidades de seguimiento de indicios y cruce de información orientan y apoyan las acciones de las patrullajes de los guardaparques',
                'Organización del un sistema de informantes / contactos',
                'Apoyo informático a la seguimiento de indicios',
                'Sistema de organización y análisis de datos de seguimiento de indicios',
                'Colaboración interinstitucional (por ejemplo, los fiscales del servicio de vida silvestre o la unidad especializada en la persecución de delitos contra la vida silvestre, policia ambinetal, tribunal agroambiental)',
                'Colaboración interinstitucional con las ONG (por ejemplo, AIDA - Red de Justicia Ambiental, entre otros)'
            ],
            'group0b' => [
                'XXXXXXXXX Intelligence and investigation units orienting and supporting sea patrol operations',
                'XXXXXXXXX Detection and punishment of the illegal activities (such as fisheries and harvesting)',
                'XXXXXXXXX Knowledge of boarding legal requirements',
                'XXXXXXXXX Boarding protocols: inspections, required documents, what to check and look for, documenting the inspection',
                'XXXXXXXXX Interrogating and confronting suspicious crews on illegal activities',
                'XXXXXXXXX Standardized boarding report used consistently and correctly',
                'XXXXXXXXX Level of personal security during boarding',
                'XXXXXXXXX Use of a risk assessment model (GAR -GREEN-AMBER-RED or equivalent/other)',
                'XXXXXXXXX Use of database for recording and tracking information on violations',
                'XXXXXXXXX Collaboration with NGOs specialised in marine laws, enforcement, etc. (e.g. Environmental Law Institute (ELI) Ocean Program)'
            ],
            'group1' => [
                'Observación de los delitos',
                'Notificación y decomisos',
                'Preparación del informe de patrullaje especial',
                'Denuncia hacia las entidades correspondiente',
                'Aplicación de la ley (querella)/ multa a los infractores',
                'Seguimiento a infractores/conclusión del caso'
            ],
            'group1b' => [
                'XXXXXXXXX Training workshops for judges, attorneys, and lawyers on marine and fisheries-related rules and regulations',
                'XXXXXXXXX Ability to seize and detain vessels after transgression',
                'XXXXXXXXX Ability to restrict sailing within the MPA borders by issuing authorization permits',
                'XXXXXXXXX Seizure of fishing gear',
                'XXXXXXXXX Ability to enforce temporary suspension of permits for ships, crew members, or ship-owners',
                'XXXXXXXXX Ability to revoke of operating licenses for ships, ship-owners, agents, maritime personnel, or fishers',
            ],
        ],
        'ratingLegend' => [
            'Adequacy' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '0' => 'Completamente inadecuado (0-30%)',
                '1' => 'Algo inadecuado (31-60%)',
                '2' => 'Adecuado (61-90%)',
                '3' => 'Completamente adecuado (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿En qué medida es adecuado el seguimiento de indicios/ cruce de información / seguimiento a infracciones /acciones jurídicas orientadas a garantizar la protección de la diversidad biológica a largo plazo?',
            'El Seguimiento de indicios y el cruce de información, así como el seguimiento a infracciones y las medidas jurídicas, son actividades esenciales de aplicación de la ley para hacer cumplir las normas jurídicas existentes que deberían garantizar la protección a largo plazo de la biodiversidad y otros valores en el área protegida. La gestión eficaz de las áreas protegidas requiere la aplicación de la ley a todos los niveles: patrullajes de guardaparques, Seguimiento de indicios y sistemas de justicia penal eficaces. Esta etapa del análisis está orientada a la evaluación de: A) Seguimiento de indicios y la cruce de información y B) la busqueda de indicios y la adopción de medidas jurídicas'
        ],
        'module_info_Rating' => [
            'Evaluar la idoneidad en el seguimiento de indicios/ cruce de información / seguimiento a infracciones /acciones legales orientadas a asegurar la protección a largo plazo de la biodiversidad y otros valores.'
        ]
    ],

    'StakeholderCooperation' => [
        'title' => 'Cooperación con socios/actores locales',
        'fields' => [
            'Element' => 'Criterio - Concepto medido - Variables',
            'Cooperation' => 'Grado de cooperación',
            'MPInvolvement' => 'P:Planificación de la gestión',
            'MPIImplementation' => 'PM: Aplicación del plan de manejo o gestión',
            'BAInvolvement' => 'B/A: Beneficios/asistencia para las comunidades locales',
            'EEInvolvement' => 'EAS: educación ambiental, sensibilización y compromiso de la comunidad',
            'Comments' => 'Comentarios/explicación',
        ],
        'groups' => [
            'group0' => 'Comunidad local',
            'group1' => 'Gobierno',
            'group2' => 'Científicos, investigadores, donantes y ONG',
            'group3' => 'Operadores económicos',
            'group4' => 'Otros interesados'
        ],
        'predefined_values' => [
            'group0' => [
                'Autoridades tradicionales',
                'Poblaciones indígenas',
                'Comunidades que viven cerca o en el área protegida',
                'Titulares con derechos territoriales',
                'Propietarios',
                'Usuarios locales de los recursos naturales',
                'Usuarios locales de productos forestales no madereros PFNM',
                'Grupos insuficientemente representados o desfavorecidos',
                'Población que no se encuentra en la zona de amortiguación'
            ],
            'group1' => [
                'Gobierno central',
                'Gobierno local',
                'Consejo territorial, departamental y municipal',
                'Autoridad del área protegida/Comité de gestión',
                'Autoridades y servicios de gestión del territorio y suelos (Autoridades Ambientales regionales y urbanas en Colombia, INRA, ABT en Bolivia, Servicio Forestal y Fauna Silvestre en Perú, etc.)',
                'Representantes de las poblaciones locales (representantes parlamentarios, etc.)',
                'Fuerzas armadas (policía militar y naval)'
            ],
            'group2' => [
                'ONGs de derechos sociales',
                'ONGs medioambientales',
                'Científicos/investigadores',
                'Donantes'
            ],
            'group3' => [
                'Operadores privados de turismo',
                'Operadores forestales',
                'Operadores de pesca'
            ]
        ],
        'ratingLegend' => [
            'Cooperation' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '0' => 'No hay cooperación',
                '1' => 'Muy poca cooperación',
                '2' => 'Cooperación moderada',
                '3' => 'Cooperación muy alta'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Contribuyen los socios en la gestión del área protegida para desarrollar la comprensión y el apoyo al cumplimiento de los objetivos del área protegida?',
            'En muchas áreas protegidas, algunos o todos los interesados pertinentes cooperan de manera sustancial en la adopción de decisiones de la administración en relación con las actividades y su ejecución dentro o fuera del área protegida. Esta cooperación puede consistir en acuerdos formales o informales. El nivel de cooperación de los interesados directos en un área protegida depende de diversos factores, pero en particular de la naturaleza de los interesados directos, las presiones y otras influencias derivadas de los interesados directos y la biodiversidad y los servicios de los ecosistemas del área protegida. En esta etapa del análisis se evalúa la forma en que algunos o todos los interesados pertinentes participan en la gestión del área protegida en cuatro esferas: (P) planificación; (PM) planificación y gestión (B/A) beneficios/asistencia para las comunidades locales (EAI) Información, educación y comunicación para la comprensión y el compromiso de la comunidad. El nivel óptimo de participación y cooperación de los interesados directos debería determinarse para cada área protegida individualmente porque cada área protegida es única'
        ],
        'module_info_Rating' => [
            'Seleccione (A) las áreas en las que los socios / actores locales participan en la gestión del área protegida y evalúe (B) el nivel de cooperación:<ul><li><b>P</b>: planificación de la gestión</li><li><b>PM</b>: Aplicación del plan de manejo o gestión</li><li><b>B/A</b>: Beneficios/asistencia para las comunidades locales</li><li><b>EAS</b>:Educación ambiental, sensibilización y compromiso de la comunidad</li></ul>'
        ]
    ],

    'AssistanceActivities' => [
        'title' => 'Beneficios/asistencia para las comunidades locales',
        'fields' => [
            'Activity' => 'Elementos',
            'EvaluationScore' => 'Adecuación de las actividades para proporcionar beneficios/asistencia',
            'Comments' => 'Comentarios/explicación',
        ],
        'groups' => [
            'group0' => 'Elementos del nivel de vida material',
            'group1' => 'Elementos del nivel de vida inmaterial'
        ],
        'predefined_values' => [
            'group0' => [
                'Apoyo a las actividades locales (por ejemplo, gestión de los servicios/funciones ecosistémicas - gestión de aprovisionamiento, adaptación al cambio climático, etc.)',
                'Apoyo a las empresas locales (por ejemplo, procesamiento de productos agrícolas, pesqueros, forestales, etc.)',
                'Apoyo a las vías de financiación locales',
                'Apoyo a la producción de alimentos y a la pequeña agricultura',
                'Compra de productos agrícolas para el turismo y contratación de personal',
                'Apoyo a las empresas de turismo',
                'Apoyo a los productos tradicionales y a la artesanía para los turistas',
                'Apoyo al conflicto entre los seres humanos y la vida silvestre resolución - compensación',
                'Apoyo al empleo de personal local en el turismo',
                'Apoyo a los proveedores de servicios locales',
                'Distribución de los ingresos del turismo',
                'Provisión de recursos naturales en caso de necesidad (por ejemplo, agua, fibras, etc. de las áreas protegidas durante las crisis o contribuciones de material para edificios sociales como hospitales, escuelas, etc.)',
                'Empleo de la población local en el área protegida',
                'Empleo de guardasparques de la región',
                'Provisión de suministro de energía, conexión eléctrica',
                'Suministro de agua',
                'Apoyo a la construcción, mantenimiento y mejora de las carreteras exteriores',
                'XXXXXXXXX Support for human-wildlife conflict resolution–compensation',
                'XXXXXXXXX Support small scale fisheries',
                'XXXXXXXXX Support for the construction of boat sheds',
                'XXXXXXXXX Support for the construction of boat parking'
                ],
            'group1' => [
                'Fortalecimiento de la seguridad en la área',
                'Reducción al mínimo de los conflictos y fortalecimiento de la gestión y el uso sostenible de los servicios/funciones ecosistémicas (avituallamiento y cultura)',
                'Provisión de acceso a la educación e infraestructura (por ejemplo, edificios)',
                'Prestación de servicios educativos (enseñanza)',
                'Provisión de infraestructura (por ejemplo, edificios, agua limpia)',
                'Prestación de servicios de salud (atención/apoyo a la salud en las comunidades)',
                'Provisión de acceso libre al área',
                'Provisión de servicios culturales (físico - intelectual - emblemático - espiritual - interacción con los servicios/funciones ecosistémicas)',
                'Facilitación de la solución de problemas sociales',
                'Fortalecimiento de la identidad y el sentido de lugar de las comunidades locales'
            ]
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '0' => 'Completamente inadecuado (0-30%)',
                '1' => 'Algo inadecuado (31-60%)',
                '2' => 'Adecuado (61-90%)',
                '3' => 'Completamente adecuado (91-100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Realiza el área protegida actividades/programas diseñados para proporcionar beneficios/ayuda adecuados a las comunidades?',
            'La gestión de las áreas protegidas se ha alejado del paradigma histórico de la protección total, en el que se consideraba que los beneficios de la conservación se obtenían en general a expensas de los intereses de las comunidades locales. En la actualidad se reconoce ampliamente que las áreas protegidas deben contribuir al desarrollo sostenible y al bienestar económico de sus comunidades vecinas. Los resultados socioeconómicos positivos de las áreas protegidas son importantes por derecho propio, pero también pueden ser necesarios para asegurar que las áreas protegidas sigan produciendo resultados ecológicos sólidos. En muchos estudios de casos de todo el mundo se ha vinculado la falta de beneficios/ayuda apropiados para las comunidades locales con los resultados fallidos de las iniciativas de conservación de las áreas protegidas. En consecuencia, las normas internacionales sobre prácticas óptimas promueven una evaluación de las áreas protegidas que tenga en cuenta tanto los resultados ecológicos como los socioeconómicos (Fuentes UNESCO - UICN).'
        ],
        'module_info_Rating' => [
            'Evaluar la idoneidad de las actividades/programa que el área protegida está llevando a cabo para proporcionar beneficios/asistencia a las comunidades'
        ],
    ],

    'EnvironmentalEducation' => [
        'title' => 'Educación ambiental y sensibilización pública',
        'fields' => [
            'Activity' => 'Criterio - Concepto medido - Variables',
            'EvaluationScore' => 'Adecuación de la educación ambiental y la sensibilización pública',
            'Comments' => 'Comentarios/explicación',
        ],
        'predefined_values' => [
            'Programas comunitarios de conservación',
            'Programas de sensibilización en las comunidades de los alrededores del  área protegida',
            'Programas de sensibilización de los residentes que no sean los de las comunidades de los alrededores del área protegida',
            'Programas de educación ambiental en las escuelas',
            'Programas de radio sobre el área protegida (por ejemplo, en estaciones de radio comunitarias)',
            'Programas de televisión sobre el área protegida',
            'Conferencias y debates sobre la conservación',
            'Visitas guiadas para las comunidades locales del área protegida',
            'Material de educación ambiental distribuido a las escuelas',
            'Campañas de limpieza',
            'Sensibilización pública (por ejemplo, ecomuseos, presentaciones itinerantes)'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '0' => 'Totalmente inadecuado (0-30%)',
                '1' => 'Algo inadecuado (31-60%)',
                '2' => 'Adecuado (61-90%)',
                '3' => 'Totalmente adecuado (91-100%)',
          ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Realiza el área protegida actividades/programas de educación ambiental y de sensibilización pública específicamente vinculados a las necesidades y objetivos de conservación/gestión de los recursos naturales?',
            'La educación ambiental puede desempeñar un papel eficaz en la creación de conciencia sobre la necesidad de proteger y preservar el medio ambiente y de mejorar la calidad de la vida humana. La educación ambiental puede ayudar a las personas a equilibrar sus propias necesidades vitales con las necesidades del medio ambiente natural que presta servicios de ecosistema (de aprovisionamiento, de regulación, culturales y de apoyo) a las comunidades dentro y fuera, cerca y lejos del área protegida (considerando la designación específica del área protegida). La educación ambiental incluye la educación y la capacitación tanto formal como informal que aumenta la capacidad y la habilidad humanas para participar en la gestión ambiental y en la solución de las crisis y los desafíos ambientales, incluido el cambio climático. Esto podría lograrse aumentando la conciencia y cambiando efectivamente la perspectiva del individuo sobre el medio ambiente'
        ],
        'module_info_Rating' => [
            'Evaluar la idoneidad de las actividades/programas de educación ambiental y de sensibilización pública que se apoyan en el área protegida'
        ]
    ],

    'VisitorsManagement' => [
        'title' => 'Gestión de las instalaciones y servicios para visitantes',
        'fields' => [
            'Aspect' => 'Criterio - Concepto medido - Variables',
            'EvaluationScore' => 'Adecuación de las instalaciones y servicios para visitantes',
            'Comments' => 'Comentarios/explicación',
        ],
        'predefined_values' => [
            'Procedimientos de gestión del turismo relacionados con los objetivos/resultados favorables de los valores del área protegida',
            'Existencia de objetivos específicos para la gestión del turismo y los visitantes',
            'Sensibilización sobre las consecuencias derivadas de las actividades recreativas y turísticas',
            'Utilización de la zonificación para gestionar diversas oportunidades de recreación, preservando los valores importantes',
            'Diversificación del turismo mediante la promoción de valores biofísicos, culturales y socioculturales',
            'Compromiso de las partes interesadas y los titulares de derechos para establecer un consenso y una asociación para la realización de actividades turísticas',
            'Garantía de beneficios económicos para el área protegida',
            'Estrategia y programas de información y comunicación que apoyen la sostenibilidad de los programas turísticos',
            'Gestión del alojamiento, la restauración y las actividades de ocio',
            'Gestión del transporte y la seguridad de los visitantes',
            'Alojamiento, servicio de alimentación y actividades de ocio para personas discapacitadas',
            'Gama de experiencias disponibles para los visitantes',
            'Guías turísticos en el área protegida',
            'Desarrollo constante de las atracciones turísticas',
            'Sentido del lugar (preservar o mejorar el carácter específico del espacio natural)',
            'Datos de seguimiento del turismo'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '0' => 'Completamente inadecuado (0-30%)',
                '1' => 'Algo inadecuado (31-60%)',
                '2' => 'Adecuado (61-90%)',
                '3' => 'Completamente adecuado (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Gestiona el área protegida (diseña, establece, mantiene y mejora) las instalaciones y servicios para visitantes necesarios para el turismo ambiental y ecoturismo?',
            'El turismo de las áreas protegidas es una industria grande y en crecimiento. El turismo es un servicio crítico del ecosistema que puede contribuir directa e indirectamente a las áreas protegidas como estrategia de conservación mundial, incluido el cumplimiento de los Objetivos de Aichi relacionados con la conservación, el desarrollo comunitario y la sensibilización del público (CDB, 2012). El turismo es un fenómeno complejo y sus interacciones con las áreas protegidas se producen en contextos históricos, culturales y geográficos singulares en los que intervienen múltiples valores y partes interesadas. La gestión eficaz del turismo en las áreas protegidas requiere una apreciación y comprensión de los contextos de sostenibilidad ambiental, social y económica y una gestión compatible de los servicios e instalaciones para los visitantes, así como la comprensión de la forma en que cambian con el tiempo.'
        ],
        'module_info_Rating' => [
            'Evaluar la idoneidad de la gestión de las instalaciones y servicios para visitantes del área protegida para el turismo ambiental y ecoturismo'
        ]
    ],

    'VisitorsImpact' => [
        'title' => 'Gestión del impacto de los visitantes',
        'fields' => [
            'Impact' => 'Criterio - Concepto medido  - Variables',
            'EvaluationScore' => 'Adecuación de la gestión del impacto de los visitantes',
            'Comments' => 'Comentarios/explicación',
        ],
        'predefined_values' => [
            'Medidas para determinar, monitorear y gestionar el nivel aceptable de impacto de los visitantes',
            'Acciones para minimizar los cambios inducidos por el hombre (transporte, alojamiento y actividades de ocio)',
            'Proceso de gestión que equilibra los objetivos de conservación con las actividades con fines de lucro [por ejemplo, 1) desarrollar un centro de visitantes y senderos, 2) limitar el uso para proteger la biodiversidad en un hábitat específico].',
            'Recopilación y comunicación de datos de vigilancia del turismo y pruebas de los efectos para aumentar la participación del público y la sensibilización de los visitantes'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A => Este elemento no está relacionado con la gestión del área protegida',
                '0' => 'Completamente inadecuado (0-30%)',
                '1' => 'Algo inadecuado (31-60%)',
                '2' => 'Adecuado (61-90%)',
                '3' => 'Completamente adecuado (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Gestiona y mitiga adecuadamente el área protegida los impactos de los visitantes?',
            'Promover la recreación y el turismo para que los visitantes puedan conocer y apreciar un área protegida, sin dañar los valores para los que fue establecida, puede ser un desafío. Los visitantes pueden tener un impacto negativo tanto en los recursos como en la experiencia de otros visitantes, o pueden también, sin saberlo, ofender las normas culturales. La vigilancia, gestión y mitigación adecuadas de los impactos de los visitantes son fundamentales para las estrategias de gestión del turismo sostenible, pero a menudo se pasan por alto una vez que el plan está en marcha. Sin un conocimiento adecuado de los efectos de las actividades turísticas en el entorno natural del sitio y las comunidades circundantes, es imposible establecer si la gestión del ecoturismo del área protegida tiene éxito'
        ],
        'module_info_Rating' => '•	Evaluar la gestión del impacto de los visitantes en el área protegida (turismo ambiental y ecoturismo)'
    ],

    'NaturalResourcesMonitoring' => [
        'title' => 'Sistemas de vigilancia de los recursos naturales y culturales',
        'fields' => [
            'Aspect' => 'Criterio - Concepto medido - Variables',
            'EvaluationScore' => 'Adecuación del Monitoreo',
            'Comments' => 'Comentarios/explicación',
        ],
        'predefined_values' => [
            'Diseño del monitoreo y su aplicación sobre el terreno (por ejemplo, monitoreo llevado a cabo por los guardaparques, los investigadores, técnicos, etc.)',
            'Capacidades institucionales y recursos técnicos para el monitoreo',
            'Seguridad del almacenamiento de los datos de monitoreo',
            'Utilización de los datos de monitoreo para inducir cambios en la gestión del área protegida',
            'Monitoreo de los principales objetivos de conservación',
            'Monitoreo de especies (emblemáticas o bandera, en peligro, endémicas, …) ',
            'Monitoreo de los hábitats y las dimensiones relacionadas de la cobertura del suelo, uso del suelo y tenencia del territorio',
            'Monitoreo de los ecosistemas de agua dulce (lagos, ríos y los pequeños estanques y arroyos)',
            'Monitoreo del nivel de vida material de las poblaciones en el área protegida y su zona de amortiguación',
            'Monitoreo de los niveles de vida inmateriales de las poblaciones en el área protegida y su zona de amortiguación',
            'Monitoreo de las amenazas directas e indirectas al área protegida',
            'Monitoreo de los impactos de los visitantes',
            'Monitoreo de los servicios/funciones ecosistémicas que presta el área protegida',
            'Monitoreo de los efectos del cambio climático en elementos clave del área protegida',
            'Recopilación y análisis de datos (i.e. SMART, Programas de Monitoreo Integral, Programas de monitoreo de especies, monitoreo basado en los guardaparques, monitoreo con Sistemas de Información Geográfico, monitoreo de focos de calor - quemas - incendios, otros)'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '0' => 'Totalmente inadecuado (0-30%)',
                '1' => 'Algo inadecuado (31-60%)',
                '2' => 'Adecuado (61-90%)',
                '3' => 'Totalmente adecuado (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Son adecuados los programas de monitoreo para realizar un seguimiento eficazmente la diversidad biológica y los recursos naturales y culturales del área protegida?',
            'El éxito de la ejecución de un programa de monitoreo depende del análisis de los principales objetivos de conservación del área protegida para establecer criterios e indicadores de monitoreo específicos. Bajo la influencia de fuerzas motrices negativas y amenazas (crecimiento demográfico y económico, fenómenos naturales, etc.), las actividades humanas ejercen presión sobre el área protegida. Esta presión provoca un cambio, una alteración o una degradación de los valores y recursos del área protegida. Para anticiparse a los posibles problemas y planificar las mejores intervenciones en el área protegida, es indispensable una sólida comprensión de las tendencias de los servicios y funciones ambientales y ecosistémicas (biodiversidad, abastecimiento de agua, suministro de alimentos, calidad de los bosques, amenazas, etc.)'
        ],
        'module_info_Rating' => [
            'Evaluar la idoneidad de los programas de monitoreo establecidos para la diversidad biológica y los recursos naturales y culturales del área protegida'
        ]
    ],

    'ResearchAndMonitoring' => [
        'title' => 'Investigación y monitoreo ecológico a largo plazo',
        'fields' => [
            'Program' => 'Criterio - Concepto medido - Variables',
            'EvaluationScore' => 'Adecuación de la investigación y el monitoreo a largo plazo',
            'Comments' => 'Comentarios/explicación',
        ],
        'predefined_values' => [
            'La investigación y la función del monitoreo ecológico/ambiental a largo plazo en la gestión del área protegida',
            'Fondos/instalaciones y capacidades institucionales y/o externas para promover y coordinar actividades de investigación',
            'Accesibilidad y seguridad de los datos de la investigación',
            'Apoyo a la gestión a partir de la investigación y los datos de monitoreo ecológico/ambiental a largo plazo',
            'Investigación y monitoreo ecológico/ambiental a largo plazo de especies (emblemáticas o bandera, en peligro, endémicas, etc.)',
            'Investigación y monitoreo ecológico/ambiental a largo plazo de los hábitats y las dimensiones relacionadas de la cobertura del suelo, uso del suelo y tenencia del territorio',
            'Investigación y monitoreo ecológico/ambiental a largo plazo de los ecosistemas de agua dulce (lagos, ríos y los estanques y arroyos más pequeños)',
            'La investigación y la monitoreo ecológico/ambiental a largo plazo del bienestar humano y material de la población en el área protegida',
            'Investigación y monitoreo ecológico/ambiental a largo plazo de las amenazas directas e indirectas al área protegida',
            'La investigación y la monitoreo ecológico/ambiental a largo plazo de los servicios/funciones del ecosistema que presta el área protegida',
            'Investigación y monitoreo ecológico/ambiental a largo plazo de los efectos del cambio climático en elementos clave de la área protegida'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '0' => 'Completamente inadecuado (0-30%)',
                '1' => 'Algo inadecuado (31-60%)',
                '2' => 'Adecuado (61-90%)',
                '3' => 'Completamente adecuado (91-100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Coordina o inicia el área protegida actividades de investigación y monitoreo ecológico/ambiental a largo plazo, y tiene acceso a los resultados de la investigación y los utiliza en la gestión?',
            'El propósito de la investigación y monitoreo ecológico/ambiental en un área protegida es obtener información sobre el desarrollo a largo plazo de determinados componentes de sus ecosistemas para predecir cuestiones futuras y planificar intervenciones de gestión. Un estudio debe seleccionar las áreas así como las especies, los hábitats, el agua, etc. para evaluar la salud ambiental de los valores y la importancia del área protegida. Podrían aplicarse cada vez más medidas funcionales como enfoque complementario para monitorear la integridad ecológica del área protegida'
        ],
        'module_info_Rating' => [
            '•	Evaluar la idoneidad de las acciones/aplicaciones de investigación que apoyan la gestión del área protegida'
        ]
    ],

    'ClimateChangeMonitoring' => [
        'title' => 'Gestión de la adaptación a los efectos del cambio climático',
        'fields' => [
            'Program' => 'Criterio - Concepto medido - Variables',
            'EvaluationScore' => 'Adecuación de la gestión de la adaptación',
            'Comments' => 'Comentarios/explicación',
        ],
        'predefined_values' => [
            'Gestionar la adaptación de las especies (por ejemplo, reubicar especies, etc.)',
            'Gestión de la adaptación de los hábitats y las dimensiones relacionadas de cobertura de suelos  -  uso del suelo  -  cobertura del suelo dentro y fuera del área protegida (evitar la fragmentación del bosque, el suelo desnudo, etc.)',
            'Gestión de la adaptación de los servicios/funciones ecosistémicas',
            'Reducir los factores de estrés que amplifican los impactos climáticos (por ejemplo, aumentar la conectividad, controlar las especies invasoras, etc.)',
            'Sostener o restaurar el proceso y la función del ecosistema para promover la resistencia (por ejemplo, restaurar la vegetación degradada, etc.)',
            'Proteger los ecosistemas intactos y conectados (por ejemplo, eliminar los impedimentos de las vías fluviales; evitar la fragmentación de los corredores, etc.)',
            'Proteger las zonas que constituyen el futuro hábitat de las especies desplazadas (por ejemplo, establecer asociaciones para proteger los hábitats críticos fuera del   área protegida para las especies clave afectadas por los efectos del cambio climático)',
            'Identificar y proteger el clima refugia  (por ejemplo, reducir el uso humano y las perturbaciones en los refugios, etc.)',
            'Gestionar las redes ecológicas para promover la resiliencia ecológica/ambiental para enfrentar el impacto climático',
            'Participar en la planificación de la adaptación de los paisajes terrestres y marinos que se extiende más allá de los límites de las áreas protegidas individuales'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '0' => 'Totalmente inadecuado (0-30%)',
                '1' => 'Algo inadecuado (31-60%)',
                '2' => 'Adecuado (61-90%)',
                '3' => 'Totalmente adecuado (91-100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Cómo gestiona el área protegida la adaptación a los efectos del cambio climático?',
            'La respuesta al cambio climático puede dividirse en "mitigación" (acciones que reducen la cantidad de dióxido de carbono y otros gases que atrapan el calor en la atmósfera) y "adaptación" (un ajuste de los sistemas humanos o naturales al clima cambiante). Si bien las áreas protegidas tienen la capacidad de capturar y almacenar carbono en sus ecosistemas y de reducir las emisiones de las operaciones de las áreas protegidas, el enfoque principal de la gestión suele ser la adaptación a los efectos del cambio climático'
        ],
        'module_info_Rating' => [
            'Evaluar la idoneidad de las medidas de gestión de la adaptación al cambio climático'
        ]
    ],

    'EcosystemServices' => [
        'title' => 'Gestión de los servicios y funciones ecosistémicas',
        'fields' => [
            'Intervention' => 'Criterio - Concepto medido - Variables',
            'EvaluationScore' => 'Adecuación de la gestión de los servicios/funciones ecosistémicas',
            'Comments' => 'Comentarios/explicación',
        ],
        'categories' => [
            'title1' => 'Aprovisionamiento',
            'title2' => 'Regulación',
            'title3' => 'Cultural',
            'title4' => 'Soporte',
        ],
        'groups' => [
            'group0' => 'Gestión de la nutrición (por ejemplo, agua, alimentos, forraje, plantas medicinales, pesca, etc.)',
            'group1' => 'Gestión de materiales (por ejemplo, reforestación para producir madera, Productos Forestales No Maderable (PFNM) de uso sostenible, otros materiales para extracción)',
            'group2' => 'Gestión de la energía (por ejemplo, la energía hidroeléctrica)',
            'group3' => 'Gestión del flujo de materiales de desecho, sustancias tóxicas (por ejemplo, filtrado y descomposición de residuos orgánicos y contaminantes en las aguas)',
            'group4' => 'Gestión del mantenimiento de las condiciones biológicas, químicas y físicas (por ejemplo, la polinización, la mitigación de los daños causados por los desastres naturales)',
            'group5' => 'Gestión para un alto nivel de interacciones físicas (por ejemplo, conservación ex-situ)',
            'group6' => 'Gestión de un alto nivel de interacciones intelectuales (por ejemplo, la investigación)',
            'group7' => 'Gestión para altos niveles de interacciones espirituales y/o emblemáticas entre el área protegida y los actores sociales locales (por ejemplo, ritos tradicionales)',
            'group8' => 'Gestión para hábitats sostenibles (polinización de cultivos, insectos, etc.)',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '0' => 'Totalmente inadecuado (0-30%)',
                '1' => 'Algo inadecuado (31-60%)',
                '2' => 'Adecuado (61-90%)',
                '3' => 'Totalmente adecuado (91-100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Gestiona el área protegida para promover la conservación/mejora de los servicios y/o funciones ecosistémicas que proporciona el área protegida?',
            '•	Los servicios y funciones ecosistémicas son los muchos y variados beneficios que los seres humanos obtienen libremente del medio ambiente natural y de los ecosistemas que funcionan correctamente. Los servicios y funciones ecosistémicas se agrupan en cuatro grandes categorías: 1) servicios o funciones de aprovisionamiento, como la producción de alimentos y agua; 2) servicios o funciones de regulación, como el control del clima y las enfermedades; 3) servicios o funciones culturales, como los beneficios espirituales y recreativos; y 4) servicios o funciones de apoyo, como los ciclos de los nutrientes, la polinización de los cultivos o los hábitats que proporcionan todo lo que una planta o un animal necesita para sobrevivir: alimento, agua y refugio [Evaluación de los Ecosistemas del Milenio (EM)].'
        ],
        'module_info_Rating' => [
            '•	Evaluar la idoneidad de las medidas de ordenación que promueven la conservación/mejora de los servicios y funciones ecosistémicas que presta el área protegida'
        ]
    ],

    'ObjectivesProcessus' => [
        'module_info' => 'Establecer y describir los objetivos de conservación relacionados <b> con el proceso implementación de la planificación</b> del área protegida.<br /> Los objetivos que se indican a continuación se utilizarán para mejorar la gestión y, más concretamente, para la planificación, la movilización de recursos (insumos), las fases del proceso y el seguimiento y monitoreo de las actividades de gestión del área protegida.'
    ],

    'WorkProgramImplementation' => [
        'title' => 'Implementación de las actividades del plan de trabajo/acción',
        'fields' => [
            'Category' => 'Categoría de actividades',
            'Activity' => 'Actividad',
            'TargetedActivity' => 'Actividades planificadas',
            'EvaluationScore' => 'Nivel de aplicación',
            'Comments' => 'Comentarios/explicación',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'No hay o hay un nivel muy bajo de ejecución de las actividades específicas del año anterior (entre el 0 y el 25%)',
                '1' => 'Bajo nivel de ejecución de las actividades específicas del año anterior (entre el 26 y el 50%)',
                '2' => 'Nivel moderado de ejecución de las actividades específicas del año anterior (entre el 51 y el 75%)',
                '3' => 'Alto nivel de ejecución de las actividades específicas del año anterior (entre el 76 y el 100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿En qué medida ha llevado a cabo el área protegida las principales actividades del plan de trabajo?',
            'La aplicación es la realización o ejecución del plan de trabajo/acción anual o plurianual relativo a las actividades del área protegida. Como tal, la aplicación es la acción que debe seguir a cualquier actividad previa de planificación, gestión y conservación. Cuando el área protegida implementa un plan de trabajo, puede lograr acciones de gestión y conservación específicas de manera sostenible'
        ],
        'module_info_Rating' => [
            'Evaluar el nivel de implementación de las principales actividades del plan de trabajo/de acción del año anterior (en el recuadro de observaciones indique el año de referencia si solicita un plan de trabajo/de acción plurianual)',
            '<b>Categoría de actividades</b>: por ejemplo, aplicación de la ley, desarrollo de instalaciones sociales, educación ambiental, gestión del turismo, etc.',
            '<b>Actividad</b>: acción perteneciente a una de las principales categorías de actividades que se ejecuta para lograr un propósito particular',
            'Sin un plan de trabajo/acción, puede referirse a las categorías y las actividades del elemento Proceso: Gestión y protección de los elementos clave; Relaciones con las partes interesadas; Turismo; Vigilancia e investigación; Cambio climático y Servicios de los ecosistemas'
        ]
    ],

    'AchievedResults' => [
        'title' => 'Logro de resultados del plan de trabajo/acción',
        'fields' => [
            'Category' => 'Categoría de actividades',
            'Activity' => 'Actividad',
            'TargetedOutput' => 'Resultado del objetivo',
            'EvaluationScore' => 'Nivel de logro',
            'Comments' => 'Comentarios/explicación',
        ],
        'module_info' => 'El sistema estadístico permite sólo cinco líneas para identificar las funciones del personal del área protegida',
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'No se alcanzó o se ha alcanzado muy poco el resultado previsto del año anterior (entre el 0 y el 25%)',
                '1' => 'Bajo nivel de logro de la meta del año anterior (entre el 26 y el 50%)',
                '2' => 'Nivel moderado de logro de la meta del año anterior (entre el 51 y el 75%)',
                '3' => 'Alto nivel de logro de la meta del año anterior (entre 76 y 100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿En qué medida ha alcanzado el área protegida los principales resultados del plan de trabajo?',
            'El enfoque predominante para la planificación de las áreas protegidas incluye el establecimiento de resultados de planes de trabajo/acciones anuales o multianuales que contribuyan al logro de los objetivos de conservación a largo plazo/objetivos o EFECTOS E IMPACTOS. En el proceso de planificación, las metas/objetivos a más largo plazo se traducen en objetivos de conservación a corto plazo para características específicas de la diversidad biológica, como especies, hábitats y amenazas o servicios de los ecosistemas que es posible lograr con el plan de trabajo/acción. Sin embargo, dado que la utilización de muchas metas de conservación de bajo nivel es un obstáculo para lograr un rendimiento de conservación de alto nivel, los productos deben estar fuertemente vinculados a los resultados para asegurar un rendimiento de conservación de alto nivel. El establecimiento de sistemas de medición del rendimiento es una forma importante de hacer un seguimiento de los progresos de sus actividades de gestión y conservación'
        ],
        'module_info_Rating' => [
            'Evaluar el nivel de logro/cumplimiento de las principales metas del plan de trabajo/acción (en las observaciones, indicar el año de referencia si se solicita un plan de trabajo/acción plurianual).',
            '<b>Categoría de actividades</b>: acción perteneciente a una de las principales categorías de actividades que se ejecuta para lograr un propósito particular',
            '<b>Actividad</b>: action belonging to one of the main categories of activities that is executed to achieve particular purpose',
            'Sin un plan de trabajo/acción, puede referirse a las categorías y las actividades del elemento Proceso: Gestión y protección de los elementos clave; Relaciones con las partes interesadas; Turismo; Monitoreo e investigación; Cambio climático y Servicios/funciones ecosistémicas'
        ]
    ],

    'AreaDomination' => [
        'title' => 'Dominio del área',
        'fields' => [
            'Patrol' => 'A) Zona/áreas cubiertas por patrullajes',
            'RapidIntervention' => 'B) Capacidad de intervención rápida',
            'AirVehicles' => 'C.1) Medios especiales disponibles y adecuados para la vigilancia',
            'Planes' => 'C.2) Medios especiales disponibles y adecuados para una intervención rápida',
            'Comments' => 'Comentarios/explicación'
        ],
        'ratingLegend' => [
            'Patrol' => [
                '0' => 'El área cubierta por patrullajes de vigilancia es mínima (de 0 a 25% de la superficie)',
                '1' => 'El área cubierta por el estudio de patrullajes es limitada (del 26 al 50% de la superficie)',
                '2' => 'El área cubierta por la encuesta de patrullajes es justa (del 51 al 75% de la superficie)',
                '3' => 'El área cubierta por la encuesta de patrullajes es muy buena (más del 76% de la superficie)',
            ],
            'RapidIntervention' => [
                '0' => 'La capacidad de intervención rápida en el área protegida es mínima (de 0 a 25% de la superficie)',
                '1' => 'La capacidad de intervención rápida en la zona protegida es limitada (del 26 al 50% de la superficie)',
                '2' => 'La capacidad de intervención rápida en el área protegida es justa (del 51 al 75% de la superficie)',
                '3' => 'La capacidad de intervención rápida en la zona protegida es muy buena (más del 76% de la superficie)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            '¿Cuál es la extensión del área actual del dominio por parte del área protegida?',
            'La dominación de una zona se refiere a la capacidad de la administración del parque para crear presencia en una zona determinada, por ejemplo, mediante encuestas de patrullaje regulares, intervenciones rápidas o vigilancia aérea. Cuando sea necesario, esta presencia debe imponerse con frecuencia y eficacia para hacer frente a amenazas como la caza furtiva o las actividades ilegales. El objetivo de un alto grado de dominio de la zona es prevenir o reducir al mínimo las actividades ilegales que afectan a la biodiversidad y los valores culturales o históricos, y hacer cumplir la protección del área protegida y sus límites'
        ],
        'module_info_Rating' => [
            'Evaluar la dominación del área basándose en el porcentaje de la superficie del área protegida en el que la gestión está presente o puede estar presente a través de: (A) estudios de patrullaje; (B) intervenciones rápidas; (C) utilización de medios especiales'
        ]
    ],

    'AreaDominationMPA' => [
        'title' => 'XXXXXXXX Enforcement in MPA',
        'fields' => [
            'Activity' => 'XXXXXXXX Range of activities subject to analysis',
            'Patrol' => 'Area covered by patrols',
            'RapidIntervention' => 'Rapid intervention capacity',
            'DetectionRemoteSensing' => 'XXXXXXXX Detection via remote-sensing tools (ie vessel monitoring systems VMS)',
            'SpecialMeansRapidIntervention' => 'XXXXXXXX Special means supporting rapid intervention',
        ],
        'groups' => [
            'group0' => 'XXXXXXXX Sanctuary',
            'group1' => 'XXXXXXXX No-take areas / Marine reserve',
            'group2' => 'XXXXXXXX Buffer zones for traditional use',
            'group3' => 'XXXXXXXX Buffer zones for educational and/or recreational activities',
            'group4' => 'XXXXXXXX Dockside enforcement for vessels that come to port'
        ],
        'predefined_values' => [
            'group0' => [
                'XXXXXXXX All activities/uses prohibited'
            ],
            'group1' => [
                'XXXXXXXX Prohibited activities (e.g. fishing or extraction of any kind, anchoring, boating, dumping, etc.)',
                'XXXXXXXX Allowed activities (e.g. research and monitoring, etc.)'
            ],
            'group2' => [
                'XXXXXXXX Prohibited activities (e.g. illegal fishing and specified legal fishing methods, anchoring, dumping)',
                'XXXXXXXX Allowed activities (e.g. limited and specified traditional fishing and boating, swimming and diving, anchoring on mooring buoys, research, etc.) '
            ],
            'group3' => [
                'XXXXXXXX Allowed activities (e.g. limited and specified traditional fishing and boating, swimming and diving, anchoring on mooring buoys, research and education, etc.)'
            ],
            'group4' => [
                'XXXXXXXX Activities used to gather information that may that shed light on patterns of illicit behaviours. Dockside strategies should be tailored to promote the most appropriate enforcement for large MPAs or to address enforcement problems in smaller, near-shore MPAs.'
            ],
        ],
        'ratingLegend' => [
            'Patrol' => [
                '0' => 'Area covered by patrols survey is minimal (from 0 to 25% of the surface area)',
                '1' => 'Area covered by patrols survey is limited (from 26 to 50% of the surface area)',
                '2' => 'Area  covered by patrols survey is fair (from 51 to 75% of the surface area)',
                '3' => 'Area covered by patrols survey is very good (more than 76% of the surface area)',
            ],
            'RapidIntervention' => [
                '0' => 'Rapid intervention capacity in the protected area is minimal (from 0 to 25% of the surface area)',
                '1' => 'Rapid intervention capacity in the protected area is limited (from 26 to 50% of the surface area)',
                '2' => 'Rapid intervention capacity in the protected area is fair (from 51 to 75% of the surface area)',
                '3' => 'Rapid intervention capacity in the protected area is very good (more than 76% of the surface area)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'XXXXXXXX What is the current extent of enforcement in MPA?',
            'XXXXXXXX Enforcement in MPA refers to the ability of park management to create presence in a given area, for example through regular patrols surveys, rapid interventions or airborne surveillance or detection via remote-sensing tools. Where required, this presence needs to be imposed frequently and effectively to address threats such as poaching or illegal activities. The aim of high enforcement in MPA is to prevent or minimise illegal activities affecting the biodiversity, cultural or historical values, and to enforce the protection of the protected area and its boundaries'
        ],
        'module_info_Rating' => [
            'Evaluate the area domination based on the percentage of the protected area’s surface area where the management is present or can be present through (A) patrols surveys; (B) rapid interventions; (C) using special means'
        ]
    ],

    'AchievedObjectives' => [
        'title' => 'Logro de los objetivos de conservación a largo plazo del plan de manejo/gestión/rector',
        'fields' => [
            'Objective' => 'Principales metas/objetivos a largo plazo',
            'EvaluationScore' => 'Nivel de logro de los objetivos',
            'Comments' => 'Comentarios/explicación',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Ningún o muy bajo nivel de logro (entre 0 y 25%).',
                '1' => 'Bajo nivel de logro (entre el 26 y el 50%)',
                '2' => 'Nivel de logro moderado (entre el 51 y el 75%)',
                '3' => 'Alto nivel de logro (entre 76 y 100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿En qué medida ha alcanzado el área protegida los principales objetivos del plan de manejo/gestión/rector?',
            '(Basado en el análisis del contexto de la intervención, punto CTX1.5 Visión - Misión - Objetivos o elementos de Planificación, punto P6 - Objetivos del área protegida)',
            'La gestión de las áreas protegidas se lleva a cabo cada vez más de acuerdo con los principios de la "gestión por objetivos". Las metas y objetivos de un área protegida deben entenderse claramente si se quiere que la gestión tenga éxito sobre la base de logros mensurables. En esta herramienta hacemos una importante distinción entre resultados y productos:<ul><li>Los RESULTADOS se relacionan con las METAS / OBJETIVOS, es decir, las metas / objetivos a largo plazo o las visiones expresadas en el plan de manejo/gestión. Estas metas / objetivos suelen ser declaraciones específicas relacionadas con los valores clave del área protegida (es decir, especies importantes o servicios/funciones ecosistémicas) o con las principales áreas de actividades de gestión (por ejemplo, el turismo, la educación).</li><li>Los EFECTOS se relacionan con MOTIVOS, es decir, metas cuantitativas a corto plazo (o relativamente a corto plazo) para alcanzar las metas / objetivos a largo plazo y los objetivos específicos. Creemos que el uso de muchas metas de conservación de bajo nivel es un obstáculo para lograr un alto rendimiento de la conservación</li></ul>'
        ],
        'module_info_Rating' => [
            'Evaluar el nivel de logro de las principales metas/objetivos a largo plazo relacionados con los valores clave del área protegida o las principales áreas del plan de gestión.'
        ]
    ],

    'KeyConservationTrend' => [
        'title' => 'Condiciones y tendencias de los elementos clave de la conservación del área protegida',
        'fields' => [
            'Element' => 'Elemento clave de conservación',
            'Condition'=> 'Condición del elemento clave',
            'Trend'=> 'Tendencia del elemento clave',
            'Reliability' => 'Fiabilidad de la información',
            'Comments' => 'Comentarios/explicación',
        ],
        'groups' => [
            'group0' => 'Condiciones y tendencias de conservación de especies clave de animales',
            'group1' => 'Condiciones y tendencias de conservación de especies clave de plantas',
            'group2' => 'Condiciones de conservación y tendencias de los hábitats y las dimensiones relacionadas del territorio - uso del suelo - cobertura del suelo',
            'group3' => 'Situaciones y tendencias de las amenazas al área protegida',
            'group4' => 'Adaptación al cambio climático',
            'group5' => 'Condiciones y tendencias de conservación de los servicios y funciones ecosistémicas del área protegida'
        ],
        'ratingLegend' => [
            'Condition' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '-3' => 'Muy malo',
                '-2' => 'Malo',
                '-1' => 'Ligeramente malo',
                '0' => 'Neutral',
                '+1' => 'Ligeramente bueno',
                '+2' => 'Bueno',
                '+3' => 'Muy bueno',
            ],
            'Trend' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '-3' => 'Disminuyendo fuertemente',
                '-2' => 'Disminuyendo',
                '-1' => 'Ligeramente decreciente',
                '0' => 'No hay cambios',
                '+1' => 'Aumentando ligeramente',
                '+2' => 'Aumentando',
                '+3' => 'Aumentando fuertemente',
            ],
            'Reliability' => [
                'High' => 'Certeza casi completa sobre los valores de la condición y las tendencias',
                'Medium' => 'Alguna posibilidad de error sobre los valores de la condición y las tendencias',
                'Poor' => 'Gran incertidumbre sobre los valores de la condición y las tendencias',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Cuáles son las condiciones y tendencias de los elementos clave de conservación del área protegida?',
            'Las principales metas/objetivos de gestión del área protegida son la conservación/restauración de los valores naturales y los beneficios que los seres humanos obtienen del medio ambiente natural y de los ecosistemas que funcionan correctamente (servicios y funciones ecosistémicas). Los administradores deberían asegurar la conservación/restauración de valores clave (especies animales y vegetales, hábitats, etc.) y la preservación de los servicios de aprovisionamiento, de regulación, culturales y de apoyo del ecosistema, asegurando los valores y beneficios de las áreas protegidas para todos'
        ],
        'module_info_Rating' => [
            'Evaluar: A) las condiciones y B) las tendencias de los elementos clave de conservación del área protegida (basado en el Contexto 1 y 3, los elementos del proceso PR7 - Gestión de los valores y elementos clave del área protegida con acciones específicas, PR 17 adaptación al cambio climático y PR18 - Gestión de las funciones/servicios de los ecosistemas)'
        ]
    ],

    'LifeQualityImpact' => [
        'title' => 'Efectos sobre la calidad de vida de los actores locales',
        'fields' => [
            'Element' => 'Criterio - Concepto medido - Variables',
            'EvaluationScore' => 'Efectos',
            'Comments' => 'Comentarios/explicación',
        ],
        'groups' => [
            'group0' => 'Elementos del nivel de vida material',
            'group1' => 'Elementos del nivel de vida inmaterial',

        ],
        'predefined_values' => [
            'group0' => [
                'XXXXXXXXX Local activities strengthened (food production, small-scale farming, small-scale fishing, handicraft, services for the protected area, etc.)',
                'XXXXXXXXX Support to local business (power supply, water supply, commerce, roads between villages, boat sheds, boat parking, etc.)',
                'Servicios de aprovisionamiento de los ecosistemas: (alimentos, materias primas, etc.)',
                'Ingresos por turismo',
                'Conflictos entre el hombre y la fauna silvestre',
                'Empleos de la población local'
            ],
            'group1' => [
                'Protección de las personas, instalaciones e infraestructuras y estabilidad social',
                'Mantenimiento de la cantidad y calidad de los servicios de aprovisionamiento de los ecosistemas',
                'Contribución a la educación',
                'Contribución a la mejora de la salud pública local',
                'Mantenimiento del valor emblemático y espiritual del territorio local',
                'Mantenimiento o fortalecimiento de la identidad comunitaria (cultural, tradicional, espiritual, etc.)',
                'Reducción de los conflictos de los usuarios de los recursos naturales'
            ]
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'Este elemento no está relacionado con la gestión del área protegida',
                '-3' => 'Efectos altamente perjudiciales',
                '-2' => 'Efectos perjudiciales',
                '-1' => 'Efectos ligeramente perjudiciales',
                '0' => 'Neutral',
                '+1' => 'Efectos ligeramente favorables',
                '+2' => 'Efectos favorables',
                '+3' => 'Efectos altamente favorables',
                ]
        ],
        'module_info_EvaluationQuestion' => [
            '¿Tiene la gestión del área protegida efectos positivos o negativos en la calidad de vida de los actores locales?',
            'Desde la perspectiva del ecosistema, todas las personas dependen del capital natural y de los servicios y funciones ecosistémicas. Los cambios en el medio ambiente (condiciones presentes y futuras) y la disponibilidad de recursos esenciales pueden afectar a la calidad de vida (las contribuciones que los servicios de los ecosistemas hacen al bienestar) a través de los impactos en el consumo, los ingresos y la riqueza (niveles de vida material) y en la buena vida, la salud y las relaciones sociales y culturales (niveles de vida inmateriales). La gestión de las áreas protegidas debe tener mucho cuidado en los efectos sobre la calidad de vida de los actores locales'
        ],
        'module_info_Rating' => [
            'Evaluar los efectos para los interesados locales derivados de las actividades operacionales del área protegida'
        ]
    ]
];
