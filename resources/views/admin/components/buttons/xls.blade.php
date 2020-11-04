<?php
/** @var \App\Http\Controllers\Components\FormController $controller */
/** @var String $label */

$label = $label ?? trans('common.xls');

?>
<a href="{{ action([$controller, 'xls']) }}"
   class="btn-nav rounded"> {!! App\Library\Utils\Template::icon('file-excel', 'white') !!} {{ ucfirst($label) }}
</a>