<?php
/** @var String $version */

use AndreaMarelli\ModularForms\Helpers\Template;

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


<span>
    <span id="edit_{{ $item->getKey() }}">
        <button class="btn-nav mr-1 small yellow">{!! AndreaMarelli\ModularForms\Helpers\Template::icon('pen', 'white') !!}</button>
    </span>
    <tooltip :on-click=true
             anchor-elem-id="edit_{{ $item->getKey() }}">

        <div class="flex flex-col gap-y-1">

            {{-- Context --}}
            <a class="btn-nav my-0.5 small yellow" href="{{ action([$controller_context, 'edit'], [$item->getKey()]) }}">
                {!! Template::icon('list') . ' ' . ucfirst(trans('imet-core::common.context')) !!}
            </a>

            {{-- Evaluation --}}
            <a class="btn-nav my-0.5 small yellow" href="{{ action([$controller_eval, 'edit'], [$item->getKey()]) }}">
                {!! Template::icon('check-circle') . ' ' . ucfirst(trans('imet-core::common.evaluation')) !!}
            </a>

            {{-- Analysis Report --}}
            @if($version===\AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_V2 || $version===\AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_OECM)
                <a class="btn-nav my-0.5 small yellow" href="{{ action([$controller_report, 'report'], [$item->getKey()]) }}">
                {!! Template::icon('flag-checkered') . ' ' . ucfirst(trans('imet-core::common.report')) !!}
            </a>
            @endif

        </div>

    </tooltip>
</span>