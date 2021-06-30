export default {

    data() {
        return {
            hover_feature: [],
            popup: null,
            popup_features: [],
            click_coords: null
        }
    },

    methods: {

        // ########  Highlight filtered features  ######

        setHighlight(layer_id, condition, filter_attribute, filter_value){
            if(this.layerIsOnMap(layer_id)) {
                if (condition) {
                    this.addGrayedLayer(layer_id);
                    this.map.setFilter(layer_id, ['==', filter_attribute, filter_value]);
                    this.map.setFilter(this.__grayedLayerId(layer_id), ['!=', filter_attribute, filter_value]);
                } else {
                    this.removeGrayedLayer(layer_id);
                    this.map.setFilter(layer_id, true);
                }
            } else {
                this.removeGrayedLayer(layer_id);
            }
        },

        __grayedLayerId(layer_id){
            return layer_id + '_grayed';
        },

        addGrayedLayer(layer_id){
            if(!this.layerIsOnMap(this.__grayedLayerId(layer_id))){
                this.map.addLayer({
                    'id': this.__grayedLayerId(layer_id),
                    'type': 'fill',
                    'source': layer_id,
                    'source-layer': layer_id,
                    'paint': {
                        "fill-color": 'rgba(180, 180, 180, 0.5)',
                    },
                });
            }
        },

        removeGrayedLayer(layer_id){
            if(this.layerIsOnMap(this.__grayedLayerId(layer_id))){
                this.map.removeLayer(this.__grayedLayerId(layer_id));
            }
        },


        // ########  Mask unwanted features  ######

        setMask(layer_id, condition, filter_attribute, filter_value){
            if(this.layerIsOnMap(layer_id)) {
                if (filter_value !== null && condition) {
                    this.addMaskedLayer(layer_id);
                    this.map.setFilter(this.__maskedLayerId(layer_id), ['!=', filter_attribute, filter_value]);
                } else {
                    this.removeMaskedLayer(layer_id);
                }
            } else {
                this.removeMaskedLayer(layer_id);
            }
        },

        __maskedLayerId(layer_id){
            return layer_id + '_masked';
        },

        addMaskedLayer(layer_id){
            if(!this.layerIsOnMap(this.__maskedLayerId(layer_id))){
                this.map.addLayer({
                    'id': this.__maskedLayerId(layer_id),
                    'type': 'fill',
                    'source': layer_id,
                    'source-layer': layer_id,
                    'paint': {
                        "fill-color": 'rgba(0, 0, 0, 0.5)',
                        "fill-outline-color": 'rgba(0, 0, 0, 0.5)',
                    },
                });
            }
        },

        removeMaskedLayer(layer_id){
            if(this.layerIsOnMap(this.__maskedLayerId(layer_id))){
                this.map.removeLayer(this.__maskedLayerId(layer_id));
            }
        },

        // ########  Highlight on mouse hover  ######

        mouseOver(layer_id){
            let _this = this;
            if(_this.layerIsOnMap(layer_id)) {
                _this.hover_feature[layer_id] = _this.hover_feature[layer_id] || [];
                this.map.on('mousemove', layer_id, function (evt) {
                    if (!_this.hover_feature[layer_id].includes(evt.features[0].id)) {
                        _this.hover_feature[layer_id].forEach(function(feature_id){
                            _this._featureHoverOff(layer_id, feature_id);
                        });
                        _this._featureHoverOn( layer_id, evt.features[0].id);
                    }
                });
                this.map.on('mouseleave', layer_id, function () {
                    _this.hover_feature[layer_id].forEach(function(feature_id){
                        _this._featureHoverOff(layer_id, feature_id);
                    });
                });
            }
        },

        __setFeatureHover(feature_id, layer_id, hover){
            this.map.setFeatureState({
                source: layer_id,
                sourceLayer: layer_id,
                id: feature_id
            }, {
                hover: hover
            });
        },

        _featureHoverOn(layer_id, feature_id){
            this.hover_feature[layer_id].push(feature_id);
            this.__setFeatureHover(feature_id, layer_id, true);
            this.map.getCanvas().style.cursor = 'pointer';
        },
        _featureHoverOff(layer_id, feature_id){
            if (this.hover_feature[layer_id].includes(feature_id)) {
                this.__setFeatureHover(feature_id, layer_id, false);
                this.map.getCanvas().style.cursor = '';
                this.hover_feature[layer_id].splice(this.hover_feature[layer_id].indexOf(feature_id), 1);
            }
        },

        hoverOnRelatedLayer(hover_layer_id, related_layer_id, hover_layer_filter_attribute, related_layer_filter_attribute){
            let _this = this;
            if(_this.layerIsOnMap(hover_layer_id) && _this.layerIsOnMap(related_layer_id)) {
                _this.hover_feature[hover_layer_id] = _this.hover_feature[hover_layer_id] || [];
                _this.hover_feature[related_layer_id] = _this.hover_feature[related_layer_id] || [];
                this.map.on('mousemove', hover_layer_id, function (evt) {
                    let related_features_ids = _this.map.querySourceFeatures(related_layer_id, {
                        sourceLayer: related_layer_id,
                        filter: ['==', related_layer_filter_attribute, evt.features[0].properties[hover_layer_filter_attribute]]
                    }).map(({ id }) => id);
                    _this.hover_feature[related_layer_id].forEach(function(feature_id){
                        if(!related_features_ids.includes(feature_id)){
                            _this._featureHoverOff(related_layer_id, feature_id);
                        }
                    });
                    related_features_ids.forEach(function (feature_id) {
                        if (!_this.hover_feature[related_layer_id].includes(feature_id)) {
                            _this._featureHoverOn(related_layer_id, feature_id);
                        }
                    });
                });
                this.map.on('mouseleave', hover_layer_id, function () {
                    _this.hover_feature[related_layer_id].forEach(function(feature_id){
                        _this._featureHoverOff(related_layer_id, feature_id);
                    });
                });
            }
        },

        // ########  Popup  ######

        showPopup(layer_id){
            let _this = this;
            if(_this.layerIsOnMap(layer_id)) {
                _this.map.on('click', layer_id, function (evt) {
                    _this.removeLayerPopup(evt);
                    // Collect all clicked features
                    _this.click_coords = evt.lngLat;
                    evt.features.forEach(function (feature) {
                        let ids = _this.popup_features.map(a => a.id);
                        if (!ids.includes(feature.id)) {
                            _this.popup_features.push(feature);
                        }
                    });

                    // Build popUp content
                    let popup_content = '';
                    _this.popup_features.forEach(function (feature, feature_index) {
                        popup_content +=
                            '<div class="popup-item" id="popup-item_' + feature_index + '">' +
                            _this.featurePopupDescription(feature) +
                            _this.featurePopupActions(feature) +
                            '</div>';
                    });

                    _this.popup = new window.mapboxgl.Popup()
                        .setLngLat(evt.lngLat)
                        .setHTML(popup_content)
                        .addTo(_this.map);

                    // Add manually the EventListener. v-on directive on button added by mapboxgl.Popup (after VUeJS render) does not work.
                    document.querySelectorAll('.mapboxgl-popup .popup-item')
                        .forEach(function (popup_item) {
                            let popup_features_index = popup_item.id.replace('popup-item_', '');
                            let button = popup_item.querySelector('button.getAPI');
                            if (button !== null) {
                                button.addEventListener('click', (event) => {
                                    let feature = _this.popup_features[popup_features_index];
                                    _this.zoomToFeature(feature);
                                    _this.getAPI(feature.id);
                                });
                            }
                        });
                });
            }
        },

        removeLayerPopup(evt = null){
            if(this.popup!==null){
                this.popup.remove();
            }
            this.popup = null;
            if(evt===null || (this.click_coords!=null && this.click_coords!==evt.lngLat)){
                this.popup_features = [];
            }
        },

        featurePopupDescription(feature){
            // console.log(feature.properties);
            if(feature.layer.id === 'countries'){
                return '<i>' + this.Locale.getLabel('mapping.platform.sites.countries', 1) + '</i><br />' +
                    '<b class="green">' + feature.properties.name_fr + '</b>';
            }
            else{
                return '<i>' + this.Locale.getLabel('mapping.platform.sites.'+feature.layer.id, 1) + '</i><br />' +
                    '<b class="green">' + feature.properties.name + '</b>';
            }
        },

        featurePopupActions(feature){
            if(feature.layer.id === this.level){
                return '<div class="popup-footer">' +
                    '<button class="btn btn-sm act-btn-basic getAPI">' + this.Locale.getLabel('mapping.platform.analysis') + '</button>' +
                    '</div>';
            }
            return '';
        },

    }
}