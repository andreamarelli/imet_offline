<template>
    <div class="mt-2">
        <div class="text-editor-edit" v-if="props.action === 'edit'">
            <editor :model-value="modelValue" @update:modelValue="updateContent"></editor>
        </div>
        <div v-else-if="props.action === 'show'" class="field-preview" style="max-width: none; margin-bottom: 10px;">
            <div v-html="modelValue"></div>
        </div>
        <div class="text-editor-print" v-html=modelValue></div>
    </div>
</template>

<script setup>
const props = defineProps({
    modelValue: {
        type: String,
        required: true
    },
    action: {
        type: String,
        required: true,
        validator: (value) => ['edit', 'show'].includes(value)
    },
    field: {
        type: String,
        required: true
    }
});

const emit = defineEmits(['update:modelValue']);

const updateContent = (value) => {
    emit('update:modelValue', value);
};
</script>

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
