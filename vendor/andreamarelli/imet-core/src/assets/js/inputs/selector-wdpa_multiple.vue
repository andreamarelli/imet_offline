<template>

    <modal-selector
        class="selector-wdpa_multiple"
        :disable_modal=disable_modal
        :parent-id=id
    >

        <!-- Anchor -->
        <template v-slot:custom_anchor>
            <span class="field-preview" v-for="item in inputValuesObj">
                <i class="fa fa-times removeItem" v-on:click="removeItem(item.id)"></i>
                {{ item.label }}
            </span>
        </template>
        <template v-slot:modal_anchor>
            <span class="field-preview"></span>
        </template>


        <!-- Modal -->
        <template v-slot:modal_content>

            <div v-show="displaySearch" >

                <modal_api_search
                        :parent-id=id
                        :search-url=searchUrl
                        :key-min-length=3
                >
                <template v-slot:modal_search_results_filters>
                    <i>{{ Locale.getLabel('modular-forms::common.filter_results') }}: </i>&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ Locale.getLabel('imet-core::common.country') }}
                    <select v-model=filterByCountry @change="filterList()" class="field-edit">
                        <option value="null"> - - </option>
                        <option v-for="(label, key) in countries" :value=key>
                          {{ label }}
                        </option>
                    </select>
                </template>

                <template v-slot:resultItem="{ item }">
                    <td><span class="result_left"><b>{{ item.name }}</b></span></td>
                    <td><a v-if="item.wdpa_id!==null" target="_blank" href="https://www.protectedplanet.net/'+item.wdpa_id+'">{{ item.wdpa_id }}</a></td>
                    <td>{{ item.country_name }}</td>
                    <td>{{ item.iucn_category }}</td>
                </template>

              </modal_api_search>

            </div>

            <div v-show="displayInsert" >
                <div class="modal-body insert">
                    <div>
                        <input type="text" class="field-edit" value="" :id="'selector_item_insert_'+id" />
                    </div>
                    <div>
                        <i>{{ Locale.getLabel('modular-forms::common.be_specific_as_possible') }}</i>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div>
                    <button type="button"
                            v-if="enableFreeText && displaySearch"
                            class="btn-nav dark small"
                            v-on:click="enableFreeTextItem" >
                        {{ Locale.getLabel('modular-forms::common.add_if_not_found') }}
                    </button>
                </div>
                <div>
                    <button type="button"
                            class="btn-nav dark small"
                            v-if=displayInsert
                            v-on:click="confirmInsert" >
                        {{ Locale.getLabel('modular-forms::common.add') }}
                    </button>
                    <button type="button"
                            class="btn-nav dark small"
                            :disabled="selectedValue===null"
                            v-if=displaySearch
                            v-on:click="confirmSelection" >
                        {{ Locale.getLabel('modular-forms::common.confirm_select') }}
                    </button>
                </div>
            </div>

        </template>

    </modal-selector>

</template>

<style lang="scss" scoped>

    @import "vendor/andreamarelli/modular-forms/src/assets/sass/abstracts/all";

    .module-container .selector-wdpa_multiple {

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
                    color: $gray-800;
                }
            }
        }


        .modal-body.insert{
            font-size: 0.8em;
            text-align: center;
            div{
              margin-bottom: 4px;
            }
            input{
              width: 380px
            }
        }

        .modal-footer{
            justify-content: space-between;
        }

    }

</style>

<script>

    export default {

        components: {
            'flag': window.ModularForms.Template.flag,
            'modal-selector': window.ModularForms.Input.modalSelector,
            'modal_api_search': window.ModularForms.Input.modalApiSearch
        },

        mixins: [
            window.ModularForms.MixinsVue.values
        ],

        props: {
            searchUrl: {
                type: String,
                default: ''
            },
            labelsUrl: {
                type: String,
                default: ''
            },
            disable_modal: {
                type: Boolean,
                default: false
            },
            dataObjs : {
                type: Object,
                default: null
            },
            enableFreeText: {
                type: Boolean,
                default: false,
            },
        },

        data (){
            return {
                Locale: window.Locale,
                inputValuesObj: [],
                inputValuesString: '',
                countries: [],
                filterByCountry: null,
                selectedValue: null,
                displaySearch: true,
                displayInsert: false,
            }
        },

        mounted(){
            let _this = this;
            this.getPaLabels(this.value);
            this.modalComponent = this.$children[0];
            this.searchComponent = null;    // will be populated from modalComponent when modal opens
        },

        watch: {
            value(value) {
                this.getPaLabels(value);
            }
        },

        methods: {

            getPaLabels(value) {
                let _this = this;
                this.inputValuesObj = [];
                this.inputValuesString = '';

                if (value !==null) {
                    window.axios({
                        method: 'POST',
                        url: this.labelsUrl,
                        data: {
                            _token: window.Laravel.csrfToken,
                            ids: value
                        },
                    })
                        .then(function (response) {
                            if (Object.values(response.data).length > 0) {
                                Object.values(response.data).forEach(function (item) {
                                    _this.pushItem(item);
                                });
                            }
                        })
                        .catch(function () {
                            // _this.setErrors();
                        });
                }
            },

            afterModalOpen(){
                this.displayInsert = false;
                this.displaySearch = true;
                document.getElementById('selector_item_insert_'+this.id).value = null;
            },

            afterSearch(response){
                this.countries = response['countries'];
            },

            resultTableHeader(){
                return [
                    '',
                    Locale.getLabel('imet-core::common.name'),
                    Locale.getLabel('imet-core::common.protected_area.wdpa_id',1),
                    Locale.getLabel('imet-core::common.country'),
                    Locale.getLabel('imet-core::common.protected_area.iucn_category'),
                ]
            },

            filterList(){
                let filters = {
                    'country': this.filterByCountry
                };
                this.searchComponent.filterShowList(filters);
            },

            confirmSelection(){
                this.pushItem({
                    id: this.selectedValue.wdpa_id,
                    label: this.selectedValue.name,
                });
                this.emitValue(this.inputValuesString);
                this.modalComponent.closeModal();
            },

            enableFreeTextItem(){
                this.displaySearch = false;
                this.displayInsert = true;
            },

            confirmInsert(){
                let value = document.getElementById('selector_item_insert_'+this.id).value;
                this.pushItem({
                    id: value,
                    label: value
                });
                this.emitValue(this.inputValuesString);
                this.modalComponent.closeModal();
            },

            pushItem(item){
                if(item!==null && item!==''){
                    this.inputValuesObj.push({
                        id: item.id,
                        label: item.label
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
