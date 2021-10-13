<template>

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
                    echarts.init(canvas_container).setOption(options);
                }
            }

        }

    }
</script>
