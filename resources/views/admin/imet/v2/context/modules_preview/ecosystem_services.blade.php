<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

use \Wa72\HtmlPageDom\HtmlPageCrawler;

$page = View::make('admin.components.module.preview.type.group_table', compact(['definitions', 'records']))->render();
$dom = HtmlPageCrawler::create(
    \Wa72\HtmlPageDom\Helpers::trimNewlines($page)
);

$groupByCategory = \App\Models\Imet\v2\Modules\Context\EcosystemServices::$groupByCategory;
$stats = array_key_exists('FormID', $records[0]) ? \App\Models\Imet\v2\Modules\Context\EcosystemServices::getStats($records[0]['FormID']) : null;

// Group titles & histogram
foreach($groupByCategory as $i => $category){
    $title = ' <div class="module-row">
                    <div style="width: 60%;">
                        <h3>'.($i+1).'. '.trans('form/imet/v2/context.EcosystemServices.categories.title'.($i+1)).'</h3>
                    </div>
                    <div  class="module-row__input">

                        <div class="row progress_bar" style="margin-top: 25px">
                            <div class="col-lg-1 progress_bar_limits">-100%</div>
                            <div class="col-lg-10 progress_bar_container">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-negative"
                                         role="progressbar"
                                         style="width: '.$stats[$i].'%; background-color: #85c79b;">
                                        <span>'.$stats[$i].' %</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 progress_bar_limits">0%</div>
                        </div>

                    </div>
               </div>';
    $dom->filter('h5.group_title_'.$definitions['module_key'].'_'.$category[0])->eq(0)->before($title);
}

?>

{!! $dom->saveHTML() !!}