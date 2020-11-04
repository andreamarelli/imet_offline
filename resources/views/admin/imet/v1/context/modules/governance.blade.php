<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

?>

@include('admin.components.module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))
@include('admin.components.module.edit.type.accordion', compact(['collection', 'vue_data', 'definitions']))

@include('admin.components.module.edit.script', compact(['collection', 'vue_data', 'definitions']))