<?php
    $uri = \Illuminate\Support\Facades\Route::getCurrentRequest()->path();
    $home = $uri==='admin/imet' || $uri==='admin/v1' || $uri==='admin/v2';
?>
@if(!\Illuminate\Support\Facades\Auth::guest())

    <div id="imet_header">

        <ul class="menu-header">

            <li>
                <a href="{{ url('admin/imet') }}">{!! \AndreaMarelli\ModularForms\Helpers\Template::icon('home', '') !!}
                    @lang('imet-core::common.imet')
                </a>
            </li>

        </ul>

        <ul class="menu-header">
            <li>
                <a>{!! \AndreaMarelli\ModularForms\Helpers\Template::icon('user-circle', '', '1.2em') !!}&nbsp;{{ \Illuminate\Support\Facades\Auth::user()->getName() }}</a>
            </li>
            @if($home)
                <li>
                    <a >{!! \AndreaMarelli\ModularForms\Helpers\Template::flag(strtolower(\Illuminate\Support\Facades\App::getLocale()), '') !!}</a>
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
