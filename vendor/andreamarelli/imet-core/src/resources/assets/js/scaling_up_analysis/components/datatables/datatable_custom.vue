<template>
    <table id="global_scores">
        <thead>
            <th v-for="column in columns" @click="sort(column.field)" :key="column.field">
                {{ column.label }} <i :class="sort_icon(column.field)" />

            </th>
        </thead>
        <tbody>
            <tr v-for="(value, index) in items" :key="index">
                <td v-for="column in columns" v-html="value[column.field]" :key="column.field"></td>
            </tr>
        </tbody>
    </table>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { useList } from './composables/list'

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
const { Locale } = window;

const {
    filterList,
    sortList,
    sort_icon,
    customization,
    percentage,
    colorArea
} = useList({});

const items = computed(() => {

    let items = list.value;
    items = filterList(items);
    items = sortList(items);

    return items;

});


onMounted(() => {
    list.value = customization(props.values, props.columns);
});

</script>
<!--<script>-->
<!--import datatable from "./datatable.vue";-->

<!--export default {-->
<!--    name: "datatable_custom.vue",-->
<!--    mixins: [-->
<!--        datatable-->
<!--    ],-->

<!--    mounted: function () {-->
<!--        this.customization();-->
<!--    },-->

<!--    methods: {-->
<!--        customization: function () {-->
<!--            let items = [];-->
<!--            Object.entries(this.values).forEach(([key, value]) => {-->
<!--                const object = {};-->
<!--                this.columns.forEach((value2) => {-->

<!--                    if (value[value2.field] !== 'undefined') {-->
<!--                        if (value2['type'] && value2['type'] === 'percentage') {-->
<!--                            object[value2.field] = this.percentage(value[value2.field], value2.color);-->
<!--                        } else if (value2['type'] && value2['type'] === 'color') {-->
<!--                            object[value2.field] = this.colorArea(value[value2.field]);-->
<!--                        } else if (value2['type'] && value2['type'] === 'bg-color') {-->
<!--                            object[value2.field] = this.colorArea(value['color'], value[value2.field]);-->
<!--                        } else if (value2['type'] && value2['type'] === 'value_in_area_with_color') {-->
<!--                            object[value2.field] = this.colorArea(value2.color, value[value2.field]);-->
<!--                        } else {-->
<!--                            object[value2.field] = value[value2.field];-->
<!--                        }-->
<!--                    }-->
<!--                });-->
<!--                items.push(object);-->
<!--            })-->

<!--            this.list = items;-->
<!--        },-->
<!--        percentage: function (value, color) {-->
<!--            return `${value} <br/><div class="progress"><div class="progress-bar" style="width: ${value}%; background-color: ${color}"></div></div>`;-->
<!--        },-->
<!--        colorArea: function (color, value = '') {-->
<!--            return `<div class="p-3 mb-2 " style="background-color: ${color}">${value}</div>`;-->
<!--        }-->
<!--    }-->
<!--}-->
<!--</script>-->
