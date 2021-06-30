
window._ = require('lodash');
window.axios = require('axios');
window.$ = window.jQuery = require('jquery');

require('bootstrap');
require('bootstrap-select');
require('bootstrap-datepicker');

require('select2');
require('select2/dist/js/i18n/fr');
$.fn.select2.defaults.set("theme", "bootstrap");
$.fn.select2.defaults.set("language", Lang.getLocale());

window.echarts = require('echarts');
window.gradstop = require('gradstop');

// Vue
window.Vue = require('vue');
window.vueBus = new Vue();


// Vuex
window.Vuex = require('vuex');
window.Vue.use(window.Vuex);

