<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

?>

@include('imet-core::components.module.edit.table_with_nothing_to_evaluate', compact(['collection', 'vueData', 'definitions']))
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

@include('modular-forms::module.edit.script', compact(['collection', 'vueData', 'definitions']))
