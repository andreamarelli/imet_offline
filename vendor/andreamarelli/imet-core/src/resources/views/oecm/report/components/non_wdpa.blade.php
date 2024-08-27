<?php
/** @var bool $show_non_wdpa */
/** @var Array $non_wdpa */

$fields = [
    'pa_def',
    'country',
    'name',
    'origin_name',
    'designation',
    'designation_eng',
    'designation_type',
    'marine',
    'rep_m_area',
    'rep_area',
    'status',
    'status_year',
]

?>

@if($show_non_wdpa)
    <div class="module-container">
        <div class="module-header"><div class="module-title" id="ar1">AR.1 @lang('imet-core::v2_report.general_elements')</div></div>
        <div class="module-body">

            @foreach($fields as $field)
                @component('modular-forms::module.components.field_container', [
                    'name' => $field,
                    'label' => trans('imet-core::common.CreateNonWdpa.fields.'.$field)
                ])
                    <div class="field-preview">
                        @if($field === 'pa_def')
                            @lang('imet-core::v2_lists.NonWdpaPaDef.'.$non_wdpa[$field])
                        @elseif($field === 'marine')
                            @lang('imet-core::v2_lists.NonWdpaTypology.'.$non_wdpa[$field])
                        @else
                            {{ $non_wdpa[$field] ?? '-' }}
                        @endif
                    </div>
                @endcomponent
            @endforeach


        </div>
    </div>
@endif
