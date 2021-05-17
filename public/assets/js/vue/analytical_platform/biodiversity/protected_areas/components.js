// info
Vue.component('general_info', require('./info/general_info.vue').default);

// Management
Vue.component('management_info', require('./management/management_info.vue').default);

// Species
Vue.component('animal_species_info', require('./species/animal_species_info.vue').default);
Vue.component('species_info_dopa', require('./species/species_info_dopa.vue').default);

// landcover
Vue.component('landcover_change', require('./context/landcover_change_chart.vue').default);

// Ecosystems
Vue.component('habitat_pa', require('./context/habitat_pa.vue').default);
Vue.component('ecoregions_pa', require('./context/ecoregions_pa.vue').default);
Vue.component('land_fragmentation_pa_chart', require('./context/land_fragmentation_pa_chart.vue').default);
Vue.component('land_degradation_pa_chart', require('./context/land_degradation_pa_chart.vue').default);

// Ecosystem services
Vue.component('soil_carbon_dopa_chart', require('./context/soil_carbon_dopa_chart.vue').default);
Vue.component('carbon', require('./context/carbon.vue').default);


