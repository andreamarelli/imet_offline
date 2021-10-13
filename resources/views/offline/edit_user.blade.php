<?php
$item = \AndreaMarelli\ImetCore\Models\Person::find(0);

?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['show' => false, 'links' => [
        action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'index']) => trans('imet-core::common.imet_short')
    ]])
@endsection

@section('admin_page_title')
    @lang('entities.staff.user_info')
@endsection

@section('content')

    @include('modular-forms::module.edit.container', [
        'controller' => \App\Http\Controllers\StaffController::class,
        'module_class' => \AndreaMarelli\ImetCore\Models\UserGeneralInfo::class,
        'form_id' => $item->getKey()
    ])

@endsection


