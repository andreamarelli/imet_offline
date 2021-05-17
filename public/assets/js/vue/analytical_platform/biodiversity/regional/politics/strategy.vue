<template>

    <div>

        <div class="list-key-numbers">
            <div>
                <i class="icon-svg icon-contract" />
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('common.national_strategy') }}</span>
                    <span class="number">{{ api_data.national_strategy || '-' }} / 10</span>
                    <span class="txt"><country_list :api_data=api_data.national_strategy_country ></country_list></span>
                    <data_driven_layer_toggle
                            method="national_strategy_country"
                            :title="Locale.getLabel('common.national_strategy')"
                            :api_data=api_data.national_strategy_country
                    ></data_driven_layer_toggle>
                    <progress_bar :percentage=api_data.rate_strategy :small=true />
                </div>
            </div>

            <div>
                <i class="icon-svg icon-contract" />
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('common.action_plan') }}</span>
                    <span class="number">{{ api_data.action_plan || '-' }} / 10</span>
                    <span class="txt"><country_list :api_data=api_data.action_plan_country ></country_list></span>
                    <data_driven_layer_toggle
                            method="action_plan_country"
                            :title="Locale.getLabel('common.action_plan')"
                            :api_data=api_data.action_plan_country
                    ></data_driven_layer_toggle>
                    <progress_bar :percentage=api_data.rate_action_plan :small=true />
                </div>
            </div>

            <div>
                <i class="icon-svg icon-teamwork" />
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('common.strategy_apa') }}</span>
                    <span class="number">{{ api_data.strategy_apa || '-' }} / 10</span>
                    <span class="txt"><country_list :api_data=api_data.strategy_apa_country ></country_list></span>
                    <data_driven_layer_toggle
                            method="strategy_apa_country"
                            :title="Locale.getLabel('common.strategy_apa')"
                            :api_data=api_data.strategy_apa_country
                    ></data_driven_layer_toggle>
                </div>
            </div>

            <div>
                <i class="icon-svg icon-teamwork" />
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('common.strategy_framework') }}</span>
                    <span class="number">{{ api_data.strategy_framework || '-' }} / 10</span>
                    <span class="txt"><country_list :api_data=api_data.strategy_apa_framework_country ></country_list></span>
                    <data_driven_layer_toggle
                            method="strategy_apa_framework_country"
                            :title="Locale.getLabel('common.strategy_framework')"
                            :api_data=api_data.strategy_apa_framework_country
                    ></data_driven_layer_toggle>
                </div>
            </div>
        </div>

    </div>

</template>


<script>

    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base],
    }
</script>
