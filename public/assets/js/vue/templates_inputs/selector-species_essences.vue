<template>

    <modal-selector
            class="selector-essences"
            :parent-id=id
            :anchor-label=anchorLabel
    >

        <!-- Modal -->
        <template v-slot:modal_content>

            <modal_api_search
                    :parent-id=id
                    search-url='ajax/search/essences'
            >
                <template v-slot:resultItem="{ item }">
                    <td><b>{{ item.Name }}</b></td>
                    <td>
                        <ul>
                            <li v-for="commercial_name in item.commercial_names">{{ commercial_name.Name }}</li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li v-for="scientific_name in item.scientific_names">{{ scientific_name.Name }}</li>
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

    .module-container .modal_selector.selector-essences{

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

            resultTableHeader(){
                return [
                    '',
                    Locale.getLabel('entities.biodiversity.essence.essence', 1),
                    Locale.getLabel('entities.biodiversity.essence.commercial_names'),
                    Locale.getLabel('entities.biodiversity.essence.scientific_names'),
                ]
            },

            confirmSelection(){
                this.confirmedValue = this.selectedValue.Name;
                this.emitValue(this.confirmedValue);
                this.modalComponent.closeModal();
            },

        }
    }

</script>