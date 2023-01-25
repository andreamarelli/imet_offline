<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

$new_records = AndreaMarelli\ModularForms\Helpers\Module::createRecordsArrayByGroup($records);

$view_groupTable = \Illuminate\Support\Facades\View::make('modular-forms::module.show.type.group_table', compact(['collection', 'records', 'definitions']))->render();

// Inject titles
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['module_key'], 'group0', trans('imet-core::v1_context.EcosystemServices.categories.title1'));
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['module_key'], 'group3', trans('imet-core::v1_context.EcosystemServices.categories.title2'));
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['module_key'], 'group6', trans('imet-core::v1_context.EcosystemServices.categories.title3'));

// Inject average calculation
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group0', 4, 2, '', AndreaMarelli\ModularForms\Helpers\Module::calculateAverage('Importance', 'group0', $new_records));
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group1', 4, 2, '', AndreaMarelli\ModularForms\Helpers\Module::calculateAverage('Importance', 'group1', $new_records));
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group2', 4, 2, '', AndreaMarelli\ModularForms\Helpers\Module::calculateAverage('Importance', 'group2', $new_records));
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group3', 4, 2, '', AndreaMarelli\ModularForms\Helpers\Module::calculateAverage('Importance', 'group3', $new_records));
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group4', 4, 2, '', AndreaMarelli\ModularForms\Helpers\Module::calculateAverage('Importance', 'group4', $new_records));
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group5', 4, 2, '', AndreaMarelli\ModularForms\Helpers\Module::calculateAverage('Importance', 'group5', $new_records));
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group6', 4, 2, '', AndreaMarelli\ModularForms\Helpers\Module::calculateAverage('Importance', 'group6', $new_records));
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group7', 4, 2, '', AndreaMarelli\ModularForms\Helpers\Module::calculateAverage('Importance', 'group7', $new_records));
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group8', 4, 2, '', AndreaMarelli\ModularForms\Helpers\Module::calculateAverage('Importance', 'group8', $new_records));
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group9', 4, 2, '', AndreaMarelli\ModularForms\Helpers\Module::calculateAverage('Importance', 'group9', $new_records));


?>

{!! $view_groupTable !!}
@include('modular-forms::module.show.type.commons', compact(['collection', 'definitions']))

