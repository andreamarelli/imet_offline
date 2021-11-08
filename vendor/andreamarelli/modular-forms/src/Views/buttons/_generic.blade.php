<?php
/** @var \AndreaMarelli\ModularForms\Controllers\Controller $controller */
/** @var String $action */
/** @var \Illuminate\Database\Eloquent\Model|String $item */
/** @var String $label */
/** @var String $tooltip */
/** @var String (optional) $class */
/** @var String (optional) $icon */
/** @var String (optional) $new_page */

$label = $label ?? '';
$tooltip = $tooltip ?? $label;
$class = $class ?? '';
$new_page = $new_page ?? true;

$href = $item instanceof \Illuminate\Database\Eloquent\Model
    ? 'href="' . action([$controller, $action], [$item->getKey()]) . '"'
    : ':href="\'' . vueAction($controller, $action, $item ?? 'item.id') . '\'"';

?>
<a {!! $href !!}
   @if($new_page) target="_blank" @endif
   class="btn-nav small {!! $class !!}"
   role="button"
   data-toggle="tooltip" data-placement="top" data-original-title="{{ $tooltip }}">
    {!! $icon!==null ? AndreaMarelli\ModularForms\Helpers\Template::icon($icon) : '' !!} {!! $label !!}
</a>
