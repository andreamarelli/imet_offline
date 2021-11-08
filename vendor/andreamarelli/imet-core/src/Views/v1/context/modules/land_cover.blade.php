<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

?>

@include('modular-forms::module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))
@include('modular-forms::module.edit.type.table', compact(['collection', 'vue_data', 'definitions']))

@include('modular-forms::module.edit.script', compact(['collection', 'vue_data', 'definitions']))
