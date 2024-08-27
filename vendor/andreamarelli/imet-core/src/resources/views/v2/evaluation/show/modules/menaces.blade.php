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
                    ('.trans('imet-core::v2_context.MenacesPressions.fields.Impact').': <b>'.$records[$index]['_Impact'].'</b>,&nbsp;&nbsp;
                    '.trans('imet-core::v2_context.MenacesPressions.fields.Extension').': <b>'.$records[$index]['_Extension'].'</b>,&nbsp;&nbsp;
                    '.trans('imet-core::v2_context.MenacesPressions.fields.Duration').': <b>'.$records[$index]['_Duration'].'</b>,&nbsp;&nbsp;
                    '.trans('imet-core::v2_context.MenacesPressions.fields.Trend').': <b>'.$records[$index]['_Trend'].'</b>,&nbsp;&nbsp;
                    '.trans('imet-core::v2_context.MenacesPressions.fields.Probability').': <b>'.$records[$index]['_Probability'].'</b>)
                </span>
            </div>'
        : '';

    $tr->filter('td')->first()->each(function ($td, $j) use ($input){
        $td->append($input);
    });
});

?>

{!! $dom->saveHTML() !!}
