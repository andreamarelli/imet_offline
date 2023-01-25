<template>
    <div class="imet_radar" :style="'width:100%; min-height: ' + height +'px;'"></div>
</template>
<script>

import imet_radar from "./radar_multiple_values.vue";

export default {
    name: "scaling_radar",
    props: {
        event_key: {
            type: String,
            default: ''
        }
    },
    mixins: [
        window.ImetCore.ScalingUp.Mixins.resize,
        imet_radar

    ],
    methods: {
        draw_chart: function () {
            if (Object.keys(this.values).length > 0) {
                this.chart = echarts.init(this.$el);
                this.chart.setOption(this.radar_options);

                this.chart.on('legendselectchanged', (params) => {
                    this.$root.$emit(`radar_data_${this.event_key}`, params);
                });
                if (this.unselect_legends_on_load) {
                    this.unselect_all_legends(this.radar_options?.legend?.data);
                }
            }
        },
    }
}
</script>
