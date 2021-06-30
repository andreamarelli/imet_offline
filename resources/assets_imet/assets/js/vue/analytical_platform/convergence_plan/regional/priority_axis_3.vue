<template>

    <div>

        <div class="list-key-numbers grid_one_col">

            <div>
                <div class="content">                    
                    <span>
                        D'ici <span class="highlighted">2020</span>, au moins <span class="highlighted">02 APT</span> ont été créées entre les pays d’Afrique Centrale et des Accords de coopération signées.
                    </span>
                    <chart_lines_and_pie
                        title="APTs créées"
                        :input_data=api_data.cross_border_protected_areas_chart.data
                        unit="m3"
                        ></chart_lines_and_pie>

                    <data_driven_layer_toggle
                        method="country_cross_border_protected_areas"
                        title="Pays ayant des APT créées"
                        :api_data=api_data.cross_border_protected_areas_chart.eligible_country
                        ></data_driven_layer_toggle>
                </div>
            </div>

            <div>
                <div class="content">

                    <span>
                        D’ici <span class="highlighted">2020</span> ,au moins <span class="highlighted">80%</span> des AP et APT
                        disposent d’un <span class="highlighted">plan de gestion et d’un plan d’affaires actualisé</span>.
                    </span>
                    <data_year :year=api_data.protected_areas_management_plan.last_year></data_year>
                    <gauge_cp  :percentage=api_data.protected_areas_management_plan.percentage :comparative_value=80></gauge_cp>
                    <span class="number">{{ api_data.protected_areas_management_plan.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.protected_areas_management_plan.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_protected_areas_management_plan"
                            title="Pays disposant des données cartographiques sur les affectations de terre"
                            :api_data=api_data.protected_areas_management_plan.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">                    
                    <span>
                        D'ici <span class="highlighted">2025</span>, les effectifs du personnel qualifié doté d’un statut particulier ont triplé dans les AP de tous les pays d’Afrique Centrale suivant le standard sous-régional.
                    </span>

                    <chart
                        title="Effectifs du personnel qualifié doté d’un statut particulier"
                        :bars=[api_data.number_qualified_personnel_chart.data]
                        unit="Nbre"
                        ></chart>
                    <data_driven_layer_toggle
                        method="country_number_qualified_personnel"
                        title="Pays ayant des effectifs du personnel qualifié doté d’un statut particulier"
                        :api_data=api_data.number_qualified_personnel_chart.eligible_country
                        ></data_driven_layer_toggle>
                </div>
            </div>

            <div>
                <div class="content">
                    <span>
                        D’ici <span class="highlighted">2025</span> ,<span class="highlighted">80%</span> des AP
                        sont dotées des matériels et équipements adéquats dans les pays d’Afrique Centrale de l’espace COMIFAC.
                    </span>
                    <data_year :year=api_data.protected_areas_materials_equipment.last_year></data_year>
                    <gauge_cp  :percentage=api_data.protected_areas_materials_equipment.percentage :comparative_value=80></gauge_cp>
                    <span class="number">{{ api_data.protected_areas_materials_equipment.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.protected_areas_materials_equipment.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_protected_areas_materials_equipment"
                            title="Pays dont 80% des AP sont dotées des matériels et équipements adéquats"
                            :api_data=api_data.protected_areas_materials_equipment.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">                    
                    <span>
                        D'ici <span class="highlighted">2025</span>, au moins <span class="highlighted">50%</span> des résultats du Plan d’action sous régional et des stratégies nationales de gestion et de valorisation des AP sont atteints.
                    </span>

                    <span><span class="highlighted">Régional</span></span>
                    <chart
                        title="Taux d'atteinte des résultats du plan d'action sous-régionale"
                        :lines=[api_data.rate_action_plan_chart.data_regional]        
                        unit="%"
                        ></chart>
                    <span><span class="highlighted">National</span></span>
                    <chart_lines_and_pie
                        title="Taux d'atteinte des résultats du plan d'action par pays"
                        :input_data=api_data.rate_action_plan_chart.data
                        unit="m3"
                        ></chart_lines_and_pie>
                </div>
            </div>

            <div>
                <div class="content">                    
                    <span>
                        D'ici <span class="highlighted">2025</span> le nombre d’aires protégées marines, côtières, mangroves et de zones humides dotées des programmes de suivi et de gestion conformes aux orientations sous-régionales et internationales a doublé dans chaque pays d’Afrique centrale.
                    </span>
                    <chart_lines_and_pie
                        title="APs marines,côtières."
                        :input_data=api_data.marine_protected_areas_chart.data
                        unit="Nbre"
                        ></chart_lines_and_pie>

                    <data_driven_layer_toggle
                        method="country_marine_protected_areas"
                        title="Pays ayant le nombre d’aires protégées marines, côtières, mangroves et de zones humides dotées des programmes de suivi et de gestion conformes aux orientations sous-régionales et internationales"
                        :api_data=api_data.marine_protected_areas_chart.eligible_country
                        ></data_driven_layer_toggle>
                </div>
            </div>

            <div>
                <div class="content">

                    <span>
                        D’ici <span class="highlighted">2020</span>,chaque pays d’Afrique centrale s’est doté d’une stratégie nationale de valorisation des connaissances, innovations et pratiques traditionnelles conforme aux orientations sous-régionales et tenant compte du genre et des droits des peuples autochtones.
                    </span>
                    <data_year :year=api_data.strategy_promoting_traditional.last_year></data_year>
                    <gauge_cp  :percentage=api_data.strategy_promoting_traditional.percentage></gauge_cp>
                    <span class="number">{{ api_data.strategy_promoting_traditional.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.strategy_promoting_traditional.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_strategy_promoting_traditional"
                            title="Pays doté d’une stratégie nationale de valorisation des connaissances, innovations et pratiques traditionnelles conforme aux orientations sous-régionales et tenant compte du genre et des droits des peuples autochtones"
                            :api_data=api_data.strategy_promoting_traditional.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">

                    <span>
                        D’ici <span class="highlighted">2025</span>, chaque pays d’Afrique Centrale a démarré la mise en œuvre de sa stratégie nationale de valorisation des connaissances traditionnelles.
                    </span>
                    <data_year :year=api_data.implementation_promoting_traditional.last_year></data_year>
                    <gauge_cp  :percentage=api_data.implementation_promoting_traditional.percentage></gauge_cp>
                    <span class="number">{{ api_data.implementation_promoting_traditional.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.implementation_promoting_traditional.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_implementation_promoting_traditional"
                            title="Pays ayant démarré la mise en œuvre de sa stratégie nationale de valorisation des connaissances traditionnelles"
                            :api_data=api_data.implementation_promoting_traditional.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            <div>
                <div class="content">

                    <span>
                        Au moins <span class="highlighted">07</span> pays d’Afrique centrale disposent d’ici <span class="highlighted">2020</span> 
                        de base(s)de données actualisées sur le suivi écologique de la biodiversité selon le standard sous-régional et tous les pays en disposent d’ici <span class="highlighted">2025</span>.

                    </span>
                    <data_year :year=api_data.database_ecological_monitoring.last_year></data_year>
                    <gauge_cp  :percentage=api_data.database_ecological_monitoring.percentage></gauge_cp>
                    <span class="number">{{ api_data.database_ecological_monitoring.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.database_ecological_monitoring.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_database_ecological_monitoring"
                            title="Pays disposant de base(s) de données actualisées sur le suivi écologique de la biodiversité selon le standard sous-régional"
                            :api_data=api_data.database_ecological_monitoring.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span>
                        D’ici <span class="highlighted">2020</span>, au moins <span class="highlighted">07</span> pays d’Afrique centrale disposent des instruments régissant l’exploitation et la consommation durable des ressources de la faune conformes aux orientations sous-régionales et tous les pays en disposent en <span class="highlighted">2025</span>.

                    </span>
                    <data_year :year=api_data.sustainable_exploitation.last_year></data_year>
                    <gauge_cp  :percentage=api_data.sustainable_exploitation.percentage></gauge_cp>
                    <span class="number">{{ api_data.sustainable_exploitation.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.sustainable_exploitation.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_sustainable_exploitation"
                            title="Pays disposant des instruments régissant l’exploitation et la consommation durable des ressources de la faune conformes aux orientations sous-régionales"
                            :api_data=api_data.sustainable_exploitation.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">
                    <span>
                        D’ici <span class="highlighted">2020</span>, au moins <span class="highlighted">05</span> pays d’Afrique Centrale rétrocèdent une partie des revenus issus de la filière faune et de l’écotourisme aux populations locales et autochtones de manière équitable et tous les pays en rétrocèdent en <span class="highlighted">2025</span>.

                    </span>
                    <data_year :year=api_data.income_wildlife_ecotourism.last_year></data_year>
                    <gauge_cp  :percentage=api_data.income_wildlife_ecotourism.percentage></gauge_cp>
                    <span class="number">{{ api_data.income_wildlife_ecotourism.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.income_wildlife_ecotourism.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_income_wildlife_ecotourism"
                            title="Pays rétrocèdant une partie des revenus issus de la filière faune et de l’écotourisme aux populations locales et autochtones de manière équitable"
                            :api_data=api_data.income_wildlife_ecotourism.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">
                    <span>
                        D’ici <span class="highlighted">2020</span>, chaque pays d’Afrique Centrale dispose d'une base de données pour le suivi de la consommation et commerce des ressources de la faune.                        
                    </span>
                    <data_year :year=api_data.database_monitoring_wildlife.last_year></data_year>
                    <gauge_cp  :percentage=api_data.database_monitoring_wildlife.percentage></gauge_cp>
                    <span class="number">{{ api_data.database_monitoring_wildlife.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.database_monitoring_wildlife.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_database_monitoring_wildlife"
                            title="Pays disposant d'une base de données pour le suivi de la consommation et commerce des ressources de la faune"
                            :api_data=api_data.database_monitoring_wildlife.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">
                    <span>
                        D’ici <span class="highlighted">2025</span>, au moins <span class="highlighted">30%</span> des AP dans tous les pays d’Afrique Centrale disposent de sites éco touristiques attrayants avec un personnel qualifié.                        
                    </span>
                    <data_year :year=api_data.attractive_ecotourism_site.last_year></data_year>
                    <gauge_cp  :percentage=api_data.attractive_ecotourism_site.percentage :comparative_value=30></gauge_cp>
                    <span class="number">{{ api_data.attractive_ecotourism_site.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.attractive_ecotourism_site.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_attractive_ecotourism_site"
                            title="Pays ayant au moins 30% des AP qui disposent de sites éco touristiques attrayants avec un personnel qualifié"
                            :api_data=api_data.attractive_ecotourism_site.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">                    
                    <span>
                        D'ici <span class="highlighted">2025</span>, le nombre de visiteurs dans les AP a triplé dans chaque pays d’Afrique centrale.
                    </span>
                    <chart_lines_and_pie
                        title="Nombre de visiteurs dans les AP"
                        :input_data=api_data.number_visitor_pa_chart.data
                        unit="Nbre"
                        ></chart_lines_and_pie>

                    <data_driven_layer_toggle
                        method="country_number_visitor_pa"
                        title="Pays ayant le nombre de visiteurs dans les AP"
                        :api_data=api_data.number_visitor_pa_chart.eligible_country
                        ></data_driven_layer_toggle>
                </div>
            </div>

            <div>
                <div class="content">
                    <span>
                        Au moins <span class="highlighted">60%</span> des AP et APT disposent des unités/brigades de contrôle équipés et opérationnels d’ici <span class="highlighted">2025</span>                        
                    </span>
                    <data_year :year=api_data.protected_areas_control_unit.last_year></data_year>
                    <gauge_cp  :percentage=api_data.protected_areas_control_unit.percentage :comparative_value=60></gauge_cp>
                    <span class="number">{{ api_data.protected_areas_control_unit.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.protected_areas_control_unit.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_protected_areas_control_unit"
                            title="Pays ayant au moins 60% des AP et APT disposent des unités/brigades de contrôle équipés et opérationnels "
                            :api_data=api_data.protected_areas_control_unit.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">
                    <span>
                        D’ici <span class="highlighted">2020</span>, tous les pays d’Afrique Centrale disposent des plans nationaux de Lutte Anti-Braconnage conformes aux orientations sous-régionales. 
                    </span>
                    <data_year :year=api_data.anti_poaching_plans.last_year></data_year>
                    <gauge_cp  :percentage=api_data.anti_poaching_plans.percentage></gauge_cp>
                    <span class="number">{{ api_data.anti_poaching_plans.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.anti_poaching_plans.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_anti_poaching_plans"
                            title="Pays disposant des plans nationaux de Lutte Anti-Braconnage conformes aux orientations sous-régionales"
                            :api_data=api_data.anti_poaching_plans.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">                    
                    <span>
                        D'ici <span class="highlighted">2020</span>, l’effort des patrouilles pour la LAB dans les AP, les APT a doublé.
                    </span>

                    <chart
                        title="Effort des patrouilles pour la LAB"
                        :bars=[api_data.patrol_effort_chart.data]
                        unit="Nbre"
                        ></chart>
                    <data_driven_layer_toggle
                        method="country_patrol_effort"
                        title="Pays ayant l'effort des patrouilles pour la LAB dans les AP, les APT"
                        :api_data=api_data.patrol_effort_chart.eligible_country
                        ></data_driven_layer_toggle>
                </div>
            </div>

            <div>
                <div class="content">                    
                    <span>
                        D'ici <span class="highlighted">2020</span>, les effectifs en personnel affectés à la LAB ont augmenté de 100% dans chaque pays d’Afrique Centrale.
                    </span>
                    <chart_lines_and_pie
                        title="Effectifs en personnel affectés à la LAB"
                        :input_data=api_data.staff_numbers_affected_chart.data
                        unit="Nbre"
                        ></chart_lines_and_pie>

                    <data_driven_layer_toggle
                        method="country_staff_numbers"
                        title="Pays ayant des effectifs en personnel affectés à la LAB"
                        :api_data=api_data.staff_numbers_affected_chart.eligible_country
                        ></data_driven_layer_toggle>
                </div>
            </div>

            <div>
                <div class="content">
                    <span>
                        D’ici <span class="highlighted">2020</span>, l’Afrique Centrale dispose d’un référentiel de labellisation.
                    </span>
                    <data_year :year=api_data.labeling_repository.last_year></data_year>
                    <gauge_cp  :percentage=api_data.labeling_repository.percentage></gauge_cp>
                    <span class="number">{{ api_data.labeling_repository.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.labeling_repository.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_labeling_repository"
                            title="Pays disposant d’un référentiel de labellisation"
                            :api_data=api_data.labeling_repository.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">
                    <span>
                        D’ici <span class="highlighted">2025</span>, au moins  <span class="highlighted">10%</span> des AP sont labellisées en Afrique Centrale.
                    </span>
                    <data_year :year=api_data.labeled_protected_area.last_year></data_year>
                    <gauge_cp  :percentage=api_data.labeled_protected_area.percentage></gauge_cp>
                    <span class="number">{{ api_data.labeled_protected_area.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.labeled_protected_area.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_labeled_protected_area"
                            title="Pays dont au moins 10% des AP sont labellisées"
                            :api_data=api_data.labeled_protected_area.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">
                    <span>
                        D’ici <span class="highlighted">2020</span>, tous les pays d’Afrique Centrale disposent d’une <span class="highlighted">stratégie nationale et des cadres réglementaire et institutionnel sur l’APA</span>.
                    </span>
                    <data_year :year=api_data.strategy_institutional.last_year></data_year>
                    <gauge_cp  :percentage=api_data.strategy_institutional.percentage></gauge_cp>
                    <span class="number">{{ api_data.strategy_institutional.eligible_country.length || '-' }} / 10</span>
                    <span class="txt">
                        {{ api_data.strategy_institutional.eligible_country | country_names }}
                        <data_driven_layer_toggle
                            method="country_strategy_institutional"
                            title="Pays disposant  d’une stratégie nationale et des cadres réglementaire et institutionnel sur l’APA"
                            :api_data=api_data.strategy_institutional.eligible_country
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <div class="content">                    
                    <span>
                        D'ici <span class="highlighted">2025</span>, les revenus issus de l’accès et de l’exploitation des ressources génétiques ont doublé dans les pays d’Afrique Centrale.
                    </span>
                    <chart_lines_and_pie
                        title="Revenus issus de l'accès et exploitation des ressources génetiques"
                        :input_data=api_data.exploitation_resources_chart.data
                        unit=""
                        ></chart_lines_and_pie>

                    <data_driven_layer_toggle
                        method="country_exploitation_resources"
                        title="Pays ayant des revenus issus de l’accès et de l’exploitation des ressources génétiques"
                        :api_data=api_data.exploitation_resources_chart.eligible_country
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