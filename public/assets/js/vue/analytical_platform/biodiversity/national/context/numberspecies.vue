<template>

    <div>
        <div class="list-key-numbers grid_three_cols">
            <div>
                <div class="content">
                    <span class="txt">Espèces Animales</span>
                    <span class="number">{{ api_data.animals| pretty_number }}</span>
                    <span class="txt">Rang: {{ api_data.animals_rank| pretty_number }}</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">Espèces Floristiques</span>
                    <span class="number">{{ api_data.plants| pretty_number }}</span>
                    <span class="txt">Rang: {{ api_data.plants_rank| pretty_number }}</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span class="txt">Total</span>
                    <span class="number">{{ api_data.total| pretty_number }}</span>
                    <span class="txt">Rang: {{ api_data.total_rank| pretty_number }}</span>
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