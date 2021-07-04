<template>
  <div class="bar" :style="'width:' + width +'; min-height: '+ height+';'"></div>
</template>

<script>
import resize from './../../mixins/resize.mixin';

export default {
  name: "bar_category_stack",
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
    legends: {
      type: [Array, Object],
      default: () => {
      }
    },
    x_axis_data: {
      type: [Array, Object],
      default: () => {
      }
    },
    colors: {
      type: [Array, Object],
      default: () => {
      }
    }

  },
  computed: {
    bar_options() {
      return {
        legend: {
          data: Object.values(this.legends),
          selectedMode: false
        },
        ...this.grid(),
        // title: {
        //   text: this.title,
        //   left: 'center'
        // },
        tooltip: {
          trigger: 'axis',
          axisPointer: {
            type: 'shadow'
          }
        },
        xAxis: {
          type: 'category',
          data: this.x_axis_data,
          axisLabel: {
            interval: 0,
            rotate: 45
          }
        },
        yAxis: {
          type: 'value',
          realtimeSort: true,
          minInterval: 1
        },
        series: this.series()
      }
    }
  },
  watch: {
    data: {
      deep: true,
      handler() {
        this.draw_chart();
      }
    }
  },
  data() {
    return {
      data: []
    }
  },
  mounted() {

    this.data = this.values;
    this.draw_chart();
  },
  methods: {
    grid: function () {
      return {
        grid: {
          y: 50,
          y2: 100,
          x: 50, //Left blank
          x2: 50
        } // Right blank
      }
    },
    series: function () {
      const bars = [];
      Object.entries(this.values).forEach((value, idx) => {
        bars.push({
          color: this.colors[idx],
          name: value[0],
          type: 'bar',
          stack: 'total',
          label: {
            show: false
          },
          emphasis: {
            focus: 'series'
          },
          data: value[1]
        })
      });

      bars.map((bar, index) => {
        if (index === bars.length - 1) {
          bar.label = {
            show: true,
            position: 'top',
            color: '#000',
            formatter: (param) => {
              let sum = 0;
              bars.forEach(item => {
                sum += item.data[param.dataIndex];
              });

              return sum.toFixed(2);
            }

          }
        }
        return bar;
      })

      return bars;
    },
    get_colors: function () {
      if (this.colors === null) {
        return {};
      }
      return {colors: this.colors}
    },
    field_name: function () {
      return this.fields.map(field => {
        return field.length > 10 ? field.split(' ').join('\n') : field;
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