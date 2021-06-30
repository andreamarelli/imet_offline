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
                    <span class="txt">{{ Locale.getLabel('mapping.common.planning') }}</span>
                    <span class="number">
                            {{api_data.communal_forest.development_area | pretty_number }} ha
                            ({{api_data.communal_forest.development_percent | pretty_number }} %)
                        </span>
                    <span class="number">{{api_data.communal_forest.development_volume | pretty_number }} m<sup>3</sup></span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.common.durability') }}</span>
                    <span class="number">
                            {{api_data.communal_forest.certified_durability_area | pretty_number }} ha
                            ({{api_data.communal_forest.certified_durability_area_percent | pretty_number }} %) {{ Locale.getLabel('mapping.common.certified') }}
                        </span>
                    <span class="number">
                            {{api_data.communal_forest.engaged_durability_area | pretty_number }} ha
                            ({{api_data.communal_forest.engaged_durability_area_percent | pretty_number }} %) {{ Locale.getLabel('mapping.common.engaged_in_process') }}
                        </span>
                </div>
            </div>
            <div>
                <button @click="toggle_hidden('communal_forest')"
                        class="btn-nav rounded"
                >{{ Locale.getLabel('mapping.common.historic_data') }}
                </button>
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