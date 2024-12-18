<template>

    <span>
        <input type="password"
               :id=id
               :name=id
               v-model="inputValue"
               class="field-edit"
               autocomplete="off"
        />
    </span>

</template>

<script setup>

    const props = defineProps({
        id: {
            type: String,
            default: null
        },
        tooltipEnabled: {
            type: Boolean,
            default: true
        }
    });

    const inputValue = defineModel();

</script>
