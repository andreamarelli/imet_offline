@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('admin.components.breadcrumbs', ['links' => [
         action([\App\Http\Controllers\Imet\ImetController::class, 'index']) => trans('form/imet/common.imet_short')
    ]])
@endsection

@if(!App::environment('imetoffline'))
    @section('admin_page_title')
        @lang('form/imet/common.imet')
    @endsection
@endif

@section('content')

    <div class="entity-heading">
        <div class="name">{{ ucfirst(trans('form/imet/common.create')) }}</div>
    </div>

    @include('admin.components.module.edit.container', [
        'controller' => \App\Http\Controllers\Imet\ImetControllerV1::class,
        'module_class' => \App\Models\Imet\v1\Modules\Context\Create::class,
        'form_id' => null]
    )


@endsection