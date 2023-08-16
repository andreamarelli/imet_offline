<template>
    <div class="module-container">
        <div class="module-header">
            <div class="module-title"></div>
        </div>
        <div class="module-body" v-if="current_report">
            <div class="row">
                <div class="col-8">
                    <h4>{{ Locale.getLabel('imet-core::oecm_report.possible_roadmap') }}</h4>
                </div>
                <div class="col"><h5>{{ Locale.getLabel('imet-core::oecm_report.year') }}1</h5></div>
                <div class="col"><h5>{{ Locale.getLabel('imet-core::oecm_report.year') }}2</h5></div>
                <div class="col"><h5>{{ Locale.getLabel('imet-core::oecm_report.year') }}3</h5></div>
                <div class="col"><h5>{{ Locale.getLabel('imet-core::oecm_report.year') }}4</h5></div>
                <div class="col"><h5>{{ Locale.getLabel('imet-core::oecm_report.year') }}5</h5></div>
            </div>
            <div class="row mb-1">
                <div class="col-6">
                    <h3>{{ Locale.getLabel('imet-core::oecm_report.long_term_objectives') }}</h3>
                </div>
               <div class="col-6">
                   <editor v-model=current_report.long_term v-on:update="current_report.long_term = $event"
                           v-if="action='edit'"></editor>
               </div>
            </div>
            <div class="row mb-1">
                <div class="col">
                    <h3>{{ Locale.getLabel('imet-core::oecm_report.outcome') }} 1</h3>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-8">
                    <editor v-model=current_report.outcome v-on:update="current_report.outcome = $event"
                            v-if="action='edit'"></editor>
                </div>
                <div v-for="year in [1,2,3,4,5]" class="col">
                    <checkbox-boolean v-model="current_report['outcome_year'+year]"
                                      :id="current_report['group_key']+'_outcome_year'+year"></checkbox-boolean>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-6">
                    <h3>{{ Locale.getLabel('imet-core::oecm_report.annual_multi_annual_targets') }}</h3>
                </div>
                <div class="col-6">
                    <editor v-model=current_report.annual_targets1 v-on:update="current_report.annual_targets1 = $event"
                            v-if="action='edit'"></editor>
                </div>
            </div>
            <div v-for="activity in [1,2]">
                <div class="row mb-1">
                    <div class="col">
                        <h5>{{ Locale.getLabel('imet-core::oecm_report.activity') }} {{ activity }}</h5>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-8">
                        <editor v-model="current_report['annual_targets1_activity'+activity]"
                                v-on:update="current_report['annual_targets1_activity'+activity] = $event"
                                v-if="action='edit'"></editor>
                    </div>

                    <div v-for="year in [1,2,3,4,5]" class="col">
                        <checkbox-boolean v-model="current_report['annual_targets1_activity'+activity+'_year'+year]"
                                          :id="current_report['group_key']+'_annual_targets1_activity'+activity+'_year'+year"></checkbox-boolean>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h3>{{ Locale.getLabel('imet-core::oecm_report.outcome') }} 2</h3>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-8">
                    <editor v-model=current_report.outcome2 v-on:update="current_report.outcome2 = $event"
                            v-if="action='edit'"></editor>

                </div>

                <div v-for="year in [1,2,3,4,5]" class="col">
                    <checkbox-boolean v-model="current_report['outcome2_year'+year]"
                                      :id="current_report['group_key']+'_outcome2_year'+year"></checkbox-boolean>
                </div>

            </div>
            <div class="row mb-1">
                <div class="col-6">
                    <h3>{{ Locale.getLabel('imet-core::oecm_report.annual_multi_annual_targets') }}</h3>
                </div>
                <div class="col-6">
                    <editor v-model=current_report.annual_targets2 v-on:update="current_report.annual_targets2 = $event"
                            v-if="action='edit'"></editor>
                </div>
            </div>
            <div v-for="activity in this.intervention_list.length">
                <div class="row">
                    <div class="col">
                        <h5>{{ Locale.getLabel('imet-core::oecm_report.activity') }} {{ activity }}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <editor v-model="current_report['annual_targets2_activity'+activity]"
                                v-on:update="current_report['annual_targets2_activity'+activity] = $event"
                                v-if="action='edit'"></editor>
                    </div>

                    <div v-for="year in [1,2,3,4,5]" class="col">
                        <checkbox-boolean v-model="current_report['annual_targets2_activity'+activity+'_year'+year]"
                                          :id="current_report['group_key']+'_annual_targets2_activity'+activity+'_year'+year"></checkbox-boolean>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <button type="button" v-if="intervention_list.length < 5"
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
            intervention_list: [1,2]
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

            const arr = [3, 4, 5];
            let add = 0;
            for (const i in arr) {
                for (const key in this.current_report) {
                    if (key.startsWith('annual_targets2_activity' + arr[i])) {
                        if (this.current_report[key] !== this.default_schema[key]) {
                            add = arr[i];
                        }
                    }
                }
            }
            for (let i = 3; i <= add; i++) {
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
