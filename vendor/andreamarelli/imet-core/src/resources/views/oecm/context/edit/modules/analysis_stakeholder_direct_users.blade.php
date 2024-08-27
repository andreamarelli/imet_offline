<?php

use \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\Stakeholders;
use Illuminate\Database\Eloquent\Collection;

/** @var Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

$stakeholders = Stakeholders::calculateWeights($vueData['form_id'], Stakeholders::ONLY_DIRECT);
arsort($stakeholders);

?>

@include('imet-core::oecm.context.edit.modules._analysis_stakeholders', [
    'collection' => $collection,
    'definitions' => $definitions,
    'vueData' => $vueData,
    'stakeholders' => $stakeholders
])
