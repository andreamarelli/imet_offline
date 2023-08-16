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

@elseif(Str::startsWith($type, 'imet-core::rating-'))
    <?php
        $ratingType = str_replace('imet-core::rating-', '', $type);
        $ratingType = str_replace('WithNA', '', $ratingType);
        $ratingType = str_replace('Minus', '-', $ratingType);
        [$min, $max] = explode('to', $ratingType);
    ?>
    <span ref="ratingOptions" class="rating-container">
        @if(Str::contains($type, 'WithNA'))
            <span class="rating field-edit ratingNa {{ $value=='-99' ? 'active' : '' }}"
            >N/A</span>
        @endif
        @for($i=$min; $i<=$max; $i++)
            <span class="rating field-edit ratingNum {{ $value!==null && $i<=$value ? 'active' : '' }}"
            >{{ $i }}</span>
        @endfor
    </span>

@endif
