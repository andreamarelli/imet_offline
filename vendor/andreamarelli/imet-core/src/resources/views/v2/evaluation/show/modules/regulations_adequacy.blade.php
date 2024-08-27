<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component\ImetModule;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\RegulationsAdequacy;
use Illuminate\Support\Facades\View;


$view = View::make('modular-forms::module.show.type.table', compact(['definitions', 'records']))->render();

// Inject marine icon on criteria
$view = ImetModule::injectIconToPredefinedCriteria(ImetModule::MARINE, $view, RegulationsAdequacy::get_marine_predefined());

?>

{!! $view !!}
