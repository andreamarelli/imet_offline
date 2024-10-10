<template>
    <div ref="chartCont" class="imet_radar" :style="'width:100%; min-height: ' + height + 'px;'"></div>
</template>

<script setup>
import { ref, onMounted, nextTick, inject, computed } from "vue";
import * as echarts from "~/echarts";
import { useRadar } from "./composables/radar";
import { useResize } from "../../composables/resize";
import { commonProps } from "./common/charts_props";

const chartCont = ref(null);
const emitter = inject('emitter');
const default_colors = ['#5470c6', '#91cc75', '#fac858', '#ee6666', '#73c0de', '#3ba272', '#fc8452', '#9a60b4', '#ea7ccc'];
const legend_selected = ref([])

const props = defineProps({
    ...commonProps,
});

const obj = useRadar({ ...props, chart: chartCont });
const { singleData, multipleData, unselect_all_legends, calculateAverage } = obj;
const { initResize } = useResize({
    emitter
});
const emit = defineEmits(['incoming-data']);

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
            startAngle: 90,
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
    if (Object.entries(props.values).length > 0) {

        if (obj.chart.value.clientWidth > 0 && obj.chart.value.clientHeight > 0) {

            const chartScaling = echarts.init(obj.chart.value);
            chartScaling.setOption(radar_options.value);
            chartScaling.on('legendselectchanged', (params) => {
                if (props.refresh_average) {
                    radar_options.value.series[0].data = calculateAverage(radar_options.value.series[0].data, params);

                    chartScaling.setOption(radar_options.value);
                }

                emitter.emit(`radar_data_${props.event_key}`, params);
            })
            initResize(chartScaling);


            if (props.unselect_legends_on_load) {
                unselect_all_legends(radar_options.value?.legend?.data, chartScaling);
            }
        }

    }
}

</script>
