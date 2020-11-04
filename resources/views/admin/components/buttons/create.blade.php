<?php
/** @var \App\Http\Controllers\Controller $controller */
/** @var String $label */

$label = $label ?? trans('common.create');

?>

<a href="{{ action([$controller, 'create']) }}"
   class="btn-nav rounded"> {!! App\Library\Utils\Template::icon('plus-circle', 'white') !!} {{ ucfirst($label) }}
</a>