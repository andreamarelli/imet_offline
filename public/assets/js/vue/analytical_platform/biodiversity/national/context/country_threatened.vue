<template>

    <div class="list-key-numbers grid_three_cols">
        <div>
            <div class="content">
                <span>{{ Locale.getLabel('entities.biodiversity.class.mammals') }}</span>
                <span class="number">{{ api_data.mammals| pretty_number }}</span>
                <span>Rang: {{ api_data.mammals_rank| pretty_number }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span>{{ Locale.getLabel('entities.biodiversity.class.birds') }}</span>
                <span class="number">{{ api_data.birds| pretty_number }}</span>
                <span>Rang: {{ api_data.birds_rank| pretty_number }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span>{{ Locale.getLabel('entities.biodiversity.class.amphibians') }}</span>
                <span class="number">{{ api_data.amphibians| pretty_number }}</span>
                <span>Rang: {{ api_data.amphibians_rank| pretty_number }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span>Total</span>
                <span class="number">{{ api_data.total| pretty_number }}</span>
                <span>Rang: {{ api_data.total_rank| pretty_number }}</span>
            </div>
        </div>
    </div>

</template>

<style lang="scss" type="text/scss" scoped>
    .grid_three_cols{
        div:last-child{
            grid-row-start: 2;
        }
    }
</style>

<script>

    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base]
    }
</script>