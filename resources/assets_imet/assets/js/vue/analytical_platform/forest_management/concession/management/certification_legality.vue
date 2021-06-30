<template>

    <div class="list-key-numbers">
        <div>
            <div class="content">
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.common.type') }}</span>
                    <span>{{ Locale.getLabel('mapping.common.legality') }}</span>
                </span>
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.common.name') }}</span>
                    <span>{{ api_data.certification_process_legality || '-' }}</span>
                </span>
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.common.office') }}</span>
                    <span>{{ api_data.audit_office_contracted_legality || '-' }}</span>
                </span>
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.common.date') }}</span>
                    <span>{{ api_data.date_obtaining_certificate_legality || '-' }}</span>
                </span>
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.common.duration') }}</span>
                    <span>{{ api_data.duration_legality || '-' }}</span>
                </span>
                <span v-if="api_data.download_link_certification_legality!==null">
                     <a target="_blank" :href=api_data.download_link_certification_legality>
                         <i class="fas fa-file"></i>
                        {{ Locale.getLabel('mapping.common.legality_check') }}
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
