<template>

    <span>
        <input type="password"
           :id=id
           :name=id
           v-model="inputValue"
           class="field-edit"
        />
    </span>

</template>

<script>


    export default {

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
