<template>
    <div>
        <div class="row">
            <div v-if="pas.length > 0" class="col-4" v-for="(selection, i) in pas" :key="i">
                <div class=" alert alert-warning alert-dismissible" role="alert">
                    <input type="checkbox"
                           :checked="is_checked(selection.FormID)"
                           :data-name="selection.name"
                           @click="selectValue(selection.FormID)"
                           class="vue-checkboxes"
                           :value="selection.FormID">
                    <strong>{{ selection.name }}</strong>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
            </div>
            <div class="col">
                <button :disabled="button_status()" @click="enable_overall()" class="btn btn-success">{{
                        stores.BaseStore.localization('imet-core::analysis_report.apply')
                    }}
                </button>
                <button @click="check_all()" class="btn btn-success">{{
                        stores.BaseStore.localization('imet-core::analysis_report.select_all')
                    }}
                </button>
                <button @click="clearSelections()" class="btn btn-danger">{{
                        stores.BaseStore.localization('imet-core::analysis_report.reset')
                    }}
                </button>
            </div>
            <div class="col">
            </div>
        </div>

        <div v-if="show_overall">
            <slot :props="{'ids':checkboxes_ids(), 'show_view': show_overall }"></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "checkboxes_list",
    inject: ['stores'],
    mixins: [
        window.ModularForms.MixinsVue.checkboxes
    ],
    props: {
        items: {
            type: Object,
            default: () => {
            }
        },
        event: {
            type: String,
            default: ''
        },
        minimum_valid_items: {
            type: Number,
            default: 1
        }
    },
    data: function () {
        return {
            pas: [],
            show_overall: false
        }
    },
    mounted() {
        const areas = [];
        Object.entries(this.items).forEach(val => {
            areas.push({'FormID': val[0], 'name': val[1]})
        });
        areas.sort((a, b) => a.name.localeCompare(b.name));
        this.pas = areas;
    },
    methods: {
        is_checked(id) {
            return this.checkboxes.some(checkbox => {
                return parseInt(checkbox) === parseInt(id);
            });
        },
        selectValue(value) {
            if (this.checkboxes.includes(value)) {
                this.checkboxes = this.checkboxes.filter(item => item !== value);
            } else {
                this.checkboxes.push(value);
                this.selected();
            }

            this.show_overall = false;
        },
        checkboxes_ids: function () {
            return this.checkboxes.join(',');
        },
        enable_overall: function () {
            if (this.event) {
                this.$parent.$emit(this.event, this.checkboxes_ids())
            } else {
                if (this.show_overall) {
                    setTimeout(() => {
                        this.show_overall = !this.show_overall;
                    }, 500)
                }
                this.show_overall = !this.show_overall;
            }

        },
        button_status: function () {
            if (this.checkboxes.length > this.minimum_valid_items) {
                return false
            }

            return true;
        },
        check_all: function () {
            if (!this.are_checked_all) {
                const checkboxes = [...document.querySelectorAll(".vue-checkboxes")];
                for (const key in checkboxes) {
                    const check_box = checkboxes[key];
                    const exist = this.is_checked(check_box.defaultValue);
                    if (!exist) {
                        this.checkboxes.push(check_box.defaultValue);
                    }
                }
                this.are_checked_all = true;
            } else {
                this.clearSelections();
            }
            this.selected();
        },
    }

}
</script>
