<template>

    <div class="list-key-numbers">
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.biodiversity.protected_areas.sections.management.management_mode') }}</span>
                <span class="number">{{ api_data.governance_type }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.biodiversity.protected_areas.sections.management.manager') }}</span>
                <span class="number">{{ api_data.administrator }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.biodiversity.protected_areas.sections.management.development_plan') }}</span>
                <span class="number">
                        <span v-if="api_data.link_management_plan!==null">
                            <i class="fa fa-fw fa-file" /><a target="_blank" :href=api_data.link_management_plan>{{ Locale.getLabel('mapping.common.download') }}</a>
                        </span>
                        <span v-else>{{ Locale.getLabel('mapping.common.not_available') }}</span>
                    </span>
            </div>
        </div>
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.biodiversity.protected_areas.sections.management.management_evaluation') }}</span>
                <span class="number">{{ api_data.management_evaluation }}</span>
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
