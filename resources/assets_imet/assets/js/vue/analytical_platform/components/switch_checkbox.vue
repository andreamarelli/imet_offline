<template>

    <span class="switch_checkbox sm">
        <input type="checkbox" :id=switch_id @click="switchChange" /><label :for=switch_id ></label>
    </span>

</template>

<script>

    export default {

        props: {
            id : {
                type: String,
                default: ''
            }
        },
        data() {
            return {
                switch_id: null
            }
        },

        mounted() {
            this.switch_id = 'switch_' + this.id
        },

        methods:{
            switchChange(evt){
                this.$emit('change', evt.target.checked);
            }
        }
    }

</script>