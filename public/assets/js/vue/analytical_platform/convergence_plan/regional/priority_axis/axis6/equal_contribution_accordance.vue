<template>

    <div>
        <div class="content">


            <data_year :year=api_data.last_year></data_year>

            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt">
                        Tous les pays d’Afrique Centrale sont à jour vis-à-vis de leurs <span class="highlighted">contributions égalitaires</span> d’ici  <span class="highlighted">2017</span> conformément au Traité de la COMIFAC.
                    </span>
                </div>
                <div>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>
                    <span class="number">{{ api_data.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        <country_list :api_data=api_data.eligible_country ></country_list>
                        <data_driven_layer_toggle
                            method="country_equal_contribution_accordance"
                            title="Pays à jour vis-à-vis de leurs contributions égalitaires conformément au Traité de la COMIFAC"
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
