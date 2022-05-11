<?php
/** @var String $type */
/** @var String $value */
/** @var bool $only_label [optional] */

$value = $value==='' ? null : $value;
$only_label = $only_label ?? false;

?>

@include('imet-core::components.module.show.field', [
       'type' => $type,
       'value' => $value,
       'only_label' => $only_label
    ])

