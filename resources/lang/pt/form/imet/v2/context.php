<?php

return [

    'Create' => [
        'title' => 'Criar um novo IMET (WDPA)',
        'fields' => [
            'version' => 'versão',
            'Year' => 'ano',
            'wdpa_id' => 'zona protegida',
            'language' => 'língua',
            'prefill_prev_year' => 'pré-preencher com o ano anterior'
        ]
    ],

    'CreateNonWdpa' => [
        'title' => 'Criar um novo IMET (não WDPA)',
        'fields' => [
            'version' => 'versão',
            'Year' => 'ano',
            'wdpa_id' => 'zona protegida',
            'language' => 'língua',
            'prefill_prev_year' => 'pré-preencher com o ano anterior',
            'pa_def' => 'definição',
            'name' => 'nome fornecido pelo operador',
            'origin_name' => 'nome na língua original',
            'designation' => 'nome da designação (por exemplo, reserva, santuário, etc.) ',
            'designation_eng' => 'designação obrigatória em inglês',
            'designation_type' => 'Tipo de designação',
            'marine' => 'tipologia',
            'rep_m_area' => 'superfície da área protegida marinha conservada [km<sup>2</sup>]',
            'rep_area' => 'superfície da área protegida conservada [km<sup>2</sup>]',
            'status' => 'estado',
            'status_year' => 'ano da promulgação do estatuto',
            'country' => 'país',
        ],

        'allowed_international' => 'Allowed values for international-level designations',
        'allowed_regional' => 'Allowed values for regional-level designations',
        'allowed_national' => 'No fixed values for protected areas designated at a national level',
    ],

    'Objectives' => [
        'title' => 'Definição de objectivos',
        'fields' => [
            'Element' => 'Elemento/Indicador',
            'Status' => 'Dados de referencia',
            'Objective' => 'Objectivo - Metas de Longo termo/Objectivos',
            'Comments' => 'Comments'
        ]
    ],

    'Objectives1' => [
        'module_info' => 'Estabelecer e descrever objectivos de conservação para a governação, parcerias e a designação da área protegida <br/> Os objectivos inseridos abaixo serão utilizados para melhorar a gestão, e mais especificamente para o planeamento, mobilização de recursos (insumos), fases do processo, e para o controlo das actividades de gestão da área protegida'
    ],
    'Objectives2' => [
        'module_info' => 'Estabelecer e descrever objectivos de conservação para <b>áreas terrestres, limites, índice de configuração e domínio</b> da área protegida<br/>. Os objectivos inseridos abaixo serão utilizados para melhorar a gestão, e mais especificamente para o planeamento, mobilização de recursos (insumos), fases do processo, e para o controlo das actividades de gestão da área protegida'
    ],
    'Objectives3' => [
        'module_info' => 'Estabelecer e descrever objectivos de conservação para osde recursos <b>humanos e financeiros/apoio de parcerias e infra-estruturas, equipamento e instalações na gestão </b>da área protegida.<br/> Os objectivos inseridos abaixo serão utilizados para melhorar a gestão, e mais especificamente para o planeamento, mobilização de recursos (insumos), fases do processo, e para o controlo das actividades de gestão da área protegida'
    ],
    'Objectives4' => [
        'module_info' => 'Estabelecer e descrever objectivos de conservação para factores-chave: <b>i) espécies e plantas emblemáticas, ameaçadas, endémicas, invasorasivas, exploradas, com dados insuficientes; ii) habitats; iii) mudança de terra e iv) gestão dos recursos naturais </b>da área protegida.<br/> Os objectivos inseridos abaixo serão utilizados para melhorar a gestão, e mais especificamente para o planeamento, mobilização de recursos (input), fases do processo, e para o controlo das actividades de gestão da área protegida'
    ],
    'Objectives5' => [
        'module_info' => 'Estabelecer e descrever objectivos de conservação para as <b>ameaças</b> que a área protegida enfrenta.<br/> Os objectivos inseridos abaixo serão utilizados para melhorar a gestão, e mais especificamente para o planeamento, mobilização de recursos (insumos), fases do processo, e para a monitorização das actividades de gestão da área protegida'
    ],
    'Objectives6' => [
        'module_info' => 'Estabelecer e descrever objectivos de conservação <b>dos efeitos das alterações</b> climáticas com que as áreas protegidas se confrontam<br/> Os objectivos inseridos abaixo serão utilizados para melhorar a gestão, e mais especificamente para o planeamento, mobilização de recursos (insumos), fases do processo e para o controlo das actividades de gestão da área protegida.'
    ],
    'Objectives7' => [
        'module_info' => 'Estabelecer e descrever objectivos de conservação para <b>os serviços ecossistémicos e a dependência destes serviços das comunidades/sociedades</b> na área protegida <br/> Os objectivos inseridos abaixo serão utilizados para melhorar a gestão, e mais especificamente para o planeamento, mobilização de recursos (insumos), fases do processo, e para o controlo das actividades de gestão da área protegida.'
    ],

    'ResponsablesInterviewers' => [
        'title' => 'Responsibilide pelo preenchimento do formulário: Equipa de Gestão e Parceiros',
        'fields' => [
            'Name' => 'Nome',
            'Institution' => 'Organizaçao',
            'Function' => 'Função',
            'Contacts' => 'Detalhes de contacto',
            'EncodingDate' => 'Data de compilação',
            'EncodingDuration' => 'Tempo levado para a avaliação (horas)'
        ]
    ],

    'ResponsablesInterviewees' => [
        'title' => 'Responsibilidade pelo Preenchimento do formulário: Apoio externo para a analise e avaliacao da gestao',
        'fields' => [
            'Name' => 'Nome',
            'Institution' => 'organização',
            'Function' => 'Função',
            'Contacts' => 'Detalhes de contacto',
            'EncodingDate' => 'Data de compilação',
            'EncodingDuration' => 'Tempo levado para a Avaliação (horas)',
        ]
    ],

    'GeneralInfo' => [
        'title' => 'Dados Básicos',
        'fields' => [
            'CompleteName' => 'Nome completo da área protegida',
            'CompleteNameWDPA' => 'Nome pelo qual a área protegida é referida',
            'WDPA' => 'Nome da área protegida no sítio da WDPA',
            'UsedName' => 'Código do sítio WDPA (a partir dos códigos em www.unep-wcmc.org/wdpa/)',
            'Type' => 'tipologia',
            'NationalCategory' => 'Categoria Nacional',
            'IUCNCategory1' => '1ª categoria da UICN',
            'IUCNCategory2' => '2ª categoria da UICN',
            'IUCNCategory3' => '3ª categoria da UICN',
            'Country' => 'País',
            'CreationYear' => 'Ano de Criacao',
            'Institution' => 'Instituição(ões) supervisora(s)',
            'Biome' => 'Bioma',
            'Ecoregions' => 'ecorregião(ões) de referência [Ecoregiões G200, Olson, WWF; Spalding M. et alt. 2007]',
            'Ecotype' => 'Ecotipos (até três elementos que descem pela predominância)',
            'ReferenceText' => 'Referência à designação do texto de declaração',
            'ReferenceTextDocument' => '',
            'ReferenceTextValues' => 'Qual é a importância da área protegida e dos seus principais valores para os quais foi designada? (Fornecer uma lista e depois uma breve descrição).',
        ],
        'IUCN Categories' => 'Categoria (s) da UICN  (áreas protegidas com mais classificacoes para o zoneamento interno)',
    ],

    'Governance' => [
        'title' => 'Governancao e parcerias',
        'fields' => [
            'Partner' => 'Lista a suas parcerias (caso existam)',
            'InstitutionType' => 'Tipo de Organização',
            'PartnershipsType1' => 'A parceria mais importante: primeira',
            'PartnershipsType2' => 'segunda',
            'PartnershipsType3' => 'terceira',
            'Type' => 'Modelo de Governação',
            'Comments' => 'Informação adicional sobre o modelo de governação (se necessário)',
        ],
        'governance' => 'Governação',
        'partnership' => 'Parceria ',
    ],

    'SpecialStatus' => [
        'title' => 'Denominações especiais (Património Mundial, MAB, sítio Ramsar, IBAs, SPAMI, LMMA, etc.)',
        'fields' => [
            'Designation' => 'Designação',
            'RegistrationDate' => 'Dada de registo',
            'Code' => 'Código',
            'Area' => 'Area (ha)',
            'DesignationCriteria' => 'Critéria para designação',
            'upload' => 'carregamento',
        ],
        'groups' => [
            'conventions' => 'Designação (inclusoes) nas listas das convencoes internacionais (World Heritage, RAMSAR, etc.)',
            'networks' => 'Membro de uma rede internacional reconhecida (MAB, RAPAC etc.)',
            'conservation' => 'Designação para o estado da importancia da conservação pelos organismos internacionais (IBA, AZE, etc.)',
            'marine_pa' => 'Designação das áreas protegidas marinhas',
        ]
    ],

    'Networks' => [
        'title' => 'Membro da rede de gestão local',
        'fields' => [
            'NetworkName' => 'Nome',
            'ProtectedAreas' => 'Nomes de outras areas protegidas dentro da rede',
        ],
        'groups' => [
            'group0' => 'Rede Transfronteiricas',
            'group1' => 'Rede paisagistica (áreas protegidas terrestres e marinhas) - Rede (rede marinha)',
            'group2' => 'Outras redes',
        ]
    ],

    'Missions' => [
        'title' => 'Visao - Missao - objectivos',
        'fields' => [
            'LocalVision' => 'Visao ao nivel local ou nacional',
            'LocalMission' => 'Missão',
            'LocalObjective' => 'objectivos',
            'LocalSource' => 'Fonte',
            'LocalManagementPlan' => 'Arquivo (Plano de Gestão)',
            'InternationalVision' => 'Visao ao nivel internacional',
            'InternationalMission' => 'Missão',
            'InternationalObjective' => 'Objectivos',
            'InternationalSource' => 'Fonte',
            'InternationalManagementPlan' => 'Arquivo (Plano de Gestão)',
            'Observation' => 'Observação',
        ]
    ],

    'Contexts' => [
        'title' => 'Referências de contextos históricos, políticos, jurídicos, institucionais e socioeconómicos da área protegida',
        'fields' => [
            'Context' => 'Congtexto especificos ou elementos',
            'file' => 'Arquivo(s)',
            'Summary' => 'Sumário',
            'Source' => 'Fonte',
            'Observations' => 'Observacoes',
        ],
        'predefined_values' => [
            'Contexto histórico',
            'Contexto sócio-económico',
            'Contexto político (país)',
            'Contexto legal',
            'Contexto institucional'
        ],
        'module_info' => 'Dados ao nivel nacional com verifição ao nivel local'
    ],

    'GeographicalLocation' => [
        'title' => 'Localização',
        'fields' => [
            'LimitsExist' => 'Existência de limites oficiais georeferenciados (sim/não)',
            'Shapefile' => 'Arquivo GIS',
            'Source SHP' => 'Fonte do Arquivo GIS',
            'Coordinates' => 'Coordenadas Geográficas (dados de base para ou ponto chave do parque)',
            'Source Coords' => 'Fonte',
            'Administrative Location' => 'Localização Administrativa da localização da área protegida (província, região, etc.)',
        ]
    ],

    'Areas' => [
        'title' => 'Superficie da área protegida e contexto de conservação',
        'fields' => [
            'BoundaryLength' => 'Comprimento dos limites',
            'Administrative Area' => 'Superficie Administrativa',
            'WDPAArea' => 'Superficie de acordo com a WDPA',
            'GISArea' => 'Superficie Actual (GIS para o parque ou autoridade responsável para a área protegida) correspondente ao carregamento dos arquivos',
            'Terrestrial Area' => 'area protegidas mistas (terrestres e marinhas) = Terrestres (a zona costeira deverá ser incluida na area protegida terrestre)',
            'Marine Area' => 'área protegidas mistas: area marinha',
            'PercentageNationalNetwork' => '% da Superficie da rede nacional de áreas protegidas',
            'PercentageEcoregion' => '% da Superficie da ecoregião',
            'PercentageTransnationalNetwork' => ' % da superficie da rede transfronteiriça',
            'PercentageLandscapeNetwork' => '% da Superficie da paisagens/rede',
            'Index' => 'Índice de configuração <br />&radic;(3.14)/(6.28)*perímetro/&radic;(área) =<br /> bom 1 - 1.5; média 1.5 - 2; baixo > 2',
            'Observations' => 'Observaçoes',
        ]
    ],

    'Sectors' => [
        'title' => 'Dominação da área dos sectores da área protegida',
        'fields' => [
            'Name' => 'Sector',
            'UnderControlArea' => 'Km² sob protecção',
            'UnderControlPatrolKm' => 'Km de patrulhas',
            'UnderControlPatrolManDay' => 'Fiscal * dia de patrulha',
            'SectorMap' => 'Mapas de zoneamento',
            'Source' => 'Fonte',
            'Observations' => 'Observacoes',
        ],
        'area_percentage' => '% da area',
        'average_time' => 'Média do fiscal * d * km² da área total',
        'sum_error' => 'A área total sob proteccao deverá corresponder a area especificada no modúlo <b>CTX 2.2</b>'
    ],

    'TerritorialReferenceContext' => [
        'title' => 'Contexto territorial de base da área protegida',
        'fields' => [
            'Reference Ecosystem Area Estimation' => 'A) Área funcional do ecossistema.Estimativar da área funcional do ecossistema: área importante para a manutenção dos serviços ecossistémicos prestados pela área protegida: a) em Km² e b) como largura da faixa exterior.',
            'Reference Ecosystem Area Population' => 'Estimativa da dimensão da população local que vive dentro da área funcional do ecossistema',
            'Ecological Aspects' => 'Estimativa da presença de factores ambientais, por exemplo, área de distribuição de gamas domésticas de espécies emblemáticas (em km2) (Km2)',
            'Functional Area' => 'B) Area que beneficia os servicos ecossistémicos da área protegida. Zona de influência socioeconómica da área protegida: Área não habitada em redor da área protegida que beneficia dos serviços ecossistémicos prestados pela área protegida: a) em km² e b) como largura da faixa exterior',
            'Functional Area Population' => 'Estimativa da dimensão da população local que vive dentro da zona socioeconómica de influência',
            'SocioEconomic Aspects' => 'Listar e descrever os factores socioeconómicos e administrativos (por exemplo, papéis tradicionais ou modernos sobre os recursos naturais estabelecidos pelas autoridades tradicionais e modernas) que influenciam a gestão da área protegida',
            'Spill Over Effect' => 'C) Zona de derrame. Estimar os efeitos de derrame na área marinha protegida, ou seja, a dimensão da área crucial para manter o fornecimento de serviços ecossistémicos (pesca) prestados pela área protegida: a) em km² e b) como largura da faixa exterior',
            'NoTake Area' => 'será a área funcional do ecossistema correspondente a área de proibição de colecta de recursos?',
        ],
        'categories' => [
            'FunctionalEcosystemArea' => 'Área Funcional de ecossistema',
            'BenefitsOfEcosystemServicesArea' => 'Area que beneficia dos servicos ecossistémicos da área protegida',
            'SpillOverArea' => 'Area dos efeitos de derrame',
        ]
    ],

    'ManagementStaff' => [
        'title' => 'Tamanho e composição do pessoal: Pessoal da área protegida',
        'fields' => [
            'Function' => 'Funcoes',
            'ExpectedPermanent' => 'Pessoal planeado ou adequado*',
            'ActualPermanent' => 'Efectivos actuais do pessoal',
            'Observations' => 'Observacoes',
            'Source' => 'Fonte',
        ],
        'module_info' => 'O sistema estatistico permite somente catorze linhas para identificar as funcoes do pessoal da área protegida'
    ],

    'ManagementStaffPartners' => [
        'title' => 'Tamanho e composição do pessoal: Pessoal de organizações parceiras',
        'fields' => [
            'Partner' => 'Parceiros',
            'Coordinators' => 'Coordenadores (número)',
            'Technicians' => 'Pessoa Técnico e Administrativo (número)',
            'Auxiliaries' => 'pessoal Auxiliar (número)',
        ]
    ],

    'ManagementStaffCommunities' => [
        'title' => 'Tamanho e composição do pessoal: Pessoal das Comunidades',
        'fields' => [
            'Community' => 'Communidade',
            'Role1' => 'Papel',
            'StaffNUmberRole1' => 'número',
            'Role2' => 'Papel',
            'StaffNUmberRole2' => 'número',
            'Role3' => 'Papel',
            'StaffNUmberRole3' => 'número',
        ]
    ],

    'FinancialResources' => [
        'title' => 'Recursos financeiros: Orçamento e custos de gestão',
        'fields' => [
            'Currency' => 'Moeda',
            'ReferenceYear' => 'Ano de Referencia',
            'Management Financial Plan Costs' => 'Custo operacional estimado no plano de gestão/plano financeiro ($ ou EUR/ano)',
            'OperationalWorkPlanCosts' => 'Custos de funcionamento estimados a partir do plano operacional/plano de trabalho (orçamentados anualmente)',
            'Total Budget' => 'orçamento anual total disponível',
        ],
        'amount' => 'Total',
        'functioning_costs' => 'Custos de Funcionamento ($ ou €/km2/year)',
        'estimation_financial_plan' => '% de recursos exigidos pelo plano financeiro/plano de trabalho (orçamentados anualmente)',
        'estimation_operational_plan' => '% dos recursos exigidos pelo plano de trabalho (orçamentados anualmente)',
        'module_info' => 'Custos totais estimados no plano de gestao/Financeiro'
    ],

    'FinancialAvailableResources' => [
        'title' => 'Recursos financeiros: Orçamento disponível',
        'fields' => [
            'BudgetType' => '',
            'National Budget' => 'Orçamento nacional',
            'OwnRevenues' => 'Receitas provenientes das operações da área protegida',
            'Disputes' => 'Rendimento do litígio/multas (tesouro nacional)',
            'Partners' => 'Contribuições dos parceiros',
            'total' => 'total',
            'percentage' => '% do orçamento previsto',
        ],
        "predefined_values" => [
            "Orçamento anual total disponível",
            "Orçamento total anual disponível para o funcionamento",
            "Orçamento total anual disponível para investimentos"
        ],
        'module_info' => 'O total deve corresponder ao orçamento total declarado no módulo <b>CTX 3.2.1</b>',
        'sum_error' => 'O total deve corresponder ao orçamento total declarado no módulo <b>CTX 3.2.1</b>'
    ],

    'FinancialResourcesBudgetLines' => [
        'title' => 'Recursos financeiros: Rubricas orçamentais do plano operacional/plano de trabalho (orçamentadas anualmente)',
        'fields' => [
            'Line' => 'Rubricas orçamentais',
            'Amount' => 'Montante ($ ou EUR/ano)',
            'BudgetSource' => 'Fonte da fundação',
            'function_costs' => 'Custos de funcionamento ($ ou EUR/Km²/ano)',
            'percentage' => '% do orçamento disponível',
        ],
        'module_info' => 'Valores na mesma moeda especificada em  <b>CTX 3.2.1</b>',
        'sum_error' => 'O total deve corresponder ao orçamento total declarado no módulo <b>CTX 3.2.1</b>'
    ],

    'FinancialResourcesPartners' => [
        'title' => 'O papel dos parceiros no apoio à área protegida',
        'fields' => [
            'Partner' => 'Parceiros',
            'Funding' => 'Apoios (financiamento/projecto/actividades)',
            'Contribution' => 'Montante ($ or € / year)',
            'StartDate' => 'Inicio',
            'EndDate' => 'Data de previsão de fim',
            'Observations' => 'Observacoes',
            'Currency' => 'Moeda',
        ],
        'module_info' => 'Montante na mesma moeda especificada em <b>CTX 3.2.1</b>'
    ],

    'Equipments' => [
        'title' => 'Disponibilidade de infra-estruturas, equipamento e instalações',
        'fields' => [
            'Resource' => 'categoria',
            'Adequacy Level' => 'adequação',
            'Comments' => 'Fonte/Observação'
        ],
        'groups' => [
            'group0' => 'Edifícios administrativos',
            'group1' => 'Alojamento',
            'group2' => 'Instalações turísticas',
            'group3' => 'Meios de transporte',
            'group4' => 'Equipamento de combate a anti-caça furtiva',
            'group5' => 'Meios de communicação',
            'group6' => 'IT',
            'group7' => 'Equipamento de produção de água/electricidade para serviços',
            'group8' => 'Equipamento de manutenção para (ver categorias)',
            'group9' => 'Estradas e pistas',
            'group10' => 'Vias navegáveis',
            'group11' => 'Pistas de Aterragem',
            'group12' => 'Ligações e conexigações da área protegida com o mundo exterior'
        ],
        'predefined_values' => [
            'group0' => ['Escritórios', 'Postos de Patrulha', 'Pontos de barreira', 'Edifícios científicos', 'Garagem e oficina', 'Diversos (revista, rádio, etc.)', 'Centro de cuidados de saúde'],
            'group1' => ['Para os oficiais e seus adjuntos', 'Para o pessoal de fiscalização', 'Para o pessoal de apoio'],
            'group2' => ['Hotéis (capacidade para hospedes)', 'Eco-lodges (capacidade para hóspedes)', 'Acampamentos (capacidade para hóspedes)', 'Instalações de acolhimento para turistas', 'Pontos de visualizacao ou pontos de observação', 'Rotas turísticas disponíveis (km)'],
            'group3' => ['Carros', 'Motociclos/Quadros', 'Bicicletas', 'Barcos', 'Pirogues', 'Aeroplano, microlight', 'Motores pesados'],
            'group4' => ['armas', 'Cartuchos', 'Uniformes', 'Racoes (per diem)', 'GPS, bússulas', 'Equipamento de  campismo'],
            'group5' => ['Radios VHF/HF', 'V-SAT', 'Telefones fixos', 'Telefones GSM', 'Telefones Satelite', 'Conexão de Internet'],
            'group6' => ['Computadores de Secretária', 'Impressoras', 'Fotocopiadoras', 'Computadores portáteis'],
            'group7' => ['Geradores de energia', 'Instalação eléctrica solar', 'Instalação eléctrica hidroeléctrica', 'Instalação eléctrica eólica', 'Abastecimento de água'],
            'group8' => ['Veiculos/barcos', 'Radios', 'Edificios', 'Rede eléctrica', 'Rede hidraulica', 'motores pesados'],
            'group9' => ['Estradas/carreiros dentro da área protegida', 'Atalhos dentro da área protegida', 'Estrada ao longo da fronteira'],
            'group10' => ['Vias navegáveis dentro da área protegida'],
            'group11' => ['Pista de Aterragem Tiras à primeira vista dentro e/ou fora da área protegida'],
            'group12' => ['Principais vias de comunicação terrestres', 'Vias navegáveis interiores e marítimas', 'Ligações aéreas nacionais e internacionais']
        ],
        'ratingLegend' => [
            'AdequacyLevel' => [
                '0' => 'Fully inadequate (0-30% das necessidades)',
                '1' => 'Somewhat inadequate (31-60% das necessidades)',
                '2' => 'Adequate (61-90% das necessidades)',
                '3' => 'Fully adequate (91-100% das necessidades)',
            ]
        ]
    ],

    'AnimalSpecies' => [
        'title' => 'Espécies animais (emblemáticas, ameaçadas, endémicas, exploradas, invasivas, etc.) utilizadas como indicadores do estado da área protegida e que requerem monitorização ao longo do tempo',
        'fields' => [
            'SpeciesID' => 'Espécies',
            'FlagshipSpecies' => 'EE',
            'EndangeredSpecies' => 'EP',
            'EndemicSpecies' => 'EED',
            'ExploitedSpecies' => 'EXP',
            'InvasiveSpecies' => 'INV',
            'InsufficientDataSpecies' => 'EBC',
            'PopulationEstimation' => 'Estado actual estimado',
            'DesiredPopulation' => 'Situacao de conservação favorável',
            'TrendRating' => 'Tendencia',
            'Reliability' => 'Confiabilidade',
            'Comments' => 'Fonte/Observação',
        ],
        'module_info' => 'Estado de conservação favorável: A partir de Natura 2000, o estado de conservação das espécies será considerado "favorável" quando:<ul> os dados sobre a dinâmica populacional das espécies em causa indicam que se mantém a longo prazo como uma componente viável dos seus habitats naturais, e<li> a área variedade natural de distribuição da espécie não está a ser reduzida nem será provavelmente reduzida num futuro previsível, e existe, e provavelmente continuará a existir, um habitat suficientemente grande para manter as suas populações a longo prazo</li></ul> Classificação: Avaliar a partir da lista de espécies que se supõe existirem (ver as listas da IUCN de A - mamiferos, B -_ aves e C - anfibios), um número limitado de espécies chave da área protegida. <br /> <b>Espécies indicadoras</b> <ul> <li><b>EE</b>: Espécies emblemáticas</li> <li><b>EP</b>: especies em perigo (Ameaçadas)</li> <li><b>EED</b>: Espécies Endémicas </li> <li><b>EXP</b>: Espécies exploradas</li> <li><b>INV</b>: Espécies invasoras</li> <li><b>EBC</b>: Espécie com baixo nível de conhecimento</li></ul> <b>Estimativa da população</b>: Programa de monitorização ecológica e geração de gráfico de tendências plurianuais.',
        'validation_min3' => 'Please encode not less than 3 key species',
        'warning_on_save' =>
            'Qualquer <br/> modificação pode causar perda de dados no seguinte
            módulos de avaliação (se já codificados): <br /> <i>C1.2</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'VegetalSpecies' => [
        'title' => 'Espécies de plantas (emblemáticas, ameaçadas, endémicas, exploradas, invasorasivas, etc.) utilizadas como indicadores do estado da área protegida e que requerem monitorização ao longo do tempo',
        'fields' => [
            'Species' => 'Espécies',
            'FlagshipSpecies' => 'EE',
            'EndangeredSpecies' => 'EP',
            'EndemicSpecies' => 'EED',
            'ExploitedSpecies' => 'EXP',
            'InvasiveSpecies' => 'INV',
            'InsufficientDataSpecies' => 'INS',
            'PopulationEstimation' => 'Estado actual estimado',
            'DesiredPopulation' => 'Estado de conservação favorável',
            'TrendRating' => 'Tendencias',
            'Reliability' => 'confiabilidade',
            'Comments' => 'Fonte/Observação',
        ],
        'module_info' => 'Estado de conservação favorável:<br /> A partir de Natura 2000, o estado de conservação das espécies será considerado "favorável" quando:<ul><li> os dados sobre a dinâmica populacional das espécies em causa indicam que se mantém a longo prazo como uma componente viável dos seus habitats naturais, e </li><li>a área variedade natural de distribuição das espécies não está a ser reduzida nem será provavelmente reduzida num futuro previsível, e existe, e provavelmente continuará a existir, um habitat suficientemente grande para manter as suas populações a longo prazo</li></ul> Classificação: Avaliar, a partir da lista de plantas que se supõe existirem (ver as listas disponíveis e informações do parque), um número limitado de plantas-chave da área protegida<br /> <b>Indicadores das espécies</b> <ul> <li><b>EE</b>: Espécies emblemáticas  </li> <li><b>EP</b>:Espécies em perigo (ameaçadas) </li> <li><b>EED</b>: Espécies Endémicas</li> <li><b> EXP</b>: Espécies exploradas</li> <li><b> INV</b>: Espécies Invasoras</li> <li><b> INS</b>: Espécie com baixo nível de conhecimento</li> </ul> <br/><b> EB Estimativa da população</b>: Programa de monitorização ecológica e geração de gráfico de tendências plurianuais.<br /> <b>Fiabilidade da informacao</b>: <ul><li>1 Baixa</li> <li>2: Media</li><li> 3: alta</li></ul>',
        'warning_on_save' =>
            'Qualquer <br/> modificação pode causar perda de dados no seguinte
            módulos de avaliação (se já codificados): <br /> <i>C1.2</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'Habitats' => [
        'title' => 'Ecossistema, habitats, ocupação do solo - utilização do solo - seleccionados como indicadores para a área protegida e que terão de ser monitorizados ao longo do tempo',
        'fields' => [
            'EcosystemType' => 'Tipo de ecosistema ou habitat',
            'Value' => 'Descricao do estado ou valor',
            'Area' => 'Superficie da area (ha)',
            'DesiredConservationStatus' => 'Estado de conservação favorável',
            'Trend' => 'Tendencias',
            'Reliability' => 'Fiabilidade da informação',
            'Sectors' => 'sectores',
            'Comments' => 'Commentários/Fonte'
        ],
        'module_info' => 'Nota: Estado de conservação favorável:<br />A partir de Natura 2000, o estado de conservação de um habitat natural será considerado "favorável" quando:<ul><li>a sua área de distribuição alcance natural e as áreas que cobre dentro dessa área alcance são estáveis ou estão a aumentar e</li><li>a estrutura e funções específicas que são necessárias para a sua manutenção a longo prazo existem e são susceptíveis de continuar a existir num futuro previsível</li></ul>Classificação: Seleccionar e avaliar os parâmetros mais importantes dos ecossistemas e habitats terrestres e de água doce e habitats da área protegida.<br /> <b>Note</b>:A avaliação do habitat ainda está a emergir como disciplina, uma vez que é altamente complexa. A classificação prevê a seguinte divisão de território: Bioma, Ecorregião, Ecossistema, Habitat. As características/valores do habitat podem ser avaliados como:<ul> <li>i) sob ameaça de extinção (dentro da sua área de distribuição,</li> <li>ii) ter área distribuição um alcance natural reduzida,</li> <li>iii) em declíneo,</li> <li>iv) um exemplo notável de características específicas, etc.</li> </ul> A avaliação de habitats também pode ser realizada na perspectiva de:<ul> <li>i) reproduccao,</li> <li>ii) nutricao,</li> <li>iii) protecção de espécies, etc.</li> </ul> <br /> <b>Fiabilidade da informacao</b> <ul> <li>1: Baixa<li>2: Media<li>3: Alta</li> </ul>',
        'warning_on_save' =>
            'Qualquer <br/> modificação pode causar perda de dados no seguinte
            módulos de avaliação (se já codificados): <br /> <i>C1.3</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'HabitatsMarine' => [
        'title' => 'Presença, extensão e distribuição dos principais habitats marinhos',
        'fields' => [
            'HabitatType' => 'Habitats and stratus',
            'Presence' => 'Presença',
            'Area' => 'Extencao do habitat (estimado, em ha)',
            'Fragmentation' => 'Fragmentação do habitat',
            'Source' => 'Fonte',
            'Description' => 'Descrição',
        ],
        'predefined_values' => [
            'Mangais',
            'Algas marinhas',
            'Recifes de Coral',
            'Pântanos de maré, pântanos costeiros',
            'Ecossistema de águas marinhas costeiras',
            'Estrato pelágico',
            'Estrato de Abyssal',
            'Estrato bentónico',
            'Mar aberto'
        ],
        'module_info' => '<i><span style="cor: Azul;">Indicateur</span></i>: Habitat marinho com caracteristicas importantes e significativas da área protegida, Cobertura da Terra e ocupacao<br /> <i><span style="cor:Azul;">Sous indicateur</span></i>: <b><span style="font-style: normal;">Presenca, extencao e distribuicao de habitats marinhos chave</span></b>'
    ],

    'LandCover' => [
        'title' => 'Manutenção da cobertura do solo - utilização do solo (ou terreno físico - floresta, água, estradas, etc.) [para valores agregados ver ponto CTX 2.2]',
        'fields' => [
            'CoverType' => 'cobertura do solo - categorias de utilização do solo',
            'HistoricalArea' => 'superficie (ha)',
            'ConservationStatusArea' => 'Estado de conservação favorável (ha)',
            'Notes' => 'Fonte / Observação',
            'HistoricalAreaData' => 'Dado de referencia',
        ],
        'module_info' => 'Rating: Avaliacao dos elementos mais importantes  cobertura do solo - utilização do solo para a gestao da area protegida<br /> cobertura do solo - categorias de utilização do solo(exemple: floresta, savana, água, /plantacoes, moradias, Estradas, etc.)',
        'warning_on_save' =>
            'Qualquer <br/> modificação pode causar perda de dados no seguinte
            módulos de avaliação (se já codificados): <br /> <i>C1.3</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'MenacesPressions' => [
        'title' => 'Pressoes sobre e ameaças',
        'fields' => [
            'Value' => 'Valores',
            'Impact' => 'Impacto/ Severidade',
            'Extension' => 'Escala/ Extenção',
            'Duration' => 'Quanto tempo/ Irreversibilidade',
            'Trend' => 'Tendencias',
            'Probability' => 'Probabilidade para ameacas no futuro',
        ],
        'groups' => [
            'group0' => 'Comercial e residencial',
            'group1' => 'Culturas anuais ou plurianuais (não madeireiro)',
            'group2' => 'Plantações para madeira e Polpa de madeira',
            'group3' => 'Pequenos e grandes criadores de animais domésticos',
            'group4' => 'Aquacultura marinha e de água doce',
            'group5' => 'Outra tipologia de produção',
            'group6' => 'Energia e minas',
            'group7' => 'Transportes e infra-estruturas',
            'group8' => 'Caça e colectaheita de animais terrestres',
            'group9' => 'Recolha e colheita de plantas terrestres',
            'group10' => 'Silvicultura e extracção de madeira',
            'group11' => 'Pesca e colecta de recursos aquáticos',
            'group12' => 'Disturbios Humanos/Perturbação/intrusão',
            'group13' => 'Incêndios na natureza (fogos)',
            'group14' => 'Barragens e gestão ou utilização de água',
            'group15' => 'Outras mudanças no ecossistema',
            'group16' => 'Espécies invasoras/problemáticas',
            'group17' => 'Águas residuais domésticas e urbanas',
            'group18' => 'Afluentes Industriais e militares',
            'group19' => 'Afluentes agrícolas e florestais',
            'group20' => 'Lixo e resíduos sólidos',
            'group21' => 'Poluição atmosférica',
            'group22' => 'Uso excessivo de energia',
            'group23' => 'Fenómenos geológicos',
            'group24' => 'Alterações climáticas e fenómenos',
            'group25' => 'Outras pressões e ameaças'
        ],
        'predefined_values' => [
            'group0' => [
                'Áreas urbanas e residenciais',
                'Áreas comerciais',
                'Áreas turísticas e recreativas',
                'Áreas de enclave'],
            'group1' => [
                'Agricultura itinerante',
                'Pequenos Agricultores',
                'Grandes empresas agro-industriais',
                'Produção de frutas/vegetais de jardim'],
            'group2' => [
                'Pequenas plantações',
                'Plantações agro-industriais'],
            'group3' => [
                'Pastoreio nómada',
                'Criação de gado e pastoreio em pequenas explorações',
                'Pecuária agro-industrial e pastoreio'],
            'group4' => [
                'Aquacultura de subsistência ou artesanal',
                'Aquacultura industrial'],
            'group6' => [
                'Perfuração (gás e petróleo)',
                'Operações mineiras ou de pedreiras',
                'Energias renováveis'],
            'group7' => [
                'Estradas',
                'Redes e linhas de utilidade e comunicação (electricidade, telefone, aqueduto, etc.)',
                'Vias navegáveis marítimas e vias navegáveis para Navios',
                'Corredores aéreos',
                'Caminhos-de-ferro'],
            'group8' => [
                'Caça de animais terrestres',
                'Colheita de animais vivos'],
            'group9' => [
                'Recolha de plantas',
                'Colheita de plantas'],
            'group10' => [
                'Operações de madeireiras em pequena escala',
                'Operações de combustível lenhoso em grande escala',
                'Operações de madeira combustível lenhoso em pequena escala',
                'Operações de madeireira em grande escala',
                'Sarrafos/postes para construção'],
            'group11' => [
                'Pesca de subsistência ou em pequena escala',
                'Pesca emm grande escala',
                'Colheita em pequena escala ou de subsistência dos recursos aquáticos',
                'Colheita em grande escala dos recursos aquáticos',
                'Colheita de marisco'],
            'group12' => [
                'Actividades recreativas',
                'Guerras, tumultos civis e exercícios militares',
                'Obras e outras actividades'],
            'group13' => [
                'Frequência e intensidade dos incêndios'],
            'group14' => [
                'Captação de águas superficiais (uso doméstico)',
                'Captação de águas superficiais (uso comercial)',
                'Captação de águas superficiais (uso agrícola)',
                'Captação de águas superficiais (utilização desconhecida)',
                'Captação de água subterrânea (uso doméstico)',
                'Captação de água subterrânea (uso comercial)',
                'Captação de água subterrânea (uso agrícola)',
                'Captação de água subterrânea (utilização desconhecida)',
                'Pequenas barragens',
                'Grandes barragens',
                'Barragens (tamanho desconhecido)'],
            'group16' => [
                'Espécies invasoras ou doenças introduzidas',
                'Espécies problemáticas ou doenças indígenas problemáticas',
                'Espécies problemáticas ou doenças de origem desconhecida',
                'Material genético introduzido',
                'Doenças virais ou priónicas',
                'Doença de causa desconhecida'],
            'group17' => [
                'Águas residuais e esgotos',],
            'group18' => [
                'Mancha de óleo',
                'Vazamentos nas minas'],
            'group19' => [
                'Carga nutritiva',
                'Erosão do solo e sedimentação',
                'Herbicidas e pesticidas'],
            'group20' => [
                'Resíduos municipais',
                'Lixo de automóveis/destroços & lixo de barcos de recreio',
                'Lixo de construção',
                'Resíduos que entrelaçam a vida selvagem'],
            'group21' => [
                'Chuva ácida',
                'Nuvem de poluição',
                'Ozono'],
            'group22' => [
                'Poluição luminosa',
                'Poluição pelo calor',
                'Poluição sonora'],
            'group23' => [
                'Vulcões',
                'Terramotos e tsunamis',
                'Avalanches e desabamentos de terras'],
            'group24' => [
                'Danos e alterações no habitat',
                'Secas',
                'Temperaturas extremas',
                'Tempestades e cheias',
                'Other: Outros: Aumento da precipitação e mudanças sazonais'],
            'group25' => [
                'Conflito Homem Fauna Selvagem'
            ]
        ],
        'categories' => [
            'title1' => 'Comercial e residencial',
            'title2' => 'Agricultura e aquacultura',
            'title3' => 'Energia e Minas',
            'title4' => 'Transporte e infra-structuras',
            'title5' => 'Utilização de recursos biológicos',
            'title6' => 'Intrusão Humana & distúrbios',
            'title7' => 'Mudanças no sistema natural',
            'title8' => 'Espécies invasoras/problemáticas',
            'title9' => 'Poluicao',
            'title10' => 'Fenómenos geológicos',
            'title11' => 'Alterações climáticas e fenómenos',
            'title12' => 'Outras pressões e ameaças'
        ],
        'ratingLegend' => [
            'Impact' => [
                '0' => 'Médio',
                '1' => 'Moderado',
                '2' => 'Alto',
                '3' => 'Severo',
            ],
            'Extension' => [
                '0' => 'Localizado <5%',
                '1' => 'Com espacamento 5-15%',
                '2' => 'Largamente disperso 15-50%',
                '3' => 'Todo o lugar >50%',
            ],
            'Duration' => [
                '0' => 'Curto prazo < 5 ans',
                '1' => 'Medio termo 5-20 ans',
                '2' => 'Longo termo 20-100 ans',
                '3' => 'Permanente >100 ans',
            ],
            'Trend' => [
                '-2' => 'Decrescendo',
                '-1' => 'Decrescendo ligeiramente',
                '0' => 'Sem mudança',
                '1' => 'Aumento ligeiramente',
                '2' => 'Aumentando',
            ],
            'Probability' => [
                '0' => 'Muito baixa',
                '1' => 'Baixa',
                '2' => 'Médiana',
                '3' => 'Alta',
            ],
        ],
        'module_info' => 'A calculadora de ameaças é utilizada para calcular o impacto das ameaças numa área protegida específica. Usando o seu melhor julgamento profissional, avalia o impacto da ameaça explorando cinco categorias de pontuação: (1) Impacto/ Gravidade; (2) Escala/ Extensão; (3) Quanto tempo/ Irreversibilidade; (4) Tendência; (5) Probabilidade para a ameaça no futuro',
        'warning_on_save' =>
            'Qualquer <br/> modificação pode causar perda de dados no seguinte
            módulos de avaliação (se já codificados): <br /> <i>C3</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'ClimateChange' => [
        'title' => 'Alterações climáticas e conservação/elementos-chave afectados pelas alterações climáticas',
        'fields' => [
            'Value' => 'Elementos Chave',
            'Description' => 'Descricao dos efeitos das alteracoes climáticas ',
            'Trend' => 'Efeeitos das alterações climáticas',
            'Notes' => 'Observações',
        ],
        'groups' => [
            'group0' => 'Especies animais afectadas pelas alterações climáticas',
            'group1' => 'Especies de Plantas afectadas pelas alterações climáticas',
            'group2' => 'Habitats afectados pelas alterações climáticas',
            'group3' => 'Servicos Ecosystémicos afectados pelas alterações climáticas',
            'group4' => 'Valores e importancia afectadas pelas alterações climáticas',
            'group5' => 'Outros',
        ],
        'module_info' => 'Os produtos das seguintes secções irao apoiando decisoes de gestao para assegurar que as areas protegidas adopte medidas para minimizar os efeitos das alteracoes climáticas. A análise garantirá que a incorporacao dos valores relevantes no sistema de gestao das áreas protegidas',
        'ratingLegend' => [
            'Trend' => [
                '0' => 'Altamente afectado pelas alterações climáticas',
                '1' => 'Moderadamente afectado pelas alterações climáticas',
                '2' => 'Pouco afectadas pelas alterações climáticas',
                '3' => 'Nao afectado pelas alterações climáticas',
            ]
        ],
        'warning_on_save' =>
            'Qualquer <br/> modificação pode causar perda de dados no seguinte
            módulos de avaliação (se já codificados): <br /> <i>C1.4</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'EcosystemServices' => [
        'title' => 'Serviços Ecossistémicos - importância, dependência das comunidades e tendencias',
        'fields' => [
            'Element' => 'Servicos Ecossistémicos',
            'Importance' => 'Importancia',
            'ImportanceRegional' => 'Communidade/sociedade dependencia',
            'ImportanceGlobal' => 'Tendencia',
            'Observations' => 'Descrição/Condição',
        ],
        'groups' => [
            'group0' => 'Nutricao',
            'group1' => 'Materiais',
            'group2' => 'Energia',
            'group3' => 'Remediação de materiais residuais, substâncias tóxicas e outras poluições',
            'group4' => 'Remediação de fluxos',
            'group5' => 'Interacções físicas e experiência',
            'group6' => 'Interacções e desempenhos intelectuais',
            'group7' => 'Espiritual e/ou emblemático',
            'group8' => 'Outros serviços culturais do ecossistema',
            'group9' => 'Serviços de apoio',
        ],
        'predefined_values' => [
            'group0' => ['Abastecimento de água - ilegal', 'Abastecimento de água - legal', 'Alimentação humana - vegetal (tubérculos, frutas, mel, cogumelos, algas marinhas, etc.) - ilegal', 'Alimentação humana - vegetal (tubérculos, frutas, mel, cogumelos, algas marinhas, etc.) - legal', 'Alimentação humanaHumano food - animal (carne selvagem/domésticae criação, frutos do mar, insectos) - ilegal', 'Alimentação humanaHumano food - animal (carne selvagem/domésticae criação, frutos do mar, insectos)- legal', 'Medicamentos e biotecnologia azul (óleo de peixe) - ilegal', 'Medicamentos e biotecnologia azul (óleo de peixe) - legal', 'Alimento para peixes/animais (selvagens, de criação, isco) - ilegal', 'Alimento para peixes/animais (selvagens, de criação, isco) - legal'],
            'group1' => ['Madeira de alto valor - ilegal', 'Madeira de alto valor - legal', 'Madeira para a construção local - ilegal', 'Madeira para a construção local - legal', 'Fibras de caule (palmeiras, kenaf, etc.) - ilegal', 'Fibras de caule (palmeiras, kenaf, etc.) - legal', 'Outras fibras (folhas, sumaúma, coco, etc.) - ilegal', 'Outras fibras (folhas, sumaúma, coco, etc.) - legal', 'Recursos ornamentais e aquários (colecção de sementes, conchas e peixes) - ilegal', 'Recursos ornamentais e aquários (coleção de sementes, conchas e peixes) - legal', 'Areia (construção) - ilegal', 'Areia (construção) - legal', 'Terras de cultivo (agricultura, pecuária, florestas) - ilegal', 'Terras de cultivo (agricultura, pecuária, florestas) - legal'],
            'group2' => ['Lenha e biocombustíveis - ilegal', 'Lenha e biocombustíveis - legal', 'Água para a energia - ilegal', 'Água para a energia - legal', 'Fertilizante - ilegal', 'Fertilizante - legal'],
            'group3' => ['Regulação de gás (C sequestro de C)', 'Enterro/remoção/neutralização de resíduos'],
            'group4' => ['Controlo das cheias', 'Controlo da Seca', 'Protecção contra tempestades', 'Controlo da erosão da água', 'Controlo da erosão Ecological', 'Prevenção da erosão costeira'],
            'group5' => ['Benefícios estéticos (integridade do ecossistema)', 'Ecoturismo e observação da natureza', 'Caminhadas, escaladas de montanhas e recreacao em geral', 'Mergulho com tubo de respiração, navegação e mergulho', 'Caça ou pesca, se for permitida', 'Pesca tradicional específica'],
            'group6' => ['Ciência - Investigação', 'Educação', 'Património cultural'],
            'group7' => ['Simbólico ou histórico', 'Sagrado ou religioso'],
            'group8' => ['conservacao ex situ'],
            'group9' => ['Produção primária líquida (vegetação)', 'Ciclagem de nutrientes (decomposição e mineralização do lixo)', 'Habitats importantes (nidificação de aves - desova junto ao mar - habitats viveiros)', 'Habitat de antigas espécies (por exemplo, corais)', 'Polinização (plantas)', 'ciclismo aquático', 'Paisagem marítima: heterogeneidade/complexidade de habitat (apoiando a diversidade)'],
        ],
        'categories' => [
            'title1' => 'Aprovisionamento',
            'title2' => 'Regulação',
            'title3' => 'Cultural',
            'title4' => 'Apoio',
        ],
        'module_info' => '<b>Serviços Ecossistémicos - importância, dependência das comunidades e tendência dos serviços ecossistémicos prestados pela área protegida </b> <ul> <li>The outputs from the following section will support management decisions to ensure that ecosystem services delivered by the protected area for the human well-being are preserved. The analysis will ensure incorporation of the relevant values into the management system of the protected area</li> <li>Classificação: Considere cada avaliação com base em: A) importância de serviços ecossistémicos específicos, B) dependência da população local em relação ao serviço ecossistémico e C) tendência na quantidade ou qualidade dos serviços ecossistémicos prestados pela área protegida, utilizando as escalas abaixo</li> <li>Não é necessária uma medição precisa do valor para atribuir uma classificação</li> <li>A especificação da natureza do aprovisionamento como legal ou ilegal depende da designação da área protegida e dos costumes legais existentes para a área avaliada</li> </ul>',
        'ratingLegend' => [
            'Importance' => [
                'Local' => 'importância limitada às comunidades locais ou regionais (por exemplo, tubérculos, frutas, lenha, etc.)',
                'Maior' => 'importância alargada aos intervenientes nacionais e mundiais (bacia hidrográfica, turismo, etc.)'
            ],
            'ImportanceRegional' => [
                '0' => 'Muito baixa',
                '1' => 'baixa',
                '2' => 'mediana',
                '3' => 'alta',
            ],
            'ImportanceGlobal' => [
                '-2' => 'decrescendo',
                '-1' => 'decrescendo ligeiramente',
                '0' => 'sem mudança',
                '1' => 'aumentando ligeiramente',
                '2' => 'aumentando'
            ]
        ],
        'warning_on_save' =>
            'Qualquer <br/> modificação pode causar perda de dados no seguinte
            módulos de avaliação (se já codificados): <br /> <i>C1.5</i>, <i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ]

];
