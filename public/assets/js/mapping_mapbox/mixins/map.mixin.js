export default {

    data() {
        return {
            map: null,
            extents: null,
            map_loading: false,
            zoomBBoxPadding: 75, // in pixels

            all_layers: {},
            thematic_layer: null,   // layer associated with current theme/level selection
            exclusive_active_layer: null,

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

        // ##########################################
        // ##############  Manage map  ##############
        // ##########################################

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
                _this.map.addSource('protected_areas', window.WebMapping.Mapbox.mapbox_vector_source('protected_areas', '2021-05-05'));

                // Add countries borders and mask outer regions
                _this.addLayerToMap(_this.all_layers['comifac_mask']);
                _this.addLayerToMap(_this.all_layers['comifac_eez']);
                _this.addLayerToMap(_this.all_layers['countries']);
            });

        },

        __getBounds(extent){
            return new window.mapboxgl.LngLatBounds(
                new window.mapboxgl.LngLat(extent['minx'], extent['miny']),
                new window.mapboxgl.LngLat(extent['maxx'], extent['maxy'])
            )
        },

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

        // #########################################
        // ############  Manage layers  ############
        // #########################################

        layerIsOnMap(layer_id){
            if(this.map!==null){
                return typeof this.map.getLayer(layer_id) !== 'undefined'
            }
            return false
        },

        addLayerToMap(layer){
            if(!this.layerIsOnMap(layer.id)){
                // If "exclusive" layer
                if(layer.hasOwnProperty('exclusive') && layer.exclusive) {
                    // remove existing exclusive layer and add to store
                    if(this.exclusive_active_layer!==null){
                        this.removeLayerFromMap(this.exclusive_active_layer);
                    }
                    this.exclusive_active_layer = layer;
                    // hide thematic layer (if any)
                    if(this.thematic_layer!==null){
                        this.removeLayerFromMap(this.thematic_layer);
                    }
                }
                // "data-driven": only add layer to map
                if(layer.hasOwnProperty('data_driven') && layer.data_driven){
                    this.map.addLayer(layer);
                }
                // standard layer
                else {
                    this.map.addLayer(layer);
                    window.vueBus.$emit('toggle_layer', layer.id, true);
                    this.refreshInteractiveLayers();  // must be called after adding main layer
                    this.sortLayers();
                }
            }
        },

        removeLayerFromMap(layer){
            if(this.layerIsOnMap(layer.id)){
                // If "exclusive" layer
                if(layer.hasOwnProperty('exclusive') && layer.exclusive) {
                    // remove from store
                    this.exclusive_active_layer = null;
                    // show thematic layer (if any)
                    if(this.thematic_layer!==null){
                        this.addLayerToMap(this.thematic_layer);
                    }
                }
                // "data-driven": only remove from map
                if(layer.hasOwnProperty('data_driven') && layer.data_driven){
                    this.map.removeLayer(layer.id);
                    window.vueBus.$emit('toggle_layer', layer.id, false);
                }
                // standard layer
                else {
                    this.map.removeLayer(layer.id);
                    window.vueBus.$emit('toggle_layer', layer.id, false);
                    this.refreshInteractiveLayers(); // must be called before removing source
                    if(layer.id!=='countries' && layer.id!=='protected_areas'){
                        this.map.removeSource(layer.id);
                    }
                    this.sortLayers();
                }
            }
        },

        toggleLayer(layer){
            if(this.layerIsOnMap(layer.id)){
                this.removeLayerFromMap(layer);
            } else {
                this.addLayerToMap(layer);
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
            // Move all layers defined in this.all_layers
            for (let layer_id in this.all_layers) {
                if (this.all_layers.hasOwnProperty(layer_id)) {
                    if (this.layerIsOnMap(layer_id)) {
                        this.map.moveLayer(layer_id);
                    }
                    if (this.layerIsOnMap(this.__grayedLayerId(layer_id))) {
                        this.map.moveLayer(this.__grayedLayerId(layer_id));
                    }
                    if (this.layerIsOnMap(this.__maskedLayerId(layer_id))) {
                        this.map.moveLayer(this.__maskedLayerId(layer_id));
                    }
                }
            }

            // Move countries mask
            if(this.layerIsOnMap('countries_mask')) {
                this.map.moveLayer('countries_mask');
            }
        },

        refreshThematicLayer(){
            if(this.thematic_layer!==null){
                this.removeLayerFromMap(this.thematic_layer);
                this.thematic_layer = null;
            }
            if(this.level==='concessions'
                || this.level==='klc'
                || this.level==='protected_areas'){
                let layer = this.all_layers[this.level];
                this.thematic_layer = layer;
                this.addLayerToMap(layer);
            }
        },

        refreshExclusiveLayers(){
            if(this.exclusive_active_layer!==null){
                this.removeLayerFromMap(this.exclusive_active_layer);
                this.exclusive_active_layer = null;
            }
        },

        refreshInteractiveLayers(){}

    }
}
