<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\MenacesPressions;
use Illuminate\Support\Facades\View;

$view_groupTable = View::make('modular-forms::module.edit.type.group_table', compact(['collection', 'vueData', 'definitions']))->render();

// Inject titles
foreach(MenacesPressions::$groupsByCategory as $i => $category){
    $view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectGroupTitle(
        $view_groupTable, $definitions['module_key'], $category[0],
        ($i+1).'. '.trans('imet-core::v1_context.MenacesPressions.categories.title' . ($i+1)));
}

// inject column with row stats
$searchFor = '<input type="hidden" v-model="records[index].group_key"';
$textToAdd = '<div class="field-preview field-numeric">{{ recordStats[index] }}</div>';
$view_groupTable = str_replace($searchFor, $textToAdd.$searchFor, $view_groupTable);
?>

{!! $view_groupTable !!}
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV1.context.MenacesPressions(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
