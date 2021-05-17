<template>
            <div>
                <div class="content">                    
                    <span>
                        Dans au moins <span class="highlighted">05</span> pays d'Afrique Centrale, <span class="highlighted">les règles et normes de GDF</span> établies sont appliquées par toutes les parties prenantes 
                        d'ici <span class="highlighted"> 2025 </span>.
                    </span>
                    <chart_lines_and_pie
                    title="Nombre de procès-verbaux et contentieux"
                    :input_data=api_data.data
                    unit="Nbre"
                    ></chart_lines_and_pie>
                                              
                    <data_driven_layer_toggle
                                    method="country_gdf_rule"
                                    title="Pays ayant des procès-verbaux et contentieux"
                                    :api_data=api_data.eligible_country
                    ></data_driven_layer_toggle>
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