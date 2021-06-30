<template>

    <modal-selector
        class="selector-institutions"
        :parent-id=id
        :anchor-label=anchorLabel
    >

        <!-- Modal -->
        <template v-slot:modal_content>

            <modal_api_search
                :parent-id=id
                search-url='ajax/search/institutions'
            >

                <template v-slot:resultItem="{ item }">
                    <td><b>{{ item.Acronym }}</b></td>
                    <td>{{ item.FullName }}</td>
                    <td>
                        <flag :iso2=item.country_rel.iso2></flag>&nbsp;
                        {{ item.country_rel.name }}</td>
                    <td>{{ item.LegalStatus }}</td>
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

.modal_selector.selector-institutions{

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
        dataCountries: {
            type: Object,
            default: () => {}
        },
        labelAsId: {
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
            confirmedLabel: null
        }
    },

    watch:{
        inputValue(value){
            if(this.labelAsId){
                this.anchorLabel = this.confirmedValue = value;
            } else {
                this.anchorLabel = this.confirmedLabel!==null ? this.confirmedLabel : null;
                this.confirmedLabel = null;
                this.confirmedValue = value;
            }

        }
    },

    mounted(){
        this.modalComponent = this.$children[0];
        this.searchComponent = null;    // will be populated from modalComponent when modal opens
        this.anchorLabel = this.labelAsId ? this.inputValue : 'hello world!!';
    },

    methods: {

        resultTableHeader(){
            return [
                '',
                Locale.getLabel('entities.common.denomination_acronym'),
                Locale.getLabel('entities.common.full_name'),
                Locale.getLabel('form/institution.Country'),
                Locale.getLabel('form/institution.LegalStatus')
            ]
        },

        confirmSelection(){
            this.confirmedValue = this.selectedValue.name;
            if(!this.labelAsId) {
                this.confirmedValue = this.selectedValue.InstitutionID;
            }
            this.emitValue(this.confirmedValue);
            this.modalComponent.closeModal();
        },

    }
}

</script>
