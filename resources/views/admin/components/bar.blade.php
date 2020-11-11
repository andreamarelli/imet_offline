<?php
/** @var String $class */
/** @var String $label */
/** @var String $other */

$class = $class ?? '';
$label = $label ?? '';
$other = $other ?? '';

?>
<div class="module-bar {{ $class }}" {!! $other !!} >
    <div class="message">
        {{ $label }}
    </div>
</div>
