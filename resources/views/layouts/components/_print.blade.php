<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
    <head>
        <meta charset="utf-8">
        {{--<link rel="stylesheet" href="{{ asset(mix('vendor.css', 'assets')) }}">--}}
        <link rel="stylesheet" href="{{ asset(mix('custom.css', 'assets')) }}">
        <link rel="stylesheet" href="{{ asset(mix('pdf.css', 'assets')) }}">
    </head>
    <body class="pdf">

        <div id="pdf_logos">
            <a href="http://www.comifac.org/" target="_blank" class="logo_comifac"><img src="{{ asset('images').'/comifac.png' }}" /></a>
            <a href="https://www.observatoire-comifac.net/" class="logo_ofac"><img src="{{ asset('images').'/ofac.png' }}" /></a>
            <br />
            <img src="{{ asset('images').'/countries.png' }}" class="logo_countries"/>
        </div>

        @yield('body')

    </body>
</html>