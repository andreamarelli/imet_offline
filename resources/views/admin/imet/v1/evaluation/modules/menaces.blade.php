<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

use \Wa72\HtmlPageDom\HtmlPageCrawler;

$view_table = View::make('admin.components.module.edit.type.table', compact(['collection', 'vue_data', 'definitions']))->render();

$input = '<input type="text" disabled="disabled" v-model="stats[index]" class="field-disabled input-number field-edit text-center" />';

$dom = HtmlPageCrawler::create(
    \Wa72\HtmlPageDom\Helpers::trimNewlines($view_table)
);
$dom->filter('thead > tr > th')->eq(0)->append('<th></th>');
$dom->filter('tbody > tr.module-table-item td')->eq(0)->append('<td>'.$input.'</td>');

$vue_data['stats'] =  \App\Models\Imet\v1\Modules\Context\MenacesPressions::getStats($vue_data['form_id'])['category_stats'];


?>


{!! $dom->saveHTML() !!}
@include('admin.components.module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))

@include('admin.components.module.edit.script', compact(['collection', 'vue_data', 'definitions']))