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
        title: {
            type: String,
            default: ''
        },
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
            default: '800px'
        },
        values: {
            type: [Array, Object],
            default: () => {
            }
        },
        raw_values: {
            type: [Array, Object],
            default: () => {
            }
        },
        percent_values: {
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
            const {raw_values, percent_values} = this;
            return {
                title: {
                    text: this.title,
                    left: 'center',
                    textStyle: {
                        fontWeight: 'normal'
                    }
                },
                legend: {
                    data: Object.values(Array.isArray(this.legends) ? this.legends[0] : this.legends),
                    selectedMode: false,
                    padding: [30, 0, 0, 0]
                },
                ...this.grid,
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    },
                    formatter: function (params) {
                        let tooltip_text = `${params[0].axisValueLabel} <br/>`;
                        if (raw_values) {
                            params.forEach(function (item) {
                                const value = item.value;
                                if (value == -99999999) {
                                    tooltip_text += `${item.marker} ${item.seriesName} : -</div> <br/>`;
                                } else {
                                    let percent = percent_values[item.seriesName][item.dataIndex];
                                    let raw_value = raw_values[item.dataIndex][item.componentIndex];
                                    if (percent == -99999999) {
                                        percent = '-';
                                        raw_value = '-';
                                    }
                                    else{
                                        percent = percent + '%';
                                    }
                                    tooltip_text += `${item.marker} ${item.seriesName} : ${raw_value} (${percent})</div> <br/>`;
                                }
                            });
                        } else {
                            params.forEach(function (item) {
                                const value = item.value;
                                if (value == -99999999) {
                                    tooltip_text += `${item.marker} ${item.seriesName} : - </div> <br/>`;
                                } else {
                                    tooltip_text += `${item.marker} ${item.seriesName} : ${value}</div> <br/>`;
                                }
                            });
                        }

                        return tooltip_text;
                    }
                },

                xAxis: {
                    type: 'category',
                    data: this.x_axis_data,
                    ...this.axis_dimensions_x,
                    axisLabel: {
                        interval: 0,
                        rotate: 0,
                        formatter: function (value, index) {
                            return value.replace(/ /g, "\n")
                        }
                    }
                },
                yAxis: {
                    type: 'value',
                    ...this.axis_dimensions_y,
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
            data: [],
            new_values: [],
            calculated_values: [],
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
                        show: false,
                        position: this.label_position,
                    },
                    emphasis: {
                        focus: 'series'
                    },
                    data: value[1].map((item, idx) => {
                        if (item == -99999999) {
                            return 0
                        }

                        return item;
                    })
                })
            });

            bars.map((bar, index) => {

                if (this.show_option_label) {

                    bar.label = {
                        show: true,
                        color: '#000'
                    }
                } else if (index === bars.length - 1) {
                    let has_value = false;
                    bar.label = {
                        show: true,
                        position: this.label_position,
                        color: '#000',
                        formatter: (param) => {
                            let sum = 0;
                            has_value = true;
                            bars.forEach(item => {
                                if (item.data[param.dataIndex] !== '-') {
                                    sum += parseFloat(item.data[param.dataIndex]);
                                }
                            });
                            if(sum === 0){
                                return sum;
                            }
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
