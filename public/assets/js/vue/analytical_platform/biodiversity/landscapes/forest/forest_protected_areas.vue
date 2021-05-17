<template>

    <div>

        <chart style="margin: 10px 0;"
               :bars="[api_data['2000-2015'],api_data['2015-2019']]"
               :bars_labels="['2000-2015','2015-2019']"
               :x_labels="Object.values(api_data['wdpa_names'])"
               unit="[%/an]"
               :y_start_at_zero=true
               :rotate_x_labels=true
               :colors="['#FFADB6','#F70019']"
               :decimals=2
        ></chart>

    </div>

</template>


<script>

import base from '../../../components/_base.mixin';

export default {

    mixins: [
        base
    ]

}
</script>
