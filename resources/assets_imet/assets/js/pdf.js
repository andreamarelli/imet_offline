
window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
window.echarts = require('echarts');

// Common Utilities
window.Locale = require('./utils/locale.js');
window.WebMapping.Leaflet = require('./mapping_leaflet/utils.js');

// vendor
require("leaflet");
require("leaflet.markercluster");
require("leaflet.awesome-markers/dist/leaflet.awesome-markers"); // import "leaflet.awesome-markers" fails

