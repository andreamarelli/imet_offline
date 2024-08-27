<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */


?>

@include('modular-forms::module.edit.type.simple', compact(['collection', 'vueData', 'definitions']))


@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.CreateNonWDPA(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush


