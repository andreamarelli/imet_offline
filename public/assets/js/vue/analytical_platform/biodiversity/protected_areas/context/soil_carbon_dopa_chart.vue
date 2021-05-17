<template>

    <div>
        <div class="list-key-numbers grid_two_cols">
            <div>
                <div class="content">
                    <span class="txt">Stock de Carbone Minimal</span>
                    <span class="number">{{ api_data[2]| pretty_number  }} Mg/Km<sup>2</sup></span>
                </div>
            </div>

            <div>
                <div class="content">
                    <span class="txt">Stock de Carbone Maximal</span>
                    <span class="number">{{ api_data[0]| pretty_number  }} Mg/Km<sup>2</sup></span>
                </div>
            </div>

            <div>
                <div class="content">
                    <span class="txt">Stock de Carbone Moyen</span>
                    <span class="number">{{ api_data[1]| pretty_number  }} Mg/Km<sup>2</sup></span>
                </div>
            </div>

            <div>
                <div class="content">
                    <span class="txt">Stock de Carbone Total</span>
                    <span class="number">{{ api_data[4]| pretty_number  }} Mg/Km<sup>2</sup></span>
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
