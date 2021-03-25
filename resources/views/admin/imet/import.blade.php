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
    <div class="module-container" id="import_imet">
        <div class="module-header">
            <div class="module-title">
                @lang('form/imet/common.import_imet')
            </div>
        </div>
        <div class="module-body">
            <br/>
            <br/>
            <multiple-files-upload id="import_json"></multiple-files-upload>
        </div>
    </div>
    <script>
        new Vue({
            el: '#import_imet',
        })
    </script>
@endsection
