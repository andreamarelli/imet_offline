<?php
/**
 *  Input rating type (custom variant for IMET - includes tooltip legend)
 */

/** @var String $v_value */
/** @var String $v_id */
/** @var String $class  */
/** @var String $other [optional] */
/** @var String $rules */
/** @var String $type */
/** @var String $module_key */

$vue_attributes = \AndreaMarelli\ModularForms\Helpers\DOM::vueAttributes($v_id, $v_value);

// retrieve legend
$fieldName = explode('.', rtrim($v_value, '"'))[1];
$className = \AndreaMarelli\ModularForms\Helpers\ModuleKey::KeyToClassName($module_key);
$legend = (new $className())->ratingLegend;
$legend = array_key_exists($fieldName, $legend) ? $legend[$fieldName] : [];
$legend = array_values($legend);

// retrieve rating type
$type_as_array = explode('-', $type);
$ratingType = end($type_as_array);
?>

<rating
    rating-type="{{ $ratingType }}"
    :legend='@json($legend)'
    {!! $vue_attributes !!}
    data-{!! $class !!}
    {!! $rules !!}
    {!! $other !!}
></rating>
