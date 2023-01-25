<?php
/** @var String $version */

if ($version === \AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_V1) {
    $controller_context = \AndreaMarelli\ImetCore\Controllers\Imet\v1\Controller::class;
    $controller_eval    = \AndreaMarelli\ImetCore\Controllers\Imet\v1\EvalController::class;
    $controller_report  = \AndreaMarelli\ImetCore\Controllers\Imet\v1\ReportController::class;
} else {
    $controller_context = \AndreaMarelli\ImetCore\Controllers\Imet\v2\Controller::class;
    $controller_eval    = \AndreaMarelli\ImetCore\Controllers\Imet\v2\EvalController::class;
    $controller_report  = \AndreaMarelli\ImetCore\Controllers\Imet\v2\ReportController::class;
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
            @uclang('imet-core::common.encode')
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
    @include('imet-core::components.popover')
@endpush
