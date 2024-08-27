<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

use \Wa72\HtmlPageDom\HtmlPageCrawler;

$stats = array_key_exists('FormID', $records[0]) ? \AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\EcosystemServices::getStats($records[0]['FormID']) : null;
$fistGroupPerCategory = array_map(function($category){
    return $category[0];
}, \AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\EcosystemServices::$groupsByCategory);

$view = \Illuminate\Support\Facades\View::make('modular-forms::module.show.type.group_table', compact(['definitions', 'records']))->render();
$dom = HtmlPageCrawler::create('<div>'.$view.'</div>');

foreach ($fistGroupPerCategory as $i => $group){
    $title = ' <div class="module-row">
                    <div style="width: 60%;">
                        <h3>'.($i+1).'. '.trans('imet-core::v2_context.EcosystemServices.categories.title'.($i+1)).'</h3>
                    </div>
                    <div  class="module-row__input">
                        <div class="row progress_bar" style="margin-top: 25px">
                            <imet_score_bar
                                value='.round($stats[$i], 1).'
                                color="#87c89b"
                            ></imet_score_bar>
                        </div>
                    </div>
               </div>';
    $dom->filter('h5.group_title_'.$definitions['module_key'].'_'.$group)->eq(0)->before($title);
}
?>

{!! $dom->saveHTML() !!}