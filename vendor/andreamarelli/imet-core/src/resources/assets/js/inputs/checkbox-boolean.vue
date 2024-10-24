<template>
    <span class="checkbox" :class="dataClass">
        <input type="checkbox" :name="id" :id="'bool-check_' + id" :checked="isChecked" @click="checkChange" />
        <label :for="'bool-check_' + id" v-html="label"></label>
    </span>
</template>

<script setup>
import { ref, computed, watch, onBeforeMount, onMounted } from 'vue';

const props = defineProps({
    id: { type: String, default: '' },
    value: { type: [String, Number, Boolean, Array, Object], default: null },
    dataClass: { type: String, default: '' },
    dataRules: { type: String, default: '' },
    dataNumeric: { type: Boolean, default: false },
    label: { type: String, default: null },
});

const emit = defineEmits(['update:modelValue']);

const inputValue = ref(props.value === true || props.value === "1" || props.value === 1);

const isChecked = computed(() => {
    return inputValue.value === true || inputValue.value === 1 || inputValue.value === "1";
});

watch(() => props.value, (newValue) => {
    inputValue.value = newValue;
});

const checkChange = () => {
    inputValue.value = !inputValue.value;
    setModuleValue();
};

const emitValue = (value) => {
    emit('update:modelValue', value);
};

onBeforeMount(() => {
    if (props.value === null) {
        setModuleValue();
    }
});

onMounted(() => {
    document.querySelector('.checkbox').classList.remove('field-edit');
});

const setModuleValue = () => {
    let moduleValue = false;
    if(props.dataNumeric){
        moduleValue = inputValue.value ? true : false;
    } else {
        moduleValue = inputValue.value;
    }
    emitValue(moduleValue);
};
</script>
