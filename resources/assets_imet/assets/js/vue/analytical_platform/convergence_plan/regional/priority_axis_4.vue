<template>

    <div>

        <div class="list-key-numbers grid_one_col">

            <div>
                <div class="content">

                    <span>
                        D’ici <span class="highlighted">2020</span> ,tous les pays d’Afrique Centrale disposent des Plans/programmes d’actions nationales d’adaptation aux changements climatiques actualisés.
                    </span>
                    <data_year :year=api_data.adaptation_climate_change.last_year></data_year>
                    <gauge_cp  :percentage=api_data.adaptation_climate_change.percentage></gauge_cp>
                    <span class="number">{{ api_data.adaptation_climate_change.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.adaptation_climate_change.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_adaptation_climate_change"
                            title="Pays disposant des plans/programmes d’actions nationales d’adaptation aux changements climatiques actualisés"
                            :api_data=api_data.adaptation_climate_change.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            
            <div>
                <div class="content">
                    <span>
                        D’ici <span class="highlighted">2022</span> , tous les pays d’Afrique Centrale ont exécuté au moins la moitié des actions de leur PNA.
                    </span>
                    <data_year :year=api_data.actions_carried_by_pana.last_year></data_year>
                    <gauge_cp  :percentage=api_data.actions_carried_by_pana.percentage></gauge_cp>
                    <span class="number">{{ api_data.actions_carried_by_pana.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.actions_carried_by_pana.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_actions_carried_by_pana"
                            title="Pays ayant ont exécuté au moins la moitié des actions de leur PNA"
                            :api_data=api_data.actions_carried_by_pana.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            
            <div>
                <div class="content">
                    <span>
                      Les infrastructures et/ou les mécanismes d’alerte prévus dans les PNA pour faire face aux aléas de changements climatiques sont mis en place et/ou renforcés aux niveaux national et sous-régional d'ici <span class="highlighted">2025</span>.
                    </span>
                    <data_year :year=api_data.infrastructures_alert_mechanisms.last_year></data_year>
                    <gauge_cp  :percentage=api_data.infrastructures_alert_mechanisms.percentage></gauge_cp>
                    <span class="number">{{ api_data.infrastructures_alert_mechanisms.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.infrastructures_alert_mechanisms.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_infrastructures_alert_mechanisms"
                            title="Pays ayant mis en place des infrastructures et/ou des mécanismes d’alerte prévus dans les PNA pour faire face aux aléas de changements climatiques"
                            :api_data=api_data.infrastructures_alert_mechanisms.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            
            <div>
                <div class="content">
                    <span>
                      D'ici <span class="highlighted">2025</span> tous les pays d’Afrique Centrale disposent des stratégies REDD+, plans climat et/ou Plans nationaux d’atténuation aux changements climatiques (PNACC)
                    </span>
                    <data_year :year=api_data.strategy_redd.last_year></data_year>
                    <gauge_cp  :percentage=api_data.strategy_redd.percentage></gauge_cp>
                    <span class="number">{{ api_data.strategy_redd.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.strategy_redd.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_strategy_redd"
                            title="Pays disposant des  stratégies REDD+, plans climat et/ou Plans nationaux d’atténuation aux changements climatiques (PNACC)"
                            :api_data=api_data.strategy_redd.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            
            <div>
                <div class="content">
                    <span>
                      D'ici <span class="highlighted">2025</span> des instruments de mesure, suivi et reportage du carbone forestier sont mis en place dans au moins <span class="highlighted">05</span> pays.
                    </span>
                    <data_year :year=api_data.mrv_instruments.last_year></data_year>
                    <gauge_cp  :percentage=api_data.mrv_instruments.percentage></gauge_cp>
                    <span class="number">{{ api_data.mrv_instruments.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.mrv_instruments.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_mrv_instruments"
                            title="Pays ayant mis en place des instruments de mesure, suivi et reportage du carbone forestier"
                            :api_data=api_data.mrv_instruments.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            
            <div>
                <div class="content">
                    <span>
                      D'ici <span class="highlighted">2018</span> chaque pays d’Afrique Centrale publie les données sur les émissions de gaz à effet de serre issus de la déforestation et la dégradation.
                    </span>
                    <data_year :year=api_data.data_gas_emissions.last_year></data_year>
                    <gauge_cp  :percentage=api_data.data_gas_emissions.percentage></gauge_cp>
                    <span class="number">{{ api_data.data_gas_emissions.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.data_gas_emissions.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_data_gas_emissions"
                            title="Pays ayant mis en place des instruments de mesure, suivi et reportage du carbone forestier"
                            :api_data=api_data.data_gas_emissions.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

        </div>

    </div>

</template>


<script>

    import base from '../../components/_base.mixin';

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