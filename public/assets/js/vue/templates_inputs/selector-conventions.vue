<template>

    <modal-selector
        class="selector-conventions"
        :parent-id=id
        :anchor-label=anchorLabel
    >

        <!-- Modal -->
        <template v-slot:modal_content>

            <modal_api_search
                    :parent-id=id
                    search-url='ajax/search/conventions'
            >
                <template v-slot:resultItem="{ item }">
                    <td><b>{{ item.designation}}</b></td>
                    <td>
                        <ul>
                            <li v-for="related in item.related_names">{{ related.name }}</li>
                        </ul>
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

    .modal_selector.selector-conventions{

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

        data (){
            return {
                Locale: window.Locale,
                anchorLabel: null,
                selectedValue: null,
                confirmedValue: null
            }
        },

        watch:{
            inputValue(value){
                this.anchorLabel = this.confirmedValue = value;
            }
        },

        mounted(){
            this.modalComponent = this.$children[0];
            this.searchComponent = null;    // will be populated from modalComponent when modal opens
            this.anchorLabel = this.inputValue;
        },

        methods: {

            confirmSelection(){
                this.confirmedValue = this.selectedValue.designation;
                this.emitValue(this.confirmedValue);
                this.modalComponent.closeModal();
            },

        }
    }

</script>