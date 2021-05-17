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
    import common from '../mixins/common.input.mixin';

    export default {

        components: {
            simple_text
        },

        mixins: [
            common
        ],

        watch: {
            inputValue(value){
                this.emitValue(value);
            }
        }

    }
</script>