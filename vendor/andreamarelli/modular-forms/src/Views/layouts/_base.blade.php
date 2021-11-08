<?php
/** @var string $class_to_body */
$class_to_body = $class_to_body ?? '';

?>
<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

    <head>
        @include('modular-forms::layouts.components.metatags')
        @translations
        @include('modular-forms::layouts.components.head')
    </head>

    <body class="{{ $class_to_body }}">
        @yield('body')
    </body>


    @stack('scripts')

</html>
