<?php

return [

    'ResponsablesInterviewers' => [
        'title' => 'Responsibility for filling the form: Management team and partners and external support for analysis and management evaluation',
        'fields' => [
            'Name' => 'Name',
            'Institution' => 'Institution',
            'Function' => 'Function',
            'Contacts' => 'Contacts',
            'EncodingDate' => 'Date of compilation',
            'EncodingDuration' => 'Time taken for evaluation (hrs)',
        ]
    ],

    'ResponsablesInterviewees' => [
        'title' => 'Responsibility for completing the form: Management team and partners and external support for analysis and management evaluation',
        'fields' => [
            'Name' => 'Name',
            'Institution' => 'Institution',
            'Function' => 'Function',
            'Contacts' => 'Contacts',
            'EncodingDate' => 'Date of compilation',
            'EncodingDuration' => 'Time taken for evaluation (hrs)',
        ]
    ],

    'ImportanceGovernance' => [
        'title' => 'Governance/Partnership',
        'fields' => [
            'Aspect' => 'Criteria – Concept measured – Variables',
            'EvaluationScore' => 'Rating',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Coordination on financial matters between managers of the protected area, partners and donors',
            'Coordination on financial matters between managers of the protected area and communities',
            'Coordination on technical matters between managers of the protected area, communities and partners',
            'Coordination on scientific matters between managers of the protected area, communities and partners',
            'Incorporation of the needs/aims of managers of the protected area in the management of the park by partners',
            'Incorporation of partners’ needs/aims in the management of the park by managers of the protected area',
            'Incorporation of local communities’ needs/aims in the management of the park by managers of the protected area and partners',
            'Incorporation of the needs/aims of managers of the protected area and of partners in the management of the protected area by communities',
            'Incorporation of the needs/aims of managers in the management of the protected area by tourism operators',
            'Incorporation of the needs/aims of managers in the management of the protected area by tourism operators',
            'Coordination with decentralised/devolved administrations [e.g. provincial and / or territorial  level(s)]',
            'Coordination of a number of decentralised/devolved administrations [e.g. provincial and / or territorial level(s)] where the protected area lies within a number of administrative territories'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'does not apply',
                '1' => 'applies to some extent',
                '2' => 'applies',
                '3' => 'applies to a considerable extent',
            ]
        ],
        'module_subTitle' => 'Value and Importance - Governance/Partnership',
        'module_info_EvaluationQuestion' => '<ul> <li>Does the protected area have a well-defined governance model and are you able to identify its advantages and disadvantages?</li> <li>Does the protected area currently have partnerships to support governance and management?</li> <li><b>Identifying the value and importance of the current governance model and partnerships in managing the protected area </b></li> </ul>',
        'module_info_Rating' => 'Rate the importance of each noteworthy aspect for the governance of the protected area'
    ],

    'ObjectivesGovernance' => [
        'title' => 'Setting target objectives',
        'fields' => [
            'Status' => 'Baseline of gouvernance / of partners',
            'Benchmark1' => 'Reference value, benchmark 1',
            'Benchmark2' => 'Reference value, benchmark 2',
            'Benchmark3' => 'Reference value, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées of gouvernance / of partners',
        ],
        'module_info' => 'Setting target conservation objectives and indicators for <b>governance and partnerships </b>for the protected area<br /> The objectives and benchmarks to be entered in the table below are to be used in managing and monitoring activities in the protected area and more specifically, in the planning, resource (input) mobilisation and process phases, and in identifying outputs and outcome objectives..'
    ],

    'ImportanceClassification' => [
        'title' => 'Classifications',
        'fields' => [
            'Aspect' => 'Criteria – Concept measured – Variables',
            'EvaluationScore' => 'Rating',
            'SignificativeClassification' => 'Highly significant international classification',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'not important',
                '1' => 'slightly important',
                '2' => 'important',
                '3' => 'extremely important',
            ]
        ],
        'module_subTitle' => 'Value and Importance - Classifications',
        'module_info_EvaluationQuestion' => '<ul> <li>Has the protected area been classified or awarded a status for the benefit of national, regional or international conservation?</li> <li><b>Identify the importance and the influence of national, regional or international classifications in the management of the protected area </b></li> </ul>',
        'module_info_Rating' => 'List the national, regional or international classifications of the protected area (see Operational Context, point 1.3)'
    ],

    'ObjectivesClassification' => [
        'title' => 'Setting target objectives',
        'fields' => [
            'Status' => 'Baseline classification / status of the protected area',
            'Benchmark1' => 'Reference value, benchmark 1',
            'Benchmark2' => 'Reference value, benchmark 2',
            'Benchmark3' => 'Reference value, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées classification / status of the protected area',
        ],
        'module_info' => 'Setting target conservation objectives and indicators for <b>the current national, regional or international classification(s) </b> of the protected area<br /> The objectives and benchmarks to be entered in the table below are to be used in managing and monitoring activities in the protected area and more specifically, in the planning, resource (input) mobilisation and process phases, and in identifying outputs and outcome objectives.'
    ],

    'ImportanceSpecies' => [
        'title' => 'Species',
        'fields' => [
            'Aspect' => 'Criteria – Concept measured – Variables',
            'EvaluationScore' => 'Rating',
            'SignificativeSpecies' => 'Highly representative specie',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Identify the animal species (flagship, endangered, endemic, …) chosen as indicators',
            'group1' => 'Identify the vegetal species (flagship, endangered, endemic, …) chosen as indicators',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'without management efforts',
                '1' => 'slightly important',
                '2' => 'important',
                '3' => 'extremely important',
            ]
        ],
        'module_subTitle' => 'Value and Importance - Species (flagship, endangered, endemic, exploited, invasive and for which there is insufficient data)',
        'module_info_EvaluationQuestion' => '<ul> <li>Does the protected area ensure the conservation of the most representative species (flagship, endangered, endemic, exploited, invasive and for which there is insufficient data)?</li> <li><b>Identify the degree of importance assigned in the management of the protected area to the most representative species (flagship, endangered, endemic, exploited, invasive and for which there is insufficient data) that could be adopted as indicators of environmental excellence</b></li> </ul>',
        'module_info_Rating' => 'List five or more of the most representative species (flagship, endangered, endemic, exploited, invasive and for which there is insufficient data) for the protected area, based on an analysis of the Context Status (see Operational Context, points 4.1; 4.2.<br /> <span class="error">Attention: not less than 5 and not more than 10</span>'
    ],

    'ObjectivesSpecies' => [
        'title' => 'Setting target objectives',
        'fields' => [
            'Status' => 'Baseline currently evaluable state of conservation of the values and importances of the protected area',
            'Benchmark1' => 'Reference value, benchmark 1',
            'Benchmark2' => 'Reference value, benchmark 2',
            'Benchmark3' => 'Reference value, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées Values and Importances of the protected area',
        ],
        'module_info' => 'Setting target conservation objectives and indicators for <b>species (flagship, endangered, endemic, exploited, invasive and for which there is insufficient data) </b> in the protected area<br /> The objectives and benchmarks to be entered in the table below are to be used in managing and monitoring activities in the protected area and more specifically, in the planning, resource (input) mobilisation and process phases, and in identifying outputs and outcome objectives.'
    ],

    'ImportanceHabitats' => [
        'title' => 'Terrestrial and marine habitats and land-cover and land-change',
        'fields' => [
            'Aspect' => 'Criteria – Concept measured – Variables',
            'EvaluationScore' => 'Importance',
            'EvaluationScore2' => 'Depending on the regional and global value, set the level of importance to the habitats and types of land cover',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Identify the most important habitats of the protected area',
            'group1' => 'Identify the most important elements of land cover (land cover and land change) in and outside of the protected area',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'not important',
                '1' => 'slightly important',
                '2' => 'important',
                '3' => 'extremely important',
            ],
            'EvaluationScore2' => [
                '1' => 'not important',
                '2' => 'important',
                '3' => 'very important',
            ],
        ],
        'module_subTitle' => 'Value and Importance - Terrestrial and marine habitats and land-cover and land-change',
        'module_info_EvaluationQuestion' => '<ul> <li>Does the protected area ensure the conservation and enhancement of land habitats and the land-cover (land cover and land-change)?</li> <li><b>Identify the degree of importance assigned in the management of the protected area to habitats and to the land-cover (land cover and land-change) which could be adopted as management indicators</b></li> </ul>',
        'module_info_Rating' => 'List five or more of the most representative and important habitats for the protected area, based on an analysis of the Context Status (see Operational Context, points 4.3).<br /> <span class="error">Attention: not less than 5 and not more than 10</span>'
    ],

    'ObjectivesHabitats' => [
        'title' => 'Setting target objectives',
        'fields' => [
            'Status' => 'Baseline currently evaluable state of conservation of the terrestrial and marine habitats and types of land cover',
            'Benchmark1' => 'Reference value, benchmark 1',
            'Benchmark2' => 'Reference value, benchmark 2',
            'Benchmark3' => 'Reference value, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées of the terrestrial and marine habitats and types of land cover',
        ],
        'module_info' => 'Setting target conservation objectives and indicators for maintaining of <b>terrestrial and marine habitats or land cover of the most important</b> for the protected area<br /> The objectives and benchmarks to be entered in the table below are to be used in managing and monitoring activities in the protected area and more specifically, in the planning, resource (input) mobilisation and process phases, and in identifying outputs and outcome objectives.'
    ],

    'ImportanceClimateChange' => [
        'title' => 'Climate Change',
        'fields' => [
            'Aspect' => 'Criteria – Concept measured – Variables',
            'EvaluationScore' => 'Rating',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Ecological aspects affected by CC',
            'REDD + projects',
            'Integration of the protected area into the terrestrial and marine landscape to improve resilience to CC',
            'Protected area with altitude variation',
            'Transboundary protected areas to enhance resilience to CC',
            'Relevance of habitats to support mitigation and adaptation to CC',
            'Habitat restoration to support mitigation and adaptation to CC',
            'Intersectoral planning to increase the effectiveness of responses to CC',
            'Environmental policy to support mitigation and adaptation to CC',
            'Sustainable financing to support mitigation and adaptation to CC',
            'Socio-economic problems of the local population (transition area for the MAB reserves) in the effects and to support mitigation and adaptation to CC',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'not important',
                '1' => 'slightly important',
                '2' => 'important',
                '3' => 'extremely important',
            ]
        ],
        'module_subTitle' => 'Value and Importance - Climate Change',
        'module_info_EvaluationQuestion' => '<ul> <li>Does the protected area ensure the importance to effects of climate change in the management of the protected area?</li> <li><b>Identify the degree of importance assigned in the management of the protected area with the most significant effects of climate change which could be adopted as management indicators to increase the effectiveness of mitigation and adaptation responses to the phenomenon</b></li> </ul>',
        'module_info_Rating' => 'List five or more of the most important elements related to climate change and affecting the protected area (see Operational Context, points 6.1)'
    ],

    'ObjectivesClimateChange' => [
        'title' => 'Setting target objectives',
        'fields' => [
            'Status' => 'Baseline currently evaluable state of the effects of climate change',
            'Benchmark1' => 'Reference value, benchmark 1',
            'Benchmark2' => 'Reference value, benchmark 2',
            'Benchmark3' => 'Reference value, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées for the answers to the effects of climate change',
        ],
        'module_info' => 'Setting target conservation objectives and indicators to the <b> most significant effects of climate change</b>on the protected area<br /> The objectives and benchmarks to be entered in the table below are to be used in managing and monitoring activities in the protected area and more specifically, in the planning, resource (input) mobilisation and process phases, and in identifying outputs and outcome objectives.'
    ],

    'ImportanceEcosystemServices' => [
        'title' => 'Ecosystem services',
        'fields' => [
            'Aspect' => 'Criteria – Concept measured – Variables',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Provisioning: Nutrition',
            'Provisioning: Materials',
            'Provisioning: Power',
            'Regulating: Remediation of waste materials, toxic substances and other pollution',
            'Regulating: Remediation of flows',
            'Regulating: Preservation of biological, chemical and physical conditions',
            'Cultural: Physical interactions and experience',
            'Cultural: Intellectual interactions and performances',
            'Cultural: Spiritual and/or emblematic',
            'Cultural: Other cultural visits (ex situ conservation)'
        ],
        'module_info' => 'Note that the evaluations are reported automatically from the assessments you made at point #7.1. The scale of the criteria allows you to check the appropriateness of the surveys you made previously.',
        'ratingLegend' => [
            'Importance' => [
                'N/A' => 'cet élément n\'est pas en rapport avec la gestion de l\'aire protégée',
                '0' => 'without management efforts',
                '1' => 'slightly important',
                '2' => 'important',
                '3' => 'extremely important',
            ]
        ],
        'module_subTitle' => 'Value and Importance - Ecosystem services',
        'module_info_EvaluationQuestion' => '<ul> <li>Does the protected area ensure the conservation and enhancement of ecosystem services for human well-being?</li> <li><b>Identify the degree of importance assigned in the management of the protected area to the most significant ecosystem services which could be adopted as indicators of environmental excellence because of the dependence of the local population ( transition area for MAB reserves) of these ecosystem services</b></li> </ul>',
        'module_info_Rating' => 'List five or more of the most important and representative (legal and illegal) ecosystem services for the protected area, based on an analysis of the Context Status (see Operational Context, point 7.1)'
    ],

    'ObjectivesEcosystemServices' => [
        'title' => 'Setting target objectives',
        'fields' => [
            'Status' => 'Baseline actuellement évaluable des services écosystémiques rendus',
            'Benchmark1' => 'Reference value, benchmark 1',
            'Benchmark2' => 'Reference value, benchmark 2',
            'Benchmark3' => 'Reference value, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées de services écosystémiques rendus par l\'aire protégée',
        ],
        'module_info' => 'Setting target conservation objectives and indicators for <b>preserving ecosystem services and for the dependence on these services of communities</b> in the protected area<br /> The objectives and benchmarks to be entered in the table below are to be used in managing and monitoring activities in the protected area and more specifically, in the planning, resource (input) mobilisation and process phases, and in identifying outputs and outcome objectives.'
    ],

    'SupportsAndConstraints' => [
        'title' => 'External constraints or supporting factors',
        'fields' => [
            'Aspect' => 'External constraints or supporting factors',
            'EvaluationScore' => 'Importance of the constraints or supporting factors:',
            'EvaluationScore2' => 'Actors in their action to contrast or support the protected area',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Governor',
            'Territorial authorities (prefecture and sub-prefecture)',
            'Local elected officials and community leaders (ministers for the district, members of parliament and senators)',
            'Local communities',
            'Traditional authorities',
            'Civil society',
            'Human rights',
            'Ministry responsible for technical supervision',
            'Parks directorate',
            'Inter-sector coordination agencies',
            'Military justice',
            'Civil justice',
            'Ground forces and paramilitary police forces',
            'Naval forces',
            'Police forces',
            'High-profile residents of the buffer zone',
            'Senior representatives of government'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '-3 / -2 / -1' => 'Contraintes (least - moderate - most severe)',
                '0' => 'None (no impact)',
                '+1 / +2 / +3' => '(least - moderate - important)',
                'N/A' => 'this element is not related to the management of the protected area',
            ],
            'EvaluationScore2' => [
                '1' => 'low power',
                '2' => 'significant power',
                '3' => 'extremely important power',
            ],
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Is the protected area subject to constraints or does it benefit from supporting factors arising from the external political, institutional and social environment?</li> <li><b>Are you able to identify the advantages and disadvantages arising from the external political and social environment?</b></li> </ul>',
        'module_info_Rating' => 'List the more supporting factors for or constraints on the protected area and identify their importance '
    ],

    'ObjectivesSupportsAndConstraints' => [
        'title' => 'Setting target objectives',
        'fields' => [
            'Status' => 'Baseline currently evaluable state of the constraints on or supporting factors for the protected area',
            'Benchmark1' => 'Reference value, benchmark 1',
            'Benchmark2' => 'Reference value, benchmark 2',
            'Benchmark3' => 'Reference value, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées of the constraints on or supporting factors for the protected areaAriane Matalon <ariane@eti-consulting.net>Ariane Matalon <ariane@eti-consulting.net>',
        ],
        'module_info' => 'Setting target conservation objectives and indicators for <b>constraints on or supporting factors</b> for the protected area<br /> The objectives and benchmarks to be entered in the table below are to be used in managing and monitoring activities in the protected area and more specifically, in the planning, resource (input) mobilisation and process phases, and in identifying outputs and outcome objectives.'
    ],

    'Menaces' => [
        'title' => 'Threats',
        'fields' => [
            'Aspect' => 'Supports or constaints',
            'Comments' => 'Comments/Explanation',
        ],
        'module_info' => 'Note that the evaluations are reported automatically from the assessments you made at point #5.1. The scale of the criteria allows you to check the appropriateness of the surveys you made previously.',
        'ratingLegend' => [
            'Menaces' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'no impact',
                '-3 / -2 / -1' => 'Constraints (least - moderate - most severe)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Is the protected area subject to threats (pressures, threats and vulnerabilities) that could endanger biodiversity, cultural heritage or ecosystem services, etc., in the protected area? What are the most serious and significant threats (pressures, threats and vulnerabilities) to the protected area?</li> <li>What are the most serious and significant threats (pressures, threats and vulnerabilities) to the protected area?</li> <li><b>Identify the degree to which the management of the protected area controls the main threats that could be adopted as indicators of excellence</b></li> </ul>',
        'module_info_Rating' => 'List the most significant threats (pressures, threats and vulnerabilities) to the protected area (based on analysis of the Context Status point 5.1)'
    ],

    'ObjectivesMenaces' => [
        'title' => 'Setting target objectives',
        'fields' => [
            'Status' => 'Baseline currently evaluable state of the threats facing the protected area',
            'Benchmark1' => 'Reference value, benchmark 1',
            'Benchmark2' => 'Reference value, benchmark 2',
            'Benchmark3' => 'Reference value, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées of the threats facing the protected area',
        ],
        'module_info' => 'Setting target conservation objectives and indicators for <b>threats facing</b> the protected area<br /> The objectives and benchmarks to be entered in the table below are to be used in managing and monitoring activities in the protected area and more specifically, in the planning, resource (input) mobilisation and process phases, and in identifying outputs and outcome objectives.'
    ],

    'RegulationsAdequacy' => [
        'title' => 'Adequacy of legal and regulatory provisions',
        'fields' => [
            'Regulation' => 'Main regulations',
            'EvaluationScore' => 'Weakness/Adequacy',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Classification decree (pertaining to demarcation)',
            'Internal rules for the park',
            'Laws on the conservation',
            'Enabling legislation for ratification of international conventions on conservation (CITES, CBD, Nagoya, CITES, RAMSAR, etc.)',
            'Implementing decrees for the laws on parks and conservation',
            'Laws on the management of natural resources (complementary to laws on conservation)',
            'Implementing decrees for the laws on natural resources management',
            'Laws and conventions on research about biodiversity and natural resources',
            'Implementing decrees for the laws on research measures about biodiversity and natural resources',
            'Customary law (see P2)',
            'Land rights/law'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '-3 / -2 / -1' => 'Weakness (least weak - weakest)',
                '0' => 'No regulations in existence',
                '+1 / +2 / +3' => 'Adequacy (least - most adequate)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Are current regulations for controlling land use and activities (e.g. conservation-food-gathering, etc.) in the protected area appropriate?</li> <li><b>Identify the current regulations for controlling land use and activities and managing the protected area, and evaluate compliance with them</b></li> </ul>',
        'module_info_Rating' => 'Evaluate the main regulations connected with the scope of management of the protected area'
    ],

    'DesignAdequacy' => [
        'title' => 'Design and layout of the protected area',
        'fields' => [
            'Values' => 'The most important aspects of the layout and the current suitability of the design of the protected area',
            'EvaluationScore' => 'Adequacy',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Size (surface area)',
            'Index of shape or configuration (area / contour)',
            'Shape',
            'Buffer zone',
            'Corridors',
            'Border or boundary zone',
            'Segment (s) subject to limits conflict or dispute (e.g. non-natural boundaries, customary rights, farms, etc.)',
            'Officially recognized enclaves',
            'Remote areas with difficult / impossible to access for patrols'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '-3 / -2 / -1' => 'Negative (least negative - worst)',
                '0' => 'Stable',
                '+1 / +2 / +3' => 'Positive (least good - best)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Is the size and shape of the protected area appropriate for protecting species and habitats and assisting natural processes such as environmental processes and water catchment?</li> <li>Does the size of the protected area need to be increased (by expanding its corridors, etc.) to achieve its objectives?</li> <li><b>Evaluate the layout and the degree to which the design of the protected area is suitable for ensuring that its key values are protected</b></li> </ul>',
        'module_info_Rating' => 'Evaluate the most important aspects of the layout and the current suitability of the design of the protected area (based on analysis of the Context Status point 2)'
    ],

    'BoundaryLevel' => [
        'title' => 'Demarcation of the protected area',
        'fields' => [
            'EvaluationScore' => 'Current status of the perimeter of the protected area that is marked',
            'PercentageLevel' => '% of the perimeter',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'boundaries are not known by the authorities and/or residents/users and are not marked (0%)',
                '1' => 'boundaries are known by the authorities and residents/users, but there is insufficient marking (1–50%)',
                '2' => '= boundaries are known by the authorities and residents/users, but marking is inadequate (51–75%)',
                '3' => 'boundaries are known by the authorities and residents/users and are properly marked (more than 76, but less than 100%)',
                '4' => 'limits perfectly known by the authorities and residents / users and are properly marked (100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>- Is the boundary known and marked?</li> <li><b>- Identify the degree to which the boundaries of the protected area are known and marked, and, if you can, give the percentage of boundaries that are marked, within the range given</b></li> </ul>',
        'module_info_Rating' => 'Specify the % of the perimeter of the protected area that is marked'
    ],

    'ManagementPlan' => [
        'title' => 'Management plan',
        'fields' => [
            'PlanExistenceScore' => 'Existence of the plan',
            'PlanApplicationScore' => 'Applicability of the plan',
            'PercentageLevel' => '% implementation of the plan',
            'Comments' => 'Comments',
        ],
        'ratingLegend' => [
            'PlanExistenceScore' => [
                '0' => 'there is no management plan for the protected area',
                '1' => 'A management plan is being drawn up',
                '2' => 'A management plan has been drawn up and has been implemented, although it has not been approved',
                '3' => 'A management plan has been drawn up, approved and implemented',
            ],
            'PlanApplicationScore' => [
                '0' => 'The management plan does not show clear and convenient vision, mission and objectives of the protected area (0%)',
                '1' => 'The management plan does not show sufficiently clear and convenient vision, mission and objectives of the protected area (1-33%)',
                '2' => 'The management plan shows sufficiently clear and convenient vision, mission, and objectives of the protected area (34-66%)',
                '3' => 'The management plan shows very clear and convenient vision, mission and objectives of the protected area (67-100%)',
            ],
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Is there a management plan and if yes, is it applicable?</li> <li><b>Check the existence and applicability of the management plan</b></li> </ul>',
        'module_info_Rating' => 'Based on the four + four levels below, provide information on the existence and applicability of the management plan'
    ],

    'WorkPlan' => [
        'title' => 'Work plan',
        'fields' => [
            'PlanExistenceScore' => 'Existence of the plan',
            'PlanApplicationScore' => 'Relevance of the plan',
            'PercentageLevel' => '% of relevance of the plan',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'PlanExistenceScore' => [
                '0' => 'There is no work plan',
                '1' => 'An established work plan exists, but activities are not carried out or checked on the basis of the plan objectives',
                '2' => 'A work plan exists, but activities are not fully focused on the plan objectives or properly completed',
                '3' => 'A work plan exists, activities are carried out on the basis of the plan objectives and all or most scheduled activities are properly completed',
            ],
            'PlanApplicationScore' => [
                '0' => 'The activities and results expected by the work plan does not correspond to the proposals given by the management plan (Vision - Mission - Objectives) (0%)',
                '1' => 'The activities and results expected by the work plan does not properly correspond to the proposals given by the management plan (Vision - Mission - Objectives) (1-33%)',
                '2' => 'The activities, and results expected by the work plan match, but below the optimal threshold, to the proposals by the Management Plan (Vision - Mission - Objectives) (34-66%)',
                '3' => 'The activities, and results expected by the work plan fit perfectly with to the proposals given by the management plan (Vision - Mission - Objectives) (67-100%)',
            ],
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Is there an annual work plan?</li> <li><b>Check the existence and relevance of the work plan</b></li> </ul>',
        'module_info_Rating' => 'Based on the four + four levels below, provide information on the existence and relevance of the work plan'
    ],

    'Objectives' => [
        'title' => 'Objectives of the protected area',
        'fields' => [
            'Objective' => 'Objective',
            'EvaluationScore' => 'Pertinence',
            'Comments' => 'Commentaire',
        ],
        'predefined_values' => [
            'Conservation of the animal species (flagship, endangered, endemic, …) chosen as indicators',
            'Conservation of the plants species (flagship, endangered, endemic, …) chosen as indicators',
            'Conservation of the most important habitats and the land use in and outside of the protected area (land cover - use - take)',
            'Legal and sustainable use of natural resources (customary law and protected areas management of natural resources)',
            'Mitigation of the direct and indirect threats to the protected area',
            'Mitigation / adaptation of the effects of climate change on key elements of the protected area',
            'Conservation of ecosystem services provided by the protected area'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'no definition of objectives, indicators, and benchmarks',
                '1' => 'definition of objectives, but these are not specified on the basis of indicators and benchmarks',
                '2' => 'definition of objectives, but these are not fully specified on the basis of indicators or benchmarks',
                '3' => 'definition of objectives with indicators and related benchmarks',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Do the objectives set for the protected area present indicators and benchmarks of the expected conditions as the impact of the management of the protected area?</li> <li><b>Determine the relevance of the objectives, indicators and benchmarks for the management of the protected area coming out of the planning documents and the context status</b></li> </ul>',
        'module_info_Rating' => 'Evaluate the relevance of the objectives, indicators and benchmarks of planning for the conservation of the values and the importance of the protected area (based on elements of the context status, items 4, 5, 6, 7) '
    ],

    'ObjectivesPlanification' => [
        'title' => 'Setting target objectives',
        'fields' => [
            'Status' => 'Baseline',
            'Benchmark1' => 'Reference value, benchmark 1',
            'Benchmark2' => 'Reference value, benchmark 2',
            'Benchmark3' => 'Reference value, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées',
        ],
        'module_info' => 'Setting target conservation objectives and indicators for <b>planning exercises and tools </b> the protected area<br /> The objectives and benchmarks to be entered in the table below are to be used in managing and monitoring activities in the protected area and more specifically, in the planning, resource (input) mobilisation and process phases, and in identifying outputs and outcome objectives.'
    ],

    'InformationAvailability' => [
        'title' => 'Basic information',
        'fields' => [
            'Element' => 'Elements for management',
            'EvaluationScore' => 'Availability ',
            'PercentageLevel' => 'Knowledge as compared with management requirements [%]',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Knowledge of the animal species (flagship, endangered, endemic, …) chosen as indicators',
            'group1' => 'Knowledge of the vegetal species (flagship, endangered, endemic, …) chosen as indicators',
            'group2' => 'Knowledge of the most important habitats and the land use in and outside of the protected area (land cover - use - take)',
            'group3' => 'Knowledge of the direct and indirect threats to the protected area',
            'group4' => 'Knowledge of the effects of climate change on key elements of the protected area',
            'group5' => 'Knowledge of the ecosystem services provided by the protected area',
            'group6' => 'Threat hot spots',
            'group7' => 'Local community expectations and aspirations',
            'group8' => 'REDD+',
            'group9' => 'Other',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'no or little information (between 0 and 25% of management needs)',
                '1' => 'information available, but insufficient for planning and decision making (between 26 and 50% of management needs)',
                '2' => 'information available and sufficient for planning and decision making but essential monitoring and research work is not addressed (between 51 and 75% of management needs)',
                '3' => 'information available and sufficient for planning and decision making and updated through essential monitoring and research work (between 76 and 100% of management needs',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Do you have sufficient information to manage the protected area?</li> <li><b>Analyse the relevance and availability of information to ensure effective management of the protected area</b></li> </ul>',
        'module_info_Rating' => 'List the most important elements for management of the protected area for which basic information is/is not available (based on the Operational Context factors in points 4; 5; 6; 7) '
    ],

    'Staff' => [
        'title' => 'Staff',
        'fields' => [
            'Theme' => 'Function',
            'PercentageLevel' => 'Percentage',
            'Comments' => 'Comments/Explanation',
        ],
        'status' => 'Current state of available staff',
        'module_info' => 'Note that the evaluations are reported automatically from the assessments you made at point #3.1.1. The scale of the criteria allows you to check the appropriateness of the surveys you made previously.',
        'ratingLegend' => [
            'Estimation' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'few staff (between 0 and 25% of the number required)',
                '1' => 'not enough staff for essential management activities (between 26 and 50% of the number required)',
                '2' => 'below the ideal level (between 51 and 75% of the number required)',
                '3' => 'appropriate for activities (between 76 and 100% of the number required)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Are there enough staff to manage the protected area</li> <li><b>Specify whether staff numbers are suitable for management requirements for the protected area on the basis of indications of management plan or the official organigram of the staff</b></li> </ul>',
        'module_info_Rating' => 'Current status automatically reported, and identify if possible the percentage, of staff compared with management requirements for the protected area (Automatic linkage with the values from the Context Status factors in point 3.1)'
    ],

    'BudgetAdequacy' => [
        'title' => 'Current budget',
        'fields' => [
            'EvaluationScore' => 'Adequacy of current budget',
            'Percentage' => 'Percentage of budgetary adequancy for requirements',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'no budget (0% of requirements)',
                '1' => 'inadequate for essential management activities (between 1 and 35% of requirements)',
                '2' => 'below the ideal threshold (between 36 and 70% of requirements)',
                '3' => 'appropriate for activities (more than 71, but less than 100% of requirements)',
                '4' => 'ideal for activities (100% of requirements)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Is the current budget sufficient for appropriate management of the protected area?</li> <li><b>Determine the adequacy of current funding in relation to conservation requirements for the protected area</b></li> </ul>',
        'module_info_Rating' => 'Based on the four levels below, state the level of adequacy of current funding for the protected area in relation to conservation requirements (based on the Operational Context factors in point 3.2)'
    ],

    'BudgetSecurization' => [
        'title' => 'Securing the budget',
        'fields' => [
            'EvaluationScore' => 'Securing the budget',
            'Percentage' => 'Percentage of budgetary security for requirements',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'budget is not secure and management is entirely dependent on external funding or annual financing (0% of the budget is secure)',
                '1' => 'a very limited proportion of the budget is secure and management is largely dependent on external funding or annual financing (between 1 and 33% of the budget is secure)',
                '2' => 'a significant proportion of the budget is secure, but many innovations and initiatives remain dependent on external funding (between 34 and 67% of the budget is secure)',
                '3' => 'budget is secure and management requirements are covered for several years (budget is more than 67%, but less than 100% secure)',
                '4' => 'budget is secure and the management needs are perfectly covered for several years (100% of the budget is secure)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Is the budget secure?</li> <li><b>Determine the security of current funding in relation to conservation requirements for the protected area</b></li> </ul>',
        'module_info_Rating' => 'Based on the four levels below, state the level of security of current funding for the protected area in relation to conservation requirements'
    ],

    'ManagementEquipmentAdequacy' => [
        'title' => 'Infrastructure, equipment and facilities',
        'fields' => [
            'Equipment' => 'Infrastructure, equipment and facilities ',
            'Importance' => 'Importance for the park',
            'Comments' => 'Comments/Explanation',
        ],
        'adequacy' => 'Adequacy',
        'module_info' => 'Note that the evaluations are reported automatically from the assessments you made at point #3.3. The scale of the criteria allows you to check the appropriateness of the surveys you made previously.',
        'ratingLegend' => [
            'Estimation' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'highly inadequate (meeting between 0 and 25% of requirements)',
                '1' => 'inadequate for essential management activities (between 26 and 50% of requirements)',
                '2' => 'below the ideal level (between 51 and 75% of requirements)',
                '3' => 'appropriate for activities (between 76 and 100% of requirements)',
            ],
            'Importance' => [
                '0' => 'normal',
                '1' => 'high',
                '2' => 'very high',
            ],
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Are infrastructure, equipment and facilities sufficient for management requirements?</li> <li><b>Evaluate the adequacy of infrastructure, equipment and facilities in relation to management requirements for the protected area</b></li> </ul>',
        'module_info_Rating' => 'Evaluate the level of adequacy of infrastructure, equipment and facilities in relation to management requirements for the protected area (Automatic linkage with the values from the Context Status factors in point 3.3)'
    ],

    'ObjectivesIntrants' => [
        'title' => 'Setting target objectives',
        'fields' => [
            'Status' => 'Baseline',
            'Benchmark1' => 'Reference value, benchmark 1',
            'Benchmark2' => 'Reference value, benchmark 2',
            'Benchmark3' => 'Reference value, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées',
        ],
        'module_info' => ' Setting target conservation objectives and indicators for the <b>inputs required to implement the plans of management and governance</b> for the protected area<br /> The objectives and benchmarks to be entered in the table below are to be used in managing and monitoring activities in the protected area and more specifically, in the planning, resource (input) mobilisation and process phases, and in identifying outputs and outcome objectives.'
    ],

    'StaffCompetence' => [
        'title' => 'Staff capabilities and training',
        'fields' => [
            'Theme' => 'Functions',
            'EvaluationScore' => 'Average level of skill',
            'PercentageLevel' => 'Average level of training',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'no skills or training',
                '1' => 'low level of skills or training',
                '2' => 'the level of skills or training is appropriate, but improvement needed',
                '3' => 'the level of skills or training is up to date or even ahead of current requirements',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Do staff have the skills and adequate training to achieve management objectives?</li> <li><b>Determine the level of staff skills and the adequacy of the training in relation to the management requirements of the protected area</b></li> </ul>',
        'module_info_Rating' => 'With regard to the role (function-position) and the most significant thematic areas of management of the protected area, enter the average level of skill and training of the available staff (based on the Operational Context factors in point 3.1)'
    ],

    'HRmanagementPolitics' => [
        'title' => 'Human resource management policies and procedures',
        'fields' => [
            'Conditions' => 'If necessary, add to the list of prerequisites for a proper human resources policy and adequate human resources procedures in a protected area',
            'EvaluationScore' => 'Degree of application',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Formally documented policies and guidelines for the organisation of and to define management procedures for public authority staff',
            'Level of application of the status specifically for staff of the protected area (staff status of the National agency for national parks)',
            'Internal rules of the protected area defining roles, obligations, authorities, controls, services and responsibilities',
            'Management and control of internal procedures by the HRD of the protected area to improve human resource management',
            'Recruitment and HR management are independent of external pressures',
            'Implementation of HR arrangements with communication, applicable procedures and training programmesn',
            'Monitoring of and revisions to internal processes and procedures for the protected area'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'does not apply',
                '1' => 'applies to a small extent',
                '2' => 'applies to a medium extent',
                '3' => 'applies to a large extent',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Has the protected area adopted human resource management policies and procedures?</li> <li><b>Determine the adequacy of the human resource management policies and procedures for the protected area</b></li> </ul>',
        'module_info_Rating' => 'If necessary, add to the list of prerequisites for a proper human resources policy and adequate human resources procedures in a protected area'
    ],

    'HRmanagementSystems' => [
        'title' => 'Analyse the degree of staff motivation (job suitability)',
        'fields' => [
            'Conditions' => 'Cprerequisites for maintaining a good level of staff motivation (if required, add elements to the list )',
            'EvaluationScore' => 'Degree of application',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Clear, specific objectives for assignments',
            'Stimulation to act',
            'Information on the results achieved the activities',
            'Sufficient level of autonomy',
            'Appropriate remuneration (wages, bonuses and social security)',
            'Appropriate working conditions',
            'Support from political, administrative and military authorities',
            'Support from legal authorities',
            'Support from local communities'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'has not been implemented',
                '1' => 'has been implemented to a small extent',
                '2' => '= has been implemented to a medium extent',
                '3' => 'actively implemented',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Are the service staff for the protected area suited to conservation work?</li> <li><b>Analyse the degree of staff motivation (job suitability)</b></li> </ul>',
        'module_info_Rating' => 'If required, add to the list of prerequisites for maintaining a good level of staff motivation in a protected area'
    ],

    'GovernanceLeadership' => [
        'title' => 'Management and internal leadership',
        'fields' => [
            'EvaluationScoreGovernace' => 'Degree of internal governance',
            'EvaluationScoreLeadership' => 'Degree of leadership',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScoreGovernace' => [
                '0' => 'The number of disciplinary incidents and cases of failure to carry out orders is very high',
                '1' => 'The number of disciplinary incidents and cases of failure to carry out orders is high',
                '2' => 'The number of disciplinary incidents and cases of failure to carry out orders is low',
                '3' => 'Disciplinary incidents and cases of failure to carry out orders are rare',
            ],
            'EvaluationScoreLeadership' => [
                '0' => 'There are critical shortcomings in management and leadership processes and decision-making',
                '1' => 'There are significant shortcomings in management and leadership processes and decision-making',
                '2' => 'Management and leadership processes and decision-making are adequate',
                '3' => 'Management and leadership processes and decision-making are ideal',
            ],
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Does the management of the protected area give adequate focus to decision-making, carrying out orders and discipline?</li> <li><b>Evaluate the level of internal governance and leadership</b></li> </ul>',
        'module_info_Rating' => 'Evaluate the current level of internal governance and leadership of the protected area on the basis of the dual levels (four + four)'
    ],

    'AdministrativeManagement' => [
        'title' => 'Accounting and financial management',
        'fields' => [
            'EvaluationScore' => 'Degree of the quality of management',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'budget and financial resource management is poor and severely compromises the management effectiveness of the protected area',
                '1' => 'budget and financial resource management is middling and compromises the management effectiveness of the protected area',
                '2' => 'budget and financial resource management is adequate, but could be improved',
                '3' => 'budget and financial resource management is excellent and supports the management effectiveness of the protected area',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Are the budget and financial resources managed so as to meet essential management requirements?</li> <li><b>Evaluate the effectiveness of accounting and financial management</b></li> </ul>',
        'module_info_Rating' => 'Evaluate the current level of quality of the accounting and financial resource management'
    ],

    'EquipmentMaintenance' => [
        'title' => 'Maintenance of infrastructure, equipment and facilities',
        'fields' => [
            'Equipment' => 'Infrastructure, equipment and facilities',
            'EvaluationScore' => 'Degree of adequacy of the level of maintenance',
            'Percentage' => 'Percentage adequacy of maintenance efforts in relation to requirements',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'highly inadequate (meeting between 0 and 25% of requirements)',
                '1' => 'inadequate for essential management activities (between 26 and 50% of requirements)',
                '2' => 'below the ideal level (between 51 and 75% of requirements)',
                '3' => 'appropriate for activities (between 76 and 100% of requirements)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Are infrastructure, equipment and facilities adequately maintained?</li> <li><b>Assess the level of maintenance of infrastructure, equipment and facilities</b></li> </ul>',
        'module_info_Rating' => 'Determine the level of maintenance of infrastructure, equipment and facilities in relation to management requirements for the protected area (based on the Operational Context factors in point 3.3)'
    ],

    'ManagementActivities' => [
        'title' => 'Managing the values and important aspects of the protected area',
        'fields' => [
            'Activity' => 'Specific activities of management',
            'EvaluationScore' => 'Degree of management activity',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Active management measures: Animal species (flagship, endangered, endemic, …) chosen as indicators',
            'group1' => 'Active management measures: Vegetal species (flagship, endangered, endemic, …) chosen as indicators',
            'group2' => 'Active management measures: Habitats and the land use in and outside of the protected area (land cover - use - take)',
            'group3' => 'Active management measures: Legal and sustainable use of natural resources (customary law and protected areas management of natural resources)',
            'group4' => 'Active management measures: Direct and indirect threats to the protected area',
            'group5' => 'Active management measures: General management',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'no active management',
                '1' => 'very few active management measures, with little impact',
                '2' => 'a number of active management measures, with average impacts',
                '3' => 'numerous active management measures, with positive impacts',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Does the protected area adopt active management measures for plant and animal species, habitats, maintenance of land cover and land-use and threats?</li> <li><b>Evaluate the existence and effectiveness of management activities for plant and animal species, habitats, maintenance of land cover and land-use and threats</b></li> </ul>',
        'module_info_Rating' => 'List five or more activities specifically for the management of for plant and animal species, habitats, maintenance of land cover and land-use and threats (based on the Operational Context factors in points 4; 5)'
    ],

    'ProtectionActivities' => [
        'title' => 'Degree of protection of the values and important aspects of the protected area',
        'fields' => [
            'Activity' => 'Specific activities of protection',
            'EvaluationScore' => 'Protection systems',
            'Percentage' => 'Protection provided in relation to requirements',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Measures of control/protection of animal species (flagship, endangered, endemic, …) chosen as indicators',
            'group1' => 'Measures of control/protection of vegetal species (flagship, endangered, endemic, …) chosen as indicators',
            'group2' => 'Measures of control/protection of habitats and the land use in and outside of the protected area (land cover - use - take)',
            'group3' => 'Measures of control/protection of legal and sustainable use of natural resources (customary law and protected areas management of natural resources)',
            'group4' => 'Measures of control/protection of direct and indirect threats to the protected area',
            'group5' => 'Measures of control/protection of the ecosystem services provided by the protected area',
            'group6' => 'Others measures of control/protection',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'no control/protection',
                '1' => 'partial control/protection',
                '2' => 'moderately effective control/protection',
                '3' => 'effective control/protection',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Has the protected area adopted provisions to protect plant and animal species, habitats, maintenance of land cover and land-use, threats and ecosystem services? </li> <li><b>EEvaluate the effectiveness of activities to protect plant and animal species, habitats, maintenance of land cover and land-use, threats and ecosystem services</b></li> </ul>',
        'module_info_Rating' => 'List five or more activities specifically for protecting plant and animal species, habitats, maintenance of land cover and land-use, threats and ecosystem services (based on the Operational Context factors in points 4; 5; 6; 7)'
    ],

    'Control' => [
        'title' => 'Control of the protected area',
        'fields' => [
            'EvaluationScore' => 'Degree of control',
            'Percentage' => 'Percentage of the area under control',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Control of the protected area is minimal (from 0 to 25% of the surface area)',
                '1' => 'Control of the protected area is poor (from 26 to 50% of the surface area)',
                '2' => 'Control of the protected area is good (from 51 to 75% of the surface area)',
                '3' => 'Control of the protected area is high (more than 76, but less of 100% of the surface area)',
                '4' => 'Control of the protected area is total (100% of the surface)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Is the protected area under full or partial control?</li> <li><b>Determine the level of control of the protected area</b></li> </ul>',
        'module_info_Rating' => 'Evaluate the current status and, if possible, state the % of the surface area that is controlled'
    ],

    'LawEnforcement' => [
        'title' => 'Enforcing the law',
        'fields' => [
            'Element' => 'Elements',
            'EvaluationScore' => 'Level of enforcement of the law',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'National legislative provisions for conservation are appropriate to ensure the protection of the protected area',
            'The legislative provisions specific to the protected area are appropriate to ensure the protection of the heritage assets',
            'Level of application of the internal regulations to the protected area',
            'The protected area has a sufficient number of sworn officials',
            'Staff has the knowledge and the capabilities to enforce compliance with regulations and legislation in accordance with the principles of fairness and due process of law',
            'The protected area has sufficient resources to monitor judicial processes',
            'Level of enforcement of the law by legal authorities',
            'Collaboration with other enforcement agencies',
            'The system of enforcement of laws and regulations is inviolable',
            'Proximity of legal authorities to the protected area',
            'The central authority with responsibility for conservation supports efforts to enforce the law',
            'The local administrative authority supports efforts to enforce the law'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'highly inadequate',
                '1' => 'insuffisantenot adequate',
                '2' => 'adequate',
                '3' => 'very adequate',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Are the staff of the protected area able to effectively enforce compliance with the laws and regulations that govern the protected area?</li> <li>What happens in case of an arrest?</li> <li><b>Evaluate the capability for enforcing the law</b></li> </ul>',
        'module_info_Rating' => 'Establish which of the more basic factors for enforcing legal provisions are relevant to the protected area'
    ],

    'Implications' => [
        'title' => 'Involvement of communities, beneficiaries and stakeholders',
        'fields' => [
            'Actor' => 'Local communities, rightholders and stakeholders',
            'EvaluationScore' => 'Involvement',
            'Percentage' => 'Percentage involvement',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Local community',
            'group1' => 'Government',
            'group2' => 'Donors, Privates and NGOs',
            'group3' => 'Others',
        ],
        'predefined_values' => [
            'group0' => [
                'Traditional authorities',
                'Communities living close to or in the park',
                'Forestry groups and fishing',
                'Private operators',
                'Representatives of civil society/local councils'
            ],
            'group1' => [
                'State government (ministries, technical directions, representatives of public enterprises, etc.)',
                'Government (s) regional, provincial and prefecture (s)',
                'Territorial / departmental and municipal council',
                'Representatives of local populations (parliamentary representatives, etc.)',
                'Armed forces (paramilitary police force and navy)'
            ]
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'no involvement (0%)',
                '1' => 'involved, but no direct role in decision-making (1–25%)',
                '2' => 'involved, with a contribution to certain decisions (26–75%)',
                '3' => 'involved, with a contribution to all decision-making, for example, joint management (76–100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Are local communities, beneficiaries and stakeholders involved in management decisions for the protected area?</li> <li><b>Estimate the degree of local authority, beneficiary and stakeholder involvement in management decisions for the protected area</b></li> </ul>',
        'module_info_Rating' => 'Assess the involvement of local authorities, beneficiaries and stakeholders in management decisions for the protected area'
    ],

    'AssistanceActivities' => [
        'title' => 'Appropriate benefits/assistance for local communities',
        'fields' => [
            'Activity' => 'Activities/Programmes',
            'EvaluationScore' => 'Degree of appropriate benefits/assistance for local communities',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Employment of local staff',
            'Payment for local goods and services',
            'Regional recruitment of security guards',
            'Tourism and impacts in terms of employment',
            'Pilot project for reducing human-wildlife conflict',
            'Schools, dispensaries, social support',
            'Support for food production and small farming (oysters)',
            'Water points and water supply',
            'Improvements to roads',
            'Power supply, electrical connection'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'no activities/programmes and no benefits',
                '1' => 'few activities/programmes and minimal benefits',
                '2' => 'major, ongoing activities and programmes, with significant benefits',
                '3' => 'activités / programmes importantes et constants, et forts avantages',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Are there ongoing activities/programmes by the protected area designed to provide appropriate benefits/assistance for communities?</li> <li><b>Evaluate whether the level of benefits/assistance for communities provided by the activities and programmes supported by the protected area is appropriate</b></li> </ul>',
        'module_info_Rating' => 'Evaluate the ongoing activities/programmes supported by the protected area designed to provide appropriate benefits/assistance for communities'
    ],

    'ActorsRelations' => [
        'title' => 'Relations with the stakeholders and Environmental education',
        'fields' => [
            'Activity' => 'Activités/programmes',
            'EvaluationScore' => 'Importance and impact of the activities',
            'Percentage' => 'Participation by local communities to the activities/programmes',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Programme to raise awareness amongst residents other than in villages all around the protected area',
            'Environmental education programme in schools',
            'Programme of broadcasts on community radio stations',
            'Conferences and debates on conservation',
            'Guided tours in the protected area',
            'Educational material about environmental education distributed to schools',
            'Television programmes about the protected area',
            'Waste and clean-up operations',
            'Ecomuseum'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'no activities/programmes and no outcomess',
                '1' => 'limited, unfocused activities/programmes with minimal outcomes',
                '2' => 'appropriate activities/programmes, but sometimes ad hoc, with average outcomes',
                '3' => 'ongoing, scheduled activities/programmes, with significant outcomes',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Is there an established programme of general environmental education or a programme specifically linked to the needs and objectives of conservation/management of natural resources?</li> <li><b>Determine whether there are education and awareness programmes in existence that are tailored to the needs and objectives of conservation/management of natural resources of the protected areae</b></li> </ul>',
        'module_info_Rating' => 'Evaluate the education and awareness activities/programmes that are supported by the protected area'
    ],

    'VisitorsManagement' => [
        'title' => 'Visitor management',
        'fields' => [
            'Aspect' => '',
            'EvaluationScore' => 'Requirements for visitor facilities and services',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Management',
            'group1' => 'Visitor experience',
        ],
        'predefined_values' => [
            'group0' => [
                'Planning',
                'Accommodation, catering, leisure activities',
                'Compétences et expertise du personnel',
                'Staff skills and expertise',
                'Quality',  'Diversity of tourist attractions',
                'Level of development of tourism potential',
                'Innovation'
            ],
            'group1' => [
                'Range of diversity of supply and experiences for visitors',
                'Sense of place (preserving or improving the specific character of the natural area)',
                'Degree of visitor satisfaction and rewarding experiences',
                'Visitors’ appreciation level of the degree of cleanliness of the countryside',
                'Visitor safety',
                'Visitor transport',
                'Stability of the country',
                'Accessibility',
                'Ease of administration (authorisation, absence of red tape)',
                'Tourism exchange network'
            ],
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'not established or implemented',
                '1' => 'established and implemented to a small extent',
                '2' => 'established and implemented appropriately, but improvement needed',
                '3' => 'established and implemented in a proper and proactive manner',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Has the protected area established and implemented the requirements for suitable visitor facilities and services (environmental tourism and education)?</li> <li><b>Determine the suitability of visitor facilities and services (environmental tourism and education)</b></li> </ul>',
        'module_info_Rating' => 'Rate and evaluate the level to which the requirements have been implemented for suitable visitor facilities and services in the protected area (environmental tourism and education)'
    ],

    'VisitorsImpact' => [
        'title' => 'Visitors and impacts',
        'fields' => [
            'Impact' => '',
            'EvaluationScore' => 'Note',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Visitor management',
            'group1' => 'Impact',
        ],
        'predefined_values' => [
            'group0' => [
                'Planning',
                'Active management',
                'Communication',
                'Supervision'
            ],
            'group1' => [
                'Achieve sustainable use (environmental, social and economic)',
                'Minimise environmental impacts (transport, housing and accommodation, and leisure activities)',
                'Ensure economic benefits for protected areas and local populations'
            ],
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'inadequate',
                '1' => 'inadequate for tourism activities',
                '2' => 'below the ideal level',
                '3' => 'appropriate and proactive in relation to tourism activities',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Does the protected area manage and mitigate the impacts of tourism activities appropriately?</li> <li><b>Determine whether the protected area manages and mitigates the impacts of tourism activities appropriately </b></li> </ul>',
        'module_info_Rating' => 'Rate and evaluate the level of management and mitigation of the impacts of tourist visits to the protected area'
    ],

    'NaturalResourcesMonitoring' => [
        'title' => 'Monitoring systems for natural and cultural resources',
        'fields' => [
            'Aspect' => 'Conditions',
            'EvaluationScore' => 'Evaluate the extent to which it has been met',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Implementation of the main conservation objectives is monitored',
            'The use of more than one indicator makes it easier to monitor the implementation of the main conservation objectives',
            'Knowledge of baseline environmental data supports management',
            'Provisions for monitoring are relatively easy for target users to understand',
            'Methods for data collection and analysis are appropriate and technically sound',
            'Data is accessible and secure',
            'Monitoring makes it possible to detect trends in a series of threats',
            'The institutional capabilities and technical resources are in place to ensure monitoring in the future',
            'Data from monitoring is used and leads to changes in the management of the protected area',
            'Data from monitoring is analysed and communicated appropriately',
            'Monitoring of animal species (flagship, endangered, endemic, …) chosen as indicators',
            'Monitoring of vegetal species (flagship, endangered, endemic, …) chosen as indicators',
            'Monitoring of control/protection of habitats and the land use in and outside of the protected area (land cover - use - take)',
            'Monitoring of control/protection of legal and sustainable use of natural resources (customary law and protected areas management of natural resources)',
            'Monitoring of control/protection of direct and indirect threats to the protected area',
            'Monitoring of the effects of climate change on key elements of the protected area',
            'Monitoring of control/protection of the ecosystem services provided by the protected area'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'no provisions adopted and condition not met',
                '1' => 'provisions adopted and condition met to a slight extent',
                '2' => 'provisions adopted and condition met to an appropriate extent, but improvement is needed',
                '3' => 'provisions adopted and condition met in a proper and proactive manner',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Are the values and important aspects of the protected area effectively monitored in relation to the management efforts and the extent and severity of threats?</li> <li><b>Evaluate the effectiveness of the monitoring of values and important aspects in relation to the management efforts and the extent and severity of threats facing the protected area</b></li> </ul>',
        'module_info_Rating' => 'Establish which of the conditions listed for carrying out appropriate monitoring of the management efforts and the threats facing of the values and important aspects of the protected area have been met (based on the Operating Context factors in points 4; 5; 6; 7)'
    ],

    'ResearchAndMonitoring' => [
        'title' => 'Research and biomonitoring',
        'fields' => [
            'Program' => 'Monitoring and research programmes and activities',
            'EvaluationScore' => 'Level of effectiveness of biomonitoring and research activities',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Research and biomonitoring activities on animal species (flagship, endangered, endemic, ...)',
            'Research and biomonitoring activities on vegetal species (flagship, endangered, endemic, ...)',
            'Research and biomonitoring on habitats and the land use in and outside of the protected area (land cover - use - take)',
            'Research and biomonitoring activities on legal and sustainable use of natural resources (customary law and protected areas management of natural resources)',
            'Research and biomonitoring on direct and indirect threats to the protected area',
            'Research and biomonitoring on climate change on key elements of the protected area',
            'Research and biomonitoring on the ecosystem services provided by the protected area'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'no biomonitoring or research activities in the protected area',
                '1' => 'ad hoc biomonitoring and research activities, but not aligned to the needs or the improvement of the management of the protected area',
                '2' => 'biomonitoring and research activities partially aligned to the needs and improvement of the management of the protected area',
                '3' => 'biomonitoring and research activities partially aligned to the needs and improvement of the management of the protected area',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Are there a program and biomonitoring and research activities?</li> <li><b>Analyse and evaluate the environmental research and biomonitoring activities in the management of natural and cultural factors</b></li> </ul>',
        'module_info_Rating' => 'List five or more management programmes focused on biomonitoring and research efforts (based the Operational Context factors in points 4; 5; 6; 7)'
    ],

    'ClimateChangeMonitoring' => [
        'title' => 'Management of the effects of climate change',
        'fields' => [
            'Program' => 'Management programmes',
            'EvaluationScore' => 'Level of effectiveness of activities',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Adoption of monitoring and evaluation components of the aspects and effects of climate change (e.g. indicators for REDD + activities)',
            'In planning, adoption of the aspects related to climate change',
            'Adoptions of measures related to mitigation and adaptation to climate change for animal species (flagship, endangered, endemic, …)',
            'Adoptions measures related to mitigation and adaptation to climate change for vegetal species (flagship, endangered, endemic, …)',
            'Adoptions measures related to mitigation and adaptation to climate change for habitats and the land use in and outside of the protected area (land cover - use - take)',
            'Adoptions measures related to mitigation and adaptation to climate change for ecosystem services and the dependence of local populations (the transition zone for MAB reserves)',
            'Adopt measures for mitigation and adaptation to climate change for sustainable use of natural resources in the buffer zone of the protected area',
            'Adoption of adaptive and proactive approach in managing the effects of climate change',
            'Adoption of building human resource capacity in planning, monitoring and evaluation, management and governance processes related to climate change (e.g. REDD+ plus activities)',
            'Adoption of a commitment and accountability of the stakeholder approach in planning and processes related to climate change and their reference AP ecosystems',
            'Adoption benchmarks-indicators for mitigation and adaptation to climate change (e.g. carbon stock, invasive alien species, fires, etc.)',
            'Adoption of the aspects of climate change in the strategies of communication, environmental education and education for sustainable development environmental of the protected area (benefits) and their reference ecosystems (sustainable management of natural resources)'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'no climate change mitigation or adaptation activities/programmes within the protected area',
                '1' => 'ad hoc activities/programmes, but not aligned with needs for mitigation of and adaptation to climate change',
                '2' => 'activities/programmes partially aligned with needs for mitigation of and adaptation to climate change',
                '3' => 'activities/programmes aligned with needs for mitigation of and adaptation to climate change',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Is the protected area managed so as to take into account the effects of climate change?</li> <li><b>Assess the provisions for mitigation and adaptation that aim to take account of the effects of climate change in planning and management for the protected area</b></li> </ul>',
        'module_info_Rating' => 'Evaluate planning/management activities and programmes for the protected area that are focused on mitigating climate change and on adaptation activities for conserving biological diversity and the sustainable management of natural resources (based on the Operational Context factors in points 4; 5; 7) (e.g. see REDD+ projects)'
    ],

    'EcosystemServices' => [
        'title' => 'Ecosystem services',
        'fields' => [
            'Intervention' => 'Interventions',
            'EvaluationScore' => 'Effectiveness in conservation',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Provisioning – Nutrition (e.g. water, trees of caterpillars, medicinal plants, etc. in and around the protected area)',
            'group1' => 'Provisioning – Materials (e.g. producing reforestation, NWFP for sustainable use)',
            'group2' => 'Provisioning – Energy (e.g. hydropower)',
            'group3' => 'Regulating - Remediation of waste materials, toxic substances and other pollution (e.g. filtering and decomposition of organic waste and pollutants in waters)',
            'group4' => 'Regulating - Remediation of flows (e.g. protection reforestation)',
            'group5' => 'Regulating - Maintaining biological, chemical and physical conditions (e.g. pollination, mitigate the damage caused by natural disasters)',
            'group6' => 'Cultural - Physical interactions and experience (e.g. environmental education)',
            'group7' => 'Cultural - Intellectual interactions and performances (e.g. research)',
            'group8' => 'Cultural - Spiritual and/or emblematic (e.g. traditional rites)',
            'group9' => 'Cultural - Other cultural excursions (e.g. botanical garden, shelter animals, ex-situ conservation, etc.)',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'inadequate',
                '1' => 'not adequate to preserve/enhance essential ecosystem services',
                '2' => 'below the ideal level for preserving/enhancing ecosystem services',
                '3' => 'appropriate for preserving/enhancing ecosystem services',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>- Has action been taken/is there a programme to promote the conservation/enhancement of the ecosystem services provided by the protected area?</li> <li><b>Determine the effectiveness of the conservation/enhancement of ecosystem services</b></li> </ul>',
        'module_info_Rating' => 'List three or more ways in which the protected area preserves or enhances ecosystem services provided for human well-being (based on the Operational Context factors in point 7))'
    ],

    'ObjectivesProcessus' => [
        'title' => 'Setting target objectives',
        'fields' => [
            'Status' => 'Baseline',
            'Benchmark1' => 'Reference value, benchmark 1',
            'Benchmark2' => 'Reference value, benchmark 2',
            'Benchmark3' => 'Reference value, benchmark 3',
            'Objective' => 'Objectif - Conditions souhaitées',
        ],
        'module_info' => 'Setting target conservation objectives and indicators related <b>to implementation process of the planning</b> of the protected area<br /> The objectives and benchmarks to be entered in the table below are to be used in managing and monitoring activities in the protected area and more specifically, in the planning, resource (input) mobilisation and process phases, and in identifying outputs and outcome objectives.'
    ],

    'WorkProgramImplementation' => [
        'title' => 'Implementation of the programme of work',
        'fields' => [
            'Activity' => 'Categories of intervention',
            'Action' => 'Action',
            'EvaluationScore' => '',
            'Percentage' => 'Percentage of implementation',
            'Comments' => 'Comments/Explanation',
        ],
        'module_info' => 'The statistical system allows only five lines to identify the functions of the staff of the protected area',
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'no implementation of annual (multi-year) activity (0%)',
                '1' => 'low level of implementation of annual (multi-year) activity (between 1 and 33%) ',
                '2' => 'moderate level of implementation of annual (multi-year) activity (between 34 and 66%)',
                '3' => 'high level of implementation of annual (multi-year) activity (between 66 and 100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>How and in what proportion has the protected area implemented the main activities of the work plan?</li> <li><b>Evaluation of the <span style="text-decoration: underline">implementation</span> of the main activities of the work plan</b></li> </ul>',
        'module_info_Rating' => 'List not more than five primary activities of the work plan to evaluate their implementation'
    ],

    'AchievedResults' => [
        'title' => 'Outputs achieved',
        'fields' => [
            'Activity' => 'Main activities of the work plan',
            'EvaluationScore' => 'Level of outputs of annual activities ',
            'Percentage' => 'Percentage of outputs',
            'Comments' => 'Comments/Explanation',
        ],
        'module_info' => 'The statistical system allows only five lines to identify the functions of the staff of the protected area',
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'output not achieved (0%)',
                '1' => 'low level of achievement of output (between 1 and 33%)',
                '2' => 'moderate level of achievement of output (between 34 and 66%)',
                '3' => 'high level of achievement of output (between 66 and 100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>How and in what proportion has the protected area achieved the main <b>outputs</b> from the work plan?</li> <li><b>State the proportion of the five main <span style="text-decoration: underline">outputs</span> from annual activities of the work plan that is estimated to have been achieved </b></li> </ul>',
        'module_info_Rating' => 'List not more than five main outputs from annual activities of the work plan that is estimated to have been achieved'
    ],

    'AchievedObjectives' => [
        'title' => 'Achievement of conservation objectives',
        'fields' => [
            'Objective' => 'Main or secondary objectives of the management plan',
            'EvaluationScore' => ' Level of achievement',
            'Percentage' => 'Proportion of the objective achieved',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'objective of the work plan and management plan not achieved (0%)',
                '1' => 'low level of achievement of the objective of the work plan and the management plan (between 1 and 33%)',
                '2' => 'moderate level of achievement of the objective of the work plan and the management plan (between 34 and 66%)',
                '3' => 'high level of achievement of the objective of the work plan and management plan (between 66–100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>How and in what proportion has the protected area achieved the objectives of the management plan?</li> <li><b>Determine the achievement of the objectives set</b></li> </ul>',
        'module_info_Rating' => 'List five or more main or secondary objectives of the management plan to evaluate their level of achievement'
    ],

    'DesignatedValuesConservation' => [
        'title' => 'Conservation status of the designated values or the key elements of the protected area',
        'fields' => [
            'Value' => 'Values',
            'EvaluationScore' => 'Conservation status of the values',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Impact of the activities of management on the conservation status of animal species (flagship, endangered, endemic, …) chosen as indicators',
            'group1' => 'Impact of the activities of management on the conservation status of vegetal species (flagship, endangered, endemic, …) chosen as indicators',
            'group2' => 'Impact of the activities of management on the conservation status of habitats and the land use in and outside of the protected area (land cover - use - take)',
            'group3' => 'Impact of the activities of management on the conservation status of legal and sustainable use of natural resources (customary law and protected areas management of natural resources)',
            'group4' => 'Impact of the activities of management on the control/protection of direct and indirect threats to the protected area',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '-3 / -2 / -1' => 'Negative (least negative - worst)',
                '0' => 'Stable',
                '+1 / +2 / +3' => 'Positive (least good - best)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>What are the <span style="text-decoration: underline">conservation status </span> for the designated values of the protected area?</li> <li><b>Determine the impact of the management on the conservation status of the designated values for the protected area</b></li> </ul>',
        'module_info_Rating' => 'Evaluate the impact of the activities of management on the conservation status of the values of the protected (based on the Operational Context factors in points 4; 5; 6; 7)'
    ],

    'DesignatedValuesConservationTendency' => [
        'title' => 'Trends in the conservation status of the designated values or key elements of the protected area',
        'fields' => [
            'Value' => 'Valeus',
            'EvaluationScore' => 'Trends of the values',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Impact of the activities of management on the conservation trends of animal species (flagship, endangered, endemic, …) chosen as indicators',
            'group1' => 'Impact of the activities of management on the conservation trends of vegetal species (flagship, endangered, endemic, …) chosen as indicators',
            'group2' => 'Impact of the activities of management on the conservation trends of habitats and the land use in and outside of the protected area (land cover - use - take)',
            'group3' => 'Impact of the activities of management on the conservation trends of legal and sustainable use of natural resources (customary law and protected areas management of natural resources)',
            'group4' => 'Impact of the activities of management on the control/protection of direct and indirect threats to the protected area',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '-3 / -2 / -1' => 'Negative (least negative - worst)',
                '0' => 'Stable',
                '1 / 2 / 3' => 'Positive (least good - best)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>What are the <span style="text-decoration: underline">conservation trends</span> of the designated values of the protected area?</li> <li>Assess the <span style="text-decoration: underline">conservation trends</span> of the designated values for the protected area</li> </ul>',
        'module_info_Rating' => 'Evaluate the impact of the activities of management on the conservation trends of the values of the protected (based on the Operational Context factors in points 4; 5; 6; 7)'
    ],

    'LocalCommunitiesImpact' => [
        'title' => 'Outcomes for local communities',
        'fields' => [
            'Impact' => 'Economic/Social outcomes',
            'EvaluationScore' => 'Current level of impact of the economic/social outcomes',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Employment of local staff',
            'Payment for local goods and services',
            'Regional recruitment of security guards',
            'Tourism and impacts in terms of employment',
            'Pilot project for reducing human-wildlife conflict',
            'Schools, dispensaries, social support',
            'Support for food production and small farming (oysters)',
            'Water points and water supply',
            'Improvements to roads',
            'Power supply, electrical connection'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '-3 / -2 / -1' => 'Negative (least - most severe)',
                '0' => 'None',
                '1 / 2 / 3' => 'Positive (least - most significant)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Does the protected area bring economic benefits or disadvantages for local communities, such as income, employment, payment for environmental services, etc.?</li> <li>Determine the economic outcome of the management of the protected area for local communities</li> </ul>',
        'module_info_Rating' => 'Evaluate the economic outcomes for local communities resulting from the management of the protected area'
    ],

    'ClimateChangeImpact' => [
        'title' => 'Outcomes of mitigation of and adaptation to climate change',
        'fields' => [
            'Impact' => 'Outcomes',
            'EvaluationScore' => 'Current level of outcomes',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Outcomes of measures related to mitigation and adaptation to climate change for animal species (flagship, endangered, endemic, …)',
            'Outcomes of measures related to mitigation and adaptation to climate change for vegetal species (flagship, endangered, endemic, …)',
            'Outcomes of measures related to mitigation and adaptation to climate change for habitats and the land use in and outside of the protected area (land cover - use - take)',
            'Outcomes of measures related to mitigation and adaptation to climate change for ecosystem services and the dependence of local populations (the transition zone for MAB reserves)',
            'Outcomes of measures related to mitigation and adaptation to climate change for sustainable use of natural resources in the buffer zone of the protected area'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '-3 / -2 / -1' => 'Negative (least - most severe)',
                '0' => 'None',
                '1 / 2 / 3' => 'Positive (least - most significant)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Does the management of the protected area take account of the likely effects of climate change?</li> <li>Assess the effects of the mitigation of and adaptation to climate change in the management of the protected area</li> </ul>',
        'module_info_Rating' => 'Evaluate the outcomes from the management of the protected area that are intended to mitigate and adapt to climate change, to benefit the conservation of biological diversity and the sustainable management of natural resources (based on the Operational Context factors in points 4; 5; 6; 7)'
    ],

    'EcosystemServicesImpact' => [
        'title' => 'Outcomes for ecosystem services',
        'fields' => [
            'Impact' => 'Outcomes',
            'EvaluationScore' => 'Current level of outcomes',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Provisioning of Nutrition',
            'Provisioning of Materials',
            'Provisioning of Energy',
            'Regulating: Remediation of waste materials, toxic substances and other pollution',
            'Regulating: Remediation of flows',
            'Regulating: Preservation of biological, chemical and physical conditions',
            'Cultural: Physical interactions and experience',
            'Cultural: Intellectual interactions and performances',
            'Cultural: Spiritual and/or emblematic',
            'Cultural: Other cultural aspects (ex situ conservation)'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '-3 / -2 / -1' => 'Negative (least - most severe)',
                '0' => 'None',
                '+1 / +2 / +3' => 'Positive (least - most significant)',
            ]
        ],
        'module_info_EvaluationQuestion' => '<ul> <li>Does the protected area provide outcomes for the preservation/enhancement of ecosystem services?</li> <li>Determine the outcomes from the management of the protected area for the preservation/enhancement of ecosystem services</li> </ul>',
        'module_info_Rating' => 'Evaluate the outcomes from the management of the protected area that are intended to mitigate and adapt to climate change, to benefit the conservation of biological diversity and the sustainable management of natural resources (based on the Operational Context factors in point 7)'
    ]

];
