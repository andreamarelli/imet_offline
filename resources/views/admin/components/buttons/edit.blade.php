<?php
/** @var \App\Http\Controllers\Controller $controller */
/** @var \Illuminate\Database\Eloquent\Model|String $item */

$href = $item instanceof \Illuminate\Database\Eloquent\Model
    ? 'href="' . action([$controller, 'edit'], [$item->getKey()]) . '"'
    : ':href="\'' . vueAction($controller, 'edit', $item ?? 'item.id') . '\'"';

?>
<a
        {!! $href !!}
        class="btn btn-warning btn-sm"
        role="button"
        data-toggle="tooltip" data-placement="top" data-original-title="@lang('common.edit')">
    {!! App\Library\Utils\Template::icon('pen', 'white') !!}
</a>