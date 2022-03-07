<?php
$accordion_title = $accordion_title ?? trans('imet-core::analysis_report.custom_names');
$submit_button_label = $submit_button_label ?? @trans('imet-core::analysis_report.apply');
?>
<div id="form-grid">
    @component('modular-forms::page.filters-accordion', ['accordion_title' => trans('imet-core::analysis_report.custom_names'), 'submit_button_label' => $submit_button_label, 'url'=>route('report_scaling_up', ['items' => $pa_ids]), 'request'=>$request, 'method'=>'POST', 'expanded'=>false])
        @slot('filter_content')
            <div class="module-bar info-black-bar mt-2 mb-2 exclude-element" style="grid-column: span 2;">
                <div class="icon blue">
                    <span class="fas fa-fw fa-file-alt  " style="font-size: 1.4em;"></span>
                </div>
                <div class="message">
                    {{trans('imet-core::analysis_report.guidance.custom_names')}}
                </div>
            </div>
            @foreach($protected_areas as $key => $pa)
                {!! \AndreaMarelli\ModularForms\Helpers\Input\Input::label('name', $pa->name, "exclude-element") !!}
                {!! \AndreaMarelli\ModularForms\Helpers\Input\Input::text($pa->FormID, $custom_names[$pa->FormID] )!!}
            @endforeach
            {!! \AndreaMarelli\ModularForms\Helpers\Input\Input::hidden('save_form', 1) !!}

        @endslot
    @endcomponent
</div>
