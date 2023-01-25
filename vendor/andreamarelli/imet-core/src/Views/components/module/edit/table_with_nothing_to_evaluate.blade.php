<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */
/** @var String $group_key (optional - only for GROUP_TABLE) */

use \Wa72\HtmlPageDom\HtmlPageCrawler;
use Wa72\HtmlPageDom\Helpers;

$group_key = $group_key ?? '';

$v_if_condition = $definitions['module_type']==='GROUP_TABLE'
    ? 'records[\'' . $group_key . '\'][0].' . $definitions['fields'][0]['name'] . '===null'
    : 'records.length===0 || records[0].' . $definitions['fields'][0]['name'] . '===null';

$v_else_condition = $definitions['module_type']==='GROUP_TABLE'
    ? 'records[\'' . $group_key . '\'][0].' . $definitions['fields'][0]['name'] . '!==null'
    : 'records.length!==0 && records[0].' . $definitions['fields'][0]['name'] . '!==null';

$num_cols = count($definitions['fields']);

$original_table = \Illuminate\Support\Facades\View::make('modular-forms::module.edit.type.table', compact(['collection', 'vue_data', 'definitions', 'group_key']))->render();
$nothing_to_evaluate = \Illuminate\Support\Facades\View::make('imet-core::components.module.nothing_to_evaluate', ['num_cols' => $num_cols, 'attributes' => 'v-if="'.$v_if_condition.'"'])->render();

$dom = HtmlPageCrawler::create(Helpers::trimNewlines($original_table));
$tbody = HtmlPageCrawler::create($dom->filter('tbody'));
$tbody->filter('tr')->eq(0)->setAttribute('v-else-if', $v_else_condition);
$tbody->prepend($nothing_to_evaluate);

?>


{!! $dom->saveHTML() !!}

