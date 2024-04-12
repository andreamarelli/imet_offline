<?php
$uri = \Illuminate\Support\Facades\Route::getCurrentRequest()->path();

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
                    <a href="{{ route('imet-core::index') }}">{!! \AndreaMarelli\ModularForms\Helpers\Template::icon('arrow-circle-right', '') !!}
                        @lang('imet-core::common.imet_short')
                    </a>
                </li>
                <li>
                    <a href="{{ route('imet-core::oecm.index') }}">{!! \AndreaMarelli\ModularForms\Helpers\Template::icon('arrow-circle-right', '') !!}
                        @lang('imet-core::oecm_common.oecm_short')
                    </a>
                </li>
            @endif
        </ul>

        <ul class="menu-header">
            @if($home)
                <li>
                    <a>{!! \AndreaMarelli\ModularForms\Helpers\Template::flag(strtolower(\Illuminate\Support\Facades\App::getLocale()), '') !!}</a>
                    <ul class="language_selector">
                        <li>@lang('imet-core::common.switch_language'):</li>
                        @foreach(trans('imet-core::common.languages') as $lang=>$label)
                            <li>
                                <a href="{{ url()->current() }}?lang={{ $lang }}">
                                    {!! \AndreaMarelli\ModularForms\Helpers\Template::flag($lang, '') !!}
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
