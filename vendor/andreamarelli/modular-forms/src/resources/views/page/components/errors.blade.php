<?php
/** @var \AndreaMarelli\ModularForms\Models\Form $item */
/** @var string $url */

    $formErrors = $item->validateFormRules();

?>
<div id="form_global_errors_bar">

     <div class="module-errors" v-if="has_errors">
        <div class="title">
            <div>
                <i class="fas fa-2x fa-exclamation-triangle"></i>
            </div>
            <div>
                {!! ucfirst(trans('modular-forms::common.form.global_errors')) !!}
            </div>
        </div>
        <ul class="errors">
            <li v-for="error in validation_errors">
                Module <a :href="'{{ $url }}/'+ error.step">@{{ error.title }}</a>
            </li>
        </ul>
    </div>

</div>

@push('scripts')
    <script type="module">

        window.Laravel.FormErrors = (new window.ModularForms.Apps.FormErrors(
            {initial_errors: @json($formErrors)}
        ))
            .mount('#form_global_errors_bar');

    </script>
@endpush
