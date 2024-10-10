<template>
    <div :style="'margin-top: -' + margin + 'px'">
        <div v-for="(radar, index) in values" :id="'radar' + index" :key="index">
            <container_actions :data="radar" :name="'radar' + index" :event_image="'save_entire_block_as_image'">
                <template v-slot:default="data_elements">
                    <div class="w-full" :id="'upper_lower_' + index">
                        <scaling_radar class="col-sm" :width="width" :height="height" :single="single"
                            :unselect_legends_on_load="unselect_legends_on_load" :show_legends="show_legends"
                            :values='data_elements.props' :indicators='indicators' :event_key="'up_' + index"
                            :refresh_average=false :key="'asd_' + index"></scaling_radar>
                    </div>
                    <datatable_interact_with_radar :values_with_indicators_keys="true" :refresh_average=false
                        :values="data_elements.props" :columns="columns" :event_key="'up_' + index">
                    </datatable_interact_with_radar>

                </template>
            </container_actions>
        </div>

    </div>
</template>
<script setup>
import { ref, onMounted, inject } from 'vue';

const props = defineProps({

    width: {
        type: Number,
        default: 180
    },
    height: {
        type: Number,
        default: 180
    },
    indicators: {
        type: [Array, Object],
        default: () => {
        }
    },
    show_legends: {
        type: Boolean,
        default: false
    },
    single: {
        type: Boolean,
        default: true
    },
    showOnlyScaling: {
        type: Boolean,
        default: false
    },
    unselect_legends_on_load: {
        type: Boolean,
        default: false
    },
    radar: {
        type: [Array, Object],
        default: () => {

        }
    },
    refresh_average: {
        type: Boolean,
        default: false
    }
});
const values = ref([]);
const data = ref({});
const margin = ref('0px');
const columns = [
    {
        "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.protected_area.protected_area'),
        "field": "name"
    },
    {
        "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.context'),
        "field": "context"
    },
    {
        "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.planning'),
        "field": "planning",
    },
    {
        "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.inputs'),
        "field": "inputs"
    },
    {
        "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.process'),
        "field": "process"
    },
    {
        "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.outputs'),
        "field": "outputs"
    },
    {
        "label": window.ModularForms.Helpers.Locale.getLabel('imet-core::common.steps_eval.outcomes'),
        "field": "outcomes"
    }
];

onMounted(() => {
    const data = {
        'Average': props.radar['Average'],
        'lower limit': { ...props.radar['lower limit'] },
        'upper limit': { ...props.radar['upper limit'] }
    };

    const entries = Object.entries(props.radar);
    if (entries.length > 0) {
        props.margin = 22 * entries.length;
    }

    entries.forEach(([key, value]) => {
        if (!['Average', 'lower limit', 'upper limit'].includes(key)) {
            const item = { ...data };
            item[key] = value;
            values.value.unshift(
                item
            );
        }
    });
});

</script>
