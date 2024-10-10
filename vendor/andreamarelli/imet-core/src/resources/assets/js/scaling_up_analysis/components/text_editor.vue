<template>
    <div>
        <div class="text-editor-edit">
            <ckeditor :editor="editor" v-model="editorData" :config="editorConfig" @input="onEditorInput" />
        </div>
        <div class="text-editor-print" v-html=editorData></div>
    </div>
</template>


<style lang="scss" scoped>
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
<style>
.ck.ck-editor {
    max-width: none;
}
</style>

<script setup>
import { ref, watch, inject, onMounted } from 'vue';
import { ClassicEditor, Essentials, Paragraph, Undo, Bold, Italic, Link, List, Heading } from "~/ckeditor5";
import CKEditor from "~/@ckeditor/ckeditor5-vue";
import "~/ckeditor5/dist/ckeditor5.css";

const props = defineProps({
    value: { type: String, default: '' },
    save_data: { type: Boolean, default: false },
    event_id: { type: String, default: 'save_comments' }
});

const emitter = inject('emitter');
const ckeditor = CKEditor.component
const editor = ClassicEditor;
const editorData = ref('');
const editorConfig = {
    plugins: [
        Essentials, Paragraph, Undo, // mandatory plugins (seems not to work without them)
        Italic, Bold, Link, List, Heading
    ],
    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList'],
    heading: {
        options: [
            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
            { model: 'heading2', view: 'h2', title: 'Heading', class: 'ck-heading_heading2' }
        ]
    }
};

watch(() => props.value, (newValue) => {
    if (newValue !== editorData.value) {
        editorData.value = newValue;
    }
});

onMounted(() => {
    emitter.on('save_comments', (func, attr) => {
        func(editorData.value || '', attr);
    });
});

const onEditorInput = (value) => {
    editorData.value = value;
};
</script>
