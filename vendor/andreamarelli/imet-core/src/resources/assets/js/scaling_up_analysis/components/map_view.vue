<template>
    <div id="maps" class="align-items-center">
        <div v-if="!no_internet_connection" style="width:100%; height: 500px">
            <div id="map-load" class="ml-3" style="width:100%; height: 500px"></div>
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
        form_ids: {
            type: String,
            default: () => {}
        },
        url: {
            type: String,
            default: ''
        }
    },
    data: function () {
        return {
            no_internet_connection: false,
            error_message: ''
        }
    },
    async mounted() {
        await this.loadMap();
    },
    methods: {
        retrieveWdpaIDs: async function () {
            return fetch(this.url, {
                method: 'POST',
                headers: {
                  "Content-Type": "application/json",
                  "X-CSRF-Token": window.Laravel.csrfToken,
                },
                body: JSON.stringify({
                  func: 'get_wdpas_by_form_id',
                  parameter: this.form_ids.split(','),
                  scaling_id: this.stores.BaseStore.scaling_up_id
                })
            })
                .then((response) => response.json())
                .then(function (data) {
                    return Object.values(data).map(item => item.wdpa_id);
                })
                .catch(function (error) {
                    console.log(error)
                    return null;
                })
        }
        ,
        loadMap: async function () {

            const wdpa_ids = await this.retrieveWdpaIDs();

            if (wdpa_ids) {

                window.report_map = new window.mapboxgl.Map({
                    container: `map-load`,
                    style: window.BiopamaWDPA.base_layer,
                    center: [30, 0],
                    zoom: 4,
                    minZoom: 2,
                    maxZoom: 12,
                    preserveDrawingBuffer: true
                });

                window.report_map.on('error', (error) => {
                    if (typeof error.isSourceLoaded === 'undefined') {
                        this.no_internet_connection = true;
                        this.error_message = this.stores.BaseStore.localization('imet-core::analysis_report.error_connection');
                    }
                });

                window.report_map.on('load', function () {
                    window.BiopamaWDPA.addWdpaLayer(window.report_map, wdpa_ids, 'rgba(255, 0, 0, 0.7)');
                });

            }
        }
    }
}
</script>
