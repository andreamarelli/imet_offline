<template>

    <modal-selector
        class="selector-species_animal"
        :parent-id=id
        :anchor-label=anchorLabel
    >

        <!-- Modal -->
        <template v-slot:modal_content>

            <div v-show="displaySearch" >

                <modal_api_search
                    :parent-id=id
                    search-url='ajax/search/species'
                >
                    <template v-slot:modal_search_results_filters>
                        <i>{{ Locale.getLabel('common.filter_results') }}: </i>&nbsp;&nbsp;

                        {{ Locale.getLabel('entities.biodiversity.taxonomy.class') }}
                        <select v-model=filterByClass @change="filterList(true)" class="field-edit">
                            <option v-for="option in classes">
                                {{ option }}
                            </option>
                        </select>

                        {{ Locale.getLabel('entities.biodiversity.taxonomy.order') }}
                        <select v-model=filterByOrder @change="filterList(false)" class="field-edit">
                            <option v-for="option in orderByClass()">
                                {{ option }}
                            </option>
                        </select>

                    </template>

                    <template v-slot:resultItem="{ item }">
                        <td><span class="result_left" v-html="getSpeciesDescription(item)"></span></td>
                        <td><redlist_category :category=item.iucn_redlist_category></redlist_category></td>
                        <td><a target="_blank" :href="'http://www.iucnredlist.org/details/'+item.iucn_redlist_id+'/0'"><img src="/images/iucn_red_list.png"/></a></td>
                    </template>

                </modal_api_search>

            </div>

            <div v-show="displayInsert" >
                <div class="modal-body insert">
                    <div>
                        {{ Locale.getLabel('entities.biodiversity.species', 1) }}
                        <input type="text" class="field-edit" value="" :id="'selector_item_insert_'+id" />
                    </div>
                    <div>
                        <i>{{ Locale.getLabel('common.be_specific_as_possible') }}</i>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div>
                    <button type="button"
                            v-if="enableFreeText && displaySearch"
                            class="btn btn-sm act-btn-darkgreen"
                            v-on:click="enableFreeTextItem" >
                        {{ Locale.getLabel('common.add_if_not_found') }}
                    </button>
                </div>
                <div>
                    <button type="button"
                            class="btn btn-sm act-btn-darkgreen"
                            v-if=displayInsert
                            v-on:click="confirmInsert" >
                        {{ Locale.getLabel('common.add') }}
                    </button>
                    <button type="button"
                            class="btn btn-sm act-btn-darkgreen"
                            :disabled="selectedValue===null"
                            v-if=displaySearch
                            v-on:click="confirmSelection" >
                        {{ Locale.getLabel('common.confirm_select') }}
                    </button>
                </div>
            </div>

        </template>

    </modal-selector>

</template>


<style lang="scss" type="text/scss" scoped>

    .selector-species_animal{

        .common_names{
            margin-top: 4px;
        }

        .flag-icon{
            margin-right: 4px;
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

    import modal from './components/modal-selector.vue';
    import modal_api_search from './components/modal-api-search.vue';
    import redlist_category from "../templates/redlist_category.vue";
    import common from '../mixins/common.input.mixin';

    export default {

        components: {
            'modal-selector': modal,
            'modal_api_search': modal_api_search,
            redlist_category
        },

        mixins: [
            common
        ],

        props: {
            enableFreeText: {
                type: Boolean,
                default: false,
            },
        },

        data (){
            return {
                Locale: window.Locale,
                inputValue: null,
                selectedValue: null,
                filterByClass: null,
                filterByOrder: null,
                orders: [],
                classes: [],
                displaySearch: true,
                displayInsert: false,
            }
        },

        mounted(){
            this.modalComponent = this.$children[0];
            this.searchComponent = null;    // will be populated from modalComponent when modal opens
        },

        computed:{
            anchorLabel(){
                if(this.inputValue!==null && typeof this.inputValue == "object"){
                    return this.getScientificName(this.inputValue);
                } else if(this.value!==null && this.value.split("|").length>3){
                    let taxonomy = this.value.split("|");
                    return taxonomy[4] + ' ' + taxonomy[5]
                } else {
                    return this.value;
                }
            }
        },

        methods: {

            getScientificName (item){
                return item.genus+' '+item.species;
            },
            getFullTaxonomy (item){
                return item.phylum+'|'+item.class+'|'+item.order+'|'+item.family+'|'+item.genus+'|'+item.species
            },
            getSpeciesDescription(item){
                let description = item.class+' '+item.order+' '+item.family+' <b>'+item.genus+' '+item.species+'</b>';
                if(this.hasCommonNames(item)){
                    description += '<div class="common_names"><b><i>'+Locale.getLabel('entities.biodiversity.common_names')+':</i></b><br />';
                    if(item.common_name_en!==null){
                        description += '<div><span class="flag-icon flag-icon-gb"></span>'+item.common_name_en.replace(/\,/g, ', ')+'</div>'
                    }
                    if(item.common_name_fr!==null){
                        description += '<div><span class="flag-icon flag-icon-fr"></span>'+item.common_name_fr.replace(/\,/g, ', ')+'</div>'
                    }
                    if(item.common_name_sp!==null){
                        description += '<div><span class="flag-icon flag-icon-es"></span>'+item.common_name_sp.replace(/\,/g, ', ')+'</div>'
                    }
                    description += '</div>';
                }
                return description;
            },
            hasCommonNames (item){
                return (item.common_name_en!==null || item.common_name_fr!==null || item.common_name_sp!==null);
            },

            afterModalOpen(){
                this.displayInsert = false;
                this.displaySearch = true;
                $('#selector_item_insert_'+this.id).val(null);
            },

            afterSearch(response){
                this.orders = response['orders'];
                this.classes = response['classes'];
            },

            resultTableHeader(){
                return [
                    '',
                    Locale.getLabel('entities.biodiversity.species', 1),
                    Locale.getLabel('entities.biodiversity.red_list_category'),
                    Locale.getLabel('entities.biodiversity.red_list'),
                ]
            },

            orderByClass(){
                return this.filterByClass!=null
                    ? this.orders[this.filterByClass]
                    : [];
            },

            filterList(alsoResetOrder){
                if(alsoResetOrder){
                    this.filterByOrder = null;
                }
                this.filterByOrder = typeof this.filterByOrder === "undefined" ? null : this.filterByOrder;

                let filters = {
                    'class': this.filterByClass,
                    'order': this.filterByOrder,
                };
                this.searchComponent.filterShowList(filters);
            },

            confirmSelection(){
                this.inputValue = this.selectedValue;
                this.emitValue(this.getFullTaxonomy(this.inputValue));
                this.modalComponent.closeModal();
            },

            enableFreeTextItem(){
                this.displaySearch = false;
                this.displayInsert = true;
            },
            confirmInsert(){
                let value = $('#selector_item_insert_'+this.id).val();
                this.inputValue = value;
                this.emitValue(value);
                this.modalComponent.closeModal();
            }

        }
    }

</script>
