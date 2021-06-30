<template>

    <modal-selector
        class="selector-protected_areas"
        :parent-id=id
        :anchor-label=anchorLabel
    >

        <!-- Modal -->
        <template v-slot:modal_content>

            <modal_api_search
                :parent-id=id
                search-url='ajax/search/protected_areas'
                :key-min-length=3
                :parent-search-params-valid=searchParamValid
            >
                <template v-slot:modal_search_filters>&nbsp;
                    {{ Locale.getLabel('entities.common.country') }}
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
                        class="btn btn-sm act-btn-darkgreen"
                        :disabled="selectedValue===null"
                        v-on:click="confirmSelection" >
                    {{ Locale.getLabel('common.confirm_select') }}
                </button>
            </div>

        </template>

    </modal-selector>

</template>

<script>

    import modal from './components/modal-selector.vue';
    import modal_api_search from './components/modal-api-search.vue';
    import common from '../mixins/common.input.mixin';
    import flag from "../templates/flag";

    export default {

        components: {
            flag,
            'modal-selector': modal,
            'modal_api_search': modal_api_search
        },

        mixins: [
            common
        ],

        props: {
            dataCountries: {
                type: Object,
                default: () => {}
            },
            return_wdpa:{
                type: Boolean,
                default: false
            }
        },

        data (){
            return {
                Locale: window.Locale,
                anchorLabel: null,
                selectedValue: null,
                confirmedValue: null,
                confirmedLabel: null,
                filterByCountry: null
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
                    Locale.getLabel('entities.common.name'),
                    Locale.getLabel('entities.protected_area.wdpa_id',1),
                    Locale.getLabel('entities.common.country'),
                    Locale.getLabel('entities.protected_area.iucn_category'),
                ]
            },

            confirmSelection(){
                this.confirmedLabel = this.selectedValue.name;
                this.confirmedValue = this.return_wdpa
                    ? this.selectedValue.wdpa_id
                    : this.selectedValue.global_id;
                this.emitValue(this.confirmedValue);
                this.modalComponent.closeModal();
            },

        }
    }

</script>
