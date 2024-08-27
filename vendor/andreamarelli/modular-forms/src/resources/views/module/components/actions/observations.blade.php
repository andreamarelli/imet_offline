<?php
use AndreaMarelli\ModularForms\View\Module\Container;

?>

@if($has_observations)

    {{-- Keep "observation" field even if data status is set not applicable/available --}}
    <div class="module_body" v-if="isNotApplicable || isNotAvailable">

        @foreach($observation_fields as $observation_field)

            @component('modular-forms::module.components.field_container', [
                    'name' => $observation_field['name'],
                    'label' => $observation_field['label'] ?? '',
                    'label_width' => $definitions['label_width']
                ])

                {{-- input field --}}
                @include('modular-forms::module.edit..field.module-to-vue', [
                    'definitions' => $definitions,
                    'field' => $observation_field,
                    'vue_record_index' => '0'
                ])

            @endcomponent

        @endforeach

    </div>

@endif

