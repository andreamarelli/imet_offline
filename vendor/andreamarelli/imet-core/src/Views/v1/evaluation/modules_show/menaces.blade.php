<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */
/** @var array $item */

use \Wa72\HtmlPageDom\HtmlPageCrawler;

$view_table = \Illuminate\Support\Facades\View::make('modular-forms::module.show.type.table', compact(['collection', 'records', 'definitions']))->render();

$dom = HtmlPageCrawler::create(
    \Wa72\HtmlPageDom\Helpers::trimNewlines($view_table)
);
$dom->filter('thead > tr > th')->eq(0)->append('<th></th>');

$stats =  \AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\MenacesPressions::getStats($item['FormID'])['category_stats'];
$items = [];
foreach($stats as $i => $stat){
    $input = '<input type="text" disabled="disabled" value="'. $stat.'" class="field-disabled input-number field-edit text-center" />';
    $items[] = $dom->filter('tbody > tr.module-table-item')->eq($i)->filter('td')->eq(0)->append('<td>'.$input.'</td>');;
}

?>

{!! $dom->saveHTML() !!}
@include('modular-forms::module.show.type.commons', compact(['collection', 'records', 'definitions']))

