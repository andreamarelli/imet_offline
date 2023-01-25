<template>
    <div>
        <div class='row' id="js-grouping-action-buttons">
            <div class="col-24 mb-2">
                <button type="button" class="btn btn-success mb-1" @click="add_by_country">
                    {{ stores.BaseStore.localization('imet-core::analysis_report.grouping.add_country') }}
                </button>
                <button type="button" class="btn btn-danger mb-1" @click="reset">
                    {{ stores.BaseStore.localization('imet-core::analysis_report.grouping.reset') }}
                </button>
                <button v-if="list_of_components.length < list.length" type="button" @click="add_group()"
                        class="btn btn-primary mb-1"><i class="fa fa-plus"
                                                        aria-hidden="true">{{
                        stores.BaseStore.localization('imet-core::analysis_report.grouping.add_group')
                    }}</i></button>
            </div>
        </div>
        <div class='row start-zone'
             id="start-zone"
             @drop='on_drop($event, null)'
             @dragover.prevent
             @dragenter.prevent>
            <div v-for='item in default_list' class='default-zone-element col-2'>
                <draggable_item :is_removable=false :item="item" :item_class="'default-zone-element'"></draggable_item>
            </div>
        </div>
        <div class="row dropzone-areas d-flex " id="dropzone-areas">
            <div class="ml-1" v-for="i in list_of_components">
                <drop_drag_area :drop_id="i.id" :key="i.id" :color="i.color">
                    <template>
                        <div class="bg-white text-center mb-1">
                            <span class="text-center " v-if="i.input_visible"> <input type="text" :id="'item-'+i.id" :value="i.name" maxlength="25" size="15"/></span>
                            <span class="text-center " v-if="!i.input_visible"> {{ i.name }}</span>
                            <i class="fa fa-pen" v-if="!i.input_visible"
                               aria-hidden="true" @click='edit_component_name(i.id)'></i>

                            <i class="fa fa-save" v-if="i.input_visible"
                               aria-hidden="true" @click='save_component_name(i.id)'></i>
                            <i class="fa fa-trash"
                               aria-hidden="true" @click='remove_component_from_list(i.id)'></i>

                        </div>
                        <div v-for='item in list_items(i.id)'>
                            <draggable_item :item="item"></draggable_item>
                        </div>
                    </template>
                </drop_drag_area>
            </div>
        </div>
        <div class="row" id="js-render-buttons">
            <div class="col-24 mt-5 mb-5">
                <button type="button" @click="show_diagrams('radar')" class="btn btn-success">
                    {{ stores.BaseStore.localization('imet-core::analysis_report.grouping.render_radar') }}

                </button>
                <button type="button" @click="show_diagrams('scatter',{func:'get_scatter_grouping_analysis'})"
                        class="btn btn-success">
                    {{ stores.BaseStore.localization('imet-core::analysis_report.grouping.render_scatter') }}
                </button>
            </div>
        </div>
        <div class="col-sm" v-if="show_selected_legend" >
            <div class="list-key-numbers horizontal">
                <div class="list-head" v-if="type==='scatter'">{{ stores.BaseStore.localization('imet-core::analysis_report.grouping.scatter_plot') }}
                    <popover>
                        <template>
                            {{stores.BaseStore.localization('imet-core::analysis_report.guidance.info.group_scatter')}}
                        </template>
                    </popover>
                </div>
                <div class="list-head"  v-else-if="type==='radar'">{{ stores.BaseStore.localization('imet-core::analysis_report.grouping.radar') }}
                    <popover>
                        <template>
                            {{stores.BaseStore.localization('imet-core::analysis_report.guidance.info.group_radar')}}
                        </template>
                    </popover>
                </div>
            </div>
        </div>
        <div id="render_image">
            <div class="row mt-5" v-if="show_selected_legend">
                <div class="col legend_radars" v-for="i in list_of_components">
                    <div :style="'background-color:'+ i.color" class="text-center mb-1">
                        <span class="text-center "> {{ i.name }} </span>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item" v-for='item in list_items(i.id)' v-html="item.name">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>

.legend_radars {
    margin-bottom: 10px;
    padding: 10px;
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
<script>

import drop_drag_area from "./drag_and_drop/drop_drag_area.vue";
import draggable_item from "./drag_and_drop/draggable_item.vue";

export default {
    components: {drop_drag_area, draggable_item},
    name: "grouping",
    inject: ['stores'],
    props: {
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
    },
    data() {
        return {
            list: [],
            countriesList: [],
            list_of_components: [],
            colors: ['#5470c6', '#91cc75', '#fac858', '#ee6666', '#73c0de', '#3ba272', '#fc8452', '#9a60b4', '#ea7ccc'],
            show_selected_legend: false,
            func_to_call: 'get_grouping_analysis',
            type: null
        }
    },

    mounted: function () {
        this.list = Object.entries(this.values).map(i => {
            this.countriesList.push(i[1].Country_name.name);

            return {id: i[1].FormID, name: i[1].name, 'list': null, country: i[1].Country_name.name, input_visible: false}
        });
        this.list.sort((a, b) => a.name.localeCompare(b.name));
        this.countriesList = [...new Set(this.countriesList)];

        this.init_components();
        this.$root.$on('drop-element', (evt, list) => {
            this.on_drop(evt, list);
        });
        this.$root.$on('drag-element', (evt, id) => {
            this.start_drag(evt, id);
        });
        this.$root.$on('remove-element', (id) => {
            this.remove_from_list(id);
        });

    },
    computed: {
        default_list() {
            return this.list.filter(item => item.list === null)
        },
    },
    methods: {
        show_diagrams: function (type = 'radar', params = null) {
            this.type = type;
            const render = this.list.some(item => item.list !== null);
            if (render) {
                this.$root.$emit('incoming-data', {

                    parameters: this.list.filter(item => item.list !== null).map(item => {
                        let group_name = this.list_of_components.find(comp => comp.id === item.list).name;
                        return {id: item.id, group: item.list, name: group_name}
                    }), func: params ? params.func : this.func_to_call

                });
                this.show_selected_legend = true;
            }
        },
        init_components: function () {
            this.list_of_components = Array.from({length: this.number_of_drop_zones}, (_, id) => ({
                id: id + 1,
                color: this.colors[id],
                name: 'Group ' + (id + 1),
                input_visible: false
            }))
        },
        remove_component_from_list: function (id) {
            this.list_of_components = this.list_of_components.filter((comp, index) => comp.id !== id);
            this.reset_list_items(id);
        },
        edit_component_name:function (id) {
            this.list_of_components.find(comp => comp.id === id).input_visible = true;
        },
        save_component_name: function (id) {
            const name = document.getElementById('item-' + id).value;
            this.list_of_components = this.list_of_components.map(comp => {
                if (comp.id === id) {
                    comp.name = name;
                }
                comp.input_visible = false;
                return comp;
            })
        },
        list_items(id = null) {
            return this.list.filter(item => item.list === id)
        },
        reset_list_items(id) {
            this.list.map(item => {
                if (item.list === id) {
                    item.list = null;
                    item.by_country = null;
                }
                return item;
            })
        },
        start_drag: (evt, item) => {
            evt.dataTransfer.dropEffect = 'move'
            evt.dataTransfer.effectAllowed = 'move'
            evt.dataTransfer.setData('itemID', item.id)
        },
        on_drop(evt, id) {
            const itemID = evt.dataTransfer.getData('itemID')
            const item = this.list.find(item => item.id == itemID)
            item.list = id
        },
        remove_from_list(id) {
            const item = this.list.find(item => item.id == id)
            item.list = null;
            item.by_country = null;
        },
        add_group: function (name = null) {
            const components_length = this.list_of_components.length;
            const group_name = name ?? `${this.stores.BaseStore.localization('imet-core::analysis_report.grouping.group')} ${(components_length + 1)}`;
            const length = !components_length ? 1 : Math.max(...this.list_of_components.map(i => i.id)) + 1;
            this.list_of_components.push({id: length, color: this.colors[length - 1], name: group_name, input_visible: false})
            this.list_of_components.sort((a, b) => {
                return a.name.localeCompare(b.name)
            });

        },
        reset: function () {
            this.list.map(item => {
                item.list = null;
                item.by_country = null;
                return item;
            });
            this.stores.BaseStore.toggle_country_enabled();
            this.list_of_components = [];
            this.add_group();
            this.add_group();
            this.show_selected_legend = false;
            // this.data.values = [];
        },
        add_by_country: function () {
            this.list_of_components = [];
            let boards = this.list_of_components.length;
            const countries = this.countriesList.length;
            this.stores.BaseStore.toggle_country_enabled();

            this.list.map(item => {
                const index = this.countriesList.indexOf(item.country);

                item.list = index + 1;
                //item.name = item.country;
                item.by_country = true;
                return item;
            })

            while (countries > boards) {
                this.add_group(this.countriesList[boards]);
                boards++;
            }
        }
    }
}
</script>
