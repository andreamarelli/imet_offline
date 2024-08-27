<?php

use \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\Stakeholders;
use \Illuminate\Database\Eloquent\Collection;

/** @var Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

$form_id = $collection[0]['FormID'];

$stakeholders = Stakeholders::calculateWeights($form_id, Stakeholders::ONLY_INDIRECT);
arsort($stakeholders);

?>

@include('imet-core::oecm.context.show.modules._analysis_stakeholders', [
    'collection' => $collection,
    'definitions' => $definitions,
    'records' => $records,
    'stakeholders' => $stakeholders
])
