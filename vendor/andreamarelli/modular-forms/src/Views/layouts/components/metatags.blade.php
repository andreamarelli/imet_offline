<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{ url('/') }}/favicon.ico" type="image/x-icon" rel="icon">

<?php

    $window_js = [
        'csrfToken' => csrf_token(),
        'baseUrl' => url('/').'/',
        'locale' => \Illuminate\Support\Facades\App::getLocale()
    ]

?>
<script>
    window.Laravel = @json($window_js);
</script>
