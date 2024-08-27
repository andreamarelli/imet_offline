<?php

use Illuminate\Support\Facades\App;

$window_js = [
    'csrfToken' => csrf_token(),
    'baseUrl' => url('/') . '/',
    'locale' => App::getLocale()
];

?>

<script>
    window.Laravel = @json($window_js);
</script>


