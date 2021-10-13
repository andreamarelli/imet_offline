<template>
  <div class="treemap" :style="'width:' + width +'; height: '+ height+';'"></div>
</template>

<script>

export default {
  name: "treemap",
  mixins: [
      window.ImetCore.ScalingUp.Mixins.resize
  ],
  props: {
    width: {
      type: String,
      default: '100%'
    },
    height: {
      type: String,
      default: '500px'
    },
    values: {
      type: [Array, Object],
      default: () => {
      }
    },
    title: {
      type: String,
      default: ''
    }

  },
  computed: {
    bar_options() {
      return {

        title: {
          text: this.title,
          left: 'center'
        },


        series: [{
          type: 'treemap',
          data: this.data_fix()
        }]
      }
    }
  },
  watch: {
    values: {
      deep: true,
      handler() {
        this.draw_chart();
      }
    }
  },
  mounted() {
    //this.data_fix();
    this.draw_chart();
  },
  methods: {
    data_fix: function () {
      return this.values.map(item => {
        return {name: item.label, value: item.area, itemStyle: {color: item.color}};
      })
    },
    draw_chart() {
      if (Object.keys(this.values).length > 0) {
        this.chart = echarts.init(this.$el);
        this.chart.setOption(this.bar_options);
      }
    }
  }
}
</script>

<style scoped>

</style>
