@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['show' => false, 'links' => [
        route('imet-core::index') => trans('imet-core::common.imet_short')
    ]])
@endsection


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
                upload-url="{{ route('imet-core::upload_json') }}"
                back-url="{{ route('imet-core::index') }}"
            ></multiple-files-upload>
        </div>
    </div>
    <script>
        new Vue({
            el: '#import_imet',
        })
    </script>
@endsection
