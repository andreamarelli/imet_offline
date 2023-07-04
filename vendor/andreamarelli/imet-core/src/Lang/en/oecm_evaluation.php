<?php
return [

    '_Objectives' => [
        'title' => 'Setting objectives',
        'fields' => [
            'Element' => 'Element/Indicator',
            'Status' => 'Baseline',
            'Objective' => 'Optimal or favourable status',
            'comments' => 'Comments'
        ],
    ],

    'Designation' => [
        'title' => 'Designations',
        'fields' => [
            'Aspect' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Integration',
            'SignificativeClassification' => 'Highly significant designation',
            'IncludeInStatistics' => 'To prioritise in management',
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
        'module_subTitle' => 'Value and Importance - Designations',
        'module_info_EvaluationQuestion' => [
            'Evaluate the integration of values and importance of designations (national designation and international designations, e.g., World Heritage site or Ramsar site) for the management of the OECM'
        ],
        'warning_on_save' => 'WARNING!! <br /> Any modification might cause data loss in the following modules (if already encoded): <i>I1, PR6</i>',
    ],

    'KeyElements' => [
        'title' => 'Key elements of the OECM',
        'fields' => [
            'Aspect' => 'Key element / service',
            'Importance' => 'Importance',
            'EvaluationScore' => 'Integration',
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
        'module_subTitle' => 'Key elements animals, plants, habitats (protected, exploited, disappearing, invasive, etc.) and services (provisioning, control, cultural, supporting services)',
        'module_info_EvaluationQuestion' => [
            'Has the OECM prioritised the key elements in its management? The assessment should evaluate the need to
            prioritise the key elements in the management of the OECM. The assessment uses a ranked list based on analyses from SA1 and SA2.'
        ],
        'module_info_Rating' => [
            'Evaluate the need to prioritise the key elements in the management of the OECM'
        ],
        'from_group' => 'From category: ',
        'num_stakeholders' => 'Indicated by :num stakeholder(s)',
        'warning_on_save' => 'WARNING!! <br /> Any modification might cause data loss in the following modules (if already encoded): <i>P6, I1, PR6</i>',
    ],

    'SupportsAndConstraints' => [
        'title' => 'Constraints or supports from stakeholders',
        'fields' => [
            'Stakeholder'       => 'Stakeholder',
            'Weight'            => 'Involvement of the stakeholder (0-100)',
            'ConstraintLevel'   => 'Level of the constraint/conflict or support/compliance',
            'Comments'          => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'ConstraintLevel' => [
                '-3' => 'Severe constraints/conflicts',
                '-2' => 'Moderate constraints/conflicts',
                '-1' => 'Minor constraints/conflicts',
                '0' => 'No constraints/conflicts but also no support role',
                '+1' => 'Minor supports/compliances',
                '+2' => 'Moderate supports/compliances',
                '+3' => 'Strong supports/compliances',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'The constraints/conflicts or supports/compliances by the stakeholders can be measured by their intensity in constraining/conflicting or supporting/complying the OECM'
        ],
        'module_info_Rating' => [
            'Evaluate the most important constraints/conflicts or supporting/complying factors from the political, institutional and social environment in the management of the OECM'
        ]
    ],

    'SupportsAndConstraintsIntegration' => [
        'title' => 'Integration of stakeholders\' constraints or supports in management and governance',
        'fields' => [
            'Stakeholder'       => 'Stakeholder',
            'Integration'       => 'Integration',
            'IncludeInStatistics' => 'To prioritise in management',
            'Comments'          => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'Integration' => [
                '0' => 'no integration',
                '1' => 'low integration',
                '2' => 'moderate integration',
                '3' => 'high integration',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'The assessment evaluates the need to prioritise the minimisation of management constraints or the maximisation
            of stakeholder support in the management of the OECM. The assessment uses the ranking list based on the integration
            of the stakeholder constraint/conflict (C2.1) or support/compliance scores with the stakeholder involvement
            in the management of the OECM values (SA1 of the intervention context).'
        ],
        'module_info_Rating' => [
            'Evaluate the current integration in the management of the stakeholder constraints or support'
        ],
        'ranking' => 'Ranking (C2.1)',
        'warning_on_save' => 'WARNING!! <br /> Any modification might cause data loss in the following modules (if already encoded): <i>I1, PR6</i>',
    ],

    'Threats' => [
        'title' => 'OECM threat calculator',
        'fields' => [
            'Value' => 'Values',
            'Impact' => 'Impact/ Severity',
            'Extension' => 'Scale/ Extent',
            'Duration' => 'Duration/ Irreversibility',
            'Trend' => 'Trend',
            'Probability' => 'Probability for the threat in future',
        ],
        'ratingLegend' => [
            'Impact' => [
                '0' => 'Mild',
                '1' => 'Moderate',
                '2' => 'High',
                '3' => 'Severe',
            ],
            'Extension' => [
                '0' => 'Localised <5%',
                '1' => 'Sparse 5-15%',
                '2' => 'Widely dispersed 15-50%',
                '3' => 'Everywhere >50%',
            ],
            'Duration' => [
                '0' => 'Short term < 5 years',
                '1' => 'Medium term 5-20 years',
                '2' => 'Very long term 20-100 years',
                '3' => 'Permanent >100 years',
            ],
            'Trend' => [
                '-2' => 'Decreasing',
                '-1' => 'Slightly decreasing',
                '0' => 'No change',
                '1' => 'Slightly increasing',
                '2' => 'Increasing',
            ],
            'Probability' => [
                '0' => 'Very low',
                '1' => 'Low',
                '2' => 'Average',
                '3' => 'High',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Has the OECM clearly identified and integrated the threats that could affect the area’s biodiversity, cultural heritage, or ecosystem services in its management?'
        ],
        'module_info_Rating' => [
            'Evaluate the level of integration of most important threats in the management of the OECM based on the analysis of the threats calculator at Context of intervention point SA 2 and automatically reported below . Threats evaluation (automatically reported from SA 2) To prioritise in management Comments/Explanation'
        ],
        'stakeholders' => 'indicated by :num stakeholder(s)'
    ],

    'ThreatsIntegration' => [
        'title' => 'Threats integration',
        'fields' => [
            'Threat'       => 'Threat',
            'Integration'       => 'Integration',
            'IncludeInStatistics' => 'To prioritise in management',
            'Comments'          => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'Integration' => [
                '0' => 'no integration',
                '1' => 'low integration',
                '2' => 'moderate integration',
                '3' => 'high integration',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'The assessment evaluates the need to prioritise the threats to minimise their effects and impact on the OECM
            management. The assessment uses the ranking list based on the threats analysis in SA2 and C3.1.'
        ],
        'module_info_Rating' => [
            'Evaluate the current integration of the threats to the management of the OECM'
        ],
        'ranking' => 'Ranking (C3.1)',
        'warning_on_save' => 'WARNING!! <br /> Any modification might cause data loss in the following modules (if already encoded): <i>I1, PR6</i>',
    ],

    'RegulationsAdequacy' => [
        'title' => 'Adequacy of legal and regulatory provisions',
        'fields' => [
            'Regulation' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Gazetting and designation (e.g., conserved area, community forest)',
            'Clarity of legal demarcation of the OECM (e.g. natural boundaries such as rivers, non-natural boundaries, customary rights, enclaves).',
            'Internal rules for the management of the OECM',
            'Ratification and application of international conventions (CITES, CBD, Nagoya, CMS, World Heritage, RAMSAR, etc.)',
            'Locally established laws on OECM and conservation (spatial and temporal harvesting, hunting, fishing closures; quotas limits on control on the number and size of vessels; bans on harvesting-hunting-fishing methods or gear, etc.)',
            'National environmental laws (natural resources management, conservation, OECM)',
            'Other national laws (land and property rights, taxes, business laws, etc.)'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the OECM',
                '0' => 'Completely inadequate',
                '1' => 'Somewhat inadequate',
                '2' => 'Adequate',
                '3' => 'Fully adequate',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Are the current legal and regulatory provisions adequate for conservation and natural resources management activities in the OECM?',
            '<i>Adequate legislation and regulatory provisions are the basis for an effective and robust governance and management framework for the OECM and, more importantly, for ensuring its long-term sustainability for current and future generations</i>'
        ],
        'module_info_Rating' => [
            'Identify and evaluate the adequacy of current legal and regulatory provisions for conservation and natural resources management in the OECM'
        ]
    ],

    'DesignAdequacy' => [
        'title' => 'Design and layout of the OECM',
        'fields' => [
            'Values' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Size (surface area)',
            'Configuration or shape of the OECM',
            'Border zone integration (outside of the OECM that have special rules on resources use for the integrity of water catchment, corridors for wildlife, harvesting-hunting-fishing activities, etc.)'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the OECM',
                '0' => 'Completely inadequate',
                '1' => 'Somewhat inadequate',
                '2' => 'Adequate',
                '3' => 'Fully adequate',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Is the design and layout of the OECM adequate for the sustainable management and governance of its key elements?',
            'The analysis should show whether the design and layout are adequate to the sustainable management and governance of the key elements, or whether an improved layout should be proposed, if feasible.'
        ],
        'module_info_Rating' => [
            'Evaluate if the design and layout of the OECM (based on analysis of the Context of intervention point CTX2) is adequate for ensuring that its key elements can be well managed.'
        ]
    ],

    'BoundaryLevel' => [
        'title' => 'Demarcation of the OECM',
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
            'Clearly demarcated, unambiguous and therefore easily interpreted boundaries (e.g., signs, posts, markers, fences, buoys, etc.)',
            'Recognition of boundaries by the authorities',
            'Recognition of boundaries by communities/users',
            'Collaboration approach including national agencies and relevant stakeholders in the demarcation of boundaries',
            'Publication of information of the boundaries demarcation',
            'Demarcation and development of legal boundaries consistent with legal statutes and international laws if necessary',
            'Demarcation using the official source of reference data',
            'Boundaries recorded with geographic coordinates (degree, min, sec)',
            'Demarcation of PA use zones (zoning)',
            'Demarcation of boundaries, or part of them, that are ambulatory [e.g. banks, rivers, etc.] and may need to be revised',
            'Demarcation by natural elements using a clear statement (e.g. tidal or river flooding data – average low water, average high water, etc.)'
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
                'N/A' => 'this element is not related to the management of the OECM',
                '0' => 'Completely inadequate (Lack of correspondence with legal standing / randomly demarcated, 0-30% of the needs)',
                '1' => 'Somewhat inadequate (Inadequate correspondence to the legal standing / ambiguous demarcated 31-60% of the needs)',
                '2' => 'Adequate (Quite adequate correspondence to the legal standing / not clearly demarcated,61-90% of the needs)',
                '3' => 'Fully adequate (full Correspondence to the legal standing / clearly demarcated, 91-100% of the needs)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Is the boundary of the OECM marked and adequate?',
            'Demarcation of OECMs is useful from legal perspective, since it allows defining exactly where the controls specific for the OECM can be enforced (e.g., monitoring and sanctions can be applied in not sustainable use of the key elements).'
        ],
        'module_info_Rating' => [
            'Evaluate  <ol type="A"><li>the degree to which the boundaries of OECM area marked</li><li>the adequacy of the borders demarcation for the management of the OECM</li></ol>'
        ]
    ],

    'ManagementPlan' => [
        'title' => 'Management plan',
        'fields' => [
            'PlanExistence' => 'A) Is there a management plan?',
            'PrintedCopy' => 'Does the management entity have a printed copy?',
            'KnowledgePercentage' => 'Percentage of members or employees to whom the plan had been explained',
            'PlanUptoDate' => 'Is the management plan up to date?',
            'PlanApproved' => 'Has the management plan been approved?',
            'PlanImplemented' => 'Has the management plan been implemented?',
            'PlanAdequacyScore' => 'B) Adequacy regarding the clarity and applicability of the management plan',
            'Comments' => 'Comments / Explanation',
        ],
        'ratingLegend' => [
            'KnowledgePercentage' => [
                '0' => 'less than 10%',
                '1' => '10–50%',
                '2' => '51%-80%',
                '3' => 'more than 80%',
            ],
            'PlanAdequacyScore' => [
                '0' => 'The clarity and applicability of the vision, mission and objectives are completely inadequate (0-30% of needs)',
                '1' => 'The clarity and applicability of the vision, mission and objectives are somewhat inadequate (31-60% of needs)',
                '2' => 'The clarity and applicability of the vision, mission and objectives are adequate (61-90% of needs)',
                '3' => 'The clarity and applicability of the vision, mission and objectives are fully adequate (91-100% of needs)'
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Is there a management plan? If yes, is it adequate and practical to implement for the OECM?',
            'The Management Plan is a document which sets management approach and goals for management. Critical to the success of the plan is the widest possible consultation with stakeholders and development of objectives that can be agreed and adhered to by all who have interest in the use and ongoing survival of the area concerned (from IUCN/WDPA: Guidelines for recognising and reporting other effective area-based conservation measures, 2017)'
        ],
        'module_info_Rating' => [
            'Evaluate: A) the status of the management plan, B) Adequacy regarding the clarity and applicability:'
        ]
    ],

    'WorkPlan' => [
        'title' => 'Work plan',
        'fields' => [
            'PlanExistence' => 'A) Is there a workplan? Yes/no',
            'PrintedCopy' => 'Does the management entity have a printed copy?',
            'KnowledgePercentage' => 'Percentage of members or employees to whom the plan had been explained',
            'PlanUptoDate' => 'Is the workplan up to date (covering current period)? Yes/no',
            'PlanApproved' => 'Has the workplan been officially approved? Yes/no',
            'PlanImplemented' => 'Has the workplan or monitoring plan being implemented? Yes/no',
            'PlanAdequacyScore' => 'B) Adequacy regarding the clarity and applicability of the activities and established results of the work/action plan or monitoring plan',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'KnowledgePercentage' => [
                '0' => 'less than 10%',
                '1' => '10–50%',
                '2' => '51%-80%',
                '3' => 'more than 80%',
            ],
            'PlanAdequacyScore' => [
                '0' => 'The clarity and applicability of activities and expected results are fully inadequate',
                '1' => 'The clarity and applicability of activities and expected results are somewhat inadequate ',
                '2' => 'The clarity and applicability of activities and expected results are adequate',
                '3' => 'The clarity and applicability of activities and expected results are fully adequate'
            ],
        ],
        'module_info_Rating' => 'Evaluate: A) Status of the workplan plan, B) Clarity and applicability of the workplan established activities and results',
        'module_info_EvaluationQuestion' => [
            'Is there a work plan? If yes, is it adequate and practical to implement for the OECM?',
            'A workplan describes specific activities to be implemented allows monitoring progress in achieving outputs of the OECM. It provides necessary information to measure the success of the OECM in its conservation efforts (outcomes).'
        ]
    ],

    'Objectives' => [
        'title' => 'Objectives of the OECM',
        'fields' => [
            'Objective' => 'Objective',
            'Existence' => 'Existing in management plan',
            'EvaluationScore' => 'Adequacy',
            'IncludeInPlanning' => 'To add in planning',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Adequacy of management plan objectives for the key elements',
            'group1' => 'Prospective objectives for key elements prioritised in management, automatically reported from Management Context',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the OECM',
                '0' => 'Completely inadequate (0-30% of the needs)',
                '1' => 'Somewhat inadequate (31-60% of the needs)',
                '2' => 'Adequate (61-90% of the needs)',
                '3' => 'Fully adequate (91-100% of the needs)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Are the objectives set for the OECM adequate?',
            'The goals and objectives of the OECM must be clearly understood. They should be well -defined and worded to facilitate monitoring but also should relate to the key values of OECM (i.e. important species or ecosystems) or to major areas of management activity (e.g. tourism, education).'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of the management plan objectives for the OECM key elements , based on existing objectives from the management plan and Management Context'
        ],
        'warning_on_save' => 'WARNING!! <br /> Any modification might cause data loss in the following modules (if already encoded): <i>O/C1</i>',
    ],

    'ObjectivesContext' => [
        'module_info' =>
            'Establish and describe conservation objectives for Management context of the OECM. The objectives listed below
            will be used for improving management, and more specifically for the planning, resource (input) mobilisation,
            process phases, and for monitoring management activities of the OECM.'
    ],

    'ObjectivesPlanification' => [
        'module_info' => 'Establish and describe conservation objectives for planning of the OECM<br />The objectives listed below will be used for improving management, and more specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the OECM.'
    ],

    'InformationAvailability' => [
        'title' => 'Basic information',
        'fields' => [
            'Element' => 'Rating – Concept measured – Variables',
            'EvaluationScore' => 'Information availability',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                '0' => 'No or little information available to assist in the management (0-30% of the needs)',
                '1' => 'Very limited information available - insufficient to assist in the management  (31-60% of the needs)',
                '2' => 'Information available but moderately sufficient to assist in the management (61-90% of the needs)',
                '3' => 'Information available and largely sufficient to assist in the management (90-100% of the needs)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Do you have sufficient and relevant information to support the decision–making process of the OECM?',
            'Effective OECM management requires sufficient knowledge and information to inform decision- making. Without information good management is highly unlikely.'
        ],
        'module_info_Rating' => [
            'Assess the availability of information necessary to support the management of the OECM key elements , prioritised in management, automatically reported from Management Context'
        ]
    ],

    'CapacityAdequacy' => [
        'title' => 'Capacities for management and governance',
        'fields' => [
            'Member' => 'Member',
            'Weight' => 'Involvement',
            'Adequacy' => 'Adequacy',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Composition and staff or members of the Management Entity (automatically reported by CTX 3.1.2)',
            'group1' => 'Stakeholders involved or impacting the use of natural resources (automatically reported by CTX 5 – Direct users).'
        ],
        'ratingLegend' => [
            'Adequacy' => [
                '0' => 'No or very low staff capacities (0-30% of the needs)',
                '1' => 'Insufficient staff capacities (31-60% of the needs)',
                '2' => 'Adequate staff capacities but further improvements required (61-90% of the needs)',
                '3' => 'Completely sufficient staff capacities (91-100% of the needs)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Does the entity/entities in charge of management and governance have enough capacity to manage and govern the OECM?'
        ],
        'module_info_Rating' => [
            'Qualified, competent, committed and adequate human resources are central to the success of OECMs.'
        ]
    ],

    'BudgetAdequacy' => [
        'title' => 'Current budget',
        'fields' => [
            'EvaluationScore' => 'Adequacy of current budget',
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
            'Is the current budget adequate for appropriate management of the OECM?',
            'OECMs prepare their annual operating budgets each year or for several years. Key financial planning and budget documents are necessary to improve operational efficiency and effectiveness.'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of current year funding of the OECM in relation to conservation requirements (based on the analysis of the context of intervention, point CTX 3.2)'
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
                '0' => 'Basic financial needs for the OECM management are not secured (0–20% of needs secured)',
                '1' => 'Basic financial needs for the OECM management are very weakly secured (21–40% of needs secured)',
                '2' => 'Basic financial needs for the OECM management are weakly secured (41-60% of needs secured)',
                '3' => 'Basic financial needs for the OECM management are partially secured (61–75% of needs secured)',
                '4' => 'Basic financial needs for the OECM management are relatively well secured (76-90% of needs secured)',
                '5' => 'Basic financial needs for the OECM management are secured (> 90% of needs secured)',
            ],
            'EvaluationScore' => [
                '0' => 'Basic financial needs for the OECM management are secured only for 1 year (current year)',
                '1' => 'Basic financial needs for the OECM management are secured for 2 years (current year +1 year)',
                '2' => 'Basic financial needs for the OECM management are secured for 3 years (current year +2 years)',
                '3' => 'Basic financial needs for the OECM management are secured for 4 – and more years. (current year +3 years and more)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'How much of the required budget is secured, and for how long, to cover basic OECM management needs?',
            'Secure and reliable budget is critical for OECM planning and management, for large -scale and long- term activities.'
        ],
        'module_info_Rating' => [
            'Evaluate: A) the security of funding and B) the period of security of funding for the forthcoming years in relation to conservation requirements in the OECM'
        ]
    ],

    'ManagementEquipmentAdequacy' => [
        'title' => 'Infrastructure, equipment and facilities',
        'fields' => [
            'Equipment' => 'Criteria – Concept measured – Variable',
            'Adequacy' => 'A) Adequacy of infrastructure, equipment and facilities  (CTX 3.3)',
            'PresentNeeds' => 'B) Present needs for the availability for OECM management',
            'Comments' => 'Comments/Explanation',
        ],
        'adequacy' => 'Adequacy of infrastructure, equipment and facilities',
        'ratingLegend' => [
            'Adequacy' => [
                '0' => 'Completely inadequate (0-30% of the needs)',
                '1' => 'Somewhat inadequate (31-60% of the needs)',
                '2' => 'Adequate (61-90% of the needs)',
                '3' => 'Fully adequate (91-100% of the needs)',
            ],
            'PresentNeeds' => [
                '0' => 'Normal',
                '1' => 'High',
                '2' => 'Very high',
            ],
        ],
        'module_info_EvaluationQuestion' => [
            'Are the infrastructure, equipment and facilities of the OECM adequate for the management requirements? The infrastructure, equipment and facilities are important to ensure and enhance the operational efficiency and effectiveness of the OECM.'
        ],
        'module_info_Rating' => [
            'Evaluate: A) the adequacy of infrastructure, equipment and facilities (results automatically calculated on the basis of the analysis of the context of intervention, point CTX 3.3), B) the present needs for the availability of specific infrastructure, equipment and facilities for the OECM',
        ]
    ],

    'ObjectivesIntrants' => [
        'module_info' => 'Establish and describe conservation objectives for inputs of the OECM<br />The objectives listed below will be used for improving management, and more specifically for planning, resource (input) mobilisation, process phases, and for monitoring management activities of the OECM.'
    ],

    'ObjectivesProcessus' => [
        'module_info' => 'Establish and describe conservation objectives related to implementation process of the OECM The objectives entered below will be used for improving management, and mo re specifically for the planning, resource (input) mobilisation, process phases, and for monitoring management activities of the OECM.'
    ],

    'StaffCompetence' => [
        'title' => 'Staff skills/training',
        'fields' => [
            'Member' => 'Criteria – Concept measured – Variable',
            'Weight' => 'Involvement',
            'Adequacy' => 'Adequacy of capacity building activities for the OECM management entity',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Composition and staff or members of the OECM',
            'group1' => 'Stakeholders involved in management and impacting on the use of natural resources of the OECM'
        ],
        'ratingLegend' => [
            'Adequacy' => [
                '0' => 'Completely inadequate capacity building activities',
                '1' => 'Somewhat adequate capacity building activities',
                '2' => 'Adequate capacity-building activities, but improvements are needed',
                '3' => 'Fully adequate capacity building activities (sufficient and updated)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Are the OECM Management and Governance specific entity or combination of entities implementing adequate
            training and capacity-building programme(s) that responds to their members’ needs in achieving OECM objectives?',
            'Qualified, competent and committed workforce is central to the success of OECMs'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of capacity-building activities for the OECM Management and Governance specific entity or combination of entities members (identified in CTX 3.1.2 and CTX 5 – Direct users)'
        ]

    ],

    'HRmanagementPolitics' => [
        'title' => 'HR policies and procedures',
        'fields' => [
            'Conditions' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy of the human resource management policies and procedures ',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Compensation and benefits for employees',
            'Compensations on participation-based tasks',
            'Job or task assignment',
            'Health, safety and security',
            'Gender and ethnic equity',
            'Management of the relationships with stakeholders in tasks assignments to carry out',
            'Rules reducing favouritism and discrimination in task assignments',
            'Equity in accountability for activities carried out'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the OECM',
                '0' => 'Completely inadequate (0-30% of the needs)',
                '1' => 'Somewhat inadequate (31-60% of the needs)',
                '2' => 'Adequate (61-90% of the needs)',
                '3' => 'Fully adequate (91-100% of the needs)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Have the OECM Management and Governance specific entity or combination of entities adopted adequate management policies to motivate and retain its human resources?'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of the provisions of the human resource management policies',
            'Adequacy of the human resource management policies:'
        ],
        'module_info' => 'Provisions of the human resource management policies of the OECM Management and Governance specific entity or combination of entities (identified in SA 1 or CTX 3.1.1):',
    ],

    'AdministrativeManagement' => [
        'title' => 'Budget and finance',
        'fields' => [
            'Aspect' => 'Criteria - Measured concept – Variables',
            'EvaluationScore' => 'Rating: Set-up of the basic elements of budgetary and financial management',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Accountability: you are able to explain and demonstrate to all stakeholders how you have used your resources and what you have achieved',
            'Transparency: your organisation is transparent regarding its work and its finances, making information available to all stakeholders',
            'Integrity: individuals in your organisation are operating with honesty and propriety',
            'Financial stewardship: your organisation takes good care of the financial resources it has been given and ensures that they are used for the purpose intended',
            'Accounting standards: your organisation\'s system for keeping financial records and documentation follows accepted external accounting standards'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the OECM',
                '0' => 'Never',
                '1' => 'Rarely',
                '2' => 'Sometimes',
                '3' => 'Often',
                '4' => 'Always'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Are the budget and financial resources well managed to meet essential and priority management requirements of the OECM?',
            'The budget and financial management of a OECM should be robust to permit adequate budgeting and resource allocation. You can only achieve effective budget and financial management if you have a sound management and work plan with clear objectives.'
        ],
        'module_info_Rating' => [
            'Evaluate the set-up of the basic elements that must be in place to achieve good practice in budget and financial management.'
        ]
    ],

    'EquipmentMaintenance' => [
        'title' => 'Maintenance of infrastructure',
        'fields' => [
            'Equipment' => 'Criteria - Measured concept – Variables',
            'EvaluationScore' => 'Rating: Adequacy of maintenance',
            'AdequacyLevel' => 'Value from CTX 3.3',
            'Comments' => 'Comments/Explanation',
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the OECM',
                '0' => 'Completely inadequate (0-30% of the needs)',
                '1' => 'Somewhat inadequate (31-60% of the needs)',
                '2' => 'Adequate (61-90% of the needs)',
                '3' => 'Fully adequate (91-100% of the needs)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Are the OECM’s infrastructure, equipment and facilities adequately maintained?',
            'Poorly maintained infrastructure, equipment and facilities not only wear out more quickly, but also waste resources and fundamentally degrade the OECM’s capacity to achieve objectives.'
        ],
        'module_info_Rating' => [
            'Evaluate the level of maintenance of infrastructure, equipment and facilities in relation to management requirements for the OECM (based on the analysis of the context of intervention, point CTX 3.3)'
        ]
    ],

    'ManagementActivities' => [
        'title' => 'Managing key elements',
        'fields' => [
            'Activity' => 'Criteria - Measured concept – Variable',
            'EvaluationScore' => 'Adequacy of management actions',
            'InManagementPlan' => 'Action included in the management plan',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Key elements of the OECM'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the OECM',
                '0' => 'Completely inadequate (0-30% of the needs)',
                '1' => 'Somewhat inadequate (31-60% of the needs)',
                '2' => 'Adequate (61-90% of the needs)',
                '3' => 'Fully adequate (91-100% of the needs)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Are there specific management actions for the key elements of the OECM?',
            'To ensure a sustainability management of the key elements of the OECM, stakeholder(s)/management association(s) should evaluate the practices and actions can include conservation/restoration of animal (e.g., bees) and plant species (e.g., pharmacopoeia), managing fire, revegetation work, controlling invasive species, management of cultural resources, threat containment, etc.'
        ],
        'module_info_Rating' => [
            'Based on the list of the key elements identified in the Intervention context SA 2 and prioritise in Management analysis C2, evaluate adequacy of related management practices and actions.'
        ]
    ],

    'LawEnforcementImplementation' => [
        'title' => 'Resolving contentious issues',
        'fields' => [
            'Element' => 'Criteria – Concept measured – Variable',
            'Adequacy' => 'Adequacy',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Terrestrial and Sea control activities',
            'group1' => 'Actions in response to illegal activities or resolution of contentious issues',
        ],
        'predefined_values' => [
            'group0' => [
                'Organisation management of unites/groups of control',
                'Number of unites/groups of control per month',
                'Use of collaborative control achieved through the collaboration with stakeholders',
                'Organisation of unites/groups of control in collaboration with forest – sea agents and sworn officers',
                'Equipped unites/groups of control by diverse means (e.g., patrol types such as observation points, foot, bicycle, motorcycles, vehicle/boats-assisted unites/groups, etc.)',
                'Use of GPS or other supports tools to conduct briefing and debriefing of the unites/groups of control',
                'Enforcement of control by unites/groups operating during the night or unscheduled hours',
                'Continuous update and use of a simple fact sheet outlining zoning, controls, restrictions, and illegal activities'
            ],
            'group1' => [
                'Specific unit or administrator / warden orienting and supporting the control unites/groups against illegal activities or contentious issues',
                'Organisation of informants system orienting and supporting orienting and supporting the control unites/groups against illegal activities or contentious issues',
                'System for implementing legal actions against illegal activities',
                'Judgements obtained in court',
                'System to solve contentious issues',
                'Judgements obtained under traditional rules',
                'Collaboration with NGOs specialised in terrestrial and marine laws, enforcement, etc. (rights, rules, etc.) on management sustainability of the key elements of the OECM'
            ]
        ],
        'ratingLegend' => [
            'Adequacy' => [
                'N/A' => 'this element is not related to the management of the OECM',
                '0' => 'Completely inadequate (0-30%)',
                '1' => 'Somewhat inadequate (31-60%)',
                '2' => 'Adequate (61-90%)',
                '3' => 'Fully adequate (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'How adequate are the control and actions against illegal activities aimed at guaranteeing sustainability of the management of the key elements of the OECM?',
            'Control (observation activities and data collection) is an essential activity to enforce existing legal, traditional and specific rules to ensure long-term management of the key elements of the OECM.'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of elements of the ranger patrols management oriented on ensuring long-term protection of biodiversity and other values',
            'Evaluate the acting against illegal activities or to solve contentious issues in the sustainability of the management of the key elements of the OECM'
        ]
    ],

    'StakeholderCooperation' => [
        'title' => 'Stakeholders’ collaboration',
        'fields' => [
            'Element' => 'Criteria – Concept measured – Variable',
            'Weight' => 'Involvement of the stakeholder (0-100)',
            'Cooperation' => 'Degree of cooperation',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'Community/group or other',
            'group1' => 'Government',
            'group2' => 'NGOs, Scientists and Donors',
            'group3' => 'Economic operators',
        ],
        'predefined_values' => [
            'group0' => [
                ''
            ],
            'group1' => [
                ''
            ],
            'group2' => [
                ''
            ],
            'group3' => [
                ''
            ]
        ],
        'ratingLegend' => [
            'Cooperation' => [
                'N/A' => 'this element is not related to the management of the OECM',
                '0' => 'No cooperation',
                '1' => 'Very little cooperation',
                '2' => 'Moderate cooperation',
                '3' => 'Very high cooperation'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Are there actions to improve governance of the key elements in the OECM?',
            'This step of the analysis evaluates how some or all relevant stakeholders are involved in management of the OECM in four areas: (P) planning; (PM) planning and management (B/A) benefits/assistance (IEC) Information, education and communication for community understanding and engagement.'
        ]
    ],

    'AssistanceActivities' => [
        'title' => 'Benefits to local communities',
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
                'Support food security (small farming, small scale fisheries, harvesting, hunting, etc.)',
                'Support for local business (processing of agricultural food production, fishing construction of boat sheds, boat parking, forest products, etc.)',
                'Support for tourism businesses (distribution of tourism incomes, traditional products and crafts for tourists, agriculture products or seafood, etc.)',
                'Support for local funding pathways',
                'Support for human-wildlife conflict resolutions - compensation',
                'Support of employment local human resources in the OECM, in tourism, etc.',
                'Support local service providers',
                'Provision of natural resources in case of need (e.g., water, fibres, etc. from the OECMs during crises or materiel contribution for social buildings such as hospital, school)',
                'Provide power supply, electrical connection, water supply – connection, construction, maintenance and improvement of roads, etc.'
            ],
            'group1' => [
                'Minimisation of conflicts and strengthening of the sustainable management and use of key elements of the OECM (provisioning and cultural)',
                'Provision of education, health infrastructure (i.e., buildings, clean water)',
                'Provision of educational services (teaching), health services (health care)',
                'Provision of cultural services (physical – intellectual – emblematic – spiritual – interaction from OECM services)',
                'Facilitation of social problem solving',
                'Strengthening of the identity and sense of place of indigenous peoples and local communities (IPLCs)',
                'Minimisation of conflicts and strengthening of the sustainable management and use of key elements of the OECM (provisioning and cultural)',
                'Provision of education, health infrastructure (i.e., buildings, clean water)',
                'Provision of educational services (teaching), health services (health care)',
                'Provision of cultural services (physical – intellectual – emblematic – spiritual – interaction from OECM services)',
                'Facilitation of social problem solving',
                'Strengthening of the identity and sense of place of indigenous peoples and local communities (IPLCs)'
            ]
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the OECM',
                '0' => 'Completely inadequate (0-30%)',
                '1' => 'Somewhat inadequate (31-60%)',
                '2' => 'Adequate (61-90%)',
                '3' => 'Fully adequate (91-100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Does the OECM carry out activities/programmes designed to provide appropriate benefits/assistance for communities?',
            'OECMs should contribute to sustainable development and economic well-being of the stakeholders. Accordingly, international best practice standards promote OECM assessment that accounts for both ecological and socio-economic outcomes (Sources UNESCO - IUCN).'
        ],
        'module_info_Rating' => [
            'Evaluate adequacy of the activities/programme that the OECM is carrying out to provide benefits/assistance for stakeholders.'
        ],
    ],

    'EnvironmentalEducation' => [
        'title' => 'Environmental education',
        'fields' => [
            'Activity' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy of the activities of environmental education and public awareness',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Stakeholders conservation programmes of the OECM',
            'Programs to raise awareness of the stakeholders of the OECM',
            'Programs to raise awareness among stakeholders other than the stakeholders of the OECM',
            'Environmental education programme in schools of the landscape of the OECM',
            'Radio - Television programmes about the OECM (e.g., on community radio stations)',
            'Conferences and debates on OECM',
            'Guided tours for stakeholders in the OECM',
            'Waste and clean-up operations',
            'Public awareness (e.g., ecomuseums)'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the OECM',
                '0' => 'Completely inadequate (0-30%)',
                '1' => 'somewhat inadequate (31-60%)',
                '2' => 'adequate (61-90%)',
                '3' => 'fully adequate (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Does the OECM carry out activities/programmes of environmental education and public awareness specifically linked to the needs and objectives of conservation/management of key elements?',
            'Environmental education can help individuals to balance their own vital needs with the needs of the natural environment that provides services (provisioning, regulating, cultural and supporting) for the stakeholders inside and outside, near and far from the OECM (considering the specific designation of the OECM). This could be achieved by increasing awareness and effectively changing the stakeholders’ perspective on the OECM'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of the environmental education and the public awareness activities/programmes that are supported by the OECM'
        ]
    ],

    'VisitorsManagement' => [
        'title' => 'Tourism management',
        'fields' => [
            'Aspect' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy of visitor facilities and services',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Existence of specific objectives for tourism and visitor management',
            'Existence of tourism management procedures',
            'Raising awareness of the consequences of ecotourism activities',
            'Actions to minimise human‐induced changes (transport, accommodation, and leisure activities)',
            'Tourism diversification through promoting biophysical, cultural and social values',
            'Economic benefits for OECMs management and governance ensured',
            'Accommodation, catering and leisure activities management (also for disabled people)',
            'Tourist guides in the OECM',
            'Tourism monitoring data'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the OECM',
                '0' => 'Completely inadequate (0-30%)',
                '1' => 'Somewhat inadequate (31-60%)',
                '2' => 'Adequate (61-90%)',
                '3' => 'Fully adequate (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Does the OECM manage (designs, establishes, maintains and improves) the required visitor facilities, services and impact of the environmental tourism?',
            'Tourism occur in unique historical, cultural and geographical contexts involving multiple values and stakeholders of the OECM. Effective management of OECM tourism requires appreciation and understanding of environmental, social and economic sustainability contexts and a compatible management of visitor facilities and services.'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of the management of visitor facilities, services, impact on the OECM environmental and cultural tourism'
        ]
    ],

    'NaturalResourcesMonitoring' => [
        'title' => 'Monitoring and research',
        'fields' => [
            'Aspect' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy of monitoring',
            'Comments' => 'Comments/Explanation',
        ],
        'predefined_values' => [
            'Use of data from monitoring to induce changes in the management and governance of the OECM',
            'Monitoring of the key elements',
            'Monitoring threats to the OECM',
            'Monitoring material and immaterial living standard of stakeholders',
            'Research on the key elements',
            'Research on material and immaterial living standard of stakeholders'
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the OECM',
                '0' => 'Completely inadequate (0-30%)',
                '1' => 'somewhat inadequate (31-60%)',
                '2' => 'adequate (61-90%)',
                '3' => 'fully adequate (91-100%)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Are the monitoring and research systems adequate to effectively monitor of the key elements of the OECM?',
            'To anticipate potential issues and plan the best interventions, a solid understanding of the trends of the key elements of the OECM environmental and services as biodiversity, provisioning (water, food supply, etc.), forest quality, threats, etc. is indispensable'
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of the monitoring and research systems in place for the key elements of the OECM'
        ]
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
                '0' => 'No or very low level of implementation of the activities targeted for the last year (between 0 and 25%)',
                '1' => 'Low level of implementation of the activities targeted for the last year (between 26 and 50%)',
                '2' => 'Moderate level of implementation of the activities targeted for the last year (between 51 and 75%)',
                '3' => 'High level of implementation of the activities targeted for the last year (between 76 and 100%)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'To what extent has the OECM implemented the main activities of the work/action plan?',
            'Implementation is the carrying out, or execution, of the annual or multi-year work/action plan concerning the activities of the OECM'
        ],
        'module_info_Rating' => [
            'Evaluate the level of implementation of the priorities defined in the work/action plan for the previous year (in the comments box indicate the year of reference if you use a multi-year work/action plan)',
            '<b>Category of activities</b>: key elements management, control, environmental education, tourism management, etc.',
            '<b>Activity</b>: action belonging to one of the main categories of activities that is executed to achieve particular purpose',
            'Without a work/action plan you can refer to the categories and the activities of the Process element: Management and protection of the key elements; Stakeholder relations; Tourism; Monitoring and research; etc.'
        ]
    ],

    'ManagementGovernance' => [
        'title' => 'Area Control',
        'fields' => [
            'Patrol' => 'A) Area covered by control',
            'Comments' => 'Comments/Explanation'
        ],
        'ratingLegend' => [
            'Patrol' => [
                '0' => 'Area covered by control is minimal (from 0 to 25% of the surface area)',
                '1' => 'Area covered by control is limited (from 26 to 50% of the surface area)',
                '2' => 'Area covered by control is fair (from 51 to 75% of the surface area)',
                '3' => 'Area covered by control is very good (more than 76% of the surface area)',
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'What is the current extent of control of the management and the governance of the key elements of the OECM?',
            'The ability to ensure the control and collection of information of the key elements prioritised in the management and governance of OECM prevent or minimise illegal activities or contentious issues.'
        ],
        'module_info_Rating' => [
            'Evaluate the control of the key elements prioritised in the management and governance of OECM.'
        ]
    ],

    'AchievedObjectives' => [
        'title' => 'Achievement of long-term objectives of the OECM management and governance',
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
            'To what extent has the OECM achieved the main objectives of their plan of management and governance?',
            '(Based on the analysis of the context of intervention, point CTX1.5 Vision – Objectives or elements of Planning, point P6 – Existing objectives of the management plan).',
            'The goals and objectives of an OECM must be clearly understood if management is to be successful based on measurable achievements. '
        ],
        'module_info_Rating' => [
            'Evaluate the level of achievement of principal long-term goals / objectives related to the key elements of the OECM.'
        ]
    ],

    'KeyElementsImpact' => [
        'title' => 'Effects on key conservation elements',
        'fields' => [
            'KeyElement' => 'Key conservation element',
            'StatusSH' =>   'Status',
            'TrendSH' =>    'Trend',
            'EffectSH' =>   'Effect',
            'ReliabilitySH' =>  'Reliability of information',
            'CommentsSH' =>     'Comments/Explanation',
            'StatusER' =>   'Status',
            'TrendER' =>    'Trend',
            'EffectER' =>   'Effect',
            'ReliabilityER' =>  'Reliability of information',
            'CommentsER' =>     'Comments/Explanation',
        ],
        'from_sa' => 'From stakeholders',
        'from_external_source' => 'From external source',
        'groups' => [
            'group0' => 'Key animal species',
            'group1' => 'Key plants species',
            'group2' => 'Key habitats',
        ],
        'module_info_EvaluationQuestion' => [
            'Does the management and governance exert positive or negative effects on the key conservation elements of the OECM?',
            'One of the main objectives of the OECM is to deliver positive and sustained outcomes for the in-situ conservation
            of biodiversity. By comparing the internal assessment of key conservation elements of SA2 with corresponding technical
            data of the same landscape or region, allows for a detailed analysis and interpretation of the findings, highlighting
            specific observations, discrepancies, areas of alignment, and potential recommendations for modifications or adopting
            best practices. The results of the comparison between the internal evaluation and external data on the same key
            conservation elements can be provided in the comments section.'
        ],
        'module_info_Rating' => [
            'Report the external data of A) the conditions and B) the trends of the key conservation elements from technical and
            scientific studies and monitoring in the same landscape or region.'
        ],
        'ratingLegend' => [
            'StatusSH' => [
                '-2' => 'Decreasing',
                '-1' => 'Slightly decreasing',
                '0' => 'No change',
                '+1' => 'Slightly increasing',
                '+2' => 'Increasing',
            ],
            'TrendSH' => [
                '-2' => 'Decreasing',
                '-1' => 'Slightly decreasing',
                '0' => 'No change',
                '+1' => 'Slightly increasing',
                '+2' => 'Increasing',
            ]
        ]
    ],

    'LifeQualityImpact' => [
        'title' => 'Impacts on local communities',
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
                'Food security (small farming, small scale fisheries, harvesting, hunting, etc.)',
                'Local business (processing of agricultural food production, fishing construction of boat sheds, boat parking, forest products, etc.)',
                'Human-wildlife conflict resolutions - compensation',
                'Employment local human resources in the OECM, in tourism, etc.',
                'Natural resources in case of need (e.g., water, fibres, etc. from the OECMs during crises or materiel contribution for social buildings such as hospital, school)',
                'Power supply, electrical connection, water supply – connection, construction, maintenance and improvement of roads, etc.'
            ],
            'group1' => [
                'Conflicts and strengthening of the sustainable management and use of key elements of the OECM (provisioning and cultural)',
                'Education, health infrastructures (i.e., buildings, clean water)',
                'Educational services (teaching), health services (health care)',
                'Cultural services (physical – intellectual – emblematic – spiritual – interaction from OECM services)',
                'Social problem solving',
                'Identity and sense of place of indigenous peoples and local communities (IPLCs)'
            ]
        ],
        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the OECM',
                '-3' => 'Highly damaging effects',
                '-2' => 'Damaging effects',
                '-1' => 'Slightly damaging effects',
                '0' => 'Neutral',
                '+1' => 'Slightly favourable effects',
                '+2' => 'Favourable effects',
                '+3' => 'Highly favourable effects'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Does the management and governance of the OECM exert positive or negative effects on the quality of life of the stakeholders?',
            'The OECM management and governance should take great care in the effects on the quality of life of local stakeholders. The availability of essential resources can affect the quality of life through impacts on consumption, income and wealth (material living standards) and on good life, health and social and cultural relations (immaterial living standards). '
        ],
        'module_info_Rating' => [
            'Evaluate the effects of the management and governance of the OECM on stakeholders.'
        ]
    ],

    'EmpowermentGovernance' => [
        'title' => 'Stakeholders, empowerment',
        'fields' => [
            'Conditions' => 'Criteria – Concept measured – Variable',
            'EvaluationScore' => 'Adequacy of stakeholders empowerment',
            'Comments' => 'Comments/Explanation',
        ],
        'groups' => [
            'group0' => 'INVOLVEMENT',
            'group1' => 'RESPONSIBILITY',
            'group2' => 'DIRECTION'
        ],
        'predefined_values' => [
            'group0' => [
                'Representation: existing mechanisms that will ensure the legitimate representation of stakeholders in OECM decision-making',
                'Acceptance: understanding and recognition of customary rights on ecosystem services',
                'Acceptance: social acceptance of the legitimacy of legal rights of the ecosystem services',
                'Consensus orientation: decision-making maintaining an active dialogue and seeking consensus on solutions that meet, at least in part, the concerns and interest of everyone'
            ],
            'group1' => [
                'Respect for agreements: monitoring of the respect of agreements made between different stakeholders',
                'Fairness in cost-benefit associated with conservation: maximising the ecological, social, economic and cultural benefits of OECMs without incurring unnecessary costs or causing damage to the local communities',
                'Management efficiency: application of the existing governance of the ecosystem services effective and efficient in delivering ecological, social, economic and cultural benefits of OECM'
            ],
            'group2' => [
                'Direction (Vision): development and application of a coherent strategic vision (long-term perspective) based on agreed values and an appreciation of ecological, historical, social and cultural complexities',
                'Legalisation: promoting the legalisation of stakeholders\' rights in the management and governance of ecosystem services maximising the ecological, social, economic and cultural benefits of protected and conserved',
                'Respect for values: supporting the improvement of all the ecological, provisioning, control, cultural values of OECM for the benefit of communities'
            ]
        ],

        'ratingLegend' => [
            'EvaluationScore' => [
                'N/A' => 'this element is not related to the management of the OECM',
                '0' => 'Completely inadequate (0-30% of the needs)',
                '1' => 'Somewhat inadequate (31-60% of the needs)',
                '2' => 'Adequate (61-90% of the needs)',
                '3' => 'Fully adequate (91-100% of the needs)'
            ]
        ],
        'module_info_EvaluationQuestion' => [
            'Does the management of the OECM use adequate measures / approaches / tools for ensuring staff motivation?',
            'For a OECM, motivated staff is essential to achieve success in conservation. Working conditions and staff motivation strongly influence the ability of staff to carry out their work. Managers and leaders must understand that they need to provide a work environment that creates and maintains motivation in the staff to achieve results on conservation',
        ],
        'module_info_Rating' => [
            'Evaluate the adequacy of staff motivation measures / approaches / tools in the OECM',
        ]
    ],
];
