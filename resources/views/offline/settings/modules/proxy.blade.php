<?php
/** @var Array $vueData */

use AndreaMarelli\ModularForms\Helpers\DOM;
use AndreaMarelli\ModularForms\Helpers\Template;

?>

<div class="module-container" id="module_settings_proxy">
    <div class="module-header">
        <div class="module-title">{{ ucfirst(trans('offline.settings.proxy.title')) }}</div>
    </div>
    <div class="module-bar info-bar">
        <div class="icon">{!! Template::icon('info-circle', '', '1.4em') !!}</div>
        <div class="message">@lang('offline.settings.proxy.info')</div>
    </div>
    <div class="module-body p-2">

        @foreach(['proxy_host', 'proxy_port', 'proxy_user'] as $field)
            @component('modular-forms::module.components.field_container', [
                'name' => $field,
                'label' => ucfirst(trans('offline.settings.proxy.fields.'.$field)),
                'label_width' => 2
            ])
                <simple-text {!! DOM::vueAttributes("'$field'", 'records.' . $field) !!}></simple-text>
            @endcomponent
        @endforeach

        @component('modular-forms::module.components.field_container', [
            'name' => 'proxy_password',
            'label' => ucfirst(trans('offline.settings.proxy.fields.proxy_password')),
            'label_width' => 2
        ])
            <simple-password {!! DOM::vueAttributes("'proxy_password'", 'records.proxy_password') !!}></simple-password>
        @endcomponent

    </div>
    @include('modular-forms::module.components.bars.save')
</div>


@push('scripts')
    <script type="module">

        (new window.OfflineImet.SettingsApp(@json($vueData + ['module_key' => 'proxy'])))
                .mount('#module_settings_proxy');

    </script>
@endpush
