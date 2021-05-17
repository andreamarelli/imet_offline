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

    import chart from './chart.mixin';

    export default {

        mixins: [
            chart
        ],

        data: function () {
            return {
                last_year_with_data: null
            }
        },

        mounted(){
            let _this = this;

            setTimeout(function () {
                _this.chart.on('updateAxisPointer', function (event) {
                    let xAxisInfo = event.axesInfo[0];
                    if (xAxisInfo) {
                        let x_axis_index = xAxisInfo.value;
                        let current_year = _this.years[x_axis_index];
                        _this.chart.setOption({
                            series: _this.set_pie_options(current_year)
                        });
                    }
                })
            });
        },

        methods: {

            has_data(){
               return this.options.dataset.source.length > 1;
            },

            apply_custom_options() {

                let _this = this;

                this.last_year_with_data = this.years[0];
                let labels = this.years.map(String);
                labels.unshift('xxx');

                // dataset
                this.options.dataset = {
                    source: [
                        labels
                    ]
                };
                if (this.input_data !== null) {
                    Object.entries(this.input_data).forEach(function ([key, values]) {
                        let source = [];
                        source.push(key);
                        _this.years.forEach(function (year) {
                            let value = values.hasOwnProperty(year) ? values[year] : null;
                            source.push(value);
                            _this.last_year_with_data =
                                value !== null && year > _this.last_year_with_data
                                    ? year
                                    : _this.last_year_with_data;
                        });
                        _this.options.dataset.source.push(source);
                    });
                }

                // series (lines)
                this.options.series = [];
                if (this.input_data !== null) {
                    let num_lines = Object.keys(this.input_data).length;
                    for (let i = 0; i < num_lines; i++) {
                        this.options.series.push({
                            type: 'line',
                            smooth: true,
                            seriesLayoutBy: 'row'
                        })
                    }
                }

                // series (pie)
                this.options.series.push(_this.set_pie_options(this.last_year_with_data));

                // Tooltip & axis
                this.options.xAxis = {type: 'category'};
                this.options.yAxis = {
                    gridIndex: 0,
                    name: this.unit || null
                };
                this.options.tooltip = {
                    trigger: 'axis',
                    showContent: false
                };

                // Grid
                this.options.grid = {
                    left: '3%',
                    right: '3%',
                    bottom: '2%',
                    top: '55%',
                    containLabel: true
                };
            },

            set_pie_options(year){
                return {
                    type: 'pie',
                    id: 'pie',
                    radius: '25%',
                    center: ['50%', '30%'],
                    label: {
                        formatter: '{b}: {@' + year + '} ({d}%)'
                    },
                    encode: {
                        itemName: 'xxx',
                        value: year.toString(),
                        tooltip: year.toString()
                    }
                }

            }
        }

    }
</script>