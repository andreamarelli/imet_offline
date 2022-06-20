<?php

return [

    'languages' => [
        'fr'        => 'french',
        'en'        => 'english',
        'sp'        => 'spanish',
        'pt'        => 'portuguese'
    ],

    'NonWdpaPaDef' => [
        '1' => 'atende às definições de área protegida da IUCN e / ou CBD',
        '0' => 'atende à definição de CBD de um OECM',
    ],

    'NonWdpaDesignType' => [
        'Regional',
        'Nacional',
        'Internacional',
        'Não aplicável'
    ],

    'NonWdpaTypology' => [
        '2' => 'principalmente ou inteiramente marinho',
        '1' => 'costeiro: marinho e terrestre',
        '0' => 'principalmente ou totalmente terrestre'
    ],

    'NonWdpaStatus' => [
        'Proposta',
        'Inscrita',
        'Adotada',
        'Designada',
        'Estabelecida'
    ],

    'PaType' => [
        'terrestrial'           => 'terrestre',
        'marine_and_coastal'    => 'Marinho e costeiro',
        'oecm_terrestrial'      => 'OECMs (Other effective area-based conservation measures) - Terrestrial',
        'oecm_marine'           => 'OECMs (Other effective area-based conservation measures) - Marine',
        'icca_terrestrial'      => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Terrestrial',
        'icca_marine'           => 'Territories and areas conserved by indigenous peoples and local communities (ICCAs) - Marine'
    ],

    'IUCNDesignation' => [
        'IA'    => 'IA Reserva Natural Estricta',
        'IB'    => 'IB Área Selvagem ',
        'II'    => 'II Parque Nacional',
        'III'   => 'III Monumento ou Característica Natural ',
        'IV'    => 'IV Área de Gestão de Habitats ou Espécies',
        'V'     => 'V Paisagem Protegida ',
        'VI'    => 'VI Área Protegida com Utilização Sustentável de Qescurces Naturais',
        'not_reported' => 'Não reportado'
    ],

    'MarineDesignation' => [
        'Zona de não-entrada (No-Entry zone)',
        'Zona de Não-Take (No-Take zone)',
        'MPA multi-purposes - Zonas tampão para uso tradicional',
        'MPA multi-purposes - Zonas tampão para actividades educativas e/ou recreativas',
        'MPA multi-purposes - Outros',
        'Reservas marinhas',
        'XRefúgios de vida selvagem',
        'Zona de gestão de peixes',
        'Outros',
    ],

    'EcoType' => [
        'Deserto',
        'Savanas',
        'Miombo',
        'bosque',
        'Floresta seca',
        'Floresta Tropical',
        'Montanha alta',
        'lago / rio',
        'Area húmida',
        'Mangais',
        'Costa',
        'Mar/Oceano'
    ],

    'InstitutionType' => [
        'Académica',
        'Confessioário',
        'Independente',
        'ONG / ASBL',
        'Organizacao Internacional',
        'Privado',
        'Projecto / Programa',
        'Público (Estado)',
        'Outro'
    ],

    'PartnershipsType' => [
        'financeiro',
        'científico',
        'investigação',
        'patrocínio',
        'gemelagem',
        'períscia',
        'serviço de entrega',
        'concessão (exemplo, turismo)',
        'colaboração',
        'PPP (Parceria/Pública/Privada)'
    ],

    'GovernanceType' => [
        'Conservação baseada na comunidade (Community-based conservation-CBC)',
        'Gestão baseada na comunidade (Community-based management-CBM)',
        'Área Baseada na Conservação (Conservation Based Area-CBA)',
        'Áreas Marítimas Geridas Localmente (Locally Managed Marine Areas - LMMA)',
        'Áreas Conservadas pela Comunidade Indígena (Indigenous Community Conserved Areas - ICCAs)',
        'Áreas Protegidas e Conservadas (Protected and Conserved Areas-PCAs)',
        'Outros'
    ],

    'TerrestrialOrMarine' => [
        'terrestrial' => 'Terrestre',
        'marine' => 'Marítima',
    ],

    'SpecialDesignation' => [
        'Parques patrimoniais de ASEAN (ASEAN)',
        'Sítios de Aliança de Zero Extinção (AZE)',
        'Convençãocao de Barcelona',
        'Pontos Chave de Biodiversidade',
        'Areas Endémicas de Aves',
        'Areas Selvagens de alta Biodiversidade',
        'Sitios importantes designados pela IUCN para a Biodiversidade de Água Doce',
        'Áreas Importantes de Aves(IBA)',
        'Áreas Importantes de Plantas (IPA)',
        'Areas Chave de Biodiversidade (KBA)',
        'Natura 2000',
        'Areas Marinhas Protegidas de OSPAR',
        'Areas humidas de Ramsar',
        'Espécies de grade',
        'UNESCO MAB',
        'Sítios de Património Mundial'
    ],

    'SpeciesReliability' => [
        'Alta', 'Média', 'Pobre'
    ],

    'Habitats' => [
        # Forest
        'Forest temperate',
        'Forest boreal',
        'Subtropical/tropical moist lowland',
        'Subtropical/tropical moist montane',
        'Subtropical/tropical dry',
        'Subtropical/tropical swamp',
        # Savanna
        'Savanna-moist',
        'Savanna-dry',
        # Shrubland
        'Shrubland-Subtropical/tropical dry',
        'Shrubland-Subtropical/tropical moist',
        'Shrubland-Subtropical/tropical high altitude',
        'Shrubland temperate',
        'Shrubland boreal',
        # Grassland
        'Grassland Temperate',
        'Grassland subtropical/tropical high altitude',
        'Grassland subtropical/tropical dry',
        # Wetlands
        'Wetlands (inland)-Permanent freshwater lakes',
        'Wetlands (inland)',
        'Wetlands (inland)-Tundra wetlands',
        # Rocky Areas, Desert
        'Desert – Temperate',
        'Desert – Cold',
        'Desert - Hot',
        # Artificial
        'Plantations'
    ],

    'EcosystemServicesImportance' => [
        '_' => null,        // need to force string keys
        '0' => 'Local',
        '1' => 'Maior',
    ]

];
