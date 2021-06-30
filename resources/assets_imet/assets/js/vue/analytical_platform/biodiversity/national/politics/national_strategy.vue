<template>

    <div>
        <data_year :year=api_data.lastYear_encoded> </data_year>

        <div class="list-key-numbers grid_two_cols">
            <div>
                <div class="content">
                    <span>
                        {{ Locale.getLabel('mapping.common.national_strategy') }}
                        <i class="fas text-base" :class="[api_data.strategie_action ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>
                    </span>
                    <span>
                        {{ Locale.getLabel('mapping.common.rate_progress') }}:
                        <i class="fas text-base" :class="[api_data.taux_avancement ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>
                    </span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span>                        
                        {{ Locale.getLabel('mapping.common.apa_strategy') }}:
                        <i class="fas text-base" :class="[api_data.strategie_apa ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>
                    </span>
                    <span>                        
                        {{ Locale.getLabel('mapping.common.regulatory_framework') }}:
                        <i class="fas text-base" :class="[api_data.cadre_apa ? 'fa-check-circle green_base' : 'fa-times-circle red_base']"></i>
                    </span>
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