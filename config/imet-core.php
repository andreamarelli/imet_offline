<?php
return [

    'offline_version' => env('IMET_OFFLINE_VERSION', 'DEV'),

    // API tokens
    'mapbox_token' => \Illuminate\Support\Env::getOrFail('MAPBOX_ACCESS_TOKEN'),

    // Routes' prefixes
    'web_routes_prefix' => null,
    'api_routes_prefix' => null,

];
