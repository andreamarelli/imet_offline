<template>

    <div class="list-key-numbers">
        <div>
            <i class="icon-svg icon-money" />
            <div class="content">
                <span class="number">{{ api_data.tax.amount_recouvre | pretty_number }} USD</span>
            </div>
            <gauge :percentage=api_data.tax.percent />
        </div>
        <div>
            <i class="icon-svg icon-teamwork" />
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.forest_management.regional.sections.economy.amount_donated_COMIFAC_equal_contribution') }}</span>
                <span class="number">{{ api_data.tax.amount_contribution_egalitaire | pretty_number }} USD</span>
            </div>
        </div>
        <div>
            <i class="icon-svg icon-contract" />
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.platform.cards.forest_management.regional.sections.economy.amount_donated_COMIFAC_import_tax') }}</span>
                <span class="number">{{ api_data.tax.amount_reversement | pretty_number }} USD</span>
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

