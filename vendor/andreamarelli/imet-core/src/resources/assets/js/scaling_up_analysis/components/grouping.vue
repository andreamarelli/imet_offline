<template>
    <div>
        <div id="js-grouping-action-buttons">
            <div class="mb-2">
                <button type="button" class="btn-nav mb-1 mr-1" @click="add_by_country">
                    {{ stores.BaseStore.localization('imet-core::analysis_report.grouping.add_country') }}
                </button>
                <button type="button" class="btn-nav red mb-1 mr-1" @click="reset">
                    {{ stores.BaseStore.localization('imet-core::analysis_report.grouping.reset') }}
                </button>
                <button v-if="data.list_of_components.length < data.list.length" type="button" @click="add_group()"
                        class="btn-nav blue mb-1">
                    <i class="fa fa-plus" aria-hidden="true"/>
                    {{ stores.BaseStore.localization('imet-core::analysis_report.grouping.add_group') }}
                </button>
            </div>
        </div>
        <div class="start-zone flex flex-row gap-4"
             id="start-zone"
             @drop='on_drop($event, null)'
             @dragover.prevent
             @dragenter.prevent>
            <div v-for='(item, index) in default_list' class='default-zone-element' :key="index">
                <draggable_item :is_removable=false :item="item" :item_class="'default-zone-element'"></draggable_item>
            </div>
        </div>
        <div class="flex flex-row justify-center dropzone-areas" id="dropzone-areas">
            <div class="ml-1" v-for="(i, index) in data.list_of_components" :key="index">
                <drop_drag_area @drag-element="start_drag" @remove-element="remove_from_list" @drop-element="on_drop" :drop_id="i.id" :key="i.id" :color="i.color">
                    <template v-slot>

                        <div class="text-center mb-4 py-1 px-2 font-bold" style="background: rgba(255,255,255,0.7);">
                            <span class="text-center " v-if="i.input_visible"> <input type="text" :id="'item-'+i.id"
                                                                                      :value="i.name" maxlength="25"
                                                                                      size="15"/></span>
                            <span class="text-center " v-if="!i.input_visible"> {{ i.name }}</span>
                            <i class="fa fa-pen" v-if="!i.input_visible"
                               aria-hidden="true" @click='edit_component_name(i.id)'></i>
                            <i class="fa fa-save" v-if="i.input_visible"
                               aria-hidden="true" @click='save_component_name(i.id)'></i>
                            <i class="fa fa-trash"
                               aria-hidden="true" @click='remove_component_from_list(i.id)'></i>
                        </div>

                        <div v-for='(item, index) in list_items(i.id)' :key="index">
                            <draggable_item :item="item"></draggable_item>
                        </div>

                    </template>
                </drop_drag_area>
            </div>
        </div>
        <div class="flex flex-row gap-1 justify-center mb-5" id="js-render-buttons">
            <button type="button" @click="show_diagrams('radar')" class="btn-nav">
                {{ stores.BaseStore.localization('imet-core::analysis_report.grouping.render_radar') }}
            </button>
            <button type="button" @click="show_diagrams('scatter',{func:'get_scatter_grouping_analysis'})"
                    class="btn-nav">
                {{ stores.BaseStore.localization('imet-core::analysis_report.grouping.render_scatter') }}
            </button>
        </div>

        <div v-if="data.show_selected_legend">
            <div class="list-head" v-if="data.type==='scatter'">
                {{ stores.BaseStore.localization('imet-core::analysis_report.grouping.scatter_plot') }}
                <button class="btn-nav small blue">
                    <span class="fas fa-fw fa-info-circle"></span>
                </button>
                <tooltip>
                    {{ stores.BaseStore.localization('imet-core::analysis_report.guidance.info.group_scatter') }}
                </tooltip>
            </div>
            <div class="list-head" v-else-if="data.type==='radar'">
                {{ stores.BaseStore.localization('imet-core::analysis_report.grouping.radar') }}
                <button class="btn-nav small blue">
                    <span class="fas fa-fw fa-info-circle"></span>
                </button>
                <tooltip>
                    {{ stores.BaseStore.localization('imet-core::analysis_report.guidance.info.group_radar') }}
                </tooltip>
            </div>
        </div>
        <div id="render_image" class="mt-3">
            <div class="flex flex-row justify-center gap-2" v-if="data.show_selected_legend">
                <div class="legend_radars" v-for="(i, index) in data.list_of_components" :key="index">
                    <div :style="'background-color:'+ i.color" class="text-center py-1 px-2 font-bold">
                        {{ i.name }}
                    </div>
                    <div class="bg-white border border-gray-100 py-1 px-2" v-for='(item, index) in list_items(i.id)' :key="index"
                         v-html="item.name"></div>
                </div>
            </div>
            <slot :trigger_incoming_data="trigger_incoming_data"></slot>
        </div>
    </div>
</template>
<style scoped>

.legend_radars {
    width: 200px;
}

.start-zone {
    background-color: #eee;
    margin-bottom: 10px;
    padding: 10px;
    min-height: 200px;
    width: 100%;
}

.dropzone-areas {
    min-height: 200px;
    max-height: 500px;
    overflow: auto;
}

.add-dropzone-area {
    margin-bottom: 10px;
    padding: 10px;
    min-height: 200px;
    width: 300px;

}
</style>
<script setup>
import drop_drag_area from "./drag_and_drop/drop_drag_area.vue";
import draggable_item from "./drag_and_drop/draggable_item.vue";
import {onMounted, reactive, computed, inject, ref} from 'vue';

const stores = inject('stores');
const emit = defineEmits(['incoming-data']);
const trigger_incoming_data = ref(null);

const colors = ['#5470c6', '#91cc75', '#fac858', '#ee6666', '#73c0de', '#3ba272', '#fc8452', '#9a60b4', '#ea7ccc'];
const func_to_call = 'get_grouping_analysis';
const data = reactive({
    list: [],
    countriesList: [],
    list_of_components: [],
    show_selected_legend: false,
    type: null
});


const props = defineProps({
    values: {
        type: [Object, Array],
        default: () => {
        }
    },
    country_events: {
        type: [Array, Object],
        default: () => {
        }
    },
    number_of_drop_zones: {
        type: Number,
        default: 1
    }
});

const default_list = computed(() => {
    return data.list.filter(item => item.list === null)
});

onMounted(() => {
    data.list = Object.entries(props.values).map(i => {
        data.countriesList.push(i[1].Country_name.name);

        return {
            id: i[1].FormID,
            name: i[1].name,
            'list': null,
            country: i[1].Country_name.name,
            input_visible: false
        }
    });
    data.list.sort((a, b) => a.name.localeCompare(b.name));
    data.countriesList = [...new Set(data.countriesList)];

    init_components();

});

function show_diagrams(type = 'radar', params = null) {
    data.type = type;
    const render = data.list.some(item => item.list !== null);
    if (render) {
        trigger_incoming_data.value = {

            parameters: data.list.filter(item => item.list !== null).map(item => {
                let group = data.list_of_components.find(comp => comp.id === item.list);

                return {id: item.id, group: item.list, name: group.name, color: group.color}
            }), func: params ? params.func : func_to_call

        };

        data.show_selected_legend = true;
    }
}

function init_components() {
    data.list_of_components = Array.from({length: props.number_of_drop_zones}, (_, id) => ({
        id: id + 1,
        color: colors[id],
        name: 'Group ' + (id + 1),
        input_visible: false
    }))
}

function remove_component_from_list(id) {
    data.list_of_components = data.list_of_components.filter((comp, index) => comp.id !== id);
    reset_list_items(id);
}

function edit_component_name(id) {
    data.list_of_components.find(comp => comp.id === id).input_visible = true;
}

function save_component_name(id) {
    const name = document.getElementById('item-' + id).value;
    data.list_of_components = data.list_of_components.map(comp => {
        if (comp.id === id) {
            comp.name = name;
        }
        comp.input_visible = false;
        return comp;
    })
}

function list_items(id = null) {
    return data.list.filter(item => item.list === id)
}

function reset_list_items(id) {
    data.list.map(item => {
        if (item.list === id) {
            item.list = null;
            item.by_country = null;
        }
        return item;
    })
}

const start_drag = (evt, item) => {
    evt.dataTransfer.dropEffect = 'move'
    evt.dataTransfer.effectAllowed = 'move'
    evt.dataTransfer.setData('itemID', item.id)
}

function on_drop(evt, id) {
    const itemID = evt.dataTransfer.getData('itemID')
    const item = data.list.find(item => item.id == itemID)
    item.list = id
}

function remove_from_list(id) {
    const item = data.list.find(item => item.id == id)
    item.list = null;
    item.by_country = null;
}

function add_group(name = null) {
    const components_length = data.list_of_components.length;
    const group_name = name ?? `${stores.BaseStore.localization('imet-core::analysis_report.grouping.group')} ${(components_length + 1)}`;
    const length = !components_length ? 1 : Math.max(...data.list_of_components.map(i => i.id)) + 1;
    data.list_of_components.push({id: length, color: colors[length - 1], name: group_name, input_visible: false})
    data.list_of_components.sort((a, b) => {
        return a.name.localeCompare(b.name)
    });

}

function reset() {
    data.list.map(item => {
        item.list = null;
        item.by_country = null;
        return item;
    });
    stores.BaseStore.toggle_country_enabled();
    data.list_of_components = [];
    add_group();
    add_group();
    data.show_selected_legend = false;
    // this.data.values = [];
}

function add_by_country() {
    data.list_of_components = [];
    let boards = data.list_of_components.length;
    const countries = data.countriesList.length;
    stores.BaseStore.toggle_country_enabled();

    data.list.map(item => {
        const index = data.countriesList.indexOf(item.country);

        item.list = index + 1;
        //item.name = item.country;
        item.by_country = true;
        return item;
    })

    while (countries > boards) {
        add_group(data.countriesList[boards]);
        boards++;
    }
}

</script>
