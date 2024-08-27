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
        $vueData['records'][0]['CompleteName']     = $vueData['records'][0]['CompleteName']   ?? $pa->name;
        $vueData['records'][0]['WDPA']             = $vueData['records'][0]['WDPA']           ?? $pa->wdpa_id;
        $vueData['records'][0]['IUCNCategory1']    = $vueData['records'][0]['IUCNCategory1']  ?? $pa->iucn_category;
        $vueData['records'][0]['Country']          = $vueData['records'][0]['Country']        ?? $pa->country;
        $vueData['records'][0]['CreationYear']     = $vueData['records'][0]['CreationYear']   ??
            ($pa->creation_date!==null ? substr($pa->creation_date, 0, 4) : null);
    }
    $vueData['records'][0]['Type']             = $vueData['records'][0]['Type']           ?? $item->Type;

?>
@include('modular-forms::module.show.body',  compact(['collection', 'definitions']))
