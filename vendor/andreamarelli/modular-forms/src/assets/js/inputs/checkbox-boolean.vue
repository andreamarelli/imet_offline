<template>

    <span class="checkbox" :class="dataClass">
        <input type="checkbox" :name=id :id="'bool-check_' + id" :checked=isChecked @click="checkChange"/>
        <label :for="'bool-check_' + id" v-html="label"></label>
    </span>

</template>

<script>

    export default {

        mixins: [
            window.ModularForms.MixinsVue.values
        ],

        props: {
            dataNumeric: {
                type: Boolean,
                default: false
            },
            label: {
                type: String,
                default: null
            }
        },

        data () {
            return {
                inputValue: (this.value===true || this.value==="1" || this.value===1)
            }
        },

        computed: {
            isChecked: function(){
                return this.inputValue===true;
            }
        },

        beforeMount: function(){
            if(this.value===null) {
                this.setModuleValue();
            }
        },

        mounted: function(){
            this.$el.classList.remove('field-edit');
        },

        methods: {

            checkChange: function(){
                this.inputValue = !this.inputValue;
                this.setModuleValue();
            },

            setModuleValue: function(){
                let moduleValue = null;
                if(this.dataNumeric){
                    moduleValue = this.inputValue ? 1 : 0;
                } else {
                    moduleValue = this.inputValue;
                }
                this.emitValue(moduleValue);
            }
        },

    }
</script>
