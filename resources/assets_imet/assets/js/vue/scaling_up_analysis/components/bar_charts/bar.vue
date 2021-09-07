<template>
  <div class="bar" :style="'width:' + width +'; min-height: '+ height+';'"></div>
</template>

<script>
import resize from './../../mixins/resize.mixin';

export default {
  name: "bar",
  mixins: [resize],
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
          }
        },
        yAxis: {
          type: 'value',
          realtimeSort: true,
          minInterval: 1
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
        console.log(Object.keys(this.values).length)
        this.chart = echarts.init(this.$el);
        this.chart.setOption(this.bar_options);
      }
    }
  }
}
</script>