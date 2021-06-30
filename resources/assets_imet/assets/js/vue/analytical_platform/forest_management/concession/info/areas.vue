<template>

    <div>

        <div class="list-key-numbers grid_two_cols">
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.common.total') }}</span>
                    <span class="number"> {{ api_data.total_area_allocated | pretty_number }} ha</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.common.taxable') }} </span>
                    <span class="number"> {{ api_data.taxable_area | pretty_number }} ha</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.common.useful') }}</span>
                    <span class="number"> {{ api_data.useful_area | pretty_number }} ha</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.common.sig') }}</span>
                    <span class="number"> {{ api_data.sig_area | pretty_number }} ha</span>
                </div>
            </div>
        </div>

    </div>

</template>


<script>
    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base]
    }
</script>