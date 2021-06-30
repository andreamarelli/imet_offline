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

    import chart from './../../../../templates/charts/chart.mixin';

    export default {

        mixins: [
            chart
        ],

        methods: {

            has_data(){
                return this.options.series &&
                    this.options.series[0] &&
                    this.options.series[0].links &&
                    this.options.series[0].links.length > 0;
            },

            apply_custom_options() {

                let data = this.parse_data();
                this.options.series = [
                    {
                        type: 'sankey',
                        focusNodeAdjacency: 'allEdges',
                        // orient: 'vertical',
                        // label: {
                        //     position: 'top'
                        // },
                        data: data[0],
                        links: data[1],
                    }
                ];

                this.options.tooltip = {
                    trigger: 'item',
                    triggerOn: 'mousemove'
                };

            },

            parse_data(){

                let _this = this;

                let classes = [];
                if(this.input_data!==null) {
                    Object.values(this.input_data).forEach(function (item) {
                        if (classes.indexOf(_this.class_name(item, '1995')) === -1) {
                            classes.push(_this.class_name(item, '1995'));
                        }
                        if (classes.indexOf(_this.class_name(item, '2015')) === -1) {
                            classes.push(_this.class_name(item, '2015'));
                        }
                    });
                }
                let data = [];
                Object.values(classes).forEach(function (item) {
                    data.push({
                        name: item
                    });
                });


                let links = [];
                if(this.input_data!==null) {
                    Object.values(this.input_data).forEach(function (item) {
                        links.push({
                            source: _this.class_name(item, '1995'),
                            target: _this.class_name(item, '2015'),
                            value: parseFloat(item['area'])
                        });
                    });
                }

                return [data, links]
            },

            class_name(item, key){
                return item[key] + ' (' + key + ')'
            }
        }

    }
</script>