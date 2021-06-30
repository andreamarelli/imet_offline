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
    <script>


    </script>
    <div id="imet_report">

        <app :scaling_up_id="{{$scaling_up_id}}">

            <template>
                <div class="container">
                    <div class="row h-150 mb-5">
                        <div class="col-sm text-center">
                            <strong>Scaling up analysis report for ({{$protected_areas}})</strong>
                        </div>
                    </div>
                </div>
                @include('admin.imet.scaling_up.components.scaling_up_template')
                @foreach($templates as $key => $template)
                    @include('admin.imet.scaling_up.components.'.$template['name'],
                                [   'name' => $template['name'],
                                   'title' => $template['title'],
                                   'snapshot_id' => $template['snapshot_id'],
                                   'exclude_elements' => $template['exclude_elements'],
                                ])
                @endforeach
            </template>
        </app>
    </div>

    <script>
        new Vue({
            el: '#imet_report',
            data: {
                url: '{{ action([\App\Http\Controllers\Imet\ImetControllerV2::class, 'get_ajax_responses']) }}'
            }
        });

    </script>

    <style>
        @media screen {
            .contailer {
                position: relative;
            }

             .contailer .smallMenu {
                position: -webkit-sticky;
                display: inline-block;
                margin-bottom: 0;
                position: sticky;
                top: 0px;
                bottom: 0px;
                left: 0px;
                z-index: 999999;

            }

            .contailer .smallMenu .standalone {
                text-align: center;
                background-color: #004A19;
                color: #fff;
                cursor: pointer;
                padding: 3px 8px;
                font-size: 0.9rem;
                border-radius: 0;
                z-index: 999999;
            }

            .contailer .smallMenu .standalone {
                font-size: 1.1rem;
                padding: 8px 12px;
                margin-top: 5px;
                border-radius: 5px;
            }

            .contailer .smallMenu .highlight {
                background-color: #4cae4c;
                color: Black;
            }

            .contailer .smallMenu .standalone .active {
                background-color: #4cae4c;
                color: Black;
            }

            .contailer .smallMenu .standalone div:hover {
                background-color: #4cae4c;
                color: Black;
            }
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printSection, #printSection * {
                visibility: visible;
            }

            #printSection {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
@endsection


