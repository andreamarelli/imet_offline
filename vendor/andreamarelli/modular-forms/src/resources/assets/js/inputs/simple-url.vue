<template>

    <simple-text
        v-model=inputValue
        :id=id
        :name=id
        :data-rules="dataRules!=='' ? dataRules+'|url' : 'url'"
    ></simple-text>

</template>

<script setup>

    const props = defineProps({
        id: {
            type: String,
            default: null
        },
        dataRules: {
            type: String,
            default: ''
        },
    });

    const inputValue = defineModel();

</script>
