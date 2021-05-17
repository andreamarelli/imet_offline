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
        start_class: {
            type: String,
            default: () => null
        },
        end_class: {
            type: String,
            default: () => null
        },
        data_key: {
            type: String,
            default: () => null
        },
        sankey_data: {
            type: Array,
            default: () => []
        },
    },

    methods: {

        has_data(){
            return this.options.series &&
                this.options.series[0] &&
                this.options.series[0].links &&
                this.options.series[0].links.length > 0;
        },

        apply_custom_options(){

            let data = this.parse_data();

            this.options.series = [
                {
                    type: 'sankey',
                    focusNodeAdjacency: 'allEdges',
                    data: data[0],
                    links: data[1],
                    top: '10%',
                    right: "30%",
                    nodeGap: 15,
                }
            ];

            this.options.tooltip = {
                trigger: 'item',
                triggerOn: 'mousemove'
            };

        },

        parse_data() {
            let _this = this;

            let classes = [];
            if(this.sankey_data!==null) {
                Object.values(_this.sankey_data).forEach(function (item) {
                    classes.push(_this.class_name(item, _this.start_class));
                    classes.push(_this.class_name(item, _this.end_class));
                });
            }
            let unique_classes = [...new Set(classes)];

            let data = [];
            Object.values(unique_classes).forEach(function (item) {
                data.push({
                    name: item
                });
            });
            if(typeof this.apply_custom_color === "function"){
                data = this.apply_custom_color(data);
            }

            let links = [];
            if(_this.sankey_data!==null) {
                Object.values(_this.sankey_data).forEach(function (item) {
                    let value = item[_this.data_key]!==null && _this.decimals!==null
                        ? parseFloat(item[_this.data_key]).toFixed(_this.decimals)
                        : item[_this.data_key];
                    links.push({
                        source: _this.class_name(item, _this.start_class),
                        target: _this.class_name(item, _this.end_class),
                        value: value
                    });
                });
            }

            return [data, links]
        },

        class_name(item, key){
            return item[key] + ' (' + key + ')' // Add the start/end in the class name to avoid data cycles
        }

    }
}
</script>
