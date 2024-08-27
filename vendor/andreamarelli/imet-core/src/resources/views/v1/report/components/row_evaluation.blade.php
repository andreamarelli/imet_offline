<?php
/** @var string $assessment_value */

/** @var string $assessment_label */
/** @var string $additional_classes [optional] */

/** @var boolean $threats [optional] */

use AndreaMarelli\ImetCore\Controllers\Imet\ApiController;

$assessment_value   = $assessment_value ?? null;
$additional_classes = $additional_classes ?? null;
$threats            = $threats ?? false;

$classes = $threats
    ? ApiController::score_class_threats($assessment_value)
    : ApiController::score_class($assessment_value);

?>

<td class="{!! $classes . ' ' . $additional_classes !!}">{{  $assessment_label }}
    <div>{{ $assessment_value ?? ' - ' }}</div>
</td>
