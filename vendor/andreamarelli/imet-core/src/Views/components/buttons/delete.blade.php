<?php
/** @var String $form_class */
/** @var String $item */
/** @var String $label */

use AndreaMarelli\ImetCore\Controllers\Imet;

$item = $item ?? 'item.FormID';
$label = $label ?? null;

?>

<span v-if="item.version==='{{ $form_class::IMET_V1 }}'">
    @include('modular-forms::buttons.delete', [
        'controller' => Imet\v1\Controller::class,
        'item' => $item,
        'label' => $label
    ])
</span>
<span v-else-if="item.version==='{{ $form_class::IMET_V2 }}'">
    @include('modular-forms::buttons.delete', [
        'controller' => Imet\v2\Controller::class,
        'item' => $item,
        'label' => $label
    ])
</span>
<span v-else-if="item.version==='{{ $form_class::IMET_OECM }}'">
    @include('modular-forms::buttons.delete', [
        'controller' => Imet\oecm\Controller::class,
        'item' => $item,
        'label' => $label
    ])
</span>