module.exports = {

    tileSize: 1024,

    /**
     * Get MapProxy wms layer
     * @param layer_name
     * @param label
     * @param custom_attributes
     * @returns {*}
     */
    mapproxy_wms: function(layer_name, label = null, custom_attributes = {}){
        let self = this;
        let options = {
            layers: layer_name,
            format: 'image/png',
            transparent: true,
            tileSize: self.tileSize,
            label: label
        };
        if(!_.isEmpty(custom_attributes)){
            for (let [key, value] of Object.entries(custom_attributes)) {
                options[key] = value;
            }
        }
        return window.Leaflet.tileLayer.wms(window.urls.ofac_mapproxy, options);
    },

    vector_tiles: function(layer_name, label = null, custom_attributes = {}) {

        let bounds = window.Leaflet.latLngBounds(
            window.Leaflet.latLng(-11.125875, 5.566434),
            window.Leaflet.latLng(17.936017, 30.837150)
        );

        return window.Leaflet.vectorGrid.protobuf('https://h03-stg-ofac.jrc.it/tiles/'+layer_name+'/{z}/{x}/{y}.pbf', {
            vectorTileLayerStyles: {
                protected_area: {
                    color: '#ff6666',
                    opacity: 0.6,
                    weight: 2,
                    fillColor: '#ffaaaa',
                    fillOpacity: 0.6,
                    fill: true
                }
            },
            bounds: bounds,
            key: 'protected_area',
            id: 'protected_area',
            label: label
        });
    },

    /**
     * Get OFAC wms layer
     * @param layer_name
     * @param label
     * @param custom_attributes
     * @returns {*}
     */
    mapserver_wms: function(layer_name, label = null, custom_attributes = {}){
        let self = this;
        let options = {
            layers: layer_name,
            format: 'image/png',
            transparent: true,
            tileSize: self.tileSize,
            label: label
        };
        if(!_.isEmpty(custom_attributes)){
            for (let [key, value] of Object.entries(custom_attributes)) {
                options[key] = value;
            }
        }
        return window.Leaflet.tileLayer.wms(window.urls.ofac_mapserver, options);
    },

    /**
     * Get Mapbox layer
     * @param style
     * @param label
     */
    mapbox_layer: function(style, label = null){

        style = style==='streets' ? 'streets-v11' : style;
        style = style==='light' ? 'light-v10' : style;
        style = style==='satellite' ? 'satellite-v9' : style;

        let self = this;
        return window.Leaflet.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token='+window.mapbox_access_token, {
            tileSize: 512,
            maxZoom: 18,
            zoomOffset: -1,
            id: 'mapbox/'+style,
            attribution: 'Map data &copy; <a target="_blank" href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                '<a target="_blank" href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a target="_blank" href="http://mapbox.com">Mapbox</a>',
            label: label
        });
    },

    /**
     * Projects platform: get marker-cluster
     * @param points
     */
    project_markerCluster: function(points, label){
        let marker_cluster = window.Leaflet.markerClusterGroup({
            iconCreateFunction: function (cluster) {
                return new window.Leaflet.DivIcon({
                    html: '<div><span class="marker-count">' + cluster.getChildCount() + '</span></div>', className: 'marker-cluster', iconSize: new window.Leaflet.Point(40, 40)
                });
            },
            showCoverageOnHover: false,
            zoomToBoundsOnClick: false,
            label: label
        });

        points.forEach(function(project) {
            let [lat, lon, popupInfo, title, status] = project;
            let icon = 'asterisk';
            let color = 'lightgray';
            if(status==='finished'){
                color = 'red';
            } else if(status==='ongoing'){
                color = 'green';
            } else if(status==='planned'){
                color = 'orange';
            }

            let marker = window.Leaflet.marker(new window.Leaflet.LatLng(lat, lon), {
                title: title,
                icon: window.Leaflet.AwesomeMarkers.icon({
                    markerColor: color,
                    prefix: 'fa',
                    icon: icon,
                    iconColor: 'white'
                })
            });

            marker.bindPopup(popupInfo);
            marker_cluster.addLayer(marker);

        });

        return marker_cluster;
    },

    getLayersForLeaftletControl(layers){
        let result = {};
        layers.forEach(function(layer) {
            result[layer.options.label] = layer;
        });
        return result;
    },

};