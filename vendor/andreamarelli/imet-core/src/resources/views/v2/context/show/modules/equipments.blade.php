<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

use \Wa72\HtmlPageDom\HtmlPageCrawler;


$view_groupTable = \Illuminate\Support\Facades\View::make('modular-forms::module.show.type.group_table', compact(['definitions', 'records']))->render();

$dom = HtmlPageCrawler::create($view_groupTable);
foreach ($definitions['groups'] as $group_key => $group){
    $group_records = array_filter($records, function($item) use ($group_key){
        return $item['group_key'] === $group_key;
    });
    $input = '<thead>
                <th></th>
                <th>'.
                    \Illuminate\Support\Facades\View::make('modular-forms::module.show.field', [
                        'type' => 'numeric',
                        'value' => round(\AndreaMarelli\ImetCore\Helpers\Math::records_average($group_records, 'AdequacyLevel'), 2)
                    ]).'
                </th>
                <th></th>
                <th></th>
            </thead>';
    $dom->filter('table#group_table_'.$definitions['module_key'].'_'.$group_key.' > thead')->append($input);
}

?>

{!! $dom->saveHTML() !!}
@include('modular-forms::module.show.type.commons', ['definitions' => $definitions, 'records' => $records])
