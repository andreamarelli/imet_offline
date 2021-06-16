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
        <div class="module-header"><div class="module-title">@lang('form/imet/v2/report.general_elements')</div></div>
        <div class="module-body">

            @foreach($fields as $field)
                @component('admin.components.module.components.row', [
                    'name' => $field,
                    'label' => trans('form/imet/v2/context.CreateNonWdpa.fields.'.$field)
                ])
                    <div class="field-preview">
                        @if($field === 'pa_def')
                            @lang('form/imet/v2/lists.NonWdpaPaDef.'.$non_wdpa[$field])
                        @elseif($field === 'marine')
                            @lang('form/imet/v2/lists.NonWdpaTypology.'.$non_wdpa[$field])
                        @else
                            {{ $non_wdpa[$field] ?? '-' }}
                        @endif
                    </div>
                @endcomponent
            @endforeach


        </div>
    </div>
@endif
