<template>
    <div class='bar' style="min-height: 200px"></div>
</template>

<script>

export default {

    name: "scaling_dopa_chart_bar",

    mixins: [
        window.ImetCore.ScalingUp.Mixins.resize,
        window.ImetCore.Dopa.chart_bar
    ],

    methods: {
        set_names: function (options) {
            this.indicators.forEach(function (item, index) {
                options.series[index]['name'] = item.label;
            });

            return options;
        },
        draw_chart() {
            if (this.data !== null) {
                let options = this.set_options();
                options = this.set_names(options);

                this.chart = window.ImetCoreVendor.echarts.init(this.$el);
                this.chart.setOption(options);
            }
        }
    }
}
</script>
