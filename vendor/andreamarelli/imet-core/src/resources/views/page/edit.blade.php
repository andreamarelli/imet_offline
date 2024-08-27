<?php

use \AndreaMarelli\ImetCore\Controllers\Imet;
use \AndreaMarelli\ImetCore\Models;
use \AndreaMarelli\ImetCore\Models\User\Role;
use \AndreaMarelli\ModularForms\Enums\ModuleViewModes;
use \Illuminate\Support\Str;

/** @var Imet\v2\ContextController|Imet\v1\ContextController|Imet\oecm\ContextController|Imet\v1\EvalController|Imet\v2\EvalController|Imet\oecm\EvalController $controller */
/** @var Models\Imet\v2\Imet|Models\Imet\v1\Imet|Models\Imet\oecm\Imet|Models\Imet\v2\Imet_Eval|Models\Imet\v1\Imet_Eval|Models\Imet\oecm\Imet_Eval $item */
/** @var string $step */

if (Str::contains($controller, Models\Imet\Imet::IMET_V1)) {
    $version = Models\Imet\Imet::IMET_V1;
    $step_labels = 'v1_common.steps';
} else if (Str::contains($controller, Models\Imet\Imet::IMET_V2)) {
    $version = Models\Imet\Imet::IMET_V2;
    $step_labels = 'v2_common.steps';
} else if (Str::contains($controller, Models\Imet\Imet::IMET_OECM)) {
    $version = Models\Imet\Imet::IMET_OECM;
    $step_labels = 'oecm_common.steps';
}

if (Str::contains($controller, 'ContextController')) {
    $phase = 'context';
} else if (Str::contains($controller, 'EvalController')) {
    $phase = 'evaluation';
    $step_labels = 'common.steps_eval';
}

$steps = $phase=='evaluation' && Str::contains($controller, Models\Imet\Imet::IMET_V2)
    ? Imet\v2\EvalController::steps($item)
    : array_keys($item::modules());

$show_scrollbar = true;

?>

@extends('modular-forms::layouts.forms')

@section('content')

    {{--  Heading --}}
    @include('imet-core::components.heading', ['item' => $item])

    {{--  Phase  --}}
    @include('imet-core::components.phase', ['phase' => $phase])

    {{--  Steps menu --}}
    @include('modular-forms::page.components.steps', [
        'url' => action([$controller, 'edit'], ['item' => $item->getKey()]),
        'current_step' => $step,
        'label_prefix' =>  'imet-core::' . $step_labels . '.',
        'steps' => $steps
    ])

    {{-- Global errors --}}
    @include('modular-forms::page.components.errors', [
        'url' => action([$controller, 'edit'], ['item' => $item->getKey()]),
        'item' => $item
    ])

    {{-- Cross Analysis --}}
    @if($step==='cross_analysis' and $version==Models\Imet\Imet::IMET_V2)
        @include('imet-core::'.$version.'.cross_analysis.index', [
            'item_id' => $item->getKey(),
            'warnings' => $warnings
        ])

    @else

        {{-- Management effectiveness scores --}}
        @if($phase==='evaluation')
            @include('imet-core::components.score-container', [
                'item' => $item,
                'step' => $step
            ])
        @endif

        {{--  Modules (by step) --}}
        <div class="imet_modules">

            @if($version===Models\Imet\Imet::IMET_OECM and
                    $step==='stakeholder_analysis' and
                    Role::hasRequiredAccessLevel(Models\Imet\oecm\Modules\Context\_AnalysisStakeholders::class))
                @include('imet-core::oecm.context.edit.modules.analysis_stakeholder_summary', [
                    'form_id' => $item->getKey()
                ])
            @endif

            @foreach($item::modules()[$step] as $module)
                @if(Role::hasRequiredAccessLevel($module))
                    <x-modular-forms::module.container
                            :controller="$controller"
                            :module="$module"
                            :formId="$item->getKey()"
                            :mode="ModuleViewModes::EDIT"
                    ></x-modular-forms::module.container>
                @else
                    @include('imet-core::components.module.not_allowed_container', ['module_class' => $module])
                @endif
            @endforeach
        </div>

    @endif

    {{--  Scroll buttons  --}}
    @if($show_scrollbar)
        @include('modular-forms::module.scroll', ['item' => $item, 'step' => $step])
    @endif

@endsection
