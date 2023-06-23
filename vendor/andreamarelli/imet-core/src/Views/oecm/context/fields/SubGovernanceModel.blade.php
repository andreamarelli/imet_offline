<?php
/** @var String $type */
/** @var String $v_value */
/** @var String $id */
/** @var String $class */
/** @var String $rules */
/** @var String $other */
/** @var Mixed $definitions */


$vue_attributes = \AndreaMarelli\ModularForms\Helpers\DOM::vueAttributes($id, $v_value);
$rules_attribute = \AndreaMarelli\ModularForms\Helpers\DOM::rulesAttribute($rules);
$other_attributes = $other ?? '';

?>

<dropdown
    :data-values=SubGovernanceModel_options
    {!! $vue_attributes !!} {!! $rules_attribute !!} {!! $other_attributes !!}
></dropdown>