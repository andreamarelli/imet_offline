<?php
/** @var \AndreaMarelli\ModularForms\Controllers\Controller $controller */
/** @var \Illuminate\Database\Eloquent\Model|String $item */

$href = $item instanceof \Illuminate\Database\Eloquent\Model
    ? 'href="' . action([$controller, 'edit'], [$item->getKey()]) . '"'
    : ':href="\'' . vueAction($controller, 'edit', $item ?? 'item.id') . '\'"';

?>
<a
        {!! $href !!}
        class="btn-nav yellow small"
        role="button"
        data-toggle="tooltip" data-placement="top" data-original-title="@lang('modular-forms::common.edit')">
    {!! AndreaMarelli\ModularForms\Helpers\Template::icon('pen', 'white') !!}
</a>
