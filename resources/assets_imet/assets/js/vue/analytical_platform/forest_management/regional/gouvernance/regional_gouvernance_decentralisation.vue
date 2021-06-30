<template>

    <div class="list-key-numbers grid_two_cols">
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.common.countries_decentralized_management') }}</span>
                <span class="number"></span>
            </div>
            <gauge :percentage=api_data.decentralized_instrument.percent />
        </div>
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.common.local_development_infrastructure') }}</span>
                <span class="number">{{ api_data.local_initiative.number | pretty_number }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span class="txt">{{ Locale.getLabel('mapping.common.local_development_initiatives') }}</span>
                <span class="number">{{ api_data.infrastructure.number | pretty_number }}</span>
            </div>
        </div>
    </div>


</template>

<style lang="scss" type="text/scss" scoped>

    .list-key-numbers.grid_two_cols{
        div:first-child{
            grid-column-start: 1;
            grid-column-end: 3;
        }
        div:nth-child(2) {
            border-top: none;
        }
    }

</style>

<script>

    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base]
    }
</script>

