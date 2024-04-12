<?php
use \AndreaMarelli\ImetCore\Helpers\Template;
use \AndreaMarelli\ImetCore\Models\Imet\Imet;
use \AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use \AndreaMarelli\ModularForms\Helpers\API\ProtectedPlanet\ProtectedPlanet;

/** @var Imet $item */

$last_update = $item->getLastUpdate();

?>
<div class="id" style="margin-bottom: 4px;">{{-- version --}}
    @if($item->version===Imet::IMET_V1)
        &nbsp;<span class="badge badge-secondary" style="vertical-align: text-top;">v1</span>
    @elseif($item->version===Imet::IMET_V2)
        &nbsp;<span class="badge badge-success" style="vertical-align: text-top;">v2</span>
    @elseif($item->version===Imet::IMET_OECM)
        &nbsp;<span class="badge badge-info" style="vertical-align: text-top;">@lang('imet-core::oecm_common.oecm_short')</span>
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

