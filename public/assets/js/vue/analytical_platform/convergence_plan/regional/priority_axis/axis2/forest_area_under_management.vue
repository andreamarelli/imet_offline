<template>
    <div>
        <div class="content">

            <data_year :year=api_data.last_year></data_year>
            <div class="convergence-plan-2col-indicator">

                <div>
                    <span class="txt">
                        Au moins <span class="highlighted">80 %</span> des superficies forestières sont  <span class="highlighted">sous aménagement </span>  d'ici <span class="highlighted"> 2020 </span>.
                    </span>
                </div>

                <div>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>
                    <span class="number">{{ api_data.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        <country_list :api_data=api_data.eligible_country ></country_list>
                        <data_driven_layer_toggle
                            method="country_forest_area_under_management"
                            title="Pays ayant au moins 80% des superficies forestières sous aménagement"
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
