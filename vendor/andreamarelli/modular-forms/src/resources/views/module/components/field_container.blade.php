<?php
/** @var String     $name */
/** @var String     $label */
/** @var int    $label_width */
/** @var String   $other_attributes */

$label_width = $label_width ?? 3;

$style_width = $label_width!==3
    ? 'style="width: '.round(100/12*$label_width).'%;"'      // bootstrap col-lg-x to %
    : '';

$other_attributes = $other_attributes ?? '';

?>

<div class="module-row" {!! $other_attributes !!}>

    {{-- label  --}}
    <div class="module-row__label" {!! $style_width !!}>
        @if($label!='')
            <label for="{{ $name }}">{!! ucfirst($label) !!}</label>
        @endif
    </div>

    {{-- input field --}}
    <div  class="module-row__input">
        {!! $slot  !!}
    </div>

</div>
