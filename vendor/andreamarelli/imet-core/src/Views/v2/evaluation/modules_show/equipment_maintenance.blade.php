<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

foreach ($records as $i => $record){
    $records[$i]['Equipment'] = $records[$i]['__predefined_label'];
}

?>

@include('modular-forms::module.show.type.table', compact(['definitions', 'records']))
