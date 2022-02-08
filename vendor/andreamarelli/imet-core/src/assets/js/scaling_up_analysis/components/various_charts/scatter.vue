<template>
    <div class="scatter" :style="'width:' + width +'; height: '+ height+';'"></div>
</template>

<script>

export default {
    name: "scatter",
    mixins: [
        window.ImetCore.ScalingUp.Mixins.resize
    ],
    props: {
        width: {
            type: String,
            default: '100%'
        },
        label_axis_x: {
            type: String,
            default: ''
        },
        label_axis_y: {
            type: String,
            default: ''
        },
        label_axis_y2: {
            type: String,
            default: ''
        },
        height: {
            type: String,
            default: '800px'
        },
        values: {
            type: [Array, Object],
            default: () => {
            }
        },
        event_key: {
            type: String,
            default: ''
        }
    },
    computed: {
        bar_options() {
            return {
                color: [
                    ...this.get_colors()
                ],
                grid: {
                    left: "10%",
                    right: "0%",
                    bottom: "3%",
                    width: "80%",
                    height: "85%"
                },
                title: {
                    text: this.title,
                    left: 'center'
                },
                legend: {
                    ...this.get_legends()
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    }
                },
                xAxis: {
                    splitLine: {show: true},
                    nameLocation: 'middle',
                    name: this.label_axis_x,
                    min: 0,
                    max: 100,
                    nameGap: -30
                },
                yAxis: [{
                    splitLine: {show: true},
                    scale: true,
                    nameLocation: 'middle',
                    name: this.label_axis_y,
                    min: 0,
                    max: 100,
                    nameGap: -30
                }, {
                    splitLine: {show: false},
                    scale: true,
                    min: 0,
                    max: 100,
                    show: true,
                    name: this.label_axis_y2,
                    nameLocation: 'middle',
                    nameGap: -30
                }],
                ...this.series()
            }
        }
    },
    data() {
        return {
            data: []
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
    mounted() {
        this.data = this.values;//.map(el=>Object.values(el));
    },
    methods: {
        draw_chart() {
            if (this.data.length > 0) {
                this.chart = echarts.init(this.$el);
                this.chart.setOption(this.bar_options);

                this.chart.on('legendselectchanged', (params) => {
                    this.$root.$emit(`scatter_data_${this.event_key}`, params);
                });
            }
        },
        get_colors(){
            return this.data.map(i => i.itemStyle.borderColor);
        },
        get_legends() {
            const legends = [];
            this.data.forEach(dato => {
                legends.push({"name": dato.name});
            })

            return {
                data: legends
                    .sort((a, b) => {
                    return a.name > b.name ? 1 : -1
                })
            };
        },
        series: function () {
            const items = [];
            this.data.forEach(record => {
                items.push({
                    tooltip: {
                        show: false
                    },
                    data: [record],
                    type: 'scatter',
                    name: record['name'],
                    symbol: "rect",
                    symbolSize: function (data) {
                        return Math.sqrt(data[2]) * 5;
                    },
                    emphasis: {
                        focus: 'self'
                    },
                    label: {
                        formatter: function (param) {
                            return param.data['name'];
                        }
                    }
                })
            })
            return {series: items};
        }
    }
}
</script>
