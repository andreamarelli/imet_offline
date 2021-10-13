<template>

    <v-select
        v-model=selectedItem
        :options=list
        :taggable=taggable
        :multiple=multiple
        :create-option="newOption => ({ label: newOption, code: newOption })"
        v-on:input="sendToEmitter"
    ></v-select>

</template>


<style lang="scss" scoped>

</style>

<script>

    import vSelect from 'vue-select';
    Vue.component('v-select', vSelect);

    export default {

        mixins: [
            window.ModularForms.MixinsVue.sorter,
            window.ModularForms.MixinsVue.values
        ],

        props: {
            dataValues: {
                type: String,
                default: '{}',
            },
            taggable: {
                type: Boolean,
                default: false
            },
            multiple: {
                type: Boolean,
                default: false
            }
        },

        data (){
            return {
                list: [],
                selectedItem: null,
                sortBy: 'label',
            }
        },

        beforeMount(){
            this.buildOptions();
            this.selectedItem = this.getSelectedItem();
        },

        computed: {
            option_list(){
                return JSON.parse(this.dataValues);
            }
        },

        watch:{
            dataValues: function () {
                this.buildOptions();
            },
            value: function (value) {
                this.selectedItem = this.getSelectedItem();
            },
        },

        methods: {

            _getPair(item){
              return  {
                  label: this.option_list[item],
                  code: item
              };
            },

            getSelectedItem(){
                let _this = this;
                let value = this.value;

                if(value!==null){
                    if(this.multiple){
                        try {
                            value = JSON.parse(value);
                        } catch (e) {
                            value = value.split(',');
                        }
                        return value.map(function(item){
                            return _this._getPair(item);
                        });
                    }
                    else {
                        return _this._getPair(value);
                    }
                }
                return null;
            },

            buildOptions() {
                this.list = [];
                for(let key in this.option_list) {
                    if((key !== '' && key !== 'null')
                        && this.option_list.hasOwnProperty(key)) {
                        this.list.push(this._getPair(key));
                    }
                }
                // ensure initial selected value is in option list (if added by user)
                if(this.value!==null && !(this.value in this.option_list)){
                    this.list.push(this._getPair(this.value));
                }
                this.list = this.sortList(this.list);
            },

            sendToEmitter(option){
                if(option===null){
                    this.emitValue(null);
                } else if(this.multiple){
                    this.emitValue(JSON.stringify(option.map(item => item.code)));
                } else {
                    this.emitValue(option.code)
                }
            }

        }

    }
</script>
