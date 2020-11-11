<?php
/** @var Mixed $definitions */
/** @var Mixed $data [optional] */
$data = $data ?? [];

?>

<div class="module-rows">
@foreach($definitions['fields'] as $field)

    @component('admin.components.module.components.row', [
               'name' => $field['name'],
               'label' => $field['label'] ?? '',
               'label_width' => $definitions['label_width']
           ])

        {{-- input field --}}
        @include('admin.components.module.edit.field.field', [
            'type' => $field['type'],
            'id' => $field['name'],
            'value' => $data[$field['name']] ?? ''
        ])

    @endcomponent

@endforeach
</div>
