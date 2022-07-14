<template>
    <div id="maps" class="align-items-center">
        <div v-if="!no_internet_connection" class="row" style="width:100%;height: 500px">
            <div id="map-load" class="ml-3" style="width:100%; height:500px"></div>
        </div>
        <div v-else class="dopa_not_available">
            {{ error_message }}
        </div>
    </div>
</template>

<script>
export default {
    name: "map_view",
    inject: ['stores'],
    props: {
        pa: {
            type: String,
            default: () => {

            }
        },
        url: {
            type: String,
            default: ''
        }
    },
    data: function () {
        return {
            url_map: `${window.Laravel.baseUrl}admin/imet/scaling_up/analysis/coordinates/{param}`,
            no_internet_connection: false,
            error_message: ''
        }
    },
    async mounted() {
        await this.loadMap();
    },
    methods: {
        retrieveCoords: async function () {
            return await window.axios({
                method: 'POST',
                url: this.url,
                data: {
                    _token: window.Laravel.csrfToken,
                    func: 'get_array_of_custom_names',
                    parameter: this.pa.split(','),
                    scaling_id: this.stores.BaseStore.scaling_up_id
                }
            })
                .then(function (response) {
                    return Object.entries(response.data).map(area => area[1].wdpa_id);
                })
                .catch(function (error) {
                    console.log(error)
                    return null;
                })
        }
        ,
        loadMap: async function (protected_areas) {

            const pa = await this.retrieveCoords();
            if (pa) {
                let biopamaBaseLayer = 'mapbox://styles/jamesdavy/cjw25laqe0y311dqulwkvnfoc';
                let mapPolyHostURL = "https://tiles.biopama.org/BIOPAMA_poly";
                let mapPointHostURL = "https://tiles.biopama.org/BIOPAMA_point";
                let mapPaLayer = "2021_July_ACP";
                const mapPointLayer = "2021_July_ACP_poly_centers";

                window.report_map = new window.mapboxgl.Map({
                    container: `map-load`,
                    style: biopamaBaseLayer,
                    center: [15, 0],
                    zoom: 3,
                    minZoom: 0,
                    maxZoom: 18,
                    preserveDrawingBuffer: true
                });
                window.report_map.on('error', (error) => {
                    if (typeof error.isSourceLoaded === 'undefined') {
                        this.no_internet_connection = true;
                        this.error_message = this.stores.BaseStore.localization('imet-core::analysis_report.error_connection');
                    }
                });
                window.report_map.on('load', function () {
                    window.report_map.addSource("BIOPAMA_Poly", {
                        "type": 'vector',
                        "tiles": [mapPolyHostURL + "/{z}/{x}/{y}.pbf"],
                        "minZoom": 0,
                        "maxZoom": 12,
                    });

                    window.report_map.addLayer({
                        "id": "wdpaSelected",
                        "type": "line",
                        "source": "BIOPAMA_Poly",
                        "source-layer": mapPaLayer,
                        "layout": {"visibility": "visible"},
                        "paint": {
                            "line-color": "#ff0000",
                            "line-width": 2,
                        },
                        "transition": {
                            "duration": 300,
                            "delay": 0
                        }
                    });

                    // window.report_map.addSource("BIOPAMA_Point", {
                    //     "type": 'vector',
                    //     "tiles": [mapPointHostURL + "/{z}/{x}/{y}.pbf"],
                    //     "minZoom": 0,
                    //     "maxZoom": 12,
                    // });
                    //
                    // window.report_map.addLayer({
                    //     "id": "wdpaBase",
                    //     "type": "circle",
                    //     "source": "BIOPAMA_Point",
                    //     "source-layer": mapPointLayer,
                    //     'layout': {
                    //         'visibility': 'visible'
                    //     },
                    //     "minzoom": 1,
                    //     'paint': {
                    //         'circle-radius': 8,
                    //         'circle-color': "#ff0000"
                    //     }
                    // });

                    pa.unshift('WDPAID')
                    pa.unshift('in')
                    //
                    window.report_map.setFilter("wdpaSelected", pa);
                   // window.report_map.setFilter("wdpaBase", pa);

                });

            }
        }
    }
}
</script>
