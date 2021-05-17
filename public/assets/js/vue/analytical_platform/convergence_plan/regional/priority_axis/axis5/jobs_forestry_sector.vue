<template>

    <div>
        <div class="content">  
            
            <data_year :year=api_data.last_year></data_year>
            
            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt">
                        Le <span class="highlighted">nombre d’emplois</span> issus du secteur forêt-environnement a augmenté de <span class="highlighted">25%</span> d’ici à  <span class="highlighted">2025</span>.
                    </span>
                </div>

                <div>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>
                    <span class="txt">
                        <data_driven_layer_toggle
                            method="country_jobs_forestry_sector"
                            title="Pays ayant des emplois issus du secteur forêt-environnement"
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