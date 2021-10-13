export default {
    indicators: [
        window.Locale.getLabel('imet-core::v2_common.steps_eval.context'),
        window.Locale.getLabel('imet-core::v2_common.steps_eval.outcomes'),
        window.Locale.getLabel('imet-core::v2_common.steps_eval.outputs'),
        window.Locale.getLabel('imet-core::v2_common.steps_eval.process'),
        window.Locale.getLabel('imet-core::v2_common.steps_eval.inputs'),
        window.Locale.getLabel('imet-core::v2_common.steps_eval.planning')
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
        context: {
            columns: [
                {
                    "label": window.Locale.getLabel('imet-core::v2_context.Create.fields.wdpa_id'),
                    "field": "name"
                },
                {
                    "label": window.Locale.getLabel('imet-core::analysis_report.assessment.c11'),
                    "field": "c11"
                },
                {
                    "label": window.Locale.getLabel('imet-core::analysis_report.assessment.c12'),
                    "field": "c12",
                },
                {
                    "label": window.Locale.getLabel('imet-core::analysis_report.assessment.c13'),
                    "field": "c13"
                },
                {
                    "label": window.Locale.getLabel('imet-core::analysis_report.assessment.c14'),
                    "field": "c14"
                },
                {
                    "label": window.Locale.getLabel('imet-core::analysis_report.assessment.c15'),
                    "field": "c15"
                }
            ]
        },
        process: {
            columns: [
                {
                    "label": window.Locale.getLabel('imet-core::v2_context.Create.fields.wdpa_id'),
                    "field": "name"
                },
                {
                    "label": window.Locale.getLabel('imet-core::analysis_report.assessment.pr15_16'),
                    "field": "pr15_16"
                },
                {
                    "label": window.Locale.getLabel('imet-core::analysis_report.assessment.pr10_12'),
                    "field": "pr10_12",
                },
                {
                    "label": window.Locale.getLabel('imet-core::analysis_report.assessment.pr13_14'),
                    "field": "pr13_14"
                },
                {
                    "label": window.Locale.getLabel('imet-core::analysis_report.assessment.pr17_18'),
                    "field": "pr17_18"
                },
                {
                    "label": window.Locale.getLabel('imet-core::analysis_report.assessment.pr1_6'),
                    "field": "pr1_6"
                },
                {
                    "label": window.Locale.getLabel('imet-core::analysis_report.assessment.pr7_9'),
                    "field": "pr7_9"
                }
            ]
        }
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
                    label: window.Locale.getLabel('imet-core::analysis_report.protected_area_coverage_and_connectivity.protected_marin_area'),
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
            window.Locale.getLabel('imet-core::v2_common.steps_eval.context'),
            window.Locale.getLabel('imet-core::v2_common.steps_eval.outcomes'),
            window.Locale.getLabel('imet-core::v2_common.steps_eval.outputs'),
            window.Locale.getLabel('imet-core::v2_common.steps_eval.process'),
            window.Locale.getLabel('imet-core::v2_common.steps_eval.inputs'),
            window.Locale.getLabel('imet-core::v2_common.steps_eval.planning')

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
                "label": window.Locale.getLabel('imet-core::v2_context.Create.fields.wdpa_id'),
                "field": "name"
            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.steps_eval.context'),
                "field": "context"
            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.steps_eval.planning'),
                "field": "planning",

            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.steps_eval.inputs'),
                "field": "inputs"
            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.steps_eval.process'),
                "field": "process"
            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.steps_eval.outputs'),
                "field": "outputs"
            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.steps_eval.outcomes'),
                "field": "outcomes"
            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.indexes.imet'),
                "field": "imet_index"
            }
        ]
    },
    evaluation_of_protected_area_management_cycle: {
        columns: [
            {
                "label": window.Locale.getLabel('imet-core::v2_context.Create.fields.wdpa_id'),
                "field": "name"
            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.steps_eval.context'),
                "field": "context"
            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.steps_eval.planning'),
                "field": "planning",

            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.steps_eval.inputs'),
                "field": "inputs"
            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.steps_eval.process'),
                "field": "process"
            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.steps_eval.outputs'),
                "field": "outputs"
            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.steps_eval.outcomes'),
                "field": "outcomes"
            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.indexes.imet'),
                "field": "imet_index"
            }
        ]
    },
    relative_performance_effectiveness_bar_average: {
        indicators: [
            window.Locale.getLabel('imet-core::v2_common.steps_eval.context'),
            window.Locale.getLabel('imet-core::v2_common.steps_eval.planning'),
            window.Locale.getLabel('imet-core::v2_common.steps_eval.inputs'),
            window.Locale.getLabel('imet-core::v2_common.steps_eval.process'),
            window.Locale.getLabel('imet-core::v2_common.steps_eval.outputs'),
            window.Locale.getLabel('imet-core::v2_common.steps_eval.outcomes')
        ],
        color: [
            '#ffff00',
            '#bfbfbf',
            '#ffc000',
            '#0099CC',
            '#92D050',
            '#00B050',
            '#ffff00'
        ]
    },
    group_analysis_on_demand: {
        scatter_columns: [
            {
                "label": window.Locale.getLabel('imet-core::v2_context.Create.fields.wdpa_id'),
                "field": "name"
            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.steps_eval.process'),
                "field": "context"
            },
            {
                "label": `${window.Locale.getLabel('imet-core::v2_common.steps_eval.context')}, ${window.Locale.getLabel('imet-core::v2_common.steps_eval.planning')}, ${window.Locale.getLabel('imet-core::v2_common.steps_eval.inputs')}`,
                "field": "planning",

            },
            {
                "label": `${window.Locale.getLabel('imet-core::v2_common.steps_eval.outputs')}, ${window.Locale.getLabel('imet-core::v2_common.steps_eval.outcomes')}`,
                "field": "inputs"
            },
        ],
        columns: [
            {
                "label": window.Locale.getLabel('imet-core::v2_context.Create.fields.wdpa_id'),
                "field": "name"
            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.steps_eval.context'),
                "field": "context"
            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.steps_eval.planning'),
                "field": "planning",

            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.steps_eval.inputs'),
                "field": "inputs"
            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.steps_eval.process'),
                "field": "process"
            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.steps_eval.outputs'),
                "field": "outputs"
            },
            {
                "label": window.Locale.getLabel('imet-core::v2_common.steps_eval.outcomes'),
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
