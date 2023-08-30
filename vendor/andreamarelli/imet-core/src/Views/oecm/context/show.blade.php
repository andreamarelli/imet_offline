<?php

use AndreaMarelli\ImetCore\Controllers\Imet\oecm\Controller;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\_AnalysisStakeholders;
use AndreaMarelli\ImetCore\Models\User\Role;
use Illuminate\Support\Facades\App;

/** @var Imet $item */

// Force Language
if($item->language != App::getLocale()){
    App::setLocale($item->language);
}

?>

@extends('layouts.admin')

@include('imet-core::components.breadcrumbs_and_page_title')

@section('content')

    @include('imet-core::components.heading', ['item' => $item])
    @include('imet-core::components.phase', ['phase' => 'context'])

    {{--  Form Controller Menu --}}
    @include('modular-forms::page.steps', [
        'url' => route(Controller::ROUTE_PREFIX . 'context_show', ['item' => $item->getKey()]),
        'current_step' => $step,
        'label_prefix' =>  'imet-core::oecm_common.steps.',
        'steps' => array_keys($item::modules())
    ])

    {{--  Modules (by step) --}}
    <div class="imet_modules">

        @if($step === 'stakeholder_analysis' && Role::hasRequiredAccessLevel(_AnalysisStakeholders::class))
            @include('imet-core::oecm.context.modules_show.analysis_stakeholder_summary', [
                'form_id' => $item->getKey()
            ])
        @endif

        @foreach($item::modules()[$step] as $module)
            @if(Role::hasRequiredAccessLevel($module))
                @include('modular-forms::module.show.container', [
                    'module_class' => $module,
                    'form_id' => $item->getKey()])
            @else
                @include('imet-core::components.module.not_allowed_container', ['module_class' => $module])
            @endif
        @endforeach
    </div>

    {{--  Scroll buttons  --}}
    @include('modular-forms::buttons.scroll', ['item' => $item, 'step' => $step])

@endsection
