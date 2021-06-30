<template>

  <div class='doughnut card-chart'></div>

</template>

<style lang="scss" type="text/scss" scoped>
.doughnut{
  min-height: 200px;
  min-width: 400px;
}
</style>
<script>
import dopa_chart_doughnut from "../analytical_platform/components/dopa_chart_doughnut";
import resize from './mixins/resize.mixin';

export default {
  name: "scaling_dopa_chart_doughnut",
  mixins: [
    resize,
    dopa_chart_doughnut

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
