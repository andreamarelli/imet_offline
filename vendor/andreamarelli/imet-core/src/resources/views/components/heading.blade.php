<?php
use \AndreaMarelli\ImetCore\Helpers\Template;
use \AndreaMarelli\ImetCore\Models\Imet\Imet;
use \AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa;
use \AndreaMarelli\ModularForms\Helpers\API\ProtectedPlanet\ProtectedPlanet;

/** @var Imet $item */

$last_update = $item->getLastUpdate();

?>
<div class="id mx-1" >{{-- version --}}
    @if($item->version===Imet::IMET_V1)
        &nbsp;<span class="badge badge-secondary align-top">v1</span>
    @elseif($item->version===Imet::IMET_V2)
        &nbsp;<span class="badge badge-success align-top">v2</span>
    @elseif($item->version===Imet::IMET_OECM)
        &nbsp;<span class="badge badge-info align-top">OECM</span>
    @endif
    {{-- ID --}}
    <span class="ml-2.5">
        IMET #: {{ $item->getKey() }}
    </span>
    {{-- last update --}}
    <span class="ml-2.5">
        @uclang('modular-forms::entities.common.last_update'):&nbsp;
        <b><i>{{ $last_update['date'] }}</i></b>
    </span>
</div>

<div class="entity-heading scale-95">
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

