<template>

    <span>

        <div class="modal-header">


            <div class="modal_search">
                <i>{{ Locale.getLabel('modular-forms::common.search_item') }}: </i>
                <!-- Search by key -->
                <input type="text" class="field-edit" ref="searchByKey" autofocus
                       v-model="searchKey"
                       v-on:keydown.13="preventDefault"
                       v-on:keyup.13="applySearch" />
                <!-- Option search filters -->
                <slot name="modal_search_filters"></slot>
                <!-- Search button -->
                <button type="button" class="btn-nav gray small"
                        v-on:click="applySearch"
                        :disabled=!isSearchable >
                    {{ Locale.getLabel('modular-forms::common.search') }}
                </button>
                <br />
                <small v-if="searchKey.length>0 && searchKey.length<keyMinLength" ><i>{{ keyLengthErrorMessage }}</i></small>
                <div class="modal_search_count" v-if="searchExecuted">
                    <b>{{ totalCount }} {{ recordFoundLabel }}</b><br />
                </div>
            </div>

            <!-- Loading icon -->
            <div class="modal_search_loading" v-if="isSearching">
                <br />
                <i class="fa fa-spinner fa-spin fa-2x primary-800"></i>
            </div>

            <!-- Result filters -->
            <div class="modal_search_results_filters" v-if="searchExecuted">
                <slot name="modal_search_results_filters">

                </slot>
            </div>

        </div>

        <div class="modal-body" v-if="searchExecuted">

            <!-- Search Result -->
            <table class="striped modal_search_results">
                <thead v-if="resultTableHeader()!==null">
                    <tr>
                        <th v-for="th in resultTableHeader()" v-html="th"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in showList">
                        <td>
                            <span class="radio">
                                <input type="radio"
                                       :name="parentId + '_radio'" :id="parentId + '_radio' + index"
                                       v-on:click="selectResultItem(item, $event)"
                                       data-toggle="tooltip" data-placement="top" :title=radioTooltip
                                />
                                <label :for="parentId + '_radio' + index" ></label>
                            </span>
                        </td>
                        <slot name="resultItem" v-bind:item="item"></slot>
                    </tr>
                </tbody>
            </table>

        </div>

    </span>

</template>


<style lang="scss" scoped>

    @import "../../../sass/abstracts/all";

    .modal_selector{

        .modal-header{
            flex-direction: column;
            align-items: center;
        }

        .modal_search,
        .modal_search_results_filters{
            font-size: 0.9em;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .field-edit{
            width: 250px;
            height: 28px;
            padding: 4px 12px;
            margin: 2px 16px;
        }
        .searchByKey:focus{
            background-color: #D9534F;
        }

        .modal_search_loading{
            text-align: center;
        }

        .modal_search_count{
            padding: 8px 10px;
            color: $primary-800;
        }

        table.modal_search_results{
            td,tr{
                font-size: 0.9em;
                text-align: center;
            }
            td{
                padding: 4px 12px;
                .result_left{
                    display: block;
                    text-align: left;
                }
            }
            .radio{
                margin-top: 5px;
                margin-bottom: 0;
                //label{
                //  &::before{
                //    left: 20px;
                //    top: -30px;
                //  }
                //  &::after{
                //    left: 23px;
                //    top: -27px;
                //  }
                //}
            }
            label{
                margin: 0;
                padding: 0;
            }
        }

    }

</style>


<script>

    export default {

        mixins: [
            window.ModularForms.MixinsVue.filter,
            window.ModularForms.MixinsVue.values
        ],

        props: {
            searchUrl: {
                type: String,
                default: null
            },
            parentId:  {
                type: String,
                default: null
            },
            keyMinLength: {
                type: Number,
                default: 4
            },
            parentSearchParamsValid:  {
                type: Boolean,
                default: false
            },
            radioTooltip:  {
              type: String,
              default: null
            }
        },

        data (){
            return {
                Locale: window.Locale,
                selectorComponent: null,
                searchKey: '',
                searchExecuted: false,
                isSearching: false,
                searchResults: [],
                showList: [],
                selectedValue: null
            }
        },

        mounted(){
            this.selectorComponent = this.$parent.$parent;  /// the selector (component) which extends this component
            this.selectorComponent.searchComponent = this;
        },

        computed: {
            keyLengthErrorMessage(){
                return Locale.getLabel('modular-forms::common.type_at_least', {'num_chars': this.keyMinLength} );
            },
            recordFoundLabel(){
                return Locale.getLabel('modular-forms::common.record_found', this.totalCount);
            },
            isSearchable(){
                return this.parentSearchParamsValid
                 || this.searchKey.length >= this.keyMinLength;
            },
        },

        methods: {

            searchParams(){
                let _this = this;
                let params = {
                    '_token': window.Laravel.csrfToken,
                    'search_key': _this.searchKey
                };
                if(typeof this.selectorComponent.searchParams === "function"){
                    Object.entries(_this.selectorComponent.searchParams()).forEach(([key, value]) => {
                        params[key] = value;
                    });
                }
                return params;
            },

            preventDefault(event){
                event.preventDefault();
                event.stopPropagation();
                return false
            },

            applySearch(event) {
                let _this = this;
                if (_this.isSearchable) {

                    _this.isSearching = true;
                    _this.searchExecuted = false;
                    _this.selectedValue = null;
                    _this.searchResults = [];
                    _this.showList = [];

                    window.axios({
                        method: 'POST',
                        url: _this.searchUrl,
                        data: _this.searchParams(),
                    })
                        .then(function (response) {
                            _this.searchResults = response.data['records'];
                            _this.showList = _this.searchResults;
                            _this.totalCount = _this.searchResults.length;
                            _this.searchExecuted = true;
                            _this.isSearching = false;
                            _this.afterSearch(response);
                        })
                        .catch(function () {
                            // _this.setErrors();
                        })
                }
            },

            afterSearch(response){
                if(typeof this.selectorComponent.afterSearch === "function"){
                    this.selectorComponent.afterSearch(response);
                }
            },

            resultTableHeader(){
                if(typeof this.selectorComponent.resultTableHeader === "function"){
                    return this.selectorComponent.resultTableHeader();
                }
                return [];
            },

            filterShowList(filters){
                let _this = this;
                _this.selectedValue = _this.selectorComponent.selectedValue = null;
                let filteredList = _this.searchResults;
                Object.keys(filters).forEach(function (key) {
                    filteredList = _this.filterByAttribute(filteredList, filters[key], key);
                });
                _this.showList = filteredList;
            },

            selectResultItem(item, event){
                if(this.radioTooltip!==null){
                  let radio = event.srcElement;
                  window.$(radio).tooltip('show');
                }
                this.selectedValue = item;
                this.selectorComponent.selectedValue = this.selectedValue;
            },

        }
    }
</script>
