<template>

    <span>
        <span id="simple-textarea" class="field-preview" contenteditable @input="onInput" v-text="originalValue"></span>
    </span>

</template>

<script>

    import common from '../mixins/common.input.mixin';

    export default {

        mixins: [
            common
        ],

        data (){
            return {
                originalValue: null
            }
        },

        mounted(){
            this.container = $(this.$el)[0];
            this.originalValue = this.value;
        },

        watch: {
            inputValue(value){
                this.emitValue(value);
                if(this.originalValue === value && document.activeElement.id!=='simple-textarea'){
                    this.container.querySelector('span').innerText = value;
                }
            }
        },
         methods:{
             onInput(e) {
                 this.inputValue = e.target.innerText;
             },
         }

    }

</script>