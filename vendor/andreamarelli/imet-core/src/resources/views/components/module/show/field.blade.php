<?php
/** @var String $type */
/** @var String $value */
/** @var bool $only_label [optional] */

$value = $value==='' ? null : $value;
$only_label = $only_label ?? false;

?>

{{-- #### Custom field types #### --}}


{{-- ###### IMET ###### --}}
@if(\Illuminate\Support\Str::startsWith($type, 'imet-core::'))

    @include('imet-core::components.show-types', [
       'type' => $type,
       'value' => $value,
       'only_label' => $only_label
    ])

{{-- ###### Standard vendor (modular-forms) field types ###### --}}
@else

    @include('modular-forms::module.show.field-types', [
       'type' => $type,
       'value' => $value,
       'only_label' => $only_label
    ])

@endif

