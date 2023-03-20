<?php
/** @var String $type */
/** @var String $v_value */
/** @var String $id [optional] */
/** @var String $class [optional] */
/** @var String $rules [optional] */
/** @var String $other [optional] */
/** @var String $module_key [optional] */

$id = $id ?? '';
$class = $class ?? '';
$rules = $rules ?? '';
$other = $other ?? '';

$vue_attributes = \AndreaMarelli\ModularForms\Helpers\DOM::vueAttributes($id, $v_value);
$class_attribute = \AndreaMarelli\ModularForms\Helpers\DOM::addClass($class, 'field-edit');
$rules_attribute = \AndreaMarelli\ModularForms\Helpers\DOM::rulesAttribute($rules);
$other_attributes = $other ?? '';

?>

@if($type === 'imet-core::selector-wdpa')
    <selector-wdpa
        {!! $vue_attributes !!}
        search-url="{{ route('imet-core::search_pas') }}"
        :data-countries='@json(\AndreaMarelli\ImetCore\Models\ProtectedArea::getCountries()
                ->sortBy('name_'.\AndreaMarelli\ModularForms\Helpers\Locale::lower())
                ->pluck('name_'.\AndreaMarelli\ModularForms\Helpers\Locale::lower(), 'iso3')
                ->toArray(), JSON_HEX_APOS)'
    ></selector-wdpa>

@elseif($type === 'imet-core::selector-wdpa_multiple')
    <selector-wdpa_multiple
        search-url="{{ route('imet-core::search_pas') }}"
        labels-url="{{ route('imet-core::labels_pas') }}"
        {!! $vue_attributes !!}
    ></selector-wdpa_multiple>

@elseif($type === 'imet-core::selector-wdpa_multiple_withFreeText')
    <selector-wdpa_multiple
        search-url="{{ route('imet-core::search_pas') }}"
        labels-url="{{ route('imet-core::labels_pas') }}"
        :enable-free-text=true
        {!! $vue_attributes !!}
    ></selector-wdpa_multiple>

@elseif($type==='imet-core::selector-species_animal')
    <selector-species_animal
            {!! $vue_attributes !!}
            search-url="{{ route('imet-core::search_species') }}"
    ></selector-species_animal>

@elseif($type==='imet-core::selector-species_animal_withFreeText')
    <selector-species_animal
            {!! $vue_attributes !!}
            search-url="{{ route('imet-core::search_species') }}"
            :enable-free-text=true
    ></selector-species_animal>


@elseif(\Illuminate\Support\Str::startsWith($type, 'imet-core::rating-'))
    <?php

        // retrieve legend
        $fieldName = explode('.', rtrim($v_value, '"'))[1];
        $className = \AndreaMarelli\ModularForms\Helpers\ModuleKey::KeyToClassName($module_key);
        $legend = (new $className())->ratingLegend;
//    dd($fieldName, $legend);
        $legend = array_key_exists($fieldName, $legend) ? $legend[$fieldName] : [];
        $legend = array_values($legend);

    ?>

    <rating
        rating-type="{{ str_replace('imet-core::rating-', '', $type) }}"
        :legend='@json($legend)'
        {!! $vue_attributes !!}data-{!! $class_attribute !!} {!! $rules_attribute !!} {!! $other_attributes !!}
    ></rating>


@endif



