<script src="{{ asset(mix('modular_forms_vendor_mapbox.js', 'assets')) }}"></script>
<link rel="stylesheet" href="{{ asset(mix('modular_forms_vendor_mapbox.css', 'assets')) }}">
<script>
    window.mapboxgl.accessToken = '{{ env('MAPBOX_ACCESS_TOKEN') }}';
</script>
