<?php
/** @var String $form_class */

use AndreaMarelli\ImetCore\Controllers\Imet;

?>

<span v-if="item.version==='{{ $form_class::IMET_V1 }}'">
    @include('modular-forms::buttons._generic', [
        'controller' => Imet\v1\Controller::class,
        'action' =>'print',
        'item' => 'item.FormID',
        'tooltip' => ucfirst(trans('modular-forms::common.print')),
        'icon' => 'print',
        'class' => 'btn-primary'
    ])
</span>
<span v-else-if="item.version==='{{ $form_class::IMET_V2 }}'">
    @include('modular-forms::buttons._generic', [
        'controller' => Imet\v2\Controller::class,
        'action' =>'print',
        'item' => 'item.FormID',
        'tooltip' => ucfirst(trans('modular-forms::common.print')),
        'icon' => 'print',
        'class' => 'btn-primary'
    ])
</span>
<span v-else-if="item.version==='{{ $form_class::IMET_OECM }}'">
    @include('modular-forms::buttons._generic', [
        'controller' => Imet\oecm\Controller::class,
        'action' =>'print',
        'item' => 'item.FormID',
        'tooltip' => ucfirst(trans('modular-forms::common.print')),
        'icon' => 'print',
        'class' => 'btn-primary'
    ])
</span>