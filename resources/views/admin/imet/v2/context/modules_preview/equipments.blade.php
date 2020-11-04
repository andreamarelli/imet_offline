<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

use \Wa72\HtmlPageDom\HtmlPageCrawler;
use \App\Models\Imet\Utils\Utils;


$view_groupTable = View::make('admin.components.module.preview.type.group_table', compact(['definitions', 'records']))->render();

$dom = HtmlPageCrawler::create($view_groupTable);
foreach ($definitions['groups'] as $group_key => $group){
    $group_records = array_filter($records, function($item) use ($group_key){
        return $item['group_key'] === $group_key;
    });
    $input = '<thead>
                <th></th>
                <th>'.
                    View::make('admin.components.module.preview.field', [
                        'type' => 'numeric',
                        'value' => round(Utils::calculateAverage($group_records, 'AdequacyLevel'), 2)
                    ]).'
                </th>
                <th></th>
                <th></th>
            </thead>';
    $dom->filter('table#group_table_'.$definitions['module_key'].'_'.$group_key.' > thead')->append($input);
}

?>

{!! $dom->saveHTML() !!}
@include('admin.components.module.preview.type.commons', ['definitions' => $definitions, 'records' => $records])