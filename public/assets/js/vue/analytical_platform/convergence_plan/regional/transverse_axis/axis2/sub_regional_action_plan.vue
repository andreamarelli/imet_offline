<template>

    <div>
        <div class="content">
            <data_year :year=api_data.last_year></data_year>
            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt">
                        D’ici <span class="highlighted">2025</span>, au moins <span class="highlighted">50%</span> des résultats du plan d’action sous régional est atteint.
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