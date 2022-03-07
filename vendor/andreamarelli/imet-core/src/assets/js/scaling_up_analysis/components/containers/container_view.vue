<template>
    <div>
        <div class="" @click="toggle_view()">

            <div :id="'menu-header-header-main'"
                 class="list-key-numbers horizontal">
                <div class="list-head"><span class="fas fa-fw"
                                             :class="{'fa-plus': !data.show_view,'fa-minus':data.show_view}"></span>
                    {{ title }}
                </div>
            </div>
        </div>
        <div class="bg-white collapse" :class="{show: data.show_view}">
            <div v-if="show_loader" class="spinner-border text-success" role="status">
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

import small_menu from './../menus/small_menu.vue';


export default {
    name: "container.vue",
    inject: ['stores'],
    mixins: [
        window.ImetCore.ScalingUp.Mixins.ajax
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
