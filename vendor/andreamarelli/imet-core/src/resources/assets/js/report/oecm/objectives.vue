<template>
    <div class="module-container">
        <div class="module-header">
            <div class="module-title">{{ Locale.getLabel('imet-core::oecm_report.general_planning.objectives_title') }}
            </div>
        </div>
        <div class="module-body">

            <table class="max-w-12xl">
                <tr>
                    <th class="w-8/12">{{
                        Locale.getLabel('imet-core::oecm_report.general_planning.intervention_context') }}</th>
                    <th>{{ Locale.getLabel('imet-core::oecm_report.general_planning.prioritize_in_management') }}</th>
                </tr>
                <tr v-for="(objective, index) in objectives['context']" class="mt-3" :key="index">
                    <td v-html="objective"></td>
                    <td class="col text-center">
                        <span class="checkbox">
                            <input type="checkbox" :checked="is_checked(index)" :data-name="objective" :id="objective"
                                @click="selectValueByIdAndValue(index, objective)" class="vue-checkboxes"
                                :value="index">
                            <label :for="objective"></label>
                        </span>
                    </td>
                </tr>
            </table>

            <table class="max-w-12xl">
                <tr>
                    <th class="w-8/12">{{
                        Locale.getLabel('imet-core::oecm_report.general_planning.management_evaluation') }}</th>
                    <th>{{ Locale.getLabel('imet-core::oecm_report.general_planning.prioritize_in_management') }}</th>
                </tr>
                <tr v-for="(objective, index) in objectives['evaluation']" class="mt-3" :key="index">
                    <td v-html="objective"></td>
                    <td class="col text-center">
                        <span class="checkbox">
                            <input type="checkbox" :checked="is_checked(index)" :data-name="objective" :id="objective"
                                @click="selectValueByIdAndValue(index, objective)" class="vue-checkboxes"
                                :value="index">
                            <label :for="objective"></label>
                        </span>
                    </td>
                </tr>
            </table>

        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';

const props = defineProps({
    report: {
        type: [Object, Array],
        default: () => ({})
    },
    objectives: {
        type: Object,
        default: () => ({})
    }
});

const Locale = window.ModularForms.Helpers.Locale;
const checkboxes = ref([]);
const are_checked_all = ref(false);
const saveDisabled = ref(false);
const listItems = ref([]);

onMounted(() => {
    let data = '{}';
    if ('objectives' in props.report[0] && props.report[0]['objectives']) {
        data = props.report[0]['objectives'];
    }
    const objectives = JSON.parse(data);
    checkboxes.value = Array.isArray(objectives) ? objectives : [];
});

const selectValue = (value) => {
    if (checkboxes.includes(value)) {
        checkboxes = checkboxes.filter(item => item !== value);
    } else {
        checkboxes.push(value);
        selected();
    }
}

const selectValueByIdAndValue = (id, value) => {
    if (is_value_included(id)) {
        checkboxes.value = checkboxes.value.filter(item => item.id !== id);
    } else {
        checkboxes.value.push({ id, value });
    }
    props.report[0]['objectives'] = JSON.stringify(checkboxes.value);
};

const is_value_included = (id) => {
    if (checkboxes.value.length) {
        return checkboxes.value.some(check => check.id === id);
    }
    return false;
};

const is_checked = (id) => {
    if (checkboxes.value.length) {
        return checkboxes.value.some(checkbox => checkbox.id === id);
    }
    return false;
};

const initSettings = (items) => {
    listItems.value = items;
}

const toggle = () => {
    saveDisabled.value = checkboxes.value.length === 0;
}

const check_all = () => {
    if (!are_checked_all.value) {
        const checkboxes = [...document.querySelectorAll(".vue-checkboxes")];
                for (const key in checkboxes) {
                    if (key > 0) {
                        const check_box = checkboxes[key];
                        const exist = is_value_included(parseInt(check_box.defaultValue));
                        if(!exist) {
                            checkboxes.push({
                                id: check_box.defaultValue,
                                value: check_box.getAttribute('data-name')
                            });
                        }
                    }
                }
    } else {
        clearSelections();
    }
    selected();
}

const clearSelections = () => {
    checkboxes.value = [];
    are_checked_all.value = false;
}


</script>
<style scoped></style>
