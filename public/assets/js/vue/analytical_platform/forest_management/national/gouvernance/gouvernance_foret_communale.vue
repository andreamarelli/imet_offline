<template>

    <div>

        <div class="list-key-numbers" v-if="api_data.communal_forest.not_applicable">
            <div>
                <div class="content">
                    <span class="number">{{ Locale.getLabel('mapping.common.not_applicable') }}</span>
                </div>
            </div>
        </div>

        <div class="list-key-numbers" v-else>
            <div>
                <div class="content">
                        <span class="number">
                            {{api_data.communal_forest.area | pretty_number }} ha
                            ({{api_data.communal_forest.number | pretty_number }})
                        </span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.platform.cards.forest_management.national.sections.governance.planning') }}</span>
                    <span class="number">
                            {{api_data.communal_forest.development_area | pretty_number }} ha
                            ({{api_data.communal_forest.development_percent | pretty_number }} %)
                        </span>
                    <span class="number">{{api_data.communal_forest.development_volume | pretty_number }} m<sup>3</sup></span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.platform.cards.forest_management.national.sections.governance.durability') }}</span>
                    <span class="number">
                            {{api_data.communal_forest.certified_durability_area | pretty_number }} ha
                            ({{api_data.communal_forest.certified_durability_area_percent | pretty_number }} %) {{ Locale.getLabel('mapping.platform.cards.forest_management.national.sections.governance.certified') }}
                        </span>
                    <span class="number">
                            {{api_data.communal_forest.engaged_durability_area | pretty_number }} ha
                            ({{api_data.communal_forest.engaged_durability_area_percent | pretty_number }} %) {{ Locale.getLabel('mapping.platform.cards.forest_management.national.sections.governance.engaged_in_process') }}
                        </span>
                </div>
            </div>
            <div>
                <button @click="toggle_component('communal_forest')"
                        class="btn-nav rounded"
                >{{ Locale.getLabel('mapping.common.historic_data') }}
                </button>
            </div>
        </div>

    </div>

</template>


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
