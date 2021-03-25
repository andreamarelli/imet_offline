// Templates
require('./sorted-table.js');
Vue.component('flag',           require('./templates/flag.vue').default);
Vue.component('user',           require('./templates/user.vue').default);
Vue.component('date',           require('./templates/date.vue').default);
Vue.component('last_update',    require('./templates/last_update.vue').default);
Vue.component('file_card',    require('./templates/file_card.vue').default);
Vue.component('imet_charts',    require('./templates/imet_charts.vue').default);
Vue.component('imet_radar',    require('./templates/imet_radar.vue').default);
Vue.component('dopa_radar',    require('./templates/dopa_radar.vue').default);
Vue.component('redlist_category',    require('./templates/redlist_category.vue').default);
Vue.component('redlist_link',    require('./templates/redlist_link.vue').default);
Vue.component('imet_encoders_responsibles',    require('./templates/imet_encoders_responsibles.vue').default);
Vue.component('editor',                   require('./templates/editor.vue').default);

// Small Charts
Vue.component('gauge',                   require('./templates/charts_small/gauge.vue').default);
Vue.component('progress_bar',                   require('./templates/charts_small/progress_bar.vue').default);

// Charts
Vue.component('chart', require('./templates/charts/chart.vue').default);
Vue.component('chart_lines_and_pie', require('./templates/charts/lines_and_pie.vue').default);

// OLD Inputs
Vue.component('dropdown-simple', require('./components/dropdown-simple.vue').default);
Vue.component('dropdown-entity', require('./components/dropdown-entity.vue').default);
Vue.component('dropdown-related', require('./components/dropdown-related.vue').default);
Vue.component('currency-unit', require('./components/currency-unit.vue').default);
Vue.component('administrative-location', require('./components/administrative-location.vue').default);

Vue.component('selector-locality',                      require('./templates_inputs/selector-locality.vue').default);
Vue.component('selector-multiple_keywords',             require('./templates_inputs/selector-multiple_keywords.vue').default);

// Templates inputs (after review)
Vue.component('simple-text',                            require('./templates_inputs/simple-text.vue').default);
Vue.component('simple-textarea',                        require('./templates_inputs/simple-textarea.vue').default);
Vue.component('simple-url',                             require('./templates_inputs/simple-url.vue').default);
Vue.component('simple-email',                           require('./templates_inputs/simple-email.vue').default);
Vue.component('simple-password',                        require('./templates_inputs/simple-password.vue').default);
Vue.component('simple-numeric',                         require('./templates_inputs/simple-numeric.vue').default);
Vue.component('simple-date',                            require('./templates_inputs/simple-date.vue').default);
Vue.component('dropdown',                               require('./templates_inputs/dropdown.vue').default);
Vue.component('toggle',                                 require('./templates_inputs/toggle.vue').default);
Vue.component('checkbox-boolean',                       require('./templates_inputs/checkbox-boolean.vue').default);
Vue.component('upload',                                 require('./templates_inputs/upload.vue').default);
Vue.component('rating',                                 require('./templates_inputs/rating.vue').default);
Vue.component('selector-protected_areas',               require('./templates_inputs/selector-protected_areas.vue').default);
Vue.component('selector-protected_areas_multiple',      require('./templates_inputs/selector-protected_areas_multiple.vue').default);
Vue.component('selector-species_animal',                require('./templates_inputs/selector-species_animal.vue').default);
Vue.component('selector-species_essences',              require('./templates_inputs/selector-species_essences.vue').default);
Vue.component('selector-person',                        require('./templates_inputs/selector-person.vue').default);
Vue.component('selector-responsible',                   require('./templates_inputs/selector-responsible.vue').default);
Vue.component('selector-conventions',                   require('./templates_inputs/selector-conventions.vue').default);
Vue.component('selector-concessions',                   require('./templates_inputs/selector-concessions.vue').default);
Vue.component('selector-institution',                   require('./templates_inputs/selector-institution.vue').default);
Vue.component('selector-typology_pa',                   require('./templates_inputs/selector-typology_pa.vue').default);
Vue.component('multiple-files-upload',                  require('./templates_inputs/multiple-files-upload.vue').default);

// Components
// Vue.component('modal-selector',                         require('./abstract_components/modal-selector.vue').default);


// Components for analytical platform
require('./analytical_platform/components');
