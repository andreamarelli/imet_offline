<template>
    <div ref="chartContainer" class="treemap" :style="'width:' + width + '; height: ' + height + ';'"></div>
</template>

<script setup>
import { ref, onMounted, computed, inject } from "vue";
import * as echarts from "~/echarts";
import { useResize } from "../../composables/resize";

const emitter = inject('emitter');
const chartContainer = ref(null);

const props = defineProps({
    width: {
        type: String,
        default: '100%'
    },
    height: {
        type: String,
        default: '500px'
    },
    values: {
        type: [Array, Object],
        default: () => {
        }
    },
    title: {
        type: String,
        default: ''
    }

});

const bar_options = computed(() => {
    return {
        title: {
            text: props.title,
            left: 'center'
        },
        series: [{
            type: 'treemap',
            data: data_fix()
        }]
    }
});

const { initResize } = useResize({
    emitter
});

onMounted(() => {
    draw_chart();
});

function data_fix() {
    return props.values.map(item => {
        return { name: item.label, value: item.area, itemStyle: { color: item.color } };
    })
}

function draw_chart() {
    if (Object.keys(props.values).length > 0) {
        if (chartContainer.value.clientWidth > 0 && chartContainer.value.clientHeight > 0) {
            let echartObject = echarts.init(chartContainer.value);
            echartObject.setOption(bar_options.value);

            initResize(echartObject);
        }
    }
}
</script>
