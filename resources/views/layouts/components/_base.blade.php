<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
    <head>
        @include('layouts.components.head')
    </head>
    <body
        @if(Route::getCurrentRequest() && Route::getCurrentRequest()->is('/')) id="homepage"
        @elseif(is_imet_environment())  id="imet_offline"
        @endif
    >
        @yield('body')
    </body>

    @stack('scripts')

</html>
