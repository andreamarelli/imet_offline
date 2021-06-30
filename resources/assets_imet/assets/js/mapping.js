// Environment variables
window.mapbox_access_token = process.env.MIX_MAPBOX_ACCESS_TOKEN;

// Urls
window.urls = window.urls || {};
window.urls.ofac_mapserver = 'https://ies-ows.jrc.ec.europa.eu/ofac/' + 'ofacgeo.php?';
window.urls.ofac_mapproxy = 'https://www.observatoire-comifac.net/mapproxy/service';
window.urls.ofac_tiles = 'tiles/';
window.urls.dopa_geoserver = 'https://geospatial.jrc.ec.europa.eu/geoserver/dopa_explorer_3/wms';

// Mapping
window.WebMapping = {};
window.WebMapping.Leaflet = require('./mapping_leaflet/utils.js');
window.WebMapping.Leaflet.Layers = require('./mapping_leaflet/layers.js');
window.WebMapping.Mapbox = require('./mapping_mapbox/utils.js');
window.WebMapping.Mapbox.Layers = require('./mapping_mapbox/layers.js');
require('./mapping_mapbox/platform.js');
require('./mapping_mapbox/demo.js');
