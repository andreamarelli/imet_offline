<?php
/** @var \App\Http\Controllers\Controller $controller */
/** @var String $action */
/** @var \Illuminate\Database\Eloquent\Model|String $item */
/** @var String $label */
/** @var String $tooltip */
/** @var String (optional) $class */
/** @var String (optional) $icon */

//$label = App\Library\Utils\Template::icon('eye', 'white');
//$tooltip = trans('common.show');
$label = $label ?? '';
$tooltip = $tooltip ?? $label;
$class = $class ?? 'btn-success';

$href = $item instanceof \Illuminate\Database\Eloquent\Model
    ? 'href="' . action([$controller, $action], [$item->getKey()]) . '"'
    : ':href="\'' . vueAction($controller, $action, $item ?? 'item.id') . '\'"';

?>
<a {!! $href !!}
   target="_blank"
   class="btn btn-sm {!! $class !!}"
   role="button"
   data-toggle="tooltip" data-placement="top" data-original-title="{{ $tooltip }}">
    {!! $icon!==null ? App\Library\Utils\Template::icon($icon) : '' !!} {!! $label !!}
</a>