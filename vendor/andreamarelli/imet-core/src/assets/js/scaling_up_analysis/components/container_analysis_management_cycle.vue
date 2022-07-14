<template>
    <div>
        <div class="" @click="toggle_view()">

            <div :id="'menu-header-header-main'"
                 :class="parent_class_name+' horizontal'">
                <div :class="class_name"><span class="fas fa-fw"
                                               :class="{'fa-plus': !data.show_view,'fa-minus':data.show_view}"></span>
                    {{ title }}
                </div>
            </div>
        </div>
        <div class="bg-white collapse mb-2" :class="{show: data.show_view}">
            <guidance :text="guidance"/>
            <checkboxes_list :items="items" :event="'apply_filter'"/>
            <div v-if="show_loader" class="spinner-border text-success" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div v-else>
                <div v-if="error_returned" class="dopa_not_available mt-3"
                     v-html="stores.BaseStore.localization('entities.dopa_not_available')"></div>
                <div v-else-if="timeout" class="dopa_not_available mt-3"
                     v-html="stores.BaseStore.localization('entities.dopa_not_available')"></div>
                <div v-else-if="error_wrong" class="dopa_not_available mt-3"
                     v-html="stores.BaseStore.localization('imet-core::analysis_report.error_wrong')"></div>
                <div v-else class="container-menu mt-3">

                    <!--        <small_menu v-if="show_menu" :items="data.values.diagrams"></small_menu>-->
                    <slot :props="data"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import container_event from './containers/container_event.vue';

export default {
    name: "container_analysis_management_cycle.vue",
    inject: ['stores'],
    mixins: [
        window.ImetCore.ScalingUp.Mixins.ajax,
        container_event
    ],
    props: {
        show_menu: {
            type: Boolean,
            default: false
        },
        title: {
            type: String,
            default: ''
        },
        items: {
            type: Object,
            default: null
        },
        type: {
            type: String,
            default: ''
        },
        guidance: {
            type: String,
            default: ''
        },
        parent_class_name: {
            type: String,
            default: 'list-key-numbers'
        },
        class_name: {
            type: String,
            default: 'list-head'
        },
        inverse: {
            type: Boolean,
            default: false
        },
    },
    data: function () {
        return {
            data: {
                values: {},
                show_view: false,
                loaded_once: false,
                parameters: []
            }
        }
    },
    methods: {
        init: async function () {
            this.$on('apply_filter', async (parameters) => {
                this.event_parameters = (parameters + ',' + this.type).split(',');
                this.data.parameters = parameters;
                this.func_parameter = this.func;
                this.url_parameter = this.url;
                await this.load_procedure();
            })
        },
        success: function (response) {
            if (response.status === false) {
                this.timeout = true;
                return;
            }
            if (typeof response === 'object') {
                this.data.values = response.data;
                if (this.on_load_even !== null) {
                    this.$root.$emit('component_loaded');
                }
            } else {
                this.error_returned = true;
            }
        },
        toggle_view: async function () {
            this.data.show_view = !this.data.show_view;
        }
    }
}
</script>
