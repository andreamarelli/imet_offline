@extends('layouts.admin')

@include('imet-core::components.breadcrumbs_and_page_title')

@section('content')
    <div id="imet_report">
        <app :scaling_up_id="{{$scaling_up_id}}">
            <template>
                @include('imet-core::scaling_up.components.scaling_up_template')
                <div class="container">
                    <div class="row h-150 mb-5">
                        <div class="col-sm text-center">
                            <strong>{{trans('imet-core::analysis_report.title')}} ({{$protected_areas_names}})</strong>
                        </div>
                    </div>
                </div>
                @include('imet-core::scaling_up.components.navigation_menu', ['templates'=> $templates])
                <div id="names"></div>
                <div>
                    <guidance :text="'imet-core::analysis_report.guidance.special_information'"/>
                </div>
                @include('imet-core::scaling_up.components.wdpa_names')
                @foreach($templates as $key => $template)
                    @include('imet-core::scaling_up.components.'.$template['name'],
                                [   'name' => $template['name'],
                                   'code' => $template['code'],
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
                url: '{{ route('imet-core::scaling_up_analysis') }}'
            },
            methods: {
                goTo: function (event) {
                    let element = event.target.value;
                    if(element === '#'){
                        return;
                    }
                    if (['process', 'process_pr1_pr6', 'process_pr7_pr9', 'process_pr10_pr12', 'process_pr13_pr14', 'process_pr15_pr16', 'process_pr17_pr18'].includes(element)) {
                        let event_element = 'analysis_per_element_of_them_management_cycle';
                        this.$root.$emit(event_element);
                        setTimeout(() => {
                            this.$root.$emit('sub_elem_4');
                        }, 500);
                        setTimeout(() => {
                            window.ModularForms.Mixins.Animation.scrollPageTo($('#' + element).offset().top);
                        }, 500);
                    } else {
                        this.$root.$emit(element);
                        setTimeout(() => {
                            window.ModularForms.Mixins.Animation.scrollPageToAnchor(element);
                        }, 500);
                    }

                }
            }
        });


    </script>
    <style>
        @media screen {
            .popover-header {
                font-size: 0.9em;
                font-style: italic;
                font-weight: bold;
                text-align: center;
            }

            .popover-body {
                display: flex;
                flex-direction: column;
            }

            .popover-body a {
                margin: 3px;
            }

            .sub-title {
                font-weight: 600;
                padding: 8px 8px 8px 10px;
                background-color: #fafafa;
                color: #525252;
                font-size: 1.1rem;
                line-height: 1.3em;
                border-top: 1px dashed #d4d4d4;
                display: block;
            }

            .sub-title-second {
                font-weight: normal;
                font-size: 1.0rem;
            }

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

            .popover-header {
                font-size: 0.9em;
                font-style: italic;
                font-weight: bold;
                text-align: center;
            }

            .popover-body {
                display: flex;
                flex-direction: column;
            }

            .popover-body a {
                margin: 3px;
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


