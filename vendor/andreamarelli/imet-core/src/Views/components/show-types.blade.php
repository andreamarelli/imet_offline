<?php
/** @var String $type */
/** @var String $value */
/** @var bool $only_label [optional] */

$value = $value==='' ? null : $value;
$only_label = $only_label ?? false;

?>

@if(\Illuminate\Support\Str::contains($type, 'selector-wdpa_multiple'))
    <?php
    if($value!==null){
        $values = array_map(function($value) use($type){
            return \AndreaMarelli\ModularForms\Helpers\Input\SelectionList::getLabel('ProtectedArea', str_replace('OFAC_', '', $value));
        }, explode(',', $value));
        $value = implode(',', $values);
    }
    ?>
    <div class="field-preview">
        {!! $value ?? '&nbsp;' !!}
    </div>

@endif
