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


    <div class="module-container" id="import_imet">

        <div class="module-header">
            <div class="module-title">
                @lang('form/imet/common.import_imet')
            </div>
        </div>

        <div class="module-body">

            <br />

            Select a JSON file:
            <br />
            <upload v-model="json_file" id="import_json" :allowed-formats="['json']" ></upload>

            <br />
            <br />

        </div>

        <div class="module-bar save-bar" v-if="json_file.original_filename !== null">
            <div class="buttons">
                <button v-if="status === 'idle'" type="button" v-on:click="importImet" class="btn btn-success btn-sm">{!! ucfirst(trans('common.import')) !!}</button>
                <i v-if="status === 'loading'" class="fa fa-spinner fa-spin fa-2x green_dark"></i>
            </div>
        </div>

        <div class="module-bar error-bar" v-if="status === 'error'">
            <div class="message">
                {!! ucfirst(trans('common.saved_error')) !!}
                <div v-if="error_message !== null">
                    @{{ error_message }}
                </div>
            </div>
        </div>

    </div>




    <script>
        new Vue({
            el: '#import_imet',

            data: {
                json_file: {
                    'original_filename': null,
                    'temp_filename': null,
                    'download_link': null,
                    'changed': false
                },
                status: 'idle',
                error_message: null
            },

            methods:{

                importImet(){
                    let _this = this;

                    _this.status = 'loading';
                    _this.error_message = null;

                    window.axios({
                        method: 'post',
                        url: '{{ action([\App\Http\Controllers\Imet\ImetController::class, 'import']) }}',
                        data: {
                            _token: window.Laravel.csrfToken,
                            json_file: _this.json_file
                        }
                    })
                        .then(function (response) {
                            if(response.data['status'] === 'success'){
                                window.location.href = '{{ action([\App\Http\Controllers\Imet\ImetController::class, 'index']) }}';
                            } else {
                                _this.status = 'error';
                                _this.error_message = response.hasOwnProperty('error_message') ? response['error_message'] : null;
                            }
                        })
                        .catch(function (response) {
                            _this.status = 'error';
                        })
                        .finally(function (response) {});
                }
            }
        })

    </script>

@endsection
