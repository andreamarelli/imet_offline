<template>

    <div>

        <div class="content">

            <data_year :year=api_data.last_year></data_year>
            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt">
                        Au moins <span class="highlighted">03</span> comptes-rendus de rencontres de dialogue entre chercheurs et administrations en charge du secteur forêts-et environnement sont disponibles d’ici <span class="highlighted">2025</span> dans tous les pays d’Afrique Centrale.
                    </span>
                </div>

                <div>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>
                    <span class="number">{{ api_data.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        <country_list :api_data=api_data.eligible_country ></country_list>
                        <data_driven_layer_toggle
                            method="country_reports_dialogue_meetings"
                            title="Pays dont au moins comptes-rendus de rencontres de dialogue entre chercheurs et administrations en charge du secteur forêts-et environnement sont disponibles"
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
