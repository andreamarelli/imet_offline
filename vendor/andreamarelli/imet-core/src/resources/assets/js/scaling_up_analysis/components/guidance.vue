<template>
    <div v-if="hasGuidance" class="module-bar info-bar mt-2 mb-2 guidance" style="grid-column: span 2;"
        id="guidance">
        <div class="icon blue"><span class="fas fa-fw fa-info-circle" style="font-size: 1.4em;"></span></div>
        <div class="message">
            <div>
                <span v-html="stores.BaseStore.localization(label + '.intro')"></span>
                <a href="#" v-on:click.prevent="toggle_more()" v-if="!show_more && key_exist()">show more...</a>
                <a href="#" v-on:click.prevent="toggle_more()" v-else-if="key_exist()">show less</a>
            </div>
            <div class="mt-2" v-if="show_more && key_exist()" v-html="stores.BaseStore.localization(label + '.info')">
            </div>
            <div class="mt-5 p-2 border border-dark" v-if="show_more && key_exist('.table')"
                v-html="stores.BaseStore.localization(label + '.table')">
            </div>
            <div class="mt-2" v-if="show_more && key_exist('.extra_info')"
                v-html="stores.BaseStore.localization(label + '.extra_info')">
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, inject, onMounted } from "vue";

const stores = inject('stores');
const show_more = ref(false);
const hasGuidance = ref(false);
const props = defineProps({
    label: {
        type: String,
        default: ''
    }
});

onMounted(() => {
    hasGuidance.value = has_guidance();
});

function has_guidance() {
    return props.label.length > 0 && key_exist('.intro');
}

function key_exist(element = '.info') {
    return stores.BaseStore.localization(props.label + element).toUpperCase() !== (props.label + element).toUpperCase();
}

function toggle_more() {
    show_more.value = !show_more.value;
}

</script>
