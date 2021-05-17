<template>
    
    <div class="list-key-numbers grid_two_cols">
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.biodiversity.protected_areas.sections.info.legal_status') }}</span> 
                <span class="number">{{ api_data.status }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.biodiversity.protected_areas.sections.info.year_creation') }}</span>
                <span class="number">{{ api_data.year_creation || '-' }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.biodiversity.protected_areas.sections.info.iucn_cat') }}</span>
                <span class="number">{{ api_data.iucn_category }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.biodiversity.protected_areas.sections.info.wdpa_code') }}</span>
                <span class="number"><a target="_blank" :href=api_data.wdpa_id_link>{{ api_data.wdpa_id }}</a></span>
            </div>
        </div>

        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.biodiversity.protected_areas.sections.info.management_mode') }}</span>
                <span class="number">{{ api_data.governance_type }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.biodiversity.protected_areas.sections.info.manager') }}</span>
                <span class="number">{{ api_data.administrator }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.biodiversity.protected_areas.sections.info.area') }} </span>
                <span class="number">{{ api_data.area| pretty_number }} Km<sup>2</sup></span>
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
