<?php
use \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\AnalysisStakeholderDirectUsers;
use \AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\Stakeholders;
use \Illuminate\Database\Eloquent\Collection;

/** @var Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

$form_id = $collection[0]['FormID'];

$stakeholders = Stakeholders::calculateWeights($form_id, Stakeholders::ONLY_DIRECT);
arsort($stakeholders);

$key_elements_importance = AnalysisStakeholderDirectUsers::calculateKeyElementsImportances($form_id, $records);
$current_stakeholder = 'summary';

?>

@include('imet-core::oecm.context.modules_show._analysis_stakeholders', [
    'collection' => $collection,
    'definitions' => $definitions,
    'records' => $records,
    'stakeholders' => $stakeholders,
    'key_elements_importance' => $key_elements_importance,
    'current_stakeholder' => $current_stakeholder,
    'summary_title' => trans('imet-core::oecm_context.AnalysisStakeholders.summary_direct')
])
