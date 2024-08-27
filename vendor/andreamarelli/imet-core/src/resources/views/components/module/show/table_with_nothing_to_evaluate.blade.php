<?php
/** @var Mixed $definitions */
/** @var Mixed $records */
/** @var String $group_key (optional - only for GROUP_TABLE) */

$group_key = $group_key ?? null;

if($definitions['module_type']==='GROUP_TABLE'){
    $records = array_filter($records, function($item) use ($group_key, $definitions){
        return $item[$definitions['group_key_field']] === $group_key;
    });
}

use \Wa72\HtmlPageDom\HtmlPageCrawler;
use Wa72\HtmlPageDom\Helpers;

$group_key = $group_key ?? '';

$num_cols = count($definitions['fields']);

$original_table = \Illuminate\Support\Facades\View::make('modular-forms::module.show.type.table', compact(['definitions', 'records', 'group_key']))->render();
$nothing_to_evaluate = \Illuminate\Support\Facades\View::make('imet-core::components.module.nothing_to_evaluate', ['num_cols' => $num_cols])->render();

$dom = HtmlPageCrawler::create(Helpers::trimNewlines($original_table));
if(empty($records) || (isset($records[0]) && $records[0][$definitions['fields'][0]['name']]===null)){
    $tbody = HtmlPageCrawler::create($dom->filter('tbody'));
    $tbody->setInnerHtml($nothing_to_evaluate);
}

?>


{!! $dom->saveHTML() !!}

