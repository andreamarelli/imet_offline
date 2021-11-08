<template>

    <div>
        <div class='stacked_area card-chart'></div>
    </div>

</template>

<style lang="scss" scoped>
    .stacked_area{
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
            years: {
                type: [Array],
                default: () => null
            },
            show_percent: {
                type: Boolean,
                default: false
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
                            boundaryGap : false,
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
                if(this.title!==null){
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
                options.xAxis[0].data = this.years;

                // Series
                let data = _this.read_data();
                options.series = [];
                this.indicators.forEach(function(item, index) {
                    options.series.push({
                        name: item.label,
                        type:'line',
                        stack: 'stack_id',
                        areaStyle: {},
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
                    item.fields.forEach(function(field) {
                        data[index].push(_this.api_data[field]);
                    });
                });

                if(this.show_percent){
                    let sum = new Array(this.years.length).fill(0);
                    data.forEach(function(item) {
                        item.forEach(function(field_value, field_value_index){
                            sum[field_value_index] += field_value;
                        });
                    });
                    let data_percent = [];
                    data.forEach(function(item, item_index) {
                        data_percent[item_index] = [];
                        item.forEach(function(field_value, field_value_index){
                            // data_percent[item_index][field_value_index] = 'hello';
                            data_percent[item_index][field_value_index] = (100 / sum[field_value_index] * field_value).toFixed(1);
                        });
                    });
                    data = data_percent;
                }

                return data;
            },

            draw_chart(){
                let options = this.set_options();
                let canvas_container = this.$el.getElementsByClassName('stacked_area')[0];
                echarts.init(canvas_container).setOption(options);
            }

        }

    }

</script>
