<template>

    <span>

        <div class="modal-header">


            <div class="modal_search">
                <i>{{ Locale.getLabel('modular-forms::common.search_item') }}: </i>&nbsp;&nbsp;
                <!-- Search by key -->
                <input type="text" class="field-edit"
                       v-model="searchKey"
                       v-on:keyup.13="applySearch" />
                <!-- Option search filters -->
                <slot name="modal_search_filters"></slot>
                <!-- Search button -->
                <button type="button" class="btn-nav gray small"
                        v-on:click="applySearch"
                        :disabled=!isSearchable >
                    {{ Locale.getLabel('modular-forms::common.search') }}
                </button>

                <span  v-if="searchExecuted && totalCount===0">
                    <button type="button"
                            id="add_button_popup"
                            class="btn-nav dark small"
                            data-toggle="modal"
                            :data-target="'#'+parentId+'_createkeywords_popup'"
                            v-on:click="copySearchKeyTonewKeywords"
                            >
                        {{ Locale.getLabel('modular-forms::common.add') }}
                    </button>
                </span>
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
                                <input type="radio" :name="parentId + '_radio'" :id="parentId + '_radio' + index" v-on:click="selectResultItem(item)"/>
                                       <label :for="parentId + '_radio' + index" ></label>
                            </span>
                        </td>
                <slot name="resultItem" v-bind:item="item"></slot>
                </tr>
                </tbody>
            </table>

        </div>

        <div :id="parentId+'_createkeywords_popup'" class="modal fade selector-AddKeywords" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" >
                        <button type="button" class="close" aria-hidden="true"
                                v-on:click="closeModal" >
                            ×
                        </button>
                    </div>
                    <div class="modal-body" >
                        <i>{{ Locale.getLabel('modular-forms::common.add_if_not_found') }}: </i>&nbsp;&nbsp;

                        <!--The keywords to be create-->
                        <input type="text" class="field-edit" name="newkeywords" v-model="newKeywords" />

                        <button type="button"
                                class="btn-nav dark small"
                                data-toggle="modal"
                                :disabled="newKeywords.length<4"
                                v-on:click="createKeywords"
                                >
                            {{ Locale.getLabel('modular-forms::common.create') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </span>

</template>


<style lang="scss" scoped>

    @import "../../../sass/abstracts/all";

    .modal_selector{

        .modal_search, .selector-AddKeywords,
        .modal_search_results_filters{
            font-size: 0.9em;
            text-align: center;
        }

        .field-edit{
            width: 250px;
            height: 28px;
            padding: 4px 12px;
        }

        .modal_search_loading{
            text-align: center;
        }

        .modal_search_count{
            padding: 8px 0;
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
            parentId: {
                type: String,
                default: null
            },
            keyMinLength: {
                type: Number,
                default: 4
            },
            parentSearchParamsValid: {
                type: Boolean,
                default: false
            },
        },

        data() {
            return {
                Locale: window.Locale,
                selectorComponent: null,
                searchKey: '',
                newKeywords: '',
                searchExecuted: false,
                isSearching: false,
                searchResults: [],
                showList: [],
                totalCount: null,
                selectedValue: null,
            }
        },

        mounted() {
            this.selectorComponent = this.$parent.$parent;  /// the selector (component) which extends this component
            this.selectorComponent.searchComponent = this;
        },

        computed: {
            keyLengthErrorMessage() {
                return Locale.getLabel('modular-forms::common.type_at_least', {'num_chars': this.keyMinLength});
            },
            recordFoundLabel() {
                return Locale.getLabel('modular-forms::common.record_found', this.totalCount);
            },
            isSearchable() {
                return this.parentSearchParamsValid
                        || this.searchKey.length >= this.keyMinLength;
            },

        },

        methods: {

            searchParams() {
                let _this = this;
                let params = {
                    '_token': window.Laravel.csrfToken,
                    'search_key': _this.searchKey
                };
                if (typeof this.selectorComponent.searchParams === "function") {
                    Object.entries(_this.selectorComponent.searchParams()).forEach(([key, value]) => {
                        params[key] = value;
                    });
                }
                return params;
            },
            searchParamAddedWord(data) {
                let _this = this;
                let params = {
                    '_token': window.Laravel.csrfToken,
                    'search_key': data
                };
                if (typeof this.selectorComponent.searchParamAddedWord === "function") {
                    Object.entries(_this.selectorComponent.searchParamAddedWord(data)).forEach(([key, value]) => {
                        params[key] = value;
                    });
                }
                return params;
            },

            applySearch() {
                let _this = this;
                if (_this.isSearchable) {

                    _this.isSearching = true;
                    _this.searchExecuted = false;
                    _this.selectedValue = null;
                    _this.searchResults = [];
                    _this.showList = [];

                    window.axios({
                        method: 'post',
                        url: window.Laravel.baseUrl + _this.searchUrl,
                        data: _this.searchParams(),
                    })
                            .then(function (response) {
                                _this.searchResults = response.data['records'];
                                _this.showList = _this.searchResults;
                                _this.totalCount = _this.searchResults.length;
                                _this.searchExecuted = true;
                                _this.isSearching = false;
                                _this.afterSearch(response.data);
                            })
                            .catch(function () {
                                // _this.setErrors();
                            })
                }
            },
            createKeywords() {
                let _this = this;
                window.axios({
                    method: 'post',
                    url: window.Laravel.baseUrl + 'api/library/createKeywords',
                    data: {
                        '_token': window.Laravel.csrfToken,
                        'newKeywords': _this.newKeywords
                    }
                })
                        .then(function (response) {
                            _this.applySearchAfterCreatekeywords(response.data);
                            _this.searchKey = response.data.word;
                            _this.closeModal();
                            // console.log('BD response'+response.word);
                        })
                        .catch(function () {
                        })

            },
            applySearchAfterCreatekeywords(response) {
                let _this = this;
                _this.isSearching = true;
                _this.searchExecuted = false;
                _this.selectedValue = null;
                _this.searchResults = [];
                _this.showList = [];

                window.axios({
                    method: 'post',
                    url: window.Laravel.baseUrl + _this.searchUrl,
                    data: _this.searchParamAddedWord(response.word),
                })
                        .then(function (response1) {
                            _this.searchResults = response1.data['records'];
                            _this.showList = _this.searchResults;
                            _this.totalCount = _this.searchResults.length;
                            _this.searchExecuted = true;
                            _this.isSearching = false;
                            _this.afterSearch(response1.data);
                        })
                        .catch(function () {
                        })
            },
            closeModal(){
                let _this = this;
                $('#'+_this.parentId+'_createkeywords_popup').modal('hide');
            },
            copySearchKeyTonewKeywords(){
                let _this = this;
                _this.newKeywords= _this.searchKey;
            },

            afterSearch(response) {
                if (typeof this.selectorComponent.afterSearch === "function") {
                    this.selectorComponent.afterSearch(response);
                }
            },

            resultTableHeader() {
                if (typeof this.selectorComponent.resultTableHeader === "function") {
                    return this.selectorComponent.resultTableHeader();
                }
                return [];
            },

            filterShowList(filters) {
                let _this = this;
                _this.selectedValue = _this.selectorComponent.selectedValue = null;
                let filteredList = _this.searchResults;
                Object.keys(filters).forEach(function (key) {
                    filteredList = _this.filterByAttribute(filteredList, filters[key], key);
                });
                _this.showList = filteredList;
            },

            selectResultItem(item) {
                this.selectedValue = item;
                this.selectorComponent.selectedValue = this.selectedValue;
            },

        }
    }
</script>
