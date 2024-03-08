@extends('modular-forms::layouts._base')

@section('body')
    <div class="container">
        <div class="row ">
            <div class="col-sm text-center m-5">
                <strong>Scaling up analysis report ({{$protected_areas}})</strong>
            </div>
        </div>
    </div>
    <div id="preview-elements">
        <div class="container">
            <div class="row align-items-center fill">
                <div class="col-sm">
                    <div class="text-center">
                        <br/> <preview_template :scaling_up_id="{{$scaling_up_id}}"></preview_template>
                    </div>
                </div>
            </div>
        </div>

        <div id="imet_report" class="scrollButtons">
            <div class="standalone" @click="downloadFiles">
                {!! \AndreaMarelli\ModularForms\Helpers\Template::icon('download') !!} {{ ucfirst(trans('imet-core::analysis_report.download_files')) }}</div>
            <div class="standalone" @click="printReport">
                {!! \AndreaMarelli\ModularForms\Helpers\Template::icon('print') !!} {{ ucfirst(trans('imet-core::analysis_report.print')) }}</div>
        </div>
    </div>

    <style>

        .fill {
            min-height: 100%;
            height: 100%;
        }

        @media print {
            #imet_report {
                visibility: hidden;
            }
            .content div {
                page-break-after: always;
                margin-top: 5px;
            }
        }

    </style>

    <script>

        window.Laravel = @json([
            'csrfToken' => csrf_token(),
            'baseUrl' => url('/').'/'
        ]);

        new Vue({
            el: '#preview-elements',
            methods: {
                printReport() {
                    window.print();
                },
                downloadFiles(){
                    window.location.href = '{{route('imet-core::scaling_up_download', ['scaling_id' => $scaling_up_id])}}';
                }
            }
        });

    </script>
@endsection







