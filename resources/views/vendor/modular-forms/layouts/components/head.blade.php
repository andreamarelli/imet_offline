<title>IMET v{{ imet_offline_version() }}</title>


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


<!-- mapbox -->
@if(Route::getCurrentRoute() && (
    \Illuminate\Support\Str::contains(Route::getCurrentRoute()->uri(), '/report') ||
    \Illuminate\Support\Str::contains(Route::getCurrentRoute()->uri(), '/scaling_up')))
    @include('modular-forms::layouts.components.mapbox')
@endif
