<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component\ImetModule;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\MenacesPressions;
use Illuminate\Support\Facades\View;

$vueData['marine_predefined'] = MenacesPressions::get_marine_predefined();

$view_groupTable = View::make('modular-forms::module.edit.type.group_table', compact(['collection', 'vueData', 'definitions']))->render();

// Inject marine icon on criteria
$view_groupTable = ImetModule::injectIconToPredefinedCriteriaWithVue(ImetModule::MARINE, $view_groupTable, "is_marine(item['Value'])");

// Inject marine/terrestrial icon on title
$view_groupTable = ImetModule::injectIconToGroups($view_groupTable, MenacesPressions::get_marine_groups(), MenacesPressions::get_terrestrial_groups());

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

<div>
    @foreach(MenacesPressions::$groupsByCategory as $i => $category)
        <div class="histogram-row">
            <div class="histogram-row__code text-center"><b>{{ ($i+1) }}</b></div>
            <div class="histogram-row__title text-left">@lang('imet-core::v2_context.MenacesPressions.categories.title'.($i+1))</div>
            <div class="histogram-row__value text-right" style="margin-right: 20px;">
                <b v-html="categoryStats[{{ $i }}] || '-'"></b>
            </div>
            <div class="histogram-row__progress-bar"  v-if="categoryStats['{{ $i }}']!==null">
                <imet_score_bar
                    :value=categoryStats[{{ $i }}]
                    color="#87c89b"
                ></imet_score_bar>
            </div>
        </div>
    @endforeach
</div>
<br />
<br />

{!! $view_groupTable !!}
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.context.MenacesPressions(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush

