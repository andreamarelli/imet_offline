<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

use \Wa72\HtmlPageDom\HtmlPageCrawler;

$totalBudget = \AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\FinancialResources::getTotalBudget($records[0]['FormID']);
$totalSum = 0;
foreach($records as $index => $record){
    $records[$index]['__sum_row'] = $record[$definitions['fields'][1]['name']]
         + $record[$definitions['fields'][2]['name']]
         + $record[$definitions['fields'][3]['name']]
         + $record[$definitions['fields'][4]['name']];
    $records[$index]['__percent_row'] = $totalBudget>0
        ? round($records[$index]['__sum_row']/$totalBudget*100, 1).'%'
        : '';
    $totalSum += $records[$index]['__sum_row'] ;
}


$table = \Illuminate\Support\Facades\View::make('modular-forms::module.show.type.table', compact(['definitions', 'records']))->render();
$dom = HtmlPageCrawler::create(
    \Wa72\HtmlPageDom\Helpers::trimNewlines($table)
);
$table_dom = $dom->filter('table#table_'.$definitions['module_key']);

    $table_dom->filter('thead tr th')->eq(4)->after(
        '<th class="text-center">'.ucfirst(trans('imet-core::v2_context.FinancialAvailableResources.fields.total')).'</th>
         <th class="text-center">'.ucfirst(trans('imet-core::v2_context.FinancialAvailableResources.fields.percentage')).'</th>
    ');

    $table_dom->filter('tbody tr')->each(function ($tr, $index) use($records) {
        $tr->filter('td')->eq(4)->after(
            '<td>'.
                \Illuminate\Support\Facades\View::make('modular-forms::module.show.field', [
                    'type' => 'numeric',
                    'value' => $records[$index]['__sum_row']
                ]).
            '</td>'.
            '<td>'.
                \Illuminate\Support\Facades\View::make('modular-forms::module.show.field', [
                    'type' => 'text-area',
                    'value' => $records[$index]['__percent_row']
                ]).
            '</td>'
        );
    });

    $table_dom->filter('tbody tr')->last()->after(
        '<tr>
                <td colspan="5"></td>
                <td>'.
                    \Illuminate\Support\Facades\View::make('modular-forms::module.show.field', [
                        'type' => 'numeric',
                        'value' => $totalSum
                    ]).'
                </td>
                <td></td>
            </tr>'
    );

?>

{!! $dom->saveHTML() !!}
