<template>

    <div>
        <data_year :year=api_data.last_year> Nombre d'emploi généré en</data_year>

        <div class="list-key-numbers grid_two_cols">
            <div>
                <div class="content">
                        <span class="txt">
                            {{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.economy.direct') }}
                        </span>
                    <span class="number">{{ api_data.direct | pretty_number }}</span>
                    <span>
                            <data_driven_layer_toggle
                                v-if="regional"
                                method="direct_jobs"
                                title="Emplois directs générés"
                                :api_data=api_data.by_country.direct
                            ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            <div>
                <div class="content">
                        <span class="txt">
                            {{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.economy.indirect') }}
                        </span>
                    <span class="number">{{ api_data.indirect | pretty_number }}</span>
                    <span>
                        <data_driven_layer_toggle
                            v-if="regional"
                            method="indirect_jobs"
                            title="Emplois indirects générés"
                            :api_data=api_data.by_country.indirect
                        ></data_driven_layer_toggle>
                    </span>
                </div>
            </div>
            <div>
                <button @click="toggle_component('jobs.direct')"
                        class="btn-nav rounded"
                >{{ Locale.getLabel('mapping.common.historic_data') }}</button>
            </div>
            <div>
                <button @click="toggle_component('jobs.indirect')"
                        class="btn-nav rounded"
                >{{ Locale.getLabel('mapping.common.historic_data') }}</button>
            </div>
        </div>
    </div>

</template>

<style lang="scss" type="text/scss" scoped>

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
