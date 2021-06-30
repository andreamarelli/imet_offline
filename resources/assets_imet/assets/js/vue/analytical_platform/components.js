// ######## Common basic components ########
Vue.component('layer_toggle', require('./components/layer_toggle.vue').default);
Vue.component('data_driven_layer_toggle', require('./components/data_driven_layer_toggle.vue').default);
Vue.component('dopa_indicators_table', require('./components/dopa_indicators_table.vue').default);
Vue.component('dopa_chart_stacked_area', require('./components/dopa_chart_stacked_area.vue').default);
Vue.component('dopa_chart_doughnut', require('./components/dopa_chart_doughnut.vue').default);
Vue.component('dopa_chart_bar', require('./components/dopa_chart_bar.vue').default);
Vue.component('data_year', require('./components/data_year.vue').default);
Vue.component('data_source', require('./components/data_source.vue').default);
Vue.component('data_country', require('./components/data_country.vue').default);
Vue.component('data_list_imet', require('./components/data_list_imet.vue').default);
Vue.component('data_imet_country', require('./components/data_imet_country.vue').default);
Vue.component('data_form_link', require('./components/data_form_link.vue').default);
Vue.component('form_link', require('./components/form_link.vue').default);
Vue.component('no_data', require('./components/no_data.vue').default);
Vue.component('list', require('./components/list.vue').default);
Vue.component('switch_checkbox', require('./components/switch_checkbox.vue').default);
Vue.component('dopa_coverage_table', require('./components/dopa_coverage_table.vue').default);

Vue.component('species_list', require('./components/species_list.vue').default);
Vue.component('key_number_single', require('./components/key_number_single.vue').default);

Vue.component('gauge_cp', require('./components/gauge_cp.vue').default);
// Shared componenents
Vue.component('topographie_pa_chart', require('./biodiversity/protected_areas/context/topographie_pa_chart.vue').default);
Vue.component('tree_map_chart', require('./biodiversity/protected_areas/context/tree_map_chart.vue').default);
Vue.component('landcover', require('./biodiversity/protected_areas/context/landcover_chart.vue').default);
Vue.component('emplois', require('./forest_management/national/economy/emplois.vue').default);
Vue.component('amenagement_superficie_production', require('./forest_management/national/amenagement/amenagement_superficie_production.vue').default);
Vue.component('amenagement_concession_forestiere', require('./forest_management/national/amenagement/amenagement_concession_forestiere.vue').default);
Vue.component('gouvernance_foret_communale', require('./forest_management/national/gouvernance/gouvernance_foret_communale.vue').default);
Vue.component('gouvernance_foret_communautaire', require('./forest_management/national/gouvernance/gouvernance_foret_communautaire.vue').default);
Vue.component('plantation_superficie', require('./forest_management/national/plantation/plantation_superficie.vue').default);
Vue.component('plantation_exportation', require('./forest_management/national/plantation/plantation_exportation.vue').default);
Vue.component('plantation_certification', require('./forest_management/national/plantation/plantation_certification.vue').default);


require('./forest_management/national/components');     // Forest management / National
require('./forest_management/regional/components');     // Forest management / Regional
require('./forest_management/concession/components');   // Forest management / Concession
require('./biodiversity/national/components');          // Biodiversity / National
require('./biodiversity/protected_areas/components');   // Biodiversity / Protected areas
require('./biodiversity/regional/components');          // Biodiversity / Regional
require('./biodiversity/landscapes/components');          // Biodiversity / Landscapes
require('./convergence_plan/regional/components');          // ConvergencePlan / Regional
