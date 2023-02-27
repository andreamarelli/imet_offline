@include('modular-forms::module.edit.field.vue', [
    'type' => 'disabled',
    'v_value' => 'records[index].__weight',
    'id' => "'".$definitions['module_key']."_'+index+'__weight'",
    'other' => 'style="width: 100px; text-align: center;"'
])
