<script>
import bar from "./bar.vue";

export default {
    name: "bar_reverse",
    mixins: [bar],
    props: {
        title_data: {
            type: String,
            default: 'threats'
        }
    },
    computed: {
        bar_options() {
            return {
                legend: {show: true,
                    padding: [30, 0, 0, 0]},
                colors: ['#5470C6'],
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
                    name: this.title_data,
                    type: 'bar'
                }],
// echarts.apache create a new instance of the chart with yaxis type category and legend
                // this.values.map(item => {
                //     return {
                //
                //         type: 'bar',
                //         name: item.name,
                //         itemStyle: {
                //             color: '#C23531'
                //         },
                //         label: {
                //             show: true,
                //             position: 'left'
                //         },
                //         data: [item.value]
                //     }
                // }),
                ...this.has_zoom()

            }
        }
    },
}
</script>
