<template>

    <template v-if="scope===TERRESTRIAL_AND_MARINE || scope===TERRESTRIAL">
        <img style="height: 28px;" :src=terrestrialIcon class="inline mr-2" />
        <tooltip>{{ Locale.getLabel('imet-core::common.terrestrial') }}</tooltip>
    </template>

    <template v-if="scope===TERRESTRIAL_AND_MARINE || scope===MARINE">
        <img style="height: 28px;" :src=marineIcon class="inline mr-2" />
        <tooltip>{{ Locale.getLabel('imet-core::common.marine') }}</tooltip>
    </template>


</template>


<script setup>

import marineIcon from "../../images/fish.png";
import terrestrialIcon from "../../images/tree.png";

const Locale = window.ModularForms.Helpers.Locale;

const props = defineProps({
    scope :  {
        type: String,
        default: null
    }
});

const TERRESTRIAL_AND_MARINE = 'terrestrial_and_marine';
const TERRESTRIAL = 'terrestrial';
const MARINE = 'marine';

</script>