<?php
use \Illuminate\Support\Facades\Session;

if (Session::has('lists')) {
    Session::forget('lists');
}


?>
<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

    <head>
        @include('modular-forms::layouts.components.metatags')
        @translations
        @include('modular-forms::layouts.components.assets')
        @include('modular-forms::layouts.components.head')
    </head>

    <body class="flex-col">

        <header>
            @include('modular-forms::layouts.components.header')
        </header>

        <main>
            <section class="content">
                @yield('content')
            </section>
        </main>

        <footer>
            @include('modular-forms::layouts.components.footer')
        </footer>

    </body>

    @stack('scripts')

</html>
