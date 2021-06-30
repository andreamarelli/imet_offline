<template>


    <div class="list-key-numbers">
        <div>
            <div class="content">
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.common.name') }}</span>
                    <span>{{ api_data.name_concession }}</span>
                </span>
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.common.society') }}</span>
                    <span>{{ api_data.name_society }}</span>
                </span>
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.common.permit') }}</span>
                    <span>{{ api_data.permit }}</span>
                </span>
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.common.date') }}</span>
                    <span>{{ api_data.date_attribution }}</span>
                </span>
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.common.duration') }}</span>
                    <span>{{ api_data.duration_attribution }}</span>
                </span>
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.common.start_operation') }}</span>
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