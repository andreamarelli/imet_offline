<?php

use Illuminate\Support\Env;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

$current_route_name = Route::currentRouteName();

$window_js = [
    'csrfToken' => csrf_token(),
    'baseUrl' => url('/') . '/',
    'locale' => App::getLocale()
];

$routes = [
    'scores' => route('imet_core::api::scores', ['item' => '__id__']),
    'scores_oecm' => route('imet_core::api::scores_oecm', ['item' => '__id__']),
    'scaling_up_preview' => route('imet-core::scaling_up_preview', ['id' => '__id__']),
    'scaling_up_basket_add' => route('imet-core::scaling_up_basket_add'),
    'scaling_up_basket_get' => route('imet-core::scaling_up_basket_get'),
    'scaling_up_basket_all' => route('imet-core::scaling_up_basket_all'),
    'scaling_up_basket_delete' => route('imet-core::scaling_up_basket_delete', ['id' => '__id__']),
    'scaling_up_basket_clear' => route('imet-core::scaling_up_basket_clear')
];

?>

<script>
    window.Laravel = @json($window_js);
    window.Routes = @json($routes);
</script>

{{-- mapbox --}}
{{--@push('scripts')--}}
{{--    @if(Str::contains($current_route_name, 'report') || Str::contains($current_route_name, 'scaling_up'))--}}
{{--        <script>--}}
{{--            window.mapboxgl.accessToken = '{{ Env::getOrFail('MAPBOX_ACCESS_TOKEN') }}';--}}
{{--        </script>--}}
{{--    @endif--}}
{{--@endpush--}}



