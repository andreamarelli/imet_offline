<template>

    <div>
        <div id="land_fragmentation_chart" class="card-chart"></div>
    </div>

</template>


<style lang="scss" type="text/scss" scoped>

</style>

<script>

    export default {
            
        props: {
            legend_landfragmentation: {
                type: Array,
                default: () => null
            },
            list_margin: {
                type: Array,
                default: () => null
            },
            list_edge: {
                type: Array,
                default: () => null
            },
            list_perforation: {
                type: Array,
                default: () => null
            },
            list_islet: {
                type: Array,
                default: () => null
            },
            list_core: {
                type: Array,
                default: () => null
            },
        },

        mounted() {
            if((this.legend_landfragmentation!=null)&&(this.list_margin !=null)){
                this.land_fragmentation_chart(this.legend_landfragmentation, this.list_margin, this.list_edge, this.list_perforation, this.list_islet, this.list_core);
            }else{
                
            }
        },

        methods: {
            land_fragmentation_chart(legend_landfragmentation, list_margin,list_edge,list_perforation,list_islet,list_core){
                echarts
                        .init(document.getElementById('land_fragmentation_chart'))
                        .setOption({
                                toolbox: {
                                    feature: {
                                        saveAsImage: {
                                            title:'save',
                                            type:'png',
                                            name:'Fragmentation',
                                            show:true
                                        }
                                    }
                                },
                                title: {
                                    text: ''
                                },
                                tooltip : {
                                    trigger: 'axis',
                                    axisPointer: {
                                        type: 'cross',
                                        label: {
                                            backgroundColor: '#6a7985'
                                        }
                                    }
                                },
                                legend: {
                                    data: legend_landfragmentation
                                },
                                grid: {
                                    left: '3%',
                                    right: '4%',
                                    bottom: '3%',
                                    containLabel: true
                                },
                                xAxis : [
                                    {
                                        type : 'category',
                                        boundaryGap : true,
                                        data : ['1995','2000','2005','2015']
                                    }
                                ],
                                yAxis : [
                                    {
                                        type : 'value'
                                    }
                                ],
                                series : [
                                    {
                                        name:legend_landfragmentation[0],
                                        type:'line',
                                        stack: 'yes',
                                        areaStyle: {},
                                        data:list_margin
                                    },
                                    {
                                        name:legend_landfragmentation[1],
                                        type:'line',
                                        stack: 'yes',
                                        areaStyle: {},
                                        data:list_edge
                                    },
                                    {
                                        name:legend_landfragmentation[2],
                                        type:'line',
                                        stack: 'yes',
                                        areaStyle: {},
                                        data:list_perforation
                                    },
                                    {
                                        name:legend_landfragmentation[3],
                                        type:'line',
                                        stack: 'yes',
                                        label: {
                                            normal: {
                                                show: false,
                                                position: 'top'
                                            }
                                        },
                                        areaStyle: {},
                                        data:list_islet
                                    },
                                    {
                                        name:legend_landfragmentation[4],
                                        type:'line',
                                        stack: 'yes',
                                        label: {
                                            normal: {
                                                show: true,
                                                position: 'top'
                                            }
                                        },
                                        areaStyle: {},
                                        data:list_core
                                    }
                                ]
                            });
                            
        }

        }
    }
</script>