<?php
/** @var Mixed $definitions */

$table_id = 'table_'.$definitions['module_key'];

?>

@include('admin.components.module.edit.field.vue', [
                'type' => 'hidden',
                'v_value' => 'records[index].Equipment',
                'id' => "'".$definitions['module_key']."_'+index+'_Equipment'"
            ])
@include('admin.components.module.edit.field.vue', [
    'type' => 'disabled',
    'v_value' => 'records[index].__predefined_label',
    'class' => 'field-disabled'
])