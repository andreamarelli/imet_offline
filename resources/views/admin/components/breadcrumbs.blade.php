<?php
/** @var array $links */

?>
@if(!App::environment('imetoffline'))
    <div id="breadcrumb">
        <div class="wrap">
            <a href="{{ url('/') }}/admin">@lang('layout.admin.admin_page')</a>
            @if(isset($links))
                @foreach($links as $url=>$label)
                    <span class="sep">></span>
                    <a href="{{ !Str::startsWith($url, url('/')) ? url('/').'/'.$url : $url }}">{{ $label }}</a>
                @endforeach
            @endif
            @if(isset($item))
                <span class="sep">></span>
                <span class="entity">{{  $item->Name }}</span>
            @endif
        </div>
    </div>
@endif