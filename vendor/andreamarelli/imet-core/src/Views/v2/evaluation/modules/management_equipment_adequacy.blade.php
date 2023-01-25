<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

?>

@include('imet-core::components.module.edit.table_with_nothing_to_evaluate', compact(['collection', 'vue_data', 'definitions']))
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))

@include('modular-forms::module.edit.script', compact(['collection', 'vue_data', 'definitions']))
