<template>

    <div>
        <div class="content">

            <data_year :year=api_data.last_year></data_year>
            
            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt">                          
                        D’ici <span class="highlighted">2018</span>, au moins <span class="highlighted">50%</span> des institutions de formation révisent et mettent en œuvre des curricula et programmes de formations harmonisés adaptés aux besoins actuels et futurs.
                    </span>
                </div>

                <div>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>
                    <span class="txt">
                        <data_driven_layer_toggle
                            method="country_training_institutions"
                            title="Pays ayant des institutions de formation"
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