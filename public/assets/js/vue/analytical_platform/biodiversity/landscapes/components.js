// shared components
Vue.component('klc_toggle', require('./components/klc_toggle.vue').default);

// water
Vue.component('water_klc', require('./water/water_klc.vue').default);
Vue.component('water_protected_areas', require('./water/water_protected_areas.vue').default);
// forest
Vue.component('forest_klc', require('./forest/forest_klc.vue').default);
Vue.component('forest_protected_areas', require('./forest/forest_protected_areas.vue').default);
// carbon
Vue.component('carbon_table', require('./carbon/carbon_table.vue').default);
Vue.component('carbon_stock', require('./carbon/carbon_stock.vue').default);
// land use
Vue.component('land_use', require('./land_use/land_use.vue').default);
Vue.component('land_use_sankey', require('./land_use/land_use_sankey.vue').default);


