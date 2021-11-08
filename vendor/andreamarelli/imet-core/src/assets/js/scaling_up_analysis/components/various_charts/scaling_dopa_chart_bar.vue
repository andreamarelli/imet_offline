<template>
    <div class='bar' style="min-height: 200px"></div>
</template>

<style lang="scss" scoped>

</style>

<script>

export default {

    name: "scaling_dopa_chart_bar",

    mixins: [
        window.ImetCore.ScalingUp.Mixins.resize,
        window.ModularForms.Dopa.chart_bar
    ],

    methods: {
        draw_chart() {
            if (this.data !== null) {
                let options = this.set_options();
                this.chart = echarts.init(this.$el);
                this.chart.setOption(options);
            }
        }
    }
}
</script>
