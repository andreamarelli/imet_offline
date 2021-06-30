<template>

    <modal-selector
        class="selector-keywords_multiple"
        :disable_modal=disable_modal
        :parent-id=id
    >

        <!-- Anchor -->
        <template v-slot:custom_anchor>
            <span class="field-preview" v-for="item in inputValuesObj">
                <i class="fa fa-times removeItem" v-on:click="removeItem(item.id)"></i>
                {{ item.word }}
            </span>
        </template>
        
        <template v-slot:modal_anchor>
            <span class="field-preview"></span>
        </template>


        <!-- Modal -->
        <template v-slot:modal_content>

            <modal_api_search
                :parent-id=id
                search-url='ajax/search/keywords'
                :key-min-length=3
            >

                <template v-slot:resultItem="{ item }">
                    <td><b>{{ item.document_type}}</b></td>
                    <td>{{ item.word }}</td>
                </template>

            </modal_api_search>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-sm act-btn-darkgreen"
                        :disabled="selectedValue===null"
                        v-on:click="confirmSelection" >
                    {{ Locale.getLabel('common.confirm_select') }}
                </button>
            </div>
        </template>

    </modal-selector>

</template>

<style lang="scss" type="text/scss" scoped>

    @import "../../../sass/abstracts/all";

    .module-container .selector-keywords_multiple {

        .field-preview {
            min-width: 80px;
            display: inline-block;
            margin-right: 10px;
            margin-bottom: 5px;
            vertical-align: top;

            i.removeItem {
                color: $contextual-danger;
                cursor: pointer;

                &:hover {
                    color: $darkestGray;
                }
            }
        }

    }


</style>

<script>

    import modal from './components/modal-selector.vue';
    import modal_api_search from './components/modal-api-search-AddElement.vue';
    import common from '../mixins/common.input.mixin';
    import flag from "../templates/flag";

    export default {

        components: {
            'modal-selector': modal,
            'modal_api_search': modal_api_search
        },

        mixins: [
            common
        ],

        props: {
            disable_modal: {
                type: Boolean,
                default: false
            },
            dataObjs : {
                type: Object,
                default: null
            },
        },

        data (){
            return {
                Locale: window.Locale,
                inputValuesObj: [],
                inputValuesString: '',
                //countries: [],
                //filterByCountry: null,
                selectedValue: null
  
            }
        },

        mounted(){
            let _this = this;
            this.getKeywords(this.value);
            this.modalComponent = this.$children[0];
            this.searchComponent = null;    // will be populated from modalComponent when modal opens
        },
        watch: {
            value(value) {
               this.getKeywords(value);
            }
        },

        methods: {

            getKeywords(value) {
                
                let _this = this;
                this.inputValuesObj = [];
                this.inputValuesString = '';

                if (value !==null) {

                    $.ajax({
                        method: 'POST',
                        url: window.Laravel.baseUrl + 'api/library/getKeywords',
                        dataType: 'json',
                        data: {
                            '_token': window.Laravel.csrfToken,
                            'ids': value
                        },
                        cache: false
                    })
                        .done(function (response) {
                            if(response.length>0){
                                response.forEach(function (item) {
                                    _this.pushItem(item);
                                });
                            }
                        })
                        .fail(function () {
                            // _this.setErrors();
                        })
                }
            },

            resultTableHeader(){
                return [
                    '',
                     Locale.getLabel('form/catalogue.Document.fields.document_type'),
                     Locale.getLabel('form/catalogue.Document.fields.keywords'),
                ]
            },

            confirmSelection(){
                let _this = this;
                this.pushItem({
                    id: this.selectedValue.id,
                    word: this.selectedValue.word,
                });
                this.emitValue(this.inputValuesString);
                this.modalComponent.closeModal();
            },

            pushItem(item){
                if(item!==null && item!==''){
                    this.inputValuesObj.push({
                        id: item.id,
                        word: item.word
                    });
                    if(this.inputValuesString!==''){
                        this.inputValuesString += ',';
                    }
                    this.inputValuesString += item.id;
                }
            },

            removeItem(id){
                let _this = this;

                let values = this.inputValuesString
                    .replace(id, '')
                    .split(',')
                    .filter(function(el) { return el !== ''; });
                this.inputValuesString = values.toString();

                let inputValuesObj = [];
                this.inputValuesObj.forEach(function (item) {
                    if(item['id']!==id){
                        inputValuesObj.push(item);
                    }
                });
                this.inputValuesObj = inputValuesObj;
                this.emitValue(this.inputValuesString);
            }

        }
    }

</script>