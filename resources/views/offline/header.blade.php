<?php
use AndreaMarelli\ModularForms\Helpers\Template;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

$uri = Route::getCurrentRequest()->path();

$home = $uri === 'imet'
    || $uri === 'oecm'
    || Str::contains($uri, 'imet/scaling_up') > -1;

$welcome = $uri === 'welcome'
    || $uri === 'confirm_user';

?>
@if(!\Illuminate\Support\Facades\Auth::guest())

    <div id="imet_header">

        <ul class="menu-header">
            @if(!$welcome)
                <li>
                    <a href="{{ route('imet-core::index') }}">{!! Template::icon('arrow-circle-right', '') !!}
                        @lang('imet-core::common.imet_short')
                    </a>
                </li>
                <li>
                    <a href="{{ route('imet-core::oecm.index') }}">{!! Template::icon('arrow-circle-right', '') !!}
                        @lang('imet-core::oecm_common.oecm_short')
                    </a>
                </li>
            @endif
        </ul>

        <ul class="menu-header">
            @if($home)
                <li>
                    <a>{!! Template::flag(strtolower(App::getLocale()), '') !!}</a>
                    <ul class="language_selector">
                        <li>@lang('imet-core::common.switch_language'):</li>
                        @foreach(trans('imet-core::common.languages') as $lang=>$label)
                            <li>
                                <a href="{{ url()->current() }}?lang={{ $lang }}">
                                    {!! Template::flag($lang, '') !!}
                                    {{ ucfirst($label) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
{{--            <li>--}}
{{--                <a href="{{ route('settings') }}" >{!! Template::icon('gear') !!}</a>--}}
{{--            </li>--}}
        </ul>

    </div>




@endif
