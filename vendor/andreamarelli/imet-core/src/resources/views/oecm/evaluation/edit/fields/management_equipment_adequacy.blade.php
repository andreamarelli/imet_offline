<?php
/** @var Mixed $definitions */

$table_id = 'table_'.$definitions['module_key'];

?>

@include('modular-forms::module.edit.field.vue', [
    'type' => 'hidden',
    'v_value' => 'records[index].Equipment',
    'id' => "'".$definitions['module_key']."_'+index+'_Equipment'"
])
@include('modular-forms::module.edit.field.vue', [
    'type' => 'disabled',
    'v_value' => 'records[index].__predefined_label',
    'id' => "'".$definitions['module_key']."_'+index+'_Equipment-predefined_label'",
    'class' => 'field-disabled'
])
