<?php
/** @var \AndreaMarelli\ImetCore\Models\Imet\v2\Imet $item */

// Force Language
if ($item->language != \Illuminate\Support\Facades\App::getLocale()) {
    \Illuminate\Support\Facades\App::setLocale($item->language);
}

?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['show' => false, 'links' => [
        action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'index']) => trans('imet-core::common.imet_short')
    ]])
@endsection

@section('admin_page_title')
    @lang('imet-core::common.imet')
@endsection

@section('content')

    @include('imet-core::components.heading', ['phase' => 'evaluation'])

    {{--  Form Controller Menu --}}
    @include('modular-forms::page.steps', [
        'url' => action([\AndreaMarelli\ImetCore\Controllers\Imet\EvalControllerV2::class, 'show'], ['item' => $item->getKey()]),
        'current_step' => $step,
        'label_prefix' =>  'imet-core::v2_common.steps_eval.',
        'classes' => $classes,
        'steps' => $steps
    ])


    @if($step=='cross_analysis')
        @include('imet-core::v2.cross_analysis.index', [
            'item_id' => $item->getKey(),
            'warnings' => $warnings
        ])
    @else
        {{-- management effectiveness --}}
        @include('imet-core::v2.evaluation.management_effectiveness.management_effectiveness', [
            'item_id' => $item->getKey(),
            'step' => $step
        ])

        {{--  Modules (by step) --}}
        <div class="imet_modules">
            @foreach($item::modules()[$step] as $module)
                @include('modular-forms::module.show.container', [
                    'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\ControllerV2::class,
                    'module_class' => $module,
                    'form_id' => $item->getKey()])
            @endforeach
        </div>
    @endif
@endsection
