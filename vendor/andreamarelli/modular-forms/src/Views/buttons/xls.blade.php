<?php
/** @var \AndreaMarelli\ModularForms\Controllers\FormController $controller */
/** @var String $label */

$label = $label ?? trans('modular-forms::common.xls');

?>
<a href="{{ action([$controller, 'xls']) }}"
   class="btn-nav rounded"> {!! AndreaMarelli\ModularForms\Helpers\Template::icon('file-excel', 'white') !!} {{ ucfirst($label) }}
</a>
