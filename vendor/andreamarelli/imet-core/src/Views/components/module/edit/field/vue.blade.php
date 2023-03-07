<?php
/** @var String $type */
/** @var String $v_value */
/** @var String $id [optional] */
/** @var String $class [optional] */
/** @var String $rules [optional] */
/** @var String $other [optional] */
/** @var String $module_key */

$id = $id ?? '';
$class = $class ?? '';
$rules = $rules ?? '';
$other = $other ?? '';

?>


{{-- ###### IMET ###### --}}
@if(\Illuminate\Support\Str::startsWith($type, 'imet-core::'))

    @include('imet-core::components.vue-types', [
            'type' => $type,
            'v_value' => $v_value,
            'id' => $id,
            'class' => $class,
            'rules' => $rules,
            'other' => $other,
            'module_key' => $module_key ?? null
        ])

{{-- ###### Standard vendor (modular-forms) view ###### --}}
@else

    @include('modular-forms::module.edit.field.vue-types', [
        'type' => $type,
        'v_value' => $v_value,
        'id' => $id,
        'class' => $class,
        'rules' => $rules,
        'other' => $other,
        'module_key' => $module_key ?? null
    ])

@endif
