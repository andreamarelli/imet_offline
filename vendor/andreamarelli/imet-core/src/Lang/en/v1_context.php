<?php

return [

    'Objectives' => [
        'title' => 'Setting target objectives',
        'fields' => [
            'Status' =>         'Baseline',
            'Benchmark1' =>     'Benchmark 1',
            'Benchmark2' =>     'Benchmark 2',
            'Benchmark3' =>     'Benchmark 3',
            'Objective' =>      'Objective - expected conditions',
        ]
    ],

    'Objectives1' => [
        'module_info' => 'Setting target conservation objectives and indicators for governance and partnership, status, membership network and mission and the historical, political, legal, institutional and other contexts of the protected area<br /> The objectives and benchmarks to be entered in the table below are to be used for managing and monitoring activities in the protected area and, more specifically, for the planning, resource (input) mobilisation and process phases, and in identifying outputs and outcome objectives.'
    ],
    'Objectives2' => [
        'module_info' => 'Setting target conservation objectives and indicators for <b>land areas, boundaries, shape index and level of control</b> of the protected area</b><br /> The objectives and benchmarks to be entered in the table below are to be used for managing and monitoring activities in the protected area and, more specifically, for the planning, resource (input) mobilisation and process phases, and in identifying outputs and outcome objectives.'
    ],
    'Objectives3' => [
        'module_info' => 'Setting target conservation objectives and indicators for <b>for human and financial resources/support from partnerships in managing</b> the protected area<br /> The objectives and benchmarks to be entered in the table below are to be used for managing and monitoring activities in the protected area and, more specifically, for the planning, resource (input) mobilisation and process phases, and in identifying outputs and outcome objectives.'
    ],
    'Objectives4' => [
        'module_info' => ' Setting target conservation objectives and indicators for key factors: <b> i) species and plants flagship, endangered, endemic, invasive, exploited, with insufficient data; ii) habitats; iii) land-cover-change and iv) management of natural ressources</b><br /> The objectives and benchmarks to be entered in the table below are to be used for managing and monitoring activities in the protected area and, more specifically, for the planning, resource (input) mobilisation and process phases, and in identifying outputs and outcome objectives.'
    ],
    'Objectives5' => [
        'module_info' => 'Setting target conservation objectives and indicators for <b>pressures and threats</b> facing the protected areae<br /> The objectives and benchmarks to be entered in the table below are to be used for managing and monitoring activities in the protected area and, more specifically, for the planning, resource (input) mobilisation and process phases, and in identifying outputs and outcome objectives.'
    ],
    'Objectives6' => [
        'module_info' => 'Setting target conservation objectives and indicators for <b>climate change</b> facing the protected areae<br /> The objectives and benchmarks to be entered in the table below are to be used for managing and monitoring activities in the protected area and, more specifically, for the planning, resource (input) mobilisation and process phases, and in identifying outputs and outcome objectives.'
    ],
    'Objectives7' => [
        'module_info' => 'Setting objectives associated with <b>he maintenance of ecosystem services and the dependence on these services of communities</b> in the protected area<br /> The objectives and benchmarks to be entered in the table below are to be used for managing and monitoring activities in the protected area and, more specifically, for the planning, resource (input) mobilisation and process phases, and in identifying outputs and outcome objectives'
    ],

    'ResponsablesInterviewers' => [
        'title' => 'Responsibility for filling the form: Management team and partners',
        'fields' => [
            'Name'          => 'name',
            'Institution'   => 'institution',
            'Function'      => 'function',
            'Contacts'      => 'contacts',
            'EncodingDate'  => 'Date of compilation',
            'EncodingDuration' => 'Time taken for evaluation (hrs)'
        ]
    ],

    'ResponsablesInterviewees' => [
        'title' => 'Responsibility for completing the form: External support for analysis and management evaluation',
        'fields' => [
            'Name' => 'Name',
            'Institution' => 'Institution',
            'Function' => 'Function',
            'Contacts' => 'Contacts',
            'EncodingDate' => 'Date of compilation',
            'EncodingDuration' => 'Time taken for evaluation (hrs)',
        ]
    ],

    'GeneralInfo' => [
        'title' => 'Basic data',
        'fields' => [
            'CompleteName' => 'Full name of the protected area',
            'CompleteNameWDPA' => 'WPDA site name (from https://www.protectedplanet.net/)',
            'UsedName' => 'Name by which referred to',
            'WDPA' => 'WPDA site code  WDPA',
            'NationalCategory' => 'National category',
            'IUCNCategory1' => 'IUCN category(ies) (protected areas with more classifications for internal zoning) (1st category)',
            'IUCNCategory2' => '2nd UICN category',
            'IUCNCategory3' => '3rd UICN category',
            'Country' => 'Country',
            'CreationYear' => 'Year created',
            'Institution' => 'Supervisory Governance and partnership(s)',
            'Biome' => 'Biome',
            'Ecoregions' => 'Reference ecoregion(s) [Ecoregions G200, Olson, WWF; Spalding M. et alt. 2007]',
            'Ecotype' => 'Ecotypes (up to 3 elements gradually as the predominance)',
            'ReferenceText' => 'Citation for existing founding legislation',
            'ReferenceTextDocument' => '',
            'ReferenceTextValues' => 'What are the main values for which the area has been designated? (Provide a brief description)',
        ]
    ],

    'Governance' => [
        'title' => 'Governance and partnership',
        'fields' => [
            'Partner' => 'Name of the partners',
            'InstitutionType' => 'Kind of institution',
            'PartnershipsType1' => 'The most important partnership: first',
            'PartnershipsType2' => 'second',
            'PartnershipsType3' => 'third',
            'Type' => 'Tick the governance model',
            'Comments' => 'Additional information on governance model (if required)',
        ]
    ],

    'SpecialStatus' => [
        'title' => 'Special status: World Heritage, MAB, Ramsar site, IBAs, SPAMI, LMMA, etc. )',
        'fields' => [
            'Designation' => 'Designation',
            'RegistrationDate' => 'Date of inscription',
            'Code' => 'Code',
            'Area' => 'Area (ha)',
            'DesignationCriteria' => 'Criteria for designation',
            'upload' => 'upload',
        ],
        'groups' => [
            'conventions'  => 'Accreditations and registrations in the lists of the international conventions (World Heritage, RAMSAR, etc.)',
            'networks'     => 'Membership of an officially recognized international network (MAB, RAPAC etc.)',
            'conservation' => 'Accreditation of the status of conservation interest by international bodies (IBA, AZE, etc.)',
            'marine_pa'    => 'Status of marine protected areas',
        ],
        'module_info' => 'Designation Name 1 (for example, UNESCO World Heritage site (Endangered site - Outstanding universal value)'
    ],

    'Networks' => [
        'title' => 'Membership of a local management network',
        'fields' => [
            'NetworkName' => 'Name',
            'ProtectedAreas' => 'Names of other protected areas within the network',
        ],
        'groups' => [
            'group0' => 'Transboundary network',
            'group1' => 'Landscape network (terrestrial and marine protected areas) - Network (marine network)',
            'group2' => 'Other network',
        ]
    ],

    'Missions' => [
        'title' => 'Vision - Mission - Objectives',
        'fields' => [
            'LocalVision' => 'At local or national level Vision',
            'LocalMission' => 'Mission',
            'LocalObjective' => 'Objectives',
            'LocalSource' => 'Source',
            'LocalManagementPlan' => 'File (Management plan)',
            'InternationalVision' => 'At international level Vision',
            'InternationalMission' => 'Mission',
            'InternationalObjective' => 'Objectives',
            'InternationalSource' => 'Source',
            'InternationalManagementPlan' => 'File (Management plan)',
            'Observation' => 'Observation',
        ]
    ],

    'Contexts' => [
        'title' => 'References for historical, political, legal and institutional and socio-economic contexts of the protected area ',
        'fields' => [
            'Context' => 'Specific context or elements',
            'file' => 'File(s)',
            'Summary' => 'Summary',
            'Source' => 'Source',
            'Observations' => 'Notes',
        ],
        'predefined_values' => [
            'Historic context',
            'Socio-economic context',
            'Political context (in country)',
            'Legal context',
            'Institutional context'
        ],
        'module_info' => 'Filling of data at national level with verification at local level'
    ],

    'GeographicalLocation' => [
        'title' => 'Localisation',
        'fields' => [
            'LimitsExist' => 'Existence of georeferenced official limits (yes / no)',
            'Shapefile' => 'GIS file',
            'SourceSHP' => 'Source of GIS file',
            'Coordinates' => 'Geographic coordinates (baseline for or key point in the park)',
            'SourceCoords' => 'Source',
            'AdministrativeLocation' => 'Administrative location of the protected area (province, region, etc.)',
        ]
    ],

    'Areas' => [
        'title' => 'Land areas of the protected area and the conservation context',
        'fields' => [
            'AdministrativeArea' => 'Administrative land area',
            'WDPAArea' => 'WPDA area',
            'GISArea' => 'Actual land area (GIS for the park or the authority responsible for protected areas) corresponding to the uploaded file',
            'TerrestrialArea' => 'Mixed protected areas = terrestrial and marine area (the coastal zone must be included in the terrestrial protected area)',
            'MarineArea' => 'Mixed protected areas: Marine area',
            'PercentageNationalNetwork' => '% of national network of protected areas',
            'PercentageEcoregion' => '% of ecoregion',
            'PercentageTransnationalNetwork' => '% of transboundary network',
            'PercentageLandscapeNetwork' => '% of landscape/network',
            'Index' => 'Shape index (Km²/Km = good > 23; average de 23 à 17;  poor < 17)',
            'Observations' => 'Notes',
        ]
    ],

    'ControlLevel' => [
        'title' => 'Level of control of the protected area',
        'fields' => [
            'UnderControlArea'              => 'Km² under control',
            'UnderControlPatrolManDay'      => 'Person / day of patrol',
            'UnderControlPatrolKm'          => 'Km of patrols',
            'EcologicalMonitoringPatrolKm'  => 'Area subject to environmental monitoring',
            'Source'                        => 'Source',
            'Observations'                  => 'Notes',
        ],
        'area'                          => 'Land area in the protected area',
        'under_control_area'            => 'Protected area under control (anti-poaching protection) during the last 12 months (or specify the reference period)',
        'area_percentage'               => '% of the area',
        'average_time'                  => 'Average p/d/ km² per year of the total area',
        'area_percentage_conversion'    => '% of the area (conversion)',
        'average_time_controlled'       => 'Average p/d/km² per year of the area under control'
    ],

    'Sectors' => [
        'title' => 'Level of control of the sectors of the protected area',
        'fields' => [
            'Name' => 'Sector',
            'UnderControlArea' => 'Km² under control',
            'UnderControlPatrolKm' => 'Km of patrols',
            'UnderControlPatrolManDay' => 'Person / day of patrol',
            'Objectives' => 'Management objectifves',
            'Restrictions' => 'Major restrictions on conservation',
            'SectorMap' => 'Zoning maps',
            'Source' => 'Source',
            'Observations' => 'Notes',
        ]
    ],

    'TerritorialReferenceContext' => [
        'title' => 'Baseline territorial context for the protected area',
        'fields' => [
            'ReferenceEcosystemAreaEstimation' => 'Estimate of the functional ecosystem area or baseline area of the protected area (with an outer strip of 10 to 25 km by default – in km²) (Km2)',
            'ReferenceEcosystemAreaPopulation' => 'Estimation of the local population',
            'EcologicalAspects' => 'Environmental factors, e.g. home ranges of flagship species (in km2) (Km2)',
            'FunctionalArea' => 'Functional area (resource area, e.g. the region of populations who benefit from the protected area – in km2) (Km2)',
            'FunctionalAreaPopulation' => 'Estimation of the local population',
            'SocioEconomicAspects' => 'Socio-economic and administrative factors, e.g. the relationships of traditional and modern authorities with the landscapes of the protected area (in km2) (Km2)',
            'SpillOverEffect' => 'SPILL-OVER effect in the marine protected area',
        ]
    ],

    'ManagementStaff' => [
        'title' => 'Size and composition of staff: Staff of protected area',
        'fields' => [
            'Function' => 'Fonctions',
            'ExpectedPermanent' => 'Planned or adequate staffing *',
            'ActualPermanent' => 'Current actual staffing',
            'Observations' => 'Notes',
            'Source' => 'Source',
        ],
        'module_info' => 'The statistical system allows only fourteen lines to identify the functions of the staff of the protected area'
    ],

    'ManagementStaffPartners' => [
        'title' => 'Size and composition of staff: Staff from partner organisations',
        'fields' => [
            'Partner' => 'Partenaire',
            'Coordinators' => 'Coordinators',
            'Technicians' => 'Techniciens/ Administrators',
            'Auxiliaries' => 'Auxiliary staff',
        ]
    ],

    'ManagementStaffCommunities' => [
        'title' => 'Size and composition of staff: Staff from Communities',
        'fields' => [
            'Community' => 'Communitie',
            'Role1' => 'Role',
            'StaffNUmberRole1' => 'Number',
            'Role2' => 'Role',
            'StaffNUmberRole2' => 'Number',
            'Role3' => 'Role',
            'StaffNUmberRole3' => 'Number',
        ]
    ],

    'FinancialResources' => [
        'title' => 'Financial resources: Budget and management costs',
        'fields' => [
            'Currency' => 'Currency',
            'ReferenceYear' => 'Baseline year',
            'ManagementFinancialPlanCosts' => 'Operating cost estimated on Management plan/Financial plan ($ or currency/year)',
            'OperationalWorkPlanCosts' => 'Operating costs estimated from the operational plan / working plan (budgeted annually)',
            'TotalBudget' => 'Total annual budget - Forecasts',
        ],
        'amount'                        => 'Montant',
        'functioning_costs'             => 'Operating costs ($/km2/year or currency/km2/year)',
        'estimation_financial_plan'     => '% of estimates in financial plan / working plan (budgeted annually)',
        'estimation_operational_plan'   => '% of estimation of the working plan (budgeted annually)',
        'module_info' => 'Estimated total costs based on Management plan/Financial plan'
    ],

    'FinancialAvailableResources' => [
        'title' => 'Financial resources: Budget available',
        'fields' => [
            'BudgetType' => '',
            'NationalBudget' => 'National budget',
            'OwnRevenues' => 'Revenues from the protected area',
            'Disputes' => 'Income from litigation (national treasury)',
            'Partners' => 'Contributions from the partners',
            'Currency' => 'Currency',
        ],
        "predefined_values" => [
            "Total annual budget available",
            "Total annual budget available for operating",
            "Total annual budget available for investments"
        ]
    ],

    'FinancialResourcesBudgetLines' => [
        'title' => 'Financial resources: Budget lines of the operational plan / working plan (budgeted annually)',
        'fields' => [
            'Line' => 'Budget lines',
            'Amount' => 'Amount (currency/an)',
            'BudgetSource' => 'Source of foundingt',
            'Currency' => 'Currency',
        ]
    ],

    'FinancialResourcesPartners' => [
        'title' => 'Financing of the partners',
        'fields' => [
            'Partner' => 'Project',
            'Funding' => 'Financing / Project / Activities',
            'Contribution' => 'Amount (currency / year)',
            'StartDate' => 'Beginning',
            'EndDate' => 'Expected end',
            'Observations' => 'Notes',
            'Currency' => 'Currency',
        ]
    ],

    'Equipments' => [
        'title' => 'Availability of infrastructure, equipment and facilities',
        'fields' => [
            'Resource' => 'Category',
            'AdequacyLevel' => 'Need/availability ratio',
        ],
        'groups' => [
            'group0' => 'Administrative buildings',
            'group1' => 'Accommodation',
            'group2' => 'Tourism',
            'group3' => 'Means of transport',
            'group4' => 'Anti-poaching equipment',
            'group5' => 'Means of communication',
            'group6' => 'IT',
            'group7' => 'Power generation for services',
            'group8' => 'Maintenance equipment',
            'group9' => 'Roads and tracks',
            'group10' => 'Waterways (qualitative evaluation)',
            'group11' => 'Airstrips (qualitative evaluation)',
            'group12' => 'Transportation for the protected area',
        ],
        'predefined_values' => [
            'group0' =>  ['Offices','Patrol posts','Barrier points','Scientific research','Suitably equipped garage and workshop','Miscellaneous services (magazine, radio, etc.)','Dispensaries','Other buildings'],
            'group1' =>  ['Officers and deputy officers', 'Ranger staff', 'Support staff', 'Reception', 'Other buildings'],
            'group2' =>  ['Hotels Tinga', 'Eco-lodges camp nomade', 'Salamat', 'Reception facilities for tourists', 'Miradors', 'Number of rooms', 'Number of guides on service:', 'Available tourist routes (km)', 'Other buildings'],
            'group3' =>  ['Cars', 'Motorbyke/Quads', 'Bicycles', 'Boats', 'Pirogues', 'Aeroplane, microlight', 'Heavy engines', 'Horses'],
            'group4' =>  ['Weapons', 'Cartridges', 'Uniforms', 'Rations (per diem)', 'GPS, compasses', 'Camping and bush equipment', 'Other means of anti-poaching equipment'],
            'group5' =>  ['VHF/HF radios', 'V-SAT', 'Landline telephones', 'GSM telephones', 'Satellite telephones', 'Internet connection', 'Other means of communication'],
            'group6' =>  ['Desktop computers', 'Printers', 'Photocopiers', 'Laptop computers', 'Other means of IT'],
            'group7' =>  ['Power generators', 'Solar electric facility', 'Hydropower electric facility', 'Wind electric facility', 'Water'],
            'group8' =>  ['Vehicles/boats', 'Radios', 'Buildings', 'Electrical network', 'Hydraulic network', 'Heavy engines'],
            'group9' =>  ['Penetration roads/tracks into the protected area', 'Penetration paths into the protected area', 'Road for the outside'],
            'group10' => ['Penetration waterways into the protected area', 'Other waterways'],
            'group11' => ['Airstrips inside and outside the protected area', 'Other airstrips'],
            'group12' => ['Major land-based communication routes', 'Inland and maritime waterways', 'National and international air connections', 'Other transportation for the protected area']
        ],
        'ratingLegend' => [
            'AdequacyLevel' => [
                '0' => 'highly inadequate',
                '1' => 'inadequate',
                '2' => 'adequate',
                '3' => 'excellent',
            ]
        ]
    ],

    'AnimalSpecies' => [
        'title' => 'Animal species: flagship, endangered, endemic, exploited, invasive and for which there is insufficient data (mammals, birds,
                                    amphibians, reptiles and fish) selected as indicators for the protected area and that will need to be monitored over time',
        'fields' => [
            'SpeciesID' => 'Species',
            'FlagshipSpecies' => 'PHA',
            'EndangeredSpecies' => 'MEN',
            'EndemicSpecies' => 'END',
            'ExploitedSpecies' => 'EXP',
            'InvasiveSpecies' => 'INV',
            'InsufficientDataSpecies' => 'INS',
            'PopulationEstimation' => 'Estimated population',
            'DesiredPopulation' => 'Desired conservation status',
            'TrendRating' => 'Trend',
            'Reliability' => 'Reliability',
            'Comments' => 'Source / Note',
        ],
        'module_info' => 'From the list of species that are assumed to exist (see the IUCN’s lists of A - mammals, B - birds and C - amphibians), the manager selects a limited number of flagship species for monitoring over time, basing the selection on the species’ presence in/absence from the protected area.<br /> <b>Species indicators</b> <ul> <li><b>PHA</b>: Flagship species</li> <li><b>MEN</b>: Endangered (threatened) species</li> <li><b>END</b>: Endemic species</li> <li><b>EXP</b>: Exploited species</li> <li><b>INV</b>: Invasive species</li> <li><b>INS</b>: Epecies with low level of knowledge</li> </ul> <b>Estimated population:</b> Ecological monitoring program and generation of multiannual trend graph.<br /> <b>Reliability of information</b> <ul> <li><b>High</b>: methodology that is officially recognised</li> <li><b>Medium</b>: methodology that is not officially recognised</li> <li><b>Poor</b>: non-existent methodology, information is usually estimated</li> </ul>',
        'ratingLegend' => [
            'TrendRating' => [
                '-1 / -2' => 'Negative (least - most severe)',
                '0' => 'Stable',
                ' +1 / +2' => 'Positive (least - most significant)',
            ],
        ]
    ],

    'VegetalSpecies' => [
        'title' => 'Plant species: flagship, endangered, endemic, exploited, invasive and for which there is insufficient data selected as indicators for the protected area',
        'fields' => [
            'Species' => 'Species',
            'FlagshipSpecies' => 'PHA',
            'EndangeredSpecies' => 'MEN',
            'EndemicSpecies' => 'END',
            'ExploitedSpecies' => 'EXP',
            'InvasiveSpecies' => 'INV',
            'InsufficientDataSpecies' => 'INS',
            'PopulationEstimation' => 'Estimated population',
            'DesiredPopulation' => 'Desired conservation status',
            'TrendRating' => 'Trend',
            'Reliability' => 'Reliability',
            'Comments' => 'Source / Note',
        ],
        'module_info' => 'From the list of supposedly existing plant that are assumed to exist (see the lists made available and the information from the park), the manager selects a limited number of flagship species for monitoring over time, basing the selection on the species’ presence in/absence from the protected area and that will need to be monitored over time.<br /> <b>Species indicators</b> <ul> <li><b>PHA</b>: Flagship species</li> <li><b>MEN</b>: Endangered (threatened) species</li> <li><b>END</b>: Endemic species</li> <li><b>EXP</b>: Exploited species</li> <li><b>INV</b>: Invasive species</li> <li><b>INS</b>: Epecies with low level of knowledge</li> </ul> <b>Estimated population:</b> Ecological monitoring program and generation of multiannual trend graph.<br /> <b>Reliability of information</b> <ul> <li>High: methodology that is officially recognised</li> <li>Medium: methodology that is not officially recognised</li> <li>Poor: non-existent methodology, information is usually estimated</li> </ul> ',
        'ratingLegend' => [
            'TrendRating' => [
                '-1 / -2' => 'Negative (least - most severe)',
                '0' => 'Stable',
                ' +1 / +2' => 'Positive (least - most significant)',
            ],
        ]

    ],

    'Habitats' => [
        'title' => 'Ecosystem and habitats with important and significant features of the protected area',
        'fields' => [
            'EcosystemType' => 'Type of ecosystem or habitat',
            'Value' => 'Characteristic or value',
            'Area' => 'Surface area (ha)',
            'DesiredConservationStatus' => 'Desired conservation status',
            'Trend' => 'Trend',
            'Reliability' => 'Reliability of information',
            'Sectors' => 'Sectors',
        ],
        'module_info' => '<i><span style="color: Blue;">Indicateur</span></i>: Ecosystem and habitats with important and significant features of the protected area, Land cover and Land use<br /> <i><span style="color: Blue;">Sous indicateur</span></i>: <b><span style="font-style: normal;">Ecosystem and habitats with important and significant features of the protected area</span></b><br /> Based on a number of ecosystem and habitat-related parameters (external = irreplaceability and internal = specific features of the protected area), the manager determines the specific features of terrestrial, marine and freshwater ecosystems and habitats in the protected area which should be monitored over time.<br /> <b>Note</b>: Habitat evaluation is still emerging as a discipline, since it is highly complex. The classification provides for the following division of territory: Biome, Ecoregion, Ecosystem, Habitat. Habitat characteristics/values can be assessed as: <ul> <li>i) under threat of extinction (within their natural range),</li> <li>ii) having a reduced natural range,</li> <li>iii) in decline,</li> <li>iv) an outstanding example of specific characteristics, etc.</li> </ul> Identification can assess habitats also as being specifically for: <ul> <li>i) reproduction,</li> <li>ii) nutrition,</li> <li>iii) species protection, etc.</li> </ul> <br /> <b>Reliability of information</b> <ul> <li><b>High</b>: methodology that is officially recognised</li> <li><b>Medium</b>: methodology that is not officially recognised</li> <li><b>Poor</b>: non-existent methodology, information is usually estimated</li> </ul>',
        'ratingLegend' => [
            'Trend' => [
                '-1 / -2' => 'Negative (least - most severe)',
                '0' => 'Stable',
                ' +1 / +2' => 'Positive (least - most significant)',
            ],
        ]

    ],

    'HabitatsMarine' => [
        'title' => 'Presence, extent and distribution of key marine habitats',
        'fields' => [
            'HabitatType' => 'Habitats and stratus',
            'Presence' => 'Presence',
            'Area' => 'Extent of habitat (estimated, in ha)',
            'Fragmentation' => 'Fragmentation of the habitat',
            'Source' => 'Source',
            'Description' => 'Description',
        ],
        'predefined_values' => [
            'Mangroves',
            'Seaweed',
            'Coral reef',
            'Tidal swamps, coastal swamps',
            'Ecosystem of coastal marine waters',
            'Pelagic stratus',
            'Abyssal stratus',
            'Benthic stratus',
            'Open sea'
        ],
        'module_info' => '<i><span style="color: Blue;">Indicateur</span></i>: Marin habitats with important and significant features of the protected area, Land cover et Land use<br /> <i><span style="color: Blue;">Sous indicateur</span></i>: <b><span style="font-style: normal;">Presence, extent and distribution of key marine habitats</span></b>'
    ],

    'LandCover' => [
        'title' => 'Maintenance of land cover (or physical terrain - forest, water, roads, etc.) [for total values see point # 2.2]',
        'fields' => [
            'CoverType' => 'Land cover categories',
            'HistoricalArea' => 'Baselines (ha)',
            'PreviousEstimationArea' => 'Previous estimate (ha)',
            'CurrentEstimationArea' => 'Latest estimate (ha)',
            'Trend' => 'Trend',
            'Reliability' => 'Reliability',
            'Notes' => 'Source / Note',
            'HistoricalAreaData' => 'Baseline date',
            'PreviousEstimationAreaData' => 'Previous estimate date',
        ],
        'predefined_values' => [
            'Forest',
            'Savannah shrublands',
            'Herbaceous savannah',
            'Grasslands',
            'Water',
            'Crops/Plantations',
            'Dwellings',
            'Roads'
        ],
        'module_info' => '<i><span style="color: Blue;">Indicateur</span></i>: Ecosystem and habitats with important and significant features of the protected area, Land cover and Land use<br /> <i><span style="color: Blue;">Sous indicateur</span></i>: <b><span style="font-style: normal;">Maintenance of land cover (or physical terrain - forest, water, roads, etc.) [for total values see point # 2.2]</span></b><br /> <b>Land cover categories (basis: Land Cover Classification System - LCCS, main categories, example)<br /> <b>Reliability of information</b> <ul> <li>High</b>: methodology that is officially recognised</li> <li><b>Medium</b>: methodology that is not officially recognised</li> <li><b>Poor</b>: non-existent methodology, information is usually estimated</li> </ul>',
        'ratingLegend' => [
            'Trend' => [
                '-1 / -2' => 'Negative (least - most severe)',
                '0' => 'Stable',
                ' +1 / +2' => 'Positive (least - most significant)',
            ],
        ]
    ],

    'NonSustainableUsage' => [
        'title' => 'Legal but non-sustainable use of the protected land or marine area (land or resource use by man) [see point 2.2 for total values]',
        'fields' => [
            'HabitatParameter' => 'Habitat parameters',
            'HistoricalArea' => 'Baseline Surface area (ha)',
            'PreviousEstimationArea' => 'Previous estimate (ha)',
            'CurrentEstimationArea' => 'Latest estimate (ha)',
            'Trend' => 'Trend',
            'Reliability' => 'Reliability',
            'Sectors' => 'Sector(s) of the protected area',
            'HistoricalAreaData' => 'Baseline date',
            'PreviousEstimationAreaData' => 'Previous estimate date',
        ],
        'predefined_values' => [
            'Loss of habitat',
            'Deterioration',
            'Pollution',
            'Fragmentation',
            'Crop production/fish farming',
            'Industrial fishing',
            'Nonindustrial fishing',
            'Harvesting  on the sea',
            'Grazing/fishing/harvesting (terrestrial)',
            'Erosion',
            'Invasive species',
            'Pests and diseases',
            'Fires',
            'Accessibility and relative impacts'
        ],
        'module_info' => '<b>Reliability of information</b> <ul> <li>High = methodology that is officially recognised</li> <li>Medium = methodology that is not officially recognised</li> <li>Poor = non-existent methodology, information is usually estimated</li> </ul>',
        'ratingLegend' => [
            'Trend' => [
                '-1 / -2' => 'Positive (least - most significant)',
                '0' => 'Stable',
                ' +1 / +2' => 'Negative = (least - most severe)',
            ],
        ]
    ],

    'MenacesPressions' => [
        'title' => 'Pressures on and threats',
        'fields' => [
            'Value' => 'Values',
            'Impact' => 'Impact/ Severity',
            'Extension' => 'Scale/ Extent',
            'Duration' => 'How long/ Irreversibility',
            'Trend' => 'Over the last years',
            'Probability' => 'Probability of a future threat',
        ],
        'groups' => [
            'group0' => 'Commercial and residential',
            'group1' => 'Annual or multi-annual crops (non-woody)',
            'group2' => 'Wood and pulpwood plantations',
            'group3' => 'Small- and large-scale livestock farming',
            'group4' => 'Marine and freshwater aquaculture',
            'group5' => 'Other typology of production',
            'group6' => 'Energy and mining',
            'group7' => 'Transport and infrastructure',
            'group8' => 'Hunting and harvesting of land animals',
            'group9' => 'Gathering and harvesting of land plants',
            'group10' => 'Forestry and timber harvesting',
            'group11' => 'Fishing and harvesting aquatic resources',
            'group12' => 'Human disturbance / intrusion',
            'group13' => 'Bush fires (fires)',
            'group14' => 'Dams and water management or use',
            'group15' => 'Other changes in the ecosystem',
            'group16' => 'Invasive / problematique species',
            'group17' => 'Domestic and urban waste water',
            'group18' => 'Industrial and military effluent',
            'group19' => 'Agricultural and forestry effluents',
            'group20' => 'Rubbish and solid waste',
            'group21' => 'Atmospheric pollution',
            'group22' => 'Excessive energy use',
            'group23' => 'Geological phenomena',
            'group24' => 'Climate change and phenomenas',
            'group25' => 'Other pressures and threats'
        ],
        'predefined_values' => [
            'group0' => [
                'Urban and residential areas',
                'Commercial areas',
                'Tourist and recreational areas',
                'Enclave areas'],
            'group1' => [
                'Shifting cultivation',
                'Smallholder farming',
                'Large agro-industrial enterprises'],
            'group2' => [
                'Small plantations',
                'Agro-industrial plantations'],
            'group3' => [
                'Nomadic grazing',
                'Livestock farming and grazing on small farms',
                'Agro-industrial livestock farming and grazing'],
            'group4' => [
                'Subsistence or artisanal aquaculturee',
                'Industrial aquaculture'],
            'group6' => [
                'Drilling (gas and oil)',
                'Mining or quarrying operations',
                'Renewable energies'],
            'group7' => [
                'Roads',
                'Utility and communication networks and lines (power, telephone, aqueduct, etc.)',
                'Maritime waterways and shipping lanes',
                'Air corridors',
                'Railways'],
            'group8' => [
                'Hunting of land animals',
                'Harvesting of live animals'],
            'group9' => [
                'Plant gathering',
                'Plant harvesting'],
            'group10' => [
                'Small-scale lumber operations',
                'Large-scale fuelwood operations',
                'Small-scale fuelwood operations',
                'Large-scale lumber operations',
                'Battens/poles for construction'],
            'group11' => [
                'Subsistence or small-scale fishing',
                'Large-scale fishing',
                'Subsistence or small-scale harvesting of aquatic resources',
                'Large-scale harvesting of aquatic resources',
                'Shellfish harvesting'],
            'group12' => [
                'Recreational activities',
                'Wars, civil unrest and military exercises',
                'Works and other activities'],
            'group13' => [
                'Frequency and intensity of fires'],
            'group14' => [
                'Surface water abstraction (domestic usage))',
                'Surface water abstraction (commercial usage)',
                'Surface water abstraction (agricultural usage)',
                'Surface water abstraction (usage unknown)',
                'Underground water abstraction (domestic usage)',
                'Underground water abstraction (commercial usage)',
                'Underground water abstraction (agricultural usage)',
                'Underground water abstraction (usage unknown)',
                'Small dams',
                'Large dams',
                'Dams (size unknown)'],
            'group16' => [
                'Invasive introduced species or diseases',
                'Problematic indigenous species or diseases',
                'Problematic species or diseases of unknown origin',
                'Introduced genetic material',
                'Viral or prion diseases',
                'Disease of unknown cause'],
            'group17' => [
                'Waste water and sewers',],
            'group18' => [
                'Oil slick',
                'Mining leak'],
            'group19' => [
                'Nutrient load',
                'Soil erosion and sedimentation',
                'Herbicides and pesticides'],
            'group20' => [
                'Municipal waste',
                'Litter from cars / Flotsam & jetsam from recreational boats',
                'Construction debris',
                'Waste that entangles wildlife'],
            'group21' => [
                'Acid rain',
                'Pollution cloud',
                'Ozone'],
            'group22' => [
                'Light pollution',
                'Heat pollution',
                'Noise pollution'],
            'group23' => [
                'Volcanoes',
                'Earthquakes and tsunamis',
                'Avalanches and landslides'],
            'group24' => [
                'Damage and changes to habitat',
                'Droughts',
                'Extreme temperatures',
                'Storms and flooding',
                'Other: Increased rainfall and seasonal changes'],
            'group25' => [
                'Human-Wildlife Conflict'
            ]
        ],
        'categories' => [
            'title1' => 'Commercial and residential',
            'title2' => 'Agriculture et aquaculture',
            'title3' => 'Energy and mining',
            'title4' => 'Transport and infrastructure',
            'title5' => 'Use of biological resources',
            'title6' => 'Human disturbance / intrusion',
            'title7' => 'Changes in the natural system',
            'title8' => 'Invasive / problematique species',
            'title9' => 'Pollution',
            'title10' =>'Geological phenomena',
            'title11' =>'Climate change and phenomenas',
            'title12' =>'Other pressures and threats'
        ],
        'ratingLegend' => [
            'Impact' => [
                '0' => 'mild',
                '1' => 'moderate',
                '2' => 'high',
                '3' => 'severe',
            ],
            'Extension' => [
                '0' => 'localised <5%',
                '1' => 'sparse 5-15%',
                '2' => 'widely dispersed 15-50%',
                '3' => 'everywhere >50%',
            ],
            'Duration' => [
                '0' => 'short term < 5 ans',
                '1' => 'medium term 5-20 ans',
                '2' => 'very long term 20-100 ans',
                '3' => 'permanent >100 ans',
            ],
            'Trend' => [
                '-2' => 'has decreased significantly',
                '-1' => 'has decreased slightly',
                '0' => 'has remained constant',
                '1' => 'has increased slightly',
                '2' => 'has increased significantly',
            ],
            'Probability' => [
                '0' => 'very low',
                '1' => 'low',
                '2' => 'average',
                '3' => 'high',
            ],
        ]
    ],

    'ClimateChangeImportanceElements' => [
        'title' => 'Climate change and conservation / Elements of importance',
        'fields' => [
            'GroupElement' => 'Element',
            'Element' => '',
            'Application' => 'Application',
            'Observations' => 'Observations',
        ],
        'predefined_values' => [
            'REDD+',
            'Integration into the terrestrial and marine landscape',
            'Protected area with altitude variation',
            'Transboundary protected areas',
            'Relevance habitats',
            'Habitat restoration',
            'Intersectoral planning',
            'Environmental policy',
            'Sustainable financing',
            'Socioeconomic'
        ],
        'Element' => [
            'Support for REDD+ projects (areas with high biodiversity and high carbon storage possibilities)',
            'Connections between protected and buffer areas and corridors to enhance resilience and adaptation of biodiversity to climate change effects',
            'Altitude variation or not inside the protected area allowing species migration (the more altitude variation inside the protected the most favourable areas for species)',
            'Cooperation agreements for the management of transboundary ecosystems to improve resilience and adaptation of biodiversity to climate change effects',
            'Identification / Availability of suitable areas for adaptation to climate change effects',
            'Identification / Availability of degraded areas to improve or not to contribute to climate change mitigation and adaptation to climate change in biodiversity',
            'Integration of protected areas in the general planning of mitigation and adaptation responses to climate change effects to increase the effectiveness of conservation on biodiversity',
            'Integration of mitigation and adaptation responses to climate change in the policies and legislations on environment and protected areas',
            'Integration of measures on mitigation and adaptation responses to climate change in the provision of funds for biodiversity and natural resource management',
            'Integration of mitigation and adaptation responses to in the issues of socio-economic problems of the local population'
        ],
        'module_info' => '<ul> <li>The results of this analysis help to establish the management decisions regarding the effects of climate change on conservation. The analyse helps to promote the integration of the effects of climate change in the management of the protected area</li> <li>Write down each estimation based on your information according to the scale: high; average; low; very weak</li> <li>You do not need to measure accurately the value to ratee</li> </ul>',
        'ratingLegend' => [
            'Application' => [
                '0' => 'does not apply',
                '1' => 'applies to some extent',
                '2' => 'applies',
                '3' => 'applies to a considerable extent',
            ]
        ]
    ],

    'ClimateChange' => [
        'title' => 'Climate change and conservation / Trends',
        'fields' => [
            'Value' => 'Values',
            'Description' => 'Description',
            'DesiredStatus' => 'Expected conditions',
            'Trend' => 'Trend',
            'Notes' => 'Notes',
        ],
        'groups' => [
            'group0' => 'Animal species most vulnerable to climate change',
            'group1' => 'Plant species most vulnerable to climate change',
            'group2' => 'Habitats most vulnerable to climate change',
            'group3' => 'Ecosystem services most vulnerable to climate change',
            'group4' => 'Values and importance with the most sensitive characteristics to climate change',
            'group5' => 'Other',
        ],
        'module_info' => 'Based on the list of values, the manager chooses a small number of elements to be monitored and to help assess the impact of conservation efforts in the time',
        'ratingLegend' => [
            'Trend' => [
                '-3 / -2 / -1' => 'Negative (least - most severe)',
                '0' => 'Stable',
                '1 / 2 / 3' => 'Positive (least - most significant)',
            ]
        ]

    ],

    'EcosystemServices' => [
        'title' => 'Ecosystem services and dependence of communities in the protected area on these services / Importance',
        'fields' => [
            'Element' => 'Value',
            'Importance' => 'Importance',
            'ImportanceRegional' => 'Regional Importance',
            'ImportanceGlobal' => 'Global Importance',
            'Observations' => 'Description / Condition',
        ],
        'groups' => [
            'group0' => 'Nutrition',
            'group1' => 'Materials',
            'group2' => 'Energy',
            'group3' => 'Remediation of waste materials, toxic substances and other pollution',
            'group4' => 'Remediation of flows',
            'group5' => 'Maintaining biological, chemical and physical conditions',
            'group6' => 'Physical interactions and experience',
            'group7' => 'Intellectual interactions and performances',
            'group8' => 'Spiritual and/or emblematic',
            'group9' => 'Other cultural excursions',
        ],
        'predefined_values' => [
            'group0' => ['water - illegal', 'water - legal', 'tubers, fruits, honey, mushrooms - illegal', 'tubers, fruits, honey, mushrooms - legal', 'various fibres - illegal', 'various fibres - legal', 'medicines - illegal', 'medicines - legal', 'meat, insects - illegal', 'meat, insects - legal', 'fish - illegal', 'fish - legal', 'fields - illegal', 'fields - legal', 'other - illegal', 'other - legal'],
            'group1' => ['wood for construction - illegal', 'wood for construction - legal', 'biomass fibres - illegal', 'biomass fibres - legal', 'timber - illegal', 'timber - legal', 'sand - illegal', 'sand - legal', 'other - illegal', 'other - legal'],
            'group2' => ['fuelwood - illegal', 'fuelwood - legal', 'water for energy - illegal', 'water for energy - legal', 'other - illegal', 'other - legal'],
            'group3' => ['bioremediation/regulation'],
            'group4' => ['hydrological cycle', 'flood control', 'storm protection', 'erosion control'],
            'group5' => ['protection against disease', 'general regulation of the conservation target'],
            'group6' => ['Walking, hiking and general recreation, including hunting or fishing if permitted'],
            'group7' => ['scientific', 'educational', 'cultural heritage', 'entertainment', 'aesthetic'],
            'group8' => ['symbolic', 'sacred and/or religious'],
            'group9' => ['ex situ conservation'],
        ],
        'categories' => [
            'title1' => 'Supplying',
            'title2' => 'Regulation',
            'title3' => 'Cultural',
        ],
        'module_info' => '<b>Ecosystem services and dependence of communities in the protected area on these services / Importance</b> <ul> <li>The outputs from this analysis will be used to define management decisions designed to ensure that ecosystem services are preserved. This work will help in furthering the incorporation of these values into the management systems for the protected area</li> <li>Rate each assessment on the basis of on your information, using the scale: high; medium; low; very low</li> <li>You do not need an accurate measurement of the value to assign a rating</li> <li>Specifying the nature of provisioning as legal or illegal depends on the classification category of the protected area and any customary use tolerated within the classified area</li> </ul>',
        'ratingLegend' => [
            'Importance' => [
                '0' => 'very low',
                '1' => 'low',
                '2' => 'average',
                '3' => 'high',
            ],
        ]
    ],

    'EcosystemServicesTendance' => [
        'title' => 'Ecosystem services and dependence of communities in the protected area on these services  / Trends',
        'fields' => [
            'Value' => 'Valeurs',
            'Description' => 'Description',
            'DesiredStatus' => 'Expected conditions',
            'Trend' => 'Trend',
            'Reliability' => 'Reliability',
            'Notes' => 'Notes',
        ],
        'groups' => [
            'group0' => 'Nutrition',
            'group1' => 'Materials',
            'group2' => 'Energy',
            'group3' => 'Remediation of waste materials, toxic substances and other pollution',
            'group4' => 'Remediation of flows',
            'group5' => 'Maintaining biological, chemical and physical conditions',
            'group6' => 'Physical interactions and experience',
            'group7' => 'Intellectual interactions and performances',
            'group8' => 'Spiritual and/or emblematic',
            'group9' => 'Other cultural excursions',
        ],
        'categories' => [
            'title1' => 'Supplying',
            'title2' => 'Regulation',
            'title3' => 'Cultural',
        ],
        'module_info' => '<b>Ecosystem services and dependence of communities in the protected area on these services / Trends</b> <ul> <li>Based on the list of values, the manager chooses a small number of ecosystems services to be monitored and to help assess the impact of conservation efforts in the time </li> </ul>',
        'ratingLegend' => [
            'Trend' => [
                '-1 / -2 / -3 ' => 'Negative (least - most severe)',
                '0' => 'Stable',
                ' +1 / +2 / +3' => 'Positive (least - most significant)',
            ],
            'Reliability' => [
                'High' => 'Methodology that is officially recognised',
                'Average' => 'Methodology that is not officially recognised',
                'Low' => 'Non-existent methodology, information is usually estimated',
            ],
        ]
    ],

];