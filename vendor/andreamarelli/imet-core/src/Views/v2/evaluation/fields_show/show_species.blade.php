<?php
/** @var String $value */


if(\AndreaMarelli\ImetCore\Models\Animal::isTaxonomy($value)){
    $taxonomy = \AndreaMarelli\ImetCore\Models\Animal::parseTaxonomy($value);
    $value = $taxonomy['genus'] . ' ' . $taxonomy['species'];
}

?>

<div class="field-preview">
    {!! $value ?? '&nbsp;' !!}
</div>
