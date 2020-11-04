<?php
/** @var \App\Http\Controllers\Controller $controller */
/** @var \Illuminate\Database\Eloquent\Model|String $item */

$href = $item instanceof \Illuminate\Database\Eloquent\Model
    ? 'href="' . action([$controller, 'show'], [$item->getKey()]) . '"'
    : ':href="\'' . vueAction($controller, 'show', $item ?? 'item.id') . '\'"';

?>
<a
        {!! $href !!}
        class="btn btn-primary btn-sm"
        role="button"
        data-toggle="tooltip" data-placement="top" data-original-title="@lang('common.show')">
    {!! App\Library\Utils\Template::icon('eye', 'white') !!}
</a>