<template>

    <div>
        <div class="content">
            <data_year :year=api_data.last_year></data_year>
            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt">
                        D’ici <span class="highlighted">2025</span>, au moins  <span class="highlighted">10%</span> des AP sont <span class="highlighted">labellisées</span> en Afrique Centrale.
                    </span>
                </div>

                <div>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>                                        
                    <data_driven_layer_toggle
                        method="country_labeled_protected_area"
                        title="Pays ayant des AP labellisées"
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