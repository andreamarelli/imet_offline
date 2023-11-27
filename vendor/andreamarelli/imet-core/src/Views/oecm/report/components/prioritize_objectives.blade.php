<?php
/** @var array $report */

$objectives = json_decode($report['objectives']);

?>
<div class="row ">
    <div class="col text-center mt-4 mb-2">
        <h4>4. @lang('imet-core::oecm_report.general_planning.short_term_prioritize')</h4>
    </div>
</div>

<div class="module-container">
    <div class="module-body">
        <div class="row">
            <div class="col"><h4>@lang('imet-core::oecm_report.general_planning.intervention_context')</h4></div>
        </div>
        @foreach($objectives as $key => $value)
            @if( stripos($value->id, "_context"))
                <div class="row mt-3">
                    <div class="col">{{$value->value}}</div>
                </div>
            @endif
        @endforeach
    </div>
</div>
<div class="module-container">
    <div class="module-body">
        <div class="row">
            <div class="col"><h4>@lang('imet-core::oecm_report.general_planning.management_evaluation')</h4></div>
        </div>
        @foreach($objectives as $key => $value)
            @if( stripos($value->id, "_evaluation"))
                <div class="row mt-3">
                    <div class="col">{{$value->value}}</div>
                </div>
            @endif
        @endforeach
    </div>
</div>

