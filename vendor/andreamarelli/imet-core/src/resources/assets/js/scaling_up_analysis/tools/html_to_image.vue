<template></template>
<script>

export default {
    name: "html_to_image",
    inject: ['stores'],
    props: {
        element: {
            type: String,
            default: ''
        },
        exclude_elements: {
            type: String,
            default: null
        },
        event_id: {
            type: String,
            default: 'save_image'
        }
    },
    data: function () {
        return {
            random_element: '',
            unique_key: null
        }
    },
    async mounted() {
        const _this = this;
        this.create_random_element();
        this.$parent.$on('save_entire_block_as_image', async (value, func, attr) => {
            await _this.html_to_image(1024, func, attr);
        });
    },
    methods: {
        show_editor: function (element) {
            const block = element.querySelectorAll('.text-editor-edit');
            block.forEach(i => i.style.display = 'block');
            const none = element.querySelectorAll('.text-editor-print');
            none.forEach(i => i.style.display = 'none');
        },
        hide_editor: function (element) {
            const block = element.querySelectorAll('.text-editor-edit');
            block.forEach(i => i.style.display = 'none');
            const none = element.querySelectorAll('.text-editor-print');
            none.forEach(i => {
                if (i.innerText.length > 0) {
                    i.style.display = 'block'
                }
            });
        },
        html_to_image: async function (size = 1024, func, attr) {
            const element = document.getElementById(this.random_element);
            window.element = element;
            this.show_hide_excluded_elements();
            this.hide_editor(element);

            window.ImetCoreVendor.htmlToImage.toPng(document.getElementById(this.random_element), {
                canvasWidth: size,
                filter: (node) => {
                    const classNames = node?.className;
                    const id = node?.id;
                    if (typeof classNames !== 'string') {
                        return true;
                    }
                    const exclude = ['add_item', 'carrot', 'generic-comments', 'exclude-element', 'dropzone-areas', 'js-smallMenu', 'guidance'];

                    return !exclude.some(val => classNames.includes(val));
                }
            })
                .then(async function (dataUrl) {
                    func(dataUrl, attr)
                }).catch((error) => {

            }).finally(() => {
                this.show_editor(element);
                this.show_hide_excluded_elements('block');
            });
        },
        create_random_element: function () {
            if (!this.element) {
                this.random_element = `elem_${Math.floor(Math.random() * 1000)}`;
            } else {
                this.random_element = this.element;
            }
        },
        show_hide_excluded_elements: function (action = 'none') {
            if (this.exclude_elements.length > 0) {
                const exclude_elements = this.exclude_elements.split(',');

                exclude_elements.length > 0 && exclude_elements.forEach(el => {
                    const element = document.getElementById(el);
                    element.style.display = action;
                })


            }
        }

    }
}
</script>
