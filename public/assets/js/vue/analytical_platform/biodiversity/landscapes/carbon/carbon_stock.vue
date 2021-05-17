<template>

    <div style="margin-top: 10px;">
        <carbon_table
            :title="Locale.getLabel('mapping.common.carbon.agc')"
            :api_data="api_data['agc']"
            :layer=layers.landscapes_above_ground_carbon
        ></carbon_table>
        <carbon_table
            :title="Locale.getLabel('mapping.common.carbon.bgc')"
            :api_data="api_data['bgc']"
            :layer=layers.landscapes_below_ground_carbon
        ></carbon_table>
        <carbon_table
            :title="Locale.getLabel('mapping.common.carbon.soc')"
            :api_data="api_data['soc']"
            :layer=layers.landscapes_soil_organic_carbon
        ></carbon_table>
        <carbon_table
            :title="Locale.getLabel('mapping.common.carbon.ct')"
            :api_data="api_data['ct']"
            :layer=layers.landscapes_total_carbon
        ></carbon_table>
    </div>

</template>


<script>

import base from '../../../components/_base.mixin';

export default {

    mixins: [
        base
    ],

    props:{
        layers:{
            type: Object,
            default: () => {}
        }
    }



}
</script>
