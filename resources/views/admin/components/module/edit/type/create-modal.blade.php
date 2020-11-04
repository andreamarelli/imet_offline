<?php
/** @var Mixed $definitions */
/** @var Mixed $data [optional] */
$data = isset($data) ? $data : [];

?>

<div class="module-rows">
@foreach($definitions['fields'] as $field)

    @component('admin.components.module.components.row', [
               'name' => $field['name'],
               'label' => isset($field['label']) ? $field['label'] : '',
               'label_width' => $definitions['label_width']
           ])

        {{-- input field --}}
        @include('admin.components.module.edit.field.field', [
            'type' => $field['type'],
            'id' => $field['name'],
            'value' => isset($data[$field['name']]) ? $data[$field['name']] : ''
        ])

    @endcomponent

@endforeach
</div>
