<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

?>

@include('imet-core::components.module.edit.table_with_nothing_to_evaluate', [
    'collection' => $collection,
    'definitions' => $definitions,
    'vueData' => $vueData,
])

@include('modular-forms::module.edit.script', compact(['collection', 'vueData', 'definitions']))