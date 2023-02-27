<?php
/** @var String $version */

if($version === \AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_V1){
    $controller_context = \AndreaMarelli\ImetCore\Controllers\Imet\v1\ContextController::class;
    $controller_eval = \AndreaMarelli\ImetCore\Controllers\Imet\v1\EvalController::class;
    $controller_report = \AndreaMarelli\ImetCore\Controllers\Imet\v1\ReportController::class;
}
else if($version === \AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_V2){
    $controller_context = \AndreaMarelli\ImetCore\Controllers\Imet\v2\ContextController::class;
    $controller_eval = \AndreaMarelli\ImetCore\Controllers\Imet\v2\EvalController::class;
    $controller_report = \AndreaMarelli\ImetCore\Controllers\Imet\v2\ReportController::class;
} else {
    $controller_context = \AndreaMarelli\ImetCore\Controllers\Imet\oecm\ContextController::class;
    $controller_eval = \AndreaMarelli\ImetCore\Controllers\Imet\oecm\EvalController::class;
    $controller_report = \AndreaMarelli\ImetCore\Controllers\Imet\oecm\ReportController::class;
}
?>

<span class="imet_show_popover">

    <button class="btn-nav small"
            role="button"
            data-toggle="popover" data-trigger="focus" data-placement="top"
            :data-popover-content="'popover_show_'+item.FormID">
        {!! AndreaMarelli\ModularForms\Helpers\Template::icon('eye', 'white') !!}
    </button>

    <div :id="'popover_show_'+item.FormID" style="display: none">
        <div class="popover-heading">
            @uclang('imet-core::common.show')
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

            {{-- Analysis Report --}}
            @if($version===\AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_V2 || $version===\AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_OECM)
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
    @include('imet-core::components.popover')
@endpush