<template>
    <div>
        <slot></slot>
    </div>
</template>

<script setup>

import { provide } from 'vue';

import LocalStore from './../stores/local.storage.store';
import basket_store from './../stores/basket.store';
import base_store from './../stores/base.store';

const props = defineProps({
    scaling_up_id: {
        type: Number,
        default: 0
    },
    labels: {
        type: String,
        default: ""
    }
});

const initializeScalingUpLabels = () => {
    window.ScalingUp = {};
    window.ScalingUp.labels = function (label) {

        return props.labels[label] ?? label;
    }
};

initializeScalingUpLabels();

import config from './../config/config.js';

const stores = {
    BasketStore: new basket_store({ scaling_up_id: props.scaling_up_id }),
    BaseStore: new base_store({ scaling_up_id: props.scaling_up_id }),
    LocalStore
};

provide('stores', stores);
provide('config', config);
</script>
