export default {

    data() {
        return {
            map: null,
            extents: null,
            map_loading: false,
            zoomBBoxPadding: 75, // in pixels

            // layer selector
            show_layer_selector: true,
            close_layer_selector_onclick: true,
            layers_selected: 0
        }
    },


    methods: {

        setLoading(){
            let _this = this;
            this.map.on('dataloading', function () {
                _this.map_loading = true;
            });
            this.map.on('data', function () {
                if(_this.map.areTilesLoaded()){
                    _this.map_loading = false;
                }
            });
            this.map.on('error', function () {
                _this.map_loading = false;
            });
        },

        // ###############################################
        // ############  Manage map & layers  ############
        // ###############################################

        initMap: function () {
            let _this = this;

            // Initialize map
            this.map = new window.mapboxgl.Map({
                container: 'platform_map',
                style: 'mapbox://styles/mapbox/streets-v11',
                bounds: this.__getBounds(this.extents['comifac']),
                minZoom: 3,
                maxZoom: 12
            });

            // Add navigation control
            this.map.addControl(new window.mapboxgl.NavigationControl({
                showCompass: false
            }), 'top-right');

            // Add events
            this.map.on('click', function (e) {
                if (_this.close_layer_selector_onclick) {
                    _this.show_layer_selector = false;
                }
            });

            // Set loading spinner events
            this.setLoading();

            this.map.on('load', function () {

                // Add default sources
                _this.map.addSource('countries', window.WebMapping.Mapbox.mapbox_vector_source('countries'));
                _this.map.addSource('protected_areas', window.WebMapping.Mapbox.mapbox_vector_source('protected_areas'));

                // Add countries borders and mask outer regions
                _this.addLayer('comifac_mask', 'overlays');
                _this.addLayer('comifac_eez', 'overlays');
                _this.addLayer('countries', 'overlays');
            });

        },

        layerIsOnMap(layer_id){
            if(this.map!==null){
                return typeof this.map.getLayer(layer_id) !== 'undefined'
            }
            return false
        },

        addLayer(layer_id, group_key){
            if(!this.layerIsOnMap(layer_id)){
                this.map.addLayer(
                    this.layers[group_key][layer_id]
                );
                window.vueBus.$emit('toggle_layer', layer_id, true);
                this.refreshInteractiveLayers();  // must be called after adding main layer
                this.sortLayers();
            }
        },

        removeLayer(layer_id, group_key){
            if(this.layerIsOnMap(layer_id)){
                this.map.removeLayer(layer_id);
                window.vueBus.$emit('toggle_layer', layer_id, false);
                this.refreshInteractiveLayers(); // must be called before removing source
                if(layer_id!=='countries' && layer_id!=='protected_areas'){
                    this.map.removeSource(layer_id);
                }
                this.sortLayers();
            }
        },

        toggleLayer(layer_id, group_key){
            if(this.layerIsOnMap(layer_id)){
                this.layers_selected -= 1;
                this.removeLayer(layer_id, group_key);
            } else {
                this.layers_selected += 1;
                this.addLayer(layer_id, group_key);
            }
        },

        sortLayers(){
            // Move countries borders
            if(this.layerIsOnMap('countries')) {
                this.map.moveLayer('countries');
            }
            if(this.layerIsOnMap('comifac_eez')) {
                this.map.moveLayer('comifac_eez');
            }
            // Move all layers defined in this.layers
            for (let group_key in this.layers) {
                if (this.layers.hasOwnProperty(group_key)) {
                    for (let layer_id in this.layers[group_key]) {
                        if (this.layers[group_key].hasOwnProperty(layer_id)){
                            if(this.layerIsOnMap(layer_id)){
                                this.map.moveLayer(layer_id);
                            }
                            if(this.layerIsOnMap(this.__grayedLayerId(layer_id))){
                                this.map.moveLayer(this.__grayedLayerId(layer_id));
                            }
                            if(this.layerIsOnMap(this.__maskedLayerId(layer_id))){
                                this.map.moveLayer(this.__maskedLayerId(layer_id));
                            }
                        }
                    }
                }
            }
            // Move countries mask
            if(this.layerIsOnMap('countries_mask')) {
                this.map.moveLayer('countries_mask');
            }
        },

        __getBounds(extent){
            return new window.mapboxgl.LngLatBounds(
                new window.mapboxgl.LngLat(extent['minx'], extent['miny']),
                new window.mapboxgl.LngLat(extent['maxx'], extent['maxy'])
            )
        },

        /**
         * Pan e zoom accoridng to level/site selection
         */
        zoomToBBox(bbox){
            this.map.fitBounds(this.__getBounds(bbox), { padding: this.zoomBBoxPadding });
        },

        zoomToFeature(feature){
            let bbox = window.Turf.bbox({
                type: 'FeatureCollection',
                features: [
                    feature
                ]
            });
            this.map.fitBounds(bbox, { padding: this.zoomBBoxPadding });
        },

        // #######################################################
        // ######  Manage dynamic layers' interactivity  #########
        // #######################################################

        refreshInteractiveLayers(){}

    }
}
