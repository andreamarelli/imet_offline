<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component\ImetModule;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\IntelligenceImplementation;
use Illuminate\Support\Facades\View;

$view_groupTable = View::make('modular-forms::module.edit.type.group_table', compact(['collection', 'vueData', 'definitions']))->render();

// Inject marine/terrestrial icon on title
$view_groupTable = ImetModule::injectIconToGroups($view_groupTable, IntelligenceImplementation::get_marine_groups(), IntelligenceImplementation::get_terrestrial_groups());

?>

{!! $view_groupTable !!}
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

@include('modular-forms::module.edit.script', compact(['collection', 'vueData', 'definitions']))
