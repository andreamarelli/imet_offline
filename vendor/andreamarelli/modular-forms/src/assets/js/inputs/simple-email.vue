<template>

    <simple-text
        v-model=inputValue
        :id=id
        :name=id
        :data-rules="dataRules!=='' ? dataRules+'|email' : 'email'"
    ></simple-text>

</template>

<script>

    import simple_text from './simple-text.vue';

    export default {

        components: {
            simple_text
        },

        mixins: [
            window.ModularForms.MixinsVue.values
        ],

        watch: {
            inputValue(value){
                this.emitValue(value);
            }
        }

    }
</script>
