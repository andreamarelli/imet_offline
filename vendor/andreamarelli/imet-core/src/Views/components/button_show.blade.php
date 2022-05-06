<?php
/** @var String $version */

if($version==='v1'){
    $controller_context = \AndreaMarelli\ImetCore\Controllers\Imet\ControllerV1::class;
    $controller_eval = \AndreaMarelli\ImetCore\Controllers\Imet\EvalControllerV1::class;
    $controller_report = \AndreaMarelli\ImetCore\Controllers\Imet\ReportControllerV1::class;
} else {
    $controller_context = \AndreaMarelli\ImetCore\Controllers\Imet\ControllerV2::class;
    $controller_eval = \AndreaMarelli\ImetCore\Controllers\Imet\EvalControllerV2::class;
    $controller_report = \AndreaMarelli\ImetCore\Controllers\Imet\ReportControllerV2::class;
    $controller_cross_analysis = \AndreaMarelli\ImetCore\Controllers\Imet\CrossAnalysisController::class;
}
?>

<span class="imet_show_popover">

    <button class="btn-nav small"
            role="button"
            data-toggle="popover" data-trigger="focus" data-placement="top" :data-popover-content="'popover_show_'+item.FormID" >
        {!! AndreaMarelli\ModularForms\Helpers\Template::icon('eye', 'white') !!}
    </button>

    <div :id="'popover_show_'+item.FormID" style="display: none">
        <div class="popover-heading">
            @lang_u('imet-core::common.show')
        </div>
        <div class="popover-body">

            {{-- Context --}}
            @include('modular-forms::buttons._generic', [
                'controller' => $controller_context,
                'action' =>'show',
                'item' => 'item.FormID',
                'label' => ucfirst(trans('imet-core::common.context')),
                'icon' => 'list',
                'class' => 'btn-success',
                'new_page' => false
            ])

            {{-- Evaluation --}}
            @include('modular-forms::buttons._generic', [
                'controller' => $controller_eval,
                'action' =>'show',
                'item' => 'item.FormID',
                'label' => ucfirst(trans('imet-core::common.evaluation')),
                'icon' => 'check-circle',
                'class' => 'btn-success',
                'new_page' => false
            ])

            @if($version==='v2')
                {{-- Cross Analysis --}}
                @include('modular-forms::buttons._generic', [
                    'controller' => $controller_cross_analysis,
                    'action' =>'cross_analysis',
                    'item' => 'item.FormID',
                    'label' => ucfirst(trans('imet-core::common.cross_analysis')),
                    'icon' => 'chart-bar',
                    'class' => 'btn-success',
                    'new_page' => false
                ])
            @endif

            {{-- Analysis Report --}}
            @if($version==='v2')
                @include('modular-forms::buttons._generic', [
                    'controller' => $controller_report,
                    'action' =>'report_show',
                    'item' => 'item.FormID',
                    'label' => ucfirst(trans('imet-core::common.report')),
                    'icon' => 'flag-checkered',
                    'class' => 'btn-success',
                    'new_page' => false
                ])
            @endif

        </div>
    </div>

</span>

@push('scripts')
    <style>
        .popover-header{
            font-size: 0.9em;
            font-style: italic;
            font-weight: bold;
            text-align: center;
        }
        .popover-body{
            display: flex;
            flex-direction: column;
        }
        .popover-body a{
            margin: 3px;
        }
    </style>

    @push('scripts')
        @once

            <script>

                // ###########################  Bootstrap popover  ###########################
                window.onload = function(){

                    $('[data-toggle="popover"]').popover({
                        html : true,
                        content: function() {
                            return document
                                .getElementById(this.getAttribute('data-popover-content'))
                                .querySelector(".popover-body").innerHTML;
                        },
                        title: function() {
                            return document
                                .getElementById(this.getAttribute('data-popover-content'))
                                .querySelector(".popover-heading").innerHTML;
                        }
                    });
                }

            </script>
        @endonce
    @endpush
@endpush
