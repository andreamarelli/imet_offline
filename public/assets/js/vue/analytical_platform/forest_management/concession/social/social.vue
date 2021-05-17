<template>


    <div class="list-key-numbers grid_three_cols">
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.social.villages') }}</span>
                <span class="number">{{ api_data.village | pretty_number  }} ({{ api_data.village_population | pretty_number }} hab.)</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.social.life_bases') }}</span>
                <span class="number">{{ api_data.life_base | pretty_number  }} ({{ api_data.number_employers | pretty_number }} emplo.)</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.social.schools') }}</span>
                <span class="number">{{ api_data.school | pretty_number  }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.social.health_center') }}</span>
                <span class="number">{{ api_data.health_center | pretty_number  }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.social.stores') }}</span>
                <span class="number">{{ api_data.food_store | pretty_number  }}</span>
            </div>
        </div>

        <div>
            <div class="content">
                <span class="number">{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.social.specifications') }}</span>
                <span>
                    Date: {{ api_data.date_signature_specifications || '-' }}
                </span>
                <span v-if="api_data.download_link_speficication!==null">
                    <i class="fas fa-file"></i>
                    <a target="_blank" :href=api_data.download_link_speficication> 
                     {{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.social.contractual_commitments') }} 
                    </a>
                </span>
            </div>
        </div>

        <div>
            <div class="content">
                <span class="number">{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.social.local_development') }}</span>
                <span class="two_columns">
                    <span>{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.social.investments') }}</span> 
                    <span>{{ api_data.investment | pretty_number  }} {{ api_data.currency }}</span>
                </span>
                <span class="two_columns"> 
                    <span>{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.social.conflict_resolution') }}</span> 
                    <span>
                        <i class="fas text-base" :class="[api_data.conflict_resolution ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>
                    </span>
                </span>
                <span class="two_columns">
                    <span>Carto. participative</span>
                    <span>
                        <i class="fas text-base" :class="[api_data.participatory_mapping ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>
                    </span>
                </span>
            </div>
        </div>

    </div>

</template>

<style lang="scss" type="text/scss" scoped>

    .list-key-numbers{
        div:nth-child(6),
        div:nth-child(7){
            grid-column-end: 3 span;
        }
        .two_columns{
            width: 250px;
        }
    }
</style>

<script>
    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base]
    }
</script>