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
                <div class="scrollButtons mr-3" style="width:200px;">
                    <div class="content">
                        <span class="m-1">{{trans('imet-core::analysis_report.navigation_menu')}}</span>
                        <span>
                            <select class="form-control" @change="goTo($event)">
                                <option
                                    value="names">{{ trans('imet-core::analysis_report.guidance.custom_names') }}</option>
                                <option
                                    value="list_of_names">{{ trans('imet-core::analysis_report.sections.list_of_names') }}</option>
                                @foreach($templates as $key => $template)
                                    <option value="{{ $template['name'] }}">{{ $template['title'] }}</span>
                                @endforeach
                        </select>
                    </div>
                </div>

                <div id="names"></div>
                @include('imet-core::scaling_up.components.scaling_up_template')
                @include('imet-core::scaling_up.components.wdpa_names')
                @include('imet-core::scaling_up.components.protected_areas',
                                [   'name' => 'list_of_names' ,
                                   'code' => '',
                                   'title' => trans('imet-core::analysis_report.sections.list_of_names'),
                                   'snapshot_id' => '',
                                   'exclude_elements' => '',
                                   'pas' => ($custom_names)
                                ])
                @foreach($templates as $key => $template)
                    @include('imet-core::scaling_up.components.'.$template['name'],
                                [   'name' => $template['name'],
                                   'code' => '',
                                   'title' => $template['title'],
                                   'snapshot_id' => $template['snapshot_id'],
                                   'exclude_elements' => $template['exclude_elements'],
                                   'pas' => ($custom_names)
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
            },
            methods: {
                goTo: function (event) {
                    window.ModularForms.Mixins.Animation.scrollPageToAnchor(event.target.value);
                }
            }
        });

    </script>
    <style>
        @media screen {

            .scrollButtons {
                bottom: 120px;
            }

            .scrollButtons div:hover {
                background-color: #14532D;
                color: white;
            }

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


