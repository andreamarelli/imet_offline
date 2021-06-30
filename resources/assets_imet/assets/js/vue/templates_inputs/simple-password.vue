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

    import common from '../mixins/common.input.mixin';

    export default {

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