<?php
/** @var string $current_version */

?>

@extends('layouts.base')

@section('content')

        <div class="module-container" id="module_settings_api_keys">
            <div class="module-header">
                <div class="module-title">{{ ucfirst(trans('offline.update.download_successful')) }}</div>
            </div>
            <div class="module-body">

                <div class="m-4 text-xl">
                    @lang('offline.update.download_successful_long')
                </div>

            </div>

        </div>

@endsection

