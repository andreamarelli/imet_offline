<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */


use \Wa72\HtmlPageDom\HtmlPageCrawler;

$page = \Illuminate\Support\Facades\View::make('imet-core::components.module.show.table_with_nothing_to_evaluate', compact(['definitions', 'records']))->render();
$dom = HtmlPageCrawler::create(
    \Wa72\HtmlPageDom\Helpers::trimNewlines($page)
);

$dom->filter('tbody > tr.module-table-item')->each(function ($tr, $index) use($records) {

    $input = isset($records[$index]['_rank'])
        ? '<div class="text-left" style="padding: 4px;">
                <b class="highlight">'.round($records[$index]['_rank'], 2).'</b>&nbsp;&nbsp;
                <span style="font-size: 0.85em; font-style: italic; ">
                    ('.trans('imet-core::v2_context.EcosystemServices.fields.Importance').': <b>'.$records[$index]['_Importance'].'</b>,&nbsp;&nbsp;
                    '.trans('imet-core::v2_context.EcosystemServices.fields.ImportanceRegional').': <b>'.$records[$index]['_ImportanceRegional'].'</b>,&nbsp;&nbsp;
                    '.trans('imet-core::v2_context.EcosystemServices.fields.ImportanceGlobal').': <b>'.$records[$index]['_ImportanceGlobal'].'</b>)
                </span>
            </div>'
        : '';

    $tr->filter('td')->first()->each(function ($td, $j) use ($input){
        $td->append($input);
    });
});

?>

{!! $dom->saveHTML() !!}
