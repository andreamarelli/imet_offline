<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

use \Wa72\HtmlPageDom\HtmlPageCrawler;

$page = \Illuminate\Support\Facades\View::make('modular-forms::module.show.type.group_table', compact(['definitions', 'records']))->render();
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
                    \Illuminate\Support\Facades\View::make('modular-forms::module.show.field', [
                        'type' => 'numeric',
                        'value' => round(\AndreaMarelli\ImetCore\Helpers\Math::records_average($group_records, 'EvaluationScore'), 2)
                    ]).'
                </th>
                <th></th>
            </thead>';
    $dom->filter('table#group_table_imet__v2__evaluation__life_quality_impact_'.$group_key.' > thead')->append($input);
}
?>
{!! $dom->saveHTML() !!}

