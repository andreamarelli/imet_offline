<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

?>

@include('imet-core::components.module.edit.table_with_nothing_to_evaluate', [
    'collection' => $collection,
    'definitions' => $definitions,
    'vue_data' => $vue_data,
])

@include('modular-forms::module.edit.script', compact(['collection', 'vue_data', 'definitions']))
