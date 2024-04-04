<template>
    <div class="vue-cloud">
        <div class="row mb-3 mr-0" v-if="get_selections()">
            <div class="col">
                <button class="btn btn-success float-right" @click="scaling_up">
                    {{this.labelScalingUp}}
                </button>

            </div>
            <div class="col">
                <actionButton :class-name="'btn btn-danger float-left'" :click="clear_all" :label="this.labelRemoveAll"
                              :event="'remove_values'"></actionButton>
            </div>
        </div>
        <div class="row mr-0 results-cloud">
            <div class="col-sm-2" v-for="selection in selections" :key="selection.id"
                 v-on:click="remove_item(selection)">
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                    <strong>{{ selection.value }}</strong>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import actionButton from './action-button.vue';

export default {
    name: "label-cloud.vue",
    components: {actionButton},
    props: {
        sourceOfData: {
            type: String,
            default: "cookie"
        },
        cookieName: {
            type: String,
            default: ""
        },
        fieldId: {
            type: String,
            default: 'id'
        },
        url: {
            type: String,
            default: ''
        },
        labelScalingUp: {
            type: String,
            default: 'Scaling up analysis'
        },
        labelRemoveAll: {
            type: String,
            default: 'Remove all'
        },
    },
    data() {
        return {
            Locale: window.Locale,
            _token: window.Laravel.csrfToken,
            modalIsOpen: false,
            selections: [],
            value: [],
            ids: []
        };
    },
    mounted: function () {
        this.values = window.list;
        this.parse_cookie_data();
        this.$root.$on('update_cloud_tags', (data) => {
            if (this.is_cookie()) {
                this.parse_cookie_data();
            }
        });
        this.$root.$on('add_cloud_tags', (data) => {
            if (this.is_cookie()) {
                this.parse_cookie_data();
            }
        });
        this.$root.$on('remove_values', () => {
            if (this.is_cookie()) {
                this.clear_all();
            }
        });
        this.$root.$on('scaling_up', () => {
            this.ids = this.selections.map(selection => selection[this.fieldId]).join(',');
            this.url.replace('__items__', this.ids);
            window.location.href = this.url;
        });
    },
    methods: {
        get_selections() {
            if (this.selections?.length) {
                return this.selections.length > 1;
            }
            return false;
        },
        scaling_up: function () {
            this.ids = this.selections.map(selection => selection[this.fieldId]).sort((a, b) => parseInt(a) - parseInt(b)).join(',');
            this.ids = this.selections.map(selection => selection[this.fieldId]).join(',');

            window.location.href = this.url.replace('__items__', this.ids);
        },
        get_values: function () {
            return this.get_raw_values();
        },
        get_raw_values() {
            if (this.is_cookie()) {
                const cookie = window.ModularForms.Mixins.Cookies.getByName(this.cookieName);
                if (cookie) {
                    const data = cookie.split('=');
                    return JSON.parse(data[1]);
                }
            }
            return null;
        },
        is_cookie: function () {
            return this.sourceOfData === "cookie";
        },
        initialize() {
            this.selections = this.get_values();
        },
        parse_cookie_data: function () {
            this.selections = this.get_values();
        },
        remove_item: function (item) {
            this.selections = this.selections?.filter((selection) => {
                return selection[this.fieldId] !== item[this.fieldId];
            });
            this.update();
        },
        clear_all: async function () {
            this.selections = [];
            if (this.is_cookie()) {
                window.ModularForms.Mixins.Cookies.delete(this.cookieName);
            }
        },
        update: function () {
            if (this.is_cookie()) {
                const updated_values = JSON.stringify([...this.selections]);
                window.ModularForms.Mixins.Cookies.update(this.cookieName, updated_values);
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.results-cloud {
    max-height: 300px;
    overflow: auto;
    background: #fff;
}
</style>
