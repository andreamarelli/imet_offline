<?php

use \AndreaMarelli\ImetCore\Controllers;

/** @var Controllers\Imet\Controller|Controllers\Imet\oecm\Controller $controller */

if($controller === Controllers\Imet\oecm\Controller::class){
    $route_prefix = Controllers\Imet\oecm\Controller::ROUTE_PREFIX;
} else {
    $route_prefix = Controllers\Imet\v2\Controller::ROUTE_PREFIX;
}

?>

@extends('layouts.admin')

@include('imet-core::components.breadcrumbs_and_page_title')

@section('content')
    <div class="module-container" id="import_imet">
        <div class="module-header">
            <div class="module-title">
                @lang('imet-core::common.import_imet')
            </div>
        </div>
        <div class="module-body">
            <br/>
            <multiple-files-upload
                upload-url="{{ route($route_prefix.'upload_json') }}"
                back-url="{{ route($route_prefix.'index') }}"
            ></multiple-files-upload>
        </div>
    </div>
    <script>
        new Vue({
            el: '#import_imet',
        })
    </script>
@endsection
