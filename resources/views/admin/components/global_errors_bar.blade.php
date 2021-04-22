<?php
/** @var \App\Models\Components\Form $item */
/** @var string $url */

    $validationErrors = $item->validateFormRules();

?>
<div id="form_global_errors_bar" class="module-errors" v-show="has_errors">
    <div class="title">
        <div>
            <i class="fas fa-2x fa-exclamation-triangle"></i>
        </div>
        <div>
            {!! ucfirst(trans('common.form_global_errors')) !!}
        </div>
    </div>
    <ul class="errors">
        <li v-for="error in validation_errors">
            Module <a :href="'{{ $url }}/'+ error.step">@{{ error.title }}</a>
        </li>
    </ul>
</div>

@push('scripts')
<script>

    // ## Initialize Vue ##
    new window.Vue({

        store: window.formStore,

        el: '#form_global_errors_bar',

        data: function(){
            return {
                validation_errors: [],
                initial_errors: @json($validationErrors),
            }
        },

        computed: {
            has_errors() {
                return this.validation_errors.length > 1;
            }
        },

        watch: {
            validation_errors: function () {
                this.displayNonValidModules();
            },
        },

        beforeMount (){
            let _this = this;
            this.registerInitialErrors();
            this.validation_errors = this.$store.state.validator.validation_errors;
            window.vueBus.$on('refresh_validation', function (module_key) {
                _this.fixedError(module_key);
            });
        },

        methods: {

            /**
             * Register in formStore initial (page load) errors
             */
            registerInitialErrors: function(){
                let _this = this;
                this.initial_errors.forEach(function (item) {
                    _this.$store.commit('validator/registerInvalidModule', item);
                });
            },

            /**
             * Highlight module with errors
             */
            displayNonValidModules(){
                let error_class = 'validation-error';
                let invalid_modules = this.validation_errors.map(a => 'module_'+a.key);
                let containers = document.querySelectorAll('.module-container');
                containers.forEach(function (container) {
                    if(invalid_modules.includes(container.id)){
                        if(!container.classList.contains(error_class)){
                            container.classList.add(error_class);
                        }
                    } else {
                        if(container.classList.contains(error_class)){
                            container.classList.remove(error_class);
                        }
                    }
                });
            },

            /**
             * Set a module as fixed
             * @param module_key
             */
            fixedError(module_key){
                let invalid_modules = this.validation_errors.map(a => a.key);
                if(invalid_modules.includes(module_key)){
                    this.$store.commit('validator/registerFixedModule', module_key);
                }
            }

        }
    });
</script>
@endpush
