<template>
    <div class="module-container">
        <div class="module-header">
            <div class="module-title">{{ Locale.getLabel('imet-core::oecm_report.general_planning.objectives_title') }}</div>
        </div>
        <div class="module-body">

            <table class="max-w-6xl">
                <tr>
                    <th class="w-8/12">{{ Locale.getLabel('imet-core::oecm_report.general_planning.intervention_context') }}</th>
                    <th>{{ Locale.getLabel('imet-core::oecm_report.general_planning.prioritize_in_management') }}</th>
                </tr>
                <tr v-for="(objective, index) in objectives['context']" class="mt-3">
                    <td v-html="objective" ></td>
                    <td class="col text-center">
                        <span class="checkbox">
                        <input type="checkbox"
                               :checked="is_checked(index)"
                               :data-name="objective"
                               :id="objective"
                               @click="selectValueByIdAndValue(index, objective)"
                               class="vue-checkboxes"
                               :value="index">
                            <label :for="objective"></label>
                        </span>
                    </td>
                </tr>
            </table>

            <table class="max-w-6xl">
                <tr>
                    <th class="w-8/12">{{ Locale.getLabel('imet-core::oecm_report.general_planning.management_evaluation') }}</th>
                    <th>{{ Locale.getLabel('imet-core::oecm_report.general_planning.prioritize_in_management') }}</th>
                </tr>
                <tr v-for="(objective, index) in objectives['evaluation']" class="mt-3">
                    <td v-html="objective" ></td>
                    <td class="col text-center">
                        <span class="checkbox">
                        <input type="checkbox"
                               :checked="is_checked(index)"
                               :data-name="objective"
                               :id="objective"
                               @click="selectValueByIdAndValue(index, objective)"
                               class="vue-checkboxes"
                               :value="index">
                        <label :for="objective"></label>
                        </span>
                    </td>
                </tr>
            </table>

        </div>
    </div>
</template>

<script>
export default {
    name: "objectives",
    mixins: [
        window.ModularForms.MixinsVue.checkboxes
    ],
    props: {
        report: {
            type: [Object, Array],
            default: () => {
            }
        },
        objectives: {
            type: Object,
            default: () => {
            }
        }
    },
    mounted: function () {
        let data = '{}';
        if('objectives' in this.report[0] && this.report[0]['objectives']) {
            data = this.report[0]['objectives'];
        }
        const objectives = JSON.parse(data);
        this.checkboxes = Array.isArray(objectives) ? objectives : [];
    },
    data() {
        return {
            Locale: window.Locale,
            current_objectives: null
        }
    },
    methods: {

        selectValueByIdAndValue: function (id, value) {
            if (this.is_value_included(id)) {
                this.checkboxes = this.checkboxes.filter(item => item.id !== id);
            } else {
                this.checkboxes.push({id, value});
            }
            this.report[0]['objectives'] = JSON.stringify(this.checkboxes);
        },
        is_value_included(id) {
            if(this.checkboxes.length) {
                return this.checkboxes.some(check => {
                        return (check.id) === id
                    }
                )
            }

            return false;
        },
        is_checked(id) {
            if(this.checkboxes.length) {
                return this.checkboxes.some(checkbox => (checkbox.id) === id);
            }
            return false;
        },
    }
}
</script>

<style scoped>

</style>
