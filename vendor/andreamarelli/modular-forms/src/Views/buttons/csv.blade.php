<?php
/** @var \AndreaMarelli\ModularForms\Controllers\Controller $controller */
/** @var String $label */

$label = $label ?? ('modular-forms::common.csv');

?>

<a href="{{ action([$controller, 'csv']) }}"
   class="btn-nav rounded"> {!! AndreaMarelli\ModularForms\Helpers\Template::icon('file-alt', 'white') !!} {{ ucfirst($label) }}
</a>
