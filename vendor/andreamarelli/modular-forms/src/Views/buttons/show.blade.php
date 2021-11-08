<?php
/** @var \AndreaMarelli\ModularForms\Controllers\Controller $controller */
/** @var \Illuminate\Database\Eloquent\Model|String $item */

$href = $item instanceof \Illuminate\Database\Eloquent\Model
    ? 'href="' . action([$controller, 'show'], [$item->getKey()]) . '"'
    : ':href="\'' . vueAction($controller, 'show', $item ?? 'item.id') . '\'"';

?>
<a
        {!! $href !!}
        class="btn-nav small"
        role="button"
        data-toggle="tooltip" data-placement="top" data-original-title="@lang('modular-forms::common.show')">
    {!! AndreaMarelli\ModularForms\Helpers\Template::icon('eye', 'white') !!}
</a>
