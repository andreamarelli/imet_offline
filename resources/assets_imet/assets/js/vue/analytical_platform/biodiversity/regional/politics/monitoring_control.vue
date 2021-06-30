<template>

    <div>

        <div class="list-key-numbers">

            <div>
                <i class="icon-svg icon-database" />
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('common.db_ecological_country') }}</span>
                    <span class="number">{{ api_data.existence_db_ecological || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.existence_ecological_country | country_names }}
                            <data_driven_layer_toggle
                                    method="existence_ecological_country"
                                    :title="Locale.getLabel('common.db_ecological_country')"
                                    :api_data=api_data.existence_ecological_country
                            ></data_driven_layer_toggle>
                        </span>
                </div>
            </div>

            <div>
                <i class="icon-svg icon-database" />
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('common.db_updated_db_ecological') }}</span>
                    <span class="number">{{ api_data.updated_db_ecological || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.updated_ecological_country | country_names }}
                            <data_driven_layer_toggle
                                    method="updated_ecological_country"
                                    :title="Locale.getLabel('common.db_updated_db_ecological')"
                                    :api_data=api_data.updated_ecological_country
                            ></data_driven_layer_toggle>
                        </span>
                </div>
            </div>

            <div>
                <i class="icon-svg icon-database" />
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('common.conformity_ecological') }}</span>
                    <span class="number">{{ api_data.conformity_ecological || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.conformity_ecological_country | country_names }}
                            <data_driven_layer_toggle
                                    method="conformity_ecological_country"
                                    :title="Locale.getLabel('common.conformity_ecological')"
                                    :api_data=api_data.conformity_ecological_country
                            ></data_driven_layer_toggle>
                        </span>
                </div>
            </div>

            <div>
                <i class="icon-svg icon-database" />
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('common.wildlife_existence_db') }}</span>
                    <span class="number">{{ api_data.wildlife_existence_db || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.wildlife_existence_db_country | country_names }}
                            <data_driven_layer_toggle
                                    method="wildlife_existence_db_country"
                                    :title="Locale.getLabel('common.wildlife_existence_db')"
                                    :api_data=api_data.wildlife_existence_db_country
                            ></data_driven_layer_toggle>
                        </span>
                </div>
            </div>

            <div>
                <i class="icon-svg icon-project" />
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('common.legal_instruments') }}</span>
                    <span class="number">{{ api_data.legal_instruments_number || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.legal_instruments_country | country_names }}
                            <data_driven_layer_toggle
                                    method="legal_instruments_country"
                                    :title="Locale.getLabel('common.legal_instruments')"
                                    :api_data=api_data.legal_instruments_country
                            ></data_driven_layer_toggle>
                        </span>
                </div>
            </div>

            <div>
                <i class="icon-svg icon-hunting" />
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('common.alert_mechanism') }}</span>
                    <span class="number">{{ api_data.alert_mechanism || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.country_alert_mechanism | country_names }}
                            <data_driven_layer_toggle
                                    method="country_alert_mechanism"
                                    :title="Locale.getLabel('common.alert_mechanism')"
                                    :api_data=api_data.country_alert_mechanism
                            ></data_driven_layer_toggle>
                        </span>
                </div>
            </div>

            <div>
                <i class="icon-svg icon-hunting" />
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('common.plan_lab') }}</span>
                    <span class="number">{{ api_data.plan_lab || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.country_plan_lab | country_names }}
                            <data_driven_layer_toggle
                                    method="country_plan_lab"
                                    :title="Locale.getLabel('common.plan_lab')"
                                    :api_data=api_data.country_plan_lab
                            ></data_driven_layer_toggle>
                        </span>
                </div>
            </div>

            <div>
                <i class="icon-svg icon-hunting" />
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('common.conformity_plan_lab') }}</span>
                    <span class="number">{{ api_data.conformity_plan_lab || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.country_conformity_plan_lab | country_names }}
                            <data_driven_layer_toggle
                                    method="country_conformity_plan_lab"
                                    :title="Locale.getLabel('common.conformity_plan_lab')"
                                    :api_data=api_data.country_conformity_plan_lab
                            ></data_driven_layer_toggle>
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
