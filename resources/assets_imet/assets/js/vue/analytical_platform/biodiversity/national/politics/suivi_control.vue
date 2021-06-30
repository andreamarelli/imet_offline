<template>

    <div>

        <data_year :year=api_data.lastYear_encoded> </data_year>

        <div class="list-key-numbers">

            <div>
                <i class="fas fa-database"></i>
                <div class="content">
                    <span class="number">{{ Locale.getLabel('mapping.common.ecological_monitoring') }}</span>
                    <span>
                        {{ Locale.getLabel('mapping.common.database') }} <i class="fas text-base" :class="[api_data.base_donnees ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>
                    </span>
                    <span>
                        {{ Locale.getLabel('mapping.common.ecological_monitoring') }} <i class="fas text-base" :class="[api_data.suivi_ecologique ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>
                    </span>
                    <span>
                        {{ Locale.getLabel('mapping.common.regional_compliance') }} <i class="fas text-base" :class="[api_data.conformite ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>
                    </span>
                </div>
            </div>

            <div>
                <i class="fas fa-database"></i>
                <div class="content">
                    <span class="number">{{ Locale.getLabel('mapping.common.wildlife_trade_monitoring') }} </span>
                    <span>
                        {{ Locale.getLabel('mapping.common.database') }} <i class="fas text-base" :class="[api_data.base_donnees_faun ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>
                    </span>
                    <span>
                        {{ Locale.getLabel('mapping.common.legal_instruments') }} <i class="fas text-base" :class="[api_data.instrument_jurique ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>
                    </span>
                </div>
            </div>

            <div>
                <i class="fas fa-bell"></i>
                <div class="content">
                    <span class="number">{{ Locale.getLabel('mapping.common.alert_mechanism') }}</span>
                    <span>
                        {{ Locale.getLabel('mapping.common.alert_mechanism') }} <i class="fas text-base" :class="[api_data.alert_mecanism ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>
                    </span>
                </div>
            </div>

            <div>
                <i class="fas fa-shield-alt"></i>
                <div class="content">
                    <span class="number">{{ Locale.getLabel('mapping.common.lab_plan') }}</span>
                    <span>
                        {{ Locale.getLabel('mapping.common.database') }} <i class="fas text-base" :class="[api_data.plan_lab ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>
                    </span>
                    <span>
                        {{ Locale.getLabel('mapping.common.complies_subr_guidelines') }}  <i class="fas text-base" :class="[api_data.conformite_plan_lab ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>
                    </span>
                </div>
                <button @click="toggle_hidden('plan_lab')"
                        class="btn-nav rounded"
                >{{ Locale.getLabel('mapping.common.details') }}</button>
            </div>

        </div>

        <div class="list-key-numbers" style="margin-top: 20px;"
             v-if="is_hidden_component_visible('plan_lab')">
            <div class="list-head">
                Détails des infractions
            </div>
            <div>
                <div class="content">
                    <span class="two_columns" v-for="item in api_data.details_suivi_control">
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
        mixins: [base],
    }
</script>