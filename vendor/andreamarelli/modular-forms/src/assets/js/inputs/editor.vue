<template>

    <div>
        <div class="text-editor-edit">
            <ckeditor :editor="editor" v-model="editorData" :config="editorConfig" @input="onEditorInput" />
        </div>
        <div class="text-editor-print" v-html=editorData></div>
    </div>

</template>


<style lang="scss" scoped>
      .text-editor-edit{
          @media print {
              display: none;
          }
      }
      .text-editor-print{
          background-color: white !important;
          padding: 15px;
          @media screen {
              display: none;
          }
      }
</style>

<script>

    export default {

        name: "editor",

        components: {
            ckeditor: window.CKEditor.component
        },

        props: {
            value: ''
        },

        watch: {
          value(value){
            // Used on reset
            if(value!==this.editorData){
              this.editorData = value;
            }
          }
        },

        data() {
            return {
                editor: window.ClassicEditor,
                editorData: this.value,
                editorConfig: {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList' ],
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                            { model: 'heading2', view: 'h2', title: 'Heading', class: 'ck-heading_heading2' }
                        ]
                    }
                }
            };
        },

        methods:{
            onEditorInput(value){
                this.$emit('update', this.editorData);
            }
        }
    }

</script>
