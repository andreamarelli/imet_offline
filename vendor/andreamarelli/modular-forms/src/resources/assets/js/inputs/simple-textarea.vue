<template>

    <span>
        <span v-if="disabled" :id=id class="field-preview disabled" v-on:input="onInput" v-text="inputValue"></span>
        <span v-else :id=id class="field-preview" contenteditable v-on:input="onInput" v-text="inputValue"></span>
    </span>

</template>

<script setup>

    const props = defineProps({
        id: {
            type: String,
            default: null
        },
        disabled: {
            type: Boolean,
            default: false
        }
    });

    const inputValue = defineModel();

    function onInput(e) {
        inputValue.value = e.target.innerText;
    }

</script>
