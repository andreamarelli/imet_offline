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

    export default {

        mixins: [
            window.ModularForms.MixinsVue.values,
            window.ModularForms.MixinsVue.tooltip
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
