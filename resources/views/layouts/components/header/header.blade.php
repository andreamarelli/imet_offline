<?php
/** @var bool  $only_logo */
$only_logo = $only_logo ?? false;
?>

<header id="header" class="container-fluid">
    <div class="wrap">

        {{-- Forced only logo --}}
        @if($only_logo)
            @include('layouts.components.header.components.logo')

        {{-- IMET OFFLINE --}}
        @elseif(is_imet_environment())
            @include('admin.imet.offline.header')

        {{-- Administration --}}
        @elseif(\Illuminate\Support\Str::contains(url()->current(), url('/').'/admin'))
            @include('layouts.components.header.components.db_check')
            @include('layouts.components.header.components.logo')
            @include('layouts.components.header.components.logged')
            @yield('admin_breadcrumbs')

        {{-- homepage --}}
        @elseif(Route::getCurrentRequest()->is('/'))
            @include('layouts.components.header.components.logo')
            @include('layouts.components.header.components.top')
            @include('layouts.components.header.components.menu')
            @include('layouts.components.header.components.observatory')

        {{-- website pages --}}
        @else
            @include('layouts.components.header.components.logo')
            @include('layouts.components.header.components.top')
            @include('layouts.components.header.components.menu')
            @if(!\Illuminate\Support\Str::contains(Route::getCurrentRequest(),'analytical_platform/projects')
                    && !\Illuminate\Support\Str::contains(Route::getCurrentRequest(),'analytical_platform'))
                @include('layouts.components.header.components.breadcrumbs')
            @endif
        @endif

        <div style="clear: both;"></div>

    </div>
</header>
