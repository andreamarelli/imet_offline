<template>
    <div>
        <div class="mb-2 mt-1">
            <slot :props="data"></slot>
        </div>
        <div class="mb-2 mt-2">
            <div class="mt-3 text-black-50 font-weight-bold generic-comments">{{ title }} :</div>
            <p>
                <editor :save_data="get_data" :event_id="event_data"></editor>
            </p>
            <div class="row">
                <div class="col">
                    <html_to_image :element="name"
                                   :exclude_elements="exclude_elements" :event_id="event_image"></html_to_image>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-success mb-1 float-right exclude-element" @click="save">
                        <div v-if="loading" class="spinner-border text-success float-right" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span
                            v-if="!loading" class="text-center">{{ stores.BaseStore.localization('imet-core::analysis_report.add_analysis') }}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import html_to_image from "../../tools/html_to_image.vue";
import editor from "./../editor.vue";

export default {
    name: "container_actions",
    components: {
        html_to_image,
        editor
    },
    inject: ['stores'],
    props: {
        name: {
            type: String,
            default: null
        },
        exclude_elements: {
            type: String,
            default: ''
        },
        event_image: {
            type: String,
            default: 'save_image'
        },
        event_data: {
            type: String,
            default: 'save_data'
        },
        comment_title: {
            type: String,
            default: null
        },
        data: {
            type: [Object, Array],
            default: () => {

            }
        },
        show_comments: {
            type: Boolean,
            default: true
        }
    },
    mounted() {
        if (this.comment_title === null) {
            this.title = this.stores.BaseStore.localization('imet-core::analysis_report.comments');
        } else {
            this.title = this.comment_title;
        }
    },
    data() {
        return {
            get_data: false,
            loading: false,
            title: '',
            values: {
                image_src: null,
                comment: null
            }
        }
    },
    watch: {
        values: {
            async handler(n, o) {
                if (n.image_src && n.comment != null) {
                    const item = await this.stores.BasketStore.save(n);
                    window.vueBus.$emit('add-section-template', item);
                    this.loading = false;
                }
            },
            deep: true
        }
    },
    methods: {
        add: function (val, attr) {
            this.values[attr] = val;
        },
        save: async function () {
            this.loading = true;
            this.values = {
                image_src: null,
                comment: null
            }

            if (this.event_image === 'save_image') {
                this.$emit('save_data', this.values, this.add, 'image_src');
            } else {
                this.$emit('save_entire_block_as_image', this.values, this.add, 'image_src');
            }
            this.$emit('save_comments', this.values, this.add, 'comment');
        }
    }
}
</script>

<style scoped>

</style>
