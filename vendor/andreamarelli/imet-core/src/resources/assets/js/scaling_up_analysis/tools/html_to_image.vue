<template></template>
<script setup>
import { inject } from 'vue'
import { useHtmlToImage } from "../composables/html_to_image";

const props = defineProps({
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
});

const emitter = inject('emitter');


const {
    htmlToImage
} = useHtmlToImage(props, emitter);
</script>
