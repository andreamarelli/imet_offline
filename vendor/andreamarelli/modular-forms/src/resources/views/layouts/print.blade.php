<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    @include('modular-forms::layouts.components.metatags')
    @include('modular-forms::layouts.components.assets')
    @include('modular-forms::layouts.components.head')
</head>

<body class="flex-col">

<main>
    <section class="content">
        @yield('content')
    </section>
</main>

</body>

</html>
