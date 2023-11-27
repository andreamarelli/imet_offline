<template>
    <div class="module-container">
        <div class="module-header">
            <div class="module-title">{{ Locale.getLabel('imet-core::oecm_report.general_planning.objectives_title') }}</div>
        </div>
        <div class="module-body">
            <div class="row">
                <div class="col"><h4>{{ Locale.getLabel('imet-core::oecm_report.general_planning.intervention_context') }}</h4></div>
                <div class="col"><h4>{{ Locale.getLabel('imet-core::oecm_report.general_planning.prioritize_in_management') }}</h4></div>
            </div>
            <div v-for="(objective, index) in objectives['context']" class="row mt-3">
                <div v-html="objective" class="col"></div>
                <div class="col text-center">
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
                </div>
            </div>
            <div class="row mt-4">
                <div class="col"><h4>{{ Locale.getLabel('imet-core::oecm_report.general_planning.management_evaluation') }}</h4></div>
                <div class="col"><h4>{{ Locale.getLabel('imet-core::oecm_report.general_planning.prioritize_in_management') }}</h4></div>
            </div>
            <div v-for="(objective, index) in objectives['evaluation']" class="row mt-3">
                <div v-html="objective" class="col"></div>
                <div class="col text-center">
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
                </div>
            </div>
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
        const objectives = JSON.parse(this.report[0]['objectives']);
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
