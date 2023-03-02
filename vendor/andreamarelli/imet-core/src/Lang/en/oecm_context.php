<?php
return [

    'GeneralInfo' => [
        'title' => 'Basic data',
        'fields' => [
            'CompleteName' => 'Full name of the OECM',
            'UsedName' => 'Name by which OECM is referred to',
            'CompleteNameWDPA' => 'Name of the OECM in the WDPA site',
            'WDPA' => 'WDPA',
            'Type' => 'typology',
            'Country' => 'Country',
            'CreationYear' => 'Year created',
            'ReferenceText' => 'Reference to the designation of the gazetting text',
            'Ownership' => 'OECM ownership type',
            'Importance' => 'What are the main values for which the area has been designated? (Provide a list and then a brief description)',
        ],
        'module_info' => '<b>Introduction to typology</b>: IMET identifies three categories of conserved areas: (1) Terrestrial protected area (2)
            Marine and Coastal protected area (3) OECM - Other Effective Conservation Measures (OECM).<br />
            This IMET analyses the management of an OECM defined as “A geographically defined area other than a Protected Area,
            which is governed and managed in ways that achieve positive and sustained long-term outcomes for the in-situ conservation of biodiversity,
            with associated ecosystem functions and services and where applicable, cultural, spiritual, socio–economic,
            and other locally relevant values” (CBD, 2018). OECMs include community forests,
            indigenous peoples and community conserved territories and areas (ICCAs), locally managed marine areas (LMMAs),
            and many other types of conserved areas.<br/> What is the difference between a protected area and an OECM? (Source WDPA)
            Protected areas and OECMs have many similarities, such as the requirement of a geographically-defined boundary and a long-term commitment.
            But while protected areas are places designated to achieve positive biodiversity outcomes,
            the term ‘OECM’ applies to areas designated for any purpose, where positive biodiversity outcomes occur regardless of the original management objectives.
            In a protected area, conservation must be the primary, or joint-primary, objective.
            In an OECM, it may be a secondary objective or not an explicit objective at all.<br/>
            OECMs also encompass areas that meet the definition of a protected area,
            in cases where the governance authority prefers the area to be considered an OECM.<br/>
            <strong>If your site is protected area, please use the IMET for Protected Area</strong>',
    ],

    'Governance' => [
        'title' => 'Governance and Management Entity',
        'fields' => [
            'Stakeholder' => 'Stakeholder',
            'StakeholderType' => 'Kind of institution',
            'GovernanceModel' => 'Governance model',
            'AdditionalInfo' => 'Additional information on governance model (if needed)',
            'ManagementUnique' => 'Determine the entity in charge of the management and governance of the OECM',
            'ManagementName' => 'Name',
            'ManagementList' => 'List of entities involved in the daily management and governance (do not list partners)',
            'ManagementType' => 'Type',
            'DateOfCreation' => 'Date of creation',
            'OfficialRecognition' => 'Official Recognition: Has the Management Entity received an official recognition from the national or regional authorities?',
            'SupervisoryInstitution' => 'Supervisory Institution (if any)',
        ],
        'governance' => 'Governance',
        'stakeholders' => 'Stakeholders',
        'management' => 'Management Entity',
    ],

    'SpecialStatus' => [
        'title' => 'Special designations (World Heritage, MAB, Ramsar site, IBAs, SPAMI, LMMA, etc. )',
        'fields' => [
            'Designation' => 'Designation',
            'RegistrationDate' => 'Date of inscription',
            'Code' => 'Code',
            'Area' => 'Area (ha)',
            'DesignationCriteria' => 'Criteria for designation',
            'upload' => 'upload',
        ],
        'groups' => [
            'conventions' => 'Designations (inclusions) in the international conventions list (World Heritage, RAMSAR, etc.)',
            'networks' => 'Membership of an officially recognized international network (MAB, RAPAC etc.)',
            'conservation' => 'Designation for the status of conservation importance by international bodies (IBA, AZE, etc.)',
            'marine_pa' => 'Designation of marine OECMs',
        ]
    ],

    'Networks' => [
        'title' => 'Membership of a local management network',
        'fields' => [
            'NetworkName' => 'Name',
            'ProtectedAreas' => 'Names of other OECMs or protected area within the network',
        ],
        'groups' => [
            'group0' => 'Transboundary network',
            'group1' => 'Landscape network (terrestrial and marine OECMs)',
            'group2' => 'Other networks',
        ]
    ],

    'Missions' => [
        'title' => 'Vision - Mission - Objectives',
        'fields' => [
            'LocalVision' => 'At local or national level Vision',
            'LocalMission' => 'Mission',
            'LocalObjective' => 'Objectives',
            'LocalSource' => 'Source',
            'Observation' => 'Observation',
        ]
    ],

    'Contexts' => [
        'title' => 'References of historical, political, legal and institutional and socio-economic contexts of the OECM',
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
            'Political context (country)',
            'Legal context',
            'Institutional context'
        ],
        'module_info' => 'Data at national level with verification at local level'
    ],

    'Objectives' => [
        'title' => 'Setting objectives',
        'fields' => [
            'Element' => 'Element/Indicator',
            'Status' => 'Baseline',
            'Objective' => 'Objective - Long term Targets/Goals',
            'Comments' => 'Comments'
        ]
    ],

    'Objectives1' => [
        'module_info' => 'Establish and describe conservation objectives for the governance, partnerships and the designation <b>of the OECM</b><br /> The objectives provided below will be used for improving management, and more specifically for planning, resource (input) mobilisation, process phases, and for monitoring of management activities of the OECM'
    ],

    'Objectives2' => [
        'module_info' => 'Establish and describe conservation objectives for <b>the area of the OECM</b><br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the OECM'
    ],

    'Objectives3' => [
        'module_info' => 'Establish and describe conservation objectives for<b> human and financial resources/support from partnerships in managing </b>of the OECM<br/> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the OECM'
    ],

    'Objectives4' => [
        'module_info' => 'Establish and describe conservation objectives for key factors: <b> i) animal species ii) plant species; iii) habitats and iv) land-cover change </b> of the OECM<br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the OECM.'
    ],

    'Objectives5' => [
        'module_info' => 'Establish and describe management objectives to <b>improve access and governance of key elements</b> of the OECM.<br/>The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the OECM'
    ],

    'Objectives6' => [
        'module_info' => 'Establish and describe objectives for <b>climate change effects</b> of the OECM<br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the OECM'
    ],

    'GeographicalLocation' => [
        'title' => 'Localisation',
        'fields' => [
            'LimitsExist' => 'Existence of georeferenced official limits (yes / no)',
            'Shapefile' => 'GIS file',
            'SourceSHP' => 'Source of GIS file',
            'Coordinates' => 'Geographic coordinates (baseline for or key point in the park)',
            'SourceCoords' => 'Source',
            'AdministrativeLocation' => 'Administrative location of the OECM (province, region, etc.)',
        ]
    ],

    'Areas' => [
        'title' => 'Surface area of the OECM and conservation context',
        'fields' => [
            'AdministrativeArea' => 'Administrative surface',
            'WDPAArea' => 'Surface according to WDPA',
            'GISArea' => 'Actual surface (GIS for the park or the authority responsible for OECMs) corresponding to the uploaded file',
            'TerrestrialArea' => 'Terrestrial OECM, Community Forest, ICCAs, Other',
            'MarineArea' => 'Marine and coastal OECM, ICCAs, LMMA, Other'
        ]
    ],

    'ManagementStaff' => [
        'title' => 'Composition and staff or members of the OECM Management and Governance Specified Entity or Combination of entities (identified in CTX 1.2).',
        'fields' => [
            'Function' => 'Functions',
            'Number' => 'Number',
            'Male' => 'Male',
            'Female' => 'Female',
            'Descriptions' => 'Descriptions',
            'AdequateNumber' => 'Adequate number',
        ],
        'module_info' => 'Number and categories of members of the OECM Management Entity'
    ],

    'ManagementStaffPartners' => [
        'title' => 'Size and composition of staff: Staff from partner organisations',
        'fields' => [
            'Partner' => 'Partners',
            'Coordinators' => 'Coordinators (number)',
            'Technicians' => 'Technical and administrative staff (number)',
            'Auxiliaries' => 'Auxiliary staff (number)',
        ]
    ],

    'ManagementRelativeImportance' => [
        'title' => 'Relative importance of staff and stakeholders in management',
        'fields' => [
            'RelativeImportance' => 'Relative importance of staff and stakeholders'
        ],
        'ratingLegend' => [
            'RelativeImportance' => [
                '-3' => 'All decisions are made by staff',
                '-2' => 'Most decisions are made by staff',
                '-1' => 'Majority of decisions are made by staff',
                '0' => 'There is equal contribution of staff and stakeholders to decision-making',
                '1' => 'Majority of decisions are made by stakeholders',
                '2' => 'Most decisions are made by stakeholders',
                '3' => 'All decisions are made by stakeholders',
            ]
        ]
    ],

    'FinancialResources' => [
        'title' => 'Financial resources: Budget and management costs',
        'fields' => [
            'Currency' => 'Currency',
            'TotalAnnualBudgetAvailable' => 'Total annual budget available',
        ],
        'module_info' => 'Estimated total management costs of the OECM '
    ],

    'Equipments' => [
        'title' => 'Availability of infrastructure, equipment and facilities',
        'fields' => [
            'Resource' => 'Category',
            'AdequacyLevel' => 'Adequacy',
            'Comments' => 'Source / Note'
        ],
        'groups' => [
            'group0' => 'Administrative buildings',
            'group1' => 'Tourism facilities',
            'group2' => 'Means of transport',
            'group3' => 'Field equipment',
            'group4' => 'Means of communication',
            'group5' => 'IT',
            'group6' => 'Power generation equipment',
            'group7' => 'Roads and tracks',
            'group8' => 'Waterways',
            'group9' => 'Links and connections of the OECM with the outer world'
        ],
        'predefined_values' => [
            'group0' => ['Offices', 'Information centre', 'Miscellaneous services (magazine, etc.)', 'Health care centre'],
            'group1' => ['Hotels (guests capacity)', 'Eco-lodges (total capacity - guests)', 'Encampments (total capacity - guests)', 'Available tourist routes (km)', 'Trails'],
            'group2' => ['Cars', 'Motorbike/Quads', 'Bicycles', 'Boats', 'Outboard motors', 'Pirogues'],
            'group3' => ['Working unit', 'GPS, compasses', 'Camping equipment'],
            'group4' => ['VHF/HF radios', 'V-SAT', 'GSM telephones', 'Internet connection'],
            'group5' => ['Desktop computers', 'Laptop computers', 'Printers', 'Photocopiers'],
            'group6' => ['Power generators', 'Solar electric facility', 'Hydropower electric facility', 'Wind electric facility'],
            'group7' => ['Roads/tracks inside the OECM', 'Paths inside the OECM', 'Road along the border'],
            'group8' => ['Waterways inside the OECM'],
            'group9' => ['Major land-based communication routes', 'Inland and maritime waterways']
        ],
        'ratingLegend' => [
            'AdequacyLevel' => [
                '0' => 'Fully inadequate (0-30% of the needs)',
                '1' => 'Somewhat inadequate (31-60% of the needs)',
                '2' => 'Adequate (61-90% of the needs)',
                '3' => 'Fully adequate (91-100% of the needs)',
            ]
        ]
    ],

    'AnimalSpecies' => [
        'title' => 'Animal species (exploited, protected, disappearing, invasive)',
        'fields' => [
            'SpeciesID' => 'Species',
            'ExploitedSpecies' => 'EXP',
            'ProtectedSpecies' => 'PRT',
            'DisappearingSpecies' => 'DSG',
            'InvasiveSpecies' => 'INV',
            'PopulationEstimation' => 'Estimated status',
            'DescribeEstimation' => 'Describe the optimum status',
            'Comments' => 'Source / Note',
        ],
        'module_info' => '<b>Species types</b> <ul>
            <li><b>EXP</b>: Exploited species</li>
            <li><b>PRT</b>: Protected species</li>
            <li><b>DSG</b>: Disappearing species</li>
            <li><b>INV</b>: Invasive species</li></ul>',
        'validation_min3' => 'Please encode not less than 3 key species'
    ],

    'VegetalSpecies' => [
        'title' => 'Plant species (exploited, protected, disappearing, invasive)',
        'fields' => [
            'SpeciesID' => 'Species',
            'ExploitedSpecies' => 'EXP',
            'ProtectedSpecies' => 'PRT',
            'DisappearingSpecies' => 'DSG',
            'InvasiveSpecies' => 'INV',
            'PopulationEstimation' => 'Estimated status',
            'DescribeEstimation' => 'Describe the optimum status',
            'Comments' => 'Source / Note',
        ],
        'module_info' => '<b>Species types</b> <ul>
            <li><b>EXP</b>: Exploited species</li>
            <li><b>PRT</b>: Protected species</li>
            <li><b>DSG</b>: Disappearing species</li>
            <li><b>INV</b>: Invasive species</li></ul>'
    ],

    'Habitats' => [
        'title' => 'Habitats selected as indicators for the OECM and that will need to be monitored over time',
        'fields' => [
            'EcosystemType' => 'Habitats types',
            'ExploitedSpecies' => 'EXP',
            'ProtectedSpecies' => 'PRT',
            'DisappearingSpecies' => 'DSG',
            'PopulationEstimation' => 'Estimated status',
            'DescribeEstimation' => 'Describe the optimum status',
            'Comments' => 'Source / Note',
        ],
        'module_info' => '<b>Species types</b><ul>
                <li><b>EXP</b>: Exploited</li>
                <li><b>PRT</b>: Protected</li>
                <li><b>DSG</b>: Disappearing</li></ul>'
    ],

    'StakeholdersNaturalResources' => [
        'title' => 'Stakeholders involved or impacting in the use of natural resources of the OECM',
        'fields' => [
            'Element' => 'Stakeholder',
            'GeographicalProximity' => 'Geographical proximity to the OECM',
            'Engagement' => 'Engagement with OECM\'s NR',
            'Impact' => 'Impact on NR in the OECM',
            'Role' => 'Role in NR management in the OECM',
            'InvolvementM' => 'M',
            'InvolvementME' => 'ME',
            'InvolvementE' => 'E',
            'InvolvementCAE' => 'CAE',
            'Comments' => 'Note',
        ],
        'titles' => [
            'title0' => 'Community/group or other',
            'title1' => 'Economic operators',
            'title2' => 'Government',
            'title3' => 'NGOs, Scientists and Donors',
        ],
        'groups' => [
            'group0' => 'Traditional authorities (Identify the traditional authorities)',
            'group1' => 'Indigenous peoples and local communities (IPLCs*) (Identify the ILPCs community/group)',
            'group2' => 'Not Indigenous peoples and local communities (IPLCs) (Identify the not ILPCs community/group)',
            'group3' => 'Disadvantaged groups, minorities, …) (Identify the disadvantaged groups as women’s associations, youth groups, etc.)',
            'group4' => 'Other Community/group (Identify others community/group)',
            'group5' => 'IPLCs operating in market economy of natural resources (Identify groups of IPLCs operating in market economy of timber, non-timber, fisheries, medicinal plant, tourism, etc.)',
            'group6' => 'NOT IPLCs operating in market economy of natural resources (Identify groups of not IPLCs operating in market economy of forest, fishing, tourism, agriculture, mining -coal, diamonds, water, sand etc., etc.)',
            'group7' => 'Local authorities (Identify local elected and appointed officials and parliament members, territorial / departmental and municipal council, land services environment services, etc.)',
            'group8' => 'National authorities (Identify national Ministry or department in charge of NR management Central government Armed forces (paramilitary police force and navy, etc.)',
            'group9' => 'NGOs (Identify Social rights NGO, Environmental NGO, Development NGO, etc.)',
            'group10' => 'Scientists/Researchers (Identify scientists/researchers, etc.)',
            'group11' => 'Donors (Identify private and public donors, etc.)',

        ],
        'ratingLegend' => [
            'Impact' => [
                '0' => 'No impact',
                '1' => 'Low impact',
                '2' => 'Medium impact',
                '3' => 'High impact',
            ],
            'Role' => [
                '0' => 'No role',
                '1' => 'Little role (e.g., only advice)',
                '2' => 'Medium role (some mix of advice, analysis, planning, implementation and monitoring)',
                '3' => 'High role (advise +analysis + planning + implementation + monitoring)',
            ]
        ],
        'module_info' =>
            'Select (A) the areas in which the stakeholders are involved in managing the OECM and evaluate:<ul>
                <li><b>M</b>: management</li>
                <li><b>ME</b>: management and exploitation</li>
                <li><b>E</b>: exploitation</li>
                <li><b>CAE</b>: community awareness and engagement</li></ul>',

        'warning_on_save' => 'WARNING!! <br /> Any modification might cause data loss in the following modules(if already encoded): <i>C2</i>'
    ],

    'AnalysisStakeholderAccessGovernance' => [
        'title' => 'Analysis per stakeholder',
        'fields' => [
            'Element' => 'Criteria',
            'Dependence' => 'Dependence',
            'Access' => 'Access',
            'Rivalry' => 'Rivalry',
            'Involvement' => 'Involvement',
            'Accountability' => 'Accountability',
            'Orientation' => 'Orientation',
            'Comments' => 'Note/Description',
        ],
        'titles' => [
            'title0' => 'Key animals and plants species in the OECM',
            'title1' => 'Key Provisioning services',
            'title2' => 'Key Cultural services',
            'title3' => 'Key Regulating services',
            'title4' => 'Key supporting services (services which enable other services)',
        ],
        'groups' => [
            'group0' => 'Animals',
            'group1' => 'Plants',
            'group2' => 'Habitats',
            'group3' => 'Provisioning-Nutrition',
            'group4' => 'Provisioning-Water',
            'group5' => 'Provisioning-Materials',
            'group6' => 'Provisioning-Energy',
            'group7' => 'Aesthetic appreciation, recreation, and tourism',
            'group8' => 'Intellectual interactions and performances',
            'group9' => 'Spiritual and/or emblematic',
            'group10' => 'Remediation of air and water pollutants',
            'group11' => 'Erosion prevention and maintenance of soil fertility',
            'group12' => 'Provisioning lands (agriculture, livestock, forests)',
            'group13' => 'Habitats for animals and plants',
        ],
        'predefined_values' => [
            'group3' => ['Nutrition: human food vegetal (tubers, fruits, honey, mushrooms, seaweed, etc.)', 'Human food animal (wild/farmed meat, insects, etc.)', 'Medicines and blue biotechnology (fish oil)', 'Fish/livestock feed (wild, farmed, bait)'],
            'group4' => ['Nutrition: drinking water', 'water for hygiene, water for agriculture, water for fish/livestock water for energy'],
            'group5' => ['High value timber', 'Timber for local construction', 'Stems - fibres (palms, kenaf, etc.)', 'Other fibres (leaves, kapok, coco, etc.)', 'Ornamental and aquarian resources (seeds, shells and fish collection)', 'Sand (building)'],
            'group6' => ['Fuelwood and biofuels', 'Wind for energy', 'Fertiliser'],
            'group7' => ['Aesthetic benefits', 'Ecotourism and nature watching', 'Walking, hiking and general recreation', 'Boating, swimming and diving', 'Hunting or fishing if permitted', 'Specified traditional fishing'],
            'group8' => ['Science – Research', 'Educational', 'Cultural heritage'],
            'group9' => ['Symbolic or historic', 'Sacred or religious'],
            'group10' => ['Air quality', 'Water purification', 'Waste removal/neutralisation', 'Waste regulation'],
            'group11' => ['Flood control', 'Prevention of coastal erosion', 'Drought control', 'Storm protection', 'Water erosion control', 'Wind erosion control', 'Prevention of coastal erosion'],
            'group12' => ['Soil formation, structure and fertility', 'Grazing lands, Woodland habitats'],
            'group13' => ['Bird nesting sites – sea/river/lake spawning grounds - Nursery habitats (e.g. corals, bees, etc.)', 'Plants for pollination, etc.)']
        ],
        'module_info' =>
            '<b>Dependence</b>: Dependence of the stakeholder’s human well-being on the OECM’ key element</br >' .
            '<b>Access</b>: Access rules to be applied by stakeholders in the management (or operation?) of OECM’ key elements</br >' .
            '<b>Rivalry</b>: Conflict in the use of the OECM’ key element due to a lack of access regulations, insufficient resources, etc.</br >' .
            '<b>Involvement</b>: Stakeholder’ involvement in the governance of the OECM’ key element. Is your community / group involved in management of the OECM with regards to the key elements?</br >' .
            '<b>Accountability</b>: Stakeholder’ accountability in the governance and management of the OECM’ key element. Is your community or group committed to following the rules and taking accountability for the results of your operations to all stakeholders to ensure good management and governance of the key elements of the OECM?</br >' .
            '<b>Orientation</b>: Stakeholders contribution to long-term objectives orientation of the OECM’ key element. Is your community or group dedicated to achieving the common long-term management and governance goals based on the equity and sustainable use of the OECM\'s key elements by all stakeholders?</br >',
            '<b>Note/Description</b>: Record important information on access and governance</br >',
        'ratingLegend' => [
            'Dependence' => [
                '0' => 'Very low',
                '1' => 'Low',
                '2' => 'Medium',
                '3' => 'High',
            ],
        ],
        'warning_on_save' =>
            'WARNING!! <br /> Any modification might cause data loss in the following modules(if already encoded): <i>CTX 6.1</i>, <i>C1.2</i> and <i>I1</i>'
    ],

    'AnalysisStakeholderTrendsThreats' => [
        'title' => 'Trends and threats on key elements – A stakeholder analysis',
        'fields' => [
            'Element' => 'Criteria',
            'Status' => 'Status',
            'Trend' => 'Dependence',
            'MainThreat' => 'Main threats',
            'ClimateChangeEffect' => 'Effects of climate change',
            'Comments' => 'Note/Description',
        ],
        'module_info' =>
            '<b>Status</b>: Estimation of current status</br >' .
            '<b>Trend</b>: Trend in the quantity or quality</br >' .
            '<b>Effects of climate change</b>: Change in quality, quantity and ecosystem production due to climate factors (precipitation, temperature, extreme events)</br >',
        'ratingLegend' => [
            'Status' => [
                '-2' => 'Very bad',
                '-1' => 'Bad',
                '0' => 'Neutral',
                '1' => 'Good',
                '2' => 'Very good',
            ],
            'Trend' => [
                '-2' => 'Strongly decreasing',
                '-1' => 'Decreasing',
                '0' => 'No change',
                '1' => 'Increasing',
                '2' => 'Strongly Increasing',
            ],
            'ClimateChangeEffect' => [
                '-2' => 'Very harmful',
                '-1' => 'Harmful',
                '0' => 'No change',
                '1' => 'Beneficial',
                '2' => 'Very beneficial',
            ],
        ],
    ],

];
