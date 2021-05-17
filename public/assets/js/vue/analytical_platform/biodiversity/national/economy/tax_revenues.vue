<template>

    <div class="list-key-numbers">
        <div>
            <i class="icon-svg icon-money" />
            <div class="content">
                <data_year :year=api_data.year_lastYear_encoded> </data_year>
                <span class="number">{{ api_data.recette_totale | pretty_number }} USD</span>
            </div>
            <data_driven_layer_toggle
                    v-if="regional"
                    method="percent_contribution_tax_revenues"
                    title="% contribution au recettes fiscales"
                    :api_data=api_data.recette_fiscale_chart.per_country
            ></data_driven_layer_toggle>
        </div>
        <div>
            <i class="icon-svg icon-travel" />
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.economy.tourism_revenue_percentage') }}</span>
                <span class="number">{{ api_data.percent_recettes_tourisme }} %</span>
            </div>
        </div>
        <div>
            <i class="icon-svg icon-country" />
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.economy.percentage_country_revenue') }}</span>
                <span class="number">{{ api_data.percent_recettes_pays }} %</span>
            </div>
        </div>
        <div>
            <button @click="toggle_component('recette_fiscale_details')"
                    class="btn-nav rounded"
            >{{ Locale.getLabel('mapping.common.details') }}</button>
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
