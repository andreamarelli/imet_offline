<?php
/** @var String $version */

if ($version === 'v1') {
    $controller_context = \AndreaMarelli\ImetCore\Controllers\Imet\ControllerV1::class;
    $controller_eval = \AndreaMarelli\ImetCore\Controllers\Imet\EvalControllerV1::class;
    $controller_report = \AndreaMarelli\ImetCore\Controllers\Imet\ReportControllerV1::class;
} else {
    $controller_context = \AndreaMarelli\ImetCore\Controllers\Imet\ControllerV2::class;
    $controller_eval = \AndreaMarelli\ImetCore\Controllers\Imet\EvalControllerV2::class;
    $controller_report = \AndreaMarelli\ImetCore\Controllers\Imet\ReportControllerV2::class;
}
?>

<span class="imet_encode_popover">

    <button class="btn-nav small yellow"
            role="button"
            data-toggle="popover" data-trigger="focus" data-placement="top"
            :data-popover-content="'popover_edit_'+item.FormID">
        {!! AndreaMarelli\ModularForms\Helpers\Template::icon('pen', 'white') !!}
    </button>

    <div :id="'popover_edit_'+item.FormID" style="display: none">
        <div class="popover-heading">
            @lang_u('imet-core::common.encode')
        </div>
        <div class="popover-body">

            {{-- Context --}}
            @include('modular-forms::buttons._generic', [
                'controller' => $controller_context,
                'action' =>'edit',
                'item' => 'item.FormID',
                'label' => ucfirst(trans('imet-core::common.context')),
                'icon' => 'list',
                'class' => 'yellow',
                'new_page' => false
            ])

            {{-- Evaluation --}}
            @include('modular-forms::buttons._generic', [
                'controller' => $controller_eval,
                'action' =>'edit',
                'item' => 'item.FormID',
                'label' => ucfirst(trans('imet-core::common.evaluation')),
                'icon' => 'check-circle',
                'class' => 'yellow',
                'new_page' => false
            ])

            {{-- Analysis Report --}}
            @include('modular-forms::buttons._generic', [
                'controller' => $controller_report,
                'action' =>'report',
                'item' => 'item.FormID',
                'label' => ucfirst(trans('imet-core::common.report')),
                'icon' => 'flag-checkered',
                'class' => 'yellow',
                'new_page' => false
            ])

        </div>
    </div>

</span>

@push('scripts')
    <style>
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
    </style>

    @push('scripts')
        @once

            <script>

                // ###########################  Bootstrap popover  ###########################
                window.onload = function () {

                    $('[data-toggle="popover"]').popover({
                        html: true,
                        content: function () {
                            return document
                                .getElementById(this.getAttribute('data-popover-content'))
                                .querySelector(".popover-body").innerHTML;
                        },
                        title: function () {
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
