<template>

    <div>
        <div id="land_degradation_chart" class="card-chart"></div>
    </div>

</template>


<style lang="scss" type="text/scss" scoped>
  
</style>

<script>

    export default {
            
        props: {
            serie_landegradation: {
                type: Array,
                default: () => null
            },
            legend_landegradation: {
                type: Array,
                default: () => null
            }
        },

        mounted() {
            if((this.serie_landegradation!==null)&&(this.legend_landegradation !==null)){
                this.land_degradation_chart(this.serie_landegradation, this.legend_landegradation);
            }else{
                
            }
        },

        methods: {
            land_degradation_chart(serie_landegradation, legend_landegradation){
                echarts
                        .init(document.getElementById('land_degradation_chart'))
                        .setOption({
                                toolbox: {
                                    feature: {
                                        saveAsImage: {
                                            title:'save',
                                            type:'png',
                                            name:'Dégradation',
                                            show:true
                                        }
                                    }
                                },
                                title : {
//                                        text: 'Land degradation',
                                        x:'center'
                                    },
                                    tooltip : {
                                        formatter: "{a} <br/>{b} : {c} ({d}%)"
                                    },
                                    legend: {
                                        orient: 'vertical',
                                        left: 'left',
                                        data: legend_landegradation
                                    },
                                    series : [
                                        {
                                            name: '',
                                            type: 'pie',
                                            radius : '55%',
                                            center: ['50%', '60%'],
                                            data:serie_landegradation ,
                                            itemStyle: {
                                                emphasis: {
                                                    shadowBlur: 10,
                                                    shadowOffsetX: 0,
                                                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                                                }
                                            }
                                        }
                                    ]
                            });
                            
        }

        }
    }
</script>