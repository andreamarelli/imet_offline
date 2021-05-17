<template>

    <modal-selector
            class="selector-person"
            :parent-id=id
            :anchor-label=anchorLabel
    >

        <!-- Modal -->
        <template v-slot:modal_content>

            <modal_api_search
                    :parent-id=id
                    search-url='ajax/search/staff'
            >
                <template v-slot:resultItem="{ item }">
                    <td class="result_left">
                        <b>{{ item.first_name }} {{ item.last_name}}</b>
                    </td>
                    <td>
                        {{ item.email }}
                    </td>
                    <td>
                        {{ item.organisation }}
                    </td>
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

    .module-container .modal_selector.selector-person{

        table.modal_search_results{
            td{
                text-align: left;
                vertical-align: top;
                ul{
                    margin: 0;
                    -webkit-padding-start: 15px;
                    li{
                        margin-bottom: 3px;
                    }
                }
            }
        }

    }

</style>

<script>

    import modal from './components/modal-selector.vue';
    import modal_api_search from './components/modal-api-search.vue';
    import common from '../mixins/common.input.mixin';

    export default {

        components: {
            'modal-selector': modal,
            'modal_api_search': modal_api_search
        },

        mixins: [
            common
        ],

        props: {
            inputLabel: {
                type: String,
                default: null,
            },
        },

        data (){
            return {
                Locale: window.Locale,
                anchorLabel: null,
                selectedValue: null,
                confirmedValue: null,
                confirmedLabel: null
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
            this.anchorLabel = this.inputLabel;
        },

        methods: {

            resultTableHeader(){
                return [
                    '',
                    Locale.getLabel('entities.common.name'),
                    Locale.getLabel('entities.common.email'),
                    Locale.getLabel('entities.staff.institution')
                ]
            },

            confirmSelection(){
                this.confirmedLabel = this.selectedValue.name;
                this.confirmedValue = this.selectedValue.id;
                this.emitValue(this.confirmedValue);
                this.modalComponent.closeModal();
            },

        }
    }

</script>