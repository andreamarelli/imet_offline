<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */
?>


@foreach($definitions['groups'] as $group_key => $group_label)
    <div class="{{ $group_key }}">

        <h5 class="green group_title_{{ $definitions['module_key'] }}_{{ $group_key }}">{{ $group_label }}</h5>

        @include('admin.components.module.preview.type.table', [
            'definitions' => $definitions,
            'records' => $records,
            'group_key' => $group_key
        ])

    </div>
@endforeach