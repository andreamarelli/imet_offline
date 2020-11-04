<?php
/** @var \App\Http\Controllers\Controller $controller */
/** @var String $label */

$label = $label ?? trans('common.csv');

?>

<a href="{{ action([$controller, 'csv']) }}"
   class="btn-nav rounded"> {!! App\Library\Utils\Template::icon('file-alt', 'white') !!} {{ ucfirst($label) }}
</a>