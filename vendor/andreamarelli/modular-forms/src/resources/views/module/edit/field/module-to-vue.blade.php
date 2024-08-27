<?php
/** @var Mixed $definitions  */
/** @var Mixed $field  */
/** @var String $vue_record_index  */
/** @var String $vue_directives  [optional]  */

$class =  $field['class'] ?? '';
$rules =  $field['rules'] ?? '';
$other =  $field['other'] ?? '';
$other .= $vue_directives ?? '';

$v_value = 'records['.$vue_record_index.'].'.$field['name'];
$id = "'".$definitions['module_key']."_'+".$vue_record_index."+'_".$field['name']."'";
$type = $field['type'];

?>

@include('modular-forms::module.edit.field.vue', [
    'type' => $type,
    'v_value' => $v_value,
    'id' => $id,
    'class' => $class,
    'rules' => $rules,
    'other' => $other,
    'module_key' => $definitions['module_key']
])

