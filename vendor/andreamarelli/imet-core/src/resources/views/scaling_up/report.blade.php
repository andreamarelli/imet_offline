@extends('modular-forms::layouts.forms')

@section('content')
    <div id="imet_report">
        <app :scaling_up_id="{{ $scaling_up_id }}">
            <template v-slot:default>

                @include('imet-core::scaling_up.components.scaling_up_template')

                <div class="text-center mb-5">
                    <strong>{{ trans('imet-core::analysis_report.title') }} ({{ $protected_areas_names }})</strong>
                </div>

                @include('imet-core::scaling_up.components.navigation_menu', ['templates' => $templates])

                <div id="names"></div>

                <div class="module-container">
                    <guidance :text="'imet-core::analysis_report.guidance.special_information'"></guidance>
                </div>

                @include('imet-core::scaling_up.components.wdpa_names')

                @foreach ($templates as $key => $template)
                    @include('imet-core::scaling_up.components.' . $template['name'], [
                        'name' => $template['name'],
                        'code' => $template['code'],
                        'title' => $template['title'],
                        'snapshot_id' => $template['snapshot_id'],
                        'exclude_elements' => $template['exclude_elements'],
                        'pas' => $custom_names,
                    ])
                @endforeach

            </template>
        </app>
    </div>
@endsection

@push('scripts')
    <script>
        const labels = @json($labels);
        window.ScalingUp = {};
        window.ScalingUp.labels = function(label) {
            return labels[label];
        }
    </script>
    <script type="module">
        (new window.ImetCore.Apps.Report({
            url: '{{ route('imet-core::scaling_up_analysis') }}',

        })).mount('#imet_report');
    </script>
    <style>
        @media screen {
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


            .smallMenu {
                position: -webkit-sticky;
                display: inline-block;
                margin-bottom: 0;
                position: sticky;
                top: 0px;
                bottom: 0px;
                left: 0px;
                z-index: 999999;

            }

            .smallMenu .standalone {
                text-align: center;
                background-color: #004A19;
                color: #fff;
                cursor: pointer;
                padding: 3px 8px;
                font-size: 0.9rem;
                border-radius: 0;
                z-index: 999999;
            }

            .smallMenu .standalone {
                font-size: 1.1rem;
                padding: 8px 12px;
                margin-top: 5px;
                border-radius: 5px;
            }

            .smallMenu .highlight {
                background-color: #4cae4c;
                color: Black;
            }

            .smallMenu .standalone .active {
                background-color: #4cae4c;
                color: Black;
            }

            .smallMenu .standalone div:hover {
                background-color: #4cae4c;
                color: Black;
            }
            .module-container .module-body {
                background-color: transparent !important;
            }
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printSection,
            #printSection * {
                visibility: visible;
            }

            #printSection {
                position: absolute;
                left: 0;
                top: 0;
            }

            .module-container .module-body {
                background-color: transparent !important;
            }
        }
    </style>
@endpush
