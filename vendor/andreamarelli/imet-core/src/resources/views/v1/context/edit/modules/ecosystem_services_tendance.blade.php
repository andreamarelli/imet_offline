<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

$view_groupTable = \Illuminate\Support\Facades\View::make('modular-forms::module.edit.type.group_table', compact(['collection', 'vueData', 'definitions']))->render();

// Inject titles
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['module_key'], 'group0', trans('imet-core::v1_context.EcosystemServicesTendance.categories.title1'));
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['module_key'], 'group3', trans('imet-core::v1_context.EcosystemServicesTendance.categories.title2'));
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectGroupTitle($view_groupTable, $definitions['module_key'], 'group6', trans('imet-core::v1_context.EcosystemServicesTendance.categories.title3'));

?>

{!! $view_groupTable !!}
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

@include('modular-forms::module.edit.script', compact(['collection', 'vueData', 'definitions']))
