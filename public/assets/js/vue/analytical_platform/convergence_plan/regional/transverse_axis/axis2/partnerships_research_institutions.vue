<template>

    <div>
        <div class="content">

            <data_year :year=api_data.last_year></data_year>
            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt">                        
                        Au moins <span class="highlighted">03</span> partenariats entre les institutions de recherche et les utilisateurs sont établis en Afrique Centrale d’ici <span class="highlighted">2020</span>.
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