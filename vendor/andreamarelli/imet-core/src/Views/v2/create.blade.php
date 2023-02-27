<?php
/** @var bool $is_wdpa */

$is_wdpa = $is_wdpa ?? true;
?>

@extends('layouts.admin')

@include('imet-core::components.breadcrumbs_and_page_title')

@section('content')

    @if($is_wdpa)
        @include('modular-forms::module.edit.container', [
            'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\v2\ContextController::class,
            'module_class' => \AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\Create::class,
            'form_id' => null])
    @else
        @include('modular-forms::module.edit.container', [
           'controller' => \AndreaMarelli\ImetCore\Controllers\Imet\v2\ContextController::class,
           'module_class' => \AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\CreateNonWdpa::class,
           'form_id' => null])
    @endif

@endsection
