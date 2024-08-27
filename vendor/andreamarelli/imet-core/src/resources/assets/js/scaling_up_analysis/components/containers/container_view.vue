<template>
    <div>
        <div class="" @click="toggle_view()">

            <div :id="'menu-header-header-main'">
                <div class="list-head">
                    <span class="fas fa-fw" :class="{'fa-plus': !data.show_view,'fa-minus':data.show_view}"></span>
                    {{ title }}
                </div>
            </div>
            
        </div>

        <div v-show="data.show_view">
            <div v-if="show_loader">
                <i class="fa fa-spinner fa-spin fa-2x text-primary-800"></i>
                <span class="sr-only">Loading...</span>
            </div>
            <div v-else>
                <div v-if="error_returned" class="dopa_not_available"
                     v-html="stores.BaseStore.localization('entities.dopa_not_available')"></div>
                <div v-else-if="timeout" class="dopa_not_available"
                     v-html="stores.BaseStore.localization('entities.dopa_not_available')"></div>
                <div v-else-if="error_wrong" class="dopa_not_available"
                     v-html="stores.BaseStore.localization('imet-core::analysis_report.error_wrong')"></div>
                <div v-else class="container-menu">
                    <guidance :text="guidance"/>
                    <!--        <small_menu v-if="show_menu" :items="data.values.diagrams"></small_menu>-->
                    <slot :props="data"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import small_menu from "./../menus/small_menu.vue";
import container_event from "./container_event.vue";

export default {
    name: "container_view",
    inject: ['stores'],
    mixins: [
        window.ImetCore.ScalingUp.Mixins.ajax,
        container_event
    ],
    components: {
        small_menu
    },
    props: {
        element: {
            type: String,
            default: ''
        },
        on_load: {
            type: Boolean,
            default: true
        },
        load_container: {
            type: Boolean,
            default: true
        },
        on_load_even: {
            type: String,
            default: null
        },
        show_menu: {
            type: Boolean,
            default: false
        },
        title: {
            type: String,
            default: ''
        },
        guidance: {
            type: String,
            default: ''
        }

    },
    watch: {
        loaded_once: {
            deep: true,
            handler() {
                this.init();
            }
        }
    },
    data: function () {
        return {
            data: {
                values: {},
                show_view: false,
                loaded_once: false
            }
        }
    },
    methods: {
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
            if (this.data.show_view && !this.loaded_once) {
                await this.init();
            }
        }
    }
}
</script>
