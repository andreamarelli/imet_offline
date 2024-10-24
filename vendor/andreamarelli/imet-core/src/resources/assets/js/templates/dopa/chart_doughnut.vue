<template>
    <div>
        <div ref="chartContainer" class='doughnut'></div>
    </div>
</template>

<style lang="scss" scoped>
.doughnut {
    min-height: 200px;
    min-width: 400px;
}
</style>

<script setup>
import { ref, watch, onMounted } from 'vue';
import * as echarts from "~/echarts";

const props = defineProps({
    title: {
        type: String,
        default: null
    },
    indicators: {
        type: Array,
        default: () => []
    },
    api_data: {
        type: Object,
        default: () => null
    }
});

const chartContainer = ref(null);

const defaultOptions = {
    tooltip: {
        trigger: 'item',
        formatter: "{b}<br />{c} ({d}%)"
    },
    series: [
        {
            type: 'pie',
            radius: ['60%', '80%'],
            center: '50%',
            data: [],
            itemStyle: {
                emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }
    ]
};

const setOptions = () => {
    let options = { ...defaultOptions };

    if (props.title !== null) {
        options.title = {
            textStyle: { fontSize: 12 },
            text: props.title,
            left: 'center'
        };
        options.series[0].center = ['50%', '55%'];
    }

    options.series[0].data = [];
    options.color = [];
    props.indicators.forEach((item) => {
        options.color.push(item.color);
        options.series[0].data.push({
            value: props.api_data[item.field]?.toFixed(1) ?? 0,
            name: item.label
        });
    });

    return options;
};

const drawChart = () => {
    const options = setOptions();
    const canvas_container = chartContainer.value;
    echarts.init(canvas_container).setOption(options);
};

watch(() => props.api_data, (value) => {
    if (value !== null) {
        drawChart();
    }
});

onMounted(() => {
    if (props.api_data !== null) {
        drawChart();
    }
});
</script>
