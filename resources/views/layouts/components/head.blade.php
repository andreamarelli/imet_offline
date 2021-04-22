<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{ url('/') }}/favicon.ico" type="image/x-icon" rel="icon">

@if(is_imet_environment())
    <title>IMET v{{ imet_offline_version() }}</title>
@else
    <title>OFAC</title>
    <meta name="description" content="Des connaissances aux services de tous" />
    <meta name="keywords" content="observatoire, forêts, afrique centrale, Etat des Forêts" />
@endif

<link rel="stylesheet" href="{{ asset(mix('vendor.css', 'assets')) }}">
<link rel="stylesheet" href="{{ asset(mix('custom.css', 'assets')) }}">
<script src="{{ asset(mix('lang.js', 'assets')) }}"></script>
<script src="{{ asset(mix('vendor.js', 'assets')) }}"></script>
<script src="{{ asset(mix('custom.js', 'assets')) }}"></script>

@if(Route::getCurrentRequest()
    && \Str::contains(Route::getCurrentRequest()->url(), 'admin/imet/')
    && \Str::contains(Route::getCurrentRequest()->url(), 'report'))
    <script src="{{ asset(mix('vendor_mapping.js', 'assets')) }}"></script>
@endif

@if(App::environment('production'))

    {{--  Google Analytics --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-74516400-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-74516400-1');
    </script>

    {{-- NoCaptcha  --}}
    @if(Route::getCurrentRequest() &&
        (Route::getCurrentRequest()->is('login')
            || Route::getCurrentRequest()->is('register')))
        {!! NoCaptcha::renderJs() !!}
    @endif
@endif

<script>
    {!! 'window.Laravel = '.json_encode([
        'csrfToken' => csrf_token(),
        'baseUrl' => url('/').'/'
    ]).';' !!}
</script>
