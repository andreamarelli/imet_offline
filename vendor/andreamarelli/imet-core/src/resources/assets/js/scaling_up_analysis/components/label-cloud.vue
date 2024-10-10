<template>
    <div class="vue-cloud flex flex-col">
        <div class="flex flex-row justify-center gap-4" v-if="has_selected()">
          <button class="btn-nav" @click="scaling_up">
            {{props.labelScalingUp}}
          </button>
          <action_button
              :class-name="'btn-nav red'"
              :click="clear_all"
              :label="props.labelRemoveAll"
              :event="'remove_values'"
              :emitter="emitter"
          ></action_button>
        </div>
        <div class="m-4 flex flex-row justify-center gap-4">
            <div  class="" v-for="selection in selections" :key="selection.id"
                 v-on:click="remove_item(selection)">
                <div class="p-2 bg-yellow-100 rounded border border-yellow-200">
                    <strong>{{ selection.value }}</strong>
                    <button type="button"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {ref, onMounted, inject} from 'vue'


const props = defineProps({
    sourceOfData: {
        type: String,
        default: "cookie"
    },
    cookieName: {
        type: String,
        default: ""
    },
    fieldId: {
        type: String,
        default: 'id'
    },
    url: {
        type: String,
        default: ''
    },
    labelScalingUp: {
        type: String,
        default: 'Scaling up analysis'
    },
    labelRemoveAll: {
        type: String,
        default: 'Remove all'
    },
});

const selections = ref([]);
const ids = ref([]);

const emitter = inject('emitter');
onMounted(() => {
    parse_cookie_data();
    emitter.on('update_cloud_tags', (data) => {
        if (is_cookie()) {
            parse_cookie_data();
        }
    });
    emitter.on('remove_values', () => {
        if (is_cookie()) {
            clear_all();
        }
    });
    emitter.on('scaling_up', () => {
        ids.value = selections.value.map(selection => selection[props.fieldId]).join(',');
        props.url.replace('__items__', ids.value);
        window.location.href = props.url;
    });
})

function is_cookie () {
    return props.sourceOfData === "cookie";
}

function get_raw_values() {
    if (is_cookie()) {
        const cookie = window.ModularForms.Helpers.Cookie.getByName(props.cookieName);
        if (cookie) {
            const data = cookie.split('=');
            return JSON.parse(data[1]);
        }
    }
    return null;
}

function has_selected() {
    if (selections.value?.length) {
        return selections.value.length > 1;
    }

    return false;
}

function scaling_up () {
    ids.value = selections.value.map(selection => selection[props.fieldId]).join(',');
    window.location.href = props.url.replace('__items__', ids.value);
}

function get_values () {
    return get_raw_values();
}

function parse_cookie_data() {
    selections.value = get_values();
}
function remove_item(item) {
    selections.value = selections.value?.filter((selection) => {
        return selection[props.fieldId] !== item[props.fieldId];
    });
    update();
}
function clear_all() {
    selections.value = [];
    if (is_cookie()) {
        window.ModularForms.Helpers.Cookie.delete(props.cookieName);
    }
}
function update() {
    if (is_cookie()) {
        const updated_values = JSON.stringify([...selections.value]);
        window.ModularForms.Helpers.Cookie.update(props.cookieName, updated_values);
    }
}
</script>

<style lang="scss" scoped>
.results-cloud {
    max-height: 300px;
    overflow: auto;
    background: #fff;
}
</style>
