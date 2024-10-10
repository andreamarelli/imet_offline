<?php

use AndreaMarelli\ImetCore\Controllers\Imet\ScalingUpAnalysisController;
use AndreaMarelli\ModularForms\Helpers\Input\Input;

?>
<x-modular-forms::accordion.container class="form-filters">
    <x-modular-forms::accordion.item title="{{ Str::upper(trans('imet-core::analysis_report.custom_names')) }}">
        <div class="module-container">
            <div class="module-body">
                <form class="form-horizontal" method="POST"
                    action="{{ action([ScalingUpAnalysisController::class, 'report'], ['items' => $pa_ids]) }}">
                    {{ csrf_field() }}
                    <guidance :text="'imet-core::analysis_report.guidance.custom_names'"></guidance>
                    <div class="max-w-7xl mx-auto mt-4">
                        @foreach ($protected_areas['models'] as $key => $pa)
                            <div class="flex items-center space-x-4 mb-2">
                                <div class="text-right flex-1">{!! Input::label('name', $pa->name, 'exclude-element') !!}</div>
                                <div class="text-left flex-1">{!! Input::text($pa->FormID, $custom_names[$pa->FormID]) !!}</div>
                                <div class="text-left flex-1">
                                    <color_picker :text_box_name="{{ $pa->FormID }}"
                                        :default_color="'{{ $custom_colors[$pa->FormID] }}'"></color_picker>
                                </div>
                            </div>
                        @endforeach
                        {!! Input::hidden('save_form', 1) !!}
                    </div>
                    <div class="text-right">
                        <button type="submit"
                            class="btn-nav">{{ Str::ucfirst(trans('imet-core::analysis_report.apply')) }}</button>
                    </div>
                </form>
            </div>
        </div>
    </x-modular-forms::accordion.item>
</x-modular-forms::accordion.container>
