<?php

use AndreaMarelli\ImetCore\Controllers\Imet\ScalingUpAnalysisController;
use AndreaMarelli\ModularForms\Helpers\Input\Input;

?>

<div class="module-container">
    <div class="module-header">
        <div class="module-title">{{ Str::upper(trans('imet-core::analysis_report.custom_names')) }}</div>
    </div>
    <div class="module-body">

        <form class="form-horizontal" method="GET" action="{{ action([ScalingUpAnalysisController::class, 'report'], ['items' => $pa_ids]) }}">
            {{ csrf_field() }}

            <guidance :text="'imet-core::analysis_report.guidance.custom_names'"></guidance>

            <table class="max-w-5xl">
                @foreach($protected_areas['models'] as $key => $pa)
                    <tr>
                        <td>{!! Input::label('name', $pa->name, "exclude-element") !!}</td>
                        <td>{!! Input::text($pa->FormID, $custom_names[$pa->FormID] )!!}</td>
                        <td><color_picker :text_box_name="{{$pa->FormID}}" :default_color="'{{$custom_colors[$pa->FormID]}}'"></color_picker></td>
                    </tr>
                @endforeach
                {!! Input::hidden('save_form', 1) !!}
            </table>

            <div class="text-right">
                <button type="submit" class="btn-nav">{{ Str::ucfirst(trans('imet-core::analysis_report.apply')) }}</button>
            </div>

        </form>

    </div>

</div>