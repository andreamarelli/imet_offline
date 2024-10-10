<template>
    <div ref="chartCont" class="imet_radar" :style="'width:100%; min-height: ' + height + 'px;'"></div>
</template>

<script setup>
import { ref, onMounted, inject, computed } from "vue";
import * as echarts from "~/echarts";
import { useRadar } from "./composables/radar";
import { useResize } from "../../composables/resize";
import { commonProps } from "./common/charts_props";

const default_colors = ['#5470c6', '#91cc75', '#fac858', '#ee6666', '#73c0de', '#3ba272', '#fc8452', '#9a60b4', '#ea7ccc'];
const chartCont = ref(null);

function setIndicators() {
    if (!props.indicators?.length) {
        return [];
    }
    return props.indicators.map((value, key) => {
        return { text: value.replace(' ', '\n'), max: 0, min: -100 };
    });
}
const emitter = inject('emitter');
const props = defineProps({
    ...commonProps,
});


const obj = useRadar({ ...props, chart: chartCont, setIndicatorsFunction: setIndicators });
const { singleData, multipleData, unselect_all_legends, calculateAverage } = obj;
const { initResize } = useResize({
    emitter
});

onMounted(() => {
    draw_chart();
});

const radar_options = computed(() => {
    let items = {};
    if (props.single) {
        items = singleData();
    } else {
        items = multipleData();
    }
    return {
        title: {
            text: props.title,
            left: 'center',
            textStyle: {
                fontWeight: 'normal'
            }
        },
        color: default_colors,
        tooltip: {
            trigger: 'axis'
        },
        ...items.legends,
        grid: {
            left: "10%",
            right: "0%",
            bottom: "3%",
            width: "80%",
            height: "82%",
            top: 30,
            "containLabel": true,
        },
        radar: {
            indicator: items.indicators,
            radius: '70%',
            startAngle: 60,
            axisLabel: {
                show: true,
                align: 'right'
            },
            name: {
                lineHeight: 18,
                textStyle: {
                    color: '#111',
                    padding: [0, 0]
                }
            },
        },
        series: [{
            name: '',
            type: 'radar',
            data: items.render_items
        }]
    };

});


function draw_chart() {

    if (Object.keys(props.values).length > 0) {
        if (chartCont.value.clientWidth > 0 && chartCont.value.clientHeight > 0) {
            let echartObject = null;
            echartObject = echarts.init(chartCont.value);
            echartObject.setOption(radar_options.value);
            initResize(echartObject);

            if (props.unselect_legends_on_load) {
                unselect_all_legends(radar_options.value?.legend?.data, echartObject);
            }
        }
    }
}
</script>
