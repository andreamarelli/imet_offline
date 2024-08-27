<?php

use AndreaMarelli\ImetCore\Controllers\Imet;
use AndreaMarelli\ImetCore\Models;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Enums\ModuleViewModes;
use \Illuminate\Support\Str;

/** @var Imet\v2\ContextController|Imet\v1\ContextController|Imet\oecm\ContextController|Imet\v1\EvalController|Imet\v2\EvalController|Imet\oecm\EvalController $controller */
/** @var Models\Imet\v2\Imet|Models\Imet\v1\Imet|Models\Imet\oecm\Imet|Models\Imet\v2\Imet_Eval|Models\Imet\v1\Imet_Eval|Models\Imet\oecm\Imet_Eval $item */
/** @var string $mode */


if (Str::contains($controller, Models\Imet\Imet::IMET_V1)) {
    $version = Models\Imet\Imet::IMET_V1;
    $context_modules = Models\Imet\v1\Imet::modules();
    $evaluation_modules = Models\Imet\v1\Imet_Eval::modules();
} else if (Str::contains($controller, Models\Imet\Imet::IMET_V2)) {
    $version = Models\Imet\Imet::IMET_V2;
    $context_modules = Models\Imet\v2\Imet::modules();
    $evaluation_modules = Models\Imet\v2\Imet_Eval::modules();
} else if (Str::contains($controller, Models\Imet\Imet::IMET_OECM)) {
    $version = Models\Imet\Imet::IMET_OECM;
    $context_modules = Models\Imet\oecm\Imet::modules();
    $evaluation_modules = Models\Imet\oecm\Imet_Eval::modules();
}

?>

@extends('modular-forms::layouts.print')

@section('content')

    <h2>
        @lang('imet-core::common.imet_short'): @lang('imet-core::common.imet')
    </h2>

    {{--  Heading --}}
    @include('imet-core::components.heading', ['item' => $item])

    {{-- Management effectiveness scores --}}
    @include('imet-core::components.score-container', [
        'item' => $item,
        'step' => 'management_effectiveness'
    ])

    {{--  Modules (by step): CONTEXT --}}
    <h1>@uclang('imet-core::common.context_long')</h1>
    @foreach($context_modules as $step => $modules_by_step)
        @foreach($modules_by_step as $module)
            @if(Role::hasRequiredAccessLevel($module))
                <x-modular-forms::module.container
                        :controller="$controller"
                        :module="$module"
                        :formId="$item->getKey()"
                        :mode="ModuleViewModes::SHOW"
                ></x-modular-forms::module.container>
            @else
                @include('imet-core::components.module.not_allowed_container', ['module_class' => $module])
            @endif
        @endforeach
    @endforeach

    {{--  Modules (by step): EVALUATION --}}
    <h1>@uclang('imet-core::common.context_long')</h1>
    @foreach($evaluation_modules as $step => $modules_by_step)
        @foreach($modules_by_step as $module)
            @if(Role::hasRequiredAccessLevel($module))
                <x-modular-forms::module.container
                        :controller="$controller"
                        :module="$module"
                        :formId="$item->getKey()"
                        :mode="ModuleViewModes::SHOW"
                ></x-modular-forms::module.container>
            @else
                @include('imet-core::components.module.not_allowed_container', ['module_class' => $module])
            @endif
        @endforeach
    @endforeach

    <style>
        .print_body {
            margin: 20px;
        }

        .entity-heading {
            margin-top: 20px;
        }

    </style>

    <script>
        window.onload = function () {
            setTimeout(function () {
                window.print();
            }, 2000);
        }
    </script>

@endsection