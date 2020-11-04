<?php
/** @var String $column */
/** @var String $label */
/** @var String $class */
$class = $class ?? '';

?>

<th class="text-center {{ $class }}" @click="sort('{{ $column }}')">
    {{ $label }} <i class="fa fa-sort" />
</th>