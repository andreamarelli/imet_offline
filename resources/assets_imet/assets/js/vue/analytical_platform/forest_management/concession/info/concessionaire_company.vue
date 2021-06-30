<template>

    <div>

        <div class="list-key-numbers">
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.common.number_concessions') }}</span>
                    <span class="number"> {{ api_data.total_number_concessions | pretty_number }}</span>

                </div>
            </div>
        </div>


        <div class="list-key-numbers grid_two_cols" style="margin-top: 20px;">
            <div class="list-head" style="grid-column-end: 2 span;">
                Superficies
            </div>
            <div style="border-top: none;">
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.common.total') }}</span>
                    <span class="number"> {{ api_data.society_total_area_allocated | pretty_number }} ha</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.common.taxable') }} </span>
                    <span class="number"> {{ api_data.society_taxable_area | pretty_number }} ha</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.common.useful') }} </span>
                    <span class="number"> {{ api_data.society_useful_area | pretty_number }} ha</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.common.sig') }} </span>
                    <span class="number"> {{ api_data.society_sig_area | pretty_number }} ha</span>
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