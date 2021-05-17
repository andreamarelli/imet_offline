<template>
    <div>
        <div class="content">

            <data_year :year=api_data.last_year></data_year>

            <div class="convergence-plan-2col-indicator">

                <div>
                    <span class="txt">
                        D'ici <span class="highlighted">2020</span>, chaque pays de l’Afrique Centrale dispose d’un  <span class="highlighted">état des lieux sur les marchés nationaux et régionaux du bois</span>.
                    </span>
                </div>

                <div>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>
                    <span class="number">{{ api_data.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        <country_list :api_data=api_data.eligible_country ></country_list>
                        <data_driven_layer_toggle
                            method="country_state_timber_markets"
                            title="Pays disposant d'un état des lieux sur les marchés nationaux et régionaux du bois"
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
