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

            <modal_api_search
                :parent-id=id
                search-url='ajax/search/protected_areas'
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

            <div class="modal-footer">
                <button type="button"
                        class="btn-nav dark small"
                        :disabled="selectedValue===null"
                        v-on:click="confirmSelection" >
                    {{ Locale.getLabel('modular-forms::common.confirm_select') }}
                </button>
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
            disable_modal: {
                type: Boolean,
                default: false
            },
            dataObjs : {
                type: Object,
                default: null
            }
        },

        data (){
            return {
                Locale: window.Locale,
                inputValuesObj: [],
                inputValuesString: '',
                countries: [],
                filterByCountry: null,
                selectedValue: null,
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
                        url: window.Laravel.baseUrl + 'api/protected_areas/pairs',
                        data: {
                            _token: window.Laravel.csrfToken,
                            ids: value
                        },
                    })
                        .then(function (response) {
                            if(Object.values(response.data).length>0){
                                Object.values(response.data).forEach(function (item) {
                                    _this.pushItem(item);
                                });
                            }
                        })
                        .catch(function () {
                            // _this.setErrors();
                        })
                }
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
                let _this = this;
                this.pushItem({
                    id: this.selectedValue.wdpa_id,
                    label: this.selectedValue.name,
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
