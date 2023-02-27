<?php
return [

    'id'                    => 'ID',
    'name'                  => 'nome',
    'year'                  => 'ano',
    'country'               => 'país',
    'language'              => 'língua',
    'version'            => 'versão',

    'staff' => [
        'first_name'            => 'primeiro nome',
        'last_name'             => 'sobrenome',
        'institution'           => 'instituição',
        'function'              => 'função',
        'confirm_user_info'         => 'Por favor, confirme as suas informações'
    ],

    'protected_area' => [
        'protected_area'    => 'zona protegida|áreas protegidas',
        'wdpa_id'           => 'WDPA id|WDPA ids',
        'iucn_category'     => 'Categoria UICN',
    ],

    'methodology'   => 'Questão de Avaliação',
    'criteria'      => 'Classificação',

    'terrestrial' => 'terrestre',
    'marine' => 'marítima e costeira',

    'dopa_not_available' => 'DOPA serviços não disponíveis',

    'languages' => [
        'fr'        => 'Francês',
        'en'        => 'Inglês',
        'sp'        => 'Espanhol',
        'pt'        => 'Português'
    ],
    'switch_language' => 'Mudar a língua actual para',

    'imet' => 'IMET: Ferramenta de Eficácia de Gestão Integrada',
    'imet_short'        => 'IMET',

    'management'        => 'Gestão do IMET',

    'encoding_language'         => 'Linguagem de codificação',
    'encoders_responsible'      => 'Codificadores e responsáveis',
    'encoders'                  => 'Codificadores',
    'responsible_internal'      => 'Responsáveis (equipa de gestão)',
    'responsible_external'      => 'Responsáveis (apoio externo)',

    'supervisors'              => 'Supervisores',
    'readonly'                 => 'Apenas leitura',

    'encode'            => 'codificar',
    'show'              => 'mostrar',

    'context'           => 'contexto',
    'evaluation'        => 'avaliação',
    'cross_analysis'        => 'cross analysis',
    'report'            => 'relatório de análise',
    'context_long'      => 'contexto de intervenção',
    'evaluation_long'   => 'avaliação da gestão',
    'cross_analysis_long'   => 'cross analysis',
    'report_long'       => 'relatório de análise',

    'import_imet'       => 'Importar IMET',
    'merge_tool'        => 'Ferramenta de fusão',
    'destination_form'        => 'Formulário de destino',
    'set_as_destination_form' => 'Definir como forma de destino',
    'confirm_merge'     => 'Confirmar para copiar dados',
    'upgrade'           => 'Actualização para IMET v2',
    'upgrade_confirm'   => 'Confirmar a actualização para IMET v2?<ul><li> Será criada uma cópia do formulário original.</li><li>alguns dados não puderam ser convertidos para v2</li>',
    'upgrade_success'   => 'Actualização para IMET v2 concluída com sucesso',
    'upgrade_failed'    => 'Erro na actualização para IMET v2',
    'not_authorized_module' => 'Sem autorização para visualizar esta informação',
    'double_check_wdpa' => 'Certifique-se de selecionar a WDPA correta',
    'nothing_to_evaluate' => 'Nada a avaliar',

    'synthetic_indicator' => 'Indicador sintético',
    'cross_analysis_info' => 'A função de análise cruzada visa identificar possíveis inconsistências nos resultados da análise IMET. Procura-se ver se as pontuações de um par (ou triplot) de perguntas IMET são significativamente diferentes. O limiar para uma diferença significativa é fixado em 20 pontos percentuais para as perguntas medidas na escala (min: 0 - max: 100). Abaixo encontram-se os indicadores para os quais foi identificada na sua avaliação uma diferença que excede o limiar pré-definido. Como a análise de tabulação cruzada é apenas consultiva, não são dadas sugestões quanto ao motivo da diferença de valores ou possíveis alterações que poderiam ser adoptadas na análise. As respostas fornecidas podem permanecer inalteradas, mas os valores atribuídos devem ser verificados em conjunto com a equipa da área protegida. Comentários adicionais devem também ser acrescentados aos indicadores seleccionados para explicar a diferença significativa de pontuação ou para que as disposições de gestão sejam adoptadas.',
    'nothing_found' => 'Nada encontrado',

    'indexes' => [
        'imet'        => 'IMET index',
        'context'     => 'Contexto index',
        'planning'    => 'Plaeamento index',
        'inputs'      => 'Recursos index',
        'process'     => 'Processo index',
        'outputs'     => 'Produtos index',
        'outcomes'    => 'Resultados index',
    ],

    'steps_eval' => [
        'general_info'              => 'Informacao Geral',
        'context'                   => 'Contexto de Gestão',
        'planning'                  => 'Planeamento',
        'inputs'                    => 'Recursos',
        'process'                   => 'Procesos',
        'outputs'                   => 'Produtos',
        'outcomes'                  => 'Resultados',
        'objectives'                => 'Objectivos',
        'management_effectiveness'  => 'Efectividade de Gestão',
    ],

    'Create' => [
        'title' => 'Criar um novo IMET (WDPA)',
        'fields' => [
            'version' => 'versão',
            'Year' => 'Ano sujeito a avaliação',
            'wdpa_id' => 'zona protegida',
            'language' => 'língua',
            'prefill_prev_year' => 'pré-preencher com o ano anterior'
        ]
    ],

    'CreateNonWdpa' => [
        'title' => 'Criar um novo IMET (não WDPA)',
        'fields' => [
            'version' => 'versão',
            'Year' => 'Ano sujeito a avaliação',
            'wdpa_id' => 'zona protegida',
            'language' => 'língua',
            'prefill_prev_year' => 'pré-preencher com o ano anterior',
            'pa_def' => 'definição',
            'name' => 'nome fornecido pelo operador',
            'origin_name' => 'nome na língua original',
            'designation' => 'nome da designação (por exemplo, reserva, santuário, etc.) ',
            'designation_eng' => 'designação obrigatória em Inglês',
            'designation_type' => 'Tipo de designação',
            'marine' => 'tipologia',
            'rep_m_area' => 'superfície da área protegida marinha conservada [km<sup>2</sup>]',
            'rep_area' => 'superfície da área protegida conservada [km<sup>2</sup>]',
            'status' => 'estado',
            'ownership_type' => 'Tipo de propriedade',
            'status_year' => 'ano da promulgação do estatuto',
            'country' => 'país',
        ],

        'allowed_international' => 'Allowed values for international-level designations',
        'allowed_regional' => 'Allowed values for regional-level designations',
        'allowed_national' => 'No fixed values for protected areas designated at a national level',
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

];
