<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

$vue_record_index = $definitions['module_type']==="ACCORDION" || $definitions['module_type']==="GROUP_ACCORDION"
    ? 'index' : '0';

?>

    @foreach($definitions['fields'] as $field)

        @component('admin.components.module.components.row', [
                'name' => $field['name'],
                'label' => isset($field['label']) ? $field['label'] : '',
                'label_width' => $definitions['label_width']
            ])

            {{-- input field --}}
            @include('admin.components.module.edit.field.auto_vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => $vue_record_index
            ])

        @endcomponent

    @endforeach
