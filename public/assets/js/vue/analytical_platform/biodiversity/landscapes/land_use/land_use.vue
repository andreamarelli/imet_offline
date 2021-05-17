<template>

    <div>
        <div class="list-key-numbers" style="margin: 20px 0;">
            <div>
                <i class="icon-svg icon-business-and-finance"></i>
                <div class="content">
                    <span class="number">{{ api_data.total_change | pretty_number }}<sup>km²</sup></span>
                    <span class="txt">Changement de couverture terrestre affecté entre {{ start_class }} et {{ end_class }}.</span>
                </div>
            </div>
        </div>
        <land_use_sankey
            :sankey_data=api_data.change
            :start_class=start_class
            :end_class=end_class
            data_key="area"
            :title="Locale.getLabel('mapping.platform.cards.biodiversity.klc.sections.land_use.change')"
        ></land_use_sankey>
        <land_use_sankey
            :sankey_data=api_data.transfer
            :start_class=start_class
            :end_class=end_class
            data_key="area"
            :title="Locale.getLabel('mapping.platform.cards.biodiversity.klc.sections.land_use.transfer')"
        ></land_use_sankey>
    </div>

</template>



<script>
import base from '../../../components/_base.mixin';

export default {

    mixins: [
        base
    ],

    props:{
        start_class: {
            type: String,
            default: () => null
        },
        end_class: {
            type: String,
            default: () => null
        },
    }

}

</script>
