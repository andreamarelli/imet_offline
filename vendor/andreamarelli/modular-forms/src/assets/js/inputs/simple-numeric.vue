<template>

    <div>
        <input type="text" class="field-edit" v-bind:class="[{ 'field-numeric': numericType!=='code'}, dataClass ]"
               ref="autoNumericElement"
               v-on:autoNumeric:rawValueModified="update"
        />
    </div>

</template>

<style scoped>
    .field-edit{
        max-width: 180px;
    }
    .field-numeric{
        text-align: right;
    }
</style>

<script>

    export default {

        mixins: [
            window.ModularForms.MixinsVue.values
        ],

        props: {
            value: {
                required: false,
                validator(val) {
                    return typeof val === 'number' || typeof val === 'string' || val === '' || val === null;
                },
            },
            numericType: {
                type: String,
                default: 'float'
            },
        },

        data() {
            return {
                inputElement: null,
                options: {},
            };
        },

        watch: {
            value(newValue, oldValue){
                if (newValue !== void(0)
                    && newValue !== oldValue
                    // Make sure this is only called when the value is set by an external script, and not from a user input
                    && this.inputElement.getNumber() !== newValue) {
                    this.inputElement.set(newValue);
                }
            },
        },

        created() {

            if(this.numericType==='integer'){
                this.options.minimumValue = '0';
                this.options.decimalPlaces = 0;
                this.options.decimalCharacter = ',';
                this.options.digitGroupSeparator = ' ';
            }
            else if(this.numericType==='code'){
                this.options.minimumValue = '0';
                this.options.decimalPlaces = 0;
                this.options.digitGroupSeparator = '';
            }
            else if(this.numericType==='float' || this.numericType==='numeric'){
                this.options.decimalCharacter = ',';
                this.options.digitGroupSeparator = ' ';
            }
            else if(this.numericType==='currency'){
                this.options.decimalCharacter = ',';
                this.options.digitGroupSeparator = ' ';
            }
            this.options.maximumValue = '100000000000000000';
            this.options.emptyInputBehavior = 'null';
        },
        mounted() {
            this.inputElement = new window.AutoNumeric(this.$refs.autoNumericElement, this.options);
            this.inputElement.set(this.value);
            this.update();
        },
        methods: {
            update(event) {
                if (this.inputElement !== null) {
                    this.$emit('input', this.inputElement.getNumber(), event);
                    this.$emit('change');
                }
            },
        },


    };

</script>
