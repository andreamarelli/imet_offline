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
    'cross_analysis_info' => 'Cross-analysis function aims to spot possible inconsistencies in IMET scores. It investigates whether scores within a pair (or a triplet) of IMET items were significantly different. The threshold for significant differences is set at the level of 20 percentage points for questions measured on the scale (min:0 – max:100). Below are provided those indicators, for which the difference exceeding the predefined threshold was established in your assessment. Since cross-analysis is for advisory purposes only, no suggestions are provided regarding the direction of discrepancy or possible changes that could be implemented. The responses can remain unchanged but should be double checked by the management team. Additional comments can be added in the selected questions to explain the significant score difference.',
    'nothing_found' => 'Nada encontrado',

];
