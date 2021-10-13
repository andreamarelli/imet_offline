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
        :data-countries='@json(\AndreaMarelli\ImetCore\Models\ProtectedArea::getCountries()
                ->sortBy('name_'.\AndreaMarelli\ModularForms\Helpers\Locale::lower())
                ->pluck('name_'.\AndreaMarelli\ModularForms\Helpers\Locale::lower(), 'iso3')
                ->toArray(), JSON_HEX_APOS)'
    ></selector-wdpa>

@elseif($type === 'imet-core::selector-wdpa_multiple')
    <selector-wdpa_multiple {!! $vue_attributes !!} ></selector-wdpa_multiple>


@endif



