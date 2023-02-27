<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Array $records */

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\MenacesPressions;
use Illuminate\Support\Facades\View;

$view_groupTable = View::make('modular-forms::module.show.type.group_table', compact(['collection', 'records', 'definitions']))->render();
$stats = \AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\MenacesPressions::getStats($records[0]['FormID']);


// Inject titles (with category stats)
foreach (MenacesPressions::$groupByCategory as $i => $category) {
    $searchFor = '<h5 class="highlight group_title_' . $definitions['module_key'] . '_' . $category[0] . '">';
    $textToAdd = '
        <div class="module-row">
            <div style="width: 90%;">
                <h3>' . ($i + 1) . '. ' . trans('imet-core::v1_context.MenacesPressions.categories.title' . ($i + 1)) . '</h3>
            </div>
            <div class="module-row__input">
                <input type="text" disabled="disabled" value="' . $stats['category_stats'][$i] . '"
                    class="field-disabled input-number field-edit text-center" style="font-style: bold; margin-top: 20px;"/>
            </div>
        </div>';
    $view_groupTable = str_replace($searchFor, $textToAdd . $searchFor, $view_groupTable);
}

// inject row and group stats
$allSpaces = '[\s\t\n\r]*';
foreach (MenacesPressions::$groupByCategory as $i => $category) {

    foreach ($category as $index => $group) {
        if (isset($stats['row_stats'][$group])) {
            foreach ($stats['row_stats'][$group] as $r => $value) {
                preg_match("/(<td>" . $allSpaces . "<\/td\>)/m", $view_groupTable, $matched1);
                $textToAdd = '<td><input type="text" disabled="disabled" value="' . $value . '" class="field-disabled input-number field-edit text-center"/></td>';
                if (count($matched1) > 0) {
                    $matched1[0] = '/' . preg_quote($matched1[0], '/') . '/';
                    $view_groupTable = preg_replace($matched1[0], $textToAdd, $view_groupTable, 1);
                }
            }
        }
        if (isset($stats['group_stats'][$group])) {
            preg_match("/(<\/tr\>" . $allSpaces . "\<\/thead\>" . $allSpaces . "\<tbody\sclass\=\"" . $group . "[\s\"])/m", $view_groupTable, $matched);
            $textToAdd = '<th>
                          <input type="text" disabled="disabled" value="' . $stats['group_stats'][$group] . '"
                                class="field-disabled input-number field-edit text-center"/>
                      </th>';
            $view_groupTable = str_replace($matched[0], $textToAdd . $matched[0], $view_groupTable);
        }
    }
}


?>

{!! $view_groupTable !!}
@include('modular-forms::module.show.type.commons', compact(['collection', 'definitions']))
