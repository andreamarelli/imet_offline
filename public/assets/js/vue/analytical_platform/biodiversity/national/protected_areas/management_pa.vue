<template>

    <div>

        <div class="list-key-numbers">
            <div>
                <i class="icon-svg icon-strategy"></i>
                <div class="content">
                    <span>{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.protected_areas.protected_areas_with') }} <span class="highlighted">{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.protected_areas.development_plan') }}</span> {{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.protected_areas.or_management_plan') }}</span>
                    <span class="number">{{ api_data.number_with_management_or_development_plan | pretty_number }}</span>
                </div>
                <data_driven_layer_toggle
                    method="with_management_or_development_plan"
                    title="Aires protégées avec plan d'aménagement ou plan de gestion"
                    :api_data=api_data.wdpa_ids_with_management_or_development_plan
                ></data_driven_layer_toggle>
            </div>
            <div>
                <i class="icon-svg icon-check"></i>
                <div class="content">
                    <span>{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.protected_areas.protected_areas_effectiveness') }} <span class="highlighted">IMET</span></span>
                    <span class="number">{{ api_data.number_assessed_imet | pretty_number }}</span>
                </div>
                <data_driven_layer_toggle
                    method="terrestrial_wdpa_ids_assessed_imet"
                    title="Aires protégées évaluées avec IMET"
                    :api_data=api_data.wdpa_ids_assessed_imet
                ></data_driven_layer_toggle>
            </div>
        </div>

        <br />

        <data_imet_country
            v-if="regional"
            :api_data=api_data.list_imet
            class="text-center"
        ></data_imet_country>

        <data_list_imet
            v-else
            :api_data=api_data.list_imet
            class="text-center"
        ></data_list_imet>


        <div class="list-key-numbers terrestrial_and_marine">
            <div class="list-head">{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.protected_areas.terrestrial') }}</div>
            <div>
                <i class="icon-svg icon-check"></i>
                <div class="content">
                    <span class="txt">
                        soit <span class="number">{{ api_data.terrestrial.number_assessed_imet | pretty_number }}</span> {{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.protected_areas.assessed_with') }} IMET
                    </span>
                    <span class="number">{{ api_data.terrestrial.area_assessed_imet | pretty_number }}<sup>km²</sup></span>
                    <a :href="baseUrl + 'monitoring_system/imet'" target="_blank"
                       class="btn-nav rounded small" style="width: 180px;">{{ Locale.getLabel('mapping.common.presentation_page') }} IMET</a>
                </div>
            </div>

            <div class="list-head">{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.protected_areas.maritime') }}</div>
            <div>
                <i class="icon-svg icon-check"></i>
                <div class="content">
                    <span class="txt">
                        soit <span class="number">{{ api_data.marine.number_assessed_imet | pretty_number }}</span> {{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.protected_areas.assessed_with') }} avec IMET
                    </span>
                    <span class="number">{{ api_data.marine.area_assessed_imet | pretty_number }}<sup>km²</sup></span>
                    <a :href="baseUrl + 'monitoring_system/imet'" target="_blank"
                       class="btn-nav rounded small" style="width: 180px;">{{ Locale.getLabel('mapping.common.presentation_page') }} IMET</a>
                </div>
            </div>

        </div>

    </div>

</template>

<style lang="scss" type="text/scss" scoped>

    @import "../../../../../../sass/abstracts/all";

    .pa_numbers{
        >div:first-child,
        >div:nth-child(2){
            border-top: none;
        }
    }
    .terrestrial_and_marine{
        display: grid;
        grid-template-rows: repeat(2, auto);
        grid-column-gap: 10px;
        grid-auto-flow: column;
        grid-auto-columns: 1fr 1fr;
        margin-top: 20px;
        >div:nth-child(3){
            border-top: 1px dashed $lightGray;
        }
    }
</style>

<script>

    import base from '../../../components/_base.mixin';

    export default {

        mixins: [
            base,
        ],

        data: function () {
            return {
                baseUrl: window.Laravel.baseUrl
            }
        }
    }
</script>
