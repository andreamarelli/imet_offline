<template>
    <div>
        <div class="content">
            <data_year :year=api_data.last_year></data_year>
            
            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt">
                        D’ici <span class="highlighted">2020</span> ,au moins <span class="highlighted">80%</span> des AP et APT
                        disposent d’un <span class="highlighted">plan de gestion et d’un plan d’affaires actualisé</span>.
                    </span>  
                    <br><br>
                    <span class="txt">
                        <span class="highlighted">*</span> Pour cet indicateur on prend en considération uniquement des aires protégées ayant un plan de gestion, car les pays ne renseignent pas sur le plan d'affaire.
                    </span>
                </div>

                <div>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>                                        
                    <data_driven_layer_toggle
                        method="country_protected_areas_management_plan"
                        title="Pays dont les des AP et APT disposent d’un plan de gestion et d’un plan d’affaires actualisé"
                        :api_data=api_data.eligible_country
                        ></data_driven_layer_toggle>
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