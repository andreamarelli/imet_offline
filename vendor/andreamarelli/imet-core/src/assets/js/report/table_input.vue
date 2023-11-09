<template>
    <div class="module-container" :id="group_key">
        <div class="module-header">
            <div class="module-title" id="ar5">AR.5 {{ Locale.getLabel('imet-core::oecm_report.table_of_planning') }}</div>
        </div>
        <div class="module-body" v-if="current_report">
            <h5>{{ Locale.getLabel('imet-core::oecm_report.previous_state') }}</h5>
            <editor v-model=current_report.previous_state v-on:update="current_report.previous_state = $event"
                    v-if="action='edit'"></editor>
            <div v-else class="field-preview" style="max-width: none; margin-bottom: 10px;">
                {{ current_report.previous_state }}}
            </div>
            <h5>{{ Locale.getLabel('imet-core::oecm_report.impacts') }}</h5>
            <editor v-model=current_report.impacts v-on:update="current_report.impacts = $event"></editor>
            <h5>{{ Locale.getLabel('imet-core::oecm_report.responses') }}</h5>
            <editor v-model=current_report.responses v-on:update="current_report.responses = $event"></editor>
            <h5>{{ Locale.getLabel('imet-core::oecm_report.proposed_short') }} </h5>
            <editor v-model=current_report.proposed_short v-on:update="current_report.proposed_short = $event"></editor>
            <h5>{{ Locale.getLabel('imet-core::oecm_report.proposed_long') }}</h5>
            <editor v-model=current_report.proposed_long v-on:update="current_report.proposed_long = $event"></editor>
        </div>
    </div>
</template>

<script>
export default {
    name: "table_input",
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
        }
    },
    data() {
        return {
            Locale: window.Locale,
            current_report: null
        }
    },
    mounted: function () {
        if (!this.current_report) {
            this.get_values();
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
        }
    }
}
</script>

