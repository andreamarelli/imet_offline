<template>

    <div>
        <div class="content">
            
            <data_year :year=api_data.last_year></data_year> 
            
            <div class="convergence-plan-2col-indicator">
                <div>
                    <span class="txt">
                        Au moins <span class="highlighted">60%</span> des AP et APT disposent des <span class="highlighted">unités/brigades de contrôle équipés et opérationnels</span> d’ici <span class="highlighted">2025</span>                        
                    </span>                
                </div>

                <div>
                    <gauge_cp  :percentage=api_data.percentage></gauge_cp>
                    <data_driven_layer_toggle
                        method="country_protected_areas_control_unit"
                        title="Pays ayant  des AP et APT qui disposent des unités/brigades de contrôle équipés et opérationnels"
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