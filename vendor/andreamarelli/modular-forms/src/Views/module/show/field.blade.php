<?php
/**
 * This is a simple wrapper which allows itself to be extended with custom type
 * (blade view can only be overwritten)
 */

/** @var String $type */
/** @var String $value */
/** @var bool $only_label [optional] */

$only_label = $only_label ?? false;

?>


@include('modular-forms::module.show.field-types', [
   'type' => $type,
   'value' => $value,
   'only_label' => $only_label
])

