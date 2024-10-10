<template>
    <div ref="chartContainer" class="scatter" :style="'width:' + width + '; height: ' + height + ';'"></div>
</template>
<script setup>
import { ref, onMounted, computed, inject } from "vue";
import * as echarts from "~/echarts";
import { useResize } from "../../composables/resize";

const emitter = inject('emitter');
const chartContainer = ref(null);

const props = defineProps({
    title: {
        type: String,
        default: ''
    },
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
    label_axis_y2_show: {
        type: Boolean,
        default: false
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
    },
    scatter_dimension_names: {
        type: Array,
        default: () => {
        }
    }
});

const { initResize } = useResize({
    emitter
});

onMounted(() => {
    draw_chart();
});

const bar_options = computed(() => {

    return {
        color: [
            ...get_colors()
        ],
        grid: {
            left: "10%",
            right: "0%",
            bottom: "3%",
            width: "80%",
            height: "85%"
        },
        title: {
            text: props.title,
            left: 'center',
            textStyle: {
                fontWeight: 'normal'
            }
        },
        legend: {
            ...get_legends(),
            padding: [35, 5, 10, 5]
        },
        tooltip: {
            trigger: 'item',
            axisPointer: {
                type: 'shadow'
            }
        },
        xAxis: {
            splitLine: { show: true },
            nameLocation: 'middle',
            name: props.label_axis_x,
            min: 0,
            max: 100,
            nameGap: -30
        },
        yAxis: [{
            splitLine: { show: true },
            scale: true,
            nameLocation: 'middle',
            name: props.label_axis_y,
            min: 0,
            max: 100,
            nameGap: -30
        }, {
            splitLine: { show: false },
            scale: true,
            min: 0,
            max: 100,
            show: true,
            name: props.label_axis_y2_show ? props.label_axis_y2 : '',
            nameLocation: 'middle',
            nameGap: -30
        }],
        ...series()
    }

});

function draw_chart() {
    if (Object.keys(props.values).length > 0) {
        if (chartContainer.value.clientWidth > 0 && chartContainer.value.clientHeight > 0) {
            let echartObject = echarts.init(chartContainer.value);
            echartObject.setOption(bar_options.value);

            echartObject.on('legendselectchanged', (params) => {
                emitter.emit(`scatter_data_${props.event_key}`, params);
            });
            initResize(echartObject);
        }
    }
}

function get_colors() {
    return props.values.map(i => i.itemStyle.borderColor);
}

function get_legends() {
    const legends = [];
    props.values.forEach(dato => {
        legends.push({ "name": dato.name });
    })
    return {
        data: legends
            .sort((a, b) => {
                return a.name > b.name ? 1 : -1
            })
    };
}

function series() {
    const items = [];
    props.values.forEach((record, idx) => {
        items.push({
            tooltip: {
                show: true,
                formatter(params) {
                    return `<b>${params.name}</b><br/><b>${props.label_axis_y}</b>: ${params.value[1]}<br/><b>${props.label_axis_x}</b>: ${params.value[0]}<br/><b>${props.label_axis_y2}</b>: ${params.value[2]}`;
                }
            },
            data: [record],
            type: 'scatter',
            name: record['name'],
            symbol: "rect",
            symbolSize: function (data) {
                if (data[2] <= 33) {
                    return 25;
                } else if (data[2] <= 50) {
                    return 35;
                } else if (data[2] <= 65) {
                    return 45;
                } else if (data[2] <= 90) {
                    return 60;
                } else if (data[2] <= 100) {
                    return 70;
                }
            },
            emphasis: {
                focus: 'self'
            },
            label: {
                show: true,
                formatter: function (param) {
                    return '';
                }
            }
        })
    })
    return { series: items };
}

</script>
