
window.Laravel = window.Laravel || {};
window.ModularForms = {};

// Loading mixins
window.ModularForms.Mixins = {
    'Animation': require('./js/mixins/animation.js').default,
    'Cookies': require('./js/mixins/cookie.js').default,
    'Input': require('./js/mixins/input.js').default,
    'Locale': require('./js/mixins/locale.js').default
};
window.ModularForms.MixinsVue = {
    'checkboxes': require('./js/mixins-vue/checkboxes.mixin.js').default,
    'dropdown': require('./js/mixins-vue/dropdown.mixin').default,
    'filter': require('./js/mixins-vue/filter.mixin').default,
    'paginate': require('./js/mixins-vue/paginate.mixin').default,
    'sorter': require('./js/mixins-vue/sorter.mixin').default,
    'tooltip': require('./js/mixins-vue/tooltip.mixin').default,
    'values': require('./js/mixins-vue/values.mixin').default
};
window.ModularForms.FiltersVue = {
    'pretty_number': require('./js/mixins-vue/filters/pretty_number.js').default,
};

window.Locale = window.ModularForms.Mixins.Locale; // Alias

// Load Vuex Store
require('./js/store/store.js'); // window.ModularForms.formStore

// Load components
require('./js/module/controller.js');  // window.ModularForms.ModuleController
require('./js/table/sortable.js');     // window.ModularForms.SortableTable

// Load TEMPLATES components
window.ModularForms.Template = {
    'flag': require('./js/templates/flag.vue').default,
    'redlist_category': require('./js/templates/redlist_category.vue').default
};
window.ModularForms.Dopa = {
    'chart_bar': require('./js/templates/dopa/chart_bar.vue').default,
    'chart_doughnut': require('./js/templates/dopa/chart_doughnut.vue').default,
    'chart_radar': require('./js/templates/dopa/chart_radar.vue').default,
    'chart_stacked_area': require('./js/templates/dopa/chart_stacked_area.vue').default,
    'indicators_table': require('./js/templates/dopa/indicators_table.vue').default,
};

window.Vue.component('date', require('./js/templates/date.vue').default);
window.Vue.component('flag', window.ModularForms.Template.flag);
window.Vue.component('gauge', require('./js/templates/gauge.vue').default);
window.Vue.component('last_update', require('./js/templates/last_update.vue').default);
window.Vue.component('progress_bar', require('./js/templates/progress_bar.vue').default);
window.Vue.component('redlist_category', window.ModularForms.Template.redlist_category);
window.Vue.component('redlist_link', require('./js/templates/redlist_link.vue').default);
window.Vue.component('user', require('./js/templates/user.vue').default);

// Load INPUT "abstract" component
window.ModularForms.Input = {
    'modalSelector': require('./js/inputs/components/modal-selector.vue').default,
    'modalApiSearch': require('./js/inputs/components/modal-api-search.vue').default,
    'modalApiSearchWithAdd': require('./js/inputs/components/modal-api-search-AddElement.vue').default
};

// Load INPUT components
window.Vue.component('checkbox-boolean', require('./js/inputs/checkbox-boolean.vue').default);
window.Vue.component('dropdown', require('./js/inputs/dropdown.vue').default);
window.Vue.component('editor', require('./js/inputs/editor.vue').default);
window.Vue.component('rating', require('./js/inputs/rating.vue').default);
window.Vue.component('simple-date', require('./js/inputs/simple-date.vue').default);
window.Vue.component('simple-email', require('./js/inputs/simple-email.vue').default);
window.Vue.component('simple-numeric', require('./js/inputs/simple-numeric.vue').default);
window.Vue.component('simple-password', require('./js/inputs/simple-password.vue').default);
window.Vue.component('simple-text', require('./js/inputs/simple-text.vue').default);
window.Vue.component('simple-textarea', require('./js/inputs/simple-textarea.vue').default);
window.Vue.component('simple-url', require('./js/inputs/simple-url.vue').default);
window.Vue.component('selector-species_animal', require('./js/inputs/selector-species_animal.vue').default);
window.Vue.component('toggle', require('./js/inputs/toggle.vue').default);
window.Vue.component('upload', require('./js/inputs/upload.vue').default);

// Load INPUT components (old - to be reviewed/deleted)
window.Vue.component('currency-unit', require('./js/inputs-old/currency-unit.vue').default);
window.Vue.component('dropdown-entity', require('./js/inputs-old/dropdown-entity.vue').default);
window.Vue.component('dropdown-related', require('./js/inputs-old/dropdown-related.vue').default);
window.Vue.component('dropdown-simple', require('./js/inputs-old/dropdown-simple.vue').default);
