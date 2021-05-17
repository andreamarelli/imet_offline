<template>

    <div>
        <div class="content">                    
            <span>
                Au moins <span class="highlighted">80 % initiatives des parties prenantes</span>
                du secteur forêts et environnement (projets, programmes, stratégies, plans d’actions, etc.) sont alignées 
                sur les politiques et stratégies nationales et sous-régionales d'ici <span class="highlighted">2020</span>.

            </span>

            <chart_lines_and_pie
                title="Initiatives des parties prenantes par pays"
                :input_data=api_data.data
                unit="Nbre"
                ></chart_lines_and_pie>

            <data_driven_layer_toggle
                method="country_stakeholder_initiatives"
                title="Pays ayant des initiatives des parties prenantes"
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