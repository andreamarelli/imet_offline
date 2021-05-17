<template>

    <div>

        <div class="list-key-numbers">
            <div>
                <i class="icon-svg icon-worker" />
                <div class="content">
                    <span class="number">{{ api_data.total | pretty_number }} ({{ api_data.total_percent_women | pretty_number }} % {{ Locale.getLabel('mapping.platform.cards.forest_management.national.sections.economy.women') }})</span>
                </div>
            </div>
        </div>

        <div class="list-key-numbers emplos_list">
            <div class="list-head">{{ Locale.getLabel('mapping.platform.cards.forest_management.national.sections.economy.direct') }}</div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.common.total') }}</span>
                    <span class="number">{{ api_data.direct_total | pretty_number }} ({{ api_data.direct_percent_women | pretty_number }} % {{ Locale.getLabel('mapping.platform.cards.forest_management.national.sections.economy.women') }})</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.platform.cards.forest_management.national.sections.economy.nationals') }}</span>
                    <span class="number">{{ api_data.direct_national | pretty_number }}</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.platform.cards.forest_management.national.sections.economy.expatriates') }}</span>
                    <span class="number">{{ api_data.direct_expatriate | pretty_number }}</span>
                </div>
            </div>
            <div>
                <button @click="toggle_component('job.direct')"
                        class="btn-nav rounded"
                >{{ Locale.getLabel('mapping.common.historic_data') }}</button>
            </div>

            <div class="list-head">{{ Locale.getLabel('mapping.platform.cards.forest_management.national.sections.economy.indirect') }}</div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.common.total') }}</span>
                    <span class="number">{{ api_data.indirect_total | pretty_number }} ({{ api_data.indirect_percent_women | pretty_number }} % {{ Locale.getLabel('mapping.platform.cards.forest_management.national.sections.economy.women') }})</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.platform.cards.forest_management.national.sections.economy.nationals') }}</span>
                    <span class="number">{{ api_data.indirect_national | pretty_number }}</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.platform.cards.forest_management.national.sections.economy.expatriates') }}</span>
                    <span class="number">{{ api_data.indirect_expatriate | pretty_number }}</span>
                </div>
            </div>
            <div>
                <button @click="toggle_component('job.indirect')"
                        class="btn-nav rounded"
                >{{ Locale.getLabel('mapping.common.historic_data') }}</button>
            </div>
        </div>


    </div>

</template>

<style lang="scss" type="text/scss" scoped>

    @import "../../../../../../sass/abstracts/all";

    .emplos_list{
        display: grid;
        grid-template-rows: repeat(5, auto);
        grid-column-gap: 10px;
        grid-auto-flow: column;
        grid-auto-columns: 1fr 1fr;
        margin-top: 20px;
        >div:nth-child(6){
            border-top: 1px dashed $lightGray;
        }
    }
</style>


<script>

    import base from '../../../components/_base.mixin';
    import visible_components from "../../../../../mapping_mapbox/mixins/visible_components";

    export default {
        mixins: [
            base,
            visible_components
        ]
    }
</script>

