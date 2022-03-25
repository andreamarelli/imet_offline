<?php
$accordion_title = $accordion_title ?? trans('imet-core::analysis_report.custom_names');
$submit_button_label = $submit_button_label ?? @trans('imet-core::analysis_report.apply');
?>
<div id="form-grid">
    @component('modular-forms::page.filters-accordion', ['accordion_title' => trans('imet-core::analysis_report.custom_names'), 'submit_button_label' => $submit_button_label, 'url'=>route('report_scaling_up', ['items' => $pa_ids]), 'request'=>$request, 'method'=>'POST', 'expanded'=>false])
        @slot('filter_content')
            <div style="grid-column: span 2;">
                <guidance :text="'imet-core::analysis_report.guidance.custom_names'"/>
            </div>
            @foreach($protected_areas['models'] as $key => $pa)
                {!! \AndreaMarelli\ModularForms\Helpers\Input\Input::label('name', $pa->name, "exclude-element") !!}
                {!! \AndreaMarelli\ModularForms\Helpers\Input\Input::text($pa->FormID, $custom_names[$pa->FormID] )!!}
            @endforeach
            {!! \AndreaMarelli\ModularForms\Helpers\Input\Input::hidden('save_form', 1) !!}

        @endslot
    @endcomponent
</div>
