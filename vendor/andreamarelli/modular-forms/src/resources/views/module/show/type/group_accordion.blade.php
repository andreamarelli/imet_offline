<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */
?>

@foreach($definitions['groups'] as $group_key => $group_label)
    <h5 class="highlight">{{ $group_label }}</h5>

    @include('modular-forms::module.show.type.accordion', [
         'definitions' => $definitions,
         'records' => $records,
         'group_key' => $group_key
    ])
    <br />

@endforeach