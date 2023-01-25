<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

$record = $records[0];
$view_groupTable = \Illuminate\Support\Facades\View::make('modular-forms::module.show.type.group_table', compact(['collection', 'records', 'definitions']))->render();

$averages = [];
foreach ($records as $record) {
    if (!isset($averages[$record['group_key']])) {
        $averages[$record['group_key']] = [];
    }
    if ($record['AdequacyLevel'] !== null) {
        $averages[$record['group_key']][] = $record['AdequacyLevel'];
    }
}

$results = [];
$i = 0;
foreach ($averages as $group) {
    $sum = array_sum($group);
    $number_of_items = count($group);
    $results[$i] = "";
    if ($sum >= 0 && $number_of_items > 0) {
        $results[$i] = round($sum / count($group),2);
    }
    $i++;
}

// Inject Average calculation
foreach ($results as $index => $result) {
    $view_groupTable = AndreaMarelli\ModularForms\Helpers\Module::injectAverageInGroup($view_groupTable, 'group' . $index, 2, 2, '', $result);
}

?>

{!! $view_groupTable !!}
@include('modular-forms::module.show.type.commons', compact(['collection', 'definitions']))
