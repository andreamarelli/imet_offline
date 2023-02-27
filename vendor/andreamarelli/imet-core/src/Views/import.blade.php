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
                upload-url="{{ route(\AndreaMarelli\ImetCore\Controllers\Imet\Controller::ROUTE_PREFIX.'upload_json') }}"
                back-url="{{ route(\AndreaMarelli\ImetCore\Controllers\Imet\Controller::ROUTE_PREFIX.'index') }}"
            ></multiple-files-upload>
        </div>
    </div>
    <script>
        new Vue({
            el: '#import_imet',
        })
    </script>
@endsection
