@include('modular-forms::module.edit.field.vue', [
    'type' => 'disabled',
    'v_value' => 'records[index].__adequacy',
    'id' => "'".$definitions['module_key']."_'+index+'___adequacy'",
    'other' => 'style="width: 100px; text-align: center;"'
])
