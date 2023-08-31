<template>

    <div class="container">

        <div class="dopa_radar" :style="'width:' + radar_width +'px; height: ' + radar_height +'px;'"></div>

    </div>

</template>

<script>
    export default {

        name: "dopa_radar",

        props: {
            data: {
                type: [Number, String],
                default: null
            },
            radar_width: {
                type: Number,
                default: 400
            },
            radar_height: {
                type: Number,
                default: 350
            },
        },

        data: function () {
            return {
                labels: [],
                radar1: [],
                radar2: []
            }
        },

        mounted(){
            let _this = this;
            let elem = this.$el.querySelector("div.dopa_radar");
            if(this.data != null && this.data !== '[]'){
                this.chart = echarts.init(elem);
                this.chart.setOption(_this.radar_options());
            }
        },


        methods: {

            get_values(){
                let _this = this;
                JSON.parse(this.data).forEach(function(item){
                    _this.labels.push({name: item.title.replace(' ', '\n'), max: 100});
                    _this.radar1.push(item.country_avg);
                    _this.radar2.push(item.site_norm_value);
                });
            },

            radar_options(){
                let _this = this;
                this.get_values();
                return {
                    tooltip: {
                        trigger: 'axis'
                    },
                    legend: {
                        data: ['Country Average', 'Protected Area']
                    },
                    radar: {
                        indicator: this.labels,
                        radius: 100,
                        center: ['50%','55%'],
                        name: {
                            textStyle: {
                                color: '#111'
                            }
                        },
                    },

                    series: [
                        {
                            type: 'radar',
                            data: [
                                {
                                    value: this.radar2,
                                    itemStyle: {
                                        color: '#8fbf4b'
                                    },
                                    areaStyle:{
                                        color: '#8fbf4b',
                                        opacity: 0.4,
                                    },
                                    symbolSize: 6,
                                    name: 'Protected Area',
                                    tooltip: {
                                        trigger: 'item'
                                    },
                                },
                                {
                                    value: this.radar1,
                                    itemStyle: {
                                        color: '#679b95'
                                    },
                                    areaStyle:{
                                        color: '#679b95',
                                        opacity: 0.4,
                                    },
                                    symbolSize: 6,
                                    name: 'Country Average',
                                    tooltip: {
                                        trigger: 'item'
                                    },
                                },
                            ]
                        }
                    ]
                };
            }

        }

    }
</script>

<style scoped>

</style>