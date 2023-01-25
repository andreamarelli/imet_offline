<?php
/** @var string $assessment_value */

/** @var string $assessment_label */
/** @var string $additional_classes [optional] */

/** @var boolean $threats [optional] */

use AndreaMarelli\ImetCore\Controllers\Imet\Traits\Assessment;

$assessment_value   = $assessment_value ?? null;
$additional_classes = $additional_classes ?? null;
$threats            = $threats ?? false;

$classes = $threats
    ? Assessment::score_class_threats($assessment_value, $additional_classes)
    : Assessment::score_class($assessment_value, $additional_classes);

?>

<td {!! $classes !!}>{{  $assessment_label }}
    <div>{{ $assessment_value ?? ' - ' }}</div>
</td>
