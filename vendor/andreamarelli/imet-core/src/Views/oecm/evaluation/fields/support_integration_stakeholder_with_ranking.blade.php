<?php
/** @var String $type */
/** @var String $v_value */
/** @var String $id */
/** @var String $class */
/** @var String $rules */
/** @var String $other */
/** @var Mixed $definitions */

$group_key = \Illuminate\Support\Str::replace('records[', '', $v_value);
$group_key = \Illuminate\Support\Str::replace('][index].Stakeholder', '', $group_key);

$score = 'records['.$group_key.'][index][\'__score\']';

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
    <div v-if={{ $score }}!==null>
        <b>@lang('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.ranking')</b>
        <span v-html="parseFloat({{ $score }}).toFixed(2)"></span>
    </div>
</div>
