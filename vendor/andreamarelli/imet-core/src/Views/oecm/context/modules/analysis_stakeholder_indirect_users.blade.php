<?php

use \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\AnalysisStakeholderIndirectUsers;
use \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\Stakeholders;
use Illuminate\Database\Eloquent\Collection;

/** @var Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

$stakeholders = Stakeholders::calculateWeights($vue_data['form_id'],  Stakeholders::ONLY_INDIRECT);
arsort($stakeholders);

$vue_data['current_stakeholder'] = 'summary';
$vue_data['key_elements_importance'] = AnalysisStakeholderIndirectUsers::calculateKeyElementsImportances($vue_data['form_id'], $vue_data['records']);

?>

@include('imet-core::oecm.context.modules._analysis_stakeholders', [
    'collection' => $collection,
    'definitions' => $definitions,
    'vue_data' => $vue_data,
    'stakeholders' => $stakeholders,
])