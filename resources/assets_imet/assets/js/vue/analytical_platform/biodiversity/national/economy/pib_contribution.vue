<template>

    <div>
        <div class="list-key-numbers">
            <div>
                <i class="icon-svg icon-money" />
                <div class="content">
                    <span class="number">{{ api_data.pib_valeur_absolue | pretty_number }} USD</span>
                </div>
                <gauge :percentage=api_data.pib_valeur_relative />
                <data_driven_layer_toggle
                        v-if="regional"
                        method="percent_contribution_pib"
                        title="% contribution au PIB"
                        :api_data=api_data.contribution_pib_chart.per_country
                ></data_driven_layer_toggle>
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