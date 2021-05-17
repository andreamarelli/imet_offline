<template>

    <div>
        <div class="content">
            <span> 
                D’ici <span class="highlighted">2020</span>, au moins <span class="highlighted">1000</span> techniciens, <span class="highlighted">200</span> licenciés, <span class="highlighted">100</span> Master, <span class="highlighted">50</span> PhD sont formés en sciences environnementales dans les pays de l’espace COMIFAC
            </span>
            <data_year :year=api_data.last_year></data_year>
            
            <div class="trained">
            <div class="trained__content"><span> <span class="highlighted">Techniciens</span>  </span>  <gauge_cp  :percentage=api_data.percent_technicians></gauge_cp></div>
            <div class="trained__content"><span> <span class="highlighted">Licenciés</span> </span> <gauge_cp  :percentage=api_data.percent_graduates></gauge_cp></div>
            <div class="trained__content"><span> <span class="highlighted">Masters</span> </span>   <gauge_cp  :percentage=api_data.percent_masters></gauge_cp></div>
            <div class="trained__content"><span> <span class="highlighted">PhD</span> </span>   <gauge_cp  :percentage=api_data.percent_phd></gauge_cp></div>
            </div>
<!--            <span class="number">{{ api_data.technicians || '-'  }} </span> Techniciens soit <gauge_cp  :percentage=api_data.percent_technicians></gauge_cp>
            <span class="number">{{ api_data.graduates || '-'  }}  </span> Licenciés soit <gauge_cp  :percentage=api_data.percent_graduates></gauge_cp>
            <span class="number">{{ api_data.masters || '-'  }} </span> Masters soit <gauge_cp  :percentage=api_data.percent_masters></gauge_cp>
            <span class="number">{{ api_data.phd || '-'  }} </span> PhD soit <gauge_cp  :percentage=api_data.percent_phd></gauge_cp>-->

            <span class="txt">
                <data_driven_layer_toggle
                    method="country_number_trained"
                    title="Pays ayant des formés en sciences environnementales"
                    :api_data=api_data.eligible_country
                    ></data_driven_layer_toggle>
            </span>
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

<style lang="scss" type="text/scss" scoped>
    .trained {
            display : flex;
            justify-content: space-around;
            &__content {
                display : flex;
                flex-direction : column;
                 justify-content: space-between;
                
            }
    }
</style>