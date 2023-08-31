<template>

    <div>
        <div class='doughnut'></div>
    </div>

</template>

<style lang="scss" scoped>
    .doughnut{
        min-height: 200px;
        min-width: 400px;
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
            }
        },

        watch: {
            api_data(value){
                if(value!==null){
                    this.draw_chart();
                }
            }
        },

        mounted() {
            if(this.api_data!==null){
                this.draw_chart();
            }
        },


        methods:{

            default_options(){
                return {
                    tooltip : {
                        trigger: 'item',
                        formatter: "{b}<br />{c} ({d}%)"
                    },
                    series : [
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
            },

            set_options(){
                let _this = this;
                let options = this.default_options();

                // Title
                if(this.title!==null){
                    options.title = {
                        textStyle: {
                            fontSize: 12,
                        },
                        text: this.title,
                        left: 'center'
                    };
                    options.series[0].center = ['50%', '55%'];
                }

                // Data & Colors
                options.series[0].data = [];
                options.color = [];
                this.indicators.forEach(function(item) {
                    options.color.push(item.color);
                    options.series[0].data.push({
                        value: _this.api_data[item.field]?.toFixed(1) ?? 0,
                        name: item.label
                    });
                });

                return options;
            },

            draw_chart(){
                let options = this.set_options();
                let canvas_container = this.$el.getElementsByClassName('doughnut')[0];
                echarts.init(canvas_container).setOption(options);
            }

        }

    }

</script>
