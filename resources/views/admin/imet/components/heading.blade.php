<?php
/** @var string $phase */

?>
<div class="id" style="margin-bottom: 4px;">IMET #{{ $item->getKey() }}</div>

<div class="entity-heading">
    <div class="subtitle">{{ $item->Year }}</div>
    &nbsp;
    <div class="name">
        {!! \App\Library\Ofac\Template::flag($item->Country) !!}
        {{ $item->name }}
        (<a target="_blank" href="{{ \App\Library\API\ProtectedPlanet\ProtectedPlanet::WEBSITE_URL  }}/{{ $item->wdpa_id }}">{{ $item->wdpa_id }}</a>)
    </div>
</div>

<nav class="steps">

    <a href="{{ action([\App\Http\Controllers\Imet\ImetControllerV2::class, 'edit'], [$item->getKey()]) }}"
       class="step @if('context'==$phase) selected @endif"
    >
        {{ ucfirst(trans('form/imet/common.context_long')) }}
    </a>

    <a href="{{ action([\App\Http\Controllers\Imet\ImetEvalControllerV2::class, 'edit'], [$item->getKey()]) }}"
       class="step @if('evaluation'==$phase) selected @endif"
    >
        {{ ucfirst(trans('form/imet/common.evaluation_long')) }}
    </a>

    <a href="{{ action([\App\Http\Controllers\Imet\ImetControllerV2::class, 'report'], [$item->getKey()]) }}"
       class="step @if('report'==$phase) selected @endif"
    >
        {{ ucfirst(trans('form/imet/common.report_long')) }}
    </a>

</nav>


{{-- <h3>{{ ucfirst(trans('form/imet/common.context_long')) }}</h3> --}}
