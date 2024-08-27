<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

$vue_record_index = \Illuminate\Support\Str::contains($definitions['module_type'], 'ACCORDION') ? 'index' : '0';

?>

    @foreach($definitions['fields'] as $field)

        @component('modular-forms::module.components.field_container', [
                'name' => $field['name'],
                'label' => $field['label'] ?? '',
                'label_width' => $definitions['label_width']
            ])

            {{-- input field --}}
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => $vue_record_index
            ])

        @endcomponent

    @endforeach
