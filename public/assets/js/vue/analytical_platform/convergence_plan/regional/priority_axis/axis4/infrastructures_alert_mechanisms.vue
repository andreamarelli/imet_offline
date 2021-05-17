<template>

    <div>
        <div class="content">
            <data_year :year=api_data.last_year></data_year>

            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt">
                        <span class="highlighted">Les infrastructures et/ou les mécanismes d’alerte</span> prévus dans les PNA pour faire face aux aléas de changements climatiques sont mis en place et/ou renforcés aux niveaux national et sous-régional d'ici <span class="highlighted">2025</span>.
                    </span>

                </div>

                <div>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>
                    <span class="number">{{ api_data.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        <country_list :api_data=api_data.eligible_country ></country_list>
                        <data_driven_layer_toggle
                            method="country_infrastructures_alert_mechanisms"
                            title="Pays ayant mis en place des infrastructures et/ou des mécanismes d’alerte prévus dans les PNA pour faire face aux aléas de changements climatiques"
                            :api_data=api_data.eligible_country
                            ></data_driven_layer_toggle>
                    </span>

                </div>

            </div>
        </div>
    </div>



</template>


<script>

    import base from '../../../../components/_base.mixin';

    export default {

        mixins: [
            base,
        ],

        data: function () {
            return {
                baseUrl: window.Laravel.baseUrl
            }
        }
    }
</script>
