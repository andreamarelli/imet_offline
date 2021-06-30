<template>

    <div>

        <div class="list-key-numbers grid_one_col">
            <div>
                <div class="content">
                    
                    <span>
                        D’ici <span class="highlighted">2025</span> ,au moins <span class="highlighted">7</span> pays
                        d'Afrique centrale dispose de <span class="highlighted">données cartographiques</span> sur les affectations de terre.
                    </span>
                    <data_year :year=api_data.map_data.last_year></data_year>
                    <gauge_cp  :percentage=api_data.map_data.percentage ></gauge_cp>
                    <span class="number">{{ api_data.map_data.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.map_data.eligible_country | country_names }}
                            <data_driven_layer_toggle
                                    method="country_map_data"
                                    title="Pays disposant des données cartographiques sur les affectations de terre"
                                    :api_data=api_data.map_data.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            
            <div>
                <div class="content">
                    
                    <span>
                        D’ici <span class="highlighted">2025</span> ,au moins <span class="highlighted">30%</span> du territoire forestier
                        sont <span class="highlighted">matérialisés</span> dans chaque pays d'Afrique Centrale.
                    </span>
                    <data_year :year=api_data.materialized_territory.last_year></data_year>
                    <gauge_cp  :percentage=api_data.materialized_territory.percentage  :comparative_value=30 ></gauge_cp>
                    <span class="number">{{ api_data.materialized_territory.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.materialized_territory.eligible_country | country_names }}
                            <data_driven_layer_toggle
                                    method="country_materialized_territory"
                                    title="Pays au moins 30% du territoire forestier matérialisé"
                                    :api_data=api_data.materialized_territory.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            <div>
                <div class="content">
                    
                    <span>
                        Au moins <span class="highlighted">05</span> pays d'Afrique Centrale ont mis en place des <span class="highlighted">mécanismes d'accès au foncier</span> pour les
                        activités de foresterie communautaire d'ici <span class="highlighted"> 2025 </span>.
                    </span>
                    <data_year :year=api_data.land_access_mechanism.last_year></data_year>
                    <gauge_cp  :percentage=api_data.land_access_mechanism.percentage></gauge_cp>
                    <span class="number">{{ api_data.land_access_mechanism.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.land_access_mechanism.eligible_country | country_names }}
                            <data_driven_layer_toggle
                                    method="country_land_access_mechanism"
                                    title="Pays ayant mise en place des mécanismes d’accès au foncier "
                                    :api_data=api_data.land_access_mechanism.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            <div>
                <div class="content">
                    
                    <span>
                        Au moins <span class="highlighted">80 %</span> des superficies forestières sont  <span class="highlighted">sous aménagement </span>  d'ici <span class="highlighted"> 2020 </span>.
                    </span>
                    <data_year :year=api_data.forest_area_under_management.last_year></data_year>
                    <gauge_cp  :percentage=api_data.forest_area_under_management.percentage  :comparative_value=80 ></gauge_cp>
                    <span class="number">{{ api_data.forest_area_under_management.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.forest_area_under_management.eligible_country | country_names }}
                            <data_driven_layer_toggle
                                    method="country_forest_area_under_management"
                                    title="Pays ayant au moins 80% des superficies forestières sous aménagement"
                                    :api_data=api_data.forest_area_under_management.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            <div>
                <div class="content">                    
                    <span>
                        Dans au moins <span class="highlighted">05</span> pays d'Afrique Centrale, <span class="highlighted">les règles et normes de GDF</span> établies sont appliquées par toutes les parties prenantes 
                        d'ici <span class="highlighted"> 2025 </span>.
                    </span>
                    <data_year :year=api_data.gdf_rule.last_year></data_year>
                    <gauge_cp  :percentage=api_data.gdf_rule.percentage></gauge_cp>
                    <span class="number">{{ api_data.gdf_rule.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.gdf_rule.eligible_country | country_names }}
                            <data_driven_layer_toggle
                                    method="country_gdf_rule"
                                    title="Pays dont les règles et normes de GDF établies sont appliquées "
                                    :api_data=api_data.gdf_rule.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            
            <div>
                <div class="content">                    
                    <span>
                        D'ici <span class="highlighted">2025</span>,  chaque pays d’Afrique Centrale dispose des données actualisées sur l’importance économique de son secteur forêt-environnement.
                    </span>
                    <data_year :year=api_data.economic_importance.last_year></data_year>
                    <gauge_cp  :percentage=api_data.economic_importance.percentage></gauge_cp>
                    <span class="number">{{ api_data.economic_importance.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.economic_importance.eligible_country | country_names }}
                            <data_driven_layer_toggle
                                    method="country_economic_importance"
                                    title="Pays disposant des données actualisées sur l’importance économique de son secteur forêt-environnement"
                                    :api_data=api_data.economic_importance.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            
            <div>
                <div class="content">                    
                    <span>
                        D'ici <span class="highlighted">2025</span>, chaque pays dispose d’un <span class="highlighted">compte satellite environnement</span> au sein de la comptabilité nationale. 
                    </span>
                    <data_year :year=api_data.satellite_account.last_year></data_year>
                    <gauge_cp  :percentage=api_data.satellite_account.percentage></gauge_cp>
                    <span class="number">{{ api_data.satellite_account.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.satellite_account.eligible_country | country_names }}
                            <data_driven_layer_toggle
                                    method="country_satellite_account"
                                    title="Pays disposant d’un compte satellite environnement au sein de la comptabilité nationale"
                                    :api_data=api_data.satellite_account.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            <div>
                <div class="content">                    
                    <span>
                        D'ici <span class="highlighted">2020</span>, chaque pays d'Afrique Centrale dispose dispose d’un plan pour la transformation plus poussée des produits forestiers. 
                    </span>
                    <data_year :year=api_data.processing_plan.last_year></data_year>
                    <gauge_cp  :percentage=api_data.processing_plan.percentage></gauge_cp>
                    <span class="number">{{ api_data.processing_plan.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.processing_plan.eligible_country | country_names }}
                            <data_driven_layer_toggle
                                    method="country_processing_plan"
                                    title="Pays disposant d’un plan pour la transformation plus poussée des produits forestiers"
                                    :api_data=api_data.processing_plan.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            <div>
                <div class="content">                    
                    <span>
                        D'ici <span class="highlighted">2025</span>, <span class="highlighted">le volume des produits à forte valeur ajoutée </span> a augmenté de 50% dans au moins trois pays d’Afrique Centrale.
                    </span>
                    <chart_lines_and_pie
                    title="Volume des produits à forte valeur ajoutée"
                    :input_data=api_data.added_value_products_chart.data
                    unit="m3"
                    ></chart_lines_and_pie>
                                              
                    <data_driven_layer_toggle
                                    method="country_added_value_products"
                                    title="Volume des produits à forte valeur ajoutée par pays"
                                    :api_data=api_data.added_value_products_chart.eligible_country
                    ></data_driven_layer_toggle>
                </div>
            </div>
            
            <div>
                <div class="content">                    
                    <span>
                        D'ici <span class="highlighted">2020</span>, au moins <span class="highlighted">07</span> pays d'Afrique Centrale disposent dispose d’une <span class="highlighted">stratégie d’organisation des filières artisanales du bois et autres produits forestiers non ligneux</span>. 
                    </span>
                    <data_year :year=api_data.artisanal_timber_products.last_year></data_year>
                    <gauge_cp  :percentage=api_data.artisanal_timber_products.percentage></gauge_cp>
                    <span class="number">{{ api_data.artisanal_timber_products.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.artisanal_timber_products.eligible_country | country_names }}
                            <data_driven_layer_toggle
                                    method="country_artisanal_timber_products"
                                    title="Pays disposant d’une stratégie d’organisation des filières artisanales du bois et autres produits forestiers non ligneux"
                                    :api_data=api_data.artisanal_timber_products.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            
            <div>
                <div class="content">                    
                    <span>
                        Au moins 50% des des opérateurs des  <span class="highlighted">filières artisanales et PFNL</span> sont regroupés et encadrés à travers des stratégies nationales appropriées dans 
                        au moins <span class="highlighted">07</span> pays d'Afrique Centrale d'ici <span class="highlighted">2025</span>. 
                    </span>
                    <data_year :year=api_data.grouping_artisanal_operators.last_year></data_year>
                    <gauge_cp  :percentage=api_data.grouping_artisanal_operators.percentage></gauge_cp>
                    <span class="number">{{ api_data.grouping_artisanal_operators.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.grouping_artisanal_operators.eligible_country | country_names }}
                            <data_driven_layer_toggle
                                    method="country_grouping_artisanal_operators"
                                    title="Pays dont au moins 50% des opérateurs des filières artisanales et PFNL sont regroupés et encadrés à travers des stratégies nationales appropriées"
                                    :api_data=api_data.grouping_artisanal_operators.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            <div>
                <div class="content">                    
                    <span>
                        Au moins  <span class="highlighted">07</span> pays d'Afrique Centrale dispose d'un <span class="highlighted">système de vérification de la légalité des produits forestiers </span>  d'ici <span class="highlighted">2020</span>. 
                    </span>
                    <data_year :year=api_data.legality_verification_system.last_year></data_year>
                    <gauge_cp  :percentage=api_data.legality_verification_system.percentage></gauge_cp>
                    <span class="number">{{ api_data.legality_verification_system.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.legality_verification_system.eligible_country | country_names }}
                            <data_driven_layer_toggle
                                    method="country_legality_verification_system"
                                    title="Pays disposant d’un système de vérification de la légalité des produits forestiers "
                                    :api_data=api_data.legality_verification_system.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            <div>
                <div class="content">                    
                    <span>
                        D'ici <span class="highlighted">2025</span>, au moins <span class="highlighted">05</span> ont pris leur disposition interne pour faciliter <span class="highlighted">le développement de la certification forestière</span>. 
                    </span>
                    <data_year :year=api_data.internal_arrangements.last_year></data_year>
                    <gauge_cp  :percentage=api_data.internal_arrangements.percentage></gauge_cp>
                    <span class="number">{{ api_data.internal_arrangements.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.internal_arrangements.eligible_country | country_names }}
                            <data_driven_layer_toggle
                                    method="country_internal_arrangements"
                                    title="Pays ayant pris des dispositions internes pour faciliter le développement de la certification forestière"
                                    :api_data=api_data.internal_arrangements.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            <div>
                <div class="content">                    
                    <span>
                        D'ici <span class="highlighted">2020</span>, chaque pays de l’Afrique Centrale dispose d’un  <span class="highlighted">état des lieux sur les marchés nationaux et régionaux du bois</span>. 
                    </span>
                    <data_year :year=api_data.state_timber_markets.last_year></data_year>
                    <gauge_cp  :percentage=api_data.state_timber_markets.percentage></gauge_cp>
                    <span class="number">{{ api_data.state_timber_markets.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                            {{ api_data.state_timber_markets.eligible_country | country_names }}
                            <data_driven_layer_toggle
                                    method="country_state_timber_markets"
                                    title="Pays disposant d'un état des lieux sur les marchés nationaux et régionaux du bois"
                                    :api_data=api_data.state_timber_markets.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
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