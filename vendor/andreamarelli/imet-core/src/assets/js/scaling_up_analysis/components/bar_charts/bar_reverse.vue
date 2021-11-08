<script>
import bar from './bar.vue';

export default {
  name: "bar_reverse",
  mixins: [bar],
  computed: {
    bar_options() {

      return {
        colors:['#5470C6'],
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
          type: 'value',
          realtimeSort: true,
          minInterval: 1,
          max: 0,
          min: -100,
        },
        yAxis: {
          position: 'right',
          type: 'category',
          data: this.field_name(),
          axisLabel: {
            rotate: this.rotate,
            interval: 0
          }
        },
          grid: {
              left: '3%',
              right: '4%',
              bottom: '3%',
              containLabel: true
          },
        series: [{
          data: this.values,
          label: {
            show: true,
            position: 'left'
          },
          type: 'bar'
        }],
        ...this.has_zoom()

      }
    }
  },
}
</script>
