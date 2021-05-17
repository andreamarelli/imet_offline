<template>

    <div class="list-key-numbers">
        <div>
            <i class="icon-svg icon-money" />
            <div class="content">
                <span class="number">{{ api_data.amount | pretty_number }} US$</span>
            </div>
            <gauge v-if="api_data.percentage!=null" :percentage=api_data.percentage />
            <button @click="toggle_component('tax_details')"
                    class="btn-nav rounded"
            >{{ Locale.getLabel('mapping.common.details') }}</button>
        </div>
    </div>

</template>

<script>

    import base from '../../../components/_base.mixin';
    import visible_components from "../../../../../mapping_mapbox/mixins/visible_components";

    export default {
        mixins: [
            base,
            visible_components
        ],
    }
</script>
