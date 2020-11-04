<?php
/**
 *  Input rating type (custom variant for IMET - includes tooltip legend)
 */

/** @var String $v_model */
/** @var String $v_bind_id */
/** @var String $class */
/** @var String $other */
/** @var String $rules */
/** @var String $type */
/** @var String $module_key */

// Set Vue attributes
$vue_attributes = $v_model . ' ' .$v_bind_id;

// retrieve legend
$fieldName = explode('.',rtrim($v_model, '"'))[1];
$className = \App\Models\Components\ModuleKey::KeyToClassName($module_key);
$legend = (new $className())->ratingLegend;
$legend = array_key_exists($fieldName, $legend) ? $legend[$fieldName] : [];
$legend = array_values($legend);

// retrieve rating type
$ratingType = explode('-', $type)[2];
?>

<rating
    rating-type="{{ $ratingType }}"
    :legend='@json($legend)'
    {!! $vue_attributes !!} data-class="{!! $class !!}" {!! $rules !!} {!! $other !!}
></rating>