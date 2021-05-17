<template>

    <div>

        <chart style="margin: 10px 0;"
            :title=title
            :bars="[api_data['1984'],api_data['2018']]"
            :bars_labels="['1984','2018']"
            :x_labels=Object.values(wdpas)
            unit="[Km2]"
            :y_start_at_zero=true
            :rotate_x_labels=true
            :colors=colors
            :decimals=2
        ></chart>

    </div>

</template>


<script>

    import base from '../../../components/_base.mixin';

    export default {

        mixins: [
            base
        ],

        props:{
            title:{
                type: String,
                default: ''
            },
            unit: {
                type: String,
                default: '[Km2]'
            },
            wdpas: {
                type: Array,
                default: () => []
            },
            colors: {
                type: Array,
                default: () => []
            }
        }

    }
</script>
