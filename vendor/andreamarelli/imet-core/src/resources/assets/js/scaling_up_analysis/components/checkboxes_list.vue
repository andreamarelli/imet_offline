<template>
    <div class="grid grid-cols-2 gap-4 pb-4 pt-4">
        <template v-if="pas.length > 0">
            <div v-for="(selection, i) in pas" :key="i" class="p-2 bg-yellow-100 rounded border border-yellow-200">
                <input type="checkbox" :checked="is_checked(selection.FormID)" class="vue-checkboxes" :data-name="selection.name"
                    @click="selectValue(selection.FormID)" :value="selection.FormID">
                <strong>&nbsp;{{ selection.name }}</strong>
            </div>
        </template>
    </div>
    <div class="flex flex-row justify-center gap-4">
        <button :disabled="button_status()" @click="enable_overall()" class="btn-nav">{{
            stores.BaseStore.localization('imet-core::analysis_report.apply')
        }}
        </button>
        <button @click="check_all()" class="btn-nav">{{
            stores.BaseStore.localization('imet-core::analysis_report.select_all')
        }}
        </button>
        <button @click="clearSelections()" class="btn-nav red">{{
            stores.BaseStore.localization('imet-core::analysis_report.reset')
        }}
        </button>
    </div>
    <div v-if="show_overall">
        <slot :props="{ 'ids': checkboxes_ids(), 'show_view': show_overall }"></slot>
    </div>
</template>

<script setup>
import { ref, onMounted, inject } from "vue";

const are_checked_all = ref(false);
const checkboxes = ref([]);
const pas = ref([]);
const show_overall = ref(false);
const emitter = inject('emitter');
const stores = inject('stores');


const props = defineProps({
    items: {
        type: Object,
        default: () => {
        }
    },
    event: {
        type: String,
        default: ''
    },
    minimum_valid_items: {
        type: Number,
        default: 1
    }
});

onMounted(() => {
    const areas = [];
    Object.entries(props.items).forEach(val => {
        areas.push({ 'FormID': val[0], 'name': val[1] })
    });
    areas.sort((a, b) => a.name.localeCompare(b.name));
    pas.value = areas;
});

function is_checked(id) {
    return checkboxes.value.some(checkbox => {
        return parseInt(checkbox) === parseInt(id);
    });
}

function selectValue(value) {
    if (checkboxes.value.includes(value)) {
        checkboxes.value = checkboxes.value.filter(item => item !== value);
    } else {
        checkboxes.value.push(value);
        selected();
    }
    show_overall.value = false;
}

function checkboxes_ids() {
    return checkboxes.value.join(',');
}

function enable_overall() {
    if (props.event) {
        emitter.emit(props.event, checkboxes_ids())
    } else {
        if (show_overall.value) {
            setTimeout(() => {
                show_overall.value = !show_overall.value;
            }, 500)
        }
        show_overall.value = !show_overall.value;
    }
}

function button_status() {
    return checkboxes.value.length <= props.minimum_valid_items;
}

function check_all() {
    if (!are_checked_all.value) {
        const checkboxes_list = [...document.querySelectorAll(".vue-checkboxes")];
        for (const key in checkboxes_list) {
            const check_box = checkboxes_list[key];
            const exist = is_checked(check_box.defaultValue);
            if (!exist) {
                checkboxes.value.push(check_box.defaultValue);
            }
        }
        are_checked_all.value = true;
    } else {
        clearSelections();
    }
    selected();
}

function selected() {

    emitter.emit('actionData', JSON.stringify(checkboxes.value));
}

function clearSelections() {
    checkboxes.value = [];
    are_checked_all.value = false;
}

</script>
