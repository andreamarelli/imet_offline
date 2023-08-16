<?php
/** @var String $type */
/** @var String $value */
/** @var bool $only_label */

$group_stakeholders = $record['__group_stakeholders'];
$num_stakeholders = $record['__num_stakeholders'];

?>

<div class="field-preview">
    {{ $value }}
</div>


<div class="text-left text-xs" style="padding: 4px 4px 0 4px;">
    @if($group_stakeholders!==null)
        <div>
            @lang('imet-core::oecm_evaluation.KeyElements.from_group'):
            <b>{!! $group_stakeholders !!}</b>
        </div>
    @endif
    @if($num_stakeholders!==null)
        <div>
            @lang('imet-core::oecm_evaluation.KeyElements.num_stakeholders', ['num' => '<b>'.$num_stakeholders.'</b>'])
        </div>
    @endif
</div>