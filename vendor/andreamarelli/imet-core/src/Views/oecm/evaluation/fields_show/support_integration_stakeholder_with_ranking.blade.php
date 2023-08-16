<?php
/** @var String $type */
/** @var String $value */
/** @var bool $only_label */

$score = $record['__score'];

?>

<div class="field-preview">
    {{ $value }}
</div>


<div class="text-left text-xs" style="padding: 4px 4px 0 4px;">
    @if($score!==null)
        <div>
            <b>@lang('imet-core::oecm_evaluation.SupportsAndConstraintsIntegration.ranking')</b>
            <span>{{ round((float) $score, 2) }}</span>
        </div>
    @endif
</div>