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

const { parse_data } = useList({sortBy: props.default_order});

onMounted(() => {
    emitter.on(`radar_data_${props.event_key}`, (params) => {
        params.selected['lower limit'] = false;
        params.selected['upper limit'] = false;

        data.value = parse_data(params.selected, props.values, props.columns, props.values_with_indicators_keys);
    });
    data.value = parse_data(null, props.values, props.columns, props.values_with_indicators_keys);
});

</script>
