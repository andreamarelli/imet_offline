// Utilities & frameworks
window._ = require('lodash');
window.axios = require('axios');
window.$ = window.jQuery = require('jquery');

// Temporary replacement for mariuzzo/laravel-js-localization (need to wait support for packages loadTranslationsFrom method)
// Pull request #149 (https://github.com/rmariuzzo/Laravel-JS-Localization/pull/149)
import I18n from 'vendor/conedevelopment/i18n/resources/js/I18n.js';
window.I18n = I18n;

// Vue
window.Vue = require('vue').default;
window.vueBus = new window.Vue();

// Vuex
window.Vuex = require('vuex');
window.Vue.use(window.Vuex);

// Bootstrap + related packages
require('bootstrap');
require('bootstrap-select');
require('bootstrap-datepicker');
require('select2');
require('select2/dist/js/i18n/fr');
window.$.fn.select2.defaults.set("theme", "bootstrap");

// Other packages
window.AutoNumeric = require('autonumeric');
window.echarts = require('echarts');
window.CKEditor = require( '@ckeditor/ckeditor5-vue' )
window.ClassicEditor = require( '@ckeditor/ckeditor5-build-classic' )
