<template>

    <div>
        <div class="content">
            <data_year :year=api_data.last_year></data_year>

            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt">
                        D'ici <span class="highlighted">2020</span>, les <span class="highlighted">effectifs en personnel</span> affectés à la LAB ont augmenté de <span class="highlighted">100%</span> dans chaque pays d’Afrique Centrale.
                    </span>

                </div>

                <div>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>
                    <span class="number">{{ api_data.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        <country_list :api_data=api_data.eligible_country ></country_list>
                        <data_driven_layer_toggle
                            method="country_staff_numbers"
                            title="Pays dont les effectifs en personnel affectés à la LAB ont augmenté de 100%"
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
