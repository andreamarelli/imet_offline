<?php
/** @var \AndreaMarelli\ImetCore\Models\Imet\oecm\Imet $item */

use AndreaMarelli\ImetCore\Models\User\Role;
use Illuminate\Support\Facades\App;

// Force Language
if ($item->language != App::getLocale()) {
    App::setLocale($item->language);
}

?>

@extends('layouts.admin')

@include('imet-core::components.breadcrumbs_and_page_title')

@section('content')

    @include('imet-core::components.heading', ['phase' => 'evaluation'])

    {{--  Form Controller Menu --}}
    @include('modular-forms::page.steps', [
        'url' => route(\AndreaMarelli\ImetCore\Controllers\Imet\oecm\Controller::ROUTE_PREFIX . 'eval_show', ['item' => $item->getKey()]),
        'current_step' => $step,
        'label_prefix' =>  'imet-core::common.steps_eval.',
        'steps' => array_keys($item::modules())
    ])

    {{-- management effectiveness --}}
    @include('imet-core::oecm.evaluation.management_effectiveness.management_effectiveness', [
        'item_id' => $item->getKey(),
        'step' => $step
    ])

    {{--  Modules (by step) --}}
    <div class="imet_modules">
        @foreach($item::modules()[$step] as $module)
            @if(Role::hasRequiredAccessLevel($module))
                @include('modular-forms::module.show.container', [
                    'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\v2\EvalController::class,
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
