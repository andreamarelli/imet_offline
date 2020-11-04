<?php
$item = \App\Models\Person\Person::find(0);

?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('admin.components.breadcrumbs', ['links' => [
        action([\App\Http\Controllers\Imet\ImetController::class, 'index']) => trans('form/imet/common.imet_short')
    ]])
@endsection

@section('admin_page_title')
    @lang('entities.staff.user_info')
@endsection

@section('content')

    @include('admin.components.module.edit.container', [
        'controller' => \App\Http\Controllers\StaffController::class,
        'module_class' => \App\Models\Person\Modules\GeneralInfo::class,
        'form_id' => $item->getKey()
    ])

@endsection


