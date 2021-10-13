<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

$vue_record_index = '0';

$group_key = '';
if($definitions['module_type']=="GROUP_TABLE" || $definitions['module_type']=="GROUP_ACCORDION"){
    reset($definitions['groups']);
    $group_key = key($definitions['groups']);
}

?>

    @foreach($definitions['common_fields'] as $field)

        @component('modular-forms::module.field_container', [
                'name' => $field['name'],
                'label' => $field['label'] ?? '',
                'label_width' => $definitions['label_width']
            ])

            {{-- input field --}}
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => $vue_record_index,
                'group_key' => $group_key
            ])

        @endcomponent

    @endforeach
