<template>

    <span>
        <input type="text"
               :id=id
               :name=id
               v-model="inputValue"
               class="field-edit"
               autocomplete="off"
        />
    </span>

</template>

<script>

    import common from '../mixins/common.input.mixin';
    import tooltip from '../mixins/tooltip.mixin';

    export default {

        mixins: [
            common,
            tooltip
        ],

        data() {
            return {
                tooltipEnabled: true,
            }
        },

        mounted() {
            this.container = $(this.$el)[0];
            this.addTooltip();
        },

        watch: {
            inputValue(value) {
                this.emitValue(value);
            }
        }

    }

</script>
