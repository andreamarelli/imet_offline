
// Protected Areas
Vue.component('aichi', require('./protected_areas/aichi.vue').default);
Vue.component('number_pa', require('./protected_areas/number_pa.vue').default);
Vue.component('management_pa', require('./protected_areas/management_pa.vue').default);
Vue.component('pertinence', require('./protected_areas/pertinence.vue').default);
Vue.component('gauge_aichi', require('./protected_areas/gauge_aichi.vue').default);

// Economy
Vue.component('pib_contribution', require('./economy/pib_contribution.vue').default);
Vue.component('tourism', require('./economy/tourism.vue').default);
Vue.component('export_contribution', require('./economy/export_contribution.vue').default);
Vue.component('tax_revenues', require('./economy/tax_revenues.vue').default);
Vue.component('tax_revenues_details', require('./economy/tax_revenues_details.vue').default);
Vue.component('jobs', require('./economy/jobs.vue').default);

// Species
Vue.component('national_animal', require('./species/national_animal.vue').default);
Vue.component('national_flora', require('./species/national_flora.vue').default);

// Politics
Vue.component('conservation_funding', require('./politics/conservation_funding.vue').default);
Vue.component('national_strategy', require('./politics/national_strategy.vue').default);
Vue.component('suivi_control', require('./politics/suivi_control.vue').default);

// Context
Vue.component('dopa_fragmentation', require('./context/dopa_fragmentation.vue').default);
Vue.component('dopa_degradation', require('./context/dopa_degradation.vue').default);
Vue.component('dopa_soil_organic_carbon', require('./context/dopa_soil_organic_carbon.vue').default);
Vue.component('dopa_above_ground_carbon', require('./context/dopa_above_ground_carbon.vue').default);
Vue.component('country_endemics', require('./context/country_endemics.vue').default);
Vue.component('country_threatened', require('./context/country_threatened.vue').default);
Vue.component('numberspecies', require('./context/numberspecies.vue').default);
Vue.component('ecoregions', require('./context/ecoregions.vue').default);