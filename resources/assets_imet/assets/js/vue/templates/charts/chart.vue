<template>

    <div v-if=show class="chart card-chart"></div>

</template>

<style lang="scss" type="text/scss" scoped>
    .chart{
        min-height: 300px;
        min-width: 600px;
    }
</style>

<script>

    import chart from './chart2.mixin';

    export default {

        mixins: [
            chart
        ],

        props: {
            custom_style: {
                type: String,
                default: () => null
            },
            unit_second_axes: {
                type: String,
                default: () => null
            },
        },

        methods: {

            has_data(){
                return this.has_data_series();
            },

            apply_custom_options() {
                let _this = this;

                this.set_cartesian_options();

                // x axis labels
                let xAxisLabels = this.x_axis_labels;
                this.options.xAxis[0].data = xAxisLabels;
                this.options.xAxis[0].boundaryGap = true;

                this.options.series = [];

                // bars
                this.bars.forEach(function (series, index) {
                    _this.options.series.push({
                        type: 'bar',
                        data: _this.parse_values(xAxisLabels, series),
                        stack: _this.stacked ? 'stack_this' : null,
                        name: _this.bars_labels[index] ? _this.bars_labels[index] : null
                    });
                });

                // lines
                this.lines.forEach(function (series, index) {
                    _this.options.series.push({
                        type: 'line',
                        smooth: true,
                        data: _this.parse_values(xAxisLabels, series),
                        stack: _this.stacked ? 'stack_this' : null,
                        name: _this.lines_labels[index] ? _this.lines_labels[index] : null
                    });
                });

                // Legend
                if(this.options.series.length>1){
                    this.add_legend();
                }

                // Second Y axis (for BAR + LINE)
                if(this.bar_and_line){
                    this.options.yAxis.push({
                        type: 'value',
                        scale: true,
                        splitLine: {
                            show: false
                        },
                        name: this.unit_second_axes || null
                    });
                    this.options.series[1].yAxisIndex = 1;
                }

                this.apply_custom_style(this.custom_style);
            },

            /**
             * Custom style
             * @param {string} style
             */
            apply_custom_style(style) {
                style = style || null;
                if(style==='national_area_chart'){
                    let line = this.options.series[0];
                    line = {...line, ...{
                        symbol: 'circle',
                        smooth: false,
                        symbolSize: 8,
                        lineStyle:{
                            color: '#00A74B',
                            width: 2,
                            type: 'dashed'
                        },
                        itemStyle:  {
                            borderWidth: 1,
                            borderColor: '#cdc43c',
                            color: '#00A74B',       // $baseGreen
                        }
                    }}
                    this.options.series[0] = line;
                }
            }

        }

    }
</script>
