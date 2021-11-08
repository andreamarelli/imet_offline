<template>
  <div class="bar" :style="'width:' + width +'; min-height: '+ height+';'"></div>
</template>

<script>

export default {
  name: "bar",
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
    fields: {
      type: Array,
      default: () => {
      }
    },
    rotate: {
      type: Number,
      default: 0
    },
    title: {
      type: String,
      default: ''
    },
    colors: {
      type: Array,
      default: null
    },
    zoom: {
      type: Boolean,
      default: false
    },
    axis_dimensions_x: {
      type: Object,
      default: () => {
      }
    },
    axis_dimensions_y: {
      type: Object,
      default: () => {
      }
    }

  },
  computed: {
    bar_options() {

      return {
        ...this.get_colors(),
        title: {
          text: this.title,
          left: 'center'
        },
        tooltip: {
          trigger: 'axis',
          axisPointer: {
            type: 'shadow'
          }
        },
        xAxis: {
          type: 'category',
          data: this.field_name(),
          axisLabel: {
            rotate: this.rotate,
            interval: 0
          },
          ...this.axis_dimensions_x
        },
        yAxis: {
          type: 'value',
          realtimeSort: true,
          minInterval: 1,
          ...this.axis_dimensions_y
        },
          grid: {
              left: '3%',
              right: '4%',
              bottom: '3%',
              containLabel: true
          },
        series: [{
          data: this.values,
          type: 'bar'
        }],
        ...this.has_zoom()

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
    this.draw_chart();
  },
  methods: {
    has_zoom: function () {
      if (this.zoom) {
        return {
          dataZoom: [
            {
              show: true,
              start: 0,
              end: 100
            }
          ]
        }
      }
      return {};
    },
    get_colors: function () {
      if (this.colors === null) {
        return {};
      }
      return {colors: this.colors}
    },
    field_name: function () {
      return this.fields.map(field => {
        return field;//.length > 10 ? field.split(' ').join('\n') : field;
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
