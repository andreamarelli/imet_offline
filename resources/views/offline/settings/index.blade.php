<?php
/** @var Array $vueData */
/** @var Array $countries */
/** @var Array $updated_pas_countries */

use AndreaMarelli\ModularForms\Helpers\DOM;
use AndreaMarelli\ModularForms\Helpers\Template;

?>

@extends('layouts.base')

@section('content')

    <h1 class="mb-8">@lang('offline.settings.page_title')</h1>

{{--    <!-- Proxy settings -->--}}
{{--    TODO: Work in progress--}}
{{--    @include('offline.settings.modules.proxy', compact('vueData'))--}}

    <!-- API keys -->
    @include('offline.settings.modules.api_keys' , compact('vueData'))

    <!-- Protected areas -->
    @include('offline.settings.modules.protected_areas', compact('countries', 'updated_pas_countries'))

@endsection
