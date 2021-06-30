<template>

    <div>
        <data_year :year=api_data.financial_last_year> </data_year>
        <div class="list-key-numbers">
            <div>
                <div class="content">
                    <span class="txt"> {{ Locale.getLabel('form/protected_area.national_level_analytic.fields.conservation_funding') }}:</span>
                    <span class="number"> {{ api_data.allocated_amount | pretty_number }} USD </span>
                </div>
                <data_driven_layer_toggle
                        v-if="regional"
                        method="percent_conservation_funding"
                        title="% du budget national"
                        :api_data=api_data.conservation_budget_per_country
                ></data_driven_layer_toggle>
            </div>
            <div>
                <div class="content">
                    <span class="txt"> {{ Locale.getLabel('form/protected_area.national_level_analytic.fields.budget') }}</span>
                    <span class="number">{{ api_data.allocated_budget | pretty_number }} USD</span>
                </div>
                <gauge :percentage=api_data.allocated_budget_percent />
            </div>
            <div>
                <div class="content">
                    <span class="txt"> {{ Locale.getLabel('form/protected_area.national_level_analytic.fields.partner') }}:</span>
                    <span class="number"> {{ api_data.total_budget_partner | pretty_number }} USD</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt"> {{ Locale.getLabel('form/protected_area.national_level_analytic.fields.trust_fund') }}:</span>
                    <i class="fas text-base" :class="[api_data.trust_fund ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt"> {{ Locale.getLabel('form/protected_area.national_level_analytic.fields.green_fund') }}:</span>
                    <i class="fas text-base" :class="[api_data.green_fund ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>
                </div>
            </div>
        </div>


        <div class="list-key-numbers" style="margin-top: 20px;">
            <div class="list-head">
                Efforts du pays
            </div>
            <div>
                <div class="content">
                    <span class="two_columns" v-for="item in api_data.list_effort">
                        <span>{{ item.type }}</span>
                        <span>{{ item.nombre| pretty_number }}</span>
                    </span>
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