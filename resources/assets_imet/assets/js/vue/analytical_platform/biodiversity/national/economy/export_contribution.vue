<template>

    <div>
        <div class="list-key-numbers">
            <div>
                <i class="icon-svg icon-money" />
                <div class="content">
                    <span class="number">{{ api_data.export_valeur_absolue  | pretty_number }} USD</span>
                </div>
                <gauge :percentage=api_data.export_valeur_relative />
                <data_driven_layer_toggle
                        v-if="regional"
                        method="percent_contribution_export"
                        title="% contribution au exportations"
                        :api_data=api_data.contribution_export_chart.per_country
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