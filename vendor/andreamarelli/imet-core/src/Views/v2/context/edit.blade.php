<?php
/** @var \AndreaMarelli\ImetCore\Models\Imet\v2\Imet $item */

// Force Language
if($item->language != \Illuminate\Support\Facades\App::getLocale()){
    \Illuminate\Support\Facades\App::setLocale($item->language);
}

?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['show' => false, 'links' => [
        action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'index']) => trans('imet-core::common.imet_short')
    ]])
@endsection


@section('content')

    @include('imet-core::components.heading', ['phase' => 'context'])

    {{--  Form Controller Menu --}}
    @include('modular-forms::page.steps', [
        'url' => action([\AndreaMarelli\ImetCore\Controllers\Imet\ControllerV2::class, 'edit'], ['item'=>$item->getKey()]),
        'current_step' => $step,
        'label_prefix' =>  'imet-core::v2_common.steps.',
        'steps' => array_keys($item::modules())
    ])

    {{--  Modules (by step) --}}
    <div class="imet_modules">
        @foreach($item::modules()[$step] as $module)
            @include('modular-forms::module.edit.container', [
                'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\ControllerV2::class,
                'module_class' => $module,
                'form_id' => $item->getKey()])
        @endforeach
    </div>

    {{--  Scroll buttons  --}}
    @include('modular-forms::buttons.scroll', ['item' => $item, 'step' => $step])

@endsection
