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

    'dopa_not_available' => 'DOPA serviços não disponíveis',

    'languages' => [
        'fr'        => 'francês',
        'en'        => 'inglês',
        'sp'        => 'espanhol',
        'pt'        => 'português'
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

    'synthetic_indicator' => 'Indicador sintético',
    'cross_analysis_info' => 'A função de análise cruzada visa identificar possíveis inconsistências nos resultados da análise IMET. Procura-se ver se as pontuações de um par (ou triplot) de perguntas IMET são significativamente diferentes. O limiar para uma diferença significativa é fixado em 20 pontos percentuais para as perguntas medidas na escala (min: 0 - max: 100). Abaixo encontram-se os indicadores para os quais foi identificada na sua avaliação uma diferença que excede o limiar pré-definido. Como a análise de tabulação cruzada é apenas consultiva, não são dadas sugestões quanto ao motivo da diferença de valores ou possíveis alterações que poderiam ser adoptadas na análise. As respostas fornecidas podem permanecer inalteradas, mas os valores atribuídos devem ser verificados em conjunto com a equipa da área protegida. Comentários adicionais devem também ser acrescentados aos indicadores seleccionados para explicar a diferença significativa de pontuação ou para que as disposições de gestão sejam adoptadas.',
    'nothing_found' => 'Nada encontrado',

];
