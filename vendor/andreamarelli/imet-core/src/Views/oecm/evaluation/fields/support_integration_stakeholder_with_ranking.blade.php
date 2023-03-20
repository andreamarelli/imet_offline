<?php
/** @var String $type */
/** @var String $v_value */
/** @var String $id */
/** @var String $class */
/** @var String $rules */
/** @var String $other */
/** @var Mixed $definitions */

?>

@include('modular-forms::module.edit.field.vue', [
    'type' => 'disabled',
    'v_value' => $v_value,
    'id' => $id,
    'class' => $class,
    'rules' => $rules,
    'other' => $other,
    'module_key' => $definitions['module_key']
])

<div class="text-left text-xs" style="padding: 4px 4px 0 4px;">
    <div v-if=records[index]['__score']!==null>
        <b>@lang('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.ranking')</b>
        <span>@{{ parseFloat(records[index]['__score']).toFixed(2) }}</span>
    </div>
</div>
