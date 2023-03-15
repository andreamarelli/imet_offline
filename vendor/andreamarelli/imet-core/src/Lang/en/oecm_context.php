<?php
return [

    'Create' => [
        'title' => 'Create a new IMET OECM (WDPA)',
        'fields' => [
            'version' => 'IMET version',
            'Year' => 'Year subject to evaluation',
            'wdpa_id' => 'OECM',
            'language' => 'language',
            'prefill_prev_year' => 'prefill with previous year',
        ]
    ],

    'CreateNonWdpa' => [
        'title' => 'Create a new IMET OECM (non-WDPA)',
        'fields' => [
            'version' => 'version',
            'Year' => 'Year subject to evaluation',
            'wdpa_id' => 'protected area',
            'language' => 'language',
            'prefill_prev_year' => 'prefill with previous year',
            'pa_def' => 'definition',
            'name' => 'name as provided by the operator',
            'origin_name' => 'name in original language',
            'designation' => 'name of designation (ex. reserve, sanctuary park, etc.)',
            'designation_eng' => 'designation in English',
            'designation_type' => 'designation type',
            'marine' => 'typology',
            'rep_m_area' => 'surface of the protected conserved marine area [km<sup>2</sup>]',
            'rep_area' => 'surface of the protected conserved area [km<sup>2</sup>]',
            'status' => 'status',
            'ownership_type' => 'Ownership type',
            'status_year' => 'year of the enactment',
            'country' => 'country',
        ],

        'allowed_international' => 'Allowed values for international-level designations',
        'allowed_regional' => 'Allowed values for regional-level designations',
        'allowed_national' => 'No fixed values for protected areas designated at a national level',
    ],

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
            'marine_pa' => 'Other designations',
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
            'Element' => 'Objective',
            'ShortOrLongTerm' => 'Short/Long term',
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
        'title' => 'Relative involvement of staff and stakeholders in management',
        'fields' => [
            'RelativeImportance' => 'Relative involvement of staff and stakeholders'
        ],
        'staff' => 'staff',
        'stakeholders' => 'stakeholders',
        'equal' =>  'majority by',
        'majority_by' =>  'equal',
        'most_by' =>  'most by',
        'all_by' =>  'all by',
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
            'group0' => ['Offices', 'Information centre', 'Service buildings (magazine, etc.)', 'Health care centre'],
            'group1' => ['Hotels (guests capacity)', 'Eco-lodges (total capacity - guests)', 'Encampments (total capacity - guests)', 'Available tourist routes (km)', 'Trails'],
            'group2' => ['Cars', 'Motorbike/Quads', 'Bicycles', 'Boats', 'Outboard motors', 'Pirogues'],
            'group3' => ['Equipment for community field work', 'GPS, compasses', 'Camping equipment'],
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
        'title' => 'Stakeholders involved in management or impacting in the use of natural resources of the OECM',
        'fields' => [
            'Element' => 'Stakeholder',
            'GeographicalProximity' => 'Living inside or in proximity to the OECM (less than a day\'s walk)',
            'Engagement' => 'Typology of management / use of OECM\'s NR',
            'Impact' => 'Level of management or impact on NR',
            'Role' => 'Role in NR management',
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
                '0' => 'No engagement',
                '1' => 'Low engagement',
                '2' => 'Medium engagement',
                '3' => 'High engagement',
            ],
            'Role' => [
                '0' => 'No role',
                '1' => 'Little role (e.g., only advice)',
                '2' => 'Medium role (some mix of advice, analysis, planning, implementation and monitoring)',
                '3' => 'High role (advise +analysis + planning + implementation + monitoring)',
            ]
        ],

        'warning_on_save' => 'WARNING!! <br /> Any modification might cause data loss in the following modules(if already encoded): <i>C2</i>'
    ],

    'AnalysisStakeholderAccessGovernance' => [
        'title' => 'Analysis per stakeholder',
        'fields' => [
            'Element' => 'Criteria',
            'Description' => 'Specific element assessed',
            'Dependence' => 'Dependence',
            'Access' => 'Access',
            'Rivalry' => 'Rivalry',
            'Involvement' => 'Involvement',
            'Accountability' => 'Accountability',
            'Orientation' => 'Orientation',
            'Comments' => 'Note',
        ],
        'titles' => [
            'title0' => 'Key animals and plants species in the OECM',
            'title1' => 'Key Provisioning services',
            'title2' => 'Key Cultural services',
            'title3' => 'Key Regulating services',
            'title4' => 'Key supporting services (services which enable other services)',
        ],
        'biodiversity' => 'Biodiversity',
        'ecosystem_services' => 'Ecosystem Services',
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
        'groups_descriptions' => [
            'group0' => '',
            'group1' => '',
            'group2' => '',
            'group3' =>
                '<p>The provision of ecosystem services - nutrition refers to the provision of food that is essential for human health and well-being. 
                    It is important to understand and manage the provision of food by maintaining the health of ecosystems through the conservation of soil and water, 
                    forests, biodiversity, etc. Example of ecosystem services provisioning – nutrition</p>
                    <ul>
                        <li>Human food vegetal as grains, tubers, fruits, honey, mushrooms, seaweed, etc</li>
                        <li>Human food animal as wild/farmed meat, eggs, insects, fish/livestock feed (wild, farmed, bait), etc.</li>
                        <li>Medicines (quinine against malaria, herbal supplements, aromatic oils, anti-venoms, etc.) and blue biotechnology (fish oil)</li>
                    </ul>',
            'group4' =>
                '<p>The provision of ecosystem services - water includes the provision of clean water for drinking, human use and irrigation. Managing water supply involves 
                    protecting watersheds, wetlands and other aquatic ecosystems, promoting sustainable water use practices and reducing water pollution and degradation. 
                    Example of ecosystem services provisioning - water</p>
                    <ul>
                        <li>Water supply and quality for human use: consumption, sanitation, and hygiene.</li>
                        <li>Water for irrigation for crops or other agricultural activities and for fish/livestock consumption</li>
                        <li>Water storage which can be accessed during periods of drought or low water availability</li>
                     </ul>',
            'group5' =>
                '<p>The provision of ecosystem services - materials includes the provision of wood, fibres, and other materials that 
                    are used for construction, and manufacturing. Managing ecosystem involves promoting sustainable harvesting practices 
                    and exploring alternative materials and technologies. Example of ecosystem services provisioning – materials</p>
                    <ul>
                        <li>Timber as high value timber; timber for local construction, stakes, stems, etc.</li>
                        <li>Fibres from plants, such as cotton, flax, palms, kenaf, etc.</li>
                        <li>Ornamental in general and aquarian resources (seeds, shells and fish collection), </li>
                        <li>Minerals as gold, silver, copper, sand (building), etc.</li>
                     </ul>',
            'group6' =>
                '<p>The provision of ecosystem services-energy includes the use of biomass, such as firewood or crop residues, and solar or 
                    wind energy and other energy needs as fertiliser helps to provide essential services such as cooking, heating, lighting 
                    and for agriculture productivity in rural communities that may lack access to modern energy sources. The sustainable management 
                    of natural systems, such as forests and agricultural land, is critical to ensure the availability of these services. 
                    Example of ecosystem services</p>
                    <ul>
                        <li>Biomass from plant materials such as wood, crop residues, and grasses that can be burned or converted into biofuels to produce energy.</li>
                        <li>Biomass to convert in fertiliser</li>
                        <li>Other green electricity sources: Flowing water, wind, solar or geothermal that can be harnessed to generate electricity.</li>
                     </ul>',
            'group7' =>
                '<p>The provision of ecosystem services – cultural services refers to the benefits that natural systems provide for the enjoyment and well-being of people. 
                    These benefits can include opportunities for outdoor recreation, such as hiking, camping and wildlife viewing, as well as the aesthetic beauty of 
                    natural landscapes, such as mountains, forests and beaches. Ecosystem services for aesthetic appreciation, recreation, and tourism can contribute 
                    to local economies through the development of ecotourism and other nature-based industries. It is important to ensure the availability of these 
                    ecosystem services for future generations. Example of ecosystem services</p>
                    <ul>
                        <li>Ecotourism and nature watching: beautiful landscapes or seascapes, natural landscapes, biodiversity and wildlife that can be enjoyed for 
                        general recreation, camping, walking, hiking, boating, swimming, wildlife watching and other recreational activities.</li>
                        <li>Cultural tourism which involves visiting historical sites, landmarks, and cultural attractions that are located within natural areas.</li>
                        <li>Traditional hunting or fishing, conserved areas for specified traditional hunting or fishing practices</li>
                     </ul>',
            'group8' =>
                '<p>The provision of ecosystem services – cultural services refer to the benefits that natural systems provide for education, research, and 
                    artistic expression. These benefits can include opportunities for scientific research, environmental education, and cultural activities 
                    that are inspired by or conducted in natural settings. These services can contribute to the development of human knowledge, cultural 
                    heritage, and creative expression, which are important for personal and societal well-being. Sustainable management of natural systems
                     is essential to ensure the availability of these ecosystem services for future generations. Example of ecosystem services</p>
                    <ul>
                        <li>Educational opportunities and scientific research in many disciplines, including ecology, botany, and zoology to understand scientific concepts and ecological processes.</li>
                        <li>Traditional practices and ecological knowledge that are important part of the community\'s identity and heritage related to nature and the environment such as traditional pharmacopeia, medicines</li>
                        <li>Inspiration and creativity for artists, writers, photographers and other creatives to develop new ideas and works.</li>
                     </ul>',
            'group9' =>
                '<p>The provision of ecosystem services – cultural services for spiritual and emblematic are those that provide cultural and symbolic 
                    value to human societies. Spiritual ecosystem services may include the aesthetic and emotional experiences that people derive from 
                    nature. Emblematic ecosystem services are those that are associated with a particular cultural identity or icon. These services 
                    are important for human well-being and cultural identity. Example of ecosystem services</p>
                    <ul>
                        <li>Sacred, historical or religious sites and pilgrimage destinations such as mountains, rivers, or forests, etc.</li>
                        <li>Cultural icons and symbols as animal or plant species as Lion (in Kenya which is a symbol of courage and strength), Elephants, Crested Crane (in Uganda a bird which represents the country\'s natural beauty and grace) or Baobab tree, etc.</li>
                        <li>Landscapes that have spiritual or cultural significance for communal identity.</li>
                     </ul>',
            'group10' =>
                '<p>The provision of ecosystem services - remediation of air and water pollutants involves the protection of ecosystems to reduce 
                    pollution and degradation, and the purification of water and air through natural processes. Examples of how habitats provide 
                    those ecosystem services</p>
                    <ul>
                        <li>Wetlands are highly effective at removing pollutants from water, such as excess nutrients, heavy metals, and organic compounds.</li>
                        <li>Forests can help to reduce air pollution by absorbing and filtering airborne pollutants and producing oxygen helping to mitigate climate change.</li>
                        <li>Vegetation zones can help to filter and contribute to water purification, waste removal/neutralisation, waste regulation, etc.</li>
                     </ul>',
            'group11' =>
                '<p>The provision of ecosystem services – erosion prevention and maintenance of soil fertility refers to the protection of soil by 
                    the vegetation from the physical forces of wind and water, which can lead to the loss of topsoil and nutrients. Maintenance 
                    of soil fertility refers to the processes that maintain the nutrient content and structure of soil. These services are important 
                    for the sustainability of agriculture, forestry, and other land-based industries, and help to maintain the health and productivity 
                    of ecosystems. Example of ecosystem services </p>
                    <ul>
                        <li>Flood control: wetlands act as natural sponges, rivers and streams provide channels for excess water, vegetation 
                        and forests help absorb rainfall and slow down water flow, floodplains absorb excess water during floods and storm protection</li>
                        <li>Erosion control: vegetation help hold soil in place, their roots stabilize the soil, soil structure resist to the erosion, 
                        wetlands reduce erosion by controlling runoff and windbreaks or vegetation barriers adjacent to streams and rivers prevent erosion (coastal erosion, water erosion, wind erosion)</li>
                        <li>Drought control: Soil health and vegetation cover play a crucial in drought control by regulating the water cycle, reducing water loss and maintaining water</li>
                        <li>Storm control: Trees and help to reduce the impact of storms, natural barriers as mountains or islands can act as barriers to 
                        storms or absorbing some of the energy from waves, bodies of water help to moderate temperatures, which can reduce the severity of storms.</li>
                     </ul>',
            'group12' =>
                '<p>Ecosystem services of provisioning productivity for agriculture, livestock, and forests refer to the benefits that natural ecosystems 
                    provide to support the production and productivity of these systems. These services include the maintenance of soil fertility, 
                    nutrient cycling, water availability and regulation, and pest and disease control. These provisioning services are essential 
                    for sustaining the productivity of agricultural, livestock, and forestry systems while minimizing the use of synthetic inputs 
                    and preserving natural resources. Example of ecosystem services</p>
                    <ul>
                        <li>Soil formation, structure and fertility for growing crops, producing timber, raising livestock, etc.</li>
                        <li>Water availability and regulation</li>
                        <li>Pest and disease control</li>
                     </ul>',
            'group13' =>
                '<p>Ecosystem services of habitats for animals and plants refer to the benefits that natural ecosystems provide to support the 
                    survival and reproduction of wildlife species and plant communities. These services include the provision of suitable habitat 
                    for various species, such as food, shelter, and breeding sites. Protecting and conserving natural habitats is therefore essential 
                    for ensuring the long-term viability of wildlife species and plant communities, as well as for maintaining the many benefits 
                    that ecosystems provide to human societies. Example of ecosystem services </p>
                    <ul>
                        <li>Nursery and nesting habitats: Ecosystems provide habitats for a wide variety of plant and animal species, including 
                        foraging areas and shelter from predators, such as bird nesting sites, spawning grounds in the sea, rivers and lakes, 
                        nursery habitats (e.g. corals, bees, etc.), etc.</li>
                        <li>Habitats for pollination: Woodland and vegetation areas provide support for pollinators such as bees, butterflies and 
                        hummingbirds which provide an important ecosystem service for agriculture as they help plants to produce fruit, seeds and 
                        other reproductive structures. </li>
                     </ul>',
        ],
        'predefined_values' => [
            'group3' => ['Human food vegetal', 'Human food animal', 'Medicines'],
            'group4' => ['Water supply and quality for human use', 'Water for irrigation', 'Water storage'],
            'group5' => ['Timber', 'Fibres', 'Ornamental and aquarian resources', 'Minerals'],
            'group6' => ['Biomass for energy', 'Biomass for fertilization', 'Other green electricity sources'],
            'group7' => ['Ecotourism and nature watching', 'Cultural tourism', 'Traditional hunting or fishing'],
            'group8' => ['Educational opportunities and scientific research', 'Traditional practices and ecological knowledge', 'Inspiration and creativity'],
            'group9' => ['Sacred, historical or religious sites', 'Cultural icons and symbols', 'Landscapes with spiritual value'],
            'group10' => ['Water and air purification', 'Waste regulation and removal'],
            'group11' => ['Flood control', 'Erosion control', 'Drought control', 'Storm control'],
            'group12' => ['Provisioning fertility', 'Provisioning water', 'Provisioning disease control'],
            'group13' => ['Nursery and nesting habitats', 'Habitats for pollination']
        ],
        'module_info' =>
            '<p>Identify key elements for your group, and assess its importance and its management/governance from your own perspective</p>' .
            '<b>Dependence</b>: A stakeholder\'s dependence on ecosystem services refers to the extent to which subsistence, income, and cultural identity depend on natural resources and ecological processes. Therefore, understanding and managing the dependence of stakeholders on ecosystem services is essential for achieving sustainable development and conservation goals.</br >' .
            '<b>Access</b>: A stakeholder\'s access to ecosystem services refers to their ability to benefit from the natural resources and services provided by ecosystems. If a stakeholder does not have access to these services, their livelihoods and well-being are at risk and they may face poverty, food insecurity and health problems.</br >' .
            '<b>Rivalry</b>: The stakeholders\’ rivalry in the ecosystem services refers to the competition or conflict between individuals or stakeholders over access or interests and priorities in the management and use of these services. Rivalry can lead to overuse or depletion of resources, exacerbating environmental degradation and undermining the long-term availability of these services for the community or communities.</br >' .
            '<b>Involvement</b>: The stakeholders\’ involvement in the management of ecosystem services refers to the participation and engagement of each stakeholder in the planning, decision-making, and implementation to ensure that they have a voice in decisions that affect their livelihoods, as well as to promote the long-term sustainability of the ecosystem services on which they depend.</br >' .
            '<b>Accountability</b>: The stakeholders\’ accountability refers to the responsibility of individuals or stakeholders for their actions and decisions to ensure that they manage ecosystem services in a sustainable and equitable manner and without negative impacts on other stakeholders and to the environment.</br >' .
            '<b>Orientation</b>: The stakeholders\’ orientation in the management of ecosystem services refers to the process of providing guidance, education, and training to other stakeholders on how to manage and sustainably use ecosystem services as well as the identification of potential threats to these services and how to mitigate them in their local environment. The aim of this orientation is to build the capacity of rural communities to manage their natural resources in a way that promotes their long-term viability and enhances their quality of life.</br >',
        'ratingLegend' => [
            'Dependence' => [
                '0' => 'Very low',
                '1' => 'Low',
                '2' => 'Medium',
                '3' => 'High',
            ],
        ],
        'warning_on_save' =>
            'WARNING!! <br /> Any modification might cause data loss in the following modules(if already encoded): <i>CTX 6.1</i>, <i>C1.2</i> and <i>I1</i>',
        'summary' => 'Importance of elements & Involvement of stakeholders',
        'elements_importance' => 'Importance of elements',
        'involvement_ranking' => 'Involvement of stakeholders',
        'importance' => 'Importance (0-100)',
        'involvement' => 'Involvement of the stakeholder (0-100)'
    ],

    'AnalysisStakeholderTrendsThreats' => [
        'title' => 'Trends and threats on key elements – A stakeholder analysis',
        'fields' => [
            'Element' => 'Criteria',
            'Status' => 'Status',
            'Trend' => 'Trend',
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
            ]
        ],
        'summary' => 'Aggregated',
        'average' => 'Average',
        'elements_importance' => 'Importance of elements',
        'involvement_ranking' => 'Involvement of stakeholders',
        'involvement' => 'Involvement of the stakeholder (0-100)'
    ],

];
