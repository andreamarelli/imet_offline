<template>

    <div class="aichi">

        <div>
            <div class="content">
                <gauge_aichi
                    :value= api_data.aichi_terrestrial
                    title="Terrestre 17%"
                ></gauge_aichi>
                <data_driven_layer_toggle
                    v-if="regional"
                    method="aichi_terrestrial"
                    title="Aïchi Terrestre"
                    :api_data=api_data.aichi_terrestrial_per_country
                ></data_driven_layer_toggle>
            </div>
        </div>

        <div>
            <div class="content">
                <gauge_aichi
                    :value= api_data.aichi_marine
                    title="Maritime 10%"
                    :marine=true
                ></gauge_aichi>
                <data_driven_layer_toggle
                    v-if="regional"
                    method="aichi_marine"
                    title="Aïchi Maritime"
                    :api_data=api_data.aichi_marine_per_country
                ></data_driven_layer_toggle>
            </div>
        </div>

    </div>

</template>


<style lang="scss" type="text/scss" scoped>

    .aichi{
        display: flex;
        justify-content: space-around;
        div{
            text-align: center;
        }
    }
</style>

<script>

    import base from '../../../components/_base.mixin';

    export default {

        mixins: [
            base,
        ]
    }

</script>