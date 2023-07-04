<template>
    <div :style="'margin-top: -'+margin+'px'">
        <div v-for="(radar, index) in values" :id="'radar'+index">
            <container_actions :data="radar" :name="'radar'+index"
                               :event_image="'save_entire_block_as_image'"
            >
                <template slot-scope="data_elements">
                    <div class="row mt-5" :id="'upper_lower_'+index">
                        <scaling_radar class="col-sm" :width="width" :height="height"
                                       :single="single"
                                       :unselect_legends_on_load="unselect_legends_on_load"
                                       :show_legends="show_legends"
                                       :values='data_elements.props'
                                       :indicators='indicators'
                                       :event_key="'up_'+index"
                                       :refresh_average=false
                                       :key="'asd_'+index"></scaling_radar>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                           <datatable_interact_with_radar
                                :values_with_indicators_keys="true"
                                :refresh_average=false
                                :values="data_elements.props" :columns="columns"
                                                           :event_key="'up_'+index"></datatable_interact_with_radar>
                        </div>
                    </div>

                </template>
            </container_actions>
        </div>

    </div>
</template>


<script>

import datatable_interact_with_radar from "./../datatables/datatable_interact_with_radar.vue";

export default {
    components: {
        datatable_interact_with_radar
    },
    props: {
        width: {
            type: Number,
            default: 180
        },
        height: {
            type: Number,
            default: 180
        },
        indicators: {
            type: [Array, Object],
            default: () => {
            }
        },
        show_legends: {
            type: Boolean,
            default: false
        },
        single: {
            type: Boolean,
            default: true
        },
        showOnlyScaling: {
            type: Boolean,
            default: false
        },
        unselect_legends_on_load: {
            type: Boolean,
            default: false
        },
        radar: {
            type: [Array, Object],
            default: () => {

            }
        },
        refresh_average: {
            type: Boolean,
            default: false
        }
    },
    data: function () {
        return {
            values: [],
            data: {},
            margin: '0px',
            columns: [
                {
                    "label": window.Locale.getLabel('imet-core::common.protected_area.protected_area'),
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
        }
    },
    mounted() {
        const data = {
            'Average': this.radar['Average'],
            'lower limit': {...this.radar['lower limit']},
            'upper limit': {...this.radar['upper limit']}
        };

        const entries = Object.entries(this.radar);
        if (entries.length > 0) {
            this.margin = 22 * entries.length;
        }

        entries.forEach(([key, value]) => {
            if (!['Average', 'lower limit', 'upper limit'].includes(key)) {
                const item = {...data};
                item[key] = value;
                this.values.unshift(
                    item
                );
            }
        });
    }
}
</script>
