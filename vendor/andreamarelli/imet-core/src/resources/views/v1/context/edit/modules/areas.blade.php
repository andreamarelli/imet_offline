<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

$vue_record_index = '0';

?>

@foreach($definitions['fields'] as $field_index => $field)

    @component('modular-forms::module.components.field_container', [
            'name' => $field['name'],
            'label' => $field['label'] ?? '',
            'label_width' => $definitions['label_width']
        ])


        @if(in_array($field_index, [0, 1, 2]))

            {{-- input field --}}
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => $vue_record_index,
                'vue_directives' => '@input=convertToKm("' . $field['name'] . '")'
            ])
            <span class="ml-2 mr-4">[ha]</span>

            @include('modular-forms::module.edit.field.vue', [
                'type' => $field['type'],
                'v_value' => $field['name'].'_km2',
                'id' =>"'".$definitions['module_key'].\AndreaMarelli\ModularForms\Helpers\ModuleKey::separator.$field['name']."_km2'",
                'other' => '@input=convertToHa("' . $field['name'] . '")'
            ])
            <span class="ml-2">[km2]</span>

        @else

            {{-- input field --}}
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => $vue_record_index
            ])

        @endif

    @endcomponent

@endforeach

@push('scripts')
    <style>
        #module_imet__v1__context__areas .module-row__input div{
            display: inline-block;
        }
    </style>

    <script type="module">
        window.imet__v1__context__areas = (new window.ImetCore.Apps.Modules.ImetV1.context.Areas(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush

