<template>

    <div>

        <chart style="margin: 10px 0;"
               :bars="[api_data]"
               :x_labels="['2000-2015','2015-2019']"
               unit="[%/an]"
               :y_start_at_zero=true
               :colors="['#F70019']"
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
