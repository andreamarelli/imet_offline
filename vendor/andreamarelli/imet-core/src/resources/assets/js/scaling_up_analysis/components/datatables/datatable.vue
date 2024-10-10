<template>
    <table id="global_scores">
        <tr>
            <th v-for="column in columns" @click="sort(column.field)" :key="column.field">
                {{ column.label }} <i :class="sort_icon(column.field)"/>
            </th>
        </tr>
        <tr v-for="(value, index) in items" :key="index">
            <td v-for="column in columns" v-html="value[column.field]" :key="column.field"></td>
        </tr>
    </table>
</template>

<script setup>

import {ref, onMounted, computed} from 'vue';
import {useList} from './composables/list'

const props = defineProps({
    columns: {
        type: Array,
        default: () => []
    },
    values: {
        type: Array,
        default: () => []
    }
});

const list = ref([]);

const {filterList, sortList, sort_icon} = useList({});

const items = computed(() => {

    let items = list.value;
    items = filterList(items);
    items = sortList(items);

    return items;

});

</script>
