<title>IMET v{{ imet_offline_version() }}</title>

{{-- hardcoded accessToken (not possible to push it into .env.imetoffline through updates --}}
@include('imet-core::layouts.components.assets', [
    'mapbox_token' => 'pk.eyJ1IjoiamFtZXNkYXZ5IiwiYSI6ImNpenRuMmZ6OTAxMngzM25wNG81b2MwMTUifQ.A2YdXu17spFF-gl6yvHXaw'
])
