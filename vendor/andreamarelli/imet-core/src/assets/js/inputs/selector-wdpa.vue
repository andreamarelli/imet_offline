<template>

    <modal-selector
        class="selector-wdpa"
        :parent-id=id
        :anchor-label=anchorLabel
    >

        <!-- Modal -->
        <template v-slot:modal_content>

            <modal_api_search
                :parent-id=id
                :search-url=searchUrl
                :key-min-length=3
                :parent-search-params-valid=searchParamValid
                :radioTooltip=radioTooltip
            >
                <template v-slot:modal_search_filters>&nbsp;
                    {{ Locale.getLabel('imet-core::common.country') }}
                    <select v-model=filterByCountry class="field-edit">
                        <option value="null"> - - </option>
                        <option v-for="(label, key) in dataCountries" :value=key>
                            {{ label }}
                        </option>
                    </select>
                </template>

                <template v-slot:modal_search_results_filters>

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
            dataCountries: {
                type: Object,
                default: () => {}
            }
        },

        data (){
            return {
                Locale: window.Locale,
                anchorLabel: null,
                selectedValue: null,
                confirmedValue: null,
                confirmedLabel: null,
                filterByCountry: null,
                radioTooltip: window.Locale.getLabel('imet-core::common.double_check_wdpa')
            }
        },

        computed:{
            searchParamValid(){
                return this.filterByCountry!==null && this.filterByCountry!=="null";
            }
        },

        watch:{
            inputValue(value){
                this.anchorLabel = this.confirmedLabel!==null ? this.confirmedLabel : null;
                this.confirmedLabel = null;
                this.confirmedValue = value;
            }
        },

        mounted(){
            this.modalComponent = this.$children[0];
            this.searchComponent = null;    // will be populated from modalComponent when modal opens
            this.anchorLabel = this.inputValue;
        },

        methods: {

            searchParams(){
                return {
                    'country': this.filterByCountry
                }
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

            confirmSelection(){
                this.confirmedLabel = this.selectedValue.name;
                this.confirmedValue = this.selectedValue.wdpa_id;
                this.emitValue(this.confirmedValue);
                this.modalComponent.closeModal();
            },

        }
    }

</script>
