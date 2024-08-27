<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component\ImetModule;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Evaluation\BoundaryLevel;
use Illuminate\Support\Facades\View;

$vueData['marine_predefined'] = BoundaryLevel::get_marine_predefined();
$view = View::make('modular-forms::module.edit.type.table', compact(['collection', 'vueData', 'definitions']))->render();

// Inject marine icon on criteria
$view = ImetModule::injectIconToPredefinedCriteriaWithVue(ImetModule::MARINE, $view, "is_marine(item['Adequacy'])");
?>

@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

<br />

{!! $view !!}


@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.evaluation.BoundaryLevel(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
