<?php
/** @var Mixed $definitions  */
/** @var Mixed $field  */
/** @var String $vue_record_index  */
/** @var String $vue_directives  [optional]  */
/** @var String $group_key  [optional] only used with GROUP_ACCORDION or GROUP_TABLE */

$class =  $field['class'] ?? '';
$rules =  $field['rules'] ?? '';
$other =  $field['other'] ?? '';
$other .= $vue_directives ?? '';

$v_value = 'records['.$vue_record_index.'].'.$field['name'];
$id = "'".$definitions['module_key']."_'+".$vue_record_index."+'_".$field['name']."'";
$type = $field['type'];

// Add an additional level (group) on record keys and id (only for GROUP_ACCORDION and GROUP_TABLE)
if($definitions['module_type']==="GROUP_ACCORDION" || $definitions['module_type']==="GROUP_TABLE"){
    $v_value = 'records[\''.$group_key.'\']['.$vue_record_index.'].'.$field['name'];
    $id = "'".$definitions['module_key']."_".$group_key."_'+".$vue_record_index."+'_".$field['name']."'";
}

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

