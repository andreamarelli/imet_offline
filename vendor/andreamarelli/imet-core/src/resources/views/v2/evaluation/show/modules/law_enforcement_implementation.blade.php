<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component\ImetModule;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\LawEnforcementImplementation;
use Illuminate\Support\Facades\View;

$page = View::make('modular-forms::module.show.type.group_table', compact(['definitions', 'records']))->render();

// Inject marine/terrestrial icon on title
$page = ImetModule::injectIconToGroups($page, LawEnforcementImplementation::get_marine_groups(), LawEnforcementImplementation::get_terrestrial_groups());


?>

{!! $page !!}

@include('modular-forms::module.show.type.commons', compact(['definitions', 'records']))