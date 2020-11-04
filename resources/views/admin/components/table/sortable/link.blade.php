<?php
/** @var String $column */
/** @var String $label */
/** @var String $class */
$class = $class ?? '';

?>
<th class="text-center sortable_col {{ $class }}">
    @sortablelink($column, $label)
</th>