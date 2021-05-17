<template>

    <div>
        <div class="list-key-numbers">

            <div>
                <i class="icon-svg icon-leaf" />
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.economy.ecotourism_sites') }} </span>
                    <span class="number">{{ api_data.touristic_site| pretty_number }}</span>
                </div>
                <data_driven_layer_toggle
                        v-if="regional"
                        method="number_touristic_site"
                        title="Nombre de sites écotouristiques"
                        :api_data=api_data.touristic_site_per_country
                ></data_driven_layer_toggle>
            </div>
            <div>
                <i class="icon-svg icon-money" />
                <div class="content">
                    <span class="txt">{{ Locale.getLabel('mapping.platform.cards.biodiversity.national.sections.economy.income_eco_tourism') }}</span>
                    <span class="number">{{ api_data.amount| pretty_number }} USD</span>
                </div>
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