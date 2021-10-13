<?php
/** @var array $links */
/** @var bool $show" */

$show = $show ?? true;

?>
@if($show)
    <div id="breadcrumb">
        <div class="wrap">
            <a href="{{ url('/') }}/admin">@lang('modular-forms::common.admin_page')</a>
            @if(isset($links))
                @foreach($links as $url=>$label)
                    <span class="sep">></span>
                    <a href="{{ !\Illuminate\Support\Str::startsWith($url, url('/')) ? url('/').'/'.$url : $url }}">{{ $label }}</a>
                @endforeach
            @endif
        </div>
    </div>
@endif
