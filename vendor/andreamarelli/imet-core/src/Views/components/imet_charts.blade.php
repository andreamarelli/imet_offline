<?php
/** @var int $form_id */
/** @var string $version */

$labels = \AndreaMarelli\ImetCore\Services\Scores\ImetScores::labels();

?>

<imet_charts
        :form_id={{ $form_id }}
        :labels='@json($labels)'
        version='{{ $version }}'
></imet_charts>
