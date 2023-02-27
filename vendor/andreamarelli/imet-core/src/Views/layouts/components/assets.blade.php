<?php
/** @var String $mapbox_token */

use \Illuminate\Support\Facades\Route;
use \Illuminate\Support\Str;

$current_route_name = Route::currentRouteName();

?>

{{-- packages --}}
<script src="{{ asset(mix('modular_forms_vendor.js', 'assets')) }}"></script>
<link rel="stylesheet" href="{{ asset(mix('modular_forms_vendor.css', 'assets')) }}">
<script src="{{ asset(mix('modular_forms_index.js', 'assets')) }}"></script>
<link rel="stylesheet" href="{{ asset(mix('modular_forms_index.css', 'assets')) }}">
<script src="{{ asset(mix('imet_core_vendor.js', 'assets')) }}"></script>
<link rel="stylesheet" href="{{ asset(mix('imet_core_vendor.css', 'assets')) }}">
<script src="{{ asset(mix('imet_core_index.js', 'assets')) }}"></script>
<link rel="stylesheet" href="{{ asset(mix('imet_core_index.css', 'assets')) }}">
{{-- vendors --}}
<script src="{{ asset(mix('vendor.js', 'assets')) }}"></script>
<link rel="stylesheet" href="{{ asset(mix('vendor.css', 'assets')) }}">
{{-- local assets --}}
<script src="{{ asset(mix('index.js', 'assets')) }}"></script>
<link rel="stylesheet" href="{{ asset(mix('index.css', 'assets')) }}">

<script>
    window.imet_routes = {
        'assessment': '{{ route('imet_core::api::assessment', ['item' => '__id__']) }}',
        'assessment_oecm': '{{ route('imet_core::api::assessment_oecm', ['item' => '__id__']) }}',
        'scaling_up_preview': '{{ route('imet-core::scaling_up_preview', ['id' => '__id__']) }}',
        'scaling_up_basket_add': '{{ route('imet-core::scaling_up_basket_add') }}',
        'scaling_up_basket_get': '{{ route('imet-core::scaling_up_basket_get') }}',
        'scaling_up_basket_all': '{{ route('imet-core::scaling_up_basket_all') }}',
        'scaling_up_basket_delete': '{{ route('imet-core::scaling_up_basket_delete', ['id' => '__id__']) }}',
        'scaling_up_basket_clear': '{{ route('imet-core::scaling_up_basket_clear') }}'
    };
</script>


<!-- mapbox -->
@if(Str::contains($current_route_name, 'imet-core::v1_report') ||
    Str::contains($current_route_name, 'imet-core::v2_report') ||
    Str::contains($current_route_name, 'imet-core::scaling_up'))
        @include('modular-forms::layouts.components.mapbox')
        <script>
            window.mapboxgl.accessToken = '{{ $mapbox_token }}';
        </script>
@endif
