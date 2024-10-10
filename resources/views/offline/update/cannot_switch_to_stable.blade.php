<?php
/** @var string $current_version */

?>

@extends('layouts.base')

@section('content')

        <h1 class="mb-8">@lang('offline.update.cannot_switch_to_stable')</h1>

        <div class="module-container" id="module_settings_api_keys">
            <div class="module-header">
                <div class="module-title">{{ ucfirst(trans('offline.update.cannot_switch_to_stable')) }}</div>
            </div>
            <div class="module-body">

                <div class="m-4 text-xl">
                    @lang('offline.update.cannot_switch_to_stable_long')
                </div>

            </div>

        </div>

@endsection
