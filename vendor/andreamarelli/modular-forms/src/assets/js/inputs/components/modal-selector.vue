<template>

    <div class="modal_selector">

        <!-- Custom Anchor -->
        <span class="modal-custom-anchor">
            <slot name="custom_anchor"></slot>
        </span>

        <!-- Modal anchor -->
        <span v-if="!disable_modal" data-toggle="modal" :data-target="'#'+modalId" class="modal-anchor">
            <slot name="modal_anchor">
                <div class="field-preview" data-toggle="tooltip" :title="anchorLabel">
                     {{ anchorLabel }}
                </div>
            </slot>
        </span>

        <!-- Non-interactive Anchor -->
        <span v-else-if="disable_modal" class="modal-disabled-anchor">
             <slot name="disabled_modal_anchor"></slot>
        </span>

        <!-- Modal -->
        <div class="modal fade" v-bind:id=modalId role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" v-if="modalIsOpen === true">

                    <div class="modal-header">
                        <b class="modal-title">{{ modalTitle }}</b>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times black"></i></button>
                    </div>

                    <slot name="modal_content"></slot>

                    <div class="error-bar" v-if="errorLabel!==null">
                        <div class="alert alert-danger text-right" role="alert">
                            {{ errorLabel }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>


</template>

<style lang="scss" scoped>

    .modal_selector{

        .modal-anchor,
        .modal-custom-anchor{
            cursor: pointer;
        }
        .error-bar{
            font-size: 0.9em;
            font-weight: bold;
        }

    }

</style>


<script>

    export default {

        props: {
            disable_modal:  {
                type: Boolean,
                default: false
            },
            parentId:  {
                type: String,
                default: null
            },
            modalTitle:  {
                type: String,
                default: () => {
                    return Locale.getLabel('modular-forms::common.select_item');
                }
            },
            anchorLabel:  {
                type: String,
                default: null
            }
        },

        data (){
            return {
                Locale: window.Locale,
                modalId: 'modal-selector_' + this.parentId,
                modalIsOpen: false,
                errorLabel: null
            }
        },

        mounted (){
            this.toggleModal();
            this.parentComponent = this.$parent;    // the selector (component) which extends this component
        },

        methods: {

            /**
             * Enable/disable form in modal (prevent IDs conflicts)
             */
            toggleModal: function () {
                let _this = this;
                $('#'+_this.modalId)
                    .on('show.bs.modal', function () {
                        _this.modalIsOpen = true;
                    })
                    .on('shown.bs.modal', function () {
                        _this.afterModalOpen();
                    })
                    .on('hide.bs.modal', function (evt) {
                        if(evt.target.id === _this.modalId){
                            _this.beforeModalClose();
                            _this.modalIsOpen = false;
                        }
                    });
            },

            openModal: function(){
                $('#'+this.modalId).modal('show');
            },

            closeModal: function(){
                $('#'+this.modalId).modal('hide');
                this.errorLabel = null;
            },

            afterModalOpen: function () {
                if(typeof this.parentComponent.afterModalOpen === "function"){
                    this.parentComponent.afterModalOpen();
                }
            },
            beforeModalClose: function(){
                if(typeof this.parentComponent.beforeModalClose === "function"){
                    this.parentComponent.beforeModalClose();
                }
            },

            setError(label = null){
                label = label===null
                    ? Locale.getLabel('modular-forms::common.saved_error')
                    : label;
                this.errorLabel = Locale.getLabel(label);
            },

            resetError(){
                this.errorLabel = null;
            }


        }
    }

</script>
