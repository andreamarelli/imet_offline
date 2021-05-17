<template>

    <div class="card-chart gaugeChart" v-if="value"></div>

</template>


<style lang="scss" type="text/scss" scoped>
    .card-chart.gaugeChart{
        min-height: 170px !important;
        height: 170px !important;
        min-width: 230px !important;
        width: 230px !important;
    }
</style>

<script>
    export default {
        props: {
            value: {
                type: [Number, String],
                default: () => null
            },
            title: {
                type: String,
                default: null
            },
            marine: {
                type: Boolean,
                default: false
            },
        },

        data: function(){
            return {
                options: {}
            }
        },

        mounted() {
            if(this.value) {
                this.base_options();
                if(this.marine){
                    this.aichi_marine();
                } else {
                    this.aichi_terrestrial();
                }
                echarts
                    .init(this.$el)
                    .setOption(this.options);
            }
        },

        methods: {

            aichi_terrestrial(){
                this.options.series[0].max = 20;
                this.options.series[0].splitNumber = 20;
                this.options.series[0].axisLine.lineStyle.color = [
                    [0.50, '#ce2e29'],      // $darkRed
                    [0.85, '#f0ad4e'],      // $contextual-warning
                    [1, '#007233']          // $darkGreen
                ];
                this.options.series[0].axisLabel.formatter = function (v) {
                    switch (v + '') {
                        case '0' : return '0';
                        case '10' : return '10';
                        case '17' : return '17';
                    }
                }
            },

            aichi_marine(){
                this.options.series[0].max = 15;
                this.options.series[0].splitNumber = 15;
                this.options.series[0].axisLine.lineStyle.color = [
                    [0.33333, '#ce2e29'],   // $darkRed
                    [0.66666, '#f0ad4e'],   // $contextual-warning
                    [1, '#007233']          // $darkGreen
                ];
                this.options.series[0].axisLabel.formatter = function (v) {
                    switch (v + '') {
                        case '0' : return '0';
                        case '5' : return '5';
                        case '10' : return '10';
                    }
                }
            },

            base_options(){
                this.options = {
                    tooltip: {
                        formatter: "{a} <br/>{c} {b}"
                    },
                    toolbox: {
                        show: true,
                        feature: {
                            saveAsImage: {
                                type: 'png',
                                name: '',
                                show: true,
                                title: null
                            }
                        }
                    },
                    series: [
                        {
                            type: 'gauge',
                            center: ['50%', '65%'],
                            radius: '115%',
                            min: 0,
                            startAngle: 180,
                            endAngle: 0,
                            splitLine:{
                                show: false,
                                length: 15
                            },
                            splitNumber: 100,
                            axisLine: {
                                lineStyle: {
                                    width: 10
                                }
                            },
                            axisTick: {
                                show: false
                            },
                            axisLabel: {
                                color: '#252525',   // $darkestGray
                            },
                            itemStyle:{
                                color: '#6f6f6f'    // $darkGray
                            },
                            pointer: {
                                width: 4
                            },
                            title: {
                                color: '#252525',   // $darkestGray
                                offsetCenter: [0, '-35%'],
                                fontSize: 14
                            },
                            detail: {
                                color: '#007233', // $darkGreen
                                formatter: '{value} %',
                                offsetCenter: [0, '30%'],
                            },
                            data: [
                                {
                                    value: this.value.toFixed(1),
                                    name: this.title
                                }
                            ]
                        }
                    ]
                }
            }

        }
    }
</script>