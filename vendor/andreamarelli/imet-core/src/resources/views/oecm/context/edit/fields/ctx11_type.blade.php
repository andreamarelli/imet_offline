<?php
/** @var String $type */
/** @var String $v_value */
/** @var String $id */
/** @var String $class */
/** @var String $rules */
/** @var String $other */
/** @var Mixed $definitions */



?>

<label class="radio-inline">
    <input name="{{ $id }}" {!! $vue_attributes !!} type="radio" value="terrestrial" />
    {{ trans('imet-core::oecm_lists.PaType.terrestrial') }}
</label>


<label class="radio-inline">
    <input name="{{ $id }}" {!! $vue_attributes !!} type="radio" value="marine_and_coastal" />
    {{ trans('imet-core::oecm_lists.PaType.marine_and_coastal') }}
</label>

<label class="radio-inline">
    <input name="{{ $id }}" {!! $vue_attributes !!} type="radio" value="mixed" />
    {{ trans('imet-core::oecm_lists.PaType.mixed') }}
</label>
