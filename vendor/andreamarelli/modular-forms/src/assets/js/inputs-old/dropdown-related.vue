<template>

    <select :id="id" :name="id">
        <option v-bind:value="selectedValue" selected="selected">{{ selectedLabel }}</option>
    </select>

</template>

<script>

    export default {

        mixins: [
            window.ModularForms.MixinsVue.dropdown,
        ],

        props: {
            dataStructure: {
                type: String,
                default: '{}'
            },
            relatedId: {
                type: String,
            },
        },

        data (){
            return {
                relatedValue: '',
                dataStructureObj: {}
            }
        },

        created: function () {
            let _this = this;
            this.dataStructureObj = JSON.parse(this.dataStructure);
            let relatedObj = $('#'+this.relatedId);
            this.relatedValue = $(relatedObj).val();
            $(relatedObj).change(function (){
                _this.relatedValue = $(relatedObj).val();
                _this.updateList();
            });
        },

        mounted: function () {
            this.updateList();
        },

        methods: {

            updateList: function () {
                if(this.relatedValue!==''){
                    let relatedStructure =this.array_values_to_keys(this.dataStructureObj[this.relatedValue]);
                    this.refreshList(relatedStructure);
                }
            },

            array_values_to_keys: function (list) {
                let new_list = [];
                for(let key in list) {
                    if(list.hasOwnProperty(key)){
                        let value = list[key];
                        new_list[value] = value;
                    }

                }
                return new_list;
            }

        }
    }
</script>
