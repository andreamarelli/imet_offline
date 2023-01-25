<template>
    <div v-if="data.length">
        <datatable_scaling :columns="columns" :values="data" :key="data.length">
        </datatable_scaling>
    </div>
</template>

<script>

import datatable_scaling from "./datatable_scaling.vue";

export default {
    name: "datatable_interact_with_radar",
    components: {datatable_scaling},
    props: {
        values: {
            type: [Array, Object],
            default: () => {
            }
        },
        columns: {
            type: Array,
            default: () => {
            }
        },
        event_key: {
            type: String,
            default: ''
        },
        values_with_indicators_keys: {
            type: Boolean,
            default: false
        }
    },
    data: function () {
        return {
            data: [],
        }
    },
    mounted() {
        this.sortBy = this.default_order;
        this.$root.$on(`radar_data_${this.event_key}`, (params) => {
            params.selected['lower limit'] = false;
            params.selected['upper limit'] = false;
            this.parse_data(params.selected);
        });

        this.parse_data();
    },
    methods: {
        parse_data: function (selected = null) {

            const values = Object.entries({...this.values});
            const data = [];
            values.forEach((value, idx) => {
                if ((selected !== null && selected[value[0]]) || (selected === null && value[1]?.legend_selected)) {
                    const item = {};
                    this.columns.forEach((column, idx) => {
                        if (!["color", "name"].includes(column['field'])) {
                            if (this.values_with_indicators_keys) {
                                item[column['field']] = value[1][column['field']];
                            } else {
                                item[column['field']] = value[1][idx - 1];
                            }
                        }
                    })
                    data.push({
                        name: value[0],
                        ...item,
                        color: value[1]['color']
                    })
                }
            });
            this.data = data;
        }
    }

}
</script>
