<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

$view_groupTable = View::make('admin.components.module.edit.type.group_table', compact(['collection', 'vue_data', 'definitions']))->render();

// Inject titles
$view_groupTable = App\Library\Ofac\Module::injectGroupTitle($view_groupTable, $definitions['module_key'], 'group0', trans('form/imet/v1/context.EcosystemServicesTendance.categories.title1'));
$view_groupTable = App\Library\Ofac\Module::injectGroupTitle($view_groupTable, $definitions['module_key'], 'group3', trans('form/imet/v1/context.EcosystemServicesTendance.categories.title2'));
$view_groupTable = App\Library\Ofac\Module::injectGroupTitle($view_groupTable, $definitions['module_key'], 'group6', trans('form/imet/v1/context.EcosystemServicesTendance.categories.title3'));

?>

{!! $view_groupTable !!}
@include('admin.components.module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))

@include('admin.components.module.edit.script', compact(['collection', 'vue_data', 'definitions']))
