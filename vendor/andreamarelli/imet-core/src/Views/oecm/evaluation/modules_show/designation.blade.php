<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

?>

@include('imet-core::components.module.edit.table_with_nothing_to_evaluate', [
    'collection' => $collection,
    'definitions' => $definitions,
    'records' => $records,
])

@include('modular-forms::module.edit.script', compact(['collection', 'records', 'definitions']))
