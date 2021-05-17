<template>

    <div>
        <div class="content">
            <data_year :year=api_data.last_year></data_year>
            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt">
                        D’ici <span class="highlighted">2020</span>,chaque pays d’Afrique centrale s’est doté d’une <span class="highlighted">stratégie nationale de valorisation des connaissances, innovations et pratiques traditionnelles</span> conforme aux orientations sous-régionales et tenant compte du genre et des droits des peuples autochtones.
                    </span>
                </div>

                <div>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>
                    <span class="number">{{ api_data.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        <country_list :api_data=api_data.eligible_country ></country_list>
                        <data_driven_layer_toggle
                            method="country_strategy_promoting_traditional"
                            title="Pays doté d’une stratégie nationale de valorisation des connaissances, innovations et pratiques traditionnelles conforme aux orientations sous-régionales et tenant compte du genre et des droits des peuples autochtones"
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
