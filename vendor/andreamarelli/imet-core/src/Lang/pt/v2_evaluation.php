<?php

return [

    '_Objectives' => [
        'title' => 'Definição de objectivos',
        'fields' => [
            'Element' => 'Elemento/Indicador',
            'Status' => 'dado de referencia',
            'Objective' => 'Objectivo - Favorável ao estado de ocnservacao',
            'comments' => 'Commentários'
        ],
    ],

    'ImportanceClassification' => [
        'title' => 'Designações',
        'fields' => [
            'Aspect' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Integracao',
            'SignificativeClassification' => 'Designação internacional altamente significante',
            'Comments' => 'Comentários/Explicaçõe',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'sem integração',
                '1' => 'baixa integração',
                '2' => 'integração moderada',
                '3' => 'alta integração',
            ]
        ],
        'module_subTitle' => 'Valor e Importancia - Designação',
        'module_info_EvaluationQuestion' => [
            'Terá a área protegida incluido os valores e a importância das designações nacionais, regionais ou internacionais na gestão da área protegida?'
        ],
        'module_info_Rating' => [
            'Avaliar a integração dos valores e a importância das designações (designação nacional e designação internacional, por exemplo, sítio do Património Mundial ou sítio Ramsar) na gestão da área protegida'
        ]
    ],

    'ObjectivesClassification' => [
        'module_info' => 'Estabelecer e descrever objectivos de conservação para a(s) actual(is) designação(ões) <b>nacional, regional ou internacional</b> da área protegida.<br/> Os objectivos inseridos abaixo serão utilizados para melhorar a gestão, e mais especificamente para o planeamento, mobilização de recursos (input), fases do processo, e para o controlo das actividades de gestão da área protegida.'
    ],

    'ImportanceSpecies' => [
        'title' => 'Espécies Chave',
        'fields' => [
            'Aspect' => 'Criterio - Conceito Medido - Variável',
            'EvaluationScore' => 'Integração',
            'SignificativeSpecies' => 'Espécies altamente representativas',
            'IncludeInStatistics' => 'Dar prioridade na gestão',
            'Comments' => 'Comentários/Explicação',
        ],
        'groups' => [
            'group0' => 'Identificar as espécies animais (emblemáticas, em perigo, endémicas, …) escolhidas com espécies chave',
            'group1' => 'Identificar espécies de plantas (emblemáticas, em perigo, endémicas, …) escolhidas com espécies chave',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'sem integração',
                '1' => 'baixa integração',
                '2' => 'integração moderada',
                '3' => 'alta integração',
            ]
        ],
        'module_subTitle' => 'Valores e Importancia - Espécies (emblemática, ameaçada, endémica, explorada, invasiva, etc.)',
        'module_info_EvaluationQuestion' => [
            'Terá a A área protegida identificado e integrado claramente as espécies-chave na gestão da área protegida?'
        ],
        'module_info_Rating' => [
            'Avaliar o nível de integração de 3 a 10 espécies-chave na gestão da área protegida (com base numa análise do Contexto de Intervenção, pontos 4.1 e 4.2, automaticamente comunicados abaixo). A representatividade de uma espécie chave corresponde ao grau de representatividade da mesma: (i) representa uma característica natural forte de um habitat, ecossistema, bioma; (ii) influencia um processo ecológico ou uma comunidade ou (iii) afecta uma política de gestão dirigida à espécie)'
        ],
        'validation_3to10' => 'Por favor incluir nas estatiticas não menos que 3 e não mais de 10 das espécies chave',
        'warning_on_save' =>
            'Qualquer <br/> modificação pode causar perda de dados no seguinte
            módulos de avaliação (se já codificados):<br /><i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'ObjectivesSpecies' => [
        'module_info' => 'Estabelecer e descrever objectivos de conservação para <b> espécies (emblemáticas, ameaçadas, endémicas, exploradas, invasoras ou para as quais não existem dados suficientes)</b> na área protegida.<br/> Os objectivos inseridos abaixo serão utilizados para melhorar a gestão, e mais especificamente para o planeamento, mobilização de recursos (insumos), fases do processo, e para o controlo das actividades de gestão da área protegida.'
    ],

    'ImportanceHabitats' => [
        'title' => 'Valores e Importancia (Habitats terrestre e marinho - tipos de cobertura, mudança, ocupação e uso solo)',
        'fields' => [
            'Aspect' => 'Critério - Conceito medido - Variável',
            'EvaluationScore' => 'Integração',
            'EvaluationScore2' => 'Valor/importância regional e global',
            'IncludeInStatistics' => 'Dar prioridade na gestão',
            'Comments' => 'Comentários/Explicação',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'sem integração',
                '1' => 'baixa integração',
                '2' => 'integração moderada',
                '3' => 'alta integração',
            ],
            'EvaluationScore2' => [
                '1' => 'baixo valor/importância',
                '2' => 'valor/importância moderada',
                '3' => 'alto valor/importância',
            ],
        ],
        'module_subTitle' => 'Valores e Importancia - Habitats Terrestre e Marinho - tipos de cobertura, mudança e ocupação e uso solo',
        'module_info_EvaluationQuestion' => [
            'Terá a área protegida identificado e integrado claramente os habitats terrestres e marinhos mais importantes e as dimensões relacionadas da cobertura terrestre, da mudança de terra e da ocupação do solo na gestão da área protegida?'
        ],
        'module_info_Rating' => [
            'Avaliar o nível de integração na gestão da área protegida de 3 a 10 dos habitats e dimensões relacionadas mais representativas e importantes dos tipos de cobertura, mudança e ocupação do solo (com base na análise do Contexto de Intervenção, pontos 4.3, automaticamente comunicados abaixo). (O valor/importância regional e global dos habitats é um grau em que se encontra: - i - representas os  a níveis regional ou global o ambiente natural das principais plantas ou animais; (ii) influencia um processo ecológico ou a comunidade ecológica and - iii - affecta a política em relação gestão dirigida ao habitat)'
        ],
        'validation_3to10' => 'Por favor inclua nas estatisticas não menos que 3 e não mais que 10 das espécies chave',
        'warning_on_save' =>
            'Qualquer <br/> modificação pode causar perda de dados no seguinte
            módulos de avaliação (se já codificados):<br /><i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'ObjectivesHabitats' => [
        'module_info' => 'Estabelecer e descrever objectivos de conservação para manter os <b>habitats terrestres e marinhos e as dimensões relacionadas de cobertura terrestre, mudança de terra e ocupação do solo</b>. <br/>Os objectivos (realizações e resultados) inseridos abaixo serão utilizados para melhorar a gestão, e mais especificamente para o planeamento, mobilização de recursos, fases do processo, e para o controlo das actividades de gestão na área protegida.'
    ],

    'ImportanceClimateChange' => [
        'title' => 'Alterações Climaticas',
        'fields' => [
            'Aspect' => 'Criterio – Conceito medido – Variável',
            'EvaluationScore' => 'integração',
            'IncludeInStatistics' => 'Para priorizar na gestão',
            'Comments' => 'Commentários/Explicação',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '0' => 'sem integração',
                '1' => 'baixa integração',
                '2' => 'integração moderada',
                '3' => 'alta integração',
            ]
        ],
        'module_subTitle' => 'Valores e Importância - Alteração Climática',
        'module_info_EvaluationQuestion' => [
            'Terá a A área protegida identificado e integrado claramente os elementos-chave (espécies, habitats, etc.) mais vulneráveis às alterações climáticas na gestão da área protegida para adoptar as melhores medidas de adaptação disponíveis?'
        ],
        'module_info_Rating' => [
            'Avaliar o nível de integração na gestão da área protegida dos elementos-chave mais importantes (espécies, habitats, etc.) mais vulneráveis às alterações climáticas (com base na análise do Contexto de Intervenção, pontos CTX6.1, automaticamente comunicados abaixo)'
        ],
        'warning_on_save' =>
            'Qualquer <br/> modificação pode causar perda de dados no seguinte
            módulos de avaliação (se já codificados):<br /><i>I1</i>, <i>PR7</i>, <i>PR17</i> and <i>O/C2</i>'
    ],

    'ObjectivesClimateChange' => [
        'module_info' => 'Estabelecer e descrever objectivos de conservação para os <b>efeitos mais significativos das alterações climáticas</b> na área protegida.<br/> Os objectivos inseridos abaixo serão utilizados para melhorar a gestão, e mais especificamente para o planeamento, mobilização de recursos (insumos), fases do processo, e para o controlo das actividades de gestão da área protegida.'
    ],

    'ImportanceEcosystemServices' => [
        'title' => 'Servicos Ecossistémicos',
        'fields' => [
            'Aspect' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Classificação',
            'IncludeInStatistics' => 'Para priorizar na gestão',
            'Comments' => 'Commentário/Explicação',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'Este elemento não está relacionado com a gestão da área protegida',
                '0' => 'sem integração',
                '1' => 'baixa integração',
                '2' => 'integração moderada',
                '3' => 'alta integração',
            ]
        ],
        'module_subTitle' => 'Valores e serviços Importancia - Serviços Ecossistémicos',
        'module_info_EvaluationQuestion' => [
            'Terá a área protegida identificado e integrado claramente os serviços ecossistémicos mais importantes para o bem-estar humano na gestão da área protegida?'
        ],
        'module_info_Rating' => [
            'Avaliar o nível de integração na gestão da área protegida dos serviços ecossistémicos mais importantes (com base na análise do Contexto do Ponto de Intervenção CTX7.1, automaticamente reportado abaixo).'
        ],
        'warning_on_save' =>
            'Qualquer <br/> modificação pode causar perda de dados no seguinte
            módulos de avaliação (se já codificados):<br /><i>I1</i>, <i>PR7</i>, <i>PR18</i> and <i>O/C2</i>'
    ],

    'ObjectivesEcosystemServices' => [
        'module_info' => 'Estabelecer e descrever objectivos de conservação para <b>, preservando os serviços ecossistémicos</b> na área protegida <br /> Os objectivos inseridos abaixo serão utilizados para melhorar a gestão, e mais especificamente para o planeamento, mobilização de recursos, fases do processo, e para o controlo das actividades de gestão da área protegida.'
    ],

    'SupportsAndConstraints' => [
        'title' => 'Constrangimentos/conflitos externos ou factores de apoio/conformidade',
        'fields' => [
            'Aspect' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Influência/poder das partes interessadas',
            'EvaluationScore2' => 'Nível do constrangimento/conflito ou apoio/conformidade',
            'Comments' => 'Comentários/Explicação',
        ],
        'groups' => [
            'group0' => 'Comunidade local',
            'group1' => 'Governo',
            'group2' => 'Doadores, Cientistas, Investigadores e ONGs',
            'group3' => 'Operadores Económicos',
        ],
        'predefined_values' => [
            'group0' => [
                'Autoridades Tradicionais',
                'Povos Indigenas',
                'Comunidades vivendo perto ou no interior do Parque',
                'Comunidades não vivendo perto ou no interior do Parque',
                'Titulares de direitos',
                'Proprietários de Terras',
                'Utilizadores locais dos recursos naturais',
                'Utilizadores local de produtos florestais nao madeireiros (NTFP)',
                'Grupos sub representados e desfavorecidos',
            ],
            'group1' => [
                'Governo Central',
                'Governo Local',
                'Conselho territorial/departamental e municipal',
                'Autoridade da área protegida',
                'Ambiente dos Serviços locais terrestres',
                'Representantes das populações locais (representantes parlamentares, etc.)',
                'Forças armadas (paramilitares, polícia, força e marinha)',
            ],
            'group2' => [
                'ONG de direitos sociais',
                'ONG Ambiental',
                'Cientistas/Pesquisadores',
                'Doadores',
            ],
            'group3' => [
                'Operadores privados de turismo',
                'Operadores Florestais',
                'Operadores de pesca',
            ],
        ],

        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'esta parte interessada não está envolvida no processo',
                '1' => 'Baixa influência/poder',
                '2' => 'Influência/poder moderado',
                '3' => 'Alta influência/poder'
            ],
            'EvaluationScore2' => [
                '-3' => 'Graves restrições/conflitos geradas por esta parte interessada',
                '-2' => 'Restrições/conflitos geradas por esta parte interessada',
                '-1' => 'Algumas restrições/conflitos geradas por esta parte interessada',
                '0' => 'Não condiciona nem apoia o papel desta parte interessada',
                '+1' => 'Alguns apoios/conformidades desta parte interessada',
                '+2' => 'Apoio/conformidade (menor - moderado - severo)',
                '+3' => 'Forte apoio/conformidade desta parte interessada',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'A gestão da área protegida está sujeita a restrições/conflitos ou beneficia de factores de apoio/conformidade decorrentes do ambiente político, institucional e social externo?',
            '<i>O ambiente político, institucional e civil pode obstruir (constrangimentos/conflitos externos) ou facilitar (apoios/conformidades externos) as actividades de conservação da área protegida. Os constrangimentos/conflitos ou apoios/conformidades do ambiente político, institucional e civil externo podem ser medidos pela sua intensidade, e pela influência/potência das partes interessadas em constranger ou apoiar a área protegida.</i>'
        ],
        'module_info_Rating' => [
            'Avaliar os constrangimentos/conflitos ou factores de apoio/conformidade mais importantes do ambiente político, institucional e civil externo na gestão da área protegida'
        ]
    ],

    'ObjectivesSupportsAndConstraints' => [
        'module_info' => 'Estabelecer e descrever objectivos de conservação para <b> constrangimentos/conflitos ou factores de apoio/conformidade </b> à área protegida<br /> Os objectivos inseridos abaixo serão utilizados para melhorar a gestão, e mais especificamente para o planeamento, mobilização de recursos, fases do processo, e para a monitorização das actividades de gestão da área protegida.'
    ],

    'Menaces' => [
        'title' => 'Ameaçada',
        'fields' => [
            'Aspect' => 'Avaliação das ameaças (automaticamente reportado de CTX 5.1)',
            'IncludeInStatistics' => 'Para priorizar na gestão',
            'Comments' => 'Comentários/Explicação',
        ],
        'module_info_EvaluationQuestion' => [
            'Terá a área protegida identificado e integrado claramente as ameaças (pressões, ameaças e vulnerabilidades) que podem afectar a biodiversidade da área, o património cultural, os serviços dos ecossistemas, etc., na gestão da área protegida?'
        ],
        'module_info_Rating' => [
            'Avaliar o nível de integração na gestão da área protegida das ameaças mais importantes com base na análise da calculadora de ameaças no contexto do ponto de intervenção CTX 5.1 e reportado automaticamente abaixo.'
        ],
        'warning_on_save' =>
            'Qualquer <br/> modificação pode causar perda de dados no seguinte
            módulos de avaliação (se já codificados):<br /><i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'ObjectivesMenaces' => [
        'module_info' => 'Estabelecer as metas dos objectivos da conservação e indicadores para <b>as ameaças mais importantes que a área protegida enfrenta g</b> <br /> Os objectivos inseridos abaixo serão utilizados para melhorar a gestão, e mais especificamente para o planeamento, mobilização de recursos, fases do processo, e para a monitorização das actividades de gestão da área protegida.'
    ],

    'RegulationsAdequacy' => [
        'title' => 'Adequação de provisoes legais e regulatórias',
        'fields' => [
            'Regulation' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Adequação',
            'Comments' => 'Comentários/Explicação',
        ],
        'predefined_values' => [
            'Declaração e designação (e.g. parque nacional)',
            'Clareza da demarcação legal da área protegida (por exemplo, limites naturais como rios, limites não naturais, direitos consuetudinários, enclaves, etc.).',
            'Regras internas para a gestão da área protegida',
            'Ratificação e aplicação de convenções internacionais (CITES, CBD, Nagoya, CMS, Património Mundial, RAMSAR, etc.)',
            'Leis sobre área protegida e conservação',
            'Leis sobre a gestão dos recursos naturais (complementares às leis sobre a conservação)',
            'Leis e convenções sobre investigação sobre biodiversidade e recursos naturais',
            'Leis sobre direitos de terra',
            'Direito consuetudinário (ver P2)',
            'Acordos voluntários, incluindo parcerias público-privadas (que podem incluir, por exemplo, esquemas voluntários de compensação da biodiversidade)',
            'Impostos, encargos, taxas de utilização (por exemplo, taxas de entrada em parques marítimos)',
            'Certificação, rotulagem ecológica (por exemplo, MSC Marine Stewardship Council)',
            'Encerramentos de pesca espaciais e temporais; limites de número e tamanho de embarcações (controlos de entrada); outras restrições ou proibições de utilização (por exemplo, CITES)',
            'Normas (por exemplo, MARPOL para navios); proibição da pesca de dinamite ou artes de pesca',
            'Limites ou quotas de captura (controlos de saída)',
            'Licenças e.g. aquacultura e parques eólicos offshore'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '0' => 'Totalmente inadequado',
                '1' => 'Um pouco inadequado',
                '2' => 'Suficiente',
                '3' => 'Totalmente adequado',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Serão as actuais disposições legais e regulamentares adequadas às actividades de conservação e gestão dos recursos naturais na área protegida?',
            '<i>Uma legislação e disposições regulamentares adequadas são a base para uma governação e um quadro de gestão eficazes e sólidos para a área protegida e, mais importante ainda, para assegurar a sua sustentabilidade a longo prazo para as gerações actuais e futuras</i>'
        ],
        'module_info_Rating' => [
            'Identificar e avaliar a adequação das actuais disposições legais e regulamentares para a conservação e gestão dos recursos naturais na área protegida'
        ]
    ],

    'DesignAdequacy' => [
        'title' => 'Concepção e disposição da área protegida',
        'fields' => [
            'Values' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Adequação',
            'Comments' => 'Comentários/Explicação',
        ],
        'predefined_values' => [
            'Tamanho (área de superfície)',
            'Configuração ou forma da área protegida',
            'Relação limite/área, valor baseado na análise do contexto de intervenção, ponto CTX 2',
            'Zonas limítrofes (áreas perto dos limites imediatamente depois da área protegida que tem regras especiais no uso dos recursos)',
            'Zonas tampão (áreas em redor de uma área protegida, onde são empreendidas medidas especiais de gestão da utilização dos recursos e medidas especiais de desenvolvimento a fim de aumentar o valor de conservação da área protegida)',
            'Corridores',
            'Integridade das bacias hidrográficas',
            'Zona de não utilização (No-Use zone)',
            'Zona de não tomada (No-take zone)',
            'Zonas tampão para uso tradicional',
            'Zonas tampão para actividades educativas e/ou recreativas',
            'Zona multiuso'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '0' => 'totalmente inadequado',
                '1' => 'Um pouco inadequado',
                '2' => 'adequado',
                '3' => 'totalmente adequado',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'A concepção e disposição da área protegida é adequada para proteger espécies, habitats, outros valores e manter processos naturais (por exemplo, bacias hidrográficas)?',
            'Metodologia de fundo: A concepção e disposição (configuração espacial) afectam a gestão dos ecossistemas, a biodiversidade e outros valores de uma área protegida. A concepção de áreas protegidas para proteger valores é complicada e nem todas as áreas protegidas têm uma concepção e disposição ideais para representar e manter os seus ecossistemas, biodiversidade e outros valores. A actual configuração espacial da área protegida deve ser avaliada com respeito ao objectivo de conservar os seus valores-chave. A análise deve mostrar se a concepção e disposição são adequadas para proteger plenamente os ecossistemas representativos, a biodiversidade e outros valores, ou se deve ser proposta uma disposição melhorada, se viável.'
        ],
        'module_info_Rating' => [
            'Avaliar se a concepção e disposição da área protegida (com base na análise do Contexto do ponto de intervenção CTX2) é adequada para assegurar que os seus valores-chave são protegidos e podem ser bem geridos.'
        ]
    ],

    'BoundaryLevel' => [
        'title' => 'Demarcação da área protegida',
        'fields' => [
            'Boundaries' => 'Grau de demarcação dos limites',
            'BoundariesComments' => 'Comentário/Explicação',
            'Adequacy' => 'Adequação dos limites',
            'EvaluationScore' => 'Adequação',
            'Comments' => 'Comentários/Explicação',
        ],
        'predefined_values' => [
            'Correspondência dos limites demarcados no que diz respeito à situação jurídica',
            'Adequação de limites demarcados',
            'Limites demarcados por elementos naturais (por exemplo, rios)',
            'Limites claramente demarcados, inequívocos e, portanto, facilmente interpretados (por exemplo, sinais, postes, marcadores, cercas, bóias, etc.)',
            'Reconhecimento dos limites pelas autoridades',
            'Reconhecimento dos limitese fronteiras pelas comunidades/utilizadores',
            'Abordagem de colaboração, incluindo agências nacionais e partes interessadas relevantes na demarcação dos limites',
            'Publicação de informações sobre a demarcação dos limites',
            'Demarcação e desenvolvimento dos limites legais coerentes com os estatutos legais e leis internacionais, se necessário',
            'Demarcação utilizando a fonte oficial de dados de referência',
            'Limites registados com coordenadas geográficas (grau, min, seg)',
            'Demarcação de zonas de utilização de AP (zoneamento)',
            'Demarcação de fronteiras, ou parte delas, que são ambulatórias [por exemplo, margens, rios, etc.] e podem precisar de ser revistas',
            'Demarcação por elementos naturais utilizando uma declaração clara (por exemplo, dados de marés ou de inundações fluviais - média de águas baixas, média de águas altas, etc.)'
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
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '0' => 'totalmente inadequado (0-30% das necessidades)',
                '1' => 'Um pouco inadequado (31-60% das necessidades)',
                '2' => 'Adequado (61-90% das necessidades)',
                '3' => 'totalmente adequado (91-100% das necessidades)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'O limite da área protegida está demarcado e é adequado?',
            'A demarcação física de uma área protegida é em geral uma obrigação legal. A demarcação dos limites cumpre os requisitos para assinalar qual é o limite da área protegida estabelecida por legislação específica. A demarcação de áreas protegidas é útil de um ponto de vista jurídico, uma vez que permite definir exactamente onde aplicar um quadro jurídico específico (ou seja, aplicar sanções). Note-se, contudo, que embora útil, a demarcação não é por si só uma medida de protecção suficiente e o conhecimento e aceitação dos limites da área protegida pelas partes interessadas é necessário para a conservação.'
        ],
        'module_info_Rating' => [
            'Avaliar  <ol type="A"><li>O grau em que os limites da área protegida estão demarcado</li><li>A adequação da demarcação doas limites para a gestão da área protegida</li></ol>'
        ]
    ],

    'ManagementPlan' => [
        'title' => 'Plano de gestão',
        'fields' => [
            'PlanExistence' => 'A) Existe um plano de gestão?',
            'PlanUptoDate' => 'O plano de gestão está actualizado?',
            'PlanApproved' => 'O plano de gestão foi aprovado?',
            'PlanImplemented' => 'O plano de gestão está a ser implementado?',
            'VisionAdequacy' => 'B) Adequação da visão, missão e objectivos do plano de gestão às necessidades de conservação',
            'PlanAdequacyScore' => 'C) Adequação relativamente à clareza e aplicabilidade',
            'Comments' => 'Comentários / Explicação',
        ],
        'ratingLegend' => [
            'VisionAdequacy' => [
                '0' => 'A visão, missão e objectivos do plano de maneio são totalmente inadequados',
                '1' => 'A visão, missão e objectivos do plano de maneio são algo inadequados',
                '2' => 'A visão, a missão e os objectivos do plano de maneio são adequados',
                '3' => 'A visão, a missão e os objectivos do plano de maneio são totalmente adequados'
            ],
            'PlanAdequacyScore' => [
                '0' => 'A clareza e aplicabilidade da visão, missão e objectivos são totalmente inadequados (0-30% das necessidades)',
                '1' => 'A clareza e aplicabilidade da visão, missão e objectivos são de certa forma inadequados (31-60% das necessidades)',
                '2' => 'A clareza e aplicabilidade da visão, missão e objectivos são adequados (61-90% das necessidades)',
                '3' => 'A clareza e aplicabilidade da visão, missão e objectivos são totalmente adequados (91-100% das necessidades)'
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Existe um plano de gestão? É adequado e prático de implementar para a área protegida?',
            'O Plano de Gestão é um documento que estabelece a abordagem e os objectivos de gestão, juntamente com um quadro para a tomada de decisões, aplicável a uma área protegida específica durante um determinado período de tempo. É fundamental para o sucesso do plano a mais ampla consulta possível com as partes interessadas e o desenvolvimento de objectivos que possam ser acordados e cumpridos por todos os que têm interesse na utilização e sobrevivência contínua da área em questão (da UICN: Guidelines for Management Planning of Protected Areas, 2008).'
        ],
        'module_info_Rating' => [
            'Evaluate: A) o estado do plano de gestão, B) a adequação da visão, missão e objectivos declarados no plano e C) a adequação do plano de gestão às necessidades de conservação'
        ]
    ],

    'WorkPlan' => [
        'title' => 'Plano de trabalho/acção (terrestre) ou plano de monitoramento (MPA)',
        'fields' => [
            'PlanExistence' => 'A) Existe um plano de trabalho/acção ou plano de monitoramento? Sim/Não',
            'PlanUptoDate' => 'O plano de trabalho/acção ou plano de monitoramento está actualizado (cobrindo o período actual)? Sim/Não',
            'PlanApproved' => 'O plano de trabalho/acção ou plano de monitoramento foi oficialmente aprovado? Sim/Não',
            'PlanImplemented' => 'O plano de trabalho/acção ou plano de monitoramento deve ser implementado? Sim/Não',
            'VisionAdequacy' => 'B) Adequação das actividades e resultados do plano de trabalho/acção ou plano de monitoramento em relação aos objectivos do plano de gestão',
            'PlanAdequacyScore' => 'C) Adequação relativamente à clareza e aplicabilidade das actividades e resultados estabelecidos do plano de trabalho/acção ou plano de monitoramento',
            'Comments' => 'Comentários/Explicação',
        ],
        'ratingLegend' => [
            'VisionAdequacy' => [
                '0' => 'As actividades e resultados do plano de trabalho/acção ou plano de monitoramento são totalmente inadequados em relação aos objectivos do plano de gestão (0-30% das necessidades)',
                '1' => 'As actividades e resultados do plano de trabalho/acção ou plano de monitoramento são inadequados em relação aos objectivos do plano de gestão (31-60% das necessidades)',
                '2' => 'As actividades e resultados do plano de trabalho/acção ou plano de monitoramento são adequados em relação aos objectivos do plano de gestão (61-90% das necessidades)',
                '3' => 'As actividades e resultados do plano de trabalho/acção ou plano de monitoramento são totalmente adequados em relação aos objectivos do plano de gestão (91-100% das necessidades)'
            ],
            'PlanAdequacyScore' => [
                '0' => 'A clareza e aplicabilidade das actividades e resultados esperados são totalmente inadequados',
                '1' => 'A clareza e aplicabilidade das actividades e resultados esperados são algo inadequados ',
                '2' => 'A clareza e aplicabilidade das actividades e os resultados esperados são adequados',
                '3' => 'A clareza e aplicabilidade das actividades e os resultados esperados são totalmente adequados'
            ],
        ],
        'module_info_Rating' => 'Evaluate: A) o estado do plano de trabalho/acção ou plano de monitoramento, B) a adequação das actividades e resultados do plano de trabalho/acção ou plano de monitoramento em relação aos objectivos do plano de gestão e C) a adequação em relação à clareza e aplicabilidade das actividades e resultados estabelecidos do plano de trabalho/acção ou plano de monitoramento',
        'module_info_EvaluationQuestion' => [
            'Existe um plano de trabalho/acção ou plano de monitoramento, é adequado e prático parade implementar napara a área protegida?',
            'Um plano de trabalho/acção ou plano de monitoramento é um plano detalhado que delineia acções ou actividades concretas que precisam de ser realizadas (e por quem, onde e quando) a fim de alcançar produtos resultados e  resultados estabelecidos no plano de gestão da área protegida. Um plano de trabalho/acção ou plano de monitoramento permite monitorizar o progresso na obtenção de realizações e resultados da área protegida. O plano de trabalho/acção ou plano de monitoramento cobre geralmente um período fixo (por exemplo, ano civil) e cria uma ligação dentro da equipa, uma vez que cada membro está consciente do seu papel individual, bem como fornece a informação necessária para assegurar o sucesso da área protegida nos seus esforços de conservação.'
        ]
    ],

    'Objectives' => [
        'title' => 'Objectivos da area protegida',
        'fields' => [
            'Objective' => 'Objectivo',
            'EvaluationScore' => 'Adequação',
            'Comments' => 'Comentários/Explicação',
        ],
        'predefined_values' => [
            'Estado e protecção da biodiversidade como valor global',
            'Espécies de animais- emblemáticas, ameaçadas, endémicas,...',
            'Espécies de Plantas - emblemáticas, ameaçadas, endémicas,...',
            'Mitigação das ameaças directas e indirectas à área protegida',
            'Serviços Ecossistémicos - Provisionamento (alimentos, frutos do mar, material, qualidade da água, etc. utilização sustentável)',
            'Serviços Ecossistémicos - Regulador (proteção contra tempestades e costeiras, erosão hídrica, etc. utilização sustentável)',
            'Serviços Ecossistémicos - Cultural (turismo, pesca tradicional, etc. utilização sustentável)',
            'Serviços Ecossistémicos - Apoio (zonas de desova no mar - habitats de berçário, etc.)',
            'Adaptação as alteraçoes climáticas',
            'Governanção',
            'Apoio à economia local',
            'Apoiar aspectos sociais',
            'Turismo e uso humano',
            'Sistemas de Gestão - pessoal, finanças, aquisiçoes',
            'Infra-estruturas e equipamento',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '0' => 'Totalmente inadequado (0-30% das necessidades)',
                '1' => 'Um pouco inadequado (31-60% das necessidades)',
                '2' => 'Adequado (61-90% das necessidades)',
                '3' => 'Totalmente adequado (91-100% das necessidades)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Os objectivos estabelecidos para a área protegida são adequados?',
            'A gestão de áreas protegidas é cada vez mais efectuada seguindo a abordagem de "gestão por objectivos". É considerada proactiva, ou seja, concebida para alcançar um conjunto específico de resultados, em vez de reactiva, ou seja, apenas respondendo a questões que surgem. As metas e objectivos da área protegida têm de ser claramente compreendidos. Devem ser bem definidos e redigidos para facilitar a monitorização, mas também devem estar relacionados com os valores-chave da área protegida (ou seja, espécies ou ecossistemas importantes) ou com as principais áreas de actividade de gestão (por exemplo, turismo, educação). Nesta ferramenta, fazemos uma distinção importante entre resultados e produtos.<ul><li>Os RESULTADOS referem-se as mudanças relacionadas com os OBJECTIVOS GERAIS, ou seja, objectivos gerais de longo prazo/objectivos ou visões expressas no plano de maneio. Estes objectivos gerais são geralmente declarações específicas relacionadas com os valores-chave da área protegida (ou seja, espécies importantes ou serviços ecossistémicos) ou com as principais áreas de actividades de gestão (por exemplo, turismo, educação).</li><li>Os PRODUTOS referem-se aos alcances das actividades de curto prazo, são geralmente medidos de maneira quantitativa considerando que contribuem com outros alcances para chegar aos objectivos gerais de longo prazo ou aos objectivos específicos.</li></ul>'
        ],
        'module_info_Rating' => [
            'Avaliar a adequação dos objectivos do plano de gestão aos elementos-chave da área protegida, com base na análise do contexto de intervenção, pontos: CTX1.5, CTX 4, 5, 6, 7 e contexto de gestão, pontos de C 1.1 a C 1.5)'
        ]
    ],

    'ObjectivesPlanification' => [
        'module_info' => 'Estabelecer e descrever objectivos de conservação para  <b>o planeamento</b> da área protegida<br /> Os objectivos inseridos abaixo serão utilizados para melhorar a gestão, e mais especificamente para o planeamento, mobilização de recursos, fases do processo, e para o controlo das actividades de gestão da área protegida.'
    ],

    'InformationAvailability' => [
        'title' => 'Informação Básica',
        'fields' => [
            'Element' => 'Classificação – Conceito medido – Variável',
            'EvaluationScore' => 'Disponibilidade',
            'Comments' => 'Comentários/Explicação',
        ],
        'groups' => [
            'group0' => 'Espécies Animais (emblemáticas, em perigo, endémicas, …)',
            'group1' => 'Espécies de Plantas (emblemáticas, ameaçadas, endémicas…)',
            'group2' => 'Habitats e as dimensões relacionadas da cobertura do solo utilização dentro e fora da área protegida',
            'group3' => 'Ameaças à área protegida',
            'group4' => 'Efeitos das alterações climáticas sobre os elementos chave da área protegida',
            'group5' => 'Serviços Ecossistémicos providenciados pela área protegida'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'nenhuma ou pouca informação disponível para ajudar na gestão (0-30% das necessidades)',
                '1' => 'pouca informação disponível e insuficiente para ajudar na gestão (31-60% das necessidades)',
                '2' => 'informação disponível mas moderadamente suficiente para ajudar na gestão (61-90% das necessidades)',
                '3' => 'informação disponível e largamente suficiente para ajudar na gestão (91-100% das necessidades)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Tem informação suficiente e direccionada para apoiar a sua tomada de decisões na gestão da área protegida?',
            'A gestão eficaz de áreas protegidas requer conhecimentos e informações suficientes para informar a tomada de decisões. A gestão de uma área protegida necessita de uma análise sólida para resumir e estruturar informação relevante com vista a encontrar soluções para desafios concretos de gestão. Bons dados e informações são um pré-requisito para uma análise sólida, e sem essas informações não pode haver uma boa gestão.'
        ],
        'module_info_Rating' => [
            'Analisar a disponibilidade de informação para apoiar a gestão da área protegida nas seguintes dimensões do Contexto de intervenção, pontos 4; 5; 6; 7.'
        ]
    ],

    'Staff' => [
        'title' => 'Pessoal actual',
        'fields' => [
            'Theme' => 'Critério – Conceito medido – Variável',
            'StaffNumberAdequacy' => 'Adequação do número de pessoal',
            'StaffCapacityAdequacy' => 'Adequação das capacidades do pessoal',
            'Comments' => 'Comentários/Explicação',
        ],
        'StaffNumberAdequacy' => 'Adequação do número de pessoal',
        'ratingLegend' => [
            'StaffNumberAdequacy' => [
                '0' => 'Quase nenhum pessoal (entre 0 e 20% do número necessário)',
                '1' => 'Pessoal insuficiente para as actividades essenciais de gestão (entre 21 e 40% do número necessário)',
                '2' => 'Não há pessoal suficiente para realizar muitas actividades de gestão (entre 41 e 60% do número necessário)',
                '3' => 'Pessoal suficiente para realizar muitas mas não todas as actividades (entre 61 e 80% do número necessário)',
                '4' => 'Número de pessoal adequado para realizar todas as actividades (entre 81 e 100% do número necessário)'
            ],
            'StaffCapacityAdequacy' => [
                '0' => 'Sem capacidades de pessoal (0-30% das necessidades)',
                '1' => 'Capacidades insuficientes do pessoal (31-60% das necessidades)',
                '2' => 'Capacidades de pessoal adequadas em princípio, mas são necessárias mais melhorias (61-90% das necessidades)',
                '3' => 'Capacidades suficientes de pessoal (91-100% das necessidades)'

            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Existe pessoal suficiente para cumprir os requisitos de gestão da área protegida?',
            'Pessoal qualificado, competente, empenhado e adequado (em número) é fundamental para o sucesso das áreas protegidas. As necessidades de pessoal estão definitivamente correlacionadas com o tamanho, tipo, densidade da vegetação e as pressões e ameaças (ou seja, densidade humana) de uma área protegida. Por exemplo, para a sua protecção, áreas florestais mais pequenas e mais protegidas tendem a exigir relativamente mais pessoal em comparação com áreas protegidas de savana maiores e mais abertas, o que implica custos de pessoal mais elevados. A avaliação baseia-se em informações constantes do plano de gestão ou do organigrama oficial do pessoal'
        ],
        'module_info_Rating' => [
            'Avaliar: A) a adequação do número de empregados (note que os resultados são automaticamente calculados na avaliação feita no CTX 3.1.1), B) a adequação da capacidade do pessoal'
        ]
    ],

    'BudgetAdequacy' => [
        'title' => 'Orçamento actual',
        'fields' => [
            'EvaluationScore' => 'Adequação do orçamento actual',
            'Percentage' => 'Percentagem que indica até que ponto o orçamento é adequado em relação às necessidades',
            'Comments' => 'Comentários/Explicação',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Sem orçamento (0% das necessidades)',
                '1' => 'Inadequado mesmo para actividades de gestão essenciais (entre 1 e 25% dos requisitos)',
                '2' => 'Inadequado para muitas actividades de gestão (26-50% dos requisitos)',
                '3' => 'Adequado para actividades essenciais de gestão (entre 51 e 70% dos requisitos)',
                '4' => 'Adequado para muitas mas não todas as actividades (entre 71% e 90% dos requisitos)',
                '5' => 'Adequado para todas as actividades (91% ou mais dos requisitos)'

            ]
        ],
        'module_info_EvaluationQuestion' => [
            'O orçamento actual é adequado para uma gestão adequada da área protegida?',
            'As áreas protegidas preparam os seus orçamentos anuais de funcionamento todos os anos ou durante vários anos. Os principais documentos de planeamento financeiro e orçamento são necessários para melhorar a eficiência e eficácia operacional. A melhoria é conseguida através da utilização de medidas de desempenho e análise de processos'
        ],
        'module_info_Rating' => [
            'Avaliar a adequação do financiamento anual actual da área protegida em relação aos requisitos de conservação (com base na análise do contexto de intervenção, ponto CTX 3.2)'
        ]
    ],

    'BudgetSecurization' => [
        'title' => 'Assegurar o orçamento',
        'fields' => [
            'Percentage' => 'A) Avaliar em percentagem a "Segurança do financiamento futuro"',
            'EvaluationScore' => 'B) Avaliar em anos o "Período de segurança do financiamento futuro"',
            'Comments' => 'Comentários/Explicação',
        ],
        'ratingLegend' => [
            'Percentage' => [
                '0' => 'As necessidades financeiras básicas da gestão da área protegida não estão asseguradas (0-20% das necessidades asseguradas)',
                '1' => 'As necessidades financeiras básicas da gestão da área protegida estão muito pouco asseguradas (21-40% das necessidades asseguradas)',
                '2' => 'As necessidades financeiras básicas da gestão da área protegida estão fracamente asseguradas (41-60% das necessidades asseguradas)',
                '3' => 'As necessidades financeiras básicas da gestão da área protegida são parcialmente asseguradas (61-75% das necessidades asseguradas)',
                '4' => 'As necessidades financeiras básicas da gestão da área protegida são relativamente bem asseguradas (76-90% das necessidades asseguradas)',
                '5' => 'As necessidades financeiras básicas da gestão da área protegida estão asseguradas (> 90% das necessidades asseguradas)',
            ],
            'EvaluationScore' => [
                '0' => 'As necessidades financeiras básicas da gestão da área protegida são asseguradas apenas por 1 ano (ano corrente)',
                '1' => 'As necessidades financeiras básicas da gestão da área protegida são asseguradas durante 2 anos (ano corrente +1 ano)',
                '2' => 'As necessidades financeiras básicas da gestão da área protegida estão garantidas por 3 anos (ano corrente +2 anos)',
                '3' => 'As necessidades financeiras básicas da gestão da área protegida estão asseguradas para 4 - and mais anos. (ano corrente +3 anos e mais)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Quanto do orçamento necessário está assegurado, e por quanto tempo, para cobrir as necessidades básicas de gestão de áreas protegidas?',
            'Um orçamento seguro e fiável é fundamental para o planeamento e gestão de áreas protegidas, em particular para actividades de grande escala e a longo prazo. Deve ser feita uma avaliação realista das necessidades para assegurar que todos os custos associados ao trabalho ou plano de gestão possam ser plenamente cumpridos, tendo em conta que alguns objectivos exigirão vários anos para serem alcançados. Quando os recursos não estão disponíveis, o gestor deve decidir como dar prioridade às actividades em termos de calendário e investimento'
        ],
        'module_info_Rating' => [
            'Avaliar: A) a segurança do financiamento e B) o período de segurança do financiamento para os próximos anos em relação aos requisitos de conservação na área protegida'
        ]
    ],

    'ManagementEquipmentAdequacy' => [
        'title' => 'Infra-estruturas, equipamento e instalações',
        'fields' => [
            'Equipment' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'A) a adequação das infra-estruturas, equipamentos e instalações (resultados calculados automaticamente com base na análise do contexto de intervenção, ponto CTX 3.3),',
            'Importance' => 'B) a actual necessidade de disponibilidade de infra-estruturas, equipamentos e instalações específicos para a área protegida',
            'Comments' => 'Comentários/Explicação',
        ],
        'adequacy' => 'Adequação de infra-estruturas, equipamento e instalações',
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Totalmente inadequado (0-30% das necessidades)',
                '1' => 'Um pouco inadequado (31-60% das necessidades)',
                '2' => 'Adequado (61-90% das necessidades)',
                '3' => 'Totalmente adequado (91-100% das necessidades)',
            ],
            'Importance' => [
                '0' => 'Normal',
                '1' => 'Alto',
                '2' => 'Muito alto',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'As infra-estruturas, equipamentos e instalações da área protegida são adequados para os requisitos de gestão?',
            'As infra-estruturas, equipamento e instalações são importantes para assegurar e melhorar a eficiência e eficácia operacional da área protegida. A análise das infra-estruturas, equipamento e instalações de uma área protegida pode fornecer uma base para a procura de financiamento adicional. Os doadores devem ser encorajados a contribuir para alcançar e manter níveis adequados de infra-estruturas, equipamento e instalações para a gestão de áreas protegidas.'
        ],
        'module_info_Rating' => [
            'Avaliar: A) a adequação das infra-estruturas, equipamentos e instalações (resultados calculados automaticamente com base na análise do contexto de intervenção, ponto CTX 3.3), B) a actual necessidade de disponibilidade de infra-estruturas, equipamentos e instalações específicos para a área protegida',
        ]
    ],

    'ObjectivesIntrants' => [
        'module_info' => 'Estabelecer e descrever objectivos de conservação para <b>recursos</b> da área protegida<br /> Os objectivos inseridos abaixo serão utilizados para melhorar a gestão, e mais especificamente para o planeamento, mobilização de recursos(insumos), fases do processo, e para a monitorização das actividades de gestão da área protegida.'
    ],

    'StaffCompetence' => [
        'title' => 'Programa de formação e desenvolvimento de capacidades do pessoal',
        'fields' => [
            'Theme' => 'Criterio – Conceito medido – Variável',
            'EvaluationScore' => 'A) Adequação da análise das capacidades/necessidades de pessoal e concepção de programas de formação',
            'PercentageLevel' => 'B) Adequação das actividades de reforço da capacidade do pessoal',
            'Comments' => 'Comentários/Explicação',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Totalmente inadequado',
                '1' => 'Um pouco inadequado',
                '2' => 'Adequado',
                '3' => 'Totalmente adequado'
            ],
            'PercentageLevel' => [
                '0' => 'Actividades de capacitação de pessoal totalmente inadequadas',
                '1' => 'Actividades de capacitação de pessoal um pouco adequadas',
                '2' => 'Actividades de capacitação de pessoal adequadas, mas são necessárias melhorias',
                '3' => 'Actividades de capacitação de pessoal totalmente adequadas (suficientes e actualizadas)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'A área protegida está a implementar um programa de formação e capacitação adequado que responde às necessidades de pessoal para alcançar os objectivos de gestão?',
            'Pessoal qualificado, competente e empenhado é fundamental para o sucesso das áreas protegidas. A formação do pessoal é cada vez mais reconhecida como uma componente vital para uma gestão eficiente das áreas protegidas. O principal objectivo da formação do pessoal é aumentar a capacidade do pessoal das áreas protegidas para se adaptar aos novos desafios, utilizando abordagens inovadoras, se necessário. A análise deste ponto tem em conta a adequação de (A) a concepção do programa de formação (incluindo análise, recursos, concepção), e (B) as actividades de capacitação (incluindo desenvolvimento e prestação de formação) em relação à capacidade e necessidades do pessoal para as necessidades de gestão da área protegida.'
        ],
        'module_info_Rating' => [
            'Para diferentes categorias/funções de pessoal (por exemplo, gestores, fiscais, etc.) avaliar a adequação das mesmas: (A) concepção de programas de formação e (B) actividades de reforço da capacidade do pessoal'
        ]
    ],

    'HRmanagementPolitics' => [
        'title' => 'Políticas e procedimentos de gestão de recursos humanos',
        'fields' => [
            'Conditions' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Adequação das politicas e procedimentos de gestão dos recursos humanos',
            'Comments' => 'Comentários/Explicação',
        ],
        'predefined_values' => [
            'Compensação e benefícios',
            'Procedimentos de recrutamento baseados no mérito',
            'Atribuição de trabalho',
            'Atribuição de postos de trabalho',
            'Saúde, segurança e protecção',
            'Carreira e possibilidades de promoção',
            'Género e equidade étnica',
            'Regras que reduzem o favoritismo e a discriminação',
            'Formação e desenvolvimento',
            'Gestão das relações com os empregados',
            'Sistemas de informação de recursos humanos'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'Este elemento não está relacionado com a gestão da área protegida',
                '0' => 'Totalmente inadequado (0-30% das necessidades)',
                '1' => 'Um pouco inadequado (31-60% das necessidades)',
                '2' => 'Adequado (61-90% das necessidades)',
                '3' => 'Totalmente adequado (91-100% das necessidades)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'A área protegida adoptou políticas, procedimentos e directrizes adequadas de gestão de recursos humanos para o recrutamento, promoção, compensação, desempenho, avaliação e formação do pessoal, as suas funções e o seu código de conduta?',
            'As políticas de recursos humanos descrevem a abordagem e as medidas a adoptar na gestão do pessoal. Estas políticas também fornecem orientações para a gestão de recursos humanos sobre vários assuntos relativos a diferentes aspectos, tais como recrutamento, promoção, compensação, desempenho, avaliação e formação, mas também deveres do pessoal, e o seu código de conduta, procedimentos disciplinares, etc. O estabelecimento de políticas, procedimentos e directrizes claros pode ajudar a demonstrar, tanto interna como externamente, que a área protegida cumpre os requisitos de equidade, diversidade, ética e formação, bem como os seus compromissos de cumprir os requisitos regulamentares e de boa governação dos recursos humanos dos funcionários da área protegida.'
        ],
        'module_info_Rating' => [
            'Avaliar a adequação das disposições das políticas, procedimentos e directrizes de gestão de recursos humanos para a área protegida'
        ]
    ],

    'HRmanagementSystems' => [
        'title' => 'Condições de trabalho e motivação do pessoal',
        'fields' => [
            'Conditions' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Adequação da motivação do pessoal ',
            'Comments' => 'Comentários/Explicação',
        ],
        'predefined_values' => [
            'Objectivos claros e específicos para as tarefas',
            'Lealdade e integridade dos gestores e líderes',
            'Retroalimentação e acompanhamento por gestores e líderes',
            'Estimulação e motivação para a realização de actividades',
            'Retroalimentação sobre as actividades realizadas',
            'Autonomia para executar tarefas adequadamente',
            'Envolvimento do pessoal nas decisões sobre o seu trabalho e emprego',
            'Remuneração adequada (salários, bónus e segurança social)',
            'Condições de trabalho adequadas (equipamento de trabalho, vestuário de trabalho, etc.)',
            'Motivação das autoridades políticas, administrativas e militares',
            'Motivação das autoridades legais',
            'Motivação das comunidades locais'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '0' => 'Totalmente inadequado (0-30% das necessidades)',
                '1' => 'Um pouco inadequado (31-60% das necessidades)',
                '2' => 'Adequado (61-90% das necessidades)',
                '3' => 'Totalmente adequado (91-100% das necessidades)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'A gestão da área protegida utiliza medidas/abordagens/ferramentas adequadas para assegurar a motivação do pessoal?',
            'Para uma área protegida, o pessoal motivado é essencial para alcançar o sucesso na conservação. As condições de trabalho e a motivação do pessoal influenciam fortemente a capacidade do pessoal para realizar o seu trabalho. Os gestores e líderes devem compreender que precisam de proporcionar um ambiente de trabalho que crie e mantenha a motivação do pessoal para alcançar resultados na conservação.',
        ],
        'module_info_Rating' => [
            '•	Avaliar a adequação das medidas/abordagens/ferramentas de motivação do pessoal na área protegida',
        ]
    ],

    'GovernanceLeadership' => [
        'title' => 'Orientação da gestão da área protegida',
        'fields' => [
            'EvaluationScoreGovernace' => 'A) Adequação da comunicação da direcção sobre a missão e os valores da área protegida',
            'EvaluationScoreLeadership' => 'B) Adequação de uma abordagem orientada para os resultados da gestão',
            'Comments' => 'Comentários/Explicação',
        ],
        'ratingLegend' => [
            'EvaluationScoreGovernace' => [
                '0' => 'Não existe comunicação ou existe uma comunicação extremamente limitada sobre a visão, missão e valores da área protegida para influenciar o desempenho, apoio e feedback do pessoal (entre 0 e 25% dos requisitos)',
                '1' => 'Não existe uma comunicação suficientemente clara sobre a visão da missão da área protegida, e valores para influenciar o desempenho, apoio e retroalimentacao do pessoal (entre 26 e 50% dos requisitos)',
                '2' => 'Existe uma comunicação clara mas não completa sobre a visão, missão e valores da área protegida para influenciar o desempenho, apoio e Retroalimentação do pessoal (entre 51 e 75% dos requisitos)',
                '3' => 'Existe uma comunicação completa sobre a visão, missão e valores da área protegida para influenciar o desempenho, apoio e Retroalimentação do pessoal (entre 76 e 100% dos requisitos)'
            ],
            'EvaluationScoreLeadership' => [
                '0' => 'A gestão não está orientada para resultados na realização da visão, missão e conservação dos valores da área protegida',
                '1' => 'A gestão está pouco orientada para resultados na consecução da visão, missão e conservação dos valores da área protegida',
                '2' => 'A gestão é normalmente orientada para resultados na realização da visão, missão e conservação dos valores da área protegida',
                '3' => 'A gestão é fortemente orientada para a obtenção da visão, missão e conservação dos valores da área protegida'
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'A gestão da área protegida dá a direcção e orientação adequadas para a realização de tarefas e execução das mesmas?',
            'A gestão da área protegida deve dar orientação e orientação adequadas para quaisquer actividades relacionadas com operações de escritório e de campo, utilização de recursos, gestão, aplicação da lei, monitorização, etc. A avaliação das orientações de gestão deve determinar se ainda é relevante, eficaz e actual, ou se são necessárias alterações. Por vezes poderão ser necessários ajustamentos para assegurar que a gestão forneça uma direcção adequada para a implementação dos produtos e resultados esperados'
        ],
        'module_info_Rating' => 'Avaliar a adequação de: (A) comunicação da missão e dos valores da área protegida por parte da direcção e (B) abordagem orientada para os resultados por parte da direcção'
    ],

    'AdministrativeManagement' => [
        'title' => 'Orçamento e gestão financeira',
        'fields' => [
            'Aspect' => 'Critério - Conceito Medido – Variável',
            'EvaluationScore' => 'Classificação: Estabelecimento dos elementos básicos da gestão orçamental e financeira',
            'Comments' => 'Comentários/Explicação',
        ],
        'predefined_values' => [
            'Consistência: as suas políticas e sistemas financeiros continuam a ser consistentes',
            'Responsabilização: é capaz de explicar e demonstrar a todos os funcionários/intervenientes como utilizou os seus recursos e o que alcançou.',
            'Transparência: a sua organização é transparente relativamente ao seu trabalho e às suas finanças, disponibilizando informação a todos os funcionários/intervenientes.',
            'Integridade: os indivíduos da sua organização estão a operar com honestidade e propriedade.',
            'Gestão financeira: a sua organização cuida bem dos recursos financeiros que lhe foram atribuídos e assegura que são utilizados para o fim a que se destinam.',
            'Normas contabilísticas: o sistema da sua organização para manter registos e documentação financeira segue as normas contabilísticas externas aceites.\''
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '0' => 'Nunca',
                '1' => 'Raramente',
                '2' => 'Por vezes',
                '3' => 'Muitas vezes',
                '4' => 'Sempre'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'O orçamento e os recursos financeiros são bem geridos de modo a satisfazer os requisitos essenciais e prioritários de gestão da área protegida?',
            'O orçamento e a gestão financeira da área protegida devem ser robustos  para permitir uma adequada alocação de recursos, uma previsã dinâmica e detalhada dos custos dos programas e planificação estratégica. A gestão orçamental e financeira é mais do que a manutenção de registos contabilísticos. É uma parte essencial do planeamento, organização, controlo e monitorização dos recursos financeiros, a fim de alcançar os objectivos de conservação da área protegida. Só é possível alcançar uma gestão orçamental e financeira eficaz se se tiver uma boa gestão e um plano de trabalho com claras  politicas, estrat;égias e um conjunto de objectivos acordados.'
        ],
        'module_info_Rating' => [
            'Avaliar o estabelecimento dos elementos básicos que devem estar em vigor para alcançar as boas práticas de gestão orçamental e financeira. (Não existe um modelo único de sistema de gestão orçamental e financeira que se adapte a todas as organizações, mas existem alguns elementos básicos que devem estar em vigor para se alcançarem boas práticas na gestão orçamental e financeira)'
        ]
    ],

    'EquipmentMaintenance' => [
        'title' => 'Manutenção de infra-estruturas, equipamentos e instalações',
        'fields' => [
            'Equipment' => 'Critério - conceito medido – Variável',
            'EvaluationScore' => 'Classificação: Adequação de manutenção',
            'AdequacyLevel' => 'Valor de CTX 3.3',
            'Comments' => 'Comentários/Explicação',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '0' => 'Totalmente inadequado (0-30% das necessidades)',
                '1' => 'Algo inadequado (31-60% das necessidades)',
                '2' => 'Adequado (61-90% das necessidades)',
                '3' => 'Totalmente adequado (91-100% das necessidades)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'As infra-estruturas, equipamentos e instalações da área protegida são adequadamente mantidos?',
            'Manutenção preventiva é o termo utilizado para as manutenções de rotina recorrentes realizadas em infra-estruturas, equipamentos e instalações para os manter a funcionar sem problemas e com eficiência e para ajudar a prolongar a sua vida útil. As infra-estruturas, equipamentos e instalações mal conservadas não só se desgastam mais rapidamente, como também desperdiçam recursos e degradam fundamentalmente a capacidade da área protegida para alcançar os objectivos de conservação. A área protegida deve trabalhar para evitar ambas estas condições através de um programa de manutenção adequado'
        ],
        'module_info_Rating' => [
            'Avaliar o nível de manutenção das infra-estruturas, equipamentos e instalações em relação aos requisitos de gestão da área protegida (com base na análise do contexto de intervenção, ponto CTX 3.3).'
        ]
    ],

    'ManagementActivities' => [
        'title' => 'Gestão dos principais valores e ameaças da área protegida com acções específicas',
        'fields' => [
            'Activity' => 'Critério - Conceito Medido – Variável',
            'EvaluationScore' => 'Adequação das acções de gestão',
            'InManagementPlan' => 'Acção incluída no plano de gestão',
            'Comments' => 'Comentários/Explicação',
        ],
        'groups' => [
            'group0' => 'Espécies animais (emblemáticas, ameaçadas, endémicas, etc.)',
            'group1' => 'Espécies de plantas (emblemáticas, ameaçadas, endémicas, etc.)',
            'group2' => 'Habitats o mais importante e as dimensões relacionadas da área protegida',
            'group3' => 'Gestão para mitigar as ameaças à área protegida',
            'group4' => 'Serviços de ecossistema',
            'group5' => 'Outros',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '0' => 'Totalmente inadequado (0-30% das necessidades)',
                '1' => 'Um pouco inadequado (31-60% das necessidades)',
                '2' => 'Adequado (61-90% das necessidades)',
                '3' => 'Totalmente adequado (91-100% das necessidades)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Existem acções de gestão específicas para os principais valores e ameaças à área protegida?',
            'O principal objectivo de gestão das áreas protegidas é a conservação/restauro dos valores naturais e culturais associados. Para preservar esses valores e minimizar as ameaças mais significativas os gestores devem utilizar os conselhos e orientações de gestão disponíveis, identificar e implementar as medidas necessárias utilizando as melhores práticas em benefício dos valores-chave e minimizando as ameaças mais significativas. As acções podem incluir a conservação/restauro de espécies animais e de plantas, os habitats e gestão de várias ameaças (nota: para as acções de adaptação às alterações climáticas e gestão dos serviços ecossistémicos ver PR 17 e PR 18). Exemplos de acções: gestão de animais ou plantas, gestão do ambiente físico, gestão de incêndios, trabalho de revegetação, controlo de espécies invasoras, gestão de recursos culturais, minimização de ameaças, etc.'
        ],
        'module_info_Rating' => [
            'Enumerar três ou mais valores chave, ameaças e outros elementos chave e avaliar a adequação das acções de gestão relacionadas (com base na análise do contexto dos pontos de intervenção CTX 4 e 5)'
        ]
    ],
    'LawEnforcementImplementation' => [
        'title' => 'Gestão das Patrulhas dos Fiscais(aplicação da lei)',
        'fields' => [
            'Element' => 'Critério – Conceito medido – Variável',
            'Adequacy' => 'Adequação da gestão das patrulhas dos fiscais',
            'Comments' => 'Comentários/Explicação',
        ],
        'groups' => [
            'group0' => 'Gestão de patrulhas de Ranger',
            'group1' => 'Gestão de patrulhas de guarda-marinha',
        ],
        'predefined_values' => [
            'group0' => [
                'Gestão estratégica proactiva',
                'Vigilância colaborativa (protecção conseguida através de uma combinação de aplicação e colaboração com as comunidades)',
                'Procedimentos operacionais padrão (POPs)',
                'Procedimentos operacionais de emergência',
                'Procedimentos de intervenção rápida',
                'Não colaborativo (tecnologia: dados digitais, monitoramento aéreo, etc Vs mau desempenho, rangers fiscais qualificados)',
                'Tácticas adaptáveis e diversas (por exemplo, tipos de patrulha complementares, tais como pontos de observação, patrulhas assistidas por veículos, emboscadas, etc.)',
                'Estratégias de aplicação que combinem tecnologia com patrulhas marítimas (por exemplo, monitorização por satélite e patrulhas de veículos/barcos assistidos)',
                'Processo eficiente de tomada de decisão para procedimentos operacionais padrão e de emergência',
                'Gestão de unidades de elite (fiscais/guardas de maior desempenho)',
                'Salas de controlo de operações',
                'Postos avançados/pickets - dentro do parque',
                'Postos avançados/pickets - fora do parque',
                'Patrulhas de vários dias',
                'Utilização de informações SMART-RBM para realizar relatórios e informacoes breves sobre o patrulhamento'
            ],
            'group1' => [
                'Não colaborativo (tecnologia: dados digitais, monitorização aérea, etc.). Tecnologia Vs, mau desempenho, rangers qualificados)',
                'Utilização de sensores electrónicos visuais e básicos para patrulhas marítimas (radar, óptico/infravermelho)',
                'Protecção conseguida através de uma combinação de aplicação e colaboração com as comunidades',
                'Utilização de vigilância colaborativa (cobertura em tempo real e de grandes áreas, baixos investimentos versus intervalos de tempo e costas recorrentes, regulamentos e incentivos, transceptores desactivados)',
                'Utilização de não-colaborativo (tecnologia: radar, óptico/infravermelho, monitorização de rádio vs. mau desempenho tecnológico, pessoal qualificado)',
                'Integração entre sistemas de vigilância colaborativa e não colaborativa na área protegida',
                'Patrulhas de aplicação da lei realizadas durante a noite e outras horas aleatórias',
                'Participação regular em formação especializada (Organização Marítima Internacional -IMO- formação básica, leitura e utilização de cartas náuticas, busca e salvamento, curso básico de manutenção de motores fora de borda, etc.)',
                'Actualização contínua e distribuição de uma simples folha de factos delineando o zoneamento, regulamentos, restrições e multas ou sanções',
            ]
        ],
        'ratingLegend' => [
            'Adequacy' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '0' => 'Totalmente inadequado (0-30%)',
                '1' => 'Um pouco inadequado (31-60%)',
                '2' => 'Adequado (61-90%)',
                '3' => 'Totalmente adequado (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Até que ponto é adequada a gestão e implementação da aplicação da lei através de patrulhas da área protegida orientadas para assegurar a protecção da biodiversidade a longo prazo?',
            'A gestão de patrulhas é uma actividade essencial para fazer cumprir as regras legais existentes que devem assegurar a protecção a longo prazo da biodiversidade e de outros valores da área protegida. Uma gestão eficaz da área protegida exige a aplicação da lei a todos os níveis: patrulhas dos fiscais, inteligência e sistemas de justiça criminal eficazes. Este passo na análise diz respeito ao processo de gestão das patrulhas dos fiscais',
            '(Nota: Está disponivel um modulo especifico do IMET, para uma analise mais profunda da aplicacao da Lei)',
        ],
        'module_info_Rating' => [
            'Avaliar a adequação dos elementos da gestão das patrulhas das áreas protegidas orientadas para assegurar a protecção a longo prazo da biodiversidade e de outros valores',
        ]
    ],

    'IntelligenceImplementation' => [
        'title' => 'Inteligência, investigações, desenvolvimento de casos e acções judiciais (aplicação da lei)',
        'fields' => [
            'Element' => 'Critério – Conceito Medido – Variável',
            'Adequacy' => 'Adequação da gestão de: A) inteligência e investigações; B) tratamento de provas, desenvolvimento de casos e acções judiciais de desenvolvimento de casos',
            'Comments' => 'Comentários/Explicação',
        ],
        'groups' => [
            'group0' => 'A) Inteligência e gestão da investigação - Terrestre',
            'group0b' => 'A) Inteligência e gestão da investigação - Marítima e costeira',
            'group1' => 'B) Tratamento de provas, desenvolvimento de casos e acção judicial - Terrestre',
            'group1b' => 'B) Tratamento de provas, desenvolvimento de casos e acção judicial - Marítima e costeira',
        ],
        'predefined_values' => [
            'group0' => [
                'Unidades de inteligência e investigação que orientam e apoiam as acções de patrulhamento dos fiscais',
                'Organização do sistema de informadores',
                'Apoio informático para a inteligência',
                'Sistema de organização e análise de dados de inteligência',
                'Colaboração inter-agências (por exemplo, procuradores dentro do serviço de vida selvagem ou unidade especializada na repressão de crimes contra a vida selvagem)',
                'Colaboração inter-agências com ONG (por exemplo, EAGLE Network, África Central/Oeste)'
            ],
            'group0b' => [
                'Unidades de inteligência e investigação que orientam e apoiam as operações de patrulha marítima',
                'Detecção e punição das actividades ilegais (como a pesca e a colheita)',
                'Conhecimento dos requisitos legais de embarque',
                'Protocolos de embarque: inspecções, documentos necessários, o que verificar e procurar, documentação da inspecção',
                'Interrogar e confrontar tripulações suspeitas sobre actividades ilegais',
                'Relatório de embarque padronizado utilizado de forma consistente e correcta',
                'Nível de segurança pessoal durante o embarque',
                'Utilização de um modelo de avaliação de risco (GAR -GREEN-AMBER-RED or ou equivalente/outro)',
                'Utilização de base de dados para registo e acompanhamento de informações sobre violações',
                'Colaboração com ONG especializadas em leis marinhas, aplicação, etc. (por exemplo, Environmental Law Institute (ELI) Ocean Program)'
            ],
            'group1' => [
                'Gestão da cena do crime',
                'Recolha e gestão de provas',
                'Prisão ou preparação do relatório do caso',
                'Acusação de suspeitos',
                'Controlo de casos e delinquentes',
                'Acórdãos obtidos em tribunal'
            ],
            'group1b' => [
                'Workshops de formação para juízes, advogados e advogados sobre normas e regulamentos marinhos e relacionados com a pesca',
                'Capacidade de apreender e deter navios após transgressã',
                'Capacidade de restringir a navegação dentro das fronteiras da MPA através da emissão de autorizações',
                'Apreensão de artes de pesca',
                'Capacidade de impor a suspensão temporária das autorizações para navios, tripulantes ou armadores',
                'Capacidade de revogação de licenças de exploração de navios, armadores, agentes, pessoal marítimo, ou pescadores',
            ],
        ],
        'ratingLegend' => [
            'Adequacy' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '0' => 'Totalmente inadequado (0-30%)',
                '1' => 'Um pouco inadequado (31-60%)',
                '2' => 'Adequado (61-90%)',
                '3' => 'Totalmente adequado (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Quão adequada é a gestão das informações/investigações/desenvolvimento de casos/acções legais orientadas para assegurar a protecção da biodiversidade a longo prazo?',
            'A inteligência e a gestão da investigação, bem como o desenvolvimento de casos e acções legais, são actividades essenciais para fazer cumprir as regras legais existentes que devem assegurar a protecção a longo prazo da biodiversidade e outros valores na área protegida. Uma gestão eficaz da área protegida exige a aplicação da lei a todos os níveis: patrulhas de fiscais, inteligência e sistemas de justiça penal eficazes. Esta etapa da análise está orientada para a avaliação de: (A) a gestão das informações e investigações e (B) o tratamento das provas, o desenvolvimento de casos e a instauração de acções judiciais'
        ],
        'module_info_Rating' => [
            'Avaliar a adequação da gestão de inteligência/investigações/desenvolvimento de casos/acções legais orientadas para assegurar a protecção a longo prazo da biodiversidade e de outros valores.'
        ]
    ],

    'StakeholderCooperation' => [
        'title' => 'Cooperacao com as partes interessadas',
        'fields' => [
            'Element' => 'Criterio – Conceito medido – Variável',
            'Cooperation' => 'Grau de cooperação',
            'MPInvolvement' => 'P',
            'MPIImplementation' => 'PM',
            'BAInvolvement' => 'B/A',
            'EEInvolvement' => 'IEC',
            'Comments' => 'Comentários/Explicação',
        ],
        'groups' => [
            'group0' => 'Comunidade Local',
            'group1' => 'Governo',
            'group2' => 'Cientistas, Pesquisadores, Doadores e ONGs',
            'group3' => 'Operadoes Economicos',
            'group4' => 'Outros'
        ],
        'predefined_values' => [
            'group0' => [
                'Autoridades tradicionais',
                'Populações indigenas',
                'Comunidades que vivem perto do parque ou no parque',
                'Titulares de direitos',
                'Proprietários de terras',
                'Utilizadores locais de recursos naturais',
                'Utilizadores locais de produtos florestais não madeireiros (NTFP)',
                'Grupos subrepresentados ou desfavorecidos',
                'População que não esteja em zona tampão'
            ],
            'group1' => [
                'Governo Central',
                'Governo Local',
                'Conselho territorial/departamental e municipal',
                'Autoridade da área protegida',
                'Serviços locais terrestres',
                'Representatives of local populations (parliamentary representatives, etc.)',
                'Forças armadas (força policial paramilitar e marinha)'
            ],
            'group2' => [
                'ONG de direitos sociais',
                'ONG Ambientais',
                'Cientistas / Investigadores',
                'Doadores'
            ],
            'group3' => [
                'Operador Privado de turismo',
                'Operador Florestal',
                'Operador de Pesca'
            ]
        ],
        'ratingLegend' => [
            'Cooperation' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '0' => 'Sem cooperação',
                '1' => 'Muito pouca cooperação',
                '2' => 'Cooperação moderada',
                '3' => 'Cooperação muito elevada'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'As partes interessadas contribuem para a gestão da área protegida a fim de desenvolver a compreensão e o apoio para a realização dos objectivos da área protegida?',
            'Em muitas áreas protegidas, alguns ou todos os intervenientes relevantes estão a cooperar de forma substancial na tomada de decisões da gestão relativamente às actividades e à sua implementação dentro ou fora da área protegida. Esta cooperação pode envolver acordos formais ou informais. O nível de cooperação das partes interessadas numa área protegida depende de uma variedade de factores, mas particularmente da natureza das partes interessadas, das pressões e outras influências decorrentes das partes interessadas, e da biodiversidade e dos serviços ecossistémicos da área protegida. Esta etapa da análise avalia a forma como alguns ou todos os interessados relevantes estão envolvidos na gestão da área protegida em quatro áreas: (P) planeamento; (PG) planeamento e gestão (B/A) benefícios/assistência para as comunidades locais (IEC) Informação, educação e comunicação para a compreensão e envolvimento da comunidade. O nível óptimo de envolvimento e cooperação das partes interessadas deve ser determinado individualmente para cada área protegida, porque cada área protegida é única'
        ],
        'module_info_Rating' => [
            'Seleccionar (A) as áreas em que os interessados estão envolvidos na gestão da área protegida e avaliar (B) o nível de cooperação:<ul><li><b>P</b>: plano de gestão</li><li><b>PM</b>: implementação do plano de gestão</li><li><b>B/A</b>:benefícios/assistência para as comunidades locais </li><li><b>IEC</b>:educação ambiental, sensibilização e envolvimento da comunidade</li></ul>'
        ]
    ],

    'AssistanceActivities' => [
        'title' => 'Benefícios/assistência para as comunidades locais',
        'fields' => [
            'Activity' => 'Criterio – Conceito medido – Variáveis',
            'EvaluationScore' => 'Adequação de actividades para proporcionar benefícios/assistência',
            'Comments' => 'Comentários/Explicação',
        ],
        'groups' => [
            'group0' => 'Elementos dos padrões materiais do nível de vida',
            'group1' => 'Elementos dos padrões imateriais de nível de vida'
        ],
        'predefined_values' => [
            'group0' => [
                'Apoio a actividades locais (por exemplo, gestão de serviços ecossistémicos - gestão de aprovisionamento, adaptação às alterações climáticas, etc.)',
                'Apoio às empresas locais (por exemplo, transformação de produtos agrícolas, de pesca, florestais, etc.)',
                'Apoio a percursos de financiamento local',
                'Apoio à produção alimentar e à agricultura de pequena escala',
                'Compra de produtos agrícolas ou frutos do mar para turismo e pessoal',
                'Apoio às empresas de turismo',
                'Apoio aos produtos tradicionais e artesanato para turistas',
                'Apoio a resolução-compensação do conflito homem-fauna selvagem',
                'Apoio ao emprego de pessoal local no turismo',
                'Apoio a prestadores de serviços locais',
                'Distribuição dos rendimentos do turismo',
                'Provisão de recursos naturais em caso de necessidade (por exemplo, água, fibras, etc. das áreas protegidas durante crises ou contribuições materiais para edifícios sociais como hospitais, escolas, etc.)',
                'Emprego da população local na área protegida',
                'Emprego de fiscais  da região',
                'Fornecimento de energia, ligação eléctrica',
                'Fornecimento de água',
                'Apoio à construção, manutenção e melhoramento de estradas externas',
                'Apoio à resolução de conflitos humano-vida selvagem-compensação',
                'Apoiar a pesca em pequena escala',
                'Apoio para a construção de hangares de barcos',
                'Apoio para a construção de estacionamento de barcos'
            ],
            'group1' => [
                'Reforço da segurança na zona',
                'Minimização dos conflitos e reforço da gestão e utilização sustentável dos serviços ecossistémicos (abastecimento e cultura)',
                'Fornecimento Infraestruturas para a educação (i.e. edifícios)',
                'Prestação de serviços educativos (ensino)',
                'Fornecimento de infra-estruturas para a Saúde (isto é, edifícios, água limpa)',
                'Prestação de serviços de saúde (cuidados de saúde)',
                'Fornecimento de livre acesso ao parque',
                'Prestação de serviços culturais (fisicos - intelectuais - emblemáticos - esspirituaisl - interaçoes a partir de serviços ecossistémicos)',
                'Facilitação da resolução de problemas sociais',
                'Reforço da identidade e do sentido de lugar das comunidades locais'
            ]
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '0' => 'Totalmente inadequado (0-30%)',
                '1' => 'Um pouco inadequado (31-60%)',
                '2' => 'Adequado (61-90%)',
                '3' => 'Totalmente adequado (91-100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'A área protegida realiza actividades/programas concebidos para proporcionar benefícios/assistência adequados às comunidades? ',
            'A gestão de áreas protegidas afastou-se do paradigma histórico da protecção total, em que os ganhos de conservação eram geralmente vistos à custa dos interesses das comunidades locais. É agora amplamente reconhecido que as áreas protegidas devem contribuir para o desenvolvimento sustentável e bem-estar económico das suas comunidades vizinhas. Os resultados socioeconómicos positivos das áreas protegidas são importantes por direito próprio, mas também podem ser necessários para assegurar que as áreas protegidas continuem a produzir resultados ecológicos fortes. A falta de benefícios/assistência adequados para as comunidades locais tem estado ligada a resultados de conservação falhados de iniciativas de áreas protegidas em muitos estudos de caso de todo o mundo. Consequentemente, as normas internacionais de melhores práticas promovem a avaliação de áreas protegidas que tem em conta tanto os resultados ecológicos como socioeconómicos (Fontes: UNESCO - IUCN).'
        ],
        'module_info_Rating' => [
            'Avaliar a adequação das actividades/programa que a área protegida está a levar a cabo para proporcionar benefícios/assistência às comunidades'
        ],
    ],

    'EnvironmentalEducation' => [
        'title' => 'Educação ambiental e sensibilização do público',
        'fields' => [
            'Activity' => 'Critério – Conceito Medido – Variável',
            'EvaluationScore' => 'Adequação das actividades de educação ambiental e sensibilização do público',
            'Comments' => 'Comentários/Explicação',
        ],
        'predefined_values' => [
            'Programas comunitários de conservação',
            'Programas de sensibilização nas aldeias em redor da área protegida',
            'Programas de sensibilização entre os residentes, excepto nas aldeias em redor da área protegida',
            'Programas de educação ambiental nas escolas',
            'Programas de rádio sobre a área protegida (por exemplo, em estações de rádio comunitárias)',
            'Programas televisivos sobre a área protegida',
            'Conferências e debates sobre conservação',
            'Visitas guiadas para as comunidades locais na área protegida',
            'Material de educação ambiental distribuído às escolas',
            'Operações de resíduos e limpeza',
            'Sensibilização do público (por exemplo, museus)'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '0' => 'totalmente inadequado (0-30%)',
                '1' => 'Um pouco inadequado (31-60%)',
                '2' => 'adequado (61-90%)',
                '3' => 'totalmente adequado (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'A área protegida realiza actividades/programas de educação ambiental e sensibilização do público especificamente ligados às necessidades e objectivos de conservação/gestão dos recursos naturais?',
            'A educação ambiental pode desempenhar um papel eficaz na sensibilização para a necessidade de proteger e preservar o ambiente e de melhorar a qualidade de vida humana. A educação ambiental pode ajudar os indivíduos a equilibrar as suas próprias necessidades vitais com as necessidades do ambiente natural que fornece serviços ecossistémicos (abastecimento, regulação, culturais e de apoio) para as comunidades dentro e fora, perto e longe da área protegida (considerando a designação específica da área protegida). A educação ambiental inclui educação e formação formal e informal que aumentam a capacidade humana e a capacidade de participar na gestão ambiental e na resolução de crises e desafios ambientais, incluindo as alterações climáticas. Isto poderia ser alcançado através de uma maior sensibilização e de uma mudança efectiva da perspectiva do indivíduo sobre o ambiente'
        ],
        'module_info_Rating' => [
            'Avaliar a adequação da educação ambiental e das actividades/programas de sensibilização do público que são apoiados pela área protegida'
        ]
    ],

    'VisitorsManagement' => [
        'title' => 'Gestão de instalações e serviços para visitantes',
        'fields' => [
            'Aspect' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Adequação das instalações e serviços dos visitantes',
            'Comments' => 'Comentários/Explicação',
        ],
        'predefined_values' => [
            'Procedimentos de gestão turistica relacionados com objectivos/resultados favoráveis dos valores das áreas protegidas',
            'Existência de objectivos específicos para o turismo e a gestão de visitantes',
            'Aumentar a consciencialização sobre as actividades de ecoturismo',
            'Utilização do zoneamento para gerir diversas oportunidades de recreação, preservando ao mesmo tempo valores importantes',
            'Diversificação turística através da promoção dos valores biofísicos, culturais e sociais',
            'Compromisso dos intervenientes e titulares de direitos para estabelecer consensos e parcerias para a implementação de actividades turísticas',
            'Garantidos os benefícios económicos para a área protegida',
            'Estratégia e programas de informação e comunicação de apoio à sustentabilidade dos programas turísticos',
            'Gestão de alojamentos, restauração e actividades de lazer',
            'Transporte de visitantes e gestão da segurança',
            'Alojamento, restauração, actividades de lazer para pessoas deficientes',
            'Gama de experiências disponíveis para os visitantes',
            'Guias turísticos na área protegida',
            'Desenvolvimento constante das atracções turísticas',
            'Sentido de lugar (preservar ou melhorar o carácter específico do espaço natural)',
            'Dados de monitorização de turismo'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '0' => 'Totalmente inadequado (0-30%)',
                '1' => 'Um pouco inadequado (31-60%)',
                '2' => 'Adequado (61-90%)',
                '3' => 'Totalmente adequado (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'A área protegida gere (concebe, cria, mantém e melhora) as instalações e serviços necessários aos visitantes para o turismo ambiental?',
            'O turismo em áreas protegidas é uma indústria grande e em crescimento. O turismo é um serviço crítico do ecossistema que pode contribuir directa e indirectamente para as áreas protegidas como estratégia global de conservação, incluindo o cumprimento dos Objectivos de Aichi relacionados com a conservação, desenvolvimento comunitário e sensibilização do público (CDB, 2012). O turismo é um fenómeno complexo e as suas interacções com áreas protegidas ocorrem em contextos históricos, culturais e geográficos únicos, envolvendo múltiplos valores e partes interessadas. A gestão eficaz do turismo em áreas protegidas requer uma apreciação e compreensão dos contextos de sustentabilidade ambiental, social e económica e uma gestão compatível das instalações e serviços dos visitantes, e a compreensão de como estes mudam ao longo do tempo.'
        ],
        'module_info_Rating' => [
            'Avaliar a adequação da gestão das instalações e serviços de visitantes da área protegida para o turismo ambiental'
        ]
    ],

    'VisitorsImpact' => [
        'title' => 'Gestão do impacto do visitante',
        'fields' => [
            'Impact' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Adequação da gestão do impacto dos visitantes',
            'Comments' => 'Comentários/Explicação',
        ],
        'predefined_values' => [
            'Acções para determinar, monitorizar e gerir o nível aceitável de impacto do visitante',
            'Acções para minimizar as mudanças induzidas pelo homem (transporte, alojamento e actividades de lazer)',
            'Processo de gestão que equilibra objectivos de conservação com actividades com fins lucrativos [por exemplo (1) desenvolvimento de um centro de visitantes e trilhos, (2) limitação da utilização para proteger a biodiversidade num habitat específico]',
            'Recolha e comunicação de dados de monitorização do turismo e provas de impactos para aumentar o envolvimento público e a sensibilização dos visitantes'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A => este elemento não está relacionado com a gestão da área protegida',
                '0' => 'totalmente inadequado (0-30%)',
                '1' => 'Um pouco algo inadequado (31-60%)',
                '2' => 'adequado (61-90%)',
                '3' => 'Totalmente adequado (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'A área protegida gere e mitiga adequadamente os impactos dos visitantes?',
            'Promover a recreação e o turismo para que os visitantes possam conhecer e apreciar uma área protegida, sem prejudicar os valores para os quais foi estabelecida, pode ser um desafio. Os visitantes podem afectar negativamente tanto os recursos como a experiência de outros visitantes, ou podem também ofender inconscientemente os padrões culturais. A monitorização adequada, gestão e mitigação dos impactos dos visitantes são fundamentais para estratégias de gestão do turismo sustentável, mas são frequentemente ignorados quando o plano está em curso. Sem um conhecimento adequado dos efeitos das actividades turísticas no ambiente natural do local e nas comunidades circundantes, é impossível estabelecer se a gestão do ecoturismo da área protegida é bem sucedida'
        ],
        'module_info_Rating' => 'Avaliar a gestão do impacto dos visitantes na área protegida (turismo ambiental)'
    ],

    'NaturalResourcesMonitoring' => [
        'title' => 'Sistemas de monitorização dos recursos naturais e culturais',
        'fields' => [
            'Aspect' => 'Critério – Conceito medido – Variáveis',
            'EvaluationScore' => 'Adequação da monitorização',
            'Comments' => 'Comentários/Explicação',
        ],
        'predefined_values' => [
            'Concepção da monitorização e sua aplicação no terreno (por exemplo, por Fiscais, investigadores, etc.)',
            'Capacidades institucionais e recursos técnicos para monitorização',
            'Segurança de guardar e armazenar os dados a partir da monitorização',
            'Utilização de dados da monitorização para induzir alterações na gestão da área protegida',
            'Monitorização dos principais objectivos de conservação',
            'Monitorização  de espécies (emblemática, ameaçada, endémica, ...)',
            'Monitorização de habitats e as dimensões relacionadas da cobertura do solo, uso e ocupação',
            'Monitorização dos ecossistemas de água doce (lagos, rios, lagoas e riachos mais pequenos)',
            'Controlo do padrão de vida material das populações na área protegida e na sua zona tampão',
            'Monitorização do padrão de vida imaterial das populações na área protegida e na sua zona tampão',
            'Controlo das ameaças directas e indirectas à área protegida',
            'Monitorização dos impactos dos visitantes',
            'Monitorização dos serviços ecossistémicos prestados pela área protegida',
            'Monitorização dos efeitos das alterações climáticas nos elementos-chave da área protegida',
            'Recolha e análise de dados (ou seja, SMART, Monitoria Baseada nos Fiscaisd - MRBFM)'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '0' => 'totalmente inadequado (0-30%)',
                '1' => 'Um pouco algo inadequado (31-60%)',
                '2' => 'adequado (61-90%)',
                '3' => 'totalmente adequado (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Os sistemas de monitorização são adequados para monitorizar eficazmente a biodiversidade, os recursos naturais e culturais da área protegida?',
            'A execução bem sucedida de um programa de monitorização depende da análise dos principais objectivos de conservação da área protegida para estabelecer critérios específicos e indicadores de monitorização. Sob a influência de forças motrizes e ameaças negativas (crescimento populacional e económico, fenómenos naturais, etc.), as actividades humanas exercem pressão sobre a área protegida. Esta pressão resulta numa mudança, perturbação ou degradação dos valores e recursos da área protegida. A fim de antecipar potenciais problemas e planear as melhores intervenções na área protegida, é indispensável uma sólida compreensão das tendências dos serviços ambientais e dos ecossistemas (biodiversidade, abastecimento de água, abastecimento alimentar, qualidade das florestas, ameaças, etc.).'
        ],
        'module_info_Rating' => [
            'Avaliar a adequação dos sistemas de monitorização existentes à biodiversidade e aos recursos naturais e culturais da área protegida'
        ]
    ],

    'ResearchAndMonitoring' => [
        'title' => 'Investigação e monitorização ecológica a longo prazo',
        'fields' => [
            'Program' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Adequação da investigação e monitorização a longo prazo',
            'Comments' => 'Comentários/Explicação',
        ],
        'predefined_values' => [
            'Investigação e papel de monitorização ecológica a longo prazo na gestão da área protegida',
            'Fundos/instalações e capacidades institucionais e/ou externas para promover e coordenar actividades de investigação',
            'Acessibilidade e segurança dos dados da investigação',
            'Apoio à gestão a partir de dados de investigação e monitorização ecológica a longo prazo',
            'Investigação e monitorização ecológica a longo prazo das espécies (emblemática, em perigo, endémica, etc.)',
            'Investigação e monitorização ecológica a longo prazo dos habitats e as dimensões relacionadas da cobertura do solo, uso e ocupação',
            'Investigação e monitorização ecológica a longo prazo dos ecossistemas de água doce (lagos, rios, lagoas e riachos mais pequenos)',
            'Investigação e monitorização ecológica a longo prazo do bem-estar humano e do bem-estar material da população da área protegida e do seu',
            'Investigação e monitorização ecológica a longo prazo das ameaças directas e indirectas à área protegida',
            'Investigação e monitorização ecológica a longo prazo dos serviços ecossistémicos prestados pela área protegida',
            'Investigação e monitorização ecológica a longo prazo dos efeitos das alterações climáticas em elementos-chave da área protegida'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '0' => 'totalmente inadequado (0-30%)',
                '1' => 'Um pouco algo inadequado (31-60%)',
                '2' => 'Adequado (61-90%)',
                '3' => 'totalmente adequado (91-100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'A área protegida coordena ou inicia actividades de investigação e monitorização ecológica a longo prazo, e tem acesso e faz uso dos resultados da investigação na sua gestão?',
            'O objectivo da investigação e biomonitorização numa área protegida é obter informações sobre o desenvolvimento a longo prazo de componentes seleccionados dos seus ecossistemas para prever questões futuras e planear intervenções de gestão. Um levantamento deve seleccionar as áreas bem como as espécies, habitats, água, etc., para avaliar a saúde ambiental dos valores e a importância da área protegida. Medidas funcionais poderiam ser cada vez mais aplicadas como uma abordagem complementar para monitorizar a integridade ecológica da área protegida'
        ],
        'module_info_Rating' => [
            'Avaliar a adequação das acções/aplicações de investigação que apoiam a gestão da área protegida'
        ]
    ],

    'ClimateChangeMonitoring' => [
        'title' => 'Gestão da adaptação aos efeitos das alterações climáticas',
        'fields' => [
            'Program' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Classificação: Adequação das medidas de adaptação',
            'Comments' => 'Comentários/Explicação',
        ],
        'predefined_values' => [
            'Gestão da adaptação de espécies (por exemplo, espécies translocadas, etc.)',
            'Gestão da adaptação dos habitats e as dimensões relacionadas da cobertura do solo, uso e ocupação dentro e fora da área protegida (evitar a fragmentação da floresta, solo descoberto, etc.)',
            'Gestão da adaptação dos serviços ecossistémicos',
            'Redução dos factores de stress que amplificam os impactos climáticos (por exemplo, aumentar a conectividade, controlar as espécies invasoras, etc.)',
            'Manter ou restaurar o processo e função do ecossistema para promover a resiliência (por exemplo, restaurar a vegetação degradada, etc.)',
            'Proteger ecossistemas intactos e conectados (por exemplo, remover impedimentos das vias navegáveis; evitar a bissecção de corredores, etc.)',
            'Protecção de áreas que fornecem um futuro habitat para espécies deslocadas (por exemplo, estabelecer parcerias para proteger habitats críticos fora da área protegida para espécies-chave afectadas pelos efeitos das alterações climáticas)',
            'Identificação e protecção do refúgio climático (por exemplo, reduzir o uso humano e a perturbação nos refúgios, etc.)',
            'Gestão de redes ecológicas para promover a resiliência ecológica aos impactos climáticos',
            'Participar no planeamento da adaptação das paisagens terrestre e marinham que se estende para além dos limites das áreas protegidas individuais'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '0' => 'totalmente inadequado (0-30%)',
                '1' => 'Um pouco inadequado (31-60%)',
                '2' => 'adequado (61-90%)',
                '3' => 'totalmente adequado (91-100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Como é que a área protegida gere a adaptação aos efeitos das alterações climáticas?',
            'A resposta às alterações climáticas pode ser dividida em \'mitigação\' (acções que reduzem a quantidade de dióxido de carbono e outros gases que retêm o calor na atmosfera) e \'adaptação\' (um ajustamento dos sistemas humanos ou naturais às alterações climáticas). Embora as áreas protegidas tenham a capacidade de capturar e armazenar carbono nos seus ecossistemas e de reduzir as emissões das operações das áreas protegidas, o foco principal da gestão é geralmente a adaptação aos efeitos das alterações climáticas.'
        ],
        'module_info_Rating' => [
            'Avaliar a adequação das acções de gestão da adaptação às alterações climáticas'
        ]
    ],

    'EcosystemServices' => [
        'title' => 'Gestão de serviços do ecossistema',
        'fields' => [
            'Intervention' => 'Critério – Conceito medido – Variáveis',
            'EvaluationScore' => 'Adequação da gestão dos serviços ecossistémicos',
            'Comments' => 'Comentários/Explicação',
        ],
        'categories' => [
            'title1' => 'Provisionando',
            'title2' => 'Regulando',
            'title3' => 'Cultural',
            'title4' => 'Apoio',
        ],
        'groups' => [
            'group0' => 'Gerir para a nutrição (exemplo água, comida, forragem, plantas medicinais, pesca, etc.)',
            'group1' => 'Gerir para materiais (exemplo reflorestamento para produção de madeira, produtos florestais não madeireiros (NTFP) para uso sustentável, outros materiais para extraccao)',
            'group2' => 'Gerir para energia (exemplo hidrolectrica)',
            'group3' => 'Gerir para o fluxo dos resíduos materiais, substancia tóxicas (exemplo filtração e decomposição de residuos organicos e poluentes nas águas)',
            'group4' => 'Gerir para manter as condições biológicas, químicas e físicas (por exemplo, polinização, mitigar os danos causados por desastres naturais)',
            'group5' => 'Gerir para altos níveis de interações físicas (exemplo conservação ex-situ)',
            'group6' => 'Gerir para um alto nivel de interações intelectuais (exemplo investigação)',
            'group7' => 'Gerir para altos níveis de interações espirituais e / ou emblemáticas entre a área protegida e as partes interessadas (por exemplo, ritos tradicionais)',
            'group8' => 'Gerir para habitats sustentáveis (polinização de culturas, insectos, etc.)',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento nao está relacionado com a gestão da área protegida',
                '0' => 'total mente inadequado (0-30%)',
                '1' => 'um pouco inadequado (31-60%)',
                '2' => 'adequado (61-90%)',
                '3' => 'totalmente adequado (91-100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'A área protegida consegue promover a conservação/ melhoria dos serviços ecossistémicos fornecidos pela área protegida?',
            'serviços do ecossistema são os muitos e variados benefícios que os humanos obtêm livremente do ambiente natural e do funcionamento adequado dos ecossistemas. Os serviços ecossistémicos são agrupados em quatro categorias amplas: (1) serviços de provisão, como a produção de alimentos e água; (2) serviços reguladores, como o controle do clima e das doenças; (3) serviços culturais, como benefícios espirituais e recreativos; e (4) serviços de apoio, como ciclos de nutrientes, polinização de culturas ou habitats que fornecem tudo que uma planta ou animal individual precisa para sobreviver: comida; água; e abrigo [Avaliação do Ecossistema do Milênio (MA)]'
        ],
        'module_info_Rating' => [
            'Avaliar a adequação das acções de gestão promovendo a conservação/valorização dos serviços ecossistémicos prestados pela unidade de conservação'
        ]
    ],

    'ObjectivesProcessus' => [
        'module_info' => 'Estabecer e descrever os objectivos da conservacao relacionado <b>com o processo de implementacao e planificacao</b> da área protegida<br /> Os objectivos inseridos abaixo serao usados para a melhoria da gestao, e mais especificamente para a planificacao, recursos (insumos) mobilizacao, fases do processo e para a monitorizacao das actividades de gestao da area protegida.'
    ],

    'WorkProgramImplementation' => [
        'title' => 'Implementação das actividades do plano de trabalho/acção',
        'fields' => [
            'Category' => 'Categorias de actividades',
            'Activity' => 'Actividade',
            'TargetedActivity' => 'Actividade Planificada',
            'EvaluationScore' => 'Nível de implementação',
            'Comments' => 'Comentários/Explicação',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Nenhum ou muito baixo nível de implementação das actividades visadas do ano anterior (entre 0 e 25%)',
                '1' => 'Baixo nível de implementação das actividades visadas do ano anterior (entre 26 e 50%)',
                '2' => 'Nível moderado de implementação das actividades visadas do ano anterior (entre 51 e 75%)',
                '3' => 'Alto nível de implementação das actividades visadas do ano anterior (entre 76 e 100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Em que medida é que a área protegida implementou as principais actividades do plano de trabalho?',
            'A implementação é a realização, ou execução, do plano de trabalho/acção anual ou plurianual relativo às actividades da área protegida. Como tal, a implementação é a acção que deve seguir qualquer actividade prévia de planeamento, gestão e conservação. Quando a área protegida implementa um plano de trabalho, pode alcançar acções de gestão e conservação orientadas de uma forma sustentável'
        ],
        'module_info_Rating' => [
            'Avaliar o nível de implementação das principais actividades do plano de trabalho/acção para o ano anterior (na caixa de comentários indique o ano de referência se se candidatar a um plano de trabalho/acção plurianual)',
            '<b>Categoria de actividades</b>: por exemplo, aplicação da lei, desenvolvimento de instalações sociais, educação ambiental, gestão do turismo, etc.',
            '<b>Actividade</b> = acção pertencente a uma das principais categorias de actividades que é executada para alcançar um determinado objectivo',
            'Sem um plano de trabalho/acção, pode referir-se às categorias e às actividades do elemento Processo: Gestão e protecção dos elementos-chave; Relações com as partes interessadas; Turismo; Monitorização e investigação; Alterações climáticas e Serviços do Ecossistema'
        ]
    ],

    'AchievedResults' => [
        'title' => 'Alcance dos produtos do plano de trabalho/acção',
        'fields' => [
            'Category' => 'Categorias de actividades',
            'Activity' => 'Actividade',
            'TargetedOutput' => 'Produto Alvo',
            'EvaluationScore' => 'Nível de alcance',
            'Comments' => 'Comentários/Explicação',
        ],
        'module_info' => 'O sistema estatistico permite apenas cinco linhas para identificar as funcoes do pessoal da area protegida',
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Nenhum ou muito baixo nível de implementação das actividades visadas do ano anterior (entre 0 e 25%)',
                '1' => 'Baixo nível de implementação das actividades visadas do ano anterior (entre 26 e 50%)',
                '2' => 'Nível moderado de implementação das actividades visadas do ano anterior (entre 51 e 75%)',
                '3' => 'Alto nível de implementação das actividades visadas do ano anterior (entre 76 e 100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Em que medida é que a área protegida implementou as principais actividades do plano de trabalho?',
            'A abordagem predominante para o planeamento de áreas protegidas inclui o estabelecimento de um plano de trabalho/plano de acção anual ou plurianual, PRODUTOS que contribuiem para a realização dos objectivos de conservação a longo prazo ou	RESULTADOS. No processo de planeamento, os objectivos gerais a longo prazo são traduzidos em metas de conservação a curto prazo para características específicas da biodiversidade, tais como espécies, habitats e ameaças ou serviços ecossistémicos possíveis de se alcançar com o plano de trabalho/plano de acção. Contudo, uma vez que a utilização de muitas metas de conservação de baixo nível são um obstáculo para alcançar um desempenho de conservação de alto nível, os produtos devem estar fortemente ligados aos resultados para assegurar um desempenho de conservação de alto nível. A implementação de sistemas de medição do desempenho é uma forma importante de acompanhar o progresso das suas actividades de gestão e conservação.'
        ],
        'module_info_Rating' => [
            '•	Avaliar o nível de realização dos principais produtos do plano de trabalho/acção (nos comentários, indique o ano de referência se se candidatar a um plano de trabalho/acção plurianual)',
            '<b>Categoria de actividade</b> = exemplo aplicação da lei, desenvolvimento de instalações sociais, educação ambiental, gestão do turismo, etc.',
            '<b>Actividade</b> = acção pertencente a uma das principais categorias de actividades que é executada para alcançar um determinado objectivo',
            'Sem um plano de trabalho/acção, pode referir-se às categorias e às actividades do elemento Processo: Gestão e protecção dos elementos-chave; Relações com as partes interessadas; Turismo; Monitorização e investigação; Alterações climáticas e Serviços do Ecossistema'
        ]
    ],

    'AreaDomination' => [
        'title' => 'Dominação da área',
        'fields' => [
            'Patrol' => 'A) Área coberta pelas patrulhas',
            'RapidIntervention' => 'B) Capacidade de intervenção rápida',
            'AirVehicles' => 'C.1) Meios especiais disponíveis e adequados para a vigilância',
            'Planes' => 'C.2) Meios especiais disponíveis e adequados para uma intervenção rápida',
            'Comments' => 'Comentários/Explicação'
        ],
        'ratingLegend' => [
            'Patrol' => [
                '0' => 'A área coberta pelo inquérito de patrulhas é mínima (de 0 a 25% da superfície)',
                '1' => 'A área coberta pelo inquérito de patrulhas é limitada (de 26 a 50% da superfície)',
                '2' => 'A área coberta pelo inquérito de patrulhas é justa (de 51 a 75% da área da superfície)',
                '3' => 'A área coberta pelo inquérito de patrulhas é muito boa (mais de 76% da superfície)',
            ],
            'RapidIntervention' => [
                '0' => 'A capacidade de intervenção rápida na área protegida é mínima (de 0 a 25% da área de superfície)',
                '1' => 'A capacidade de intervenção rápida na área protegida é limitada (de 26 a 50% da superfície)',
                '2' => 'A capacidade de intervenção rápida na área protegida é justa (de 51 a 75% da área de superfície)',
                '3' => 'A capacidade de intervenção rápida na área protegida é muito boa (mais de 76% da superfície)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Qual é a extensão actual do domínio da área protegida',
            'O domínio da área refere-se à capacidade da gestão do parque para criar presença numa determinada área, por exemplo através de levantamentos regulares de patrulha, intervenções rápidas ou vigilância aérea. Quando necessário, esta presença tem de ser imposta com frequência e eficácia para enfrentar ameaças tais como a caça furtiva ou actividades ilegais. O objectivo do domínio de uma área elevada é prevenir ou minimizar as actividades ilegais que afectam a biodiversidade, os valores culturais ou históricos, e impor a protecção da área protegida e dos seus limites'
        ],
        'module_info_Rating' => [
            'Avaliar o domínio da área com base na percentagem da superfície da área protegida onde a gestão está presente ou pode estar presente através de (A) inquéritos de patrulha; (B) intervenções rápidas; (C) utilização de meios especiais'
        ]
    ],

    'AreaDominationMPA' => [
        'title' => 'Aplicação da lei em MPA',
        'fields' => [
            'Activity' => 'Gama de actividades sujeitas a análise',
            'Patrol' => 'Area covered by patrols',
            'RapidIntervention' => 'Rapid intervention capacity',
            'DetectionRemoteSensing' => 'Detecção através de ferramentas de detecção remota (ou seja, sistemas de monitorização de navios VMS)',
            'SpecialMeansRapidIntervention' => 'Significado especial de apoio à intervenção rápida',
        ],
        'groups' => [
            'group0' => 'Santuário',
            'group1' => 'Zonas de não consumo (No-take areas) / Reserva marinha',
            'group2' => 'Zonas tampão para uso tradicional',
            'group3' => 'Zonas amortecedoras para actividades educativas e/ou recreativas',
            'group4' => 'Aplicação da doca para embarcações que chegam ao porto'
        ],
        'predefined_values' => [
            'group0' => [
                'Todas as actividades/utilizações proibidas'
            ],
            'group1' => [
                'Actividades proibidas (por exemplo, pesca ou extracção de qualquer tipo, ancoragem, navegação, despejo, etc.)',
                'Actividades permitidas (por exemplo, investigação e monitorização, etc.)'
            ],
            'group2' => [
                'Actividades proibidas (por exemplo, pesca ilegal e métodos de pesca legais especificados, ancoragem, descarga)',
                'Actividades permitidas (por exemplo, pesca e navegação tradicional limitada e especificada, natação e mergulho, ancoragem em bóias de amarração, investigação, etc.)'
            ],
            'group3' => [
                'Actividades permitidas (por exemplo, pesca e navegação tradicional limitada e especificada, natação e mergulho, ancoragem em bóias de amarração, investigação e educação, etc.)'
            ],
            'group4' => [
                'Actividades utilizadas para recolher informações que possam lançar luz sobre padrões de comportamentos ilícitos. As estratégias das docas devem ser adaptadas para promover a aplicação mais apropriada para os grandes MPAs ou para resolver problemas de aplicação em MPAs mais pequenos e próximos da costa'
            ],
        ],
        'ratingLegend' => [
            'Patrol' => [
                '0' => 'A área coberta pelo inquérito de patrulhas é mínima (de 0 a 25% da superfície)',
                '1' => 'A área coberta pelo inquérito de patrulhas é limitada (de 26 a 50% da superfície)',
                '2' => 'A área coberta pelo inquérito de patrulhas é justa (de 51 a 75% da área da superfície)',
                '3' => 'A área coberta pelo inquérito de patrulhas é muito boa (mais de 76% da superfície)',
            ],
            'RapidIntervention' => [
                '0' => 'A capacidade de intervenção rápida na área protegida é mínima (de 0 a 25% da área de superfície)',
                '1' => 'A capacidade de intervenção rápida na área protegida é limitada (de 26 a 50% da superfície)',
                '2' => 'A capacidade de intervenção rápida na área protegida é justa (de 51 a 75% da área de superfície)',
                '3' => 'A capacidade de intervenção rápida na área protegida é muito boa (mais de 76% da superfície)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Qual é a actual extensão da aplicação da lei na MPA?',
            'A aplicação da MPA refere-se à capacidade da gestão do parque para criar presença numa determinada área, por exemplo através de levantamentos regulares de patrulhas, intervenções rápidas ou vigilância aérea ou detecção através de ferramentas de detecção remota. Quando necessário, esta presença tem de ser imposta com frequência e eficácia para enfrentar ameaças tais como a caça furtiva ou actividades ilegais. O objectivo de uma fiscalização elevada na MPA é prevenir ou minimizar as actividades ilegais que afectam a biodiversidade, os valores culturais ou históricos, e impor a protecção da área protegida e dos seus limites'
        ],
        'module_info_Rating' => [
            'Avaliar o domínio da área com base na percentagem da superfície da área protegida onde a gestão está presente ou pode estar presente através de (A) inquéritos de patrulha; (B) intervenções rápidas; (C) utilização de meios especiais'
        ]
    ],

    'AchievedObjectives' => [
        'title' => 'Alcance dos objectivos de conservação a longo prazo do plano de gestão',
        'fields' => [
            'Objective' => 'Principais Objectivos Geral/Objectivo a longo prazo',
            'EvaluationScore' => 'Nível de alcance dos objectivos',
            'Comments' => 'Comentários/Explicação',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'nenhum ou muito baixo nível de realização (entre 0 e 25%).',
                '1' => 'baixo nível de realização (entre 26 e 50%)',
                '2' => 'nível de realização moderado (entre 51 e 75%)',
                '3' => 'alto nível de realização (entre 76 e 100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Em que medida é que a área protegida alcançou os principais objectivos do plano de gestão?',
            '(Com base na análise do contexto de intervenção, ponto CTX1.5 Visão - Missão - Objectivos ou elemento Planeamento, ponto P6 - Objectivoes da área protegida',
            'A gestão das áreas protegidas é cada vez mais efectuada de acordo com os princípios de "gestão por objectivos". As metas e objectivos de uma área protegida devem ser claramente compreendidos para que a gestão seja bem sucedida com base em realizações mensuráveis. Nesta ferramenta, fazemos uma distinção importante entre resultados e produtos: <ul><li>OOs RESULTADOS referem-se as mudanças relacionadas com os OBJECTIVOS GERAIS, ou seja, objectivos gerais de longo prazo/objectivos ou visões expressas no plano de maneio. Estes objectivos gerais são geralmente declarações específicas relacionadas com os valores-chave da área protegida (ou seja, espécies importantes ou serviços ecossistémicos) ou com as principais áreas de actividades de gestão (por exemplo, turismo, educação).</li><li>PRODUTOS referem-se a metas, ou seja, metas quantitativas de curto prazo (ou relativamente de curto prazo) para atingir as metas/objectivos de longo prazo e objectivos específicos. Acreditamos que a utilização de muitas metas de conservação de baixo nível é um obstáculo para alcançar um desempenho de conservação de alto nível</li></ul>'
        ],
        'module_info_Rating' => [
            'Avaliar o nível de realização dos principais objectivos Gerais a longo prazo relacionados com os valores-chave da área protegida ou das principais áreas do plano de gestão'
        ]
    ],

    'KeyConservationTrend' => [
        'title' => 'Condições e tendências para os elementos-chave da conservação da área protegida',
        'fields' => [
            'Element' => 'Elementos chave da conservação',
            'Condition' => 'Condição do elemento chave',
            'Trend' => 'Tendência do elemento chave',
            'Reliability' => 'fiabilidade da informação',
            'Comments' => 'Comentários/Explicação',
        ],
        'groups' => [
            'group0' => 'Condições e tendências de conservação para as espécies animais chave',
            'group1' => 'Condições e tendências de conservação para espécies-chave de plantas',
            'group2' => 'Condições e tendências de conservação dos habitats e as dimensões relacionadas de cobertura de terra cover - uso',
            'group3' => 'Situação e tendências das ameaças para a área protegida',
            'group4' => 'Adaptação às alterações climáticas',
            'group5' => 'Condições e tendências de conservação dos serviços ecossistémicos da área protegida'
        ],
        'ratingLegend' => [
            'Condition' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '-3' => 'Muito mau',
                '-2' => 'Mau',
                '-1' => 'Ligeiramente mau',
                '0' => 'Neutro',
                '+1' => 'Ligeiramente bom',
                '+2' => 'Bom',
                '+3' => 'Muito Bom',
            ],
            'Trend' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '-3' => 'fortemente decrescente',
                '-2' => 'Diminuindo',
                '-1' => 'Ligeiramente decrescente',
                '0' => 'Sem alterações',
                '+1' => 'Ligeiramente crescente',
                '+2' => 'Aumentando',
                '+3' => 'fortemente crescente',
            ],
            'Reliability' => [
                'High' => 'Quase uma completa certeza sobre os valores das condições e tendências',
                'Medium' => 'Alguma possibilidade de erro sobre os valores das condições e tendências',
                'Poor' => 'Alta incerteza acerca dos valores das condições e tendênciass',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Quais são as condições e tendências para os elementos-chave da conservação da área protegida?',
            'Os principais objectivos de gestão da área protegida são a conservação/restauro dos valores naturais e os benefícios que os seres humanos obtêm do ambiente natural e do bom funcionamento dos ecossistemas (serviços ecossistémicos). Os gestores devem assegurar a conservação/restauro de valores-chave (espécies animais e vegetais, habitats, etc.) e a preservação do abastecimento, regulação, cultura e apoio dos serviços ecossistémicos, assegurando os valores e benefícios das áreas protegidas para todos'
        ],
        'module_info_Rating' => [
            'Avaliar: A) as condições e B) as tendências dos elementos-chave de conservação da área protegida (com base nos Contextos 1 e 3, Elementos do processo PR7 - Gerindo os valores e elementos-chave da área']
    ],

    'LifeQualityImpact' => [
        'title' => 'Efeitos sobre a qualidade de vida das partes interessadas',
        'fields' => [
            'Element' => 'Critério – Conceito medido – Variável',
            'EvaluationScore' => 'Efeitos',
            'Comments' => 'Comentários/Explicação',
        ],
        'groups' => [
            'group0' => 'Elementos do nível de vida material',
            'group1' => 'Elementos do nível de vida imaterial',

        ],
        'predefined_values' => [
            'group0' => [
                'Actividades locais reforçadas (produção alimentar, agricultura em pequena escala, pesca em pequena escala, artesanato, serviços para a área protegida, etc.)',
                'Apoio às empresas locais (abastecimento de energia eléctrica, abastecimento de água, comércio, estradas entre aldeias, barracões de barcos, estacionamento de barcos, etc.)',
                'Provisão de serviços ecossistémicos (alimentos, material rustico, etc)',
                'Rendimento turístico',
                'Conflito entre homem e fauna selvagem',
                'Emprego de mão –de-obra local'
            ],
            'group1' => [
                'Protecção das pessoas, facilidades, infraestruturas e estabilidade social',
                'Manter a quantidade e qualidade do aprovisionamneto dos serviços ecossistémicos',
                'Contribuição para a educação',
                'Contribuição para o melhoramento dos Serviços locais de Saúde',
                'Manter os valores emblemáticos e espirituais do território local',
                'Manter or fortalecer a identidade comunitária (cultural, tradicional, espiritual, etc.)',
                'Redução de conflitos entre utilizadores de recursos naturais'
            ]
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'este elemento não está relacionado com a gestão da área protegida',
                '-3' => 'Efeitos altamente prejudiciais',
                '-2' => 'Efeitos nocivos',
                '-1' => 'Efeitos ligeiramente prejudiciais',
                '0' => 'Neutro',
                '+1' => 'Efeitos ligeiramente favoráveis',
                '+2' => 'Efeitos favoráveis',
                '+3' => 'Efeitos altamente favoráveis',
            ],

            'module_info_EvaluationQuestion' => [
                'A gestão da área protegida tem efeitos positivos ou negativos sobre a qualidade de vida dos intervenientes locais?',
                'Mudanças correntes e futuras do ambiente e disponibilidade dos recursos essenciais podem afectar a qualidade de vida através dos impactos no consumo, renda e riqueza (padroes de vida materiais) e na boa vida, saúde e relações sociais e culturais (padrões imateriais de vida).  A gestão das áreas protegidas deve ter muito cuidado com os efeitos sobre a qualidade de vida dos intervenientes locais'
            ],
            'module_info_Rating' => [
                'Avaliar os efeitos para os intervenientes locais resultantes das actividades operacionais da área protegida'
            ]
        ]
    ]
];
