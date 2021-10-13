<template>

    <div class="imet_radar" :style="'width:' + width +'px; height: ' + height +'px;'"></div>

</template>

<style lang="scss" scoped>
    .imet_radar{}
</style>


<script>

    export default {
        props: {
            width: {
                type: Number,
                default: 180
            },
            height: {
                type: Number,
                default: 180
            },
            values:{
                type: Object,
                default: () => {}
            }
        },

        computed: {
            radar_options(){

                let values = [];
                let labels = [];
                Object.entries(this.values)
                    .reverse()
                    .forEach(function([key, value]){
                        values.push(value);
                        labels.push({text: key.replace(' ', '\n'), max: 100});
                    });

                return {
                    tooltip: {
                        trigger: 'axis'
                    },
                    radar: {
                        indicator: labels,
                        radius: '65%',
                        startAngle: 150,
                        name: {
                            textStyle: {
                                color: '#111',
                                padding: [0, 0]
                            }
                        },
                    },

                    series: [
                        {
                            type: 'radar',
                            data: [
                                {
                                    value: values,
                                    itemStyle: {
                                        color: '#7CB5EC'
                                    },
                                    areaStyle:{
                                        color: '#7CB5EC',
                                        opacity: 0.4,
                                    },
                                    symbolSize: 6,
                                    name: 'imet_radar',
                                    label: {
                                        normal: {
                                            fontWeight: 'bold',
                                            color: '#222',
                                            show: true,
                                            formatter:function(params) {
                                                return params.value;
                                            }
                                        }
                                    }
                                }
                            ]
                        }
                    ]
                };
            }
        },

        watch:{
            values: {
                deep: true,
                handler(){
                    this.draw_chart();
                }
            }
        },

        mounted(){
            this.draw_chart();
        },

        methods:{
            draw_chart(){
                if(Object.keys(this.values).length>1) {
                    this.chart = echarts.init(this.$el);
                    this.chart.setOption(this.radar_options);
                }
            }
        }
    }

</script>
