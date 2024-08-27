@push('scripts')
    <script type="module">
        // ## Initialize Module controller ##
       (new window.ModularForms.Apps.Base())
           .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
