<?php
/** @var String $onClick */
/** @var String $label */
/** @var String $icon */
/** @var String $iconColor */

$onClick = $onClick ?? 'addItem';
$label = $label ?? trans('common.add_item');
$icon = $icon ?? 'plus-circle';
$iconColor = $iconColor ?? 'white';

?>


<button type="button"
        class="btn btn-success btn-sm " v-on:click="{!! $onClick !!}">
    {!! App\Library\Utils\Template::icon($icon, $iconColor) !!} {!! ucfirst($label) !!}
</button>