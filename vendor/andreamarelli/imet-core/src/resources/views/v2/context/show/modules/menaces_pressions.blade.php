<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component\ImetModule;
use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\MenacesPressions;
use Illuminate\Support\Facades\View;
use \Wa72\HtmlPageDom\HtmlPageCrawler;
use \Wa72\HtmlPageDom\Helpers;

$page = View::make('modular-forms::module.show.type.group_table', compact(['definitions', 'records']))->render();


// Inject marine icon on criteria
$page = ImetModule::injectIconToPredefinedCriteria(ImetModule::MARINE, $page, MenacesPressions::get_marine_predefined());

// Inject marine/terrestrial icon on title
$page = ImetModule::injectIconToGroups($page, MenacesPressions::get_marine_groups(), MenacesPressions::get_terrestrial_groups());


$dom = HtmlPageCrawler::create(Helpers::trimNewlines($page));

    // Inject titles
    $groupsByCategory = MenacesPressions::$groupsByCategory;
    foreach($groupsByCategory as $i => $category){
        $title = ' <h3>'.($i+1).'. '.trans('imet-core::v2_context.MenacesPressions.categories.title'.($i+1)).'</h3>';
        $dom->filter('h5.group_title_'.$definitions['module_key'].'_'.$category[0])->eq(0)->before($title);
    }

    // inject column with row stats
    $stats = array_key_exists('FormID', $records[0]) ? MenacesPressions::getStats($records[0]['FormID']) : null;
    foreach(MenacesPressions::$groupsByCategory as $i => $category){
        foreach ($category as $group){
            $dom->filter('table#group_table_imet__v2__context__menaces_pressions_'.$group.' > tbody > tr')
                ->each(function ($tr, $index) use($group, $stats) {
                    $tr->filter('td')
                        ->eq(6)
                        ->append('<div class="field-preview">'.$stats['rowStats'][$group][$index].'</div>');
                });
        }
    }

?>

<div id="threat_histograms">
    @foreach(MenacesPressions::$groupsByCategory as $i => $category)
        @php
            /** @var $stats */
            /** @var $i */
            $group_stat = (float) $stats['categoryStats'][$i];
        @endphp

        <div class="histogram-row">
            <div class="histogram-row__code text-center"><b>{{ ($i+1) }}</b></div>
            <div class="histogram-row__title text-left">@lang('imet-core::v2_context.MenacesPressions.categories.title'.($i+1))</div>
            <div class="histogram-row__value text-right" style="margin-right: 20px;">
                {{ $group_stat>0 ? $group_stat : '-' }}
            </div>
            @if($group_stat>0)
                <div class="histogram-row__progress-bar">
                    <imet_score_bar
                        :value={{ $group_stat }}
                        color="#87c89b"
                        :min=-100
                        :max=0
                    ></imet_score_bar>
                </div>
            @endif
        </div>

    @endforeach

</div>
<br />
<br />


{!! $dom->saveHTML() !!}