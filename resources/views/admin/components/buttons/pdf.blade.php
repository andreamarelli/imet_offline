<?php
/** @var \App\Http\Controllers\Components\FormController $controller */
/** @var \App\Models\Components\Form $item */

?>

<a href="{{ action([$controller, 'pdf'], [$item->getKey()]) }}"
   target="_blank"
   class="btn btn-danger btn-sm"
   role="button"
   data-toggle="tooltip" data-placement="top" data-original-title="@lang('common.pdf')">
    {!! App\Library\Utils\Template::icon('file-pdf', 'white') !!}
</a>