<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

?>

@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))
@include('modular-forms::module.edit.type.accordion', compact(['collection', 'vueData', 'definitions']))

@include('modular-forms::module.edit.script', compact(['collection', 'vueData', 'definitions']))
