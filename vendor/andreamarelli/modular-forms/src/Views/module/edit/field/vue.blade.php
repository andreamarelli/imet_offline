<?php
/**
 * This is a simple wrapper which allows itself to be extended with custom type
 * (blade view can only be overwritten)
 */

/** @var String $type */
/** @var String $v_value */
/** @var String $id [optional] */
/** @var String $class [optional] */
/** @var String $rules [optional] */
/** @var String $other [optional] */
/** @var String $module_key [optional] */

?>


@include('modular-forms::module.edit.field.vue-types', [
        'type' => $type,
        'v_value' => $v_value,
        'id' => $id,
        'class' => $class ?? null,
        'rules' => $rules ?? null,
        'other' => $other ?? null,
        'module_key' => $module_key ?? null
    ])