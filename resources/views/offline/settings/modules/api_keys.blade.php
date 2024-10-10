<?php
/** @var Array $vueData */

use AndreaMarelli\ModularForms\Helpers\DOM;

?>

<div class="module-container" id="module_settings_api_keys">
    <div class="module-header">
        <div class="module-title">{{ ucfirst(trans('offline.settings.api_keys.title')) }}</div>
    </div>
    <div class="module-body">

        @component('modular-forms::module.components.field_container', [
            'name' => 'protected_planet_api_key',
            'label' => ucfirst(trans('offline.settings.api_keys.fields.protected_planet_api_key')),
            'label_width' => 2
        ])
            <simple-text {!! DOM::vueAttributes("'protected_planet_api_key'", 'records.protected_planet_api_key') !!}></simple-text>
            <span class="italic ml-2">@lang('offline.settings.api_keys.protected_planet_api_key_description')</span>
        @endcomponent

    </div>
    @include('modular-forms::module.components.bars.save')

</div>


@push('scripts')
    <script type="module">

        (new window.OfflineImet.SettingsApp(@json($vueData + ['module_key' => 'api_keys'])))
            .mount('#module_settings_api_keys');

    </script>
@endpush
