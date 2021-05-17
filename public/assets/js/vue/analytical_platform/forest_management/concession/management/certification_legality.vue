<template>

    <div class="list-key-numbers">
        <div>
            <div class="content">
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.management.type') }}</span>
                    <span>{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.management.legality') }}</span>
                </span>
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.management.name') }}</span>
                    <span>{{ api_data.certification_process_legality || '-' }}</span>
                </span>
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.management.office') }}</span>
                    <span>{{ api_data.audit_office_contracted_legality || '-' }}</span>
                </span>
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.management.date') }}</span>
                    <span>{{ api_data.date_obtaining_certificate_legality || '-' }}</span>
                </span>
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.management.duration') }}</span>
                    <span>{{ api_data.duration_legality || '-' }}</span>
                </span>
                <span v-if="api_data.download_link_certification_legality!==null">
                     <a target="_blank" :href=api_data.download_link_certification_legality>
                         <i class="fas fa-file"></i>
                        {{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.management.legality_check') }}
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
