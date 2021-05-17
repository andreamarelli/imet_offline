<template>

    <div>
        <data_year :year=api_data.financial_last_year></data_year>

        <div class="list-key-numbers">
            <div>
                <i class="icon-svg icon-protection" />
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.common.conservation_funding') }}</span>
                    <span class="number">{{ api_data.allocated_amount | pretty_number  }} US$</span>
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
                    <span class="number">{{ api_data.allocated_budget | pretty_number }} US$</span>
                </div>
            </div>
            <div>
                <i class="icon-svg icon-teamwork" />
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.common.partners') }}</span>
                    <span class="number">{{ api_data.amount_partners | pretty_number  }} US$</span>
                </div>
            </div>
            <div>
                <i class="icon-svg icon-money" />
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('common.trust_fund_country') }}</span>
                    <span class="number">{{ api_data.trust_fund | pretty_number  }} / 10</span>
                    <span class="txt"><country_list :api_data=api_data.country_trust_fund ></country_list></span>
                </div>
                <data_driven_layer_toggle
                    method="country_trust_fund"
                    :title="Locale.getLabel('common.trust_fund_country')"
                    :api_data=api_data.country_trust_fund
                ></data_driven_layer_toggle>
            </div>
            <div>
                <i class="icon-svg icon-leaf" />
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('common.green_fund_country') }}</span>
                    <span class="number">{{ api_data.green_fund | pretty_number }} / 10</span>
                    <span class="txt"><country_list :api_data=api_data.country_green_fund ></country_list></span>
                </div>
                <data_driven_layer_toggle
                    method="country_green_fund"
                    :title="Locale.getLabel('common.green_fund_country')"
                    :api_data=api_data.country_green_fund
                ></data_driven_layer_toggle>
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
