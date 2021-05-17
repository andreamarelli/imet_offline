<template>


    <div class="list-key-numbers">
        <div>
            <div class="content">
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.info.name') }}</span>
                    <span>{{ api_data.name_concession }}</span>
                </span>
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.info.society') }}</span>
                    <span>{{ api_data.name_society }}</span>
                </span>
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.info.permit') }}</span>
                    <span>{{ api_data.permit }}</span>
                </span>
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.info.date') }}</span>
                    <span>{{ api_data.date_attribution }}</span>
                </span>
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.info.duration') }}</span>
                    <span>{{ api_data.duration_attribution }}</span>
                </span>
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.info.start_operation') }}</span>
                    <span>{{ api_data.operating_year }}</span>
                </span>
            </div>
        </div>
    </div>


</template>


<script>
    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base]
    }
</script>