<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

use \Wa72\HtmlPageDom\HtmlPageCrawler;

$page = View::make('admin.components.module.preview.type.group_table', compact(['definitions', 'records']))->render();
$dom = HtmlPageCrawler::create(
    \Wa72\HtmlPageDom\Helpers::trimNewlines($page)
);

$stats = null;
if(array_key_exists('FormID', $records[0])){
    $stats = \App\Models\Imet\v2\Modules\Context\MenacesPressions::getStats($records[0]['FormID']);
}

// Inject titles (with category stats)
$groupByCategory = \App\Models\Imet\v2\Modules\Context\MenacesPressions::$groupByCategory;
foreach($groupByCategory as $i => $category){
    $title = ' <div class="module-row">
                    <div style="width: 60%;">
                        <h3>'.($i+1).'. '.trans('form/imet/v2/context.MenacesPressions.categories.title'.($i+1)).'</h3>
                    </div>
                    <div class="module-row__input">

                        <div class="row progress_bar" style="margin-top: 25px">
                            <div class="col-lg-1 progress_bar_limits">-100%</div>
                            <div class="col-lg-10 progress_bar_container">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-negative"
                                         role="progressbar"
                                         style="width: '.$stats['category_stats'][$i].'%; background-color: #85c79b;">
                                        <span>'.$stats['category_stats'][$i].' %</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 progress_bar_limits">0%</div>
                        </div>

                    </div>
               </div>';
    $dom->filter('h5.group_title_'.$definitions['module_key'].'_'.$category[0])->eq(0)->before($title);
}
// inject row stats
foreach(\App\Models\Imet\v2\Modules\Context\MenacesPressions::$groupByCategory as $i => $category){
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

{!! $dom->saveHTML() !!}
