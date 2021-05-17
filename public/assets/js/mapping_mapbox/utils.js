module.exports = {

    tileSize: 1024,
    internalTileSize: 1024,

    mapbox_vector_layer: function(layer_id, label = null, type = 'fill', paint = {}, source_id = null, version = null) {
        return {
            'id': layer_id,
            'type': type,
            'source': source_id || module.exports.mapbox_vector_source(layer_id, version),
            'source-layer': source_id || layer_id,
            'paint': paint,
            label: label
        }
    },

    mapbox_vector_source: function(layer_id, version = null){
        version = version!=null ? '?v='+version : '';
        return {
            'type': 'vector',
            'tiles': [
                window.Laravel.baseUrl + window.urls.ofac_tiles + layer_id + '/{z}/{x}/{y}.pbf' + version
            ]
        }
    },

    mapbox_wms_source: function(wms_url, layer, tile_size){

        wms_url     = wms_url.replace(/\??$/, '?');
        tile_size   = tile_size || module.exports.tileSize;

        let options = wms_url +
            'service=WMS' +
            '&version=1.1.1' +
            '&request=GetMap' +
            '&format=image/png' +
            '&transparent=true' +
            '&styles=' +
            '&layers=' + layer +
            '&width=' + tile_size +
            '&height=' + tile_size +
            '&bbox={bbox-epsg-3857}' +
            '&srs=EPSG:3857';
        return {
            'type': 'raster',
            'tiles': [options],
            'tileSize': tile_size
        };
    },

    /**
     * Get MapServer/MapProxy wms layer
     * @param layer_id
     * @param label
     * @param cache [boolean] (true if should pass by MapProxy)
     * @param custom_attributes
     * @returns {*}
     */
    wms: function(layer_id, label = null, cache = true, custom_attributes = {}){
        let url = cache===true
            ? window.urls.ofac_mapproxy
            : window.urls.ofac_mapserver;

        url = url.replace(/\??$/, '?');

        let options = {
            'id': layer_id,
            'type': 'raster',
            'source': module.exports.mapbox_wms_source(url, layer_id, module.exports.internalTileSize),
            label: label
        };
        if(!_.isEmpty(custom_attributes)){
            for (let [key, value] of Object.entries(custom_attributes)) {
                options[key] = value;
            }
        }
        return options;
    },

};
