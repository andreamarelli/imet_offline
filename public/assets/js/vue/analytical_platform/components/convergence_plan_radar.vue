<template>

    <div class="cp_radar" :style="'width:' + width +'px; height: ' + height +'px;'"></div>

</template>


<script>

    export default {
        props: {
            width: {
                type: Number,
                default: 450
            },
            height: {
                type: Number,
                default: 350
            },
            values:{
                type: Object,
                default: () => {}
            },
            name:{
                type: String,
                default: "% par axe"
            }
        },

        computed: {
            radar_options(){

                let values = [];
                let labels = [];
                Object.entries(this.values)
                    .forEach(function([key, value]){
                        values.push(value);
                        labels.push({name: key.replace(' ', '\n'), max: 100});
                    });

                return {
                    tooltip: {
                        trigger: 'item',
                        position: ['40%', '40%']
                    },
                    radar: {
                        indicator: labels,
                        radius: 100,
                        center: ['50%','50%'],
                        name: {
                            textStyle: {
                                color: '#111',
                                padding: [3, 3]
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
                                        opacity: 0.3,
                                    },
                                    symbolSize: 4,
                                    name: this.name,
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
