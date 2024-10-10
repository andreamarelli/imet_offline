<template>

    <div>
        <div v-if="show_loader">
            <i class="fa fa-spinner fa-spin text-primary-800"></i>
            <span class="sr-only">Loading...</span>
        </div>

        <div v-else>
            <div v-if="error_returned" class="dopa_not_available"
                v-html="stores.BaseStore.localization('entities.dopa_not_available')"></div>
            <div v-else-if="timeout" class="dopa_not_available"
                v-html="stores.BaseStore.localization('entities.dopa_not_available')"></div>
            <div v-else-if="error_wrong" class="dopa_not_available"
                v-html="stores.BaseStore.localization('imet-core::analysis_report.error_wrong')"></div>
            <div v-else class="container-menu">
                <slot :props="data"></slot>
            </div>
        </div>
    </div>

</template>

<script setup>
import { onMounted, watch, inject, defineProps, ref } from "vue";
import { useAjax } from "../../composables/ajax";
import { commonProps } from "./common/props";

const show_loader = ref(false);
const timeout = ref(false);
const error_returned = ref(false);
const error_wrong = ref(false);
const data = ref([]);
const props = defineProps({
    ...commonProps,
    on_load: {
        type: Boolean,
        default: true
    },
    load_container: {
        type: Boolean,
        default: true
    },
    on_load_even: {
        type: String,
        default: null
    },
    trigger_incoming_data: {
        type: Object,
        default: null
    },
    randomKeyEvent: {
        type: String,
        default: ''
    }
});

const stores = inject('stores');
const emitter = inject('emitter');
const component_data = {
    func: props.func,
    url: props.url,
    method: props.method,
    on_load: props.on_load,
    loaded_at_once: props.loaded_at_once,
    parameters: Array.isArray(props.parameters) ? props.parameters?.slice(0, -1) : props.parameters,
    stores,
    trigger_incoming_data: props.trigger_incoming_data,
    success,
    error
};

let { init, on_event_load } = useAjax(component_data);

watch(() => props.loaded_at_once, async (newVal) => {
    if (newVal) {
        show_loader.value = true;
        try {
            await init();
        } catch (error) {
            console.error(error);
            show_loader.value = false;
        } finally {

        }
    }
}, { deep: true });

watch(() => props.trigger_incoming_data, async (newVal) => {
    if (newVal) {
        show_loader.value = true;
        try {
            await on_event_load(newVal);
        } catch (error) {
            console.error(error);
            show_loader.value = false;
        } finally {

        }
    }
}, { deep: true });

onMounted(async () => {
    if (props.loaded_at_once === true) {
        show_loader.value = true;
        try {
            await init();
        } catch (error) {
            console.error(error);
            show_loader.value = false;
        } finally {

        }
    }
});


function success(response, loader = false) {
    show_loader.value = loader;
    if (response.status === false) {
        timeout.value = true;
        return;
    }
    if (typeof response === 'object') {
        data.value = response.data;

        if (props.on_load_even !== null) {
            emitter.on('component_loaded');
        }
    } else {
        error_returned.value = true;
    }
}

function error(response) {
    show_loader.value = false;
    if (!response.response)
        error_wrong.value = true;
    else if (response.status === false) {
        timeout.value = true;
    } else if (response.code === 'ECONNABORTED')
        timeout.value = true;
    else if (response.response.status === 500)
        error_wrong.value = true;
}

</script>
