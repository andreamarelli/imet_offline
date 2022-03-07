window.ImetCore.ScalingUp = {};

// Loading mixins
window.ImetCore.ScalingUp.Mixins = {
    'resize': require('./mixins/resize.mixin.js').default,
    'ajax': require('./mixins/ajax.mixin.js').default,
    // datatable.scaling.mixin.js NOT USED?
};

Vue.component('app',    require('./components/app.vue').default);

Vue.component('general_info', require('./components/general_info.vue').default);
Vue.component('management_context', require('./components/management_context.vue').default);
Vue.component('grouping', require('./components/grouping.vue').default);
Vue.component('map_view',    require('./components/map_view.vue').default);
Vue.component('preview_template',    require('./components/preview_template.vue').default);

Vue.component('container', require('./components/containers/container.vue').default);
Vue.component('container_view', require('./components/containers/container_view.vue').default);
Vue.component('container_analysis_management_cycle', require('./components/container_analysis_management_cycle.vue').default);
Vue.component('container_section',    require('./components/containers/container_section.vue').default);
Vue.component('container_radars', require('./components/containers/container_radars.vue').default);
Vue.component('container_upper_lower_radars', require('./components/containers/container_upper_lower_radars.vue').default);
Vue.component('container_actions', require('./components/containers/container_actions.vue').default);

Vue.component('datatable_custom', require('./components/datatables/datatable_custom.vue').default);
Vue.component('datatable_interact_with_radar', require('./components/datatables/datatable_interact_with_radar.vue').default);
Vue.component('datatable_interact_with_scatter', require('./components/datatables/datatable_interact_with_scatter.vue').default);
Vue.component('datatable_scaling', require('./components/datatables/datatable_scaling.vue').default);

Vue.component('bar', require('./components/bar_charts/bar.vue').default);
Vue.component('bar_reverse', require('./components/bar_charts/bar_reverse.vue').default);
Vue.component('bar_category_stack', require('./components/bar_charts/bar_category_stack.vue').default);
Vue.component('imet_bar_error',    require('./components/bar_charts/imet_bar_error.vue').default);

Vue.component('scaling_radar', require('./components/various_charts/scaling_radar.vue').default);
Vue.component('treemap', require('./components/various_charts/treemap.vue').default);
Vue.component('scaling_dopa_chart_bar',    require('./components/various_charts/scaling_dopa_chart_bar.vue').default);
Vue.component('scaling_dopa_chart_doughnut',    require('./components/various_charts/scaling_dopa_chart_doughnut.vue').default);
Vue.component('scatter',    require('./components/various_charts/scatter.vue').default);
Vue.component('radar_threats', require('./components/various_charts/radar_threats.vue').default);

Vue.component('action_buttons',    require('./components/action_buttons.vue').default);
Vue.component('html_to_image', require('./tools/html_to_image.vue').default);

Vue.component('basket', require('./components/basket.vue').default);
Vue.component('guidance',    require('./components/guidance.vue').default);

Vue.component('small_menu',    require('./components/menus/small_menu.vue').default);
Vue.component('small_menu_analysis_per_elements',    require('./components/menus/small_menu_analysis_per_elements.vue').default);


Vue.component('imet_basic_bars',        require('./components/imet_basic_bars.vue').default);
Vue.component('action-button',          require('./components/action-button.vue').default);
Vue.component('action-button-cookie',   require('./components/action-button-cookie.vue').default);
Vue.component('label-cloud',            require('./components/label-cloud.vue').default);
Vue.component('dopa_coverage_table',            require('./components/dopa_coverage_table.vue').default);
Vue.component('checkboxes_list', require('./components/checkboxes_list.vue').default);

