<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

?>

@push('scripts')
    <script type="module">

        (new window.ModularForms.Apps.Module(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');

    </script>
@endpush
