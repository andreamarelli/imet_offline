<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

$view_groupTable = \Illuminate\Support\Facades\View::make('modular-forms::module.show.type.group_table', compact(['collection', 'records', 'definitions']))->render();

// Inject titles
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['module_key'], 'group0', trans('imet-core::v1_context.EcosystemServicesTendance.categories.title1'));
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['module_key'], 'group3', trans('imet-core::v1_context.EcosystemServicesTendance.categories.title2'));
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['module_key'], 'group6', trans('imet-core::v1_context.EcosystemServicesTendance.categories.title3'));

?>

{!! $view_groupTable !!}
@include('modular-forms::module.show.type.commons', compact(['collection', 'definitions']))

