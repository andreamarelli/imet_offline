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

    @include('imet-core::components.heading', ['phase' => 'context'])

    {{--  Form Controller Menu --}}
    @include('modular-forms::page.steps', [
        'url' => route(\AndreaMarelli\ImetCore\Controllers\Imet\v1\Controller::ROUTE_PREFIX.'context_edit', ['item'=>$item->getKey()]),
        'current_step' => $step,
        'label_prefix' =>  'imet-core::v1_common.steps.',
        'steps' => array_keys($item::modules())
    ])

    {{--  Modules (by step) --}}
    @foreach($item::modules()[$step] as $module)
        @if(Role::hasRequiredAccessLevel($module))
            @include('modular-forms::module.edit.container', [
                'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\v1\ContextController::class,
                'module_class' => $module,
                'form_id' => $item->getKey()])
        @else
            @include('imet-core::components.module.not_allowed_container', ['module_class' => $module])
        @endif
    @endforeach

    {{--  Scroll buttons  --}}
    @include('modular-forms::buttons.scroll', ['item' => $item, 'step' => $step])

@endsection
