<?php
/** @var String $onClick */
/** @var String $label */
/** @var String $icon */
/** @var String $iconColor */

$onClick = $onClick ?? 'addItem';
$label = $label ?? trans('modular-forms::common.add_item');
$icon = $icon ?? 'plus-circle';
$iconColor = $iconColor ?? 'white';

?>


<button type="button"
        class="btn-nav small " v-on:click="{!! $onClick !!}">
    {!! AndreaMarelli\ModularForms\Helpers\Template::icon($icon, $iconColor) !!} {!! ucfirst($label) !!}
</button>
