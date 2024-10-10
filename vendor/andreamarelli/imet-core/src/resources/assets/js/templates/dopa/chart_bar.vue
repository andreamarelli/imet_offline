<template>
    <div>
        <div ref="barRef" class='bar'></div>
    </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue';
import * as echarts from 'echarts';

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
    },
});

const barRef = ref(null);

const defaultOptions = {
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            type: 'line',
            lineStyle: {
                opacity: 0.5
            }
        }
    },
    grid: {
        left: '3%',
        right: '3%',
        bottom: '2%',
        top: '2%',
        containLabel: true
    },
    xAxis: [
        {
            type: 'category',
            data: []
        }
    ],
    yAxis: [
        {
            type: 'value'
        }
    ]
};

const setOptions = () => {
    let options = { ...defaultOptions };

    if (props.title != null) {
        options.title = {
            text: props.title,
            left: 'center'
        };
        options.grid.top = '12%';
    }

    options.color = [];
    options.legend = {
        data: [],
        top: 'bottom'
    };
    options.grid.bottom = '12%';
    props.indicators.forEach(item => {
        options.color.push(item.color);
        options.legend.data.push(item.label);
    });

    options.xAxis[0].data = [];

    let data = readData();
    options.series = props.indicators.map((_, index) => ({
        type: 'bar',
        name: _.label,
        data: data[index]
    }));

    return options;
};

const readData = () => {
    return props.indicators.map(item => [props.api_data[item.field]]);
};

const drawChart = () => {
    if (props.api_data !== null) {
        let options = setOptions();
        let canvas_container = barRef.value;
        ({options});
        echarts.init(canvas_container).setOption(options);
    }
};

watch(() => props.api_data, drawChart);

onMounted(() => {
    if (props.api_data !== null) {
        drawChart();
    }
});
</script>

<style lang="scss" scoped>
.bar {
    min-height: 200px;
    min-width: 200px;
}
</style>
<!-- <template>

    <div>
        <div class='bar'></div>
    </div>

</template>

<style lang="scss" scoped>
    .bar{
        min-height: 200px;
        min-width: 200px;
    }
</style>

<script>
    export default {

        props: {
            title: {
                type: String,
                default: null
            },
            indicators: {
                type: [Array],
                default: () => null
            },
            api_data: {
                type: [Object],
                default: () => null
            },
        },

        mounted(){
            if(this.api_data !== null){
                this.draw_chart();
            }
        },

        watch: {
            api_data(){
                this.draw_chart();
            }
        },

        methods: {

            default_options(){
                return {
                    tooltip : {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'line',
                            lineStyle: {
                                opacity: 0.5
                            }
                        }
                    },
                    /*toolbox: {
                        feature: {
                            saveAsImage: {}
                        }
                    },*/
                    grid: {
                        left: '3%',
                        right: '3%',
                        bottom: '2%',
                        top: '2%',
                        containLabel: true
                    },
                    xAxis : [
                        {
                            type : 'category',
                            data : []
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value'
                        }
                    ]
                };
            },

            set_options(){
                let _this = this;
                let options = this.default_options();

                // Title
                if(this.title!=null){
                    options.title = {
                        text: this.title,
                        left: 'center'
                    };
                    options.grid.top = '12%';
                }

                // Legend & Colors
                options.color = [];
                options.legend = {
                    data:  [],
                    top: 'bottom'
                };
                options.grid.bottom = '12%';
                this.indicators.forEach(function(item) {
                    options.color.push(item.color);
                    options.legend.data.push(item.label);
                });

                // xAxis
                options.xAxis[0].data = [];

               // Series
                let data = _this.read_data();
                options.series = [];
                this.indicators.forEach(function(item, index) {
                    options.series.push({
                        type: 'bar',
                        data: data[index]
                    });
                });

                return options;
            },

            read_data(){
                let _this = this;
                let data = [];
                this.indicators.forEach(function(item, index) {
                    data[index] = [];
                    data[index].push(_this.api_data[item.field]);
                });
                return data;
            },

            draw_chart(){
                if(this.data!==null){
                    let options = this.set_options();
                    let canvas_container = this.$el.getElementsByClassName('bar')[0];
                    window.ImetCoreVendor.echarts.init(canvas_container).setOption(options);
                }
            }

        }

    }
</script> -->
