<template>
  <div class="bar" :style="'width:' + width +'; min-height: '+ height+';'"></div>
</template>

<script>
import imet_bar_chart from "../../../templates/imet_bar_chart.vue";
export default {
  name: "bar",
  mixins: [
      imet_bar_chart,
      window.ImetCore.ScalingUp.Mixins.resize
  ]
}
</script>
