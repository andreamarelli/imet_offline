<template>
    <div class="module-container">
        <div class="module-header">
            <div class="module-title">{{ Locale.getLabel('imet-core::oecm_report.possible_roadmap') }}</div>
        </div>
        <div class="module-body" v-if="current_report">
            <div class="row">
                <div class="col-8">
                    <h3>{{ Locale.getLabel('imet-core::oecm_report.long_term_objectives') }}</h3>
                </div>
                <div class="col"><h5>{{ Locale.getLabel('imet-core::oecm_report.year') }}1</h5></div>
                <div class="col"><h5>{{ Locale.getLabel('imet-core::oecm_report.year') }}2</h5></div>
                <div class="col"><h5>{{ Locale.getLabel('imet-core::oecm_report.year') }}3</h5></div>
                <div class="col"><h5>{{ Locale.getLabel('imet-core::oecm_report.year') }}4</h5></div>
                <div class="col"><h5>{{ Locale.getLabel('imet-core::oecm_report.year') }}5</h5></div>
            </div>
            <div class="row">
                <div class="col-8">
                    <editor v-model=current_report.long_term v-on:update="current_report.long_term = $event"
                            v-if="action='edit'"></editor>
                </div>

                <div v-for="year in [1,2,3,4,5]" class="col">
                    <checkbox-boolean v-model="current_report['long_term_year'+year]"
                                      :id="current_report['group_key']+'_long_term_year'+year"></checkbox-boolean>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <h5>{{ Locale.getLabel('imet-core::oecm_report.outcome') }}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <editor v-model=current_report.outcome v-on:update="current_report.outcome = $event"
                            v-if="action='edit'"></editor>

                </div>

                <div v-for="year in [1,2,3,4,5]" class="col">
                    <checkbox-boolean v-model="current_report['outcome_year'+year]"
                                      :id="current_report['group_key']+'_outcome_year'+year"></checkbox-boolean>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <h3>{{ Locale.getLabel('imet-core::oecm_report.annual_multi_annual_targets') }}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <editor v-model=current_report.annual_targets v-on:update="current_report.annual_targets = $event"
                            v-if="action='edit'"></editor>
                </div>

                <div v-for="year in [1,2,3,4,5]" class="col">
                    <checkbox-boolean v-model="current_report['annual_targets_year'+year]"
                                      :id="current_report['group_key']+'_annual_targets_year'+year"></checkbox-boolean>
                </div>

            </div>
            <div v-for="intervention in intervention_list">
                <div class="row">
                    <div class="col">
                        <h4>{{ Locale.getLabel('imet-core::oecm_report.intervention') }} {{ intervention }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <editor v-model="current_report['intervention'+intervention]"
                                v-on:update="current_report['intervention'+intervention] = $event"
                                v-if="action='edit'"></editor>
                    </div>

                    <div v-for="year in [1,2,3,4,5]" class="col">
                        <checkbox-boolean v-model="current_report['intervention'+intervention+'_year'+year]"
                                          :id="current_report['group_key']+'_intervention'+intervention+'_year'+year"></checkbox-boolean>
                    </div>

                </div>
                <div class="row">
                    <div class="col-5">
                        <h5>{{ Locale.getLabel('imet-core::oecm_report.activity') }}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <editor v-model="current_report['intervention'+intervention+'_activity']"
                                v-on:update="current_report['intervention'+intervention+'_activity'] = $event"
                                v-if="action='edit'"></editor>
                    </div>
                    <div v-for="year in [1,2,3,4,5]" class="col">
                        <checkbox-boolean
                            v-model="current_report['intervention'+intervention+'_activity_year'+year]"
                            :id="current_report['group_key']+'_intervention'+intervention+'_activity_year'+year"></checkbox-boolean>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h5>{{ Locale.getLabel('imet-core::oecm_report.other') }}</h5>

                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <editor v-model="current_report['intervention'+intervention+'_other']"
                                v-on:update="current_report['intervention'+intervention+'_other'] = $event"
                                v-if="action='edit'"></editor>
                    </div>
                    <div v-for="year in [1,2,3,4,5]" class="col">
                        <checkbox-boolean class="field-edit"
                                          v-model="current_report['intervention'+intervention+'_other_year'+year]"
                                          v-bind:id="current_report['group_key']+'_intervention'+intervention+'_other_year'+year"></checkbox-boolean>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <button type="button" v-if="intervention_list.length < 3"
                            class="btn-nav small " v-on:click="add_item">
                        <span class="fas fa-fw fa-plus-circle white"></span>
                        {{ Locale.getLabel('modular-forms::common.add_item') }}
                    </button>
                    <button type="button" v-if="intervention_list.length > 1"
                            class="btn-nav small red" v-on:click="remove_item">
                        <span class="fas fa-fw fa-trash white"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "roadmap",
    props: {
        action: {
            type: String,
            default: 'edit'
        },
        report: {
            type: [Object, Array],
            default: () => {
            }
        },
        group_key: {
            type: Number,
            default: 0
        },
        default_schema: {
            type: Object,
            default: () => {
            }
        }
    },
    mounted: function () {
        if (!this.current_report) {
            this.get_values();
        }
    },
    data() {
        return {
            Locale: window.Locale,
            current_report: null,
            intervention_list: [1]
        }
    },
    methods: {
        get_values: function () {
            if (Array.isArray(this.report)) {
                this.current_report = this.report[this.group_key]
            } else {
                this.current_report = this.report[0];
            }

            this.current_report.group_key = this.group_key;

            const arr = [2, 3];
            let add = 0;
            for (const i in arr) {
                for (const key in this.current_report) {
                    if (key.startsWith('intervention' + arr[i])) {
                        if (this.current_report[key] !== this.default_schema[key]) {
                            add = arr[i];
                        }
                    }
                }
            }

            for (let i = 2; i <= add; i++) {
                this.intervention_list.push(i);
            }
        },
        add_item: function () {
            this.intervention_list.push(this.intervention_list.length + 1);
        },
        remove_item: function () {
            const i = this.intervention_list.pop();
            for (const key in this.default_schema) {
                if (key.startsWith('intervention' + i)) {
                    this.current_report[key] = this.default_schema[key];
                }
            }
        }
    }
}
</script>
