<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

$view_groupTable = \Illuminate\Support\Facades\View::make('modular-forms::module.edit.type.group_table', compact(['collection', 'vueData', 'definitions']))->render();

// Inject Average calculation
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group0', 3, 2);
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group1', 3, 2);
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group2', 3, 2);
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group3', 3, 2);
$view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group4', 3, 2);


?>

{!! $view_groupTable !!}
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV1.evaluation.DesignatedValuesConservationTendency(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
