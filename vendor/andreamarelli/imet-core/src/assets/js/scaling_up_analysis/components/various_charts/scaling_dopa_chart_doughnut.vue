<template>

    <div class='doughnut card-chart mt-5' style="min-height: 300px"></div>

</template>

<style lang="scss" scoped>
.doughnut {
    min-height: 300px;
    min-width: 400px;
}
</style>

<script>

export default {

    name: "scaling_dopa_chart_doughnut",

    mixins: [
        window.ImetCore.ScalingUp.Mixins.resize,
        window.ModularForms.Dopa.chart_doughnut
    ],

    methods: {
        draw_chart() {
            let options = this.set_options();
            this.chart = echarts.init(this.$el);
            this.chart.setOption(options);
        }
    }
}
</script>
