<template>

    <div>

        <div class="list-key-numbers">
            <div>
                <i class="icon-svg icon-ranger"></i>
                <div class="content">
                    <span class="txt">{{ api_data.number_total | pretty_number }} {{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.protected_areas.protected_areas') }}</span>
                    <span class="number">{{ api_data.area_protected.total | pretty_number }}<sup>km²</sup></span>
                </div>
                <layer_toggle
                    :layer=protected_areas_layer
                    :as_button=true
                    :exclusive_layer=true
                ></layer_toggle>
            </div>
        </div>


        <div class="list-key-numbers grid_two_cols pa_numbers">
            <div>
                <i class="icon-svg icon-ranger"></i>
                <div class="content">
                    <span>
                        avec <span class="highlighted">{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.protected_areas.brigades_ecoguards') }}</span>
                    </span>
                    <span class="number">{{ api_data.number_with_brigade.total | pretty_number }}</span>
                    <span>
                        <data_driven_layer_toggle
                            v-if="regional"
                            method="number_with_brigade"
                            title="Aires protégées avec brigades/écogardes"
                            :api_data=api_data.number_with_brigade
                        ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            <div>
                <i class="icon-svg icon-offroad"></i>
                <div class="content">
                    <span>
                        avec <span class="highlighted">{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.protected_areas.reception_facilities') }}</span>
                    </span>
                    <span class="number">{{ api_data.number_with_equipments.total | pretty_number }}</span>
                    <span>
                        <data_driven_layer_toggle
                            v-if="regional"
                            method="number_with_equipments"
                            title="Aires protégées avec équipements/structures d'accueil"
                            :api_data=api_data.number_with_equipments
                        ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            <div>
                <i class="icon-svg icon-contract"></i>
                <div class="content">
                    <span>
                        <span class="highlighted">{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.protected_areas.sustainable_labeled') }}</span>
                    </span>
                    <span class="number">{{ api_data.number_certified.total | pretty_number }}</span>
                    <span>
                        <data_driven_layer_toggle
                            v-if="regional"
                            method="number_certified"
                            title="Aires protégées labellisés durables"
                            :api_data=api_data.number_certified
                        ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

            <div>
                <i class="icon-svg icon-country"></i>
                <div class="content">
                    <span>
                        <span class="highlighted">{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.protected_areas.cross_border') }}</span>
                    </span>
                    <span class="number">{{ api_data.number_transboundary.total | pretty_number }}</span>
                    <span>
                        <data_driven_layer_toggle
                            v-if="regional"
                            method="transboundary"
                            title="Aires protégées transfrontalières"
                            :api_data=api_data.wdpa_ids_transboundary
                        ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>

        </div>


        <div class="list-key-numbers terrestrial_and_marine">
            <div class="list-head">{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.protected_areas.terrestrial') }}</div>
            <div>
                <i class="icon-svg icon-trees"></i>
                <div class="content">
                    <span class="txt">
                        {{ api_data.terrestrial.number | pretty_number}} {{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.protected_areas.terrestrial') }}
                    </span>
                    <span class="number">{{ api_data.terrestrial.area_protected.total | pretty_number }}<sup>km²</sup></span>
                    <span>
                        <data_driven_layer_toggle
                            v-if="regional"
                            method="percent_terrestrial_area_protected"
                            title="% de surface protégée"
                            :api_data="{'wdpa_ids':api_data.terrestrial.wdpa_ids,'percentage':api_data.terrestrial.area_protected}"
                        ></data_driven_layer_toggle>
                    </span>
                </div>
                <gauge :percentage=api_data.terrestrial.percent />
            </div>
            <div>
                <i class="icon-svg icon-check"></i>
                <div class="content">
                    <span class="txt">
                        {{ api_data.terrestrial.number_assessed | pretty_number }} {{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.protected_areas.assessed') }}

                    </span>
                    <span class="number">{{ api_data.terrestrial.area_assessed | pretty_number }}<sup>km²</sup></span>
                    <span>
                        <data_driven_layer_toggle
                            v-if="regional"
                            method="terrestrial_wdpa_ids_assessed"
                            title="Aires protégées terrestres évaluées"
                            :api_data=api_data.terrestrial.wdpa_ids_assessed
                        ></data_driven_layer_toggle>
                    </span>
                </div>
                <gauge :percentage=api_data.terrestrial.percent_assessed />
            </div>

            <div class="list-head">{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.protected_areas.maritime') }} </div>
            <div>
                <i class="icon-svg icon-corals"></i>
                <div class="content">
                        <span class="txt">
                            {{ api_data.marine.number | pretty_number }} {{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.protected_areas.maritime') }}
                        </span>
                    <span class="number">{{ api_data.marine.area_protected.total | pretty_number }}<sup>km²</sup></span>
                    <span>
                        <data_driven_layer_toggle
                            v-if="regional"
                            method="percent_marine_area_protected"
                            title="% de surface protégée"
                            :api_data="{'wdpa_ids':api_data.marine.wdpa_ids,'percentage':api_data.marine.area_protected}"
                        ></data_driven_layer_toggle>
                    </span>
                </div>
                <gauge :percentage=api_data.marine.percent />
            </div>
            <div>
                <i class="icon-svg icon-check"></i>
                <div class="content">
                        <span class="txt">
                            {{ api_data.marine.number_assessed | pretty_number }} {{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.protected_areas.assessed') }}
                        </span>
                    <span class="number">{{ api_data.marine.area_assessed | pretty_number }}<sup>km²</sup></span>
                    <span>
                        <data_driven_layer_toggle
                            v-if="regional"
                            method="marine_wdpa_ids_assessed"
                            title="Aires protégées maritimes évaluées"
                            :api_data=api_data.marine.wdpa_ids_assessed
                        ></data_driven_layer_toggle>
                    </span>
                </div>
                <gauge :percentage=api_data.marine.percent_assessed />
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
        grid-template-rows: repeat(3, auto);
        grid-column-gap: 10px;
        grid-auto-flow: column;
        grid-auto-columns: 1fr 1fr;
        margin-top: 20px;
        >div:nth-child(4){
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
                protected_areas_layer: window.WebMapping.Mapbox.Layers.protected_areas,
                baseUrl: window.Laravel.baseUrl
            }
        }
    }
</script>
