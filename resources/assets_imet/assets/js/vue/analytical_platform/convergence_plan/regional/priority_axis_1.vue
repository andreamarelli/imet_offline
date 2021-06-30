<template>

    <div>

        <div class="list-key-numbers grid_one_col">
            <div>
                <div class="content">
                    
                    <span>
                        D’ici <span class="highlighted">2025</span> , 
                        tous les pays d’Afrique centrale ont ratifié au moins <span class="highlighted"> 80%  de conventions et accords signés</span> à l’échelle sous-régionale,
                        régionale et internationale.
                    </span>
                    <data_year :year=api_data.convention.last_year></data_year>
                    <gauge_cp  :percentage=api_data.convention.percentage  :comparative_value=80 ></gauge_cp>
                    <span class="number">{{ api_data.convention.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.convention.eligible_country | country_names }}
                            <data_driven_layer_toggle
                                    method="country_conventions"
                                    title="Pays ayant ratifié au moins 80% de conventions et accords"
                                    :api_data=api_data.convention.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            
            <div>
                <div class="content">                    
                    <span>
                        D’ici <span class="highlighted">2020</span> , 
                        des instruments de gestion forestière et environnementale internalisant les dispositions des  <span class="highlighted"> Conventions et Accords </span> existent dans chacun des pays d’Afrique Centrale.                        
                    </span>
                    <data_year :year=api_data.management_instrument.last_year></data_year>
                    <gauge_cp  :percentage=api_data.management_instrument.percentage></gauge_cp>
                    <span class="number">{{ api_data.management_instrument.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.management_instrument.eligible_country | country_names }}
                            <data_driven_layer_toggle
                                    method="country_management_instrument"
                                    title="Pays dont les instruments de gestion internalisent les dispositions des conventions et accords"
                                    :api_data=api_data.management_instrument.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            
            <div>
                <div class="content">                    
                    <span>
                        Tous les Pays d’Afrique Centrale ont révisé leur <span class="highlighted"> cadre institutionnel  </span> et législatif d’ici 
                        <span class="highlighted">2020</span> sur la base des directives de la COMIFAC.
                        
                    </span>
                    <data_year :year=api_data.institutional_frame.last_year></data_year>
                    <gauge_cp  :percentage=api_data.institutional_frame.percentage></gauge_cp>
                    <span class="number">{{ api_data.institutional_frame.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.institutional_frame.eligible_country | country_names }}
                            <data_driven_layer_toggle
                                    method="country_institutional_frame"
                                    title="Pays ayant un cadre institutionnel révisé"
                                    :api_data=api_data.institutional_frame.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            
            
            <div>
                <div class="content">                    
                    <span>
                        Au moins <span class="highlighted">80 % initiatives des parties prenantes</span>
                        du secteur forêts et environnement (projets, programmes, stratégies, plans d’actions, etc.) sont alignées 
                        sur les politiques et stratégies nationales et sous-régionales d'ici <span class="highlighted">2020</span>.
                        
                    </span>
                    
                    <chart_lines_and_pie
                    title="Initiatives des parties prenantes par pays"
                    :input_data=api_data.stakeholder_initiatives_chart.data
                    unit="Nbre"
                    ></chart_lines_and_pie>
                                              
                    <data_driven_layer_toggle
                                    method="country_stakeholder_initiatives"
                                    title="Pays ayant des initiatives des parties prenantes"
                                    :api_data=api_data.stakeholder_initiatives_chart.eligible_country
                    ></data_driven_layer_toggle>
                    
                </div>
            </div>
            
            

        </div>

    </div>

</template>


<script>

    import base from '../../components/_base.mixin';

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