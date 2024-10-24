<template>
    <div class="module-container" :id="name">
        <div class="module-header">
            <div v-if="code_is_visible()" class="module-code text-center">
                {{ code }}
            </div>
            <div class="module-title" @click="toggle_view()">
                <span class="fas fa-fw carrot"
                    :class="{ 'fa-caret-up': !data.show_view, 'fa-caret-down': data.show_view }"></span> {{ title }}
            </div>
        </div>
        <guidance :label="props.info_label" v-show="data.show_view" ></guidance>
        <div class="module-body bg-white scaling_up_module_container_body" v-show=data.show_view>
            <slot :props="data">
            </slot>
            <div class="text-right mt-3">
                <div class="btn-nav red" @click="toggle_view()"
                    v-html="stores.BaseStore.localization('imet-core::analysis_report.close')">
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { inject, onMounted, ref } from 'vue';

const stores = inject('stores');
const config = inject('config');
const emitter = inject('emitter');

const props = defineProps({
    name: {
        type: String,
        default: ''
    },
    title: {
        type: String,
        default: ''
    },
    code: {
        type: String,
        default: ''
    },
    info_label: {
        type: String,
        default: ''
    },
    event_name: {
        type: String,
        default: ''
    }
});

const data = ref({
    values: {},
    show_view: false,
    loaded_once: false,
    config: config,
    stores: stores
});

onMounted(() => {
    emitter.on(props.event_name, () => {
        data.value.show_view = true;
    });
});

function code_is_visible() {
    return props.code.length;
}

async function toggle_view() {
    data.value.show_view = !data.value.show_view;
}

function is_visible(values) {
    return Object.keys(values).length;
}
</script>
