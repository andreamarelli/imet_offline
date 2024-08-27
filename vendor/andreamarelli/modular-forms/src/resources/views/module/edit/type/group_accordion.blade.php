<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

?>

@foreach($definitions['groups'] as $group_key => $group_label)
    <h5 class="highlight">{{ $group_label }}</h5>

    @include('modular-forms::module.edit.type.accordion', [
        'collection' => $collection,
        'definitions' => $definitions,
        'vueData' => $vueData,
        'group_key' => $group_key
    ])
    <br />

@endforeach
