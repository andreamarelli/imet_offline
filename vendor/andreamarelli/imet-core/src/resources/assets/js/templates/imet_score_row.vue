<template>

    <div class="histogram-row" :class="{'border-b border-gray-400 pb-2 mb-2': isHeader}">

        <!-- code -->
        <div class="histogram-row__code text-center font-bold" v-if="!isHeader && code!=null">{{ code }}</div>

        <!-- label -->
        <div class="histogram-row__title text-left" :class="{'text-xl font-bold text-primary-600': isHeader, 'short': shortLabel || isHeader}">{{ label }}</div>

        <!-- value -->
        <div class="histogram-row__value text-right font-bold">{{ format(value) }}</div>

        <!-- histogram -->
        <div class="histogram-row__progress-bar text-2xs pl-4" :style=grid_according_to_histogram_type>

            <template v-if="histogram_type==='0_to_100_full_width'">
                <imet_score_bar
                    :value=format(value)
                    :color=color
                ></imet_score_bar>
            </template>

            <template v-else-if="histogram_type==='0_to_100'">
                <div class="histogram-row__progress-bar__spacer"></div>
                <imet_score_bar
                    :value=format(value)
                    :color=color
                ></imet_score_bar>
            </template>

            <template v-else-if="histogram_type==='minus100_to_0'">
                <imet_score_bar
                    :value=format(value)
                    :color=color
                    :min=-100
                    :max=0
                ></imet_score_bar>
                <div class="histogram-row__progress-bar__spacer"></div>
            </template>

            <template v-else-if="histogram_type==='minus100_to_100'">
                <imet_score_bar
                    :value="format(value)<0 ? format(value): null"
                    :color=color
                    :min=-100
                    :max=null
                ></imet_score_bar>
                <imet_score_bar
                    :value="format(value)>0 ? format(value): null"
                    :color=color
                    :min=null
                    :max=100
                ></imet_score_bar>
            </template>

        </div>
    </div>

</template>


<script setup>

import { computed } from "vue";
import imet_score_bar from "./imet_score_bar.vue";

const props = defineProps({
    value: {
        type: [String, Number],
        default: null
    },
    code: {
        type: String,
        default: null
    },
    label: {
        type: String,
        default: null
    },
    color: {
        type: String,
        default: '#aaa'
    },
    histogram_type: {
        type: String,
        default: '0_to_100_full_width'
    },
    isHeader: {
        type: Boolean,
        default: false
    },
    shortLabel: {
        type: Boolean,
        default: false
    }
});

const grid_according_to_histogram_type = computed(() => {
    if(props.histogram_type === '0_to_100') {
        return 'display: grid; grid-template-columns: calc(50% - 40px)  calc(50% + 40px);';
    }
    else if(props.histogram_type === 'minus100_to_0'){
        return 'display: grid; grid-template-columns: calc(50% + 40px)  calc(50% - 40px);';
    }
    else if(props.histogram_type === 'minus100_to_100'){
        return 'display: grid; grid-template-columns: 50% 50%;';
    }
    else {
        return '';
    }
});

function format(value) {
    if(value === null) return null;
    return typeof value === 'number'
        ? value.toFixed(1)
        : parseFloat(value).toFixed(1);
}



</script>