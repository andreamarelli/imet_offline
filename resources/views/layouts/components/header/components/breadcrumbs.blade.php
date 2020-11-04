<?php
    $breadcrumbs = App\Library\Ofac\Breadcrumbs::get();
    $breadcrumbs = array_filter($breadcrumbs, function($item){
        return $item!==null;
    });

?>

@if(count($breadcrumbs)>0)

    <div id="breadcrumb">
        <div class="wrap">

            @if(count($breadcrumbs)>=2)

                @if(Lang::has('layout.menu.'.$breadcrumbs[0].'.'.$breadcrumbs[1]))
                    <a href="{{ url('/') }}">@lang('layout.home')</a>
                    <span class="sep">></span>
                    <a href="{{ url('/') }}/{{ $breadcrumbs[0] }}">{{ trans('layout.menu.'.$breadcrumbs[0].'.'.$breadcrumbs[0]) }}</a>
                    <span class="sep">></span>
                    <a href="{{ url('/') }}/{{ $breadcrumbs[0] }}">{{ trans('layout.menu.'.$breadcrumbs[0].'.'.$breadcrumbs[1]) }}</a>
                @endif

                @if(count($breadcrumbs)>2)
                    @if($breadcrumbs[1]==='biodiversity' && $breadcrumbs[2]==='details')
                        <span class="sep">></span>
                        <a href="{{ url('/') }}/africa/biodiversity/details?class={{ Request::get('class') }}">{{ trans('entities.biodiversity.class.'.Request::get('class')) }}</a>
                    @endif
                @endif

            @endif

        </div>
    </div>

@endif