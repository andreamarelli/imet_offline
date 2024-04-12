window.ImetCore = {};

// Vue Mixins
window.mixins = {
    'status': require('./js/mixins/save_or_reset.mixin')
};

window.BiopamaWDPA = {
    base_layer: 'mapbox://styles/jamesdavy/cjw25laqe0y311dqulwkvnfoc',

    addWdpaLayer: function(map, wdpa_ids = null, color = null) {

        // Add source: JRC geoserver
        map.addSource("geospatial_jrc", {
            type: 'vector',
            tiles: [
                'https://geospatial.jrc.ec.europa.eu/geoserver/gwc/service/wmts?layer=marxan:wdpa_latest_biopama&tilematrixset=EPSG:900913&Service=WMTS&Request=GetTile&Version=1.0.0&Format=application/x-protobuf;type=mapbox-vector&TileMatrix=EPSG:900913:{z}&TILECOL={x}&TILEROW={y}'
            ],
            'tileSize': 512,
            'scheme': 'xyz',
        });

        color = color || [
            "match",
            ["get", "marine"],
            ["0"],
            "rgba(141, 191, 79, 0.7)",
            "rgba(104, 156, 150, 0.7)"
        ];

        // Add layer: wdpa_latest_biopama
        map.addLayer({
            "id": "biopama_wdpa",
            "type": "fill",
            "source": "geospatial_jrc",
            "source-layer": 'wdpa_latest_biopama',
            "minzoom": 2,
            "paint": {
                "fill-color": color
            }
        });

        // Filter by wdpa_ids
        if(wdpa_ids !== null) {
            wdpa_ids = typeof wdpa_ids === 'string' ? wdpa_ids.split(',') : wdpa_ids;
            wdpa_ids = wdpa_ids
                .map(function (item) {
                    return parseInt(item)
                });
            map.setFilter("biopama_wdpa", ['in', 'wdpaid'].concat(wdpa_ids));
        }
    }

};


// Templates
Vue.component('dopa_chart_bar',                 require('./js/templates/dopa/chart_bar.vue').default);
Vue.component('dopa_indicators_table',          require('./js/templates/dopa/indicators_table.vue').default);
Vue.component('dopa_radar',                     require('./js/templates/dopa/chart_radar.vue').default);
window.ImetCore.Dopa = {
    'chart_bar': require('./js/templates/dopa/chart_bar.vue').default,
    'chart_doughnut': require('./js/templates/dopa/chart_doughnut.vue').default
};
Vue.component('imet_charts',                    require('./js/templates/imet_charts.vue').default);
Vue.component('imet_encoders_responsibles',     require('./js/templates/imet_encoders_responsibles.vue').default);
Vue.component('imet_progress_bar',              require('./js/templates/imet_progress_bar.vue').default);
Vue.component('imet_radar',                     require('./js/templates/imet_radar.vue').default);
Vue.component('imet_bar_chart',                 require('./js/templates/imet_bar_chart.vue').default);

// Inputs
Vue.component('multiple-files-upload',          require('./js/inputs/multiple-files-upload.vue').default);
Vue.component('selector-wdpa',                  require('./js/inputs/selector-wdpa.vue').default);
Vue.component('selector-wdpa_multiple',         require('./js/inputs/selector-wdpa_multiple.vue').default);
Vue.component('selector-user',                  require('./js/inputs/selector-user.vue').default);

// Report
Vue.component('table_input',                    require('./js/report/table_input.vue').default);
Vue.component('roadmap',                    require('./js/report/roadmap.vue').default);
Vue.component('objectives',                    require('./js/report/objectives.vue').default);

// Components for IMET scaling up
require('./js/scaling_up_analysis/components.js');

