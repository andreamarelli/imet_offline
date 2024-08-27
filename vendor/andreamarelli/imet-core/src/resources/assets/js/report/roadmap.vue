<template>
    <div class="module-container">
        <div class="module-header">
            <div class="module-title"></div>
        </div>
        <div class="module-body flex flex-col gap-y-4" v-if="current_report">

            <div class="flex width-full content-center justify-between">
                <div class="width w-8/12"><h4>{{ Locale.getLabel('imet-core::oecm_report.table_of_planning.possible_roadmap') }}</h4></div>
                <div><h5>{{ Locale.getLabel('imet-core::oecm_report.table_of_planning.year') }}1</h5></div>
                <div><h5>{{ Locale.getLabel('imet-core::oecm_report.table_of_planning.year') }}2</h5></div>
                <div><h5>{{ Locale.getLabel('imet-core::oecm_report.table_of_planning.year') }}3</h5></div>
                <div><h5>{{ Locale.getLabel('imet-core::oecm_report.table_of_planning.year') }}4</h5></div>
                <div><h5>{{ Locale.getLabel('imet-core::oecm_report.table_of_planning.year') }}5</h5></div>
            </div>

            <div class="flex">
                <h5 class="w-6/12">{{ Locale.getLabel('imet-core::oecm_report.table_of_planning.long_term_objectives') }}</h5>
                <div class="w-6/12">
                    <editor v-model=current_report.long_term v-on:update="current_report.long_term = $event" v-if="action='edit'"></editor>
                </div>
            </div>

            <h5>{{ Locale.getLabel('imet-core::oecm_report.table_of_planning.outcome') }} 1</h5>

            <div class="flex width-full content-center justify-between">
                <div class="width w-8/12">
                    <editor v-model=current_report.outcome v-on:update="current_report.outcome = $event"
                            v-if="action='edit'"></editor>
                </div>
                <div v-for="year in [1,2,3,4,5]" class="col">
                    <checkbox-boolean v-model="current_report['outcome_year'+year]"
                                      :id="current_report['group_key']+'_outcome_year'+year"></checkbox-boolean>
                </div>
            </div>

            <div class="flex">
                <div class="w-6/12">
                    <h5>{{ Locale.getLabel('imet-core::oecm_report.table_of_planning.annual_multi_annual_targets') }}</h5>
                </div>
                <div class="w-6/12">
                    <editor v-model=current_report.annual_targets1 v-on:update="current_report.annual_targets1 = $event"
                            v-if="action='edit'"></editor>
                </div>
            </div>

            <div v-for="activity in this.outcome1_list.length">
                <h6>{{ Locale.getLabel('imet-core::oecm_report.table_of_planning.activity') }} {{ activity }}</h6>
                <div class="flex width-full content-center justify-between">
                    <div class="width w-8/12">
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

            <div class="flex">
                <button type="button" v-if="outcome1_list.length < 5"
                        class="btn-nav small " v-on:click="add_activity_outcome1_item">
                    <span class="fas fa-fw fa-plus-circle white"></span>
                    {{ Locale.getLabel('modular-forms::common.add_item') }}
                </button>
                <button type="button" v-if="outcome1_list.length > 1"
                        class="btn-nav small red" v-on:click="remove_outcome1_item">
                    <span class="fas fa-fw fa-trash white"></span>
                </button>
            </div>


        <h5>{{ Locale.getLabel('imet-core::oecm_report.table_of_planning.outcome') }} 2</h5>

            <div class="flex width-full content-center justify-between">
                <div class="width w-8/12">
                    <editor v-model=current_report.outcome2 v-on:update="current_report.outcome2 = $event"
                            v-if="action='edit'"></editor>

                </div>
                <div v-for="year in [1,2,3,4,5]" class="col">
                    <checkbox-boolean v-model="current_report['outcome2_year'+year]"
                                      :id="current_report['group_key']+'_outcome2_year'+year"></checkbox-boolean>
                </div>
            </div>

            <div class="flex">
                <div class="w-6/12">
                    <h5>{{ Locale.getLabel('imet-core::oecm_report.table_of_planning.annual_multi_annual_targets') }}</h5>
                </div>
                <div class="w-6/12">
                    <editor v-model=current_report.annual_targets2 v-on:update="current_report.annual_targets2 = $event"
                            v-if="action='edit'"></editor>
                </div>
            </div>

            <div v-for="activity in this.outcome2_list.length">

                <h6>{{ Locale.getLabel('imet-core::oecm_report.table_of_planning.activity') }} {{ activity }}</h6>

                <div class="flex width-full content-center justify-between">
                    <div class="width w-8/12">
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

            <div class="flex">
                <button type="button" v-if="outcome2_list.length < 5"
                        class="btn-nav small " v-on:click="add_activity_outcome2_item">
                    <span class="fas fa-fw fa-plus-circle white"></span>
                    {{ Locale.getLabel('modular-forms::common.add_item') }}
                </button>
                <button type="button" v-if="outcome2_list.length > 1"
                        class="btn-nav small red" v-on:click="remove_outcome2_item">
                    <span class="fas fa-fw fa-trash white"></span>
                </button>
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
            outcome2_list: [1, 2],
            outcome1_list: [1, 2]
        }
    },
    methods: {
        outcome_list_add_items(list, label = 'annual_targets2_activity') {
            const arr = [3, 4, 5];
            let add = 0;
            for (const i in arr) {
                for (const key in this.current_report) {
                    if (key.startsWith(label + arr[i])) {
                        if (this.current_report[key] !== this.default_schema[key]) {
                            add = arr[i];
                        }
                    }
                }
            }
            for (let i = 3; i <= add; i++) {
                list.push(i);
            }
        },
        get_values: function () {
            if (Array.isArray(this.report)) {
                this.current_report = this.report[this.group_key]
            } else {
                this.current_report = this.report[0];
            }

            this.current_report.group_key = this.group_key;
            this.outcome_list_add_items(this.outcome2_list);
            this.outcome_list_add_items(this.outcome1_list, 'annual_targets1_activity');
        },
        add_activity_outcome2_item: function () {
            this.outcome2_list.push(this.outcome2_list.length + 1);
        },
        add_activity_outcome1_item: function () {
            this.outcome1_list.push(this.outcome1_list.length + 1);
        },
        remove_outcome2_item: function () {
            const i = this.outcome2_list.pop();
        },
        remove_outcome1_item: function () {
            const i = this.outcome1_list.pop();
        }
    }
}
</script>
