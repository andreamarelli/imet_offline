<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
    <head>
        @include('layouts.components.head')
    </head>
    <body
        @if(Route::getCurrentRequest() && Route::getCurrentRequest()->is('/')) id="homepage"
        @elseif(app()->environment('imetoffline'))  id="imet_offline"
        @endif
    >
        @yield('body')
    </body>

    @stack('scripts')

    @if(app()->environment('development'))
        <div class="text-center">
            Generated in <b>{{ round((microtime(true) - LARAVEL_START), 3) }}</b> seconds.
        </div>
    @endif

</html>
