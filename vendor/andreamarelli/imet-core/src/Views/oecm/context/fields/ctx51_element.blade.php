<?php
/** @var String $type */
/** @var String $v_value */
/** @var String $id */
/** @var String $class */
/** @var String $rules */
/** @var String $other */
/** @var Mixed $definitions */

use \AndreaMarelli\ModularForms\Helpers\DOM;

$re = '/records\[\'([\w\d]+)\'\]\[index\].Element/m';
preg_match_all($re, $v_value, $matches);
$group = $matches[1][0];

?>

<simple-textarea
    :disabled="predefined_values.values['{{ $group }}'].includes({{ $v_value }})"
    {!! DOM::vueAttributes($id, $v_value) !!}
    {!! DOM::rulesAttribute($rules) !!}
></simple-textarea>

