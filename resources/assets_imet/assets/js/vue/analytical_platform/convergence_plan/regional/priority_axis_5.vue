<template>

    <div>

        <div class="list-key-numbers grid_one_col">

            <div>
                <div class="content">                    
                    <span>
                        D'ici <span class="highlighted">2020</span>, les recettes fiscales issues du secteur forestier ont augmenté de 25% dans au moins 05 pays d’Afrique centrale.
                    </span>
                    <chart_lines_and_pie
                        title="Recettes fiscales issues du secteur forestier"
                        :input_data=api_data.tax_revenue_forestry_sector_chart.data
                        unit="$"
                        ></chart_lines_and_pie>

                    <data_driven_layer_toggle
                        method="country_tax_revenue_forestry_sector"
                        title="Pays ayant des recettes fiscales issues du secteur forestier"
                        :api_data=api_data.tax_revenue_forestry_sector_chart.eligible_country
                        ></data_driven_layer_toggle>
                </div>
            </div>

            <div>
                <div class="content">                    
                    <span>
                        Le nombre d’emplois issus du secteur forêt-environnement a augmenté de 25% d’ici à  <span class="highlighted">2025</span>.
                    </span>

                    <chart
                        title="Emplois issus du secteur forêt-environnement"
                        :bars=[api_data.jobs_forestry_sector_chart.data]
                        unit="Nbre"
                        ></chart>
                    <data_driven_layer_toggle
                        method="country_jobs_forestry_sector"
                        title="Pays ayant des emplois issus du secteur forêt-environnement"
                        :api_data=api_data.jobs_forestry_sector_chart.eligible_country
                        ></data_driven_layer_toggle>
                </div>
            </div>

            <div>
                <div class="content">

                    <span>
                        D’ici <span class="highlighted">2020</span> ,au moins <span class="highlighted">07</span> pays disposent des textes fixant la répartition équitable des revenus issus de l’exploitation forestière et faunique.
                    </span>
                    <data_year :year=api_data.text_fixing_distribution_income_forestry.last_year></data_year>
                    <gauge_cp  :percentage=api_data.text_fixing_distribution_income_forestry.percentage></gauge_cp>
                    <span class="number">{{ api_data.text_fixing_distribution_income_forestry.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.text_fixing_distribution_income_forestry.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_text_fixing_distribution_income_forestry"
                            title="Pays disposant des textes fixant la répartition équitable des revenus issus de l’exploitation forestière et faunique"
                            :api_data=api_data.text_fixing_distribution_income_forestry.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">
                    <span>
                        D’ici <span class="highlighted">2020</span> , les instruments de gouvernance favorisant la gestion décentralisée et participative de revenus de l’exploitation forestière et faunique sont mis en place dans au moins <span class="highlighted">05</span> pays d’Afrique centrale.
                    </span>
                    <data_year :year=api_data.promoting_decentralized_management.last_year></data_year>
                    <gauge_cp  :percentage=api_data.promoting_decentralized_management.percentage></gauge_cp>
                    <span class="number">{{ api_data.promoting_decentralized_management.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.promoting_decentralized_management.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_promoting_decentralized_management"
                            title="Pays ayant mis en place les instruments de gouvernance favorisant la gestion décentralisée et participative de revenus de l’exploitation forestière et faunique"
                            :api_data=api_data.promoting_decentralized_management.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">
                    <span>
                        D’ici <span class="highlighted">2022</span> , les revenus issus de l’exploitation forestière et faunique sont répartis selon les textes en vigueur dans au moins <span class="highlighted">05</span> pays d’Afrique centrale.
                    </span>
                    <data_year :year=api_data.harvesting_income.last_year></data_year>
                    <gauge_cp  :percentage=api_data.harvesting_income.percentage></gauge_cp>
                    <span class="number">{{ api_data.harvesting_income.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.harvesting_income.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_harvesting_income"
                            title="Pays ayant les revenus issus de l’exploitation forestière et faunique répartis selon les textes en vigueur"
                            :api_data=api_data.harvesting_income.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">

                    <span>
                        D’ici <span class="highlighted">2025</span>, le nombre des infrastructures sociales et initiatives de développement local financées par les revenus issus de l’exploitation forestière et faunique a doublé dans au moins 05 pays d’Afrique centrale.
                    </span>
                    <chart_lines_and_pie
                        title="Nombre des infrastructuress"
                        :input_data=api_data.social_infrastructure_chart.data
                        unit="Nbre"
                        ></chart_lines_and_pie>

                    <data_driven_layer_toggle
                        method="country_social_infrastructure"
                        title="Pays ayant des recettes fiscales issues du secteur forestier"
                        :api_data=api_data.social_infrastructure_chart.eligible_country
                        ></data_driven_layer_toggle>
                </div>
            </div>

            <div>
                <div class="content">

                    <span>
                        D’ici <span class="highlighted">2025</span>, les revenus des ménages des populations riveraines des zones forestières issues de la valorisation des ressources forestières et de la faune ont doublé dans tous les pays d’Afrique centrale.
                    </span>
                    <chart_lines_and_pie
                        title="Revenus ménages"
                        :input_data=api_data.household_income_chart.data
                        unit=""
                        ></chart_lines_and_pie>

                    <data_driven_layer_toggle
                        method="country_household_income"
                        title="Pays ayant des revenus"
                        :api_data=api_data.household_income_chart.eligible_country
                        ></data_driven_layer_toggle>
                </div>
            </div>

            <div>
                <div class="content">

                    <span>
                        D’ici <span class="highlighted">2025</span>, le nombre de forêts gérées par les communautés locales (hommes et femmes), populations autochtones et/ou collectivités décentralisées a augmenté d’au moins 20 % dans 07 pays d’Afrique centrale.
                    </span>
                    <chart_lines_and_pie
                        title="Nombre de forêts"
                        :input_data=api_data.forests_managed_local_chart.data
                        unit=""
                        ></chart_lines_and_pie>

                    <data_driven_layer_toggle
                        method="country_forests_managed_local"
                        title="Pays ayant des forêts gérées par les communautés locales"
                        :api_data=api_data.forests_managed_local_chart.eligible_country
                        ></data_driven_layer_toggle>
                </div>
            </div>

            <div>
                <div class="content">

                    <span>
                        Au moins une réunion de concertation multi-acteurs est organisée dans chaque pays et au niveau sous-régional par an.
                    </span>
                    <chart_lines_and_pie
                        title="Nombre de réunions"
                        :input_data=api_data.consultation_meeting_chart.data
                        unit=""
                        ></chart_lines_and_pie>

                    <data_driven_layer_toggle
                        method="country_consultation_meeting"
                        title="Pays ayant des réunions de concertation multi-acteurs"
                        :api_data=api_data.consultation_meeting_chart.eligible_country
                        ></data_driven_layer_toggle>
                </div>
            </div>

            <div>
                <div class="content">

                    <span>
                        Au moins 02 documents de plaidoyer adoptés de manière concertée et prenant en compte les intérêts des groupes vulnérables sont produits par pays annuellement
                    </span>

                    <chart_lines_and_pie
                        title="Nombre de documents de plaidoyer"
                        :input_data=api_data.advocacy_documents_adopted_chart.data
                        unit=""
                        ></chart_lines_and_pie>

                    <data_driven_layer_toggle
                        method="country_advocacy_documents_adopted"
                        title="Pays ayant documents de plaidoyer"
                        :api_data=api_data.advocacy_documents_adopted_chart.eligible_country
                        ></data_driven_layer_toggle>
                </div>
            </div>


            <div>
                <div class="content">
                    <span>
                        D’ici <span class="highlighted">2020</span> ,chaque pays dispose d’un programme de renforcement des capacités des OSCs en matière d’AGRs.
                    </span>
                    <data_year :year=api_data.capacity_building_program.last_year></data_year>
                    <gauge_cp  :percentage=api_data.capacity_building_program.percentage></gauge_cp>
                    <span class="number">{{ api_data.capacity_building_program.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.capacity_building_program.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_capacity_building_program"
                            title="Pays disposant d’un programme de renforcement des capacités des OSCs en matière d’AGRs"
                            :api_data=api_data.capacity_building_program.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">

                    <span>
                        Au moins deux OSC sont formées dans chaque pays d’Afrique centrale annuellement
                    </span>

                    <chart_lines_and_pie
                        title="Nombre d'OSCs formées"
                        :input_data=api_data.cso_trained_chart.data
                        unit=""
                        ></chart_lines_and_pie>

                    <data_driven_layer_toggle
                        method="country_cso_trained"
                        title="Pays ayant documents des OSCs formées"
                        :api_data=api_data.cso_trained_chart.eligible_country
                        ></data_driven_layer_toggle>
                </div>
            </div>
            
            <div>
                <div class="content">

                    <span>
                        D’ici <span class="highlighted">2020</span>, toutes les politiques et stratégies nationales et sous-régionales concernant le secteur forestier-environnement intègrent explicitement les intérêts des femmes et des populations autochtones tels que recommandés par les plateformes de la CEFDHAC.
                    </span>
                    <span>
                    <span class="highlighted">Politiques et stratégies nationales</span>
                    </span>
                    <data_year :year=api_data.policies_strategies.last_year></data_year>
                    <gauge_cp  :percentage=api_data.policies_strategies.percentage></gauge_cp>
                    <span class="number">{{ api_data.policies_strategies.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.policies_strategies.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_policies_strategies"
                            title="Pays dont les politiques et stratégies nationales concernant le secteur forestier-environnement intègrent explicitement les intérêts des femmes et des populations autochtones"
                            :api_data=api_data.policies_strategies.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                    <span>
                    <span class="highlighted">Politiques et stratégies sous-régionales</span>
                    </span>
                    <i class="fas text-base" :class="[api_data.policies_strategies.existence ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>

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