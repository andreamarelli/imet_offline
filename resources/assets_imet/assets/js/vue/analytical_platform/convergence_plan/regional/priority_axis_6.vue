<template>

    <div>

        <div class="list-key-numbers grid_one_col">
            <div>
                <div class="content">

                    <span>                         
                        Tous les pays d’Afrique Centrale sont à jour vis-à-vis de leurs contributions égalitaires d’ici  <span class="highlighted">2017</span> conformément au Traité de la COMIFAC.
                    </span>
                    <data_year :year=api_data.equal_contribution_accordance.last_year></data_year>
                    <gauge_cp  :percentage=api_data.equal_contribution_accordance.percentage></gauge_cp>
                    <span class="number">{{ api_data.equal_contribution_accordance.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.equal_contribution_accordance.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_equal_contribution_accordance"
                            title="Pays à jour vis-à-vis de leurs contributions égalitaires conformément au Traité de la COMIFAC"
                            :api_data=api_data.equal_contribution_accordance.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">

                    <span>                         
                        D’ici <span class="highlighted">2025</span>, <span class="highlighted">0,1%</span>  des taxes d’importation des pays tiers sont reversées à la COMIFAC.                        
                    </span>
                    <data_year :year=api_data.import_taxes_third_countries.last_year></data_year>
                    <gauge_cp  :percentage=api_data.import_taxes_third_countries.percentage></gauge_cp>
                    <span class="number">{{ api_data.import_taxes_third_countries.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.import_taxes_third_countries.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_import_taxes_third_countries"
                            title="Pays dont 0,1% des taxes d’importation sont reversées à la COMIFAC"
                            :api_data=api_data.import_taxes_third_countries.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">

                    <span>     
                        D’ici <span class="highlighted">2020</span>, au moins <span class="highlighted">7</span> pays d’Afrique centrale disposent de Fonds forestiers et/ou environnementaux opérationnels.                     
                    </span>
                    <data_year :year=api_data.environmental_funds.last_year></data_year>
                    <gauge_cp  :percentage=api_data.environmental_funds.percentage></gauge_cp>
                    <span class="number">{{ api_data.environmental_funds.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.environmental_funds.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_environmental_funds"
                            title="Pays disposant de Fonds forestiers et/ou environnementaux opérationnels"
                            :api_data=api_data.environmental_funds.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">

                    <span>     
                        D’ici <span class="highlighted">2017</span>, au moins <span class="highlighted">7</span> pays d’Afrique centrale disposent des textes fixant les taxes de conversion sur les superficies forestières affectées à d’autres usages (mines, infrastructures, agro-industries, etc.).                       
                    </span>
                    <data_year :year=api_data.conversion_text.last_year></data_year>
                    <gauge_cp  :percentage=api_data.conversion_text.percentage></gauge_cp>
                    <span class="number">{{ api_data.conversion_text.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.conversion_text.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_conversion_text"
                            title="Pays disposant des textes fixant les taxes de conversion sur les superficies forestières affectées à d’autres usages (mines, infrastructures, agro-industries, etc.)"
                            :api_data=api_data.conversion_text.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">

                    <span> 
                        D’ici <span class="highlighted">2020</span>, au moins un accord de partenariat avec le secteur privé sur le financement des actions de conservation et de gestion durable des forêts est signé dans au moins <span class="highlighted">05</span> pays d’Afrique centrale.
                    </span>
                    <data_year :year=api_data.agreement_private_sector.last_year></data_year>
                    <gauge_cp  :percentage=api_data.agreement_private_sector.percentage></gauge_cp>
                    <span class="number">{{ api_data.agreement_private_sector.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.agreement_private_sector.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_agreement_private_sector"
                            title="Pays dans lesquels au moins un accord de partenariat avec le secteur privé sur le financement des actions de conservation et de gestion durable des forêts est signé"
                            :api_data=api_data.agreement_private_sector.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">

                    <span> 
                        D’ici <span class="highlighted">2025</span>, au moins <span class="highlighted">03</span> pays d’Afrique centrale disposent d’un fonds fiduciaire et/ou un fonds vert opérationnels.
                    </span>
                    <data_year :year=api_data.trust_green_fund.last_year></data_year>
                    <gauge_cp  :percentage=api_data.trust_green_fund.percentage></gauge_cp>
                    <span class="number">{{ api_data.trust_green_fund.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.trust_green_fund.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_trust_green_fund"
                            title="Pays disposant d’un fonds fiduciaire et/ou un fonds vert opérationnels"
                            :api_data=api_data.trust_green_fund.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">                    
                    <span>
                        D'ici <span class="highlighted">2020</span>, au moins <span class="highlighted">02</span> projets pilotes de marché du carbone sont mis en œuvre dans au moins 03 pays d’Afrique centrale.
                    </span>
                    <chart_lines_and_pie
                        title="Projets pilotes"
                        :input_data=api_data.pilot_carbon_market_projects_chart.data
                        unit="$"
                        ></chart_lines_and_pie>

                    <data_driven_layer_toggle
                        method="country_pilot_carbon_market_projects"
                        title="Pays ayant des projets pilotes de marché du carbone"
                        :api_data=api_data.pilot_carbon_market_projects_chart.eligible_country
                        ></data_driven_layer_toggle>
                </div>
            </div>

            <div>
                <div class="content">

                    <span>
                        D’ici <span class="highlighted">2017</span>, au moins un document de stratégie pour la recherche et la mobilisation des financements internationaux est élaboré.
                    </span>
                    <i class="fas text-base" :class="[api_data.mobilization_funding.existence ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>

                </div>
            </div>

            <div>
                <div class="content">

                    <span>
                        D’ici <span class="highlighted">2020</span>, des financements nouveaux et additionnels sont captés à travers la mise en œuvre de la stratégie pour la recherche et la mobilisation des financements internationaux.
                    </span>
                    
                    <chart
                        title="Financements nouveaux captés"
                        :bars=[api_data.additional_funding_received.amount]
                        unit=""
                        ></chart>
                    
                    <chart
                        title="Financements additionnels captés"
                        :bars=[api_data.additional_funding_received.additional_amount]
                        unit=""
                        ></chart>

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