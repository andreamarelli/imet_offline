<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

?>

@include('admin.components.module.preview.type.commons', compact(['definitions', 'records']))
@include('admin.components.module.preview.type.table', compact(['definitions', 'records']))
