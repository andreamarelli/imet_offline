<template>
    <div class="bar" :style="'width:' + width +'; min-height: '+ height_value +'px;'"></div>
</template>

<script>

export default {
    name: "bar_category_stack",
    mixins: [
        window.ImetCore.ScalingUp.Mixins.resize
    ],
    props: {
        label_position: {
            type: String,
            default: 'top'
        },
        show_option_label: {
            type: Boolean,
            default: false
        },
        width: {
            type: String,
            default: '100%'
        },
        height: {
            type: String,
            default: '700px'
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
        },
        show_y_axis: {
            type: Boolean,
            default: true
        },
        grid: {
            type: Object,
            default: () => {
                return {
                    "grid": {
                        "left": '3%',
                        "right": '4%',
                        "bottom": '3%',
                        "containLabel": true
                    }
                }
            }
        }
    },
    computed: {

        bar_options() {
            this.grid.grid.containLabel = function () {
                return this.show_option_label;
            };
            return {
                legend: {
                    data: Object.values(this.legends),
                    selectedMode: false
                },
                ...this.grid,
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
                    show: this.show_y_axis,
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
            height_value: 700,
            data: []
        }
    },
    mounted() {
        const legends = Object.values(this.legends).length;
        this.height_value = parseInt(this.height.replace('px', ''));
        if (legends > 7) {
            this.height_value += (legends - 7) * 4;
        }
        this.data = this.values;
        this.draw_chart();
    },
    methods: {

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

                if (this.show_option_label) {
                    bar.label = {
                        show: true,
                        color: '#000'
                    }
                } else if (index === bars.length - 1) {
                    bar.label = {
                        show: true,
                        position: this.label_position,
                        color: '#000',
                        formatter: (param) => {
                            let sum = 0;
                            bars.forEach(item => {
                                sum += parseFloat(item.data[param.dataIndex]);
                            });

                            return sum.toFixed(1);
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
