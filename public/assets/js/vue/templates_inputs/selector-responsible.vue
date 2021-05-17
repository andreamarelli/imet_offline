<template>

    <modal-selector
        class="selector-responsible"
        :parent-id=id
        :disable_modal=modal_disabled()
    >

        <!-- Modal anchor -->
        <template v-slot:modal_anchor>
            <div class="field-preview" v-html="anchorLabel"></div>
        </template>

        <!-- Modal anchor -->
        <template v-slot:disabled_modal_anchor>
            <div class="field-preview" v-html="anchorLabel"></div>
            &nbsp;
            <button class="btn btn-sm btn-danger" v-on:click="revokeRole"><i class="fa fa-times"></i></button>
        </template>

        <!-- Modal -->
        <template v-slot:modal_content>

            <modal_api_search
                :parent-id=id
                search-url='ajax/search/staff'
            >

                <template v-slot:resultItem="{ item }">
                    <td class="result_left">
                        <b>{{ item.name }}</b>
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
                        v-on:click="grantRole" >
                    {{ Locale.getLabel('common.confirm_select') }}
                </button>
            </div>

        </template>

    </modal-selector>

</template>


<style lang="scss" type="text/scss" scoped>

    .module-container .selector-responsible{

        .field-preview{
            width: 450px;
            display: inline-block;
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
            'modal_api_search': modal_api_search,
        },

        mixins: [
            common
        ],

        props: {
            role: null,
            scope: null,
            country: null,
            role_url: null,
        },

        data(){
          return{
              Locale: window.Locale,
              inputValue: null,
              selectedValue: null,
              grantUrl: this.role_url + '/grant',
              revokeUrl: this.role_url + '/revoke',
          }
        },

        computed:{
            anchorLabel(){
                return this.value!==null && Object.keys(this.value).length
                    ? '<b>'+this.value.name+'</b>'
                        + (this.value.organisation!==null && this.value.organisation!=='' ? ' - ' + this.value.organisation : '')
                    : '';
            }
        },

        mounted(){
            this.modalComponent = this.$children[0];
            this.searchComponent = null;    // will be populated from modalComponent when modal opens
        },

        methods:{

            modal_disabled(){
                return this.value!==null;
            },

            resultTableHeader(){
                return [
                    '',
                    Locale.getLabel('entities.common.name'),
                    Locale.getLabel('entities.common.email'),
                    Locale.getLabel('entities.staff.institution'),
                ]
            },

            grantRole(){
                let _this = this;

                window.axios({
                    method: 'post',
                    url: _this.grantUrl,
                    data: {
                        _token: window.Laravel.csrfToken,
                        user_id: _this.selectedValue.id,
                        role: _this.role,
                        scope: _this.scope,
                        country: _this.country
                    }
                })
                    .then(function (response) {
                        if(response['status']===200){
                            _this.confirmSelection();
                        } else {
                            _this.modalComponent.setError();
                        }
                    })
                    .catch(function (response) {
                        _this.modalComponent.setError();
                    })
                    .finally(function (response) {

                    });
            },

            revokeRole(){
                let _this = this;

                window.axios({
                    method: 'post',
                    url: _this.revokeUrl,
                    data: {
                        _token: window.Laravel.csrfToken,
                        user_id: _this.value.user_id,
                        role: _this.role,
                        scope: _this.scope,
                        country: _this.country
                    }
                })
                    .then(function (response) {
                        if(response['status']===200){
                            _this.selectedValue = null;
                            _this.confirmSelection();
                        } else {
                            _this.modalComponent.setError();
                        }
                    })
                    .catch(function (response) {
                        _this.modalComponent.setError();
                    })
                    .finally(function (response) {

                    });
            },

            confirmSelection(){

                if(this.selectedValue!==null){
                    this.selectedValue = {
                        name: this.selectedValue.name,
                        organisation: this.selectedValue.organisation,
                        role: this.role,
                        user_id: this.selectedValue.id
                    };
                }

                this.emitValue(this.selectedValue);
                this.modalComponent.closeModal();
            }
        }

    }

</script>