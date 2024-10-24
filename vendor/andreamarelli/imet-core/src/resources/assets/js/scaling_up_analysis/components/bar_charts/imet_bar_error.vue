<template>
    <div ref="chart_container" class="imet_bar_error" :style="'width:100%; height: ' + height + ';'"></div>
</template>

<script setup>
import { ref, inject, onMounted, computed } from 'vue';
import * as echarts from "~/echarts";
import { useResize } from "../../composables/resize";
import { common } from "./common/commonProps";

const stores = inject('stores');
const emitter = inject('emitter');

const Locale = window.Locale;

const gather_colors = ref([]);
const chart_container = ref(null);


const props = defineProps({
    ...common,
    title: {
        type: String,
        default: ''
    },
    height: {
        type: String,
        default: '600px'
    },
    indicators: {
        type: Array,
        default: () => {
        }
    },
    indicators_color: {
        type: String,
        default: ''
    },
    show_legends: {
        type: Boolean,
        default: false
    },
    font_size: {
        type: Number,
        default: 13
    },
    options: {
        type: [Object, Array],
        default: () => {
        }
    },
    legends: {
        type: Array,
        default: () => {
        }
    },
    error_color: {
        type: String,
        default: '#C23531'
    },
    inverse_y: {
        type: Boolean,
        default: false
    },
    inverse_x: {
        type: Boolean,
        default: false
    }
});

const { save_data, handleResize } = useResize({
    emitter
})


const bar_options = computed(() => {
    {
        const { values, error_data, legends, indicators } = getValues();
        return {
            title: {
                text: props.title,
                left: 'center',
                textStyle: {
                    fontWeight: 'normal'
                }
            },
            legend: {
                show: props.show_legends,
                data: props.legends,
                padding: [30, 0, 0, 0]
            },
            ...grid(),
            xAxis: { ...props.axis_dimensions_x, inverse: props.inverse_x },
            yAxis: {
                data: indicators,
                inverse: props.inverse_y,
                axisLabel: {
                    fontSize: props.font_size,
                    interval: 0,
                    width: 0,
                    rotate: 0,
                    formatter: function (value) {
                        if (value.length < 35) {
                            return value.split(' ').join('\n')
                        }
                        const max_size = 16;
                        const reg = new RegExp(`.{${max_size}}`, 'g'); // /.{10}/g;
                        const pieces = value.match(reg);
                        const accumulated = (pieces.length * max_size);
                        const modulo = value.length % accumulated;
                        if (modulo) pieces.push(value.slice(accumulated));
                        return pieces.join('\n');
                    }
                }
            },
            series: bar_item(values, error_data)
        }
    }
});

onMounted(() => {
    if (Object.keys(props.values).length > 0) {
        draw_chart();
    }
});

function grid() {
    return {
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        }
    }
}

function render_item(params, api) {
    let xValue = api.value(0);
    let highPoint = api.coord([api.value(1), xValue]);
    let lowPoint = api.coord([api.value(2), xValue]);
    let halfWidth = api.size([0, 1])[1] * 0.2;
    let style = api.style({
        stroke: api.visual('color'),
        fill: null
    });
    return {
        type: 'group',
        toolbox: {
            show: true,
            feature: {
                saveAsImage: {
                    type: 'png',
                    show: true
                },
                dataView: { readOnly: false },
                magicType: { type: ['line', 'bar'] },
            }
        },
        children: [{
            type: 'line',
            transition: ['shape'],
            shape: {
                x1: highPoint[0], y1: highPoint[1] - halfWidth,
                x2: highPoint[0], y2: highPoint[1] + halfWidth
            },
            style: style
        }, {
            type: 'line',
            transition: ['shape'],
            shape: {
                x1: highPoint[0], y1: highPoint[1],
                x2: lowPoint[0], y2: lowPoint[1]
            },
            style: style
        }, {
            type: 'line',
            transition: ['shape'],
            shape: {
                x1: lowPoint[0], y1: lowPoint[1] - halfWidth,
                x2: lowPoint[0], y2: lowPoint[1] + halfWidth
            },
            style: style
        }]
    };
}

function setIndicators() {
    if (!props.indicators?.length) {
        return [];
    }
    if (props.values.Average) {
        return props.values.Average.map((value, key) => {
            return value['indicator'];
        });
    }
    return props.values.map((value, key) => {
        return value['indicator'];
    });
}

function colors(colors) {
    return colors;
}

function getValues(data = props.values) {
    let values = []
    let indicators = [];
    let legends = [];
    let error_data = [];

    indicators = setIndicators();

    Object.entries(data)
        .reverse()
        .forEach(([key, value]) => {
            const name = key.replace(' ', '\n');

            if (!props.indicators?.length) {
                indicators.push(name);
            }

            if (key === 'Average') {
                values = value.map((i, k) => {
                    gather_colors.value[i['itemStyle']['color']] = i['itemStyle']['color'];
                    return { 'value': i['value'], 'itemStyle': { 'color': i['itemStyle']['color'] } }
                });
                error_data = value.map((i, k) => [k, ...i['upper limit']]);
            }
        });

    return { values, error_data, legends, indicators };
}

function line_style(value, color = null) {
    return {
        lineStyle: {
            type: value,
            color
        }
    }
}

function bar_item(bar_data, error_data) {
    const color = bar_data[0].itemStyle.color;
    return [
        {
            type: 'bar',
            name: props.legends[0],
            data: bar_data.map(data => {
                return { value: data.value, itemStyle: { color: data.itemStyle.color }, label: { color: "#000000" } }
            }),
            itemStyle: {
                color
            },
            label: {
                show: true,
                position: 'inside',
                fontSize: 14
            }
        }, {
            type: 'custom',
            name: props.legends[1],
            itemStyle: {
                normal: {
                    borderWidth: 1.5,
                    color: props.error_color
                }
            },
            renderItem: render_item,
            encode: {
                x: [1, 2],
                y: 0
            },
            label: {
                show: false
            },
            data: error_data,
            z: 100
        }]
}

function draw_chart() {
    let echartObject = null;
    if (Object.keys(props.values).length > 0) {
        if (chart_container.value.clientWidth > 0 && chart_container.value.clientHeight > 0) {
            echartObject = echarts.init(chart_container.value);
            echartObject.setOption(bar_options.value);
            save_data();
            window.addEventListener('resize', () => handleResize(echartObject))
        }

    }
}
</script>
