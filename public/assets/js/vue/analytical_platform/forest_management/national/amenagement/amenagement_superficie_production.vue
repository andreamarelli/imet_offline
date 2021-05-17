<template>

    <div>        
        <div class="list-key-numbers grid_two_cols">
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.platform.cards.forest_management.national.sections.planning.planned') }}</span>
                    <span class="number">{{ api_data.production_area.planned | pretty_number }} ha</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.platform.cards.forest_management.national.sections.planning.affected') }}</span>
                    <span class="number">{{ api_data.production_area.affected | pretty_number }} ha</span>
                </div>
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
