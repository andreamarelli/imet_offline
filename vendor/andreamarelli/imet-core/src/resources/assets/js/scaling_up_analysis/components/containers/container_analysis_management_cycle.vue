<template>
    <div>
        <div @click="toggle_view()">

            <div :id="'menu-header-header-main'" :class="parent_class_name + ' horizontal'">
                <div :class="class_name"><span class="fas fa-fw"
                        :class="{ 'fa-plus': !data.show_view, 'fa-minus': data.show_view }"></span>
                    {{ title }}
                </div>
            </div>
        </div>

        <div class="mb-2 " v-show="data.show_view">
            <guidance :label="props.info_label" />
            <checkboxes_list :items="items" :event="`apply_filter_${data.randomKeyEvent}`" class="p-2" />
            <div v-if="show_loader">
                <i class="fa fa-spinner fa-spin text-primary-800"></i>
                <span class="sr-only">Loading...</span>
            </div>
            <div v-else>
                <div v-if="error_returned" class="dopa_not_available mt-3"
                    v-html="stores.BaseStore.localization('entities.dopa_not_available')"></div>
                <div v-else-if="timeout" class="dopa_not_available mt-3"
                    v-html="stores.BaseStore.localization('entities.dopa_not_available')"></div>
                <div v-else-if="error_wrong" class="dopa_not_available mt-3"
                    v-html="stores.BaseStore.localization('imet-core::analysis_report.error_wrong')"></div>
                <div v-else-if="Object.entries(data.values).length > 0" class="container-menu mt-3">

                    <!--        <small_menu v-if="show_menu" :items="data.values.diagrams"></small_menu>-->
                    <slot :props="data"></slot>
                </div>
                <div class="text-right mt-3">
                    <div class="btn-nav red" @click="toggle_view()"
                        v-html="stores.BaseStore.localization('imet-core::analysis_report.close')">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, inject, reactive, onMounted } from "vue";
import { useAjax } from "../../composables/ajax";
import { commonProps } from "./common/props";

const props = defineProps({
    ...commonProps,
    info_label: {
        type: String,
        default: ''
    },
    parent_class_name: {
        type: String,
        default: 'list-key-numbers'
    },
    class_name: {
        type: String,
        default: 'list-head'
    },
    items: {
        type: Object,
        default: null
    },
    type: {
        type: String,
        default: ''
    }
});

const stores = inject('stores');
const emitter = inject('emitter');
const show_loader = ref(false);
const timeout = ref(false);
const error_returned = ref(false);
const error_wrong = ref(false);

const data = reactive({
    values: {},
    show_view: false,
    loaded_once: false,
    parameters: [],
    randomKeyEvent: null
});

data.randomKeyEvent = Math.random().toString(36).substring(7)
const component_data = {
    func: props.func,
    url: props.url,
    method: props.method,
    on_load: props.on_load,
    loaded_at_once: props.loaded_at_once,
    parameters: props.parameters,
    stores,
    success
};

let { on_event_load } = useAjax(component_data);

onMounted(async () => {
    await init()
});

async function init() {
    emitter.on(`apply_filter_${data.randomKeyEvent}`, async (parameters) => {
        show_loader.value = true;
        const params = [...parameters.split(','), props.type];
        data.parameters = params;
        await on_event_load(data.parameters);
    })
}

function success(response, loader = false) {
    show_loader.value = loader;
    error_returned.value = false;
    if (response.status === false) {
        timeout.value = true;
        return;
    }
    if (typeof response === 'object') {
        data.values = response.data;
        // if (on_load_even.value !== null) {
        //     emitter.emit('component_loaded');
        // }
    } else {
        error_returned.value = true;
    }
}

function toggle_view() {
    data.show_view = !data.show_view;
}

</script>
