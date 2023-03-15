window.ImetCore = {};

// Vue Mixins
window.mixins = {
    'status': require('./js/mixins/save_or_reset.mixin')
};

// Templates
Vue.component('dopa_chart_bar',                 window.ModularForms.Dopa.chart_bar);
Vue.component('dopa_indicators_table',          window.ModularForms.Dopa.indicators_table);
Vue.component('dopa_radar',                     window.ModularForms.Dopa.chart_radar);
Vue.component('imet_charts',                    require('./js/templates/imet_charts.vue').default);
Vue.component('imet_encoders_responsibles',     require('./js/templates/imet_encoders_responsibles.vue').default);
Vue.component('imet_progress_bar',              require('./js/templates/imet_progress_bar.vue').default);
Vue.component('imet_radar',                     require('./js/templates/imet_radar.vue').default);
Vue.component('imet_bar_chart',                 require('./js/templates/imet_bar_chart.vue').default);

// Inputs
Vue.component('multiple-files-upload',          require('./js/inputs/multiple-files-upload.vue').default);
Vue.component('selector-wdpa',                  require('./js/inputs/selector-wdpa.vue').default);
Vue.component('selector-wdpa_multiple',         require('./js/inputs/selector-wdpa_multiple.vue').default);
Vue.component('selector-user',                  require('./js/inputs/selector-user.vue').default);

// Report
Vue.component('table_input',                    require('./js/report/table_input.vue').default);
Vue.component('roadmap',                    require('./js/report/roadmap.vue').default);

// Components for IMET scaling up
require('./js/scaling_up_analysis/components.js');
