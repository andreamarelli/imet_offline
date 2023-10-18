<?php
$uri = \Illuminate\Support\Facades\Route::getCurrentRequest()->path();
$home = $uri === 'admin/imet' || $uri === 'admin/v1' || $uri === 'admin/v2' || strpos($uri, 'admin/imet/scaling_up') > -1;

?>
@if(!\Illuminate\Support\Facades\Auth::guest())

    <div id="imet_header">

        <ul class="menu-header">

            @if(!\Illuminate\Support\Str::contains(Route::getCurrentRoute()->uri(), 'welcome'))
                <li>
                    <a href="{{ url('admin/imet') }}">{!! \AndreaMarelli\ModularForms\Helpers\Template::icon('home', '') !!}
                        @lang('imet-core::common.imet_short')
                    </a>
                </li>
                <li>
                    <a href="{{ route('imet-core::oecm.index') }}">{!! \AndreaMarelli\ModularForms\Helpers\Template::icon('home', '') !!}
                        @lang('imet-core::oecm_common.oecm_short')
                    </a>
                </li>
            @endif

        </ul>

        <ul class="menu-header">
            <li>
                <a>{!! \AndreaMarelli\ModularForms\Helpers\Template::icon('user-circle', '', '1.2em') !!}
                    &nbsp;{{ \App\Models\User::find(Auth::id())->getName() }}</a>
            </li>
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
