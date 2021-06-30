<template>
  <div class="imet_bar_basics" :style="'width:' + width +'px; height: ' + height +'px;'"></div>
</template>

<script>
export default {
  props: {
    width: {
      type: Number,
      default: 380
    },
    height: {
      type: Number,
      default: 380
    },
    values: {
      type: Object,
      default: () => {
      }
    },
    fields: {
      type: Array,
      default: () => {
      }
    },
    sub_text: {
      type: String,
      default: ''
    },
    text: {
      type: String,
      default: ''
    }
  },
  data: function () {
    return {
      default_colors: ['#3ba272', '#5470c6', '#91cc75', '#fac858', '#ee6666', '#73c0de', '#fc8452', '#9a60b4', '#ea7ccc'],
      indicators: []
    }

  },
  computed: {
    bar_options() {
      const {render_items, legends} = this.createData();

      return {
        colors: this.default_colors,
        title: {
          text: this.text,
          subtext: this.sub_text
        },
        tooltip: {
          trigger: 'axis',
          axisPointer: {
            type: 'shadow'
          }
        },
        legend: {
          data: legends,
          top: 'bottom'
        },
        grid: {
          left: 50
        },
        xAxis: {
          type: 'value',
          name: ''

        },
        yAxis: {
          type: 'category',
          inverse: true,
          data: this.indicators,
          axisLabel: {
            formatter: function (value) {
              return value;
            }
          }
        },
        series: render_items
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
    createData: function (data = this.values) {
      const legends = [];
      const render_items = [];

      this.fields.forEach((value, key) => {
        this.indicators.push(value.label);
        value.children.forEach((child, k) => {
          Object.entries(data)
              .reverse()
              .forEach(([key, value]) => {
                if (child.field === key) {
                  legends.push(child.label);
                  const isItemExist = render_items.findIndex(val => val.name === child.label);
                  if (isItemExist > -1) {
                    render_items[isItemExist].data.push(value)
                  } else {
                    const bar_item = this.series_item();
                    bar_item.name = child.label;
                    bar_item.data.push(value);
                    bar_item.color = child.color;
                    render_items.push(bar_item);
                  }
                }
              });
        });
      });
      return {render_items, legends}
    },
    series_item: function () {
      return {
        type: 'bar',
        name: '',
        data: [],
        color: null
      }
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
