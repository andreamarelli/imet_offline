<template>

    <div class="list-key-numbers grid_two_cols">
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('form/protected_area.protected_area_analytic.fields.hdi_freq') }}</span>
                <span class="number">{{ api_data.hdi_freq| pretty_number }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('form/protected_area.protected_area_analytic.fields.hdi_awhd') }}</span>
                <span class="number">{{ api_data.hdi_awhd| pretty_number }}</span>
            </div>
        </div>
    </div>

</template>

<style lang="scss" type="text/scss" scoped>

</style>

<script>

    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base]
    }
</script>
