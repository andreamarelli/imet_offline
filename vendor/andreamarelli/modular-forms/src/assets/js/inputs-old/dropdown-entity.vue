<template>
    <div>

        <select v-bind:id="id">
            <option v-bind:value="selectedValue" selected="selected">{{ selectedLabel }}</option>
        </select>

        <!-- Modal -->
        <div class="modal fade" v-bind:id=modalId role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h2 class="modal-title text-primary">{{ modalTitle }}</h2>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times black" /></button>
                    </div>

                    <div class="modal-body">
                        <form v-if="modalIsOpen === true">
                            <slot></slot>
                        </form>
                    </div>

                    <!-- Error messages -->
                    <div class="module-bar error-bar" v-show="hasErrors === true">
                        <div class="message">
                            {{ errorMessage }}
                            <ul class="errors"></ul>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" v-on:click="saveEntity" class="btn-nav small" >{{ createButtonLabel }}</button>
                    </div>

                </div>
            </div>
        </div>

    </div>
</template>

<script>

    export default {

        mixins: [
            window.ModularForms.MixinsVue.dropdown,
        ],

        props: {
            modalTitle: {
                type: String,
                default: () => {
                    return Locale.getLabel('modular-forms::common.add_entity');
                }
            },
            createButtonLabel: {
                type: String,
                default: () => {
                    return Locale.getLabel('modular-forms::common.create');
                }
            },
            errorMessage: {
                type: String,
                default: () => {
                    return Locale.getLabel('modular-forms::common.saved_error');
                }
            },
            entityKey: {
                type: String,
                default: ''
            },
            labelAsId: {
                type: Boolean,
                default: false
            }
        },

        data (){
            return {
                Locale: window.Locale,
                vueInstanceReady: false,
                hasErrors : false,
                modalIsOpen: false,
                modalId: 'entity-modal_'+this.id,
                moduleKey: this.entityKey + '__create',
                storeUrl: window.Laravel.baseUrl + 'admin/' + this.entityKey + '/entity'
            }
        },

        beforeMount: function () {
            this.injectOpenModalButton();
        },

        mounted() {
            this.dropdown.parent().removeClass('field-edit');     // remove unnecessary class
            this.toggleModal()
        },

        methods: {

            /**
             * Inject the HTML button for adding a new entity
             */
            injectOpenModalButton: function () {

                let _this = this;

                this.defaultOptions.language = {
                    noResults: function () {
                        return '<div class="container-fluid">' +
                                    Locale.getLabel('modular-forms::common.no_record_found') +
                                    '<button type="button" class="btn-nav small" data-toggle="modal" data-target="#' + _this.modalId + '">' +
                                        Locale.getLabel('modular-forms::common.add') +
                                    '</button>' +
                                '</div>';
                    }
                };
                this.defaultOptions.escapeMarkup = function (markup) {
                    return markup;
                };
                this.options = this.defaultOptions;
            },

            /**
             * Enable/disable form in modal (prevent IDs conflicts)
             */
            toggleModal: function () {
                let _this = this;
                $('#'+_this.modalId)
                    .on('show.bs.modal', function () {
                        _this.dropdown.select2('close');     // close anchor select2 (conflict with z-index)
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

            afterModalOpen: function () {
                let _this = this;

                // enable daypicker
                let form = $(_this.$el).find('form')[0];
                $(form).find('input.form-daypicker').each(function(){
                    window.ModularForms.Mixins.Input.dayPicker($(this));
                });
            },

            beforeModalClose: function(){
                let _this = this;

                // destroy daypicker
                let form = $(_this.$el).find('form')[0];
                $(form).find('input.form-daypicker').each(function(){
                    $(this).datepicker('destroy');
                });
            },

            /**
             * Save new entity
             */
            saveEntity: function(){

                let _this = this;
                let form = $(_this.$el).find('form')[0];
                let entity = {};
                $(form).find('input, select').each(function(){
                    entity[$(this).attr('name')] = $(this).val()
                });

                $.ajax({
                    method: 'POST',
                    url: _this.storeUrl,
                    dataType: 'json',
                    data: {
                        '_token': window.Laravel.csrfToken,
                        'module_key': _this.moduleKey,
                        'records_json': window.ModularForms.Mixins.Payload.encode([entity])
                    },
                    cache: false
                })
                    .done(function(response) {
                        if(response.hasOwnProperty('status')) {
                            if(response['status'] === 'success'){
                                if(_this.labelAsId){
                                    _this.addItem(response['entity_label'],  response['entity_label']);
                                } else {
                                    _this.addItem(response['entity_id'],  response['entity_label']);
                                }
                                $('#'+_this.modalId).modal('hide');
                            } else if(response['status'] === 'validation_error'){
                                _this.setErrors(response['errors']);
                            } else {
                                _this.setErrors();
                            }
                        } else {
                            _this.setErrors();
                        }
                    })
                    .fail(function() {
                        _this.setErrors();
                    })
            },

            /**
             *  Show validation errors
             */
            setErrors: function(messages){
                this.hasErrors = false;
                messages = messages || {};
                if (messages !== {}) {
                    this.hasErrors = true;
                    let error_bar = $(this.$el).find('.error-bar')[0];
                    let errors = $(error_bar).find('.errors')[0];
                    $(errors).html('');
                    for (let f in messages) {
                        for (let m in messages[f]) {
                            $(errors).append("<li>" + messages[f][m] + "</li>");
                        }
                    }
                }
            }

        }

    }

</script>
