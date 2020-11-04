<?php
/* @var String $name */
/* @var String $label */
/* @var String $value */
/* @var Integer $label_width */

$label = isset($label) ? $label : '';
$label_width = isset($label_width) ? $label_width : 2;
?>

@component('admin.components.module.components.row', [
        'name' => $name,
        'label' => $label,
        'label_width' => $label_width
    ])

    {{-- field preview --}}
    @include('admin.components.module.edit.field.preview', compact('value'))

@endcomponent