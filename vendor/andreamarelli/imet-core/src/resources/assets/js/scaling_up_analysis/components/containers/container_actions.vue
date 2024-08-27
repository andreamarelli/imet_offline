<template>
    <div>
        <div class="mb-2 mt-1">
            <slot :props="data"></slot>
        </div>
        <div class="mb-2 mt-2">

            <div v-if="show_comments" class="mt-3 text-black-50 font-bold generic-comments">{{ title }} :</div>

            <editor
                v-if="show_comments"
                :save_data="get_data"
                :event_id="event_data"
            ></editor>

            <html_to_image
                :element="name"
                :exclude_elements="exclude_elements"
                :event_id="event_image"
            ></html_to_image>

            <div class="text-right">
                <button type="button" class="btn-nav my-3 exclude-element" @click="save">
                    <span v-if="loading">
                        <i class="fa fa-spinner fa-spin text-primary-800"></i>
                        <span class="sr-only">Loading...</span>
                    </span>
                        <span v-if="!loading" class="text-center">
                        {{ stores.BaseStore.localization('imet-core::analysis_report.add_analysis') }}
                    </span>
                </button>
            </div>

        </div>
    </div>

</template>

<script>
import html_to_image from "../../tools/html_to_image.vue";
import editor from "./../text_editor.vue";

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
                if (n.image_src && ((this.show_comments && n.comment != null) || !this.show_comments)) {
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
