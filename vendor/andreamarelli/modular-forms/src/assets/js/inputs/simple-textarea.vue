<template>

    <span>
        <span v-if="disabled" id="simple-textarea" class="field-preview disabled" @input="onInput" v-text="originalValue"></span>
        <span v-else id="simple-textarea" class="field-preview" contenteditable @input="onInput" v-text="originalValue"></span>
    </span>

</template>

<script>


    export default {

        mixins: [
            window.ModularForms.MixinsVue.values
        ],

        props:{
            disabled: {
                type: Boolean,
                default: false
            }
        },

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
