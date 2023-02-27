<?php
use \AndreaMarelli\ImetCore\Controllers;
use \AndreaMarelli\ImetCore\Helpers\Template;
use \AndreaMarelli\ImetCore\Models\Imet\Imet;
use \AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use \AndreaMarelli\ModularForms\Helpers\API\ProtectedPlanet\ProtectedPlanet;
use \Illuminate\Support\Facades\Route;
use \Illuminate\Support\Str;

/** @var Imet $item */
/** @var string $phase */

$route_action = Str::endsWith(Route::currentRouteName(), 'show') ? 'show' : 'edit';

$last_update = $item->getLastUpdate();

if($item->version===Imet::IMET_V1){
    $ROUTE_PREFIX = Controllers\Imet\v1\Controller::ROUTE_PREFIX;
} elseif($item->version===Imet::IMET_V2){
    $ROUTE_PREFIX = Controllers\Imet\v2\Controller::ROUTE_PREFIX;
} elseif($item->version===Imet::IMET_OECM){
    $ROUTE_PREFIX = Controllers\Imet\oecm\Controller::ROUTE_PREFIX;
}

?>
<div class="id" style="margin-bottom: 4px;">{{-- version --}}
    @if($item->version===Imet::IMET_V1)
        &nbsp;<span class="badge badge-secondary" style="vertical-align: text-top;">v1</span>
    @elseif($item->version===Imet::IMET_V2)
        &nbsp;<span class="badge badge-success" style="vertical-align: text-top;">v2</span>
    @elseif($item->version===Imet::IMET_OECM)
        &nbsp;<span class="badge badge-info" style="vertical-align: text-top;">OECM</span>
    @endif
    {{-- ID --}}
    <span style="margin-left: 10px;">
        IMET #: {{ $item->getKey() }}
    </span>
    {{-- last update --}}
    <span style="margin-left: 10px;">
        @uclang('modular-forms::entities.common.last_update'):&nbsp;
        <b><i>{{ $last_update['date'] }}</i></b>
    </span>
</div>

<div class="entity-heading">
    <div class="subtitle">{{ $item->Year }}</div>
    &nbsp;
    <div class="name">
        {!! Template::flag($item->Country) !!}
        {{ $item->name }}
        @if(!ProtectedAreaNonWdpa::isNonWdpa( $item->wdpa_id))
            (<a target="_blank"
                href="{{ ProtectedPlanet::WEBSITE_URL  }}/{{ $item->wdpa_id }}">{{ $item->wdpa_id }}</a>
            )
        @endif
    </div>
</div>


<nav class="steps">

    <a href="{{ route($ROUTE_PREFIX.'context_' . $route_action, [$item->getKey()]) }}"
       class="step @if('context'==$phase) selected @endif"
    >@uclang('imet-core::common.context_long')</a>

    <a href="{{ route($ROUTE_PREFIX.'eval_' . $route_action, [$item->getKey()]) }}"
       class="step @if('evaluation'==$phase) selected @endif"
    >@uclang('imet-core::common.evaluation_long')</a>

    <a href="{{ route($ROUTE_PREFIX.'report_' . $route_action, [$item->getKey()]) }}"
       class="step @if('report'==$phase) selected @endif"
    >@uclang('imet-core::common.report_long')</a>

</nav>
