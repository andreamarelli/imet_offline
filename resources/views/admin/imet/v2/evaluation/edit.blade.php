<?php
/** @var \App\Models\Imet\v2\Imet $item */

// Force Language
if($item->language != App::getLocale()){
    App::setLocale($item->language);
}

?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('admin.components.breadcrumbs', ['links' => [
        action([\App\Http\Controllers\Imet\ImetController::class, 'index']) => trans('form/imet/common.imet_short')
    ]])
@endsection

@if(!is_imet_environment())
    @section('admin_page_title')
        @lang('form/imet/common.imet')
    @endsection
@endif

@section('content')

    @include('admin.imet.components.heading', ['phase' => 'evaluation'])

    {{--  Form Controller Menu --}}
    @include('admin.components.steps', [
        'url' => action([\App\Http\Controllers\Imet\ImetEvalControllerV2::class, 'edit'], ['item'=>$item->getKey()]),
        'current_step' => $step,
        'label_prefix' =>  'form/imet/v2/common.steps_eval.',
        'steps' => array_keys($item::modules())
    ])

    {{-- management effectiveness --}}
    @include('admin.imet.v2.evaluation.management_effectiveness.management_effectiveness', [
        'item_id' => $item->getKey(),
        'step' => $step
    ])

    {{--  Modules (by step) --}}
    <div class="imet_modules">
        @foreach($item::modules()[$step] as $module)
            @include('admin.components.module.edit.container', [
                'controller' => \App\Http\Controllers\Imet\ImetEvalControllerV2::class,
                'module_class' => $module,
                'form_id' => $item->getKey()])
        @endforeach
    </div>

    {{--  Scroll buttons  --}}
    @include('admin.components.buttons.scroll', ['item' => $item, 'step' => $step])

@endsection
