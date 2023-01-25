<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $item */

    if(\AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa::isNonWdpa($item->wdpa_id)){
        $pa = \AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa::find($item->wdpa_id);
    } else {
        $pa = \AndreaMarelli\ImetCore\Models\ProtectedArea::getByWdpa($item->wdpa_id);
    }

    if($pa!==null){
        $vue_data['records'][0]['CompleteName']     = $vue_data['records'][0]['CompleteName']   ?? $pa->name;
        $vue_data['records'][0]['WDPA']             = $vue_data['records'][0]['WDPA']           ?? $pa->wdpa_id;
        $vue_data['records'][0]['IUCNCategory1']    = $vue_data['records'][0]['IUCNCategory1']  ?? $pa->iucn_category;
        $vue_data['records'][0]['Country']          = $vue_data['records'][0]['Country']        ?? $pa->country;
        $vue_data['records'][0]['CreationYear']     = $vue_data['records'][0]['CreationYear']   ??
            ($pa->creation_date!==null ? substr($pa->creation_date, 0, 4) : null);
    }
    $vue_data['records'][0]['Type']             = $vue_data['records'][0]['Type']           ?? $item->Type;

?>
@include('modular-forms::module.show.body',  compact(['collection', 'definitions']))
