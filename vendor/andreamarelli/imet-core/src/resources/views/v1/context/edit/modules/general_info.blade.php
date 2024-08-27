<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */


    $imet = \AndreaMarelli\ImetCore\Models\Imet\v1\Imet::find($vueData['form_id']);
    if(\AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa::isNonWdpa($imet->wdpa_id)){
        $pa = \AndreaMarelli\ImetCore\Models\ProtectedAreaNonWdpa::find($imet->wdpa_id);
    } else {
        $pa = \AndreaMarelli\ImetCore\Models\ProtectedArea::getByWdpa($imet->wdpa_id);
    }

    if($pa!==null){
        $vueData['records'][0]['CompleteName']     = $vueData['records'][0]['CompleteName']   ?? $pa->name;
        $vueData['records'][0]['WDPA']             = $vueData['records'][0]['WDPA']           ?? $pa->wdpa_id;
        $vueData['records'][0]['IUCNCategory1']    = $vueData['records'][0]['IUCNCategory1']  ?? $pa->iucn_category;
        $vueData['records'][0]['Country']          = $vueData['records'][0]['Country']        ?? $pa->country;
        $vueData['records'][0]['CreationYear']     = $vueData['records'][0]['CreationYear']   ??
            ($pa->creation_date!==null ? substr($pa->creation_date, 0, 4) : null);
    }
    $vueData['records'][0]['Type']             = $vueData['records'][0]['Type']           ?? $imet->Type;

?>

@include('modular-forms::module.edit.body', compact(['collection', 'vueData', 'definitions']))

@include('modular-forms::module.edit.script', compact(['collection', 'vueData', 'definitions']))