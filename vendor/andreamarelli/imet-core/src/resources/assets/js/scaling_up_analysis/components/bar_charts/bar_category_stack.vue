<template>
    <div ref="chart" class="bar" :style="'width:' + width + '; min-height: ' + height_value + 'px;'"></div>
</template>

<script setup>
import { ref, onMounted, nextTick, watch, inject, computed } from "vue";
import * as echarts from "~/echarts";
import { common } from "./common/commonProps";
import { useResize } from "../../composables/resize";

const chart = ref(null);
const height_value = ref(700);
const data = ref([]);
const emitter = inject('emitter');

const props = defineProps({
    ...common,
    label_position: {
        type: String,
        default: 'top'
    },
    show_option_label: {
        type: Boolean,
        default: false
    },
    height: {
        type: String,
        default: '800px'
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
});

const { save_data, initResize } = useResize({
    emitter
})

watch(data, (newValue, oldValue) => {
    draw_chart();
}, { deep: true });

onMounted(() => {
    const legends = Object.values(props.legends).length;
    height_value.value = parseInt(props.height.replace('px', ''));
    if (legends > 7) {
        height_value.value += (legends - 7) * 4;
    }
    data.value = props.values;
    draw_chart();
});

const bar_options = computed(() => {
    props.grid.grid.containLabel = function () {
        return props.show_option_label;
    };
    const { raw_values, percent_values } = props;
    return {
        title: {
            text: props.title,
            left: 'center',
            textStyle: {
                fontWeight: 'normal'
            }
        },
        legend: {
            data: Object.values(Array.isArray(props.legends) ? props.legends[0] : props.legends),
            selectedMode: false,
            padding: [30, 0, 0, 0]
        },
        ...props.grid,
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
                            } else {
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
            data: props.x_axis_data,
            ...props.axis_dimensions_x,
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
            ...props.axis_dimensions_y,
            show: props.show_y_axis,
            realtimeSort: true,
            minInterval: 1
        },
        series: series()
    }
});

function series() {
    const bars = [];

    Object.entries(props.values).forEach((value, idx) => {
        bars.push({
            color: props.colors[idx],
            name: value[0],
            type: 'bar',
            stack: 'total',
            label: {
                show: false,
                position: props.label_position,
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

        if (props.show_option_label) {

            bar.label = {
                show: true,
                color: '#000'
            }
        } else if (index === bars.length - 1) {
            let has_value = false;
            bar.label = {
                show: true,
                position: props.label_position,
                color: '#000',
                formatter: (param) => {
                    let sum = 0;
                    has_value = true;
                    bars.forEach(item => {
                        if (item.data[param.dataIndex] !== '-') {
                            sum += parseFloat(item.data[param.dataIndex]);
                        }
                    });
                    if (sum === 0) {
                        return sum;
                    }
                    return sum.toFixed(1);
                }
            }
        }

        return bar;
    })


    return bars;
}

function get_colors() {
    if (props.colors === null) {
        return {};
    }
    return { colors: props.colors }
}

function field_name() {
    return props.fields.map(field => {
        return field.length > 10 ? field.split(' ').join('\n') : field;
    })
}

function draw_chart() {
    let echartObject = null;
    if (Object.keys(props.values).length > 0) {
        if (chart.value.clientWidth > 0 && chart.value.clientHeight > 0) {
            echartObject = echarts.init(chart.value);
            echartObject.setOption(bar_options.value);
            initResize(echartObject);

        }
    }
}

</script>
