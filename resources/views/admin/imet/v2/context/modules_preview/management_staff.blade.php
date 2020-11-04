<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

use \Wa72\HtmlPageDom\HtmlPageCrawler;


$table = View::make('admin.components.module.preview.type.table', compact(['definitions', 'records']))->render();
$dom = HtmlPageCrawler::create(
    \Wa72\HtmlPageDom\Helpers::trimNewlines($table)
);

$table_dom = $dom->filter('table#table_'.$definitions['module_key']);
$table_dom->filter('thead tr th')->eq(2)->after('<th>'.ucfirst(trans('form/imet/v2/context.ManagementStaff.fields.difference')).'</th>');
$table_dom->filter('tbody tr')->each(function ($tr, $index) use($records) {
    $tr->filter('td')->eq(2)->after(
        '<td>'.
            View::make('admin.components.module.preview.field', [
                'type' => 'integer',
                'value' => intval($records[$index]['ActualPermanent']) - intval($records[$index]['ExpectedPermanent'])
            ]).
        '</td>'
    );
});


?>

{!! $dom->saveHTML() !!}

@include('admin.components.module.preview.type.commons', compact(['definitions', 'records']))
