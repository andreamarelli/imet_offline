<template>

    <modal-selector
        class="selector-user"
        :parent-id=id
        :anchor-label=anchorLabel
    >

        <!-- Modal anchor -->
        <template v-slot:modal_anchor>
            <div class="field-preview" v-html="anchorLabel"></div>
        </template>

        <!-- Modal anchor -->
        <template v-slot:disabled_modal_anchor>
            <div class="field-preview" v-html="anchorLabel"></div>
            &nbsp;
            <button class="btn-nav small red" v-on:click="revokeRole"><i class="fa fa-times"></i></button>
        </template>

        <!-- Modal -->
        <template v-slot:modal_content>

            <modal_api_search
                :parent-id=id
                :search-url=searchUrl
            >
                <template v-slot:resultItem="{ item }">
                    <td class="result_left">
                        <b>{{ item.name }}</b>
                    </td>
                    <td>
                        {{ item.email }}
                    </td>
                    <td>
                        <span v-if="item.country !== null">
                            <flag :iso2=item.country.iso2></flag>&nbsp;&nbsp;<i>{{ item.country.name }}</i>
                        </span>
                    </td>
                    <td>
                        {{ item.organisation }}
                    </td>
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

<style lang="scss" scoped>

    .module-container .selector-user{

        .field-preview{
            width: 450px;
            display: inline-block;
        }

    }

</style>

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
        }
    },

    data (){
        return {
            Locale: window.Locale,
            inputValue: null,
            selectedValue: null
        }
    },

    computed:{
        anchorLabel(){
            return this.value!==null && Object.keys(this.value).length
                ? '<b>' + this.value.name + '</b>'
                + (this.value.organisation!==null && this.value.organisation!=='' ? ' - ' + this.value.organisation : '')
                : '';
        }
    },

    mounted(){
        this.modalComponent = this.$children[0];
        this.searchComponent = null;    // will be populated from modalComponent when modal opens
    },

    methods: {

        resultTableHeader(){
            return [
                '',
                Locale.getLabel('imet-core::users.attributes.name'),
                Locale.getLabel('imet-core::users.attributes.email'),
                Locale.getLabel('imet-core::users.attributes.country'),
                Locale.getLabel('imet-core::users.attributes.organisation')
            ]
        },

        confirmSelection(){
            this.emitValue(this.selectedValue);
            this.modalComponent.closeModal();
        },

    }
}

</script>
