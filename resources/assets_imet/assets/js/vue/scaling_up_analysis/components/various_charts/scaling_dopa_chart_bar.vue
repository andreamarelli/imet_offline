<template>
  <div class='bar card-chart'></div>
</template>

<style lang="scss" type="text/scss" scoped>
.bar {
  min-height: 200px;
  min-width: 200px;
}
</style>
<script>
import dopa_chart_bar from "../../../analytical_platform/components/dopa_chart_bar";
import resize from './../../mixins/resize.mixin';

export default {
  name: "scaling_dopa_chart_bar",
  mixins: [
    resize,
    dopa_chart_bar
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
