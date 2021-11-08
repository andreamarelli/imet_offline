<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

    $imet = \AndreaMarelli\ImetCore\Models\Imet\v1\Imet::find($vue_data['form_id']);
    $pa = \AndreaMarelli\ImetCore\Models\ProtectedArea::getByWdpa($imet->wdpa_id);

    if($pa!==null){
        $vue_data['records'][0]['CompleteName']     = $vue_data['records'][0]['CompleteName']   ?? $pa->name;
        $vue_data['records'][0]['WDPA']             = $vue_data['records'][0]['WDPA']           ?? $pa->wdpa_id;
        $vue_data['records'][0]['IUCNCategory1']    = $vue_data['records'][0]['IUCNCategory1']  ?? $pa->iucn_category;
        $vue_data['records'][0]['Country']          = $vue_data['records'][0]['Country']        ?? $pa->country;
        $vue_data['records'][0]['CreationYear']     = $vue_data['records'][0]['CreationYear']   ??
            ($pa->creation_date!==null ? substr($pa->creation_date, 0, 4) : null);
    }
    $vue_data['records'][0]['Type']             = $vue_data['records'][0]['Type']           ?? $imet->Type;

?>

@include('modular-forms::module.edit.body', compact(['collection', 'vue_data', 'definitions']))


@push('scripts')
<script>
    // ## Initialize Module controller ##
    let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
        el: '#module_{{ $definitions['module_key'] }}',
        data: @json($vue_data)
    });
</script>
@endpush
