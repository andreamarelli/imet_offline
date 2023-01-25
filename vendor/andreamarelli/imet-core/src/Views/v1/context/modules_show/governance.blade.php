<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

?>

@include('modular-forms::module.show.type.commons', compact(['collection', 'definitions']))
@include('modular-forms::module.show.type.accordion', compact(['collection',  'definitions']))

