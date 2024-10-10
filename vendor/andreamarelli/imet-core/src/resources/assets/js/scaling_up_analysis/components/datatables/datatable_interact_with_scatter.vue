<template>
    <div v-if="data.length">
        <datatable_scaling :columns="columns" :default_order="default_order" :refresh_average="refresh_average" :values="data" :key="data.length">
        </datatable_scaling>
    </div>
</template>

<script setup>
import {ref, onMounted, inject} from 'vue';
import {useList} from './composables/list'

const emitter = inject('emitter');
const data = ref([]);

const props = defineProps({
    values: {
        type: [Array, Object],
        default: () => {
        }
    },
    columns: {
        type: Array,
        default: () => {
        }
    },
    event_key: {
        type: String,
        default: ''
    },
    values_with_indicators_keys: {
        type: Boolean,
        default: false
    },
    refresh_average: {
        type: Boolean,
        default: true
    },
    default_order: {
        type: String,
        default: null
    },
    default_order_dir: {
        type: String,
        default: "asc"
    },
});

// const { parse_data } = useList({sortBy: props.default_order});

onMounted(() => {
    emitter.on(`scatter_data_${props.event_key}`, (params) => {
        parse_data(params.selected);
    });
    parse_data();
});

function parse_data(selected = null) {
    const values = Object.entries({...props.values});
    const items = [];

    values.forEach((value, idx) => {
        if (selected === null || (selected[value[1].name])) {
            items.push({
                name: value[1]['name'],
                context: value[1]['value'][0],
                planning: value[1]['value'][1],
                inputs: value[1]['value'][2]
            });
        }
    });
    data.value = items;
}

</script>
