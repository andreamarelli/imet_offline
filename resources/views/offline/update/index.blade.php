<?php
/** @var string $latest_version */
/** @var string $current_version */
/** @var array $release_notes */
/** @var array $release_date */
/** @var string $download_url */
/** @var boolean $require_installation */
/** @var string $installer_url */

use App\Helpers\SoftwareUpdater;

?>

@extends('layouts.base')

@section('content')

    {{-- ##### New Update Available: automatic update ##### --}}
    @if(SoftwareUpdater::isNewVersionAvailable() && !$require_installation)

        <h1 class="mb-8">@lang('offline.update.new_version_available')</h1>

        <div class="module-container" id="module_settings_api_keys">
            <div class="module-header">
                <div class="module-title">{{ ucfirst(trans('offline.update.update_to_latest')) }}</div>
            </div>
            <div class="module-body">

                <!-- Latest version -->
                <h4>@lang('offline.update.latest_version'): <span class="text-red-800">{{ $latest_version }}</span></h4>

                <!-- Release notes -->
                <h4>@lang('offline.update.release_notes')</h4>
                <div class="mb-8">
                    {!! $release_notes !!}
                </div>

                <!-- Release date -->
                <div class="mb-4">
                    <strong>@lang('offline.update.release_date')</strong>: {{ $release_date }}
                </div>

            </div>
            <div class="module-bar save-bar" >
                <!-- Current version -->
                <div class="message">
                    @lang('offline.update.current_version'): {{ $current_version }}
                </div>
                <div id="update_buttons" class="buttons">
                    <!-- Update later -->
                    <a class="btn-nav yellow mr-2" href="{{ url()->previous() }}">@lang('offline.update.update_later')</a>
                    <!-- Update now -->
                    <button type="button" class="btn-nav" onclick="apply_update()">@lang('offline.update.update_now')</button>
                </div>
                <!-- Update loading -->
                <div id="update_loading" class="hidden">
                    <span>{{ ucfirst(trans('offline.update.downloading')) }}... <i class="fa-solid fa-sync fa-spin text-2xl ml-2"></i></span>
                </div>
                <!-- Update errors -->
                <div id="update_errors" class="hidden">
                    <strong class="error">Error</strong>
                </div>
            </div>

        </div>

    {{-- ##### New Update Available: manual installation ##### --}}
    @elseif(SoftwareUpdater::isNewVersionAvailable() && $require_installation)

        <h1 class="mb-8">@lang('offline.update.new_version_available')</h1>

        <div class="module-container" id="module_settings_api_keys">
            <div class="module-header">
                <div class="module-title">{{ ucfirst(trans('offline.update.update_to_latest')) }}</div>
            </div>
            <div class="module-body">

                <!-- Latest version -->
                <h4>@lang('offline.update.latest_version'): <span class="text-red-800">{{ $latest_version }}</span></h4>

                <!-- Release notes -->
                <h4>@lang('offline.update.release_notes')</h4>
                <div class="mb-8">
                    {!! $release_notes !!}
                </div>

                <!-- Release date -->
                <div class="mb-4">
                    <strong>@lang('offline.update.release_date')</strong>: {{ $release_date }}
                </div>

                <!-- Download Installer -->
                <div class="mb-4 text-center text-2xl">
                    <div class="mb-4 font-bold">@lang('offline.update.require_installation')</div>
                    <a href="{{ $installer_url }}">@lang('offline.update.download_installer')</a>
                </div>


            </div>

        </div>


    {{-- ##### NO updates ##### --}}
    @else

        <h1 class="mb-8">@lang('offline.update.no_new_version')</h1>

        <div class="message">
            <a class="btn-nav mr-2" href="{{ url()->previous() }}">@lang('modular-forms::common.go_back')</a>
        </div>

    @endif

@endsection


@push('scripts')
    <script>

        function apply_update(){

            update_loading();

            let data = {
                'download_url': '{{ $download_url }}',
                'version': '{{ $latest_version }}',
            };

            fetch('{{ route('update.apply') }}', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-Token": window.Laravel.csrfToken,
                },
                body: JSON.stringify(data),
            })
                .then((response) => response.json())
                .then(function(data){
                    if (data.status === 'success') {
                        window.location.href = '{{ route('update.done') }}';
                    } else if(data.status === 'error') {
                        update_error();
                    }
                })
                .catch(function (error) {
                    update_error();
                });

        }

        function update_loading() {
            document.getElementById('update_loading').classList.remove('hidden');
            document.getElementById('update_buttons').classList.add('hidden');
            document.getElementById('update_errors').classList.add('hidden');
        }

        function update_error() {
            document.getElementById('update_loading').classList.add('hidden');
            document.getElementById('update_buttons').classList.add('hidden');
            document.getElementById('update_errors').classList.remove('hidden');
        }

    </script>

@endpush
