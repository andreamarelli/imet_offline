<template>

    <span class="toggle">

        <input type="hidden" value="value" :id="id" :name="id" v-bind:value="value" class="toggle" />

        <span class="btn-group btn-group-sm" role="group" >
            <button type="button"
                   v-for="option in listOptions"
                    :class="isSelected(option.value) ? 'btn act-btn-active' : 'btn btn-sm act-btn-lighter act-btn-basic'"
                    v-on:click="setOption(option.value)"
                   :value=option.value
            >{{ option.label }}</button>
        </span>

    </span>


</template>

<style lang="scss" type="text/scss" scoped>

    @import "../../../sass/abstracts/all";

    .toggle{
        .btn-group{
            display: inline-flex;
            .btn{
                border: 1px solid $lighterGray;
            }
        }
    }
</style>

<script>

    import common from '../mixins/common.input.mixin';

    export default {

        mixins: [
            common
        ],

        props: {
            dataValues: {
                type: String,
                default: '{}',
            }
        },

        data (){
            return {
                listOptions: this.buildOptionList(),
            }
        },

        mounted: function () {
            this.buildOptionList();
        },

        methods: {

            buildOptionList: function (){
                let dataValues = JSON.parse(this.dataValues);
                let data = [];
                for(let index in dataValues) {
                    if(index!=='_' && dataValues.hasOwnProperty(index)){
                        data.push({'label': dataValues[index], 'value': index});
                    }
                }
                this.listOptions = data;
            },

            isSelected: function(value){
                return value!==null
                    && this.inputValue!==null
                    && value.toString() === this.inputValue.toString();
            },

            setOption: function (value) {
                this.inputValue = this.inputValue===value ? null : value;
                this.emitValue(this.inputValue);
            }

        }

    }
</script>