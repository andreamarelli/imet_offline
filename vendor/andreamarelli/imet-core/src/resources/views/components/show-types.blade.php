<?php

use AndreaMarelli\ImetCore\Models\Animal;
use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;
use Illuminate\Support\Str;

/** @var String $type */
/** @var String $value */
/** @var bool $only_label [optional] */

$value = $value === '' ? null : $value;
$only_label = $only_label ?? false;

?>

@if(Str::contains($type, 'selector-wdpa_multiple'))
    <?php
        if($value !== null){
            $values = array_map(function ($value) use ($type) {
                return SelectionList::getLabel('Imet_ProtectedArea', str_replace('OFAC_', '', $value));
            }, explode(',', $value));
            $value = implode(',', $values);
        }
    ?>
    <div class="field-preview">
        {!! $value ?? '&nbsp;' !!}
    </div>

@elseif(Str::contains($type, 'selector-species_animal'))
    <?php
        if($value !== null){
            $value = Animal::getPlainNameByTaxonomy($value);
        }
    ?>
    <div class="field-preview">
        {!! $value ?? '&nbsp;' !!}
    </div>

@endif
