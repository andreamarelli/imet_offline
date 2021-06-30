<template>

  <div>
    <div class="text-editor-edit">
      <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"  @input="onEditorInput"/>
    </div>
    <div class="text-editor-print" v-html=editorData></div>
  </div>

</template>


<style lang="scss" type="text/scss" scoped>
.text-editor-edit {
  @media print {
    display: none;
  }
}

.text-editor-print {
  background-color: white !important;
  padding: 15px;
  @media screen {
    display: none;
  }
}
</style>

<script>

import CKEditor from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {

  name: "editor",
  inject:['state'],
  components: {
    ckeditor: CKEditor.component
  },

  props: {
    value: '',
    save_data: {
      type: Boolean,
      default: false
    },
    event_id: {
      type: String,
      default: 'save_comments'
    }
  },
  mounted(){
    const _this = this;
    this.$parent.$on('save_comments', (value, func, attr) => {

      func(_this.editorData || '' , attr);
      //value.comment = _this.editorData;
    } )
  },
  watch: {
    value(value) {
      // Used on reset
      if (value !== this.editorData) {
        this.editorData = value;
      }
    }
  },

  data() {
    return {
      editor: ClassicEditor,
      editorData: null,
      editorConfig: {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList'],
        heading: {
          options: [
            {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
            {model: 'heading2', view: 'h2', title: 'Heading', class: 'ck-heading_heading2'}
          ]
        }
      }
    };
  },

  methods: {
    onEditorInput(value) {
      console.log({value})
       this.editorData = value;
    }
  }
}

</script>