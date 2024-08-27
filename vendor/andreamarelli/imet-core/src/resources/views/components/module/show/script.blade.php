@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Base())
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
