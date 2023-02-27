<?php
/** @var \AndreaMarelli\ImetCore\Models\Imet\v1\Imet $item */

use AndreaMarelli\ImetCore\Models\User\Role;

// Force Language
if($item->language != \Illuminate\Support\Facades\App::getLocale()){
    \Illuminate\Support\Facades\App::setLocale($item->language);
}

?>

@extends('layouts.admin')

@include('imet-core::components.breadcrumbs_and_page_title')

@section('content')

    @include('imet-core::components.heading', ['phase' => 'evaluation'])

    {{--  Form Controller Menu --}}
    @include('modular-forms::page.steps', [
        'url' => route(\AndreaMarelli\ImetCore\Controllers\Imet\v1\Controller::ROUTE_PREFIX.'eval_show', ['item'=>$item->getKey()]),
        'current_step' => $step,
        'label_prefix' =>  'imet-core::common.steps_eval.',
        'classes' => $classes ?? '',
        'steps' => array_keys($item::modules())
    ])

    {{-- management effectiveness --}}
    @include('imet-core::v1.evaluation.management_effectiveness.management_effectiveness', [
        'item_id' => $item->getKey(),
        'step' => $step
    ])

    {{--  Modules (by step) --}}
    <div class="imet_modules">
        @foreach($item::modules()[$step] as $module)
            @if(Role::hasRequiredAccessLevel($module))
                @include('modular-forms::module.show.container', [
               'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\v1\EvalController::class,
               'module_class' => $module,
               'form_id' => $item->getKey()])
            @else
                @include('imet-core::components.module.not_allowed_container', ['module_class' => $module])
            @endif
        @endforeach
    </div>
@endsection
