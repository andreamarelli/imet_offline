<template>

    <div class="score-bar text-2xs">

        <div v-if="showLimits && min!==null" class="score-bar__limit-left">{{ min }}%</div>

        <progress_bar
            :value=score_value
            :color=color
            :negative=negative
        ></progress_bar>

        <div v-if="showLimits && max!==null" class="score-bar__limit-right">{{ max }}%</div>

    </div>

</template>

<style lang="scss" scoped>

    .score-bar{
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        width: 100%;
        align-items: center;
        margin: 1px 0;

      .score-bar__limit-left,
      .score-bar__limit-right{
          width: 40px;
          font-weight: bold;
      }

        .score-bar__limit-left{
            text-align: right;
            padding-right: 3px;
        }

        .score-bar__limit-right{
            text-align: left;
            padding-left: 3px;
        }
    }

</style>

<script setup>

import { computed } from "vue";
import progress_bar from "./progress_bar.vue";

const props = defineProps({
    value: {
        type: [String, Number],
        default: 0
    },
    color: {
        type: String,
        default: '#ccc'
    },
    showLimits: {
        type: Boolean,
        default: true
    },
    min: {
        type: Number,
        default: 0
    },
    max: {
        type: Number,
        default: 100
    },
});

const score_value = computed(() => {
    if(props.value === null) return null;
    return typeof props.value === 'number'
        ? props.value.toFixed(1)
        : parseFloat(props.value).toFixed(1);
});

const negative = computed(() => {
    return props.value < 0 || props.min < 0;
});


</script>
