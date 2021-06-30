<template>

    <div class="list-key-numbers">

        <div>
            <div class="content">
                <span class="number">{{ Locale.getLabel('mapping.common.environmental_impact_study') }}</span>
                <span>
                    Date: {{ api_data.date_environmental_study || '-' }}
                </span>
                <span v-if="api_data.download_link_environmental_study!==null">
                    <i class="fas fa-file"></i>
                    <a target="_blank" :href=api_data.download_link_environmental_study>
                         {{ Locale.getLabel('mapping.common.environmental_assessment_study') }} 
                     </a>
                </span>
            </div>
        </div>

        <div>
            <div class="content">
                <span class="number">{{ Locale.getLabel('mapping.common.environmental_impact_report') }} </span>
                <span>
                    {{ Locale.getLabel('mapping.common.date') }}: {{ api_data.date_submission_environmental_social_report || '-' }}
                </span>
                <span v-if="api_data.download_link_environmental_social_report!==null">
                    <i class="fas fa-file"></i>
                    <a target="_blank" :href=api_data.download_link_environmental_social_report>
                         {{ Locale.getLabel('mapping.common.document_certifying') }}
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