<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */
?>

@foreach($definitions['groups'] as $group_key => $group_label)
    <h5 class="green">{{ $group_label }}</h5>

    @include('admin.components.module.preview.type.accordion', [
         'definitions' => $definitions,
         'records' => $records,
         'group_key' => $group_key
    ])
    <br />

@endforeach