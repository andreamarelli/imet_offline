<?php

/** @var String $v_model */
/** @var String $v_bind_id */
/** @var String $class  */
/** @var String $other [optional] */

$vue_attributes = $v_model . ' ' .$v_bind_id;

?>

<input type="hidden" {!! $vue_attributes !!} class="{!! $class !!}" {!! $other !!} />
<div class="field-disabled">@{{ {!! $v_value !!} }}</div>