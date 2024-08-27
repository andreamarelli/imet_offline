<?php
/** @var String $version */

use AndreaMarelli\ModularForms\Helpers\Template;

if($version === \AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_V1){
    $controller = \AndreaMarelli\ImetCore\Controllers\Imet\v1\Controller::class;
} else if($version === \AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_V2){
    $controller = \AndreaMarelli\ImetCore\Controllers\Imet\v2\Controller::class;
} else {
    $controller = \AndreaMarelli\ImetCore\Controllers\Imet\oecm\Controller::class;
}

?>

<a id="merge_{{ $item->getKey() }}"
   class="btn-nav mr-1 small yellow"
   href="{{ action([$controller, 'merge_view'], [$item->getKey()]) }}">
    {!! Template::icon('clone') !!}
</a>
<tooltip anchor-elem-id="merge_{{ $item->getKey() }}">
    {{ ucfirst(trans('modular-forms::common.merge')) }}
</tooltip>
