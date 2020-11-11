<?php
    $uri = Route::getCurrentRequest()->path();
    $home = $uri==='admin/imet' || $uri==='admin/v1' || $uri==='admin/v2';
?>
@if(!Auth::guest())

    <div id="imet_header">

        <ul class="menu-header">

            <li>
                <a href="{{ url('admin/imet') }}">{!! \App\Library\Utils\Template::icon('home', '') !!}
                    @lang('form/imet/common.imet')
                </a>
            </li>

        </ul>

        <ul class="menu-header">
            <li>
                <a>{!! \App\Library\Utils\Template::icon('user-circle', '', '1.2em') !!}&nbsp;{{ Auth::user()->getName() }}</a>
            </li>
            @if($home)
                <li>
                    <a >{!! \App\Library\Utils\Template::flag(strtolower(App::getLocale()), '') !!}</a>
                    <ul class="language_selector">
                        <li>@lang('form/imet/common.switch_language'):</li>
                        @foreach(trans('form/imet/common.languages') as $lang=>$label)
                            <li>
                                <a href="{{ url()->current() }}?lang={{ $lang }}">
                                    {!! \App\Library\Utils\Template::flag($lang, '') !!}
                                    {{ ucfirst($label) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif

        </ul>

    </div>




@endif
