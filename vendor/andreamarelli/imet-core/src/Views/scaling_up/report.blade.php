@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['links' => [
        action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'index']) => trans('imet-core::common.imet_short')
    ]])
@endsection

@if(!is_imet_environment())
@section('admin_page_title')
    @lang('imet-core::common.imet')
@endsection
@endif

@section('content')
    <div id="imet_report">
        <app :scaling_up_id="{{$scaling_up_id}}">
            <template>
                <div class="container">
                    <div class="row h-150 mb-5">
                        <div class="col-sm text-center">
                            <strong>{{trans('imet-core::analysis_report.title')}} ({{$protected_areas_names}})</strong>
                        </div>
                    </div>
                </div>
                @include('imet-core::scaling_up.components.wdpa_names')
                @include('imet-core::scaling_up.components.scaling_up_template')
                @foreach($templates as $key => $template)
                    @include('imet-core::scaling_up.components.'.$template['name'],
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
                url: '{{ action([\AndreaMarelli\ImetCore\Controllers\Imet\ScalingUpAnalysisController::class, 'get_ajax_responses']) }}'
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


