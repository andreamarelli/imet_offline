<?php
/** @var Array $countries */
/** @var Array $updated_pas_countries */

use AndreaMarelli\ModularForms\Helpers\DOM;
use AndreaMarelli\ModularForms\Helpers\Template;

?>


<div class="module-container" id="module_settings_protected_areas">
    <div class="module-header">
        <div class="module-title">{{ ucfirst(trans('offline.settings.protected_areas.title')) }}</div>
    </div>
    <div class="module-bar info-bar">
        <div class="icon">{!! Template::icon('info-circle', '', '1.4em') !!}</div>
        <div class="message">@lang('offline.settings.protected_areas.info')</div>
    </div>
    <div class="module-body py-4">

        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
            @foreach($countries as $country)
                <PasCountryUpdate
                    iso2="{{ $country->iso2 }}"
                    iso3="{{ $country->iso3 }}"
                    name="{{ $country->name }}"
                    :downloaded="{{ in_array($country->iso3, array_keys($updated_pas_countries)) ? 'true': 'false' }}"
                    updated="{{ $updated_pas_countries[$country->iso3] ?? null }}"
                    update-url="{{ route('settings.update_pas') }}"
                ></PasCountryUpdate>
            @endforeach
        </div>

    </div>

</div>


@push('scripts')
    <script type="module">

        (new window.OfflineImet.PaUpdate())
            .mount('#module_settings_protected_areas');

    </script>
@endpush

