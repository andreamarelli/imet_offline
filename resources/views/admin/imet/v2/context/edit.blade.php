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

@section('admin_page_title')
    @lang('form/imet/common.imet')
@endsection

@section('content')

    <h2>{{ ucfirst(trans('form/imet/common.context_long')) }}</h2>
    <div class="entity-heading">
        <div class="id">#{{ $item->getKey() }}</div>
        <div class="name">{{ $item->Name }}</div>
        <div class="location">{!! \App\Library\Ofac\Template::flag_and_name($item->Country) !!}</div>
    </div>

    {{--  Form Controller Menu --}}
    @include('admin.components.steps', [
        'url' => action([\App\Http\Controllers\Imet\ImetControllerV2::class, 'edit'], ['item'=>$item->getKey()]),
        'current_step' => $step,
        'label_prefix' =>  'form/imet/v2/common.steps.',
        'steps' => array_keys($item::modules())
    ])

    {{--  Modules (by step) --}}
    <div class="imet_modules">
        @foreach($item::modules()[$step] as $module)
            @include('admin.components.module.edit.container', [
                'controller' => \App\Http\Controllers\Imet\ImetControllerV2::class,
                'module_class' => $module,
                'form_id' => $item->getKey()])
        @endforeach
    </div>

    {{--  Scroll buttons  --}}
    @include('admin.components.buttons.scroll', ['item' => $item, 'step' => $step])

@endsection