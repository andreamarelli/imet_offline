<?php
/** @var int $form_id */
/** @var string $version */

$labels = \AndreaMarelli\ImetCore\Controllers\Imet\Assessment::assessment_steps_labels();

?>

<imet_charts :form_id={{ $form_id }} :labels='@json($labels)'></imet_charts>
