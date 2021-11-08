<?php
/** @var \AndreaMarelli\ModularForms\Controllers\FormController $controller */
/** @var Mixed $definitions */
/** @var Mixed $validation */


?>

<div id="validation_{{ $definitions['module_key'] }}">

    <div class="module-bar" :class=bar_class>

        <div class="message">
            <span v-if="validation!=null && validation.id!=null">
                @lang_u('modular-forms::common.form.validated_by'):&nbsp;
                <b data-toggle="tooltip" data-placement="top" :title="'#'+validation.id">@{{ validation.name }}</b>&nbsp;
                <i>@{{ validation.date }}</i>
            </span>
        </div>

        <div class="buttons" style="display: flex; align-items: center" v-if="loading===false">
            <span style="margin-right: 10px;">@lang_u('modular-forms::common.form.validation'): </span>
            <div class="switch_checkbox lg" >
                <input type="checkbox" id="{{ $definitions['module_key'] }}_is_validated"
                       :checked=is_validated
                       @click="validate"
                />
                <label for="{{ $definitions['module_key'] }}_is_validated"></label>
            </div>
        </div>
        <div class="buttons" style="display: flex; align-items: center" v-else>
            <span style="margin-right: 10px;">@lang_u('modular-forms::common.saving')</span>
            <span><i class="fa fa-spinner fa-spin fa-2x gray-600"></i></span>
        </div>

    </div>

</div>

    <script>
        new Vue({
            el: '#validation_{{ $definitions['module_key'] }}',
            computed:{
              bar_class(){
                  return this.is_validated ? 'saved-bar' : 'error-bar';
              }
            },
            data: function(){
                return {
                    validation: @json($validation ?? null),
                    is_validated: null,
                    loading: false
                };
            },
            created(){
                this.is_validated = this.validation.id!==null;
            },
            methods:{
                validate(){
                    let _this = this;
                    this.loading = true;
                    this.validation.date = null;
                    this.validation.id = null;
                    this.validation.name = null;

                    window.axios({
                        method: 'post',
                        url: '{{ action([$controller, 'validate_module'], ['item' => $item->getKey()]) }}',
                        data: {
                            _token: window.Laravel.csrfToken,
                            module_key: '{{ $definitions['module_key'] }}',
                            validate: !_this.is_validated
                        },
                    })
                        .then(function (response) {
                            _this.is_validated = response.data.validated;
                            _this.validation.date = response.data.date;
                            _this.validation.id = response.data.id;
                            _this.validation.name = response.data.name;
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                        .finally(function () {
                            _this.loading = false;
                        });
                }
            }
        });
    </script>
