<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

use AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\MenacesPressions;
use Illuminate\Support\Facades\View;
use \Wa72\HtmlPageDom\HtmlPageCrawler;

$page = View::make('modular-forms::module.show.type.group_table', compact(['definitions', 'records']))->render();
$dom = HtmlPageCrawler::create(
    \Wa72\HtmlPageDom\Helpers::trimNewlines($page)
);

$stats = array_key_exists('FormID', $records[0]) ? MenacesPressions::getStats($records[0]['FormID']) : null;

    // Inject titles (with category stats)
    $groupByCategory = MenacesPressions::$groupByCategory;
    foreach($groupByCategory as $i => $category){
//        $title = ' <div class="module-row">
//                        <div style="width: 60%;">
//                            <h3>'.($i+1).'. '.trans('imet-core::v2_context.MenacesPressions.categories.title'.($i+1)).'</h3>
//                        </div>
//                        <div class="module-row__input">
//
//                            <div class="row progress_bar" style="margin-top: 25px">
//                                <div class="col-lg-1 progress_bar_limits">-100%</div>
//                                <div class="col-lg-10 progress_bar_container">
//                                    <div class="progress">
//                                        <div class="progress-bar progress-bar-striped progress-bar-negative"
//                                             role="progressbar"
//                                             style="width: '.$stats['category_stats'][$i].'%; background-color: #85c79b;">
//                                            <span>'.$stats['category_stats'][$i].' %</span>
//                                        </div>
//                                    </div>
//                                </div>
//                                <div class="col-lg-1 progress_bar_limits">0%</div>
//                            </div>
//
//                        </div>
//                   </div>';
        $title = ' <h3>'.($i+1).'. '.trans('imet-core::v2_context.MenacesPressions.categories.title'.($i+1)).'</h3>';
        $dom->filter('h5.group_title_'.$definitions['module_key'].'_'.$category[0])->eq(0)->before($title);
    }
    // inject row stats
    foreach(MenacesPressions::$groupByCategory as $i => $category){
        foreach ($category as $group){
            $dom->filter('table#group_table_imet__v2__context__menaces_pressions_'.$group.' > tbody > tr')
                ->each(function ($tr, $index) use($group, $stats) {
                    $tr->filter('td')
                        ->eq(6)
                        ->append('<div class="field-preview">'.$stats['row_stats'][$group][$index].'</div>');
                });
        }
    }

?>

<div>
    @foreach(MenacesPressions::$groupByCategory as $i => $category)
        @php
            /** @var $stats */
            /** @var $i */
            $group_stat = (float) $stats['category_stats'][$i];
        @endphp

        <div class="histogram-row">
            <div class="histogram-row__code text-center"><b>{{ ($i+1) }}</b></div>
            <div class="histogram-row__title text-left">@lang('imet-core::v2_context.MenacesPressions.categories.title'.($i+1))</div>
            <div class="histogram-row__value text-right" style="margin-right: 20px;">
                {{ $group_stat>0 ? $group_stat : '-' }}
            </div>
            @if($group_stat>0)
                <div class="histogram-row__progress-bar">
                    <div class="histogram-row__progress-bar__limit-left">-100%</div>
                    <div class="histogram-row__progress-bar__bar">
                        <div class="progress">
                            <div role="progressbar"
                                 class="progress-bar progress-bar-striped  progress-bar-negative"
                                 style="width: {{ (int) abs($group_stat) }}%; background-color: #87c89b !important;">
                                <span>{{ $group_stat }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="histogram-row__progress-bar__limit-right">0%</div>
                </div>
            @endif
        </div>

    @endforeach
</div>
<br />
<br />


{!! $dom->saveHTML() !!}
