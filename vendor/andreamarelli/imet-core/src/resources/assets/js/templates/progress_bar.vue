<template>

    <div class="progress-bar" >
        <div class="bar" :class="{'float-right': negative}" :style=style v-if="value!==null"></div>
        <div class="label" v-if="value!==null">
            {{ value }}% {{ additional_label }}
        </div>
    </div>

</template>

<style lang="scss" scoped>

    .progress-bar{
        position: relative;
        flex-grow: 1;
        border-radius: 4px;
        min-height: 24px;
        @apply bg-gray-100;
        .bar{
            min-height: 24px;
            border-radius: 4px;
        }
        .label{
            position: absolute;
            top: 35%;
            width: 100%;
            text-align: center;
            font-weight: bold;
        }
    }

</style>

<script setup>

import { computed } from "vue";

const props = defineProps({
    value: {
        type: [Number, String],
        default: () => 0
    },
    color: {
        type: String,
        default: () => ''
    },
    additional_label: {
        type: String,
        default: () => ''
    },
    digit:  {
        type: Number,
        default: () => 2
    },
    negative: {
        type: Boolean,
        default: false
    }
});

const style = computed(() => {
    return 'width: ' +  Math.abs(props.value).toFixed(props.digit) + '%; background-color: ' + props.color + ' !important;';
});

</script>

