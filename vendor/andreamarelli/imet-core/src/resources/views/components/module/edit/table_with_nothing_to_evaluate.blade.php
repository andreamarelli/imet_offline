<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */
/** @var String $group_key (optional - only for GROUP_TABLE) */

use \Wa72\HtmlPageDom\HtmlPageCrawler;
use Wa72\HtmlPageDom\Helpers;

$group_key = $group_key ?? '';
$num_cols = count($definitions['fields']);

$original_table = \Illuminate\Support\Facades\View::make('modular-forms::module.edit.type.table', compact(['collection', 'vueData', 'definitions', 'group_key']))->render();
$nothing_to_evaluate = \Illuminate\Support\Facades\View::make('imet-core::components.module.nothing_to_evaluate', ['num_cols' => $num_cols])->render();

$dom = HtmlPageCrawler::create(Helpers::trimNewlines($original_table));
$tbody = HtmlPageCrawler::create($dom->filter('tbody'));
$tbody->setAttribute('v-if', 'hasRecordsToEvaluate(\'' . $definitions['fields'][0]['name'] . '\')');
$tbody->after($nothing_to_evaluate);

?>


{!! $dom->saveHTML() !!}

