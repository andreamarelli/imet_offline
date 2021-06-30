<template>

    <div>
        <data_year :year=api_data.last_year> Nombre d'emploi généré en</data_year>
        
        <div class="list-key-numbers grid_two_cols">
            <div>
                <div class="content">
                        <span class="txt">
                            {{ Locale.getLabel('mapping.common.direct') }}
                            &nbsp;
                            &nbsp;
                            <data_driven_layer_toggle
                                    v-if="regional"
                                    method="direct_jobs"
                                    title="Emplois directs générés"
                                    :api_data=api_data.by_country.direct
                            ></data_driven_layer_toggle>
                        </span>
                    <span class="number">{{ api_data.direct | pretty_number }}</span>
                </div>
            </div>
            <div>
                <div class="content">
                        <span class="txt">
                            {{ Locale.getLabel('mapping.common.indirect') }}
                            &nbsp;
                            &nbsp;
                            <data_driven_layer_toggle
                                    v-if="regional"
                                    method="indirect_jobs"
                                    title="Emplois indirects générés"
                                    :api_data=api_data.by_country.indirect
                            ></data_driven_layer_toggle>
                        </span>
                    <span class="number">{{ api_data.indirect | pretty_number }}</span>
                </div>
            </div>
            <div>
                <button @click="toggle_hidden('jobs.direct')"
                        class="btn-nav rounded"
                >{{ Locale.getLabel('mapping.common.historic_data') }}</button>
            </div>
            <div>
                <button @click="toggle_hidden('jobs.indirect')"
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

    export default {
        mixins: [base]
    }

</script>