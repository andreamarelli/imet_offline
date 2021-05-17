<template>

    <div>
        <div class="content">
            <data_year :year=api_data.last_year></data_year>
            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt"> 
                        D’ici <span class="highlighted">2020</span>, au moins <span class="highlighted">10 médias audio-visuels</span> relaient des informations sur le processus COMIFAC et les réalisations du Plan de convergence en Afrique Centrale à travers les réseaux de communicateurs.
                    </span>
                </div>
                <div>
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