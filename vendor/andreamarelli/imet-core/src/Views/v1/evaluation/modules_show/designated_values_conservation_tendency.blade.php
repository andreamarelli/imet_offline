<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

$new_records = AndreaMarelli\ModularForms\Helpers\Module::createRecordsArrayByGroup($records);

$view_groupTable = \Illuminate\Support\Facades\View::make('modular-forms::module.show.type.group_table', compact(['collection', 'records', 'definitions']))->render();

// Inject Average calculation
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group0', 3, 2, '', AndreaMarelli\ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group0', $new_records));
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group1', 3, 2, '', AndreaMarelli\ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group1', $new_records));
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group2', 3, 2, '', AndreaMarelli\ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group2', $new_records));
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group3', 3, 2, '', AndreaMarelli\ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group3', $new_records));
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group4', 3, 2, '', AndreaMarelli\ModularForms\Helpers\Module::calculateAverage('EvaluationScore', 'group4', $new_records));


?>

{!! $view_groupTable !!}
@include('modular-forms::module.show.type.commons', compact(['collection', 'records', 'definitions']))
