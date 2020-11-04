<?php
/** @var Mixed $definitions */
?>

@if(App\Library\Utils\Type\Chars::startsWith($definitions['module_key'], 'imet__v1'))
    @include('admin.imet.v1.info', compact('definitions'))

@elseif(App\Library\Utils\Type\Chars::startsWith($definitions['module_key'], 'imet__v2'))
    @include('admin.imet.v2.info', compact('definitions'))

@else

    @if($definitions['module_info']!==null && $definitions['module_info_type']==='plain')
        <div class="module-bar info-bar">
            <div class="icon">
                {!! \App\Library\Utils\Template::icon('info-circle', '', '1.4em') !!}
            </div>
            <div class="message">
                {!! $definitions['module_info'] !!}
            </div>
        </div>
    @endif

@endif


