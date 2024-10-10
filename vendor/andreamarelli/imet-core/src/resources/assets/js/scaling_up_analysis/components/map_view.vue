<template>
    <div id="maps" class="align-items-center">
        <div v-if="!no_internet_connection" style="width:100%; height: 700px">
            <div id="map-load" class="ml-3" style="width:100%; height: 650px"></div>
        </div>
        <div v-else class="dopa_not_available">
            {{ error_message }}
        </div>
    </div>
</template>
<script setup>
import { inject, ref, onMounted } from 'vue';
import BiopamaWDPA from '../../helpers/biopamaWDPA';

const stores = inject('stores');

const props = defineProps({
    form_ids: {
        type: String,
        default: () => { }
    },
    url: {
        type: String,
        default: ''
    }
});

const no_internet_connection = ref(false);
const error_message = ref('');

onMounted(async () => {
    await loadMap();
});

const retrieveWdpaIDs = async () => {
    return fetch(props.url, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": window.Laravel.csrfToken,
        },
        body: JSON.stringify({
            func: 'get_wdpas_by_form_id',
            parameter: props.form_ids.split(','),
            scaling_id: stores.BaseStore.scaling_up_id
        })
    })
        .then(response => response.json())
        .then(data => Object.values(data).map(item => item.wdpa_id))
        .catch(error => {
            console.log(error)
            return null;
        })
};

const loadMap = async () => {
    const wdpa_ids = await retrieveWdpaIDs();

    if (wdpa_ids) {
        const report_map = new window.mapboxgl.Map({
            container: `map-load`,
            style: BiopamaWDPA.base_layer,
            center: [30, 0],
            zoom: 4,
            minZoom: 2,
            maxZoom: 12,
            preserveDrawingBuffer: true,
            attributionControl:false
        });

        report_map.on('error', (error) => {
            if (typeof error.isSourceLoaded === 'undefined') {
                no_internet_connection.value = true;
                error_message.value = stores.BaseStore.localization('imet-core::analysis_report.error_connection');
            }
        });

        report_map.on('load', function () {
            BiopamaWDPA.addWdpaLayer(report_map, wdpa_ids, 'rgba(255, 0, 0, 0.7)');
        });
    }
};
</script>
