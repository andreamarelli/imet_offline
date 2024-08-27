<?php
/** @var Mixed $definitions */
/** @var Mixed $data [optional] */
$data = $data ?? [];

?>

<div class="module-rows">
@foreach($definitions['fields'] as $field)

    @component('modular-forms::module.components.field_container', [
               'name' => $field['name'],
               'label' => $field['label'] ?? '',
               'label_width' => $definitions['label_width']
           ])

        {{-- input field --}}
        @include('modular-forms::module.edit.field.plain', [
            'type' => $field['type'],
            'id' => $field['name'],
            'value' => $data[$field['name']] ?? ''
        ])

    @endcomponent

@endforeach
</div>
