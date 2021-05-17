<template>

    <div>
        <div class="content">                    
            <data_year :year=api_data.last_year></data_year>
            
            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt">
                        Au moins un <span class="highlighted">évènement international sur la criminalité faunique</span> est organisé d’ici <span class="highlighted">2017</span> et au moins <span class="highlighted">80%</span> des recommandations issues de l’évènement mises en œuvre d’ici <span class="highlighted">2025</span>.
                    </span>
                </div>

                <div>
                    <span v-if ="api_data.existence"><i  class="fas text-base fa-check-circle green_base"></i> Au moins évènement international sur la criminalité faunique a été organisé</span> 
                    <span v-else><i  class="fas text-base fa-times-circle red_base"></i> Aucun évènement international sur la criminalité faunique n'a été organisé</span><br>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>
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