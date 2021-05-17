<template>

    <div>
        <div class="content">


            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt">
                        Au moins <span class="highlighted">10</span> <span class="highlighted">programmes de sensibilisation sur les questions environnementales</span> sont élaborés et exécutés au moins à <span class="highlighted">30%</span> aux niveaux national et sous-régional d’ici <span class="highlighted">2025</span>
                    </span>   <br>

                    <span><span class="highlighted">Sous régional</span></span>
                    <i class="fas text-base" :class="[api_data.achieved ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>
                </div>

                <div>
                    <span><span class="highlighted">National</span></span>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>
                    <span class="number">{{ api_data.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        <country_list :api_data=api_data.eligible_country ></country_list>
                        <data_driven_layer_toggle
                            method="country_percentage_completion_national"
                            title="Pays dont les programmes de sensibilisation sur les questions environnementales sont élaborés et exécutés au moins à 30%"
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
