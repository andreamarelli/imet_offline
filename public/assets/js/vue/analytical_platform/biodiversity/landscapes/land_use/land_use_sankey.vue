<template>

    <div v-if=show class="chart card-chart"></div>

</template>

<style lang="scss" scoped>
    .chart{
        min-height: 300px;
        min-width: 600px;
    }
    </style>
<script>

import sankey from '../../../../templates/charts/sankey';

export default {

    mixins: [
        sankey
    ],

    props:{
        decimals: {
            type: Number,
            default: 2
        }
    },

    methods:{

        apply_custom_color(data) {

            let palette = {
                'Cultivated area': '#BF571C',
                'Mosaic Nat/Cult area': '#BB9014',
                'Natural area': '#568336',
                'Water/Snow': '#ffffff',
            }

            let data_with_style = [];

            data.forEach(function(item){
                Object.entries(palette).forEach(([key, color]) => {
                    if(item.name.includes(key)){
                        data_with_style.push({
                            name: item.name,
                            itemStyle: {
                                color: color
                            }
                        });
                    }
                });
            });

            return data_with_style;
        },
    }

}
</script>
