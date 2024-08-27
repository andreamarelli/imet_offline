<template>
    <div class="smallMenu" style="min-height: 80px;">
        <div class="standalone js-smallMenu" id="smallMenu" v-if="list_names.length > 1">
            <div :class="is_selected(idx)" v-for="(item, idx) in list_names" v-html="item[1]"
                 @click="scroll_to_section(item[0])">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "small_menu_analysis_per_elements",
    props: {
        items: {
            type: [Object, Array],
            default: () => {
                return {};
            }
        },
        exclude: {
            type: String,
            default: ''
        },
        ids: {
            type: String,
            default: ''
        },
        root_dir: {
            type: String,
            default: ''
        }
    },
    data: function () {
        return {
            list_names: [],
            excluded_items: [],
            selection: null
        }
    },
    mounted() {

        this.list_items();
    },
    methods: {
        list_items: function () {
            this.exclude_items();
            const object_entries = Object.entries(this.items);
            if (object_entries.length > 0) {
                object_entries.forEach((item, index) => {
                    if (!this.excluded_items.includes(item[0])) {
                        if (item[1].length) {
                            item[1].forEach((v, idx) => {
                                const {menu, name} = v;
                                const menu_item = [];
                                menu_item.push('header');
                                menu_item.push(item[0]);
                                menu_item.push(name);
                                this.list_names.push([menu_item.join('-'), menu.header]);
                            })
                        } else {
                            this.list_names.unshift(item[1])
                        }
                    }
                })
            }
        },
        exclude_items: function () {
            this.excluded_items = this.exclude.split(',');
        },
        scroll_to_section: function (idx) {
            const element = document.getElementById(this.ids + idx);
            element.scrollIntoView({behavior: "smooth"});
            this.selection = idx;
        },
        is_selected: function (index) {
            return this.selection === index ? 'active' : '';
        }
    }
}
</script>
