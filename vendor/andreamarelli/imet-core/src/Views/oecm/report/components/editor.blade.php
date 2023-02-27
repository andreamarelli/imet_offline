<?php
/** @var string $action */
/** @var string $field */
/** @var array $report */

?>

@if($action==='edit')
    <editor v-model=report.{{ $field }} v-on:update="report.{{ $field }} = $event"></editor>
@elseif($action==='show')
    <div class="field-preview" style="max-width: none; margin-bottom: 10px;">
        {!! $report[$field] !!}
    </div>
@endif
