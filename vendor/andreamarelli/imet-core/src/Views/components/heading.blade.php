<?php
/** @var Imet $item */
/** @var string $phase */

use \AndreaMarelli\ImetCore\Models\Imet\Imet;
use \Illuminate\Support\Facades\Route;
use \Illuminate\Support\Str;

$route_action = Str::endsWith(Route::currentRouteName(), 'show') ? 'show' : 'edit';

$last_update = $item->getLastUpdate();

?>
<div class="id" style="margin-bottom: 4px;">{{-- version --}}
    @if($item->version===Imet::IMET_V1)
        &nbsp;<span class="badge badge-secondary" style="vertical-align: text-top;">v1</span>
    @elseif($item->version===Imet::IMET_V2)
        &nbsp;<span class="badge badge-success" style="vertical-align: text-top;">v2</span>
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
        {!! \AndreaMarelli\ImetCore\Helpers\Template::flag($item->Country) !!}
        {{ $item->name }}
        @if(!\AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa::isNonWdpa( $item->wdpa_id))
            (<a target="_blank"
                href="{{ \AndreaMarelli\ModularForms\Helpers\API\ProtectedPlanet\ProtectedPlanet::WEBSITE_URL  }}/{{ $item->wdpa_id }}">{{ $item->wdpa_id }}</a>
            )
        @endif
    </div>
</div>


<nav class="steps">

    @if($item->version==Imet::IMET_V1)

        <a href="{{ route('imet-core::v1_context_' . $route_action, [$item->getKey()]) }}"
           class="step @if('context'==$phase) selected @endif"
        >@uclang('imet-core::common.context_long')</a>

        <a href="{{ route('imet-core::v1_eval_' . $route_action, [$item->getKey()]) }}"
           class="step @if('evaluation'==$phase) selected @endif"
        >@uclang('imet-core::common.evaluation_long')</a>

        <a href="{{ route('imet-core::v1_report_' . $route_action, [$item->getKey()]) }}"
           class="step @if('report'==$phase) selected @endif"
        >@uclang('imet-core::common.report_long')</a>

    @else

        <a href="{{ route('imet-core::v2_context_' . $route_action, [$item->getKey()]) }}"
           class="step @if('context'==$phase) selected @endif"
        >@uclang('imet-core::common.context_long')</a>

        <a href="{{ route('imet-core::v2_eval_' . $route_action, [$item->getKey()]) }}"
           class="step @if('evaluation'==$phase) selected @endif"
        >@uclang('imet-core::common.evaluation_long')</a>

        <a href="{{ route('imet-core::v2_report_' . $route_action, [$item->getKey()]) }}"
           class="step @if('report'==$phase) selected @endif"
        >@uclang('imet-core::common.report_long')</a>

    @endif

</nav>
