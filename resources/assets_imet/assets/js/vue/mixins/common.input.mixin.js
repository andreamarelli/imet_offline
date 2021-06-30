export default {

    props: {
        id : {
            type: String,
            default: ''
        },
        value : {
            type: [String, Number, Boolean, Array, Object],
            default: null
        },
        dataClass: {
            type: String,
            default: ''
        },
        dataRules: {
            type: String,
            default: ''
        },
    },

    data(){
        return {
            inputValue: this.value,
        }
    },

    watch: {
        value(value){
            this.inputValue = value;
        }
    },

    methods: {

        emitValue (value) {
            this.$emit('input', value);
            this.$emit('change');
        }

    }

}