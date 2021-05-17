<template>

    <div class="list-key-numbers">
        <div>
            <div class="content">
                        <span>
                            {{ Locale.getLabel('entities.biodiversity.class.mammals') }} - endémiques
                        </span>
                <span class="number">{{ api_data.mammals_endemics| pretty_number }}</span>
                <span>Rang: {{ api_data.mammals_endemics_rank| pretty_number }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                        <span>
                            {{ Locale.getLabel('entities.biodiversity.class.birds') }} - endémiques
                        </span>
                <span class="number">{{ api_data.birds_endemics| pretty_number }}</span>
                <span>Rang: {{ api_data.birds_endemics_rank| pretty_number }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                        <span>
                            {{ Locale.getLabel('entities.biodiversity.class.amphibians') }} - endémiques
                        </span>
                <span class="number">{{ api_data.amphibians_endemics| pretty_number }}</span>
                <span>Rang: {{ api_data.amphibians_endemics_rank| pretty_number }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                        <span>
                            Raies - endémiques
                        </span>
                <span class="number">{{ api_data.sharks_rays_endemics| pretty_number }}</span>
                <span>Rang: {{ api_data.sharks_rays_endemics_rank| pretty_number }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                <span>Total - endémiques</span>
                <span class="number">{{ api_data.total_endemics| pretty_number }}</span>
                <span>Rang: {{ api_data.total_endemics_rank| pretty_number }}</span>
            </div>
        </div>

        <div>
            <div class="content">
                        <span>
                            {{ Locale.getLabel('entities.biodiversity.class.mammals') }} - endémiques ménacés
                        </span>
                <span class="number">{{ api_data.mammals_threatened_endemics| pretty_number }}</span>
                <span>Rang: {{ api_data.mammals_threatened_endemics_rank| pretty_number }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                        <span>
                            {{ Locale.getLabel('entities.biodiversity.class.birds') }} - endémiques ménacés
                        </span>
                <span class="number">{{ api_data.birds_threatened_endemics| pretty_number }}</span>
                <span>Rang: {{ api_data.birds_threatened_endemics_rank| pretty_number }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                        <span>
                            {{ Locale.getLabel('entities.biodiversity.class.amphibians') }} - endémiques ménacés
                        </span>
                <span class="number">{{ api_data.amphibians_threatened_endemics| pretty_number }}</span>
                <span>Rang: {{ api_data.amphibians_threatened_endemics_rank| pretty_number }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                        <span>
                            Raies - endémiques ménacés
                        </span>
                <span class="number">{{ api_data.sharks_rays_threatened_endemics| pretty_number }}</span>
                <span>Rang: {{ api_data.sharks_rays_threatened_endemics_rank| pretty_number }}</span>
            </div>
        </div>
        <div>
            <div class="content">
                        <span>
                            Total - endémiques ménacés
                        </span>
                <span class="number">{{ api_data.total_threatened_endemics| pretty_number }}</span>
                <span>Rang: {{ api_data.total_threatened_endemics_rank| pretty_number }}</span>
            </div>
        </div>
    </div>


</template>

<style lang="scss" type="text/scss" scoped>

    @import "../../../../../../sass/abstracts/all";

    .list-key-numbers{
        display: grid;
        grid-template-rows: repeat(5, auto);
        grid-column-gap: 30px;
        grid-auto-flow: column;
        grid-auto-columns: 1fr 1fr;
        margin-top: 20px;
        >div:nth-child(6){
            border-top: 1px dashed $lightGray;
        }
    }
</style>

<script>

    import base from '../../../components/_base.mixin';

    export default {
        mixins: [base]
    }
</script>