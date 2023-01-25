<?php
/** @var \AndreaMarelli\ImetCore\Models\Imet\v1\Imet $item */

// Force Language
if ($item->language != \Illuminate\Support\Facades\App::getLocale()) {
    \Illuminate\Support\Facades\App::setLocale($item->language);
}

?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['show' => false, 'links' => [
        route('imet-core::index') => trans('imet-core::common.imet_short')
    ]])
@endsection

@section('admin_page_title')
    @lang('imet-core::common.imet')
@endsection

@section('content')

    @include('imet-core::components.heading', ['phase' => 'evaluation'])

    {{--  Form Controller Menu --}}
    @include('modular-forms::page.steps', [
        'url' => route('imet-core::v1_eval_show', ['item'=>$item->getKey()]),
        'current_step' => $step,
        'label_prefix' =>  'imet-core::v1_common.steps_eval.',
        'classes' => $classes ?? '',
        'steps' => $steps
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
               'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\v1\Controller::class,
               'module_class' => $module,
               'form_id' => $item->getKey()])
            @else
                @include('imet-core::components.module.not_allowed_container', ['module_class' => $module])
            @endif
        @endforeach
    </div>
@endsection
