<template>

    <div>

        <div class="list-key-numbers">
            <div>
                <div class="content">
                    <span class="two_columns">
                        <span>{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.management.plan_status') }}</span>
                        <span>{{ api_data.status_planning }}</span>
                    </span>
                    <span class="two_columns">
                        <span>{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.management.date') }}</span>
                        <span>{{ api_data.date_approval_planning }}</span>
                    </span>
                    <span class="two_columns">
                        <span>{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.management.rotation_time') }}</span>
                        <span>{{ api_data.rotation_time }}</span>
                    </span>
                    <span v-if="api_data.download_link_planning!==null">
                         <a target="_blank" :href=api_data.download_link_planning>
                             <i class="fas fa-file"></i>
                            {{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.management.development_plan') }}  
                         </a>
                    </span>
                </div>
            </div>

        </div>

        <div class="list-key-numbers grid_three_cols">
            <div class="list-head">{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.management.series') }}  </div>
            <div>
                <div class="content">
                    <span class="text green_base">{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.management.production') }}  </span>
                    <span class="number">{{ api_data.production_serie | pretty_number  }} ha</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="text green_base">{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.management.conservation') }}</span>
                    <span class="number">{{ api_data.conservation_serie | pretty_number  }} ha</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="text green_base">{{ Locale.getLabel('mapping.platform.cards.forest_management.concessions.sections.management.protection') }}</span>
                    <span class="number">{{ api_data.protection_serie | pretty_number  }} ha</span>
                </div>
            </div>
        </div>
        

    </div>

</template>

<style lang="scss" type="text/scss" scoped>
    .grid_three_cols{
        margin-top: 20px;
        .list-head{
            grid-column-end: 3 span;
        }
        div:nth-child(2),
        div:nth-child(3){
            border-top: none;
        }
    }
</style>


<script>
    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base]
    }
</script>