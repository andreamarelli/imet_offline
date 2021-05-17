<template>

    <div>
        <div class="content">

            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt">
                        D'ici <span class="highlighted">2020</span>, au moins <span class="highlighted">02 APT</span> ont été créées entre les pays d’Afrique Centrale et des Accords de coopération signées.
                    </span>
                    <br><br>
                    <span class="txt">
                        <span class="highlighted">1- Le Tri-national de la Sangha (TNS) - CMR, CAF, COG;</span><br>
                        <span class="highlighted">2- Le Tri-national Dja-Odzala-Minkebe (TRIDOM) - CMR, GAB, COG;</span><br>
                        <span class="highlighted">3- Le Binational Mayumba Conkouati (PTMC)- COG, GAB;</span><br>
                        <span class="highlighted">4- Le Binational Lac Télé – Lac Tumba (LTLT) - COG, COD;</span><br>
                        <span class="highlighted">4- Le Binational Sena Oura- Bouba Ndjida (BSB) - CMR, TCD;</span>
                    </span>
                </div>

                <div>
                    <gauge_cp  :percentage=100></gauge_cp>
                    <span class="number">{{ cross_country.length || '-' }} / 10</span>
                    <span class="txt">
                        <country_list :api_data=cross_country ></country_list>
                        <data_driven_layer_toggle
                            method="country_cross_border_protected_areas"
                            title="Pays entre lesquels des APT ont été créées  et des Accords de coopération signés"
                            :api_data=cross_country
                            ></data_driven_layer_toggle>
                    </span>

                </div>

            </div>


<!--            <chart_lines_and_pie
                title="APTs créées"
                :input_data=api_data.data
                unit="m3"
                ></chart_lines_and_pie>-->

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
                baseUrl: window.Laravel.baseUrl,
                cross_country : ["CMR", "GAB", "CAF", "COD", "COG","TCD"]
            }
        }
    }
</script>
