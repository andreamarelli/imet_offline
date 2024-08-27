export default {
    indicators: [
        window.Locale.getLabel('imet-core::common.steps_eval.context'),
        window.Locale.getLabel('imet-core::common.steps_eval.outcomes'),
        window.Locale.getLabel('imet-core::common.steps_eval.outputs'),
        window.Locale.getLabel('imet-core::common.steps_eval.process'),
        window.Locale.getLabel('imet-core::common.steps_eval.inputs'),
        window.Locale.getLabel('imet-core::common.steps_eval.planning')
    ],
    color: [
        '#00B050',
        '#92D050',
        '#0099CC',
        '#ffc000',
        '#bfbfbf',
        '#ffff00'
    ],
    color_correct_order: [
        '#ffff00',
        '#bfbfbf',
        '#ffc000',
        '#0099CC',
        '#92D050',
        '#00B050'
    ],
    element_diagrams: {
        color: [{'context': '#ffff00'},
            {'planning': '#bfbfbf'},
            {'inputs': '#ffc000'},
            {'process': '#0099CC'},
            {'outputs': '#92D050'},
            {'outcomes': '#00B050'}],
        context: [
            {
                key: 'overall_scores',
                name: 'main',
                menu: {
                    header: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.main.header'),
                    title: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.main.title'),
                    radar: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.main.radar'),
                    ranking: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.main.ranking'),
                    average_contribution: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.main.average_contribution'),
                    datatable: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.main.datatable'),
                },
                ranking_labels: false,
                columns: [
                    {
                        "label": window.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                        "field": "name"
                    },
                    {
                        "label": `C1: ${window.Locale.getLabel('imet-core::analysis_report.assessment.c1')}`,
                        "field": "c1"
                    },
                    {
                        "label": `C2: ${window.Locale.getLabel('imet-core::analysis_report.assessment.c2')}`,
                        "field": "c2",
                        "extra_label": ` ${window.Locale.getLabel('imet-core::analysis_report.scale.negative_positive')}`
                    },
                    {
                        "label": `C3: ${window.Locale.getLabel('imet-core::analysis_report.assessment.c3')}`,
                        "field": "c3",
                        "extra_label": ` ${window.Locale.getLabel('imet-core::analysis_report.scale.zero_negative')}`
                    },
                    {
                        "label": `${window.Locale.getLabel('imet-core::common.steps_eval.context')}`,
                        "field": "context",
                        "extra_label": ``
                    }
                ]
            },
            {
                key: 'context_value_and_importance',
                name: 'context_value_and_importance',
                menu: {
                    title: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.context_value_and_importance.title'),
                    radar: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.context_value_and_importance.radar'),
                    ranking: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.context_value_and_importance.ranking'),
                    average_contribution: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.context_value_and_importance.average_contribution'),
                    datatable: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.context_value_and_importance.datatable'),
                },
                ranking_labels: false,
                columns: [
                    {
                        "label": window.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                        "field": "name"
                    },
                    {
                        "label": `C1.1: ${window.Locale.getLabel('imet-core::analysis_report.assessment.c11')}`,
                        "field": "c11"
                    },
                    {
                        "label": `C1.2: ${window.Locale.getLabel('imet-core::analysis_report.assessment.c12')}`,
                        "field": "c12",
                    },
                    {
                        "label": `C1.3: ${window.Locale.getLabel('imet-core::analysis_report.assessment.c13')}`,
                        "field": "c13"
                    },
                    {
                        "label": `C1.4: ${window.Locale.getLabel('imet-core::analysis_report.assessment.c14')}`,
                        "field": "c14"
                    },
                    {
                        "label": `C1.5: ${window.Locale.getLabel('imet-core::analysis_report.assessment.c15')}`,
                        "field": "c15"
                    },
                    {
                        "label": `${window.Locale.getLabel('imet-core::analysis_report.element_diagrams.context.context_value_and_importance.datatable_average')}`,
                        "field": "avg"
                    }
                ]
            },
        ],
        threats:
            {
                name: 'threats',
                ranking_labels: false,
                menu: {
                    title: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.threats.threats.title'),
                    radar: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.threats.threats.radar'),
                    ranking: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.threats.threats.ranking'),
                    average_contribution: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.threats.threats.average_contribution'),
                    datatable: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.threats.threats.datatable'),
                }
            },
        planning: [
            {
                name: 'main',
                menu: {
                    header: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.planning.main.header'),
                    radar: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.planning.main.radar'),
                    ranking: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.planning.main.ranking'),
                    average_contribution: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.planning.main.average_contribution'),
                    datatable: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.planning.main.datatable'),
                },
                ranking_labels: false,
                columns: [
                    {
                        "label": window.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                        "field": "name"
                    },
                    {
                        "label": `P1: ${window.Locale.getLabel('imet-core::analysis_report.assessment.p1')}`,
                        "field": "p1"
                    },
                    {
                        "label": `P2: ${window.Locale.getLabel('imet-core::analysis_report.assessment.p2')}`,
                        "field": "p2",
                    },
                    {
                        "label": `P3: ${window.Locale.getLabel('imet-core::analysis_report.assessment.p3')}`,
                        "field": "p3"
                    },
                    {
                        "label": `P4: ${window.Locale.getLabel('imet-core::analysis_report.assessment.p4')}`,
                        "field": "p4"
                    },
                    {
                        "label": `P.5: ${window.Locale.getLabel('imet-core::analysis_report.assessment.p5')}`,
                        "field": "p5"
                    },
                    {
                        "label": `P6: ${window.Locale.getLabel('imet-core::analysis_report.assessment.p6')}`,
                        "field": "p6"
                    },
                    {
                        "label": `${window.Locale.getLabel('imet-core::common.steps_eval.planning')}`,
                        "field": "planning",
                        "extra_label": ``
                    }
                ]

            }
        ],
        inputs: [
            {
                name: 'main',
                menu: {
                    header: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.inputs.main.header'),
                    radar: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.inputs.main.radar'),
                    ranking: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.inputs.main.ranking'),
                    average_contribution: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.inputs.main.average_contribution'),
                    datatable: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.inputs.main.datatable'),
                },
                ranking_labels: false,
                columns: [
                    {
                        "label": window.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                        "field": "name"
                    },
                    {
                        "label": `I1: ${window.Locale.getLabel('imet-core::analysis_report.assessment.i1')}`,
                        "field": "i1"
                    },
                    {
                        "label": `I2: ${window.Locale.getLabel('imet-core::analysis_report.assessment.i2')}`,
                        "field": "i2",
                    },
                    {
                        "label": `I3: ${window.Locale.getLabel('imet-core::analysis_report.assessment.i3')}`,
                        "field": "i3"
                    },
                    {
                        "label": `I4: ${window.Locale.getLabel('imet-core::analysis_report.assessment.i4')}`,
                        "field": "i4"
                    },
                    {
                        "label": `I5: ${window.Locale.getLabel('imet-core::analysis_report.assessment.i5')}`,
                        "field": "i5"
                    },
                    {
                        "label": `${window.Locale.getLabel('imet-core::common.steps_eval.inputs')}`,
                        "field": "inputs",
                        "extra_label": ``
                    }
                ]

            }
        ],
        process: [
            {
                name: 'process_sub_indicators',
                menu: {
                    header: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_sub_indicators.header'),
                    title: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_sub_indicators.title'),
                    radar: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_sub_indicators.radar'),
                    ranking: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_sub_indicators.ranking'),
                    average_contribution: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_sub_indicators.average_contribution'),
                    datatable: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_sub_indicators.datatable'),
                },
                ranking_labels: false,
                columns: [
                    {
                        "label": window.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                        "field": "name"
                    },
                    {
                        "label": `PR A: ${window.Locale.getLabel('imet-core::analysis_report.assessment.PRA')}`,
                        "field": "PRA"
                    },
                    {
                        "label": `PR B: ${window.Locale.getLabel('imet-core::analysis_report.assessment.PRB')}`,
                        "field": "PRB",
                    },
                    {
                        "label": `PR C: ${window.Locale.getLabel('imet-core::analysis_report.assessment.PRC')}`,
                        "field": "PRC"
                    },
                    {
                        "label": `PR D: ${window.Locale.getLabel('imet-core::analysis_report.assessment.PRD')}`,
                        "field": "PRD"
                    },
                    {
                        "label": `PR E: ${window.Locale.getLabel('imet-core::analysis_report.assessment.PRE')}`,
                        "field": "PRE"
                    },
                    {
                        "label": `PR F: ${window.Locale.getLabel('imet-core::analysis_report.assessment.PRF')}`,
                        "field": "PRF"
                    },
                    {
                        "label": `${window.Locale.getLabel('imet-core::common.steps_eval.process')}`,
                        "field": "avg"
                    }
                ]
            }],
        process_PRA: [{
            name: 'process_internal_management',
            menu: {
                title: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_internal_management_systems_processes.title'),
                radar: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_internal_management_systems_processes.radar'),
                ranking: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_internal_management_systems_processes.ranking'),
                average_contribution: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_internal_management_systems_processes.average_contribution'),
                datatable: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_internal_management_systems_processes.datatable'),
            },
            columns: [
                {
                    "label": window.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                    "field": "name"
                },
                {
                    "label": `PR1: ${window.Locale.getLabel('imet-core::analysis_report.assessment.pr1')}`,
                    "field": "pr1"
                },
                {
                    "label": `PR2: ${window.Locale.getLabel('imet-core::analysis_report.assessment.pr2')}`,
                    "field": "pr2",
                },
                {
                    "label": `PR3: ${window.Locale.getLabel('imet-core::analysis_report.assessment.pr3')}`,
                    "field": "pr3"
                },
                {
                    "label": `PR4: ${window.Locale.getLabel('imet-core::analysis_report.assessment.pr4')}`,
                    "field": "pr4"
                },
                {
                    "label": `PR5: ${window.Locale.getLabel('imet-core::analysis_report.assessment.pr5')}`,
                    "field": "pr5",
                },
                {
                    "label": `PR6: ${window.Locale.getLabel('imet-core::analysis_report.assessment.pr6')}`,
                    "field": "pr6"
                },
                {
                    "label": `${window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_internal_management_systems_processes.datatable_average')}`,
                    "field": "avg"
                }
            ]

        }],
        process_PRB: [{
            name: 'process_management_protection_values',
            menu: {
                title: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_management_protection_values.title'),
                radar: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_management_protection_values.radar'),
                ranking: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_management_protection_values.ranking'),
                average_contribution: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_management_protection_values.average_contribution'),
                datatable: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_management_protection_values.datatable'),
            },
            columns: [
                {
                    "label": window.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                    "field": "name"
                },
                {
                    "label": `PR7: ${window.Locale.getLabel('imet-core::analysis_report.assessment.pr7')}`,
                    "field": "pr7"
                },
                {
                    "label": `PR8: ${window.Locale.getLabel('imet-core::analysis_report.assessment.pr8')}`,
                    "field": "pr8",
                },
                {
                    "label": `PR9: ${window.Locale.getLabel('imet-core::analysis_report.assessment.pr9')}`,
                    "field": "pr9"
                },
                {
                    "label": `${window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_management_protection_values.datatable_average')}`,
                    "field": "avg"
                }
            ]

        }],
        process_PRC: [{
            name: 'process_stakeholders_relationships',
            menu: {
                title: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_stakeholders_relationships.title'),
                radar: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_stakeholders_relationships.radar'),
                ranking: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_stakeholders_relationships.ranking'),
                average_contribution: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_stakeholders_relationships.average_contribution'),
                datatable: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_stakeholders_relationships.datatable'),
            },
            columns: [
                {
                    "label": window.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                    "field": "name"
                },
                {
                    "label": `PR10: ${window.Locale.getLabel('imet-core::analysis_report.assessment.pr10')}`,
                    "field": "pr10"
                },
                {
                    "label": `PR11: ${window.Locale.getLabel('imet-core::analysis_report.assessment.pr11')}`,
                    "field": "pr11",
                },
                {
                    "label": `PR12: ${window.Locale.getLabel('imet-core::analysis_report.assessment.pr12')}`,
                    "field": "pr12"
                },
                {
                    "label": `${window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_stakeholders_relationships.datatable_average')}`,
                    "field": "avg"
                }
            ]
        }],
        process_PRD: [{
            name: 'process_tourism_management',
            menu: {
                title: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_tourism_management.title'),
                radar: ``,
                ranking: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_tourism_management.ranking'),
                average_contribution: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_tourism_management.average_contribution'),
                datatable: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_tourism_management.datatable'),
            },
            columns: [
                {
                    "label": window.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                    "field": "name"
                },
                {
                    "label": `PR13: ${window.Locale.getLabel('imet-core::analysis_report.assessment.pr13')}`,
                    "field": "pr13"
                },
                {
                    "label": `PR14: ${window.Locale.getLabel('imet-core::analysis_report.assessment.pr14')}`,
                    "field": "pr14"
                },
                {
                    "label": `${window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_tourism_management.datatable_average')}`,
                    "field": "avg"
                }
            ]
        }],
        process_PRE: [{
            name: 'process_monitoring_and_research',
            menu: {
                title: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_monitoring_and_research.title'),
                radar: '',
                ranking: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_monitoring_and_research.ranking'),
                average_contribution: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_monitoring_and_research.average_contribution'),
                datatable: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_monitoring_and_research.datatable'),
            },
            columns: [
                {
                    "label": window.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                    "field": "name"
                },
                {
                    "label": `PR15: ${window.Locale.getLabel('imet-core::analysis_report.assessment.pr15')}`,
                    "field": "pr15"
                },
                {
                    "label": `PR16: ${window.Locale.getLabel('imet-core::analysis_report.assessment.pr16')}`,
                    "field": "pr16"
                },
                {
                    "label": `${window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_monitoring_and_research.datatable_average')}`,
                    "field": "avg"
                }
            ]
        }],
        process_PRF: [{
            name: 'process_effects_of_climate_change',
            menu: {
                title: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_effects_of_climate_change.title'),
                radar: '',
                ranking: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_effects_of_climate_change.ranking'),
                average_contribution: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_effects_of_climate_change.average_contribution'),
                datatable: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_effects_of_climate_change.datatable'),
            },
            columns: [
                {
                    "label": window.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                    "field": "name"
                },
                {
                    "label": `PR17: ${window.Locale.getLabel('imet-core::analysis_report.assessment.pr17')}`,
                    "field": "pr17"
                },
                {
                    "label": `PR18: ${window.Locale.getLabel('imet-core::analysis_report.assessment.pr18')}`,
                    "field": "pr18"
                },
                {
                    "label": `${window.Locale.getLabel('imet-core::analysis_report.element_diagrams.process.process_effects_of_climate_change.datatable_average')}`,
                    "field": "avg"
                }
            ]
        }
        ],
        outputs: [
            {
                name: 'main',
                menu: {
                    header: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.outputs.main.header'),
                    radar: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.outputs.main.radar'),
                    ranking: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.outputs.main.ranking'),
                    average_contribution: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.outputs.main.average_contribution'),
                    datatable: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.outputs.main.datatable'),
                },
                ranking_labels: false,
                columns: [
                    {
                        "label": window.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                        "field": "name"
                    },
                    {
                        "label": `O/P1: ${window.Locale.getLabel('imet-core::analysis_report.assessment.op1')}`,
                        "field": "op1"
                    },
                    {
                        "label": `O/P2: ${window.Locale.getLabel('imet-core::analysis_report.assessment.op2')}`,
                        "field": "op2",
                    },
                    {
                        "label": `O/P3: ${window.Locale.getLabel('imet-core::analysis_report.assessment.op3')}`,
                        "field": "op3"
                    },
                    {
                        "label": `O/P4: ${window.Locale.getLabel('imet-core::analysis_report.assessment.op4')}`,
                        "field": "op4"
                    },
                    {
                        "label": `${window.Locale.getLabel('imet-core::common.steps_eval.outputs')}`,
                        "field": "outputs",
                        "extra_label": ``
                    }
                ]

            }
        ],
        outcomes: [
            {
                name: 'main',
                menu: {
                    header: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.outcomes.main.header'),
                    radar: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.outcomes.main.radar'),
                    ranking: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.outcomes.main.ranking'),
                    average_contribution: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.outcomes.main.average_contribution'),
                    datatable: window.Locale.getLabel('imet-core::analysis_report.element_diagrams.outcomes.main.datatable'),

                },
                ranking_labels: false,
                columns: [
                    {
                        "label": window.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                        "field": "name"
                    },
                    {
                        "label": `O/C1: ${window.Locale.getLabel('imet-core::analysis_report.assessment.oc1')}`,
                        "field": "oc1"
                    },
                    {
                        "label": `O/C2: ${window.Locale.getLabel('imet-core::analysis_report.assessment.oc2')}`,
                        "field": "oc2",
                        "extra_label": ` ${window.Locale.getLabel('imet-core::analysis_report.scale.negative_positive')}`
                    },
                    {
                        "label": `O/C3: ${window.Locale.getLabel('imet-core::analysis_report.assessment.oc3')}`,
                        "field": "oc3",
                        "extra_label": ` ${window.Locale.getLabel('imet-core::analysis_report.scale.negative_positive')}`
                    },
                    {
                        "label": `${window.Locale.getLabel('imet-core::common.steps_eval.outcomes')}`,
                        "field": "outcomes",
                        "extra_label": ``
                    }
                ]

            }
        ],
    },
    dopa_indicators: {
        protected_area_coverage_and_connectivity: {
            title_table: window.Locale.getLabel('imet-core::analysis_report.protected_area_coverage_and_connectivity.title'),
            title_chart: window.Locale.getLabel('imet-core::analysis_report.protected_area_coverage_and_connectivity.chart'),
            bar_indicators: [
                {
                    field: 'area_prot_terr_perc',
                    label: window.Locale.getLabel('imet-core::analysis_report.protected_area_coverage_and_connectivity.protected_land_area'),
                    color: '#cae5a1'
                },
                {
                    field: 'area_prot_mar_perc',
                    label: window.Locale.getLabel('imet-core::analysis_report.protected_area_coverage_and_connectivity.protected_marine_area'),
                    color: '#8ecfe0'
                },
                {
                    field: 'protconn',
                    label: window.Locale.getLabel('imet-core::analysis_report.protected_area_coverage_and_connectivity.protected_connected_land'),
                    color: '#91ad41'
                }
            ],
            table_bar_indicators: [
                {
                    field: 'area_terr_km2',
                    label: window.Locale.getLabel('imet-core::analysis_report.protected_area_coverage_and_connectivity.total_land_area')
                },
                {
                    field: 'area_prot_terr_km2',
                    label: window.Locale.getLabel('imet-core::analysis_report.protected_area_coverage_and_connectivity.protected_land_area')
                },
                {
                    field: 'area_prot_terr_perc',
                    label: window.Locale.getLabel('imet-core::analysis_report.protected_area_coverage_and_connectivity.terrestrial_coverage'),
                    color: '#cae5a1'
                },
                {
                    field: 'area_mar_km2',
                    label: window.Locale.getLabel('imet-core::analysis_report.protected_area_coverage_and_connectivity.total_marine_area')
                },
                {
                    field: 'area_prot_mar_km2',
                    label: window.Locale.getLabel('imet-core::analysis_report.protected_area_coverage_and_connectivity.protected_marine_area')
                },
                {
                    field: 'area_prot_mar_perc',
                    label: window.Locale.getLabel('imet-core::analysis_report.protected_area_coverage_and_connectivity.marine_coverage'),
                    color: '#8ecfe0'
                },
                {
                    field: 'protconn',
                    label: window.Locale.getLabel('imet-core::analysis_report.protected_area_coverage_and_connectivity.protected_connected_land'),
                    color: '#91ad41'
                }
            ]
        },
        land_degradation: {
            title_table: window.Locale.getLabel('imet-core::analysis_report.land_degradation.title'),
            title_chart: window.Locale.getLabel('imet-core::analysis_report.land_degradation.chart'),
            indicators: [
                {
                    field: 'lpd_null_km2',
                    label: window.Locale.getLabel('imet-core::analysis_report.land_degradation.indicators.no_biomas'),
                    color: '#46a246'
                },
                {
                    field: 'lpd_severe_km2',
                    label: window.Locale.getLabel('imet-core::analysis_report.land_degradation.indicators.persistent_severe'),
                    color: '#c2c5cc'
                },
                {
                    field: 'lpd_moderate_km2',
                    label: window.Locale.getLabel('imet-core::analysis_report.land_degradation.indicators.persistent_moderate'),
                    color: '#b8d879'
                },
                {
                    field: 'lpd_stressed_km2',
                    label: window.Locale.getLabel('imet-core::analysis_report.land_degradation.indicators.stable_stressed'),
                    color: '#ec4900'
                },
                {
                    field: 'lpd_stable_km2',
                    label: window.Locale.getLabel('imet-core::analysis_report.land_degradation.indicators.stable_productivity'),
                    color: '#ed732e'
                },
                {
                    field: 'lpd_increased_km2',
                    label: window.Locale.getLabel('imet-core::analysis_report.land_degradation.indicators.persistent_increase'),
                    color: '#ab2849'
                }
            ],
            bar_indicators: [
                {
                    field: 'lpd_null_km2',
                    label: window.Locale.getLabel('imet-core::analysis_report.land_degradation.bar_indicators.no_biomas'),
                    color: '#46a246'
                },
                {
                    field: 'lpd_severe_km2',
                    label: window.Locale.getLabel('imet-core::analysis_report.land_degradation.bar_indicators.persistent_severe'),
                    color: '#c2c5cc'
                },
                {
                    field: 'lpd_moderate_km2',
                    label: window.Locale.getLabel('imet-core::analysis_report.land_degradation.bar_indicators.persistent_moderate'),
                    color: '#b8d879'
                },
                {
                    field: 'lpd_stressed_km2',
                    label: window.Locale.getLabel('imet-core::analysis_report.land_degradation.bar_indicators.persistent_strong'),
                    color: '#ec4900'
                },
                {
                    field: 'lpd_stable_km2',
                    label: window.Locale.getLabel('imet-core::analysis_report.land_degradation.bar_indicators.stable_productivity'),
                    color: '#ed732e'
                },
                {
                    field: 'lpd_increased_km2',
                    label: window.Locale.getLabel('imet-core::analysis_report.land_degradation.bar_indicators.persistent_increase'),
                    color: '#ab2849'
                }
            ]
        },
        total_carbon: {
            title_table: window.Locale.getLabel('imet-core::analysis_report.total_carbon.title'),
            indicators: [
                {
                    field: 'carbon_min_c_mg',
                    label: window.Locale.getLabel('imet-core::analysis_report.total_carbon.min')
                },
                {
                    field: 'carbon_mean_c_mg',
                    label: window.Locale.getLabel('imet-core::analysis_report.total_carbon.mean')
                },
                {
                    field: 'carbon_max_c_mg',
                    label: window.Locale.getLabel('imet-core::analysis_report.total_carbon.max')
                },
                {
                    field: 'carbon_stdev_c_mg',
                    label: window.Locale.getLabel('imet-core::analysis_report.total_carbon.std_dev')
                },
                {
                    field: 'carbon_tot_c_mg',
                    label: window.Locale.getLabel('imet-core::analysis_report.total_carbon.sum')
                },
            ]
        },
        forest_cover: {
            title_table: 'Forest Cover',
            title_chart: 'Forest loss and gain (%)',
            indicators: [
                {
                    field: 'gfc_treecover_km2',
                    label: 'Forest cover [km2]',
                    color: '#5b5b5b'
                },
                {
                    field: 'gfc_treecover_perc',
                    label: 'Forest cover [%]',
                    color: '#5b5b5b'
                },
                {
                    field: 'gfc_loss_km2',
                    label: 'Forest loss [km2]',
                    color: '#D9534F'
                },
                {
                    field: 'gfc_loss_perc',
                    label: 'Forest loss [%]',
                    color: '#D9534F'
                },
                {
                    field: 'gfc_gain_km2',
                    label: 'Forest gain [km2]',
                    color: '#337AB7'
                },
                {
                    field: 'gfc_gain_perc',
                    label: 'Forest gain [%]',
                    color: '#337AB7'
                },
            ],
            bar_indicators: [
                {
                    field: 'gfc_loss_perc',
                    label: 'Forest loss [%]',
                    color: '#D9534F'
                },
                {
                    field: 'gfc_gain_perc',
                    label: 'Forest gain [%]',
                    color: '#337AB7'
                }
            ]
        },
    },
    performance_diagram: {
        indicators: [
            window.Locale.getLabel('imet-core::common.steps_eval.context'),
            window.Locale.getLabel('imet-core::common.steps_eval.outcomes'),
            window.Locale.getLabel('imet-core::common.steps_eval.outputs'),
            window.Locale.getLabel('imet-core::common.steps_eval.process'),
            window.Locale.getLabel('imet-core::common.steps_eval.inputs'),
            window.Locale.getLabel('imet-core::common.steps_eval.planning')

        ],
        color: [
            '#ffff00',
            '#bfbfbf',
            '#ffc000',
            '#0099CC',
            '#92D050',
            '#00B050'
        ],

        columns: [
            {
                "label": window.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                "field": "name"
            },
            {
                "label": window.Locale.getLabel('imet-core::common.steps_eval.context'),
                "field": "context"
            },
            {
                "label": window.Locale.getLabel('imet-core::common.steps_eval.planning'),
                "field": "planning",

            },
            {
                "label": window.Locale.getLabel('imet-core::common.steps_eval.inputs'),
                "field": "inputs"
            },
            {
                "label": window.Locale.getLabel('imet-core::common.steps_eval.process'),
                "field": "process"
            },
            {
                "label": window.Locale.getLabel('imet-core::common.steps_eval.outputs'),
                "field": "outputs"
            },
            {
                "label": window.Locale.getLabel('imet-core::common.steps_eval.outcomes'),
                "field": "outcomes"
            },
            {
                "label": window.Locale.getLabel('imet-core::common.indexes.imet'),
                "field": "imet_index"
            }
        ]
    },
    evaluation_of_protected_area_management_cycle: {
        columns: [
            {
                "label": window.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                "field": "name"
            },
            {
                "label": window.Locale.getLabel('imet-core::common.steps_eval.context'),
                "field": "context"
            },
            {
                "label": window.Locale.getLabel('imet-core::common.steps_eval.planning'),
                "field": "planning",

            },
            {
                "label": window.Locale.getLabel('imet-core::common.steps_eval.inputs'),
                "field": "inputs"
            },
            {
                "label": window.Locale.getLabel('imet-core::common.steps_eval.process'),
                "field": "process"
            },
            {
                "label": window.Locale.getLabel('imet-core::common.steps_eval.outputs'),
                "field": "outputs"
            },
            {
                "label": window.Locale.getLabel('imet-core::common.steps_eval.outcomes'),
                "field": "outcomes"
            },
            {
                "label": window.Locale.getLabel('imet-core::common.indexes.imet'),
                "field": "imet_index"
            }
        ]
    },
    relative_performance_effectiveness_bar_average: {
        indicators: [
            window.Locale.getLabel('imet-core::common.steps_eval.outcomes'),
            window.Locale.getLabel('imet-core::common.steps_eval.outputs'),
            window.Locale.getLabel('imet-core::common.steps_eval.process'),
            window.Locale.getLabel('imet-core::common.steps_eval.inputs'),
            window.Locale.getLabel('imet-core::common.steps_eval.planning'),
            window.Locale.getLabel('imet-core::common.steps_eval.context'),
        ],
        color: [
            '#00B050',
            '#92D050',
            '#0099CC',
            '#ffc000',
            '#bfbfbf',
            '#ffff00',
            '#ffff00'
        ]
    },
    group_analysis_on_demand: {
        scatter_columns: [
            {
                "label": window.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                "field": "name"
            },
            {
                "label": window.Locale.getLabel('imet-core::common.steps_eval.process'),
                "field": "context"
            },
            {
                "label": `${window.Locale.getLabel('imet-core::common.steps_eval.context')}, ${window.Locale.getLabel('imet-core::common.steps_eval.planning')}, ${window.Locale.getLabel('imet-core::common.steps_eval.inputs')}`,
                "field": "planning",

            },
            {
                "label": `${window.Locale.getLabel('imet-core::common.steps_eval.outputs')}, ${window.Locale.getLabel('imet-core::common.steps_eval.outcomes')}`,
                "field": "inputs"
            },
        ],
        columns: [
            {
                "label": window.Locale.getLabel('imet-core::common.Create.fields.wdpa_id'),
                "field": "name"
            },
            {
                "label": window.Locale.getLabel('imet-core::common.steps_eval.context'),
                "field": "context"
            },
            {
                "label": window.Locale.getLabel('imet-core::common.steps_eval.planning'),
                "field": "planning",

            },
            {
                "label": window.Locale.getLabel('imet-core::common.steps_eval.inputs'),
                "field": "inputs"
            },
            {
                "label": window.Locale.getLabel('imet-core::common.steps_eval.process'),
                "field": "process"
            },
            {
                "label": window.Locale.getLabel('imet-core::common.steps_eval.outputs'),
                "field": "outputs"
            },
            {
                "label": window.Locale.getLabel('imet-core::common.steps_eval.outcomes'),
                "field": "outcomes"
            }
        ]
    },
    terrestial_ecoregions: {
        columns: [
            {
                'label': window.Locale.getLabel('imet-core::analysis_report.terrestial_ecoregions.name'),
                'field': 'eco_name'
            },
            {
                'label': window.Locale.getLabel('imet-core::analysis_report.terrestial_ecoregions.area'),
                'field': 'ecoregion_tot_sqkm'
            },
            {
                'label': window.Locale.getLabel('imet-core::analysis_report.terrestial_ecoregions.ecoregion_pa_sqkm'),
                'field': 'ecoregion_prot_sqkm',
                color: '#cae5a1'
            },
            {
                'label': window.Locale.getLabel('imet-core::analysis_report.terrestial_ecoregions.ecoregion_protected_tot_sqkm'),
                'field': 'pa_tot_sqkm',
                color: '#8ecfe0'
            },
            {
                'label': window.Locale.getLabel('imet-core::analysis_report.terrestial_ecoregions.protected_in_ecoregion'),
                'field': 'pa_in_eco_sqkm',
                color: '#91ad41'
            }
        ]
    },
    marine_ecoregions: {
        columns: [
            {
                'label': window.Locale.getLabel('imet-core::analysis_report.terrestial_ecoregions.name'),
                'field': 'eco_name'
            },
            {
                'label': window.Locale.getLabel('imet-core::analysis_report.terrestial_ecoregions.area'),
                'field': 'ecoregion_tot_sqkm'
            },
            {
                'label': window.Locale.getLabel('imet-core::analysis_report.terrestial_ecoregions.ecoregion_pa_sqkm'),
                'field': 'ecoregion_prot_sqkm',
                color: '#cae5a1'
            },
            {
                'label': window.Locale.getLabel('imet-core::analysis_report.terrestial_ecoregions.ecoregion_protected_tot_sqkm'),
                'field': 'pa_tot_sqkm',
                color: '#8ecfe0'
            },
            {
                'label': window.Locale.getLabel('imet-core::analysis_report.terrestial_ecoregions.protected_in_ecoregion'),
                'field': 'pa_in_eco_sqkm',
                color: '#91ad41'
            }]
    },
    copernicus: {
        columns: [
            {
                "label": window.Locale.getLabel('imet-core::analysis_report.copernicus.label'),
                "field": "label"
            },
            {
                "label": window.Locale.getLabel('imet-core::analysis_report.copernicus.percent'),
                "field": "percent"
            },
            {
                "label": window.Locale.getLabel('imet-core::analysis_report.copernicus.area'),
                "field": "area"
            },
            {
                "label": window.Locale.getLabel('imet-core::analysis_report.copernicus.color'),
                "field": "color",
                type: 'color'
            }
        ]
    },
    protected_area: {
        columns: [
            {
                "label": window.Locale.getLabel('imet-core::analysis_report.protected_area.name'),
                "field": "name"
            },
            {
                "label": window.Locale.getLabel('imet-core::analysis_report.protected_area.gis_area'),
                "field": "gis_area"
            },
            {
                "label": window.Locale.getLabel('imet-core::analysis_report.protected_area.nature'),
                "field": "nature",
                type: 'bg-color'
            }
        ]
    },
    map: {
        fields: [
            {
                label: '%',
                children: [
                    {
                        label: window.Locale.getLabel('imet-core::analysis_report.map.fields.area_prot_terr_perc'),
                        field: 'area_prot_terr_perc',
                        color: '#91cc75'
                    },
                    {
                        label: window.Locale.getLabel('imet-core::analysis_report.map.fields.protconn'),
                        field: 'protconn',
                        color: '#3ba272'
                    }
                ]
            }
        ],
        dopa_indicators: {
            terrestial_area: {
                title_table: window.Locale.getLabel('imet-core::analysis_report.map.dopa_indicators.terrestial_area.title_table'),
                indicators: [
                    {
                        field: 'area_terr_perc',
                        label: window.Locale.getLabel('imet-core::analysis_report.map.dopa_indicators.terrestial_area.area_terr_perc')
                    },
                    {
                        field: 'area_prot_terr_km2',
                        label: window.Locale.getLabel('imet-core::analysis_report.map.dopa_indicators.terrestial_area.area_prot_terr_km2')
                    },
                    {
                        field: 'area_terr_km2',
                        label: window.Locale.getLabel('imet-core::analysis_report.map.dopa_indicators.terrestial_area.area_terr_km2')
                    }
                ]
            },
            marine_area: {
                title_table: window.Locale.getLabel('imet-core::analysis_report.map.dopa_indicators.marine_indicators.title_table'),
                indicators: [
                    {
                        field: 'area_mar_perc',
                        label: window.Locale.getLabel('imet-core::analysis_report.map.dopa_indicators.marine_indicators.area_mar_perc')
                    },
                    {
                        field: 'area_prot_mar_km2',
                        label: window.Locale.getLabel('imet-core::analysis_report.map.dopa_indicators.marine_indicators.area_prot_mar_km2')
                    },
                    {
                        field: 'area_mar_km2',
                        label: window.Locale.getLabel('imet-core::analysis_report.map.dopa_indicators.marine_indicators.area_mar_km2')
                    }
                ]
            },
        },
    }
};
