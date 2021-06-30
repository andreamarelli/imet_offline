<template>

    <div class="list-key-numbers">
        <div>
            <div class="content">
                    <span class="two_columns">
                        <span>{{ Locale.getLabel('mapping.common.type') }}</span>
                        <span>{{ Locale.getLabel('mapping.common.durability') }}</span>
                    </span>
                <span class="two_columns">
                        <span>{{ Locale.getLabel('mapping.common.name') }}</span>
                        <span>{{ api_data.certification_process || '-' }}</span>
                    </span>
                <span class="two_columns">
                        <span>{{ Locale.getLabel('mapping.common.office') }}</span>
                        <span>{{ api_data.audit_office_contracted || '-' }}</span>
                    </span>
                <span class="two_columns">
                        <span>{{ Locale.getLabel('mapping.common.date') }}</span>
                        <span>{{ api_data.date_obtaining_certificate || '-' }}</span>
                    </span>
                <span class="two_columns">
                        <span>{{ Locale.getLabel('mapping.common.duration') }}</span>
                        <span>{{ api_data.duration || '-' }}</span>
                    </span>
                <span v-if="api_data.download_link_certification!==null">
                     <a target="_blank" :href=api_data.download_link_certification>
                         <i class="fas fa-file"></i>
                        {{ Locale.getLabel('mapping.common.certification_process') }}  
                     </a>
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
