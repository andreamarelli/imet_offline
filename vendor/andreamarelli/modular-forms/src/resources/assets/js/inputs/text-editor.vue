<template>

    <ckeditor
        :editor="editor"
        :model-value="editorData"
        :config="editorConfig"
    ></ckeditor>

</template>

<script>
    import { ClassicEditor, Essentials, Paragraph, Undo, Bold, Italic, Link, List, Heading } from "~/ckeditor5";
    import CKEditor from "~/@ckeditor/ckeditor5-vue";
    import "~/ckeditor5/dist/ckeditor5.css";

    export default {

        components: {
            ckeditor: CKEditor.component
        },

        data() {
            return {
                editor: ClassicEditor,
                editorData: null,
                editorConfig: {
                    plugins: [
                        Essentials, Paragraph, Undo, // mandatory plugins (seems not to work without them)
                        Italic, Bold, Link, List, Heading
                    ],
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList'],
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                            { model: 'heading2', view: 'h2', title: 'Heading', class: 'ck-heading_heading2' }
                        ]
                    }
                }
            };
        }
    }

</script>
