<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

?>

@include('modular-forms::module.show.type.commons', compact(['definitions', 'records']))
@include('modular-forms::module.show.type.table', compact(['definitions', 'records']))
