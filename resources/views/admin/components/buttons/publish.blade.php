<?php
/** @var \App\Http\Controllers\Components\FormController $controller */
/** @var \App\Models\Components\Form $item */

?>

<a href="{{ action([$controller, 'publish'], [$item->getKey()]) }}"
   target="_blank"
   class="btn btn-success btn-sm"
   role="button"
   data-toggle="tooltip" data-placement="top" data-original-title="@lang('common.show')">
    {!! App\Library\Utils\Template::icon('eye', 'white') !!}
</a>