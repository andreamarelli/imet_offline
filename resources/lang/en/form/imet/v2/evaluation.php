<?php

return [

    '_Objectives' => [
        'title' => 'Setting objectives',
        'fields' => [
            'Element' => 'Element/Indicator',
            'Status' => 'Baseline',
            'Objective' => 'Objective - Favourable conservation status',
            'comments' => 'Comments'
        ],
    ],

    'ImportanceClassification' => [
        'title' => 'Special Designations',
        'fields' => [
            'Aspect' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Integration',
            'SignificativeClassification' => 'Highly significant international designation',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'no integration',
                '1' => 'low integration',
                '2' => 'moderate integration',
                '3' => 'high integration',
            ]
        ],
        'module_subTitle' => 'Value and Importance - Special Designations',
        'module_info_EvaluationQuestion' => [
            'Has the protected area included the values and importance of national, regional or international designations in the management of the protected area?'
        ],
        'module_info_Rating' => [
            'Evaluate the integration of the values and importance of the designations (national designation and international designation, e.g. World Heritage site or Ramsar site) in the management of the protected area'
        ]
    ],

    'ObjectivesClassification' => [
        'module_info' => 'Establish and describe conservation objectives for <b>the current national, regional or international designation(s) </b> of the protected area<br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the protected area.'

    ],

    'ImportanceSpecies' => [
        'title' => 'Key Species',
        'fields' => [
            'Aspect' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Integration',
            'SignificativeSpecies' => 'Highly representative specie',
            'IncludeInStatistics' => 'To prioritise in management',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Identify the animal species (flagship, endangered, endemic, …) chosen as key species',
            'group1' => 'Identify the plant species (flagship, endangered, endemic, …) chosen as key species',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'no integration',
                '1' => 'low integration',
                '2' => 'moderate integration',
                '3' => 'high integration',
            ]
        ],
        'module_subTitle' => 'Value and Importance - Species (flagship, endangered, endemic, exploited, invasive, etc.)',
        'module_info_EvaluationQuestion' => [
            'Has the protected area clearly identified and integrated the key species in the management of the protected area?'
        ],
        'module_info_Rating' => [
            'Evaluate the level of integration of 3 to 10 key species in the management of the protected area (based on an analysis of the Context of Intervention, points 4.1 and 4.2, automatically reported below). (The representativeness or highly representative of a key specie corresponds to the degree to which it: (i) represents a strong natural characteristic of one habitat, ecosystem, biome; (ii) influences an ecological process or community or (iii) affects a species-directed management policy)'
        ],
        'validation_3to10' => 'Please include in statistics not less than 3 and not more than 10 of the key species',
        'warning_on_save' =>
            'WARNING!! <br /> Any modification may cause data loss in the following
            evaluation modules (if already encoded):<br /><i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'ObjectivesSpecies' => [
        'module_info' => 'Establish and describe conservation objectives for for <b>species (flagship, endangered, endemic, exploited, invasive and for which there is insufficient data) </b> in the protected area<br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the protected area.'
    ],

    'ImportanceHabitats' => [
        'title' => 'Terrestrial and marine habitats - land-cover, land-change and land-take',
        'fields' => [
            'Aspect' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Integration',
            'EvaluationScore2'=> 'Regional and global value/importance',
            'IncludeInStatistics' => 'To prioritise in management',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Identify the most important habitats of the protected area',
            'group1' => 'Identify the most important elements of land cover, land-change and land-take inside and outside the protected area',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'no integration',
                '1' => 'low integration',
                '2' => 'moderate integration',
                '3' => 'high integration',
            ],
            'EvaluationScore2' => [
                '1' => 'low value/importance',
                '2' => 'moderate value/importance',
                '3' => 'high value/importance',
            ],
        ],
        'module_subTitle' => 'Value and Importance - Terrestrial and marine habitats - land-cover, land-change and land-take',
        'module_info_EvaluationQuestion' => [
            'Has the protected area clearly identified and integrated the most important terrestrial and marine habitats and dimensions of land-cover, land-change and land-take in the management of the protected area'
        ],
        'module_info_Rating' => [
            'Evaluate the level of integration in the management of the protected area of 3 to 10 of the most representative and important habitats and dimensions of land-cover, land-change and land-take types (based on the analysis of the Context of Intervention, points 4.3.1 and 4.3.2, automatically reported below). (The regional and global value/importance of habitats and of land-cover is a degree to which it: (i) represents at the regional or global level the natural environment of key plants or animals; (ii) influences an ecological process or community and (iii) affects a habitat / land cover directed management policy)'
        ],
        'validation_3to10' => 'Please include in statistics not less than 3 and not more than 10 of the key species',
        'warning_on_save' =>
            'WARNING!! <br /> Any modification may cause data loss in the following
            evaluation modules (if already encoded):<br /><i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'ObjectivesHabitats' => [
        'module_info' => 'Establish and describe conservation objectives for maintaining of <b>maintaining terrestrial and marine habitats and the most important land-cover, land-change and land-take elements</b> of the protected area<br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the protected area.'
    ],

    'ImportanceClimateChange' => [
        'title' => 'Climate Change',
        'fields' => [
            'Aspect' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Integration',
            'IncludeInStatistics' => 'To prioritise in management',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'no integration',
                '1' => 'low integration',
                '2' => 'moderate integration',
                '3' => 'high integration',
            ]
        ],
        'module_subTitle' => 'Value and Importance - Climate Change',
        'module_info_EvaluationQuestion' => [
            'Has the protected area clearly identified and integrated the key elements (species, habitats, etc.) most vulnerable to climate change in the management of the protected area to adopt the best available adaptation measures?'
        ],
        'module_info_Rating' => [
            'Evaluate the level of integration in the management of the protected area of the most important key elements (species, habitats, etc.) most vulnerable to climate change (based on the analysis of the Context of Intervention, points CTX6.1, automatically reported below)'
        ],
        'warning_on_save' =>
            'WARNING!! <br /> Any modification may cause data loss in the following
            evaluation modules (if already encoded):<br /><i>I1</i>, <i>PR7</i>, <i>PR17</i> and <i>O/C2</i>'
    ],

    'ObjectivesClimateChange' => [
        'module_info' => 'Establish and describe conservation objectives to the <b> most significant effects of climate change</b> on the protected area<br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the protected area.'
    ],

    'ImportanceEcosystemServices' => [
        'title' => 'Ecosystem services',
        'fields' => [
            'Aspect' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Rating',
            'IncludeInStatistics' => 'To prioritise in management',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'no integration',
                '1' => 'low integration',
                '2' => 'moderate integration',
                '3' => 'high integration',
            ]
        ],
        'module_subTitle' => 'Value and Importance - Ecosystem services',
        'module_info_EvaluationQuestion' => [
            'Has the protected area clearly identified and integrated the most important ecosystem services for human well-being in the management of the protected area?'
        ],
        'module_info_Rating' => [
            'Evaluate the level of integration in the management of the protected area of the most important ecosystem services (based on the analysis of the Context of Intervention point CTX7.1, automatically reported below)'
        ],
        'warning_on_save' =>
            'WARNING!! <br /> Any modification may cause data loss in the following
            evaluation modules (if already encoded):<br /><i>I1</i>, <i>PR7</i>, <i>PR18</i> and <i>O/C2</i>'
    ],

    'ObjectivesEcosystemServices' => [
        'module_info' => 'Establish and describe conservation objectives for <b>preserving ecosystem services</b> in the protected area<br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the protected area.'
    ],

    'SupportsAndConstraints' => [
        'title' => 'External constraints or supporting',
        'fields' => [
            'Aspect' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Influence/power of the stakeholders',
            'EvaluationScore2'=> 'Level of the constraint or support',
            'Comments' => 'Comments/Explanation',
        ],
        /*'predefined_values' => [
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
        ],*/

        'groups' => [
            'group0' => 'Local community',
            'group1' => 'Government',
            'group2' => 'Donors, Scientists, Researchers and NGOs',
            'group3' => 'Economic operators',
        ],
        'predefined_values' => [
            'group0' => [
                'Traditional authorities',
                'Indigenous peoples',
                'Communities living close to or in the park',
                'Rightholders',
                'Landowners',
                'Local users of natural resources',
                'Local users of non-timber forest products (NTFP)',
                'Underrepresented or disadvantaged groups',
            ],
            'group1' => [
                'Central Government',
                'Local Government',
                'Territorial / departmental and municipal council',
                'Protected areas authority',
                'Local Land Services environment',
                'Representatives of local populations (parliamentary representatives, etc.)',
                'Armed forces (paramilitary police force and navy)',
            ],
            'group2' => [
                'Social rights NGO',
                'Environmental NGO',
                'Scientists / Researchers',
                'Donors',
            ],
            'group3' => [
                'Private tourism operators',
                'Forestry operators',
                'Fishing operators',
            ],
        ],

        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this stakeholder is not involved in the process',
                '1' => 'Low influence/power',
                '2' => 'Moderate influence/power',
                '3' => 'High influence/power'
            ],
            'EvaluationScore2' => [
                '-3' => 'Severe constraints generated by this stakeholder ',
                '-2' => 'Constraints generated by this stakeholder',
                '-1' => 'Some constraints generated by this stakeholder',
                '0' => 'Neither constraining nor supporting role of this stakeholder',
                '+1' => 'Some supports from this stakeholder',
                '+2' => 'Support (least–moderate–severe)',
                '+3' => 'Strong supports from this stakeholder',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Is the protected area management subject to constraints or does it benefit from supporting factors arising from the external political, institutional and social environment?',
            '<i>The political, institutional and civil environment can obstruct (external constraints) or facilitate (external supports) conservation activities of the protected area. The constraints or supports by the external political, institutional and civil environment can be measured by their intensity, and by the influence/power of the stakeholders in constraining or supporting the protected area.</i>'
        ],
        'module_info_Rating' => [
            'Evaluate the most important constraints or supporting factors from the external political, institutional and civil environment in the management of the protected area'
        ]
    ],

    'ObjectivesSupportsAndConstraints' => [
        'module_info' => 'Establish and describe conservation objectives for <b>constraints or supporting factors</b> for the protected area<br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the protected area.'
    ],

    'Menaces' => [
        'title' => 'Threats',
        'fields' => [
            'Aspect' => 'Threats evaluation (automatically reported from CTX 5.1)',
            'IncludeInStatistics' => 'To prioritise in management',
            'Comments' => 'Comments/Explanation',
        ],
        'module_info_EvaluationQuestion' => [
            'Has the protected area clearly identified and integrated the threats (pressures, threats and vulnerabilities) that could affect the area’s biodiversity, cultural heritage, ecosystem services, etc. in the management of the protected area??'
        ],
        'module_info_Rating' => [
            'Evaluate the level of integration in the management of the protected area of most important threats based on the analysis of the threats calculator at Context of intervention point CTX 5.1 and automatically reported below.'
        ],
        'warning_on_save' =>
            'WARNING!! <br /> Any modification may cause data loss in the following
            evaluation modules (if already encoded):<br /><i>I1</i>, <i>PR7</i> and <i>O/C2</i>'
    ],

    'ObjectivesMenaces' => [
        'module_info' => 'Setting target conservation objectives and indicators for <b>the most important threats facing</b> the protected area<br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the protected area.'
    ],

    'RegulationsAdequacy' => [
        'title' => 'Adequacy of legal and regulatory provisions',
        'fields' => [
            'Regulation' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Gazetting and designation (e.g. national park)',
            'Clarity of legal demarcation of the protected area (e.g. natural boundaries such as rivers, non-natural boundaries, customary rights, enclaves, etc.).',
            'Internal rules for the management of the protected area',
            'Ratification and application of international conventions (CITES, CBD, Nagoya, CMS, World Heritage, RAMSAR, etc.)',
            'Laws on protected area and conservation',
            'Laws on the management of natural resources (complementary to laws on conservation)',
            'Laws and conventions on research about biodiversity and natural resources',
            'Laws on land rights',
            'Customary law',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'Fully inadequate',
                '1' => 'Somewhat inadequate',
                '2' => 'Adequate',
                '3' => 'Fully adequate',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Are the current legal and regulatory provisions adequate for conservation and natural resources management activities in the protected area?',
            '<i>Adequate legislation and regulatory provisions are the basis for an effective and robust governance and management framework for the protected area and, more importantly, for ensuring its long-term sustainability for current and future generations</i>'
        ],
        'module_info_Rating' => [
            'Identify and evaluate the adequacy of the current legal and regulatory provisions for conservation and natural resources management in the protected area'
            ]
    ],

    'DesignAdequacy' => [
        'title' => 'Design and layout of the protected area',
        'fields' => [
            'Values' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Size (surface area)',
            'Configuration or shape of the protected area',
            'Boundary/area ratio, value based on the analysis of context of intervention, point CTX 2',
            'Border zone (areas near borders immediately outside of the protected area that have special rules on resources use)',
            'Buffer zones (areas surrounding a protected area, where special management of resources use and special development measures are undertaken in order to enhance the conservation value of the protected area)',
            'Corridors',
            'Integrity of water catchment'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'Fully inadequate',
                '1' => 'Somewhat inadequate',
                '2' => 'Adequate',
                '3' => 'Fully adequate',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Is the design and layout of the protected area adequate for protecting species, habitats, other values and maintaining natural processes (e.g. water catchments)?',
            'Background methodology. The design and layout (spatial configuration or shape) affect the management of ecosystems, biodiversity and other values of a protected area. Designing protected areas to protect values is complicated and not all protected areas have an optimal design and layout to represent and maintain their ecosystems, biodiversity and other values. The current spatial configuration of the protected area should be assessed with respect to the objective of conserving its key values. The analysis should show whether the design and layout are adequate to fully protect representative ecosystems, biodiversity and other values, or whether an improved layout should be proposed, if feasible.'
        ],
        'module_info_Rating' => [
            'Evaluate if the design and layout of the protected area (based on analysis of the Context of intervention point CTX2) is adequate for ensuring that its key values are protected and can be well managed.'
        ]
    ],

    'BoundaryLevel' => [
        'title' => 'Demarcation of the protected area',
        'fields' => [
            'Boundaries' => 'Degree of marked boundaries',
            'BoundariesComments' => 'Comments/Explanation',
            'Adequacy' => 'Adequacy of the boundaries',
            'EvaluationScore' => 'Adequacy',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Correspondence of the marked boundaries with respect to the legal standing',
            'Adequacy of marked boundaries',
            'Boundaries marked by natural elements (e.g. rivers)',
            'Boundaries marked by specific marks (e.g. buoys, signs, posts, beacons, fences, etc.)',
            'Recognition of boundaries by the authorities',
            'Recognition of boundaries by communities/users',
            'Collaboration in the demarcation of boundaries',
            'Publication of information of the boundaries demarcation',
            'Demarcation and development of legal boundaries consistent with legal statutes and international laws if necessary',
            'Demarcation using the official source of reference dat',
            'Boundaries recorded with geographic coordinates (degree, min, sec)',
            'Demarcation of PA use zones (zoning)',
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
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'Fully inadequate (0-30% of the needs)',
                '1' => 'Somewhat inadequate (31-60% of the needs)',
                '2' => 'Adequate (61-90% of the needs)',
                '3' => 'Fully adequate (91-100% of the needs)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Is the boundary of the protected area marked and adequate?',
            'The physical demarcation of a protected area is in general a legal obligation. The demarcation of the boundary meets the requirements to signal which is the limit of the protected area establish by specific legislation. The demarcation of protected areas is useful from a legal point of view, since it allows defining exactly where to apply specific legal framework (i.e. applying sanctions). It should be noted, however, that while the useful, the demarcation is not by itself a sufficient measure of protection and the knowledge and acceptance of boundaries of the protected area by the stakeholders is necessary for conservation.'
        ],
        'module_info_Rating' => [
            'Evaluate  <ol type="A"><li>the degree to which the boundaries of the protected area marked</li><li>the adequacy of the boundaries demarcation for the management of the protected area</li></ol>'
        ]
    ],

    'ManagementPlan' => [
        'title' => 'Management plan',
        'fields' => [
            'PlanExistence' => 'A) Is there a management plan?',
            'PlanUptoDate' => 'Is the management plan up to date?',
            'PlanApproved' => 'Has the management plan been approved?',
            'PlanImplemented' => 'Is the management plan been implemented?',
            'VisionAdequacy' => 'B) Adequacy of the vision, mission and objectives in the management plan to the needs of conservation',
            'PlanAdequacyScore' => 'C) Adequacy regarding the clarity and applicability',
            'Comments' => 'Comments / Explanation',
        ],
        'ratingLegend' => [
            'VisionAdequacy' => [
                '0' => 'The vision, mission and objectives of the management plan are fully inadequate',
                '1' => 'The vision, mission and objectives of the management plan are somewhat inadequate',
                '2' => 'The vision, mission and objectives of the management plan are adequate',
                '3' => 'The vision, mission and objectives of the management plan are fully adequate'
              ],
              'PlanAdequacyScore' => [
                  '0' => 'The clarity and applicability of the vision, mission and objectives are fully inadequate (0-30% of needs)',
                  '1' => 'The clarity and applicability of the vision, mission and objectives are somewhat inadequate (31-60% of needs)',
                  '2' => 'The clarity and applicability of the vision, mission and objectives are adequate (61-90% of needs)',
                  '3' => 'The clarity and applicability of the vision, mission and objectives are fully adequate (91-100% of needs)'
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Is there a management plan, is it adequate and practical to implement for the protected area?',
            'The Management Plan is a document which sets the management approach and goals, together with a framework for decision-making, which apply to a specific protected area over a given period of time. Critical to the success of the plan is the widest possible consultation with stakeholders and the development of objectives that can be agreed and adhered to by all who have an interest in the use and ongoing survival of the area concerned (from IUCN: Guidelines for Management Planning of Protected Areas, 2008).'
        ],
        'module_info_Rating' => [
            'Evaluate: A) the status of the management plan, B) the adequacy of the vision, mission and objectives stated in the plan and C) Adequacy of the management plan to the needs of conservation'
        ]
    ],

    'WorkPlan' => [
        'title' => 'Work/Action plan',
        'fields' => [
            'PlanExistence' => 'A) Is there a Work/Action plan? Yes/no',
            'PlanUptoDate' => 'Is the Work/Action plan up to date (covering the current period)? Yes/no',
            'PlanApproved' => 'Has the Work/Action plan been officially approved? Yes/no',
            'PlanImplemented' => 'Is the Work/Action plan being implemented? Yes/no',
            'VisionAdequacy' => 'B) Adequacy of the activities and results of the work/action plan in relation to the objectives of the management plan',
            'PlanAdequacyScore' => 'C) Adequacy regarding the clarity and applicability of the activities and established results of the work/action plan',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'VisionAdequacy' => [
                '0' => 'The activities and results of the work/action plan are fully inadequate in relation to the objectives of the management plan (0-30% of needs)',
                '1' => 'The activities and results of the work/action plan are inadequate in relation to the objectives of the management plan (31-60% of needs)',
                '2' => 'The activities and results of the work/action plan are adequate in relation to the objectives of the management plan (61-90% of needs)',
                '3' => 'The activities and results of the work/action plan are fully adequate in relation to the objectives of the management plan (91-100% of needs)'
            ],
            'PlanAdequacyScore' => [
                '0' => 'The clarity and applicability of activities and expected results are fully inadequate',
                '1' => 'The clarity and applicability of activities and expected results are somewhat inadequate ',
                '2' => 'The clarity and applicability of activities and expected results are adequate',
                '3' => 'The clarity and applicability of activities and expected results are fully adequate'
            ],
        ],
        'module_info_Rating' => 'Evaluate: A) the status of the work/action plan, B) the adequacy of the activities and results of the work/action plan in relation to the objectives of the management plan and C) the adequacy regarding the clarity and applicability of the activities and established results of the work/action plan',
        'module_info_EvaluationQuestion' => [
            'Is there a work/action plan, is it adequate and practical to implement for the protected area?',
            'A work/action plan is a detailed plan outlining concrete actions or activities that need to be carried out (and by whom, where and when) in order to achieve outputs and outcomes established in the management plan of the protected area. A work/action plan allows monitoring progress in achieving outputs and outcomes of the protected area. The work/action plan usually covers a fixed period (e.g. calendar year) and creates a bond within the team, as each member is aware of his/her individual role, as well as provides necessary information to ensure the success of the protected area in its conservation efforts.'
        ]
    ],

    'Objectives' => [
        'title' => 'Objectives of the protected area',
        'fields' => [
            'Objective' => 'Objective',
            'EvaluationScore' => 'Adequacy',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Biodiversity status and protection as global value',
            'Animal species – flagship, endangered, endemic, … –',
            'Plants species – flagship, endangered, endemic, … –',
            'Mitigation of the direct and indirect threats to the protected area',
            'Ecosystem services – Provisioning (sustainable use)',
            'Ecosystem services – Regulating (sustainable use)',
            'Ecosystem services – Cultural (sustainable use)',
            'Ecosystem services – Supporting',
            'Climate change adaptation',
            'Governance',
            'Support to the local economy',
            'Support social aspects',
            'Tourism and human use',
            'Management systems – staffing, finances, purchasing',
            'Infrastructure and equipment',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'Fully inadequate (0-30% of the needs)',
                '1' => 'Somewhat inadequate (31-60% of the needs)',
                '2' => 'Adequate (61-90% of the needs)',
                '3' => 'Fully adequate (91-100% of the needs)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Are the objectives set for the protected area adequate?',
            'Management of protected areas is increasingly being carried out following the ‘management by objectives’ approach. It is considered proactive, i.e. designed to achieve specific set of results, rather than reactive, i.e., merely responding to issues that arise. The goals and objectives of the protected area have to be clearly understood. They should be well-defined and worded to facilitate monitoring but also should relate to the key values of the protected area (i.e. important species or ecosystems) or to major areas of management activity (e.g. tourism, education). In this tool we make an important distinction between outcomes and outputs.<ul><li>OUTCOMES relate to GOALS / OBJECTIVES, i.e. long-term goals / objectives or visions expressed in the management plan. These goals / objectives are usually specific statements relating to the key values of the protected area (i.e. important species or ecosystem services) or to major areas of management activities (e.g. tourism, education).</li><li>OUTPUTS relate to TARGETS, i.e. short-term (or relatively short-term) quantitative targets to achieve the long-term goals / objectives and specific objectives. We believe that the use of many low-level conservation targets is an obstacle to achieving high-level conservation performance.</li></ul>'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of the management plan objectives for the key elements of the protected area, based on the analysis of the intervention context, points: CTX1.5, CTX 4, 5, 6, 7 and context of management, points from C 1.1 to C 1.5)'
        ]
    ],

    'ObjectivesPlanification' => [
      'module_info' => 'Establish and describe conservation objectives for <b>planning</b> of the protected area<br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the protected area.'
    ],

    'InformationAvailability' => [
        'title' => 'Basic information',
        'fields' => [
            'Element' => 'Rating – Concept measured – Variables',
            'EvaluationScore' => 'Availability',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Animal species (flagship, endangered, endemic, …)',
            'group1' => 'Plant species (flagship, endangered, endemic, …)',
            'group2' => 'Habitats and the land cover - use - take in and outside of the protected area',
            'group3' => 'Threats to the protected area',
            'group4' => 'Effects of climate change on key elements of the protected area',
            'group5' => 'Ecosystem services provided by the protected area'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'No or little information available to assist in the management (0-30% of the needs)',
                '1' => 'Not much information available and insufficient to assist in the management  (31-60% of the needs)',
                '2' => 'Information available but moderately sufficient to assist in the management (61-90% of the needs)',
                '3' => 'Information available and largely sufficient to assist in the management (90-100% of the needs)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Do you have sufficient and targeted information supporting your decision-making in managing the protected area?',
            'Effective protected area management requires sufficient knowledge and information to inform decision-making. The management of a protected area needs sound analysis to summarise and structure relevant information with a view to find solutions for concrete management challenges. Good data and information is a prerequisite for sound analysis, and without such information there cannot be good management'
        ],
        'module_info_Rating' => [
            'Analyse the availability of information to support the management of the key elements of the protected area, based on the analysis of the context of intervention, points CTX 4; 5; 6; 7'
        ]
    ],

    'Staff' => [
        'title' => 'Current staffing',
        'fields' => [
            'Theme' => 'Criteria – Concept measured – Variable',
            'StaffNumberAdequacy'=> 'Adequacy of staff number',
            'StaffCapacityAdequacy'=> 'Adequacy of staff capacities',
            'Comments' => 'Comments/Explanation',
        ],
        'StaffNumberAdequacy' => 'Adequacy of staff number',
        'ratingLegend' => [
            'StaffNumberAdequacy' => [
                '0' => 'Almost no staff (between 0 and 20% of the number required)',
                '1' => 'Not enough staff for essential management activities (between 21 and 40% of the number required)',
                '2' => 'Not enough staff to carry out many management activities (between 41 and 60% of the number required)',
                '3' => 'Enough staff to carry out many but not all activities (between 61 and 80% of the number required)',
                '4' => 'Staff number appropriate to carry out all activities (between 81 and 100% of the number required)'
            ],
            'StaffCapacityAdequacy' => [
                '0' => 'No staff capacities (0-30% of the needs)',
                '1' => 'Insufficient staff capacities (31-60% of the needs)',
                '2' => 'Staff capacities adequate in principle, but further improvements required (61-90% of the needs)',
                '3' => 'Sufficient staff capacities (91-100% of the needs)'

            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Is there enough staff to fulfil the management requirements of the protected area?',
            'Qualified, competent, committed and adequate (in number) staffing is central to the success of protected areas. Staffing needs are definitely correlated with the size, type, vegetation density and the pressures and threats (i.e. human density) of a protected area. For example, for their protection, smaller and more forested protected areas tend to require relatively more staff compared to larger and more open savannah protected areas, which implies higher staff costs. The assessment is based on information in the management plan or the official organisational chart of the staff'
        ],
        'module_info_Rating' => [
            'Evaluate: A) the adequacy of the number of employees (note that the results are automatically calculated on the assessment made in CTX 3.1.1), B) the adequacy of staff capacity'
        ]
    ],

    'BudgetAdequacy' => [
        'title' => 'Current budget',
        'fields' => [
            'EvaluationScore' => 'Adequacy of current budget',
            'Percentage' => 'Percentage indicating the extent to which the budget is adequate relative to the requirements',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'No budget (0% of requirements)',
                '1' => 'Inadequate for even essential management activities (between 1 and 25% of requirements)',
                '2' => 'Inadequate for many management activities (26-50% of requirements)',
                '3' => 'Adequate for essential management activities (between 51 and 70% of requirements)',
                '4' => 'Adequate for many but not all activities (between 71% and 90% of requirements)',
                '5' => 'Adequate for all activities (91% or more of requirements)'

            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Is the current budget adequate for appropriate management of the protected area?',
            'Protected areas prepare their annual operating budgets each year or for a number of years. Key financial planning and budget documents are necessary to improve operational efficiency and effectiveness. The improvement is achieved through the use of performance measures and analysis of processes'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of current year funding of the protected area in relation to conservation requirements (based on the analysis of the context of intervention, point CTX 3.2)'
        ]
    ],

    'BudgetSecurization' => [
        'title' => 'Securing the budget',
        'fields' => [
            'Percentage' => 'A) Evaluate in percent the "Security of future funding"',
            'EvaluationScore' => 'B) Evaluate in years the "Period of security of future funding"',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'Percentage' => [
                '0' => 'Basic financial needs for the protected area management are not secured (0–20% of needs secured)',
                '1' => 'Basic financial needs for the protected area management are very weakly secured (21–40% of needs secured)',
                '2' => 'Basic financial needs for the protected area management are weakly secured (41-60% of needs secured)',
                '3' => 'Basic financial needs for the protected area management are partially secured (61–75% of needs secured)',
                '4' => 'Basic financial needs for the protected area management are relatively well secured (76-90% of needs secured)',
                '5' => 'Basic financial needs for the protected area management are secured (> 90% of needs secured)',
            ],
            'EvaluationScore' =>[
                '0' => 'Basic financial needs for the protected area management are secured only for 1 year (current year)',
                '1' => 'Basic financial needs for the protected area management are secured for 2 years (current year +1 year)',
                '2' => 'Basic financial needs for the protected area management are secured for 3 years (current year +2 years)',
                '3' => 'Basic financial needs for the protected area management are secured for 4 – and more years. (current year +3 years and more)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'How much of the required budget is secured, and for how long, to cover basic protected area management needs?',
            'A secure and reliable budget is critical for protected area planning and management, in particular for large-scale and long-term activities. A realistic assessment of needs should be made to ensure that all costs associated with the work or management plan can be fully met, bearing in mind that some goals will require several years to be achieved. Where resources are not available, the manager must decide how to prioritise activities in terms of timing and investmen'
        ],
        'module_info_Rating' => [
            'Evaluate: A) the security of funding and B) the period of security of funding for the forthcoming years in relation to conservation requirements in the protected area'
        ]
    ],

    'ManagementEquipmentAdequacy' => [
        'title' => 'Infrastructure, equipment and facilities',
        'fields' => [
            'Equipment' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'A) Adequacy of infrastructure, equipment and facilities (CTX 3.3)',
            'Importance' => 'B) Present needs for the availability for the protected area management',
            'Comments' => 'Comments/Explanation',
        ],
        'adequacy' => 'Adequacy of infrastructure, equipment and facilities',
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Fully inadequate (0-30% of the needs)',
                '1' => 'Somewhat inadequate (31-60% of the needs)',
                '2' => 'Adequate (61-90% of the needs)',
                '3' => 'Fully adequate (91-100% of the needs)',
            ],
            'Importance' => [
                '0' => 'Normal',
                '1' => 'High',
                '2' => 'Very high',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Are the infrastructure, equipment and facilities of the protected area adequate for the management requirements?',
            'The infrastructure, equipment and facilities are important to ensure and enhance the operational efficiency and effectiveness of the protected area. The infrastructure, equipment and facilities analysis of a protected area can provide a basis for seeking additional financing. Donors should be encouraged to contribute to achieving and maintaining appropriate levels of infrastructure, equipment and facilities for the management of protected areas'
        ],
        'module_info_Rating' => [
            'Evaluate: A) the adequacy of infrastructure, equipment and facilities (results automatically calculated on the basis of the analysis of the context of intervention, point CTX 3.3), B) the present needs for the availability of specific infrastructure, equipment and facilities for the protected area',
                ]
    ],

    'ObjectivesIntrants' => [
      'module_info' => 'Establish and describe conservation objectives for <b>inputs</b> of the protected area<br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the protected area.'
        ],

    'StaffCompetence' => [
        'title' => 'Staff training and capacity-building programme',
        'fields' => [
            'Theme' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'A) Adequacy of staff capacity / needs analysis and training programme design',
            'PercentageLevel' => 'B) Adequacy of staff capacity building activities',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'Fully inadequate',
                '1' => 'Somewhat inadequate',
                '2' => 'Adequate',
                '3' => 'Fully adequate'
            ],
            'PercentageLevel' => [
                '0' => 'Fully inadequate staff capacity-building activities',
                '1' => 'Somewhat adequate staff capacity building activities',
                '2' => 'Adequate staff capacity-building activities, but improvements are needed',
                '3' => 'Fully adequate staff capacity building activities (sufficient and updated)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Is the protected area implementing an adequate training and capacity-building programme that responds to staff needs in achieving the management objectives?',
            'Qualified, competent and committed staff is central to the success of protected areas. Training of the staff is ever more recognised as a vital component of efficient protected area management. The principal goal of staff training is to raise the capacity of protected area staff to adapt to new challenges, using innovative approaches, if necessary. The analysis OF this point takes into account the adequacy of (A) the training programme design (including analysis, resourcing, design), and (B) the capacity-building activities (including development and delivery of training) in relation to the staff capacity and needs for the management requirements of the protected area'
        ],
        'module_info_Rating' => [
            'For different staff categories / functions (e.g. managers, rangers, etc.) evaluate the adequacy of: (A) training programme design and (B) staff capacity-building activities'
        ]
    ],

    'HRmanagementPolitics' => [
        'title' => 'Human resource management policies and procedures',
        'fields' => [
            'Conditions' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy of the human resource management policies and procedures ',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Compensation and benefits',
            'Recruitment procedures based on merit',
            'Job assignment',
            'Workplace assignment',
            'Health, safety and security',
            'Career and promotion possibilities',
            'Gender and ethnic equity',
            'Rules reducing favouritism and discrimination',
            'Training and development',
            'Management of the relationships with the employees',
            'Human resources information systems'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'Fully inadequate (0-30% of the needs)',
                '1' => 'Somewhat inadequate (31-60% of the needs)',
                '2' => 'Adequate (61-90% of the needs)',
                '3' => 'Fully adequate (91-100% of the needs)'
            ]
        ],
        'module_info_EvaluationQuestion' =>[
            'Has the protected area adopted adequate human resource management policies, procedures and guidelines for the recruitment, promotion, compensation, performance, evaluation and training of staff, their duties and their code of conduct?',
            'Human resource policies outline the approach and the measures to adopt in managing the staff. These policies also provide guidelines for human resource management on various matters concerning different aspects such as recruitment, promotion, compensation, performance, evaluation and training but also staff duties, and their code of conduct, disciplinary procedures, etc. The establishment of clear policies, procedures and guidelines can help to demonstrate, both internally and externally, that the protected area meets requirements for equity, diversity, ethics and training as well as its commitments to meeting regulation requirements and good human resource governance of protected area employees'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of the provisions of the human resource management policies, procedures and guidelines for the protected area'
        ]
    ],

    'HRmanagementSystems' => [
        'title' => 'Work conditions and staff motivation',
        'fields' => [
            'Conditions' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy of staff motivation ',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Clear, specific objectives for assignments',
            'Loyalty and integrity of managers and leaders',
            'Feedback and coaching by managers and leaders',
            'Stimulation and motivation to carry out activities',
            'Feedback on the performed activities',
            'Autonomy to perform tasks adequately',
            'Involving of taff in decisions about their work and job',
            'Appropriate remuneration (wages, bonuses and social security)',
            'Appropriate working conditions (work equipment, outfits, etc.)',
            'Motivation from political, administrative and military authorities',
            'Motivation from legal authorities',
            'Motivation from local communities'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'Fully inadequate (0-30% of the needs)',
                '1' => 'Somewhat inadequate (31-60% of the needs)',
                '2' => 'Adequate (61-90% of the needs)',
                '3' => 'Fully adequate (91-100% of the needs)'
                ]
        ],
        'module_info_EvaluationQuestion' => [
            'Does the management of the protected area use adequate measures / approaches / tools for ensuring staff motivation?',
            'For a protected area, motivated staff is essential to achieve success in conservation. Working conditions and staff motivation strongly influence the ability of staff to carry out their work. Managers and leaders must understand that they need to provide a work environment that creates and maintains motivation in the staff to achieve results on conservation',
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of staff motivation measures / approaches / tools in the protected area',
            ]
    ],

    'GovernanceLeadership' => [
        'title' => 'Management guidance of the protected area',
        'fields' => [
            'EvaluationScoreGovernace' => 'A) Adequacy of management\'s communication about the protected area mission and values',
            'EvaluationScoreLeadership' => 'B) Adequacy of management’s results oriented approach',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScoreGovernace' => [
                '0' => 'There is no or extremely limited communication about the protected area vision, mission and values to influence performance, support and feedback of the staff (between 0 and 25% of requirements)',
                '1' => 'There is not a clear enough communication about the protected area mission vision, and values to influence performance, support and feedback of the staff (between 26 and 50% of requirements)',
                '2' => 'There is a clear but not complete communication about the protected area vision, mission and values to influence performance, support and feedback of the staff (between 51 and 75% of requirements)',
                '3' => 'There is complete communication about the protected area vision, mission and values to influence performance, support and feedback of the staff (between 76 and 100% of requirements)'
            ],
            'EvaluationScoreLeadership' => [
                '0' => 'The management is not results oriented in achieving the vision, mission and conservation of values of the protected area',
                '1' => 'The management is weakly results oriented in achieving the vision, mission and conservation of values of the protected area',
                '2' => 'The management is usually results oriented in achieving the vision, mission and conservation of values of the protected area',
                '3' => 'The management is strong results oriented in achieving the vision, mission and the conservation of values of the protected area'
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Does the management of the protected area give adequate direction and guidance for undertaking tasks and executing them?',
            'The management of the protected area should give adequate direction and guidance for any activities related to desk and field operations, resource use, stewardship, law enforcement, monitoring, etc. The assessment of the management guidance should determine whether it is still relevant, effective and current, or if changes are required. Sometimes adjustments may be required to ensure that the management provides adequate direction for the implementation of the expected outputs and outcomes'
        ],
        'module_info_Rating' => 'Evaluate the adequacy of: (A) management’s communication of the mission and values of the protected area and (B) management’s results-oriented approach'
    ],

    'AdministrativeManagement' => [
        'title' => 'Budget and financial management',
        'fields' => [
            'Aspect' => 'Criteria - Measured concept – Variables',
            'EvaluationScore' => 'Rating: Set-up of the basic elements of budgetary and financial management',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Consistency: your financial policies and systems remain consistent',
            'Accountability: you are able to explain and demonstrate to all officials / stakeholders how you have used your resources and what you have achieved',
            'Transparency: your organisation is transparent regarding its work and its finances, making information available to all officials/stakeholders',
            'Integrity: individuals in your organisation are operating with honesty and propriety',
            'Financial stewardship: your organisation takes good care of the financial resources it has been given and ensures that they are used for the purpose intended.',
            'Accounting standards: your organisation\'s system for keeping financial records and documentation follows accepted external accounting standards'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'Never',
                '1' => 'Rarely',
                '2' => 'Sometimes',
                '3' => 'Often',
                '4' => 'Always'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Are the budget and financial resources well managed so as to meet essential and priorities management requirements of the protected area?',
            'The budget and financial management should be a significant system for the protected area. It ensures the budget functionality that would permit budgeting, allocation of position costs across programs, dynamic and detailed forecasting of position costs, integration of strategic planning and performance measurement data, etc. Budget and financial management is more than keeping accounting records. It is an essential part of planning, organising, controlling and monitoring financial resources in order to achieve conservation objectives of the protected area. You can only achieve effective budget and financial management if you have a sound management and work plan. A plan in this context means having set objectives and having agreed, developed and evaluated the policies, strategies, tactics and actions to achieve the objectives.'
        ],
        'module_info_Rating' => [
            'Evaluate the set-up of the basic elements that must be in place to achieve good practice in budget and financial management. (There is no single model of a budget and financial management system that suits all organisations, but there are some basics that must be in place to achieve good practice in budget and financial management)'
        ]
    ],

    'EquipmentMaintenance' => [
        'title' => 'Maintenance of infrastructure, equipment and facilities',
        'fields' => [
            'Equipment' => 'Criteria - Measured concept – Variables',
            'EvaluationScore' => 'Rating: Adequacy of maintenance',
            'AdequacyLevel' => 'Value from CTX 3.3',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'Fully inadequate (0-30% of the needs)',
                '1' => 'Somewhat inadequate (31-60% of the needs)',
                '2' => 'Adequate (61-90% of the needs)',
                '3' => 'Fully adequate (91-100% of the needs)'
                ]
        ],
        'module_info_EvaluationQuestion' => [
            'Are the protected area’s infrastructure, equipment and facilities adequately maintained?',
            'Preventive maintenance is the term used for routine recurring maintenance performed on infrastructure, equipment and facilities to keep them running smoothly and efficiently and to help extend their life. Poorly maintained infrastructure, equipment and facilities not only wear out more quickly, but also waste resources and fundamentally degrade the protected area’s capacity to achieve conservation objectives. The protected area should work to prevent both of these conditions through an adequate maintenance programme'
        ],
        'module_info_Rating' => [
            'Evaluate the level of maintenance of infrastructure, equipment and facilities in relation to management requirements for the protected area (based on the analysis of the context of intervention, point CTX 3.3)'
        ]
    ],

    'ManagementActivities' => [
        'title' => 'Managing the key values and threats of the protected area with specific actions',
        'fields' => [
            'Activity' => 'Criteria - Measured concept – Variable',
            'EvaluationScore' => 'Adequacy of management actions',
            'InManagementPlan' => 'Action included in the management plan',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Animal species (flagship, endangered, endemic, …)',
            'group1' => 'Plant species (flagship, endangered, endemic, …)',
            'group2' => 'Habitats the most important of the protected area',
            'group3' => 'Land cover the protected area (land cover - use - take)',
            'group4' => 'Management to mitigate threats to the protected area',
            'group5' => 'Ecosystem services',
            'group6' => 'Other',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'Fully inadequate (0-30% of the needs)',
                '1' => 'Somewhat inadequate (31-60% of the needs)',
                '2' => 'Adequate (61-90% of the needs)',
                '3' => 'Fully adequate (91-100% of the needs)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Are there in place specific management actions for the key values and threats to the protected area?',
            'The main management objective of protected areas is conservation/restoration of natural and associated cultural values.To preserve protected areas, in addition to ensuring their protection, managers should use the available management advice and guidelines, identify and implement the required measures using best practices for the benefit of key values and minimising the most significant threats. Actions can include conservation/restoration of animal and plant species, land cover and managing various threats (note: for the climate change adaptation and ecosystem services management actions see PR 17 and PR 18). Examples of actions: management of animals or plants, management of the physical environment, managing fire, revegetation work, controlling invasive species, management of cultural resources, minimise threats, etc.'
        ],
        'module_info_Rating' => [
            'List three or more key values, threats and other key elements and evaluate the adequacy of related management actions (based on the analysis of the context of intervention points CTX 4 and 5)'
        ]
    ],
    'LawEnforcementImplementation' => [
        'title' => 'Ranger patrols management (Law enforcement)',
        'fields' => [
            'Element' => 'Criteria – Concept measured – Variable',
            'Adequacy'=> 'Adequacy of ranger patrols management',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Proactive strategic management',
			'Collaborative surveillance (protection achived through a combination of enforcement and collaboration with communities)',
            'Standard operating procedures (SOPs)',
            'Emergency operating procedures',
            'Rapid intervention procedures',
			'Non collaborative (technology: radar, optical-infrared, radio monitoring Vs technology poor performance, qualified rangers)',
            'Adaptable and diverse tactics (e.g. complementary patrol types, such as observation points, vehicle/boats-assisted patrols, and ambushes, etc.)',
            'Enforcement strategies that combine technology with sea patrols (eg. satellite monitoring and vehicle/boats-assisted patrols)',
			'Efficient decision-making process for standard and emergency operating procedures',
            'Elite units (highest performing rangers/scouts) management',
            'Operations control room',
            'Outposts/pickets - inside park',
            'Outposts/pickets - outside park',
            'Multi-day patrols',
            'Use of SMART-MIST-RBM information to conduct law enforcement patrols briefing and debriefing',
        ],
        'ratingLegend' => [
            'Adequacy' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'Fully inadequate (0-30%)',
                '1' => 'Somewhat inadequate (31-60%)',
                '2' => 'Adequate (61-90%)',
                '3' => 'Fully adequate (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'How adequate is the management and implementation of law enforcement through ranger patrols oriented on ensuring long-term biodiversity protection?',
            'Ranger patrol management is an essential law enforcement activity to enforce existing legal rules that should ensure long-term protection of biodiversity and other values of the protected area. Effective protected area management requires law enforcement at all levels: ranger patrols, intelligence and effective criminal justice systems. This step in the analysis is about the process of the ranger patrol management',
            '(Note: A specific IMET module for a more in-depth law enforcement analysis is available)',
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of elements of the ranger patrols management oriented on ensuring long-term protection of biodiversity and other values',
            ]
    ],

    'IntelligenceImplementation' => [
        'title' => 'Intelligence, investigations, case development and legal actions (law enforcement)',
        'fields' => [
            'Element' => 'Criteria – Concept measured – Variable',
            'Adequacy'=> 'Adequacy of management of: A) intelligence and investigations; B) evidence handling, case development and legal action case development',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'A) Intelligence and investigation management',
            'group1' => 'B) Evidence handling, case development and legal action',
        ],
        'predefined_values' => [
            'group0' => [
                'Intelligence and investigations units orienting ranger patrols actions ',
                'Organisation of informants system ',
                'Informatics support for intelligence',
                'System for intelligence data organisation and analysis',
                'Inter-agency collaboration (e.g. prosecutors within the wildlife service or specialised wildlife crime prosecution unit)',
                'Inter-agency collaboration with NGOs (e.g. EAGLE Network, Central/West Africa)'
            ],
            'group1' => [
                'Crime scene management',
                'Evidence collection and management',
                'Arrest or case report preparation',
                'Prosecution of suspects',
                'Monitoring cases and offender',
                'Judgements obtained in court'
            ]
        ],
        'ratingLegend' => [
            'Adequacy' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'Fully inadequate (0-30%)',
                '1' => 'Somewhat inadequate (31-60%)',
                '2' => 'Adequate (61-90%)',
                '3' => 'Fully adequate (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'How adequate is the management of intelligence / investigations / case development / legal actions oriented on ensuring long-term biodiversity protection?',
            'Intelligence and investigation management as well as case development and legal actions are essential law enforcement activities to enforce existing legal rules that should ensure long-term protection of biodiversity and other values in the protected area. Effective protected area management requires law enforcement at all levels: ranger patrols, intelligence and effective criminal justice systems. This step in the analysis is oriented on assessment of: (A) the intelligence and investigation management and (B) the evidence handling, case development and undertaking legal action'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of management of intelligence / investigations / case development / legal actions oriented on ensuring long-term protection of biodiversity and other values'
        ]
    ],

    'StakeholderCooperation' => [
        'title' => 'Cooperation with stakeholders',
        'fields' => [
            'Element' => 'Criteria – Concept measured – Variable',
            'Cooperation' => 'Degree of cooperation',
            'MPInvolvement' => 'P',
            'MPIImplementation' => 'PM',
            'BAInvolvement' => 'B/A',
            'EEInvolvement' => 'IEC',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Local community',
            'group1' => 'Government',
            'group2' => 'Scientists, Researchers, Donors and NGOs',
            'group3' => 'Economic operators',
            'group4' => 'Other'
        ],
        'predefined_values' => [
            'group0' => [
                'Traditional authorities',
                'Indigenous populations',
                'Communities living close to or in the park',
                'Rightholders',
                'Landowners',
                'Local users of natural resources',
                'Local users of non-timber forest products NTFPs',
                'Underrepresented or disadvantaged groups',
                'Population other than in buffer area'
            ],
            'group1' => [
                'Central Government',
                'Local Government',
                'Territorial / departmental and municipal council',
                'Protected areas authority',
                'Local Land Services',
                'Representatives of local populations (parliamentary representatives, etc.)',
                'Armed forces (paramilitary police force and navy)'
            ],
            'group2' => [
                'Social rights NGOs',
                'Environmental NGOs',
                'Scientists / Researchers',
                'Donors'
            ],
            'group3' => [
                'Private tourism operators',
                'Forestry operators',
                'Fishing operators'
            ]
        ],
        'ratingLegend' => [
            'Cooperation' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'No cooperation',
                '1' => 'Very little cooperation',
                '2' => 'Moderate cooperation',
                '3' => 'Very high cooperation'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Do stakeholders contribute to management of the protected area to develop understanding and support for the delivery of protected area objectives??',
            'In many protected areas, some or all of the relevant stakeholders are cooperating in a substantial way in the management’s decision-making regarding activities and their implementation inside or outside of the protected area. This cooperation can involve formal or informal agreements. The level of stakeholder cooperation in a protected area depends on a variety of factors, but particularly on the nature of the stakeholders, the pressures and other influences arising from stakeholders, and the biodiversity and ecosystem services of the protected area. This step in the analysis evaluates how some or all of the relevant stakeholders are involved in the management of the protected area in four areas: (P) planning; (PM) planning and management (B/A) benefits/assistance for local communities (IEC) Information, education and communication for community understanding and engagement. The optimal level of stakeholder involvement and cooperation should be determined for each protected area individually because each protected area is unique'
        ],
        'module_info_Rating' => [
            'Select (A) the areas in which the stakeholders are involved in managing the protected area and evaluate (B) the level of cooperation:<ul><li><b>P</b>: management planning</li><li><b>PM</b>: management plan implementation</li><li><b>B/A</b>:benefits/assistance for local communities </li><li><b>IEC</b>:environmental education, community awareness and engagement</li></ul>'
        ]
    ],

    'AssistanceActivities' => [
        'title' => 'Benefits/assistance for local communities',
        'fields' => [
            'Activity' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy of activities to provide benefits/assistance',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Elements of material living standard',
            'group1' => 'Elements of immaterial living standard'
        ],
        'predefined_values' => [
            'group0' => [
                'Support for local activities (e.g. ecosystem services management, climate change mitigation, etc.)',
                'Support for local business (e.g. processing of agricultural, fishing, forest products, etc.)',
                'Support for local funding path-ways',
                'Support for food production and small farming',
                'Purchase of agricultures products for tourism and staff',
                'Support for tourism businesses',
                'Support for traditional products and crafts for tourists',
                'Support for human-wildlife conflict resolutions - compensation',
                'Support of employment local staff in tourism',
                'Support local service providers',
                'Distribution of tourism incomes',
                'Provision of natural resources in case of need (e.g. water, fibres, etc. from the protected areas during crises or materiel contribution for social buildings such as hospital, school, etc.)',
                'Employment of local people in the protected area',
                'Employment of rangers from the region',
                'Provide power supply, electrical connection',
                'Provide water supply - connection',
                'Support for the construction, maintenance and improvement of external roads',
                ],
            'group1' => [
                'Strengthening of security in the area',
                'Minimisation of conflicts and strengthening of the sustainable management and use of ecosystem services',
                'Provision of education infrastructure (i.e. buildings)',
                'Provision of educational services (teaching)',
                'Provision of health infrastructure (i.e. buildings, clean water)',
                'Provision of health services (health care)',
                'Provision of free access to the park',
                'Provision of cultural services (physical – intellectual – emblematic – spiritual – interaction from ecosystem services)',
                'Facilitation of social problem solving',
                'Strengthening of the identity and sense of place of local communities'
            ]
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'Fully inadequate (0-30%)',
                '1' => 'Somewhat inadequate (31-60%)',
                '2' => 'Adequate (61-90%)',
                '3' => 'Fully adequate (91-100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Does the protected area carry out activities/programmes designed to provide appropriate benefits/assistance for communities? ',
            'Protected area management has moved away from the historical total protection paradigm, whereby conservation gains were generally seen to come at the expense of the local communities’ interests. It is now widely acknowledged that protected areas should contribute to sustainable development and economic well-being of their neighbouring communities. Positive socio-economic outcomes from protected areas are important in their own right, but they may also be necessary to ensure that protected areas continue to deliver strong ecological outcomes. A lack of appropriate benefits/assistance for local communities has been linked to failed conservation outcomes from protected area initiatives in many case studies from around the world. Accordingly, international best practice standards promote protected area assessment that accounts for both ecological and socio-economic outcomes (Sources UNESCO - IUCN).'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of the activities/programme that the protected area is carrying out to provide benefits/assistance for communities'
        ],
    ],

    'EnvironmentalEducation' => [
        'title' => 'Environmental education and public awareness',
        'fields' => [
            'Activity' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy of the activities of environmental education and public awareness',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Community conservation programmes',
            'Programmes to raise awareness in villages around the protected area',
            'Programmes to raise awareness among residents other than in villages around the protected area',
            'Environmental education programme in schools',
            'Radio programmes about the protected area (e.g. on community radio stations)',
            'Television programmes about the protected area',
            'Conferences and debates on conservation',
            'Guided tours for local communities in the protected area',
            'Environmental education material distributed to schools',
            'Waste and clean-up operations',
            'Public awareness (e.g. ecomuseum)'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'fully inadequate (0-30%)',
                '1' => 'somewhat inadequate (31-60%)',
                '2' => 'adequate (61-90%)',
                '3' => 'fully adequate (91-100%)',
          ]
        ],
        'module_info_EvaluationQuestion' => [
            'Does the protected area carry out activities/programmes of environmental education and public awareness specifically linked to the needs and objectives of conservation/management of natural resources?',
            'Environmental education can play an effective role in creating awareness for the need to protect and preserve the environment and to improve the quality of human life. Environmental education can help individuals to balance their own vital needs with the needs of the natural environment that provides ecosystem services (provisioning, regulating, cultural and supporting) for the communities inside and outside, near and far from the protected area (considering the specific designation of the protected area). Environmental education includes both formal and informal education and training that increase human capacity and capability to participate in environmental management and in solving environmental crises and challenges, including climate change. This could be achieved by increasing awareness and effectively changing the individual’s perspective on the environment'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of the environmental education and the public awareness activities/programmes that are supported by the protected area'
        ]
    ],

    'VisitorsManagement' => [
        'title' => 'Management of visitor facilities and services',
        'fields' => [
            'Aspect' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy of visitor facilities and services',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Management procedures for tourism related to objectives/favourable outcomes of protected area values',
            'Existence of specific targets for tourism and visitor management',
            'Awareness of the consequences emerging from tourism activities',
            'Usage of zoning to manage diverse recreation opportunities while preserving important values',
            'Tourism diversity through promoting  biophysical, cultural and social values',
            'Engagement of stakeholders and rightholders to establish consensus and partnership for implementation of tourism activities',
            'Economic benefits for protected areas ensured',
            'Information and communication strategy and programmes supporting the sustainability of tourism programmes',
            'Accommodation, catering and leisure activities management',
            'Visitor transport and safety management',
            'Accommodation, catering, leisure activities for disabled people ',
            'Range of experiences available for visitors',
            'Guides tourism in the protected area',
            'Constant development of tourist attractions',
            'Sense of place (preserving or improving the specific character of the natural area)',
            'Data tourism monitoring'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'Fully inadequate (0-30%)',
                '1' => 'Somewhat inadequate (31-60%)',
                '2' => 'Adequate (61-90%)',
                '3' => 'Fully adequate (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Does the protected area manage (designs, establish, maintain and improve) the required visitor facilities and services for environmental tourism?',
            'Protected area tourism is a large and growing industry. Tourism is a critical ecosystem service that can contribute directly and indirectly to protected areas as a global conservation strategy, including meeting the Aichi Targets related to conservation, community development and public awareness (CBD, 2012). Tourism is a complex phenomenon and its interactions with protected areas occur in unique historical, cultural and geographical contexts involving multiple values and stakeholders. Effective management of protected area tourism requires an appreciation and understanding of environmental, social and economic sustainability contexts and a compatible management of visitor facilities and services, and understanding how they change over time'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of the protected area’s management of visitor facilities and services for environmental tourism'
        ]
    ],

    'VisitorsImpact' => [
        'title' => 'Management of visitors’ impact',
        'fields' => [
            'Impact' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy of visitors impact management',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Actions to determine, monitor and manage the acceptable level of visitor impact',
            'Actions to minimise human‐induced changes (transport, accommodation, and leisure activities)',
            'Management process balancing conservation objectives with for-profit activities [e.g. (1) developing a visitor centre and trails, (2) limiting use to protect biodiversity in a specific habitat]',
            'Collection and communication of tourism monitoring data and evidence of impacts to increase public engagement and visitors awareness'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A => this element is not related to the management of the protected area',
                '0' => 'fully inadequate (0-30%)',
                '1' => 'somewhat inadequate (31-60%)',
                '2' => 'adequate (61-90%)',
                '3' => 'fully adequate (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Does the protected area manage and mitigate visitor impacts appropriately?',
            'Promoting recreation and tourism so that visitors can learn about and appreciate a protected area, without damaging the values for which it was established, can be challenging. Visitors can negatively impact both resources and the experience of other visitors, or may also unknowingly offend cultural standards. Adequate monitoring, management and mitigation of visitor impacts are fundamental to sustainable tourism management strategies, but are often overlooked once the plan is underway. Without proper knowledge of the effects of tourist activities on the site’s natural environment and the surrounding communities it is impossible to establish whether the management of the ecotourism of the protected area is successful'
        ],
        'module_info_Rating' => 'Evaluate the management of visitors’ impact on the protected area (environmental tourism)'
    ],

    'NaturalResourcesMonitoring' => [
        'title' => 'Systems for monitoring natural and cultural resources',
        'fields' => [
            'Aspect' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy of monitoring',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Design of monitoring and its application in the field (e.g. monitoring carry out by rangers, researchers, etc.)',
            'Institutional capabilities and technical resources for monitoring',
            'Security of saving and storage of data from monitoring',
            'Use of data from monitoring to induce changes in the management of the protected area',
            'Monitoring main conservation objectives',
            'Monitoring of species (flagship, endangered, endemic, …) ',
            'Monitoring ecosystems and habitats',
            'Monitoring land cover–land use–land take',
            'Monitoring freshwater ecosystems (lakes, rivers, and the smaller ponds and streams)',
            'Monitoring material living standard of populations in the protected area and its buffer area',
            'Monitoring immaterial living standards of populations in the protected area and its buffer area',
            'Monitoring threats to the protected area',
            'Monitoring visitor impacts',
            'Monitoring ecosystem services provided by the protected area',
            'Monitoring the effects of climate change on key elements of the protected area',
            'Data collection and analysis of patrols management (i.e. SMART-MIST, Ranger-Based Monitoring – RBM))'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'fully inadequate (0-30%)',
                '1' => 'somewhat inadequate (31-60%)',
                '2' => 'adequate (61-90%)',
                '3' => 'fully adequate (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Are the monitoring systems adequate to effectively monitor of biodiversity, natural and cultural resources of the protected area?',
            'Successful execution of a monitoring programme depends on the analysis of the protected area’s main conservation objectives to establish specific criteria and monitoring indicators. Under the influence of negative driving forces and threats (population and economic growth, natural phenomena, etc.), human activities exercise pressure on the protected area. This pressure results in a change, disturbance, or degradation of the values and resources of the protected area. In order to anticipate potential issues and plan the best interventions in the protected area, a solid understanding of the trends of the environmental and ecosystem services (biodiversity, water supply, food supply, forest quality, threats, etc.) is indispensable'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of the monitoring systems in place for biodiversity, natural and cultural resources of the protected area'
        ]
    ],

    'ResearchAndMonitoring' => [
        'title' => 'Research and long-term ecological monitoring',
        'fields' => [
            'Program' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy of research and long-term monitoring',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Research and long-term ecological monitoring role in the management of the protected area',
            'Use of institutional capabilities and technical resources to initiate and coordinate research activities',
            'Accessibility and security of the data from research',
            'Management support from research and long-term ecological monitoring data',
            'Research and long-term ecological monitoring of species (flagship, endangered, endemic, etc.)',
            'Research and long-term ecological monitoring of terrestrial ecosystems and land use (land cover – land use – land take)',
            'Research and long-term ecological monitoring of marine ecosystems and habitats',
            'Research and long-term ecological monitoring of freshwater ecosystems (lakes, rivers, and the smaller ponds and streams)',
            'Research and long-term monitoring of human well-being of the communities in the protected area and in the buffer areas',
            'Research and long-term monitoring of threats to the protected area',
            'Research and long-term ecological monitoring of the ecosystem services provided by the protected area',
            'Research and long-term ecological monitoring of the effects of climate change on key elements of the protected area'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'Fully inadequate (0-30%)',
                '1' => 'Somewhat inadequate (31-60%)',
                '2' => 'Adequate (61-90%)',
                '3' => 'Fully adequate (91-100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Does the protected area coordinate or initiate research activities and long-term ecological monitoring, and does it have access to and makes use of the research results in the management?',
            'The purpose of the research and biomonitoring in a protected area is to obtain information on the long-term development of selected components of its ecosystems to predict future issues and plan management interventions. A survey should select the areas as well the species, habitats, water, etc. to evaluate the environmental health of the values and importance of the protected area. Functional measures could be increasingly applied as a complementary approach to monitor the ecological integrity of the protected area'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of the research actions / applications supporting the management of the protected area'
        ]
    ],

    'ClimateChangeMonitoring' => [
        'title' => 'Management of adaptation to the effects of climate change',
        'fields' => [
            'Program' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Rating: Adequacy of adaptation measures',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Managing adaptation of species (e.g. translocate species, etc.)',
            'Managing adaptation of habitats and the land cover – use – take in and outside of the protected area (avoid forest fragmentation, bare ground, etc.)',
            'Managing adaptation of ecosystem services',
            'Reducing stressors that amplify climate impacts (e.g. increase connectivity, control invasive species, etc.)',
            'Sustaining or restoring ecosystem process and function to promote resilience (e.g. restore degraded vegetation, etc.)',
            'Protecting intact, connected ecosystems (e.g. remove waterway impediments; avoid bisection of corridors, etc.)',
            'Protecting areas that provide future habitat for displaced species (e.g. establish partnerships to protect critical habitats outside the protected area for key species affected by climate change effects)',
            'Identifying and protecting climate refugia (e.g. reduce human use and disturbance in refugia, etc.)',
            'Managing ecological networks to promote ecological resilience to climate impacts',
            'Participating in landscape and seascape adaptation planning that extends beyond the boundaries of individual protected areas'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'fully inadequate (0-30%)',
                '1' => 'somewhat inadequate (31-60%)',
                '2' => 'adequate (61-90%)',
                '3' => 'fully adequate (91-100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'How does the protected area manage adaptation to the effects of climate change?',
            'Climate change response can be divided into “mitigation” (actions that reduce the amount of carbon dioxide and other heat-trapping gases in the atmosphere) and “adaptation” (an adjustment of human or natural systems to the changing climate). While protected areas have the ability to capture and store carbon in their ecosystems and to reduce emissions from protected area operations, the primary focus of the management is usually on adaptation to the effects of climate change'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of the management actions on climate change adaptation'
        ]
    ],

    'EcosystemServices' => [
        'title' => 'Ecosystem services management',
        'fields' => [
            'Intervention' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy of ecosystem services management',
            'Comments' => 'Comments/Explanation',
        ],
        'categories' => [
            'title1' => 'Provisioning',
            'title2' => 'Regulating',
            'title3' => 'Cultural',
            'title4' => 'Supporting',
        ],
        'groups' => [
            'group0' => 'Managing for nutrition (e.g. water, food, fodder, medicinal plants, fishing, etc.)',
            'group1' => 'Managing for materials (e.g. reforestation to produce timber, NTFP for sustainable use, other materials for extraction)',
            'group2' => 'Managing for energy (e.g. hydropower)',
            'group3' => 'Managing for flow of waste materials, toxic substances (e.g. filtering and decomposition of organic waste and pollutants in waters)',
            'group4' => 'Managing for maintaining biological, chemical and physical conditions (e.g. pollination, mitigate the damage caused by natural disasters)',
            'group5' => 'Managing for high level of physical interactions (e.g. ex-situ conservation)',
            'group6' => 'Managing for high level of intellectual interactions (e.g. research)',
            'group7' => 'Managing for high levels of spiritual and/or emblematic interactions between the protected area and the stakeholders (e.g. traditional rites)',
            'group8' => 'Managing for sustainable habitats (crop pollination, insects, etc.)',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '0' => 'fully inadequate (0-30%)',
                '1' => 'somewhat inadequate (31-60%)',
                '2' => 'adequate (61-90%)',
                '3' => 'fully adequate (91-100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Does the protected area manage to promote the conservation/enhancement of the ecosystem services provided by the protected area?',
            'Ecosystem services are the many and varied benefits that humans freely gain from the natural environment and from properly functioning ecosystems. Ecosystem services are grouped into four broad categories: (1) provisioning services, such as the production of food and water; (2) regulating services, such as the control of climate and disease; (3) cultural services, such as spiritual and recreational benefits; and (4) supporting services, such as nutrient cycles, crop pollination or habitats that provide everything that an individual plant or animal needs to survive: food; water; and shelter [Millennium Ecosystem Assessment (MA)]'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of the management actions promoting conservation/enhancement of the ecosystem services provided by the protected area'
        ]
    ],

    'ObjectivesProcessus' => [
        'module_info' => 'Establish and describe conservation objectives related <b>to implementation process of the planning</b> of the protected area<br /> The objectives entered below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the protected area.'
    ],

    'WorkProgramImplementation' => [
        'title' => 'Activities implementation of the work/action plan',
        'fields' => [
            'Category' => 'Categories of activities',
            'Activity' => 'Activity',
            'TargetedActivity' => 'Targeted activity',
            'EvaluationScore' => 'Level of implementation',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'No or very low level of implementation of the targeted activities of the previous year (between 0 and 25%)',
                '1' => 'Low level of implementation of the targeted activities of the previous year (between 26 and 50%)',
                '2' => 'Moderate level of implementation of the targeted activities of the previous year (between 51 and 75%)',
                '3' => 'High level of implementation of the targeted activities of the previous year (between 76 and 100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'To what extent has the protected area implemented the main activities of the work plan?',
            'Implementation is the carrying out, or execution, of the annual or multi-year work/action plan concerning the activities of the protected area. As such, implementation is the action that must follow any prior planning, management and conservation activities. When the protected area implements a work plan, it can achieve targeted management and conservation actions in a sustainable manner'
        ],
        'module_info_Rating' => [
            'Evaluate the level of implementation of the main activities of the work/action plan for the previous year (in the comments box indicate the year of reference if you apply for a multi-year work/action plan)',
            '<b>Category of activities</b>: e.g. law enforcement, social facilities development, environmental education, tourism management, etc.',
            '<b>Activity</b> = action belonging to one of the main categories of activities that is executed to achieve particular purpose',
            'Without a work/action plan you can refer to the categories and the activities of the Process element: Management and protection of the key elements; Stakeholder relations; Tourism; Monitoring and research; Climate change and Ecosystem services'
        ]
    ],

    'AchievedResults' => [
        'title' => 'Outputs achievement of the work/action plan',
        'fields' => [
            'Category' => 'Categories of activities',
            'Activity' => 'Activity',
            'TargetedOutput' => 'Targeted output',
            'EvaluationScore' => 'Level of achievement',
            'Comments' => 'Comments/Explanation',
        ],
        'module_info' => 'The statistical system allows only five lines to identify the functions of the staff of the protected area',
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'No or very low achievement of the targeted output of the previous year (between 0 and 25%)',
                '1' => 'Low level of achievement of the targeted output of the previous year (between 26 and 50%)',
                '2' => 'Moderate level of achievement of the targeted output of the previous year (between 51 and 75%)',
                '3' => 'High level of achievement of the targeted output of the previous year (between 76 and 100% )'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'To what extent has the protected area achieved the main outputs of the work plan?',
            'The prevalent approach for protected area planning includes the establishment of annual or multi-year work/action plan OUTPUTS that contributes to the achievement of long-term conservation goals / objectives or OUTCOMES. In the planning process the longer-term goals / objectives are translated into short-term conservation targets for specific biodiversity features, such as species, habitats and threats or ecosystem services possible to achieve with the work/action plan. However, since the use of many low-level conservation targets is an obstacle to achieving high-level conservation performance, the outputs must be strongly linked to the outcomes to ensure high-level conservation performance. Putting performance measurement systems in place is an important way of keeping track of the progress of your management and conservation activities'
        ],
        'module_info_Rating' => [
            'Evaluate the level of achievement of the main outputs of the work/action plan (in comments, indicate the reference year if you apply for a multi-year work/action plan)',
            '<b>Category of activities</b> = e.g. law enforcement, social facilities development, environmental education, tourism management, etc.',
            '<b>Activity</b> = action belonging to one of the main categories of activities that is executed to achieve particular purpose',
            'Without a work/action plan you can refer to the categories and the activities of the Process element: Management and protection of the key elements; Stakeholder relations; Tourism; Monitoring and research; Climate change and Ecosystem services'
        ]
    ],

    'AreaDomination' => [
        'title' => 'Area domination',
        'fields' => [
            'Patrol' => 'A) Area covered by patrols',
            'RapidIntervention' => 'B) Rapid intervention capacity',
            'AirVehicles' => 'C.1) Special means available and adequate for surveillance',
            'Planes' => 'C.2) Special means available and adequate for rapid intervention',
            'Comments' => 'Comments/Explanation'
        ],
        'ratingLegend' => [
            'Patrol' => [
                '0' => 'Area covered by patrols survey is minimal (from 0 to 25% of the surface area)',
                '1' => 'Area covered by patrols survey is limited (from 26 to 50% of the surface area)',
                '2' => 'Area  covered by patrols survey is fair (from 51 to 75% of the surface area)',
                '3' => 'Area covered by patrols survey is very good (more than 76% of the surface area)',
            ],
            'RapidIntervention' => [
                '0' => 'Rapid intervention capacity in the protected area is minimal (from 0 to 25% of the surface area)',
                '1' => 'Rapid intervention capacity in the protected area is limited (from 26 to 50% of the surface area)',
                '2' => 'Rapid intervention capacity in the protected area is fair (from 51 to 75% of the surface area)',
                '3' => 'Rapid intervention capacity in the protected area is very good (more than 76% of the surface area)',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'What is the current extent of area domination for the protected area',
            'Area domination refers to the ability of park management to create presence in a given area, for example through regular patrols surveys, rapid interventions or airborne surveillance. Where required, this presence needs to be imposed frequently and effectively to address threats such as poaching or illegal activities. The aim of high area domination is to prevent or minimise illegal activities affecting the biodiversity, cultural or historical values, and to enforce the protection of the protected area and its boundaries'
        ],
        'module_info_Rating' => [
            'Evaluate the area domination based on the percentage of the protected area’s surface area where the management is present or can be present through (A) patrols surveys; (B) rapid interventions; (C) using special means'
        ]
    ],

    'AchievedObjectives' => [
        'title' => 'Achievement of long-term conservation objectives of the management',
        'fields' => [
            'Objective' => 'Main long-term goals-objective',
            'EvaluationScore' => 'Level of achievement of the objectives',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'no or very low level of achievement (between 0 and 25%).',
                '1' => 'low level of achievement (between 26 and 50%)',
                '2' => 'moderate level of achievement (between 51 and 75%)',
                '3' => 'high level of achievement (between 76 and 100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'To what extent has the protected area achieved the main objectives of the management plan?',
            '(Based on the analysis of the context of intervention, point CTX1.5 Vision – Mission – Objectives or element Planning, point P6 - Objectives of the protected area)',
            'Management of protected areas is increasingly being carried out according to the ‘management by objectives’ principles. The goals and objectives of a protected area must be clearly understood if management is to be successful based on measurable achievements. In this tool we make an important distinction between outcomes and outputs:<ul><li>OUTCOMES relate to GOALS / OBJECTIVES, i.e. long-term goals / objectives or visions expressed in the management plan. These goals / objectives are usually specific statements relating to the key values of the protected area (i.e. important species or ecosystem services) or to major areas of management activities (e.g. tourism, education).</li><li>OUTPUTS relate to TARGETS, i.e. short-term (or relatively short-term) quantitative targets to achieve the long-term goals / objectives and specific objectives. We believe that the use of many low-level conservation targets is an obstacle to achieving high-level conservation performance</li></ul>'
        ],
        'module_info_Rating' => [
            'Evaluate the level of achievement of the main long-term goals / objectives related to the key values of the protected area or major areas of the management plan'
        ]
    ],

    'KeyConservationTrend'=> [
        'title' => 'Conditions and trends for the key conservation elements of the protected area',
        'fields' => [
            'Element' => 'Key conservation element',
            'Condition'=> 'Condition of the key element',
            'Trend'=> 'Trend of the key element',
            'Reliability' => 'Reliability of information',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Conservation conditions and trends for key animal species',
            'group1' => 'Conservation conditions and trends for key plant species',
            'group2' => 'Conservation conditions and trends for habitats, land cover-use–take',
            'group3' => 'Situation and trends for threats to the protected area',
            'group4' => 'Adaptation to climate change',
            'group5' => 'Conservation conditions and trends for ecosystem services of the protected area '
        ],
        'ratingLegend' => [
            'Condition' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '-3' => 'Very bad',
                '-2' => 'Bad',
                '-1' => 'Slightly bad',
                '0' => 'Neutral',
                '+1' => 'Slightly good',
                '+2' => 'Good',
                '+3' => 'Very good',
            ],
            'Trend' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '-3' => 'Strongly decreasing',
                '-2' => 'Decreasing',
                '-1' => 'Slightly decreasing',
                '0' => 'No change',
                '+1' => 'Slightly increasing',
                '+2' => 'Increasing',
                '+3' => 'Strongly increasing',
            ],
            'Reliability' => [
                'High' => 'almost complete certainty about the values of condition and trends',
                'Medium' => 'some possibility of mistake about the values of condition and trends',
                'Poor' => 'high uncertainty about the values of condition and trends',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'What are the conditions and trends for the key conservation elements of the protected area?',
            'The main management goals / objectives of the protected area are the conservation/restoration of natural values and the benefits that humans get from the natural environment and from properly functioning ecosystems (ecosystem services). Managers should ensure the conservation/restoration of key values (animal and plant species, land cover, etc.) and the preservation of provisioning, regulating, cultural and supporting ecosystem services, ensuring the values and benefits of protected areas for all'
        ],
        'module_info_Rating' => [
            'Evaluate: A) the conditions and B) the trends of the key conservation elements of the protected area (based on the Context 1 and 3, Process elements PR7 – Managing the values and key elements of the protected area with specific actions, PR 17 adaptation to climate change and PR18 – Management of the ecosystem services)'
        ]
    ],

    'LifeQualityImpact' => [
        'title' => 'Effects on the quality of life of stakeholders',
        'fields' => [
            'Element' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Effects',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Elements of material living standard',
            'group1' => 'Elements of immaterial living standard',

        ],
        'predefined_values' => [
            'group0' => [
                'Material well-being of local populations',
                'Local activities intensity (food production, small farming, handicraft, services for the protected area, etc.)',
                'Support to local business (power supply, water supply, commerce, roads between villages, etc.)',
                'Tourism incomes',
                'Human-wildlife conflict',
                'Employments of locals',
                'Ecosystem services (provisioning)'
            ],
            'group1' => [
                'Security',
                'Reliability (continuity, quantity and quality) of ecosystem services',
                'Education services',
                'Health services',
                'Ecosystem services (Cultural)',
                'Communities identity (cultural, traditional, spiritual, etc.)',
                'Natural resources users conflicts reduction'
            ]
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the protected area',
                '-3' => 'Highly damaging effects',
                '-2' => 'Damaging effects',
                '-1' => 'Slightly damaging effects',
                '0' => 'Neutral',
                '+1' => 'Slightly favourable effects',
                '+2' => 'Favourable effects',
                '+3' => 'Highly favourable effects',
                ]
        ],
        'module_info_EvaluationQuestion' => [
            'Does the management of the protected area have positive or negative effects on the quality of life of local stakeholders?',
            'From an ecosystem perspective, all people rely on natural capital and ecosystem services. Changes in the environment (present and future conditions) and the availability of essential resources can affect the quality of life (contributions that ecosystem services make to well-being) through impacts on consumption, income and wealth (material living standards) and on good life, health and social and cultural relations (immaterial living standards). The protected area management should take great care in the effects on the quality of life of local stakeholders'
        ],
        'module_info_Rating' => [
            'Evaluate the effects for local stakeholders resulting from the operational activities of the protected area'
        ]
    ]



];
