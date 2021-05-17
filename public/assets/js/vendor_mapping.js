
window.Turf = require('@turf/turf');
window.Leaflet = require("leaflet");
require("leaflet.markercluster");
require("leaflet.awesome-markers/dist/leaflet.awesome-markers"); // import "leaflet.awesome-markers" fails
require("leaflet-basemaps");
require("leaflet.vectorgrid/dist/Leaflet.VectorGrid.bundled.min");
window.mapboxgl = require('mapbox-gl');
window.mapboxgl.accessToken = process.env.MIX_MAPBOX_ACCESS_TOKEN;