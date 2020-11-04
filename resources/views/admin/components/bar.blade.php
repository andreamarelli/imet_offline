<?php
/** @var String $class */
/** @var String $label */
/** @var String $other */

$class = isset($class) ? $class : '';
$label = isset($label) ? $label : '';
$other = isset($other) ? $other : '';

?>
<div class="module-bar {{ $class }}" {!! $other !!} >
    <div class="message">
        {{ $label }}
    </div>
</div>