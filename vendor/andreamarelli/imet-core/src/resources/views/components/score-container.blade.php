<?php
use AndreaMarelli\ImetCore\Models\Imet;

/** @var String $step */
/** @var Imet\v1\Imet|Imet\v2\Imet|Imet\oecm\Imet $item */

?>

<div class="module-container">
    <div class="module-header">
        <div class="module-title">
            @lang('imet-core::common.steps_eval.management_effectiveness')
        </div>
    </div>
    <div class="module-body">
        @include('imet-core::components.scores', [
            'item' => $item,
            'step' => $step
        ])
    </div>
</div>
