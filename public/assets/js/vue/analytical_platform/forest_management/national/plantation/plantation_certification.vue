<template>

    <div>
        
            <div class="list-key-numbers" v-if="api_data.certification.not_applicable">
                <div>
                    <div class="content">
                        <span class="number">{{ Locale.getLabel('mapping.common.not_applicable') }}</span>
                    </div>
                </div>
            </div>

            <div class="list-key-numbers" v-else>
                <div>
                    <div class="content">
                        <span class="txt">{{ Locale.getLabel('mapping.platform.cards.forest_management.national.sections.plantations.durability') }}</span>
                        <span class="number">{{api_data.certification.durability_area | pretty_number  }} ha</span>
                    </div>
                    <gauge :percentage=api_data.certification.durabiity_percent />
                </div>
                <div>
                    <div class="content">
                        <span class="txt">{{ Locale.getLabel('mapping.platform.cards.forest_management.national.sections.plantations.legality') }}</span>
                        <span class="number">{{api_data.certification.legality_area | pretty_number  }} ha</span>
                    </div>
                    <gauge :percentage=api_data.certification.legality_percent />
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


