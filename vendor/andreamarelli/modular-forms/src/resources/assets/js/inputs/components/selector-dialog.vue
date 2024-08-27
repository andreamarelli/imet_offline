<template>

    <dialog-box ref="dialogComponent" class="selector-dialog">

        <!-- ###################################################### -->
        <!-- ######################  anchor  ###################### -->
        <!-- ###################################################### -->
        <template v-slot:dialog-anchor>
            <div v-if="!multiple" class="field-preview" v-html="anchorLabel()"></div>
            <div v-else class="field-preview">
                <span v-if="!Common.isEmpty(confirmedItem)"
                      v-for="item in confirmedItem" class="multiple dontOpenDialog">
                    <span v-html="anchorMultipleLabel(item)"></span>
                    <i class="remove_item fa-solid fa-xmark" v-on:click=removeItem(item)></i>
                </span>
            </div>
        </template>

        <!-- ###################################################### -->
        <!-- ######################  dialog  ###################### -->
        <!-- ###################################################### -->
        <template v-slot:dialog-content>
            <div class="with_header_and_footer">

                <!-- dialog header -->
                <div class="header">
                    <div class="dialog-title">{{ Locale.getLabel('modular-forms::common.select_item') }}</div>
                    <button type="button" class="close" v-on:click=closeSelectorDialog><i class="fa fa-times black"></i></button>
                </div>

                <!-- dialog body -->
                <div class="body">

                    <!--  ###############  API search   ############### -->
                    <div v-show="displaySearch" class="dialog_search">

                        <!-- Search by key -->
                        <i>{{ Locale.getLabel('modular-forms::common.search_item') }}: </i>
                        <input type="text" class="field-edit dialog_search_by_key" autofocus
                               v-model="searchKey"
                               v-on:keydown.enter.prevent="applySearch"
                        />

                        <!-- Optional search filters -->
                        <slot name="searchFilters"></slot>

                        <!-- Search button -->
                        <button type="button" class="btn-nav gray small"
                                v-on:click="applySearch"
                                :disabled=!isSearchable >
                            {{ Locale.getLabel('modular-forms::common.search') }}
                        </button>

                        <!-- Search error / count -->
                        <div class="dialog_search_error" v-if="searchKey.length>0 && searchKey.length<keyMinLength" >
                            <i>{{ keyLengthErrorMessage }}</i>
                        </div>
                        <div class="dialog_search_count" v-if="searchExecuted">
                            <b>{{ totalCount }} {{ recordFoundLabel }}</b><br />
                        </div>

                        <!-- Loading icon -->
                        <div class="dialog_search_loading" v-if="isSearching">
                            <br />
                            <i class="fa fa-spinner fa-spin fa-2x primary-800"></i>
                        </div>

                        <!-- Result filters -->
                        <div class="dialog_search_results_filters" v-if="searchExecuted">
                            <slot name="searchResultFilters"></slot>
                        </div>

                        <!-- Search Result -->
                        <table class="striped dialog_search_results" v-if="searchExecuted">
                            <thead>
                            <tr>
                                <th></th>
                                <slot name="searchResultHeader"></slot>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item, index) in showList">
                                <td>
                                    <input type="radio"
                                           :name="parentId + '_radio'" :id="parentId + '_radio' + index"
                                           v-on:click="selectResultItem(item)"
                                    />
                                    <label :for="parentId + '_radio' + index" ></label>
                                </td>
                                <slot name="searchResultItem" :item=item></slot>
                            </tr>
                            </tbody>
                        </table>

                    </div>


                    <!--  ###############  INSERT   ############### -->

                    <!-- INSERT item (text) -->
                    <div v-show="displayInsertText" class="dialog_insert">
                        <input type="text" class="field-edit dialog_insert_freetext" v-model=insertedItem />
                        <div class="dialog_insert_msg">
                            <i>{{ Locale.getLabel('modular-forms::common.be_specific_as_possible') }}</i>
                        </div>
                    </div>

                    <!-- INSERT item (object) -->
                    <div v-if="withId" v-show="displayInsertObject" class="dialog_insert">
                        <slot name="insertObject" :item=insertedItem></slot>
                    </div>


                </div>

                <!-- dialog footer -->
                <div class="footer">

                    <!-- insert toggle -->
                    <button type="button"
                            class="btn-nav dark small"
                            v-show="withInsert && displaySearch"
                            v-on:click=enableInsert >
                        {{ Locale.getLabel('modular-forms::common.add_if_not_found') }}
                    </button>

                    <div class="spacer"></div>

                    <!-- error message -->
                    <div v-html="errorLabel" class="error text-sm"></div>

                    <!-- cancel -->
                    <button type="button"
                            class="btn-nav dark small"
                            v-on:click=closeSelectorDialog >
                        {{ Locale.getLabel('modular-forms::common.cancel') }}
                    </button>

                    <!-- confirm insert -->
                    <button type="button"
                            class="btn-nav dark small"
                            v-show="displayInsertText || displayInsertObject"
                            v-on:click=confirmInsert >
                        {{ Locale.getLabel('modular-forms::common.add') }}
                    </button>

                    <!-- confirm select -->
                    <button type="button"
                            class="btn-nav dark small"
                            :disabled="selectedItem===null"
                            v-show=displaySearch
                            v-on:click=confirmSelection >
                        {{ Locale.getLabel('modular-forms::common.confirm_select') }}
                    </button>

                </div>

            </div>
        </template>

    </dialog-box>

</template>


<style lang="scss">

    .selector-dialog {
        .dialog-anchor{
            max-width: 450px;
        }
    }

</style>

<style lang="scss" scoped>

    .with_header_and_footer{

        .body {

            .dialog_search,
            .dialog_insert {
                max-height: 80vh;
                overflow-y: auto;
            }

            .dialog_search{
                padding: 10px;
                text-align: center;

                .dialog_search_by_key{
                    width: 200px;
                    margin: 0 10px;
                }

                .dialog_search_error{
                    @apply text-red-700;
                }
                .dialog_search_error,
                .dialog_search_count{
                    @apply text-xs;
                    margin: 5px 0;
                }

                .dialog_search_results_filters{
                    margin: 10px 0;
                }

                .dialog_search_results{
                    th, td{
                        @apply text-xs;
                    }
                }


            }

        }

    }

</style>

<script setup>

    import {
        computed,
        ref,
        inject,
        onBeforeMount,
        watch
    } from "vue";

    const Locale = window.ModularForms.Helpers.Locale;
    const Common = window.ModularForms.Helpers.Common;

    const props = defineProps({
        parentId:  {
            type: String,
            default: null
        },
        searchUrl: {
            type: String,
            default: null
        },
        labelUrl: {
            type: String,
            default: null
        },
        createUrl: {
            type: String,
            default: null
        },
        withInsert: {
            type: Boolean,
            default: false,
        },
        withId: {
            type: Boolean,
            default: false,
        },
        multiple: {
            type: Boolean,
            default: false,
        },
        keyMinLength: {
            type: Number,
            default: 4
        },
        parentSearchParamsValid:  {
            type: Boolean,
            default: false
        }
    });

    // components, injections & expose
    const dialogComponent = ref(null);
    const selectorComponent_AfterSearch = inject('afterSearch', null);
    const selectorComponent_AfterLabelRetrieve = inject('AfterLabelRetrieve', null);
    const selectorComponent_SetLabel = inject('setLabel', null);
    const selectorComponent_SetValue = inject('setValue', null);
    // const selectorComponent_setSelectedValue = inject('setSelectedValue', null);
    const selectorComponent_beforeDialogClose = inject('beforeDialogClose', null);
    const selectorComponent_getSearchParams = inject('getSearchParams', null);
    const selectorComponent_validateInsert = inject('validateInsert', null);
    defineExpose({
        filterShowList
    })

    // values/labels
    const inputValue = defineModel();
    const selectedItem = ref(null);
    const insertedItem = ref(null);
    const confirmedItem = ref(null);
    const searchKey = ref('');
    const isSearching = ref(false);
    const searchResults = ref({});
    const showList = ref({});
    const totalCount = ref(null);
    const searchExecuted = ref(false);
    const errorLabel = ref(null);

    // computed
    const isSearchable = computed(() => {
        return props.parentSearchParamsValid
            || searchKey.value.length >= props.keyMinLength;
    });
    const keyLengthErrorMessage = computed(() => {
        return Locale.getLabel('modular-forms::common.search_key_min_length', {num_chars: props.keyMinLength});
    });
    const recordFoundLabel = computed(() => {
        return Locale.getLabel('modular-forms::common.record_found', totalCount.value);
    });

    // template state
    const displaySearch = ref(true);
    const displayInsertText = ref(false);
    const displayInsertObject = ref(false);

    onBeforeMount(() => {
        setConfirmedItem(inputValue.value);
        insertedItem.value = props.withId ? {} : null;
    })

    watch(inputValue, (newValue, oldValue) => {
        if(oldValue!==newValue){
            setConfirmedItem(newValue);
        }
    });

    // ###################################################
    // ###############  Methods - GENERAL  ###############
    // ###################################################

    function setConfirmedItem(value){
        if (!window.ModularForms.Helpers.Common.isEmpty(value) && value!==false && props.withId){
            retrieveItemFromId(value)
        } else {
            confirmedItem.value = value;
        }
    }

    function retrieveItemFromId(value){
        fetch(props.labelUrl, {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": window.Laravel.csrfToken,
            },
            body: JSON.stringify({
                id: value
            }),
        })
            .then((response) => response.json())
            .then(function(data){
                // Check if a custom "afterSearch" is defined in parent component
                if(typeof selectorComponent_AfterLabelRetrieve === "function"){
                    selectorComponent_AfterLabelRetrieve(data.records);
                }
                confirmedItem.value = data.records;
            })
            .catch(function (error) {});
    }

    function anchorLabel(){
        // Check if a custom "SetLabel" is defined in parent component
        if(typeof selectorComponent_SetLabel === "function" && confirmedItem.value!==null){
            return props.withId
                ? selectorComponent_SetLabel(confirmedItem.value[0])
                : selectorComponent_SetLabel(confirmedItem.value);
        }
        return confirmedItem.value;
    }

    function anchorMultipleLabel(item) {
        // Check if a custom "SetLabel" is defined in parent component
        return typeof selectorComponent_SetLabel === "function"
            ? selectorComponent_SetLabel(item)
            : item;
    }

    function resetSelectorDialog(){
        resetSearchResult();
        resetError();
        searchKey.value = '';
        errorLabel.value = null;
        displayInsertText.value = false;
        displayInsertObject.value = false;
        displaySearch.value = true;
        selectedItem.value = null;
        insertedItem.value = props.withId ? {} : null;
    }

    function resetSearchResult(){
        isSearching.value = false;
        searchExecuted.value = false;
        totalCount.value = null;
        selectedItem.value = null;
        searchResults.value = {};
        showList.value = {};
    }

    function resetError(){
        errorLabel.value = null;
    }

    /**
     *  Close the SelectorDialog component
     */
    function closeSelectorDialog(){
        // Check if a custom "beforeDialogClose" is defined in parent component
        if(typeof selectorComponent_beforeDialogClose === "function"){
            selectorComponent_beforeDialogClose();
        }
        resetSelectorDialog();
        dialogComponent.value.closeDialog();
    }

    /**
     * Apply new item and close
     */
    function applyAndClose(){
        if(typeof selectorComponent_SetValue === "function"){
            if(props.multiple){
                let values = [];
                (confirmedItem.value).forEach(function (item) {
                    values.push(selectorComponent_SetValue(item).toString());
                });
                inputValue.value = JSON.stringify(values);
            } else if(props.withId){
                inputValue.value = selectorComponent_SetValue(confirmedItem.value[0]);
            } else {
                inputValue.value = selectorComponent_SetValue(confirmedItem.value);
            }
        } else {
            inputValue.value = confirmedItem.value;
        }

        closeSelectorDialog();
    }

    function setError(label = null){
        label = label===null
            ? Locale.getLabel('modular-forms::common.saved_error')
            : label;
       errorLabel.value = Locale.getLabel(label);
    }


    // ########################################################
    // #############  Methods - Selection/search  #############
    // ########################################################

    function searchParams(){
        let params = {
            'search_key': searchKey.value
        };
        // Check if a custom "getSearchParams" is defined in selectorComponent
        if(typeof selectorComponent_getSearchParams === "function"){
            Object.entries(selectorComponent_getSearchParams()).forEach(([key, value]) => {
                params[key] = value;
            });
        }
        return params;
    }

    function applySearch(event) {
        if (isSearchable.value) {

            resetSearchResult();
            isSearching.value = true;

            fetch(props.searchUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": window.Laravel.csrfToken
                },
                body: JSON.stringify(searchParams())
            })
                .then((response) => response.json())
                .then(function(data){
                    searchResults.value = data['records'];
                    showList.value = data['records'];
                    totalCount.value = Object.keys(searchResults.value).length;
                    searchExecuted.value = true;
                    isSearching.value = false;
                    // Check if a custom "afterSearch" is defined in parent component
                    if(typeof selectorComponent_AfterSearch === "function"){
                        selectorComponent_AfterSearch(data);
                    }
                })
                .catch(function () {
                    setError();
                })
        }
    }

    function filterShowList(filters){
        selectedItem.value = null;
        let filteredList = searchResults.value;
        filteredList = Object.values(filteredList)
        Object.keys(filters).forEach(function (key) {
            filteredList = filterByAttribute(filteredList, filters[key], key);
        });
        showList.value = filteredList;
    }

    function selectResultItem(item){
        selectedItem.value = item;
    }

    function confirmSelection(){
        if(props.multiple){
            confirmedItem.value = confirmedItem.value || [];
            confirmedItem.value.push(selectedItem.value);
        } else if(props.withId){
            confirmedItem.value = [selectedItem.value];
        } else {
            confirmedItem.value = selectedItem.value;
        }
        applyAndClose();
    }

    function removeItem(item){
        let idx = confirmedItem.value.indexOf(item);
        if(idx > -1){
            confirmedItem.value.splice(idx, 1);
        }
        applyAndClose();
    }

    // ####################################################
    // ################  Methods - insert  ################
    // ####################################################

    function enableInsert(){
        displayInsertText.value = !props.withId;
        displayInsertObject.value = props.withId;
        displaySearch.value = false;
    }

    function confirmInsert(){
        // Validate inserted item
        let valid = false;
        if(typeof selectorComponent_validateInsert === "function"){
            // Custom validation
            valid = selectorComponent_validateInsert(insertedItem.value);
        } else {
            // Standard validation: just check if not empty
            valid = props.withId
                ? insertedItem.value!=={}
                : insertedItem.value!==null;
        }
        // Save/apply
        if(valid){
            resetError();
            confirmedItem.value = insertedItem.value
            if(props.withId) {
                saveNewItem();
            } else {
                applyAndClose();
            }
        } else {
            setError(Locale.getLabel('common.validation_error'))
        }

    }

    function saveNewItem(){
        fetch(props.createUrl, {
            method: 'post',
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": window.Laravel.csrfToken,
            },
            body: JSON.stringify(confirmedItem.value),
        })
            .then((response) => response.json())
            .then(function(data) {
                confirmedItem.value = data.records;
                applyAndClose();
            })
            .catch(function () {
                setError();
            });
    }


</script>
