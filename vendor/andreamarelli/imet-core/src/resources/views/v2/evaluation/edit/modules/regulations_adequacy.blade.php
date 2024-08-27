<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component\ImetModule;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\RegulationsAdequacy;
use Illuminate\Support\Facades\View;

$vueData['marine_predefined'] = RegulationsAdequacy::get_marine_predefined();
$view = View::make('modular-forms::module.edit.type.table', compact(['collection', 'vueData', 'definitions']))->render();

// Inject marine icon on criteria
$view = ImetModule::injectIconToPredefinedCriteriaWithVue(ImetModule::MARINE, $view, "is_marine(item['Regulation'])");

?>

{!! $view !!}


@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.evaluation.RegulationsAdequacy(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
