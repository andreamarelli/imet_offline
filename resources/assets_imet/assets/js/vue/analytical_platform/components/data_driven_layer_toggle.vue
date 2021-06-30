<template>

    <div class="toggle">

        <!-- layer switch -->
        <switch_checkbox :id=method
                         @change="emitToggleDataLayer"
                         @mouseenter.native="showTooltip"
                         @mouseleave.native="hideTooltip"
        ></switch_checkbox>

        <!-- tooltip -->
        <div class="toggle__tooltip" v-if="title!=null || legend!==null">

            <!-- title -->
            <div class="title" v-if="title!=null">{{ title }}</div>

            <!-- legend -->
            <div class="legend" v-if="legend!==null && legend_only_palette===false">
                <div class="legend__item" v-for="item in legend">
                    <div class="legend__color" :style="'background-color: ' + item.color"></div>
                    <div class="legend__label">{{ item.label }}</div>
                </div>
            </div>

            <!-- legend (only palette) -->
            <div class="legend palette" v-if="legend!==null && legend_only_palette===true">
                <div class="legend__item" v-for="item in legend">
                    <div class="legend__color" :style="'background-color: ' + item"></div>
                </div>
            </div>

        </div>



    </div>


</template>

<script>

    import utils from '../../../mapping_mapbox/mixins/utils/utils.mixin';
    import choropleth from '../../../mapping_mapbox/mixins/utils/choropleth.mixin';

    export default {

        mixins:[
            utils,
            choropleth
        ],

        props: {
            title: {
                type: String,
                default: null
            },
            method: {
                type: String,
                default: null
            },
            api_data: {
                type: [Object, Array],
                default: () => null
            },
            opacity: {
                type: Number,
                default: 0.9
            }
        },

        data(){
          return{
              input_data: null,
              legend: [],
              legend_only_palette: false,
              layer_paint: null
          }
        },

        beforeMount() {
            this.input_data = Object.assign({}, this.api_data);
        },

        mounted(){
            if (typeof this[this.method] === 'function') {
                let expression = this[this.method]();
                this.layer_id = this.method;
                this.layer_paint = {
                    'fill-color': expression,
                    'fill-opacity': this.opacity
                };
            }
            this.tooltip = this.$el.querySelector('.toggle__tooltip');
        },

        methods: {

            showTooltip(evt){
                let toggle_position = evt.target.getBoundingClientRect()
                this.tooltip.style.display = 'block';
                this.tooltip.style.top = (toggle_position.top + toggle_position.height - 20) + 'px';
                this.tooltip.style.left = (toggle_position.left + toggle_position.width + 13) + 'px';
            },

            hideTooltip(){
                this.tooltip.style.display = 'none';
            },

            /**
             * Emit an event to toggle the layer
             * @param checked
             */
            emitToggleDataLayer(checked){
                window.vueBus.$emit('toggleDataLayer', checked, this.layer_id, this.source_layer_id, this.layer_paint);
            },


            // ################################################
            // ##########  Shared layer definitions  ##########
            // ################################################

            /**
             * Generate layer expression: show all geometries with a color gradient on a given value
             *
             * @param match_on_layer
             * @param match_on_attribute
             * @param input_data
             * @param num_colors
             * @returns {[string, [string, *]]}
             * @private
             */
            __automatic_choropleth(match_on_layer, match_on_attribute, input_data, num_colors){
                this.source_layer_id = match_on_layer;

                num_colors = num_colors || 7;
                let palette = this.generateGradientPalette(num_colors);
                this.legend = palette;
                this.legend_only_palette = true;

                input_data = input_data || this.input_data;
                if(input_data.hasOwnProperty('total')){
                    delete input_data.total;
                }
                let data = this.choropleth(input_data, palette);

                let expression = [
                    'match',
                    ['get', match_on_attribute]
                ];
                Object.entries(data).forEach(function(entry) {
                    if(entry[1]!==null){
                        expression.push(entry[0]);
                        expression.push(palette[entry[1]]);
                    }
                });
                expression.push('rgba(0,0,0,0)');

                return expression;
            },

            /**
             * Generate layer expression: show only specific geometries
             *
             * @param match_on_layer
             * @param match_on_attribute
             * @param input_data
             * @param color
             * @returns {[string, [string, [string, *], [string, *]], *|string, string]}
             * @private
             */
            __automatic__hightlight(match_on_layer, match_on_attribute, input_data, color){
                this.source_layer_id = match_on_layer;

                color = color || '#f0ad4e';
                this.legend = null;

                input_data = input_data || this.input_data;
                input_data = input_data instanceof Object ? Object.values(input_data) : input_data;
                return [
                    'case',
                    ['in', ['get', match_on_attribute], ['literal', input_data]], color,
                    'rgba(0,0,0,0)'
                ];
            },

            // #########################################
            // ##########  Layers definition  ##########
            // #########################################

            number_with_brigade(){
                return this.__automatic_choropleth('countries', 'iso3');
            },

            number_with_equipments(){
                return this.__automatic_choropleth('countries', 'iso3');
            },

            number_assessed(){
                return this.__automatic_choropleth('countries', 'iso3');
            },

            number_certified(){
                return this.__automatic_choropleth('countries', 'iso3');
            },

            transboundary(){
                return this.__automatic__hightlight('protected_areas', 'wdpa_id');
            },

            with_management_plan(){
                return this.__automatic__hightlight('protected_areas', 'wdpa_id');
            },

            with_management_or_development_plan(){
                return this.__automatic__hightlight('protected_areas', 'wdpa_id');
            },

            percent_terrestrial_area_protected(){

                this.source_layer_id = 'protected_areas';

                let palette = this.generateGradientPalette(7);
                this.legend = palette;
                this.legend_only_palette = true;

                let data_percentage = this.choropleth(this.input_data.percentage, palette);
                delete data_percentage.total;

                let match_expression = ['match', ['get', 'country'] ];
                Object.entries(data_percentage).forEach(function(entry) {
                    if(entry[1]!==null){
                        match_expression.push(entry[0]);
                        match_expression.push(palette[entry[1]]);
                    }
                });
                match_expression.push('rgba(0,0,0,0)');

                return [
                    'case',
                    ['in', ['get', 'wdpa_id'], ['literal', this.input_data.wdpa_ids]],
                    match_expression,
                    'rgba(0,0,0,0)'
                ];
            },

            terrestrial_wdpa_ids(){
                return this.__automatic__hightlight('protected_areas', 'wdpa_id');
            },

            terrestrial_wdpa_ids_assessed(){
                return this.__automatic__hightlight('protected_areas', 'wdpa_id');
            },
            terrestrial_wdpa_ids_assessed_imet(){
                return this.__automatic__hightlight('protected_areas', 'wdpa_id');
            },

            percent_marine_area_protected(){
                return this.percent_terrestrial_area_protected();
            },

            marine_wdpa_ids(){
                return this.__automatic__hightlight('protected_areas', 'wdpa_id');
            },

            marine_wdpa_ids_assessed(){
                return this.__automatic__hightlight('protected_areas', 'wdpa_id');
            },
            marine_wdpa_ids_assessed_imet(){
                return this.__automatic__hightlight('protected_areas', 'wdpa_id');
            },

            aichi_terrestrial(){
                let palette = [
                    '#ce2e29',  // $darkRed
                    '#f0ad4e',  // $contextual-warning
                    '#007233'   // $darkGreen
                ]

                let data = []
                Object.entries(this.input_data).map(function(entry) {
                    entry[1] = parseFloat(entry[1]);
                    if(entry[1]>=0 && entry[1]<10){
                        data[entry[0]] = 0;
                    } else if(entry[1]<17){
                        data[entry[0]] = 1;
                    } else if(entry[1]>=17){
                        data[entry[0]] = 2;
                    }
                });

                let expression = ['match', ['get', 'iso3']];
                Object.entries(data).forEach(function(entry) {
                    if(entry[1]!==null){
                        expression.push(entry[0], palette[entry[1]]);
                    }
                });
                expression.push('rgba(0,0,0,0)');

                this.legend = palette;
                this.legend_only_palette = true;
                this.source_layer_id = 'countries';
                return expression;
            },

            aichi_marine(){
                return this.aichi_terrestrial();
            },

            governance() {
                let _this = this;

                let palette = this.generateColorPalette(Object.keys(this.input_data).length);

                this.legend = [];
                let expression = ['case'];
                Object.entries(this.input_data).forEach(function(entry, index) {
                    if(entry[1]!==null){
                        expression.push(['in', ['get', 'wdpa_id'], ['literal', entry[1]]]);
                        expression.push(palette[index]);
                    }
                    _this.legend.push({color: palette[index], label: entry[0]});
                });
                expression.push('rgba(0,0,0,0)');

                this.source_layer_id = 'protected_areas';
                return expression;
            },

            iucn_categories() {
                let _this = this;

                let palette = [
                    '#6f6f6f', // $darkGray
                    '#cdcdcd', // $lightGray
                    ...this.generateColorPalette(7)
                ]
                let labels = ['Not Reported', 'Not Assigned', 'Ia', 'Ib', 'II', 'III', 'IV', 'V', 'VI'];

                this.legend = [];
                let expression = ['match', ['get', 'iucn_category']];
                labels.forEach(function(label, index) {
                    expression.push(label, palette[index]);
                    _this.legend.push({color: palette[index], label: label});
                });
                expression.push('rgba(0,0,0,0)');

                this.source_layer_id = 'protected_areas';
                return expression;
            },

            designations(){
                let palette = [
                    '#00A74B', // $baseGreen
                    '#a7a7a7'  // $baseGray
                ]
                let legend = ['Parc National', 'Autres'];

                this.legend = [];
                this.legend.push({color: palette[0], label: legend[0]});
                this.legend.push({color: palette[1], label: legend[1]});

                let national_parks = [
                    ...(this.input_data.hasOwnProperty('National Park') ? this.input_data['National Park'] : []),
                    ...(this.input_data.hasOwnProperty('National park') ? this.input_data['National park'] : []),
                    ...(this.input_data.hasOwnProperty('Parc National') ? this.input_data['Parc National'] : []),
                    ...(this.input_data.hasOwnProperty('Parc national') ? this.input_data['Parc national'] : []),
                ];
                let expression = [
                    'case',
                    ['in', ['get', 'wdpa_id'], ['literal', national_parks]], palette[0],
                    palette[1]
                ];

                this.source_layer_id = 'protected_areas';
                return expression;
            },

            pertinence_animals(){

                let palette = [
                    '#ce2e29',  // $darkRed
                    '#f0ad4e',  // $contextual-warning
                    '#007233'   // $darkGreen
                ]

                let data = []
                Object.entries(this.input_data).map(function(entry) {
                    entry[1] = parseFloat(entry[1]);
                    if(entry[1]>=0 && entry[1]<50){
                        data[entry[0]] = 0;
                    } else if(entry[1]<75){
                        data[entry[0]] = 1;
                    } else if(entry[1]>=75){
                        data[entry[0]] = 2;
                    }
                });

                let expression = ['match', ['get', 'iso3']];
                Object.entries(data).forEach(function(entry) {
                    if(entry[1]!==null){
                        expression.push(entry[0], palette[entry[1]]);
                    }
                });
                expression.push('rgba(0,0,0,0)');

                this.legend = palette;
                this.legend_only_palette = true;
                this.source_layer_id = 'countries';
                return expression;

            },
            pertinence_vegetations(){
                return this.pertinence_animals();
            },
            pertinence_habitats(){
                return this.pertinence_animals();
            },
            pertinence_ecosystems(){
                return this.pertinence_animals();
            },

            percent_contribution_pib(){
                return this.__automatic_choropleth('countries', 'iso3');
            },

            percent_contribution_export(){
                return this.__automatic_choropleth('countries', 'iso3');
            },

            percent_contribution_tax_revenues(){
                return this.__automatic_choropleth('countries', 'iso3');
            },

            number_touristic_site(){
                return this.__automatic_choropleth('countries', 'iso3');
            },

            direct_jobs(){
                return this.__automatic_choropleth('countries', 'iso3');
            },

            indirect_jobs(){
                return this.__automatic_choropleth('countries', 'iso3');
            },

            number_hunting_permits(){
                return this.__automatic_choropleth('countries', 'iso3');
            },

            percent_conservation_funding(){
                return this.__automatic_choropleth('countries', 'iso3');
            },

            country_trust_fund(){
                return this.__automatic__hightlight('countries', 'iso3');
            },

            country_green_fund(){
                return this.__automatic__hightlight('countries', 'iso3');
            },

            national_strategy_country(){
                return this.__automatic__hightlight('countries', 'iso3');
            },

            action_plan_country(){
                return this.__automatic__hightlight('countries', 'iso3');
            },

            strategy_apa_country(){
                return this.__automatic__hightlight('countries', 'iso3')
            },

            strategy_apa_framework_country(){
                return this.__automatic__hightlight('countries', 'iso3');
            },

            existence_ecological_country(){
                return this.__automatic__hightlight('countries', 'iso3');
            },

            updated_ecological_country(){
                return this.__automatic__hightlight('countries', 'iso3');
            },

            conformity_ecological_country(){
                return this.__automatic__hightlight('countries', 'iso3');
            },

            wildlife_existence_db_country(){
                return this.__automatic__hightlight('countries', 'iso3');
            },

            legal_instruments_country(){
                return this.__automatic__hightlight('countries', 'iso3');
            },

            country_alert_mechanism(){
                return this.__automatic__hightlight('countries', 'iso3');
            },

            country_plan_lab(){
                return this.__automatic__hightlight('countries', 'iso3');
            },

            country_conformity_plan_lab(){
                return this.__automatic__hightlight('countries', 'iso3');
            },
            
            // Methods concerning the convergence plan module
            country_conventions(){
                return this.__automatic__hightlight('countries', 'iso3');
            },
            country_management_instrument(){
                return this.__automatic__hightlight('countries', 'iso3');
            },
            country_institutional_frame(){
                return this.__automatic__hightlight('countries', 'iso3');
            },
            country_map_data(){
                return this.__automatic__hightlight('countries', 'iso3');
            },
            country_materialized_territory(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_land_access_mechanism(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_forest_area_under_management(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_gdf_rule(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_economic_importance(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_satellite_account(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_processing_plan(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_artisanal_timber_products(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_grouping_artisanal_operators(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_legality_verification_system(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_internal_arrangements(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_state_timber_markets(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_protected_areas_management_plan(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_protected_areas_materials_equipment(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_strategy_promoting_traditional(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_implementation_promoting_traditional(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_database_ecological_monitoring(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_sustainable_exploitation(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_income_wildlife_ecotourism(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_database_monitoring_wildlife(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_attractive_ecotourism_site(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_protected_areas_control_unit(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_labeling_repository(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_anti_poaching_plans(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_labeled_protected_area(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_strategy_institutional(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_adaptation_climate_change(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_actions_carried_by_pana(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_infrastructures_alert_mechanisms(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_strategy_redd(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_mrv_instruments(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_data_gas_emissions(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_text_fixing_distribution_income_forestry(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_promoting_decentralized_management(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_harvesting_income(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_capacity_building_program(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_policies_strategies(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_equal_contribution_accordance(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_import_taxes_third_countries(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_conversion_text(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_revenue_conversion_taxes(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_instruments_compensation(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_agreement_private_sector(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_trust_green_fund(){
                return this.__automatic__hightlight('countries', 'iso3');
            },            
            country_stakeholder_initiatives(){
                return this.__automatic_choropleth('countries', 'iso3');
            },
            country_added_value_products(){
                return this.__automatic_choropleth('countries', 'iso3');
            },
            country_cross_border_protected_areas(){
                return this.__automatic_choropleth('countries', 'iso3');
            },
            country_number_qualified_personnel(){
                return this.__automatic_choropleth('countries', 'iso3');
            },
            country_rate_action_plan(){
                return this.__automatic_choropleth('countries', 'iso3');
            },
            country_marine_protected_areas(){
                return this.__automatic_choropleth('countries', 'iso3');
            },
            country_number_visitor_pa(){
                return this.__automatic_choropleth('countries', 'iso3');
            },
            country_patrol_effort(){
                return this.__automatic_choropleth('countries', 'iso3');
            },
            country_staff_numbers(){
                return this.__automatic_choropleth('countries', 'iso3');
            },
            country_exploitation_resources(){
                return this.__automatic_choropleth('countries', 'iso3');
            },
            country_tax_revenue_forestry_sector(){
                return this.__automatic_choropleth('countries', 'iso3');
            },
            country_jobs_forestry_sector(){
                return this.__automatic_choropleth('countries', 'iso3');
            },
            country_social_infrastructure(){
                return this.__automatic_choropleth('countries', 'iso3');
            },
            country_household_income(){
                return this.__automatic_choropleth('countries', 'iso3');
            },
            country_forests_managed_local(){
                return this.__automatic_choropleth('countries', 'iso3');
            },
            country_consultation_meeting(){
                return this.__automatic_choropleth('countries', 'iso3');
            },
            country_advocacy_documents_adopted(){
                return this.__automatic_choropleth('countries', 'iso3');
            },
            country_cso_trained(){
                return this.__automatic_choropleth('countries', 'iso3');
            },
            country_pilot_carbon_market_projects(){
                return this.__automatic_choropleth('countries', 'iso3');
            },
        }

    }

</script>


<style lang="scss" type="text/scss" scoped>

    @import "../../../../sass/abstracts/all";

    .toggle{
        display: inline-block;
        margin: 0 5px;

        .toggle__tooltip{
            display: none;
            position: fixed;
        }

        // style
        .toggle__tooltip{
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.7);
            padding: 8px;
            background-color: $white;
            border-radius: 3px;
            min-width: 200px;
            max-width: 250px;
            z-index: 1;

            // triangle
            &:before{
                content: '';
                display: block;
                width: 0;
                height: 0;
                position: absolute;
                border-top: 8px solid transparent;
                border-bottom: 8px solid transparent;
                border-right: 8px solid $white;
                left: -8px;
                top: 7px;
            }

            .title{
                @include text-xs;
                font-weight: bold;
                text-align: center;
                margin-bottom: 4px;
            }
            .legend{
                @include text-xs;
                .legend__item{
                    display: flex;
                    margin-bottom: 3px;
                    align-items: center;
                    .legend__color{
                        margin-right: 3px;
                        padding: 7px;
                        height: 1px;
                    }
                    .legend__label{
                        font-weight: normal;
                        font-style: italic;
                        line-height: 1.1em;
                    }
                }
            }
            .legend.palette{
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0;
                .legend__color{
                    margin-right: 3px;
                }
            }

        }

    }
</style>
