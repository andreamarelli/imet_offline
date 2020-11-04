<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

use \Wa72\HtmlPageDom\HtmlPageCrawler;
use \App\Models\Imet\Utils\Utils;

$page = View::make('admin.components.module.preview.type.group_table', compact(['definitions', 'records']))->render();
$dom = HtmlPageCrawler::create(
    \Wa72\HtmlPageDom\Helpers::trimNewlines($page)
);

foreach ($definitions['groups'] as $group_key => $group){
    $group_records = array_filter($records, function($item) use ($group_key){
        return $item['group_key'] === $group_key;
    });
    $input = '<thead>
                <th></th>
                <th>'.
                    View::make('admin.components.module.preview.field', [
                        'type' => 'numeric',
                        'value' => round(Utils::calculateAverage($group_records, 'EvaluationScore'), 2)
                    ]).'
                </th>
                <th></th>
            </thead>';
    $dom->filter('table#group_table_imet__v2__evaluation__life_quality_impact_'.$group_key.' > thead')->append($input);
}
?>
{!! $dom->saveHTML() !!}

