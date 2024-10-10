<template>
    <button :class="className" v-on:click="action">
        {{ label }}
    </button>
</template>


<script setup>
import {inject, onMounted, ref} from "vue";

const props = defineProps({
    event: {
        type: String,
        default: '',
    },
    className: {
        type: String,
        default: 'btn-nav float-left'
    },
    label: {
        type: String,
        default: 'Submit'
    }
});

const data = ref([]);
const isEnabled = ref(false);
const emitter = inject('emitter');

onMounted(() => {
       emitter.on('actionData', (data) => {
            eventFunction(data);
        })
})

function eventFunction(value) {
    data.value = value;
    isEnabled.value = true;
}
function resetValues() {
    isEnabled.value = false;
    data.value = [];
}
function action() {
    if (props.event) {
        emitter.emit(props.event);
        resetValues();
    }

}

</script>
